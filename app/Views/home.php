<?php

session_start()

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/css/homeuser.css">
</head>

<body>
    <!-- <img class="banner" src="<?php echo base_url() ?>/public/img/banner.jpeg" alt=""> -->
    <div class="container">
        <div class="header">
            <img class="logo" src="<?php echo base_url() ?>/public/img/logo.png" alt="">
            <div class="navigation">
                <a class='btn-profile' style='text-decoration:none;' href="<?php echo base_url()?>/logout">Logout</a>
            </div>
        </div>
        <div class="home">
            <div class='navbar'>
                <div class="navbar-menu">
                    <a class="navbar-item" href="<?php echo base_url('/profile');?>">
                        Home
                    </a>
                    <a class="navbar-item" href="<?php echo base_url('/profile/profile');?>">
                        Profile
                    </a>
                    <a class="navbar-item" href="<?php echo base_url('/profile/inputstruck');?>">
                        Input Struck
                    </a>
                    <a class="navbar-item" href="<?php echo base_url('/profile/daftarhadiah');?>">
                        Daftar Hadiah
                    </a>
                    <a class="navbar-item" href="<?php echo base_url('/profile/history');?>">
                        Lihat History
                    </a>
                </div>
            </div>
            <div class="content">
                <div class="banner-promo">
                    <?php 
                    if($promo){
                        for ($i=0; $i < count($promo); $i++) { ?>
                        <div class="banner-item">

                            <img src="<?php echo $promo[$i]->image_url?>" alt="<?php echo $promo[$i]->image_url?>">
                            <span class="banner-desc">
                                <?php echo $promo[$i]->promo_name?>
                            </span>
                        </div>
                    <?php } 
                    }
                    ?>
                    <div class="btn-control-container">
                        <button id='prev' class='btn-image-control btn-profile'>Prev</button>
                        <button id='next' class='btn-image-control btn-profile'>Next</button>
                    </div>
                </div>
                <div class="greeting">
                    <h1>Selamat Datang Kembali <span class='sorot'><?php echo $user_customer->companyname;?></span>,anda telah berhasil mengumpulkan</h1>
                    <ul class='poin-menu'>
                        <li ><span class='sorot'><?php echo $kupon ?></span> Kupon</li>
                        <li><span class='sorot'><?php echo $poin ?></span> Poin Keluarga Lavie</li>
                    </ul>
                </div>
            </div> 
        </div>
    </div>
    <!-- JS -->
    <script src="<?php echo base_url() ?>/public/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/public/js/main.js"></script>
    <script>
        // document.getElementById('tgllahir').valueAsDate = new Date();
        function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }


    //   image slider
    let index=0;
    let items=document.getElementsByClassName('banner-item')
    let count=items.length

    items[0].style.display ='block';

    const btnNext=document.getElementById('next')
    const btnPrev=document.getElementById('prev')

    btnNext.addEventListener('click',()=>{
        if(index < count -1) index +=1;
        slide();
    })

    btnPrev.addEventListener('click',()=>{
        if(index > 0) index -=1;
        slide();
    })

    function slide(){
       for (let i = 0; i < items.length; i++) {
           const item = items[i];
           item.style.display ='none' 
       }
       items[index].style.display ='block'
    }

    let autoSlide= setInterval(() => {
        index +=1;
        if(index >=count) index=0
        slide();
    }, 2000);
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>