<?php

session_start()

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/css/profile_user.css">
</head>

<body>
    <!-- <img class="banner" src="<?php echo base_url() ?>/public/img/banner.jpeg" alt=""> -->
    <div class="container_profile_user">
        <div class="header">
            <img class="logo" src="<?php echo base_url() ?>/public/img/logo.png" alt="">
            <div class="navigation">
                <a class='btn-profile' style='text-decoration:none;' href="<?php echo base_url()?>/logout">Logout</a>
            </div>
        </div>
        <div class="profile_user">
            <div class="profile_user_left">
                    <form action="<?php echo base_url() ?>/profile/save" method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Profile</h2>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-input" name="namalengkap" id="namalengkap" placeholder="Masukkan Lengkap" value="<?php echo $user_customer->companyname;?>"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Email:</label>
                            <input type="email" class="form-input" name="email" id="email" placeholder="Masukkan Email" value="<?php echo $user_customer->email;?>"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">No Telp:</label>
                            <input type="text" class="form-input" name="notelp" id="notelp" placeholder="Masukkan no telp" value="<?php echo $user_customer->phone;?>"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Tgl Lahir:</label> 
                            <?php 
                                if($user_customer->tanggallahir){
                                    $dateSplit=explode('/',$user_customer->tanggallahir);
                                    $hari=$dateSplit[0] >9 ? $dateSplit[0] : '0'.$dateSplit[0];
                                    $bulan=$dateSplit[1] > 9 ?$dateSplit[1]: '0'.$dateSplit[1];
                                    
                                    $newFormatDate=$dateSplit[2].'-'.$bulan.'-'.$hari ;
                                    
                                    $user_customer->tanggallahir=$newFormatDate;
                                }
                            ?>
                            <input type="date" class="form-input" name="tgllahir" id="tgllahir" placeholder="Masukkan Tgl Lahir" value="<?php echo $user_customer->tanggallahir;?>"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Alamat:</label>
                            <input type="text" class="form-input" name="alamat" id="alamat" placeholder="Masukkan Alamat" value="<?php echo $user_customer->alamat;?>"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Instagram:</label>
                            <input type="text" class="form-input" name="instagram" id="instagram" placeholder="Masukkan instagram" value="<?php echo $user_customer->instagram;?>"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Whatsapp:</label>
                            <input type="text" class="form-input" name="whatsapp" id="whatsapp" placeholder="Masukkan whatsapp" value="<?php echo $user_customer->whatsapp;?>"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Tiktok:</label>
                            <input type="text" class="form-input" name="tiktok" id="tiktok" placeholder="Masukkan tiktok" value="<?php echo $user_customer->tiktok;?>"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Facebook:</label>
                            <input type="text" class="form-input" name="facebook" id="facebook" placeholder="Masukkan facebook" value="<?php echo $user_customer->facebook;?>"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Jumah Anak:</label>
                            <input type="text" class="form-input" name="jumlahanak" id="jumahanak" placeholder="Masukkan Jumah Anak" value="<?php echo $user_customer->jumlahanak;?>"/>
                        </div>
                        <br>
                        <br>
                        <div class="btn-group">
                            <input type="submit" name="next" id="submit" class="btn-profile" value="Save" />
                            <button type="button" class="btn-profile"><a style='color:white;text-decoration:none;' href="<?php echo base_url()?>/profile/form_anak/<?php echo $user_customer->jumlahanak;?>">Next</a></button>
                            <!-- <button class='btn-profile'>
                                
                                Data Anak
                            </button> -->
                        </div>
                    </form>
                    <!-- <p class="loginhere">
                        Have already an account ? <a href="#" class="loginhere-link">Login here</a>
                    </p> -->
            </div>
            <div class="profile_user_right">
                <h2 class="form-title">History Point dan Promo</h2>
                <div class="history_reward">
                    <ul class='history_menu'>
                        <?php
                        if($history_reward){
                            foreach ($history_reward as $his) { 
                        ?>
                                <li class='history_item'>
                                    <button class='history_date'><?php echo $his->tanggal ;?></button>
                                    <ul class='history_desc'>
                                        <li><strong><?php echo $his->amount ;?></strong> Total Belanja</li> 
                                        <li><strong><?php echo $his->hadiah ;?></strong> </br> hadiah silaturahmi Rezeki Ramadhan</li> 
                                        <li><strong><?php echo $his->poin ;?></strong> Poin Keluarga Lavie</li>
                                        <li><strong><?php echo $his->totalKupon ;?></strong> Kupon undian kejutan THR</li> 
                                    </ul>
                                </li>
                        <?php } };?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- JS -->
    <script src="<?php echo base_url() ?>/public/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/public/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>