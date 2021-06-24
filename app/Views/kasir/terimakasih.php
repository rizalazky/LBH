<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/css/style.css">
</head>

<body style="background-image: url('<?php echo base_url()?>/public/img/banner.jpeg');background-size: cover;min-height: 99vh;">

    <!-- <img class="banner" src="<?php echo base_url()?>/public/img/banner.jpeg" alt=""> -->
    <div class="main">
        <section class="signup">
            <button class='btn-logout'><a href="<?php echo base_url()?>/kasir/logout">Logout</a></button>
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content" style='text-align:center;'>
                <h1 style='text-align:left;'>
                    <?php
                        $name=$_SESSION['customer']->companyname;
                        $phone=$_SESSION['customer']->phone;
                        $kupon=isset($_SESSION['earn_loyalti']->coupon) ? $_SESSION['earn_loyalti']->coupon : '';
                        $poin=0;
                        if($_SESSION['poinhis']){
                            for($j=0;$j<count($_SESSION['poinhis']);$j++){
                                $poin += $_SESSION['poinhis'][$j]['poin'];
                            }
                        }
                        
                    ?>
                    Selamat <span style='color:#db2082;font-size: 24px;font-family: "Frankfurter";'><strong><?php echo $name ? $name : $phone;?></strong></span>, Anda telah mendapatkan:
                </h1>
                
                
                <h1 style='text-align:left;'>
                    <span style='color:#db2082;font-size: 24px;font-family: "Frankfurter";'><strong><?php echo $poin;?> Poin</strong></span> Keluarga Lavie
                </h1>
                <h1 style='text-align:left;'>
                    Total Poin anda<span style='color:#db2082;font-size: 24px;font-family: "Frankfurter";'> <strong><?php echo $customerpoin;?> Poin</strong></span>
                </h1>
                <!-- <h1 style='text-align:left;'>
                    <span style='color:#db2082;font-size: 24px;font-family: "Frankfurter";'><strong><?php echo $kupon;?> Kupon</strong></span> undian kejutan THR
                </h1> -->
                <?php if(isset($_SESSION['hadiah'])){ ?>
                    <h1 style='text-align:left;'>
                        <span style='color:#db2082;font-size: 24px;font-family: "Frankfurter";'><strong><?php echo $_SESSION['hadiah']->reward_list;?></strong></span> hadiah silaturahmi Rezeki Ramadhan
                    </h>
                <?php } ?>
                
                
                <h1 style='text-align:left;'>
                    Sampai ketemu di kunjungan berikutnya
                    <br>
                    jangan lupa kumpulkan poin untuk ditukar hadiah menarik
                </h1>
                <br>
                <div class="flex">
                    <?php
                        for ($i=0; $i < 5; $i++) { 
                    ?>
                    <div class="hadiah-container-terimakasih">
                        <div class="img-container-hadiah-terimakasih">
                            <img claas="img-hadiah-terimakasih" src="<?php echo $daftar_hadiah[$i]->img?>" alt="">
                        </div>
                        <div class="desc-hadiah-terimakasih">
                            <span><?php echo $daftar_hadiah[$i]->namahadiah?></span>
                            <span><?php echo $daftar_hadiah[$i]->poindibutuhkan?> Poin</span>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="form-group">
                    <button type="submit" id="submit" class="form-submit" value="Submit">
                        <a style="text-decoration:none;color:white;" href="<?php echo base_url('/kasir/caripelanggan')?>">Kembali Cari Pelanggan</a>
                    </button>
                    <br/>
                    <br/>
                    <button type="submit" class="form-submit" value="Submit">
                        <a style="text-decoration:none;color:white;" href="<?php echo base_url('/kasir/inputstruk')?>">Ke Halaman Input Struk</a>
                    </button>
                </div>
                    <!-- <h1>Selamat! Poin dari belanjaan hari ini XYZ dan ABC kupon undian!</h1>
                    <h1>Terimakasih</h1> -->
                    <!-- <p class="loginhere">
                        Have already an account ? <a href="#" class="loginhere-link">Login here</a>
                    </p> -->
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?php echo base_url()?>/public/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>/public/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>