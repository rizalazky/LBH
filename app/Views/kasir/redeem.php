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
            <?php if($_SESSION['user']->location != '21'){ ?>
                <button class='btn-profile' onclick="showModalPoin()" style='text-decoration:none;'>Input Poin</button>
            <?php } ?>
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
                            if(($daftar_hadiah[$i]->poindibutuhkan <= $customerpoin && $daftar_hadiah[$i]->qtyonhand >0) || $_SESSION['user']->location == '21'){ // location Penukaran HUT
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
                                                <?php if($_SESSION['user']->location !== '21'){ ?>
                                                    <?php echo $daftar_hadiah[$i]->poindibutuhkan?> Poin
                                                    <br/>
                                                <?php } ?>
                                                Stock : <?php echo $daftar_hadiah[$i]->qtyonhand;?>
                                                <br/>
                                                <div class="container-inp-qty" id="container-inp-qty-<?php echo $daftar_hadiah[$i]->id?>">
                                                    <label for="qtyitem">Qty</label>
                                                    <!-- <br/> -->
                                                    <input type="number" 
                                                        name="qtyitem"
                                                        class='inp-qty' 
                                                        id="qtyitem-<?php echo $daftar_hadiah[$i]->id?>" 
                                                        data-iditem="<?php echo $daftar_hadiah[$i]->id?>"
                                                        data-namaitem="<?php echo $daftar_hadiah[$i]->namahadiah?>"
                                                        data-poindibutuhkan="<?php echo $daftar_hadiah[$i]->poindibutuhkan?>"
                                                        oninput="inpQtyOnChange(this)"
                                                        value="1"> 
                                                </div>
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
                            <?php if($_SESSION['user']->location == '21'){ ?>
                                <div style='display:none;'>
                                    <span id='lastPoinText' class='poin-angka'><?php echo $customerpoin;?> </span>
                                    <br>
                                    <span  class='poin-desc'>
                                        Last Poin
                                    </span>
                                </div>
                                <div style='display:none;'>
                                    <span id='poinRedeemText' class='poin-angka'>0</span>
                                    <br>
                                    <span class='poin-desc'>Poin Redeem </span>
                                </div>
                                <div style='display:none;'>
                                    <span id='poinText' class='poin-angka'><?php echo $customerpoin;?> </span>
                                    <br>
                                    <span class='poin-desc'>Sisa Poin</span> 
                                </div>
                                <?php }else{ ?>
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
                                <?php } ?>
                        </div>
                        <button type="button" id="saveBtn" onclick="save()">Save</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="modal-input-poin">
        <div class="modal-input-poin-header">
            <span class='modal-header-text'>Input Poin</span>
        </div>
        <div class="modal-input-poin-body">
            <form action="<?php echo base_url()?>/kasir/inputpoin" method="post">
                <div class="form-control">
                    <input type="number" name='poin'>
                </div>
        </div>
        <div class="modal-input-poin-footer">
                <div class="btn-form-container">
                    <span class="btn-form" onclick="closeModal(this)">Cancel</span>
                    <input class="btn-form" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
    <div class="loading">
        Loading...
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
        const loadingEl=document.getElementsByClassName('loading')
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

      function inpQtyOnChange(e){
        let checked=e.dataset.checked;
        let idHadiah=e.dataset.iditem;
        let poinDibutuhkan=e.dataset.poindibutuhkan;
        let namaitem=e.dataset.namaitem;
        
        let qty=document.getElementById('qtyitem-'+idHadiah).value !== "" ?document.getElementById('qtyitem-'+idHadiah).value :0;
        console.log(qty)
        console.log(qty)
        for (let index = 0; index < dataTerpilih.length; index++) {
                const dt = dataTerpilih[index];
                if(dt.id === idHadiah){
                    dt.qty=Number(qty)
                }
        }
        
        let updatePoinVar=updatePoin();
        if(!updatePoinVar){
            document.getElementById('qtyitem-'+idHadiah).value =0
            inpQtyOnChange(e)//dipanggil lagi karena utk menghitung nilai 0
        }
      }

      function updatePoin(){
          console.log(dataTerpilih)
          lastPoinCustomer=lastPoinText.innerText;
            poinRedeem=0;
            for (let index = 0; index < dataTerpilih.length; index++) {
                const dt = dataTerpilih[index];
                poinRedeem+=(Number(dt.qty)*Number(dt.poinitem))
            }
            let sisaPoin=Number(lastPoinCustomer)-Number(poinRedeem);
            if(sisaPoin>= 0){
                poin.innerText= sisaPoin
                poinRedeemText.innerText=poinRedeem
                return true
            }else{
                alert("Poin Tidak Cukup")
                return false
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
                    poinitem:poinDibutuhkan,
                    qty:1
                });
                e.dataset.checked ="true";
                // poinTemp=Number(poinTemp) + Number(poinDibutuhkan);
                // poin.innerText=Number(poin.innerText) - Number(poinDibutuhkan)
                document.getElementById("container-inp-qty-"+idHadiah).style.display='block';
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
                    // poin.innerText=Number(poin.innerText) + Number(poinDibutuhkan)
                    document.getElementById("container-inp-qty-"+idHadiah).style.display='none';
                }
            }
            // poinTemp=Number(poinTemp) - Number(poinDibutuhkan);
        }
        updatePoin();
        // poinRedeemText.innerText=Number(lastPoinText.innerText) - Number(poin.innerText)
        
      }

      async function save(){
          const btnSave=document.getElementById('saveBtn')
          if(dataTerpilih.length > 0){
            let url=`<?php echo base_url()?>/kasir/redeempost`;
            loadingEl[0].style.display='flex';
            
            btnSave.setAttribute("disabled", "");
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
                loadingEl[0].style.display='none';
                btnSave.removeAttribute("disabled", "");
            }).catch(err=>{
                console.log(err)
            })
          }else{
            alert("Anda belum memilih item")
          }
      }

      function showModalPoin(){
          const modalPoin=document.getElementsByClassName('modal-input-poin')[0]
          console.log(modalPoin)
          modalPoin.style.display='block'
      }

      function closeModal(){
          
          const modalPoin=document.getElementsByClassName('modal-input-poin')[0]
          console.log(modalPoin)
          modalPoin.style.display='none'
      }
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>