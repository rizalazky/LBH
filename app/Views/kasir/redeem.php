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
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/css/daftar-hadiah.css">
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
                <h1 id='poin' style="font-family: VAG Rounded;text-align: center;color: #4c9585;">
                    <?php echo session()->get('customer')->companyname; ?>
                    <br/>
                    Poin : <?php echo $customerpoin;?>  
                </h1>
                <div class="container-daftar-hadiah">
                    <?php
                        for ($i=0; $i <count($daftar_hadiah) ; $i++) {
                            if($daftar_hadiah[$i]->poindibutuhkan <= $customerpoin && $daftar_hadiah[$i]->qtyonhand >0){
                    ?>
                                <a href="<?php echo base_url('/kasir/redeem?id='.$daftar_hadiah[$i]->id.'&poincust='.$customerpoin.'&poinitem='.$daftar_hadiah[$i]->poindibutuhkan);?>" class="daftar-hadiah-item">
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
                                </a>
                    <?php
                            } 
                        }
                    ?>
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
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>