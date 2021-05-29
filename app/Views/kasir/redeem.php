<?php

session_start()

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redeem</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>/public/css/homeuser.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/css/daftar-hadiah.css"> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/css/redeem.css"> 
</head>

<body>
    <!-- <img class="banner" src="<?php echo base_url() ?>/public/img/banner.jpeg" alt=""> -->
    <div class="container">
        <div class="header">
            <img class="logo" src="<?php echo base_url() ?>/public/img/logo.png" alt="">
            <div class="navigation">
                <a class='btn-profile' style='text-decoration:none;' href="<?php echo base_url('/kasir/inputstruk');?>">Input Struck</a>
                <a class='btn-profile' style='text-decoration:none;' href="<?php echo base_url()?>/kasir/logout">Logout</a>
            </div>
        </div>
        <div class="home">
            <div class='navbar'>
                <!-- <div class="navbar-menu">
                    <a class="navbar-item" href="<?php echo base_url('/kasir/inputstruk');?>">
                        Input Struck
                    </a>
                </div> -->
            </div>
            <div class="content">
                
                <div class="container-daftar-hadiah">
                    <?php
                        for ($i=0; $i <count($daftar_hadiah) ; $i++) {
                            if($daftar_hadiah[$i]->poindibutuhkan <= $customerpoin && $daftar_hadiah[$i]->qtyonhand >0){
                    ?>
                                <div 
                                     data-iditem="<?php echo $daftar_hadiah[$i]->id?>"
                                     data-namaitem="<?php echo $daftar_hadiah[$i]->namahadiah?>"
                                     data-customerpoin="<?php echo $customerpoin;?>"
                                     data-poindibutuhkan="<?php echo $daftar_hadiah[$i]->poindibutuhkan?>"
                                     class="daftar-hadiah-item"
                                     >
                                     <input type='checkbox' id="<?php echo $daftar_hadiah[$i]->id?>" onclick="choosed(this)"
                                        data-iditem="<?php echo $daftar_hadiah[$i]->id?>"
                                        data-namaitem="<?php echo $daftar_hadiah[$i]->namahadiah?>"
                                        data-poindibutuhkan="<?php echo $daftar_hadiah[$i]->poindibutuhkan?>"
                                        class='daftar-hadiah-checkbox' data-checked="false"
                                        >
                                        <div class='list-gambar'>
                                            <img src="<?php echo $daftar_hadiah[$i]->img?>" alt="">
                                        </div>
                                        <div class='desc'>
                                            <span class='title'><?php echo $daftar_hadiah[$i]->namahadiah?></span>
                                            <span class='poin-ne'>
                                                <?php echo $daftar_hadiah[$i]->poindibutuhkan?> Poin
                                                <br/>
                                                Stock : <?php echo $daftar_hadiah[$i]->qtyonhand;?> 
                                            </span>
                                        </div>
                                </div>
                    <?php
                            } 
                        }
                    ?>
                    <div class="sticky">
                        <!-- <div id='poin' style="font-family: VAG Rounded;text-align: center;color: #4c9585;"> -->
                        <div id='poin'>
                            <div class='nama-customer'>
                                <?php echo session()->get('customer')->companyname; ?>
                            </div>
                            <div>
                                 <span id='lastPoinText' class='poin-angka'><?php echo $customerpoin;?> </span>
                                 <br>
                                 <span  class='poin-desc'>
                                    Last Poin
                                 </span>
                            </div>
                            <div>
                                <span id='poinRedeemText' class='poin-angka'>0</span>
                                <br>
                                <span class='poin-desc'>Poin Redeem </span>
                            </div>
                            <div>
                                <span id='poinText' class='poin-angka'><?php echo $customerpoin;?> </span>
                                <br>
                                <span class='poin-desc'>Sisa Poin</span> 
                            </div>
                        </div>
                        <button type="button" id="saveBtn" onclick="save()">Save</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    
    <!-- JS -->
    <script src="<?php echo base_url() ?>/public/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/public/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // document.getElementById('tgllahir').valueAsDate = new Date();
        const poin=document.getElementById('poinText');
        const poinRedeemText=document.getElementById('poinRedeemText');
        const lastPoinText=document.getElementById('lastPoinText');
        let poinTemp=0;
        let dataTerpilih=[];

        function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

      function confirmasi(e){
        
        let idHadiah=e.dataset.iditem;
        let poinDibutuhkan=e.dataset.poindibutuhkan;
        let customerPoin=e.dataset.customerpoin;
        let namaitem=e.dataset.namaitem;
          let cek=confirm(`Yakin Memilih Item ${namaitem} (${poinDibutuhkan} Poin) ??`);
          console.log(cek)
          if(cek){
            let url=`<?php echo base_url()?>/kasir/redeem?id=${idHadiah}&poincust=${customerPoin}&poinitem=${poinDibutuhkan}`;
            window.location.href=url
          }else{
              alert('redeem dibatalkan');
          }
      }

      function choosed(e){
          
        let checked=e.dataset.checked;
        let idHadiah=e.dataset.iditem;
        let poinDibutuhkan=e.dataset.poindibutuhkan;
        let namaitem=e.dataset.namaitem;

        // console.log("Poin Customer ==> ",poin.innerText)
        console.log(checked)
        if(checked=="false"){
            if(Number(poin.innerText) >= Number(poinDibutuhkan)){
                dataTerpilih.push({
                    id:idHadiah,
                    nama:namaitem,
                    poinitem:poinDibutuhkan
                });
                e.dataset.checked ="true";
                // poinTemp=Number(poinTemp) + Number(poinDibutuhkan);
                poin.innerText=Number(poin.innerText) - Number(poinDibutuhkan)
            }else{
                alert('Poin anda tidak cukup untuk menambah item ini');
                document.getElementById(idHadiah).checked=false;
            }
        }else{
            e.dataset.checked ="false";
            for (let index = 0; index < dataTerpilih.length; index++) {
                const dt = dataTerpilih[index];
                if(dt.id === idHadiah){
                    dataTerpilih.splice(index,1);
                    poin.innerText=Number(poin.innerText) + Number(poinDibutuhkan)
                }
            }
            // poinTemp=Number(poinTemp) - Number(poinDibutuhkan);
        }
        poinRedeemText.innerText=Number(lastPoinText.innerText) - Number(poin.innerText)
        
      }

      async function save(){
          if(dataTerpilih.length > 0){
            let url=`<?php echo base_url()?>/kasir/redeempost`;
            
            let postData={
                data:dataTerpilih
            }
            console.log(postData);
            fetch(url, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                'Content-Type': 'application/json'
                // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify(postData) // body data type must match "Content-Type" header
            }).then(res=>{
                return res.json()
            }).then(result=>{
                console.log(result)
                if(result.status == 'OKE'){
                    alert('redeem Berhasil Sipp !!');
                    window.location.href='<?php echo base_url()?>/kasir/redeem'
                }else{
                    alert("Gagal");
                }
            }).catch(err=>{
                console.log(err)
            })
          }else{
            alert("Anda belum memilih item")
          }
      }
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>