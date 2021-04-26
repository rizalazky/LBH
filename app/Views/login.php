<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/css/style.css">
</head>

<body>
    <img class="banner" src="<?php echo base_url()?>/public/img/banner.jpeg" alt="">
    <div class="main">
        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            
            <div class="container">
                <div class="signup-content">
                    <form action="<?= base_url('/auth')?> " method="POST" id="signup-form" class="signup-form">
                        <img class="logo" src="<?php echo base_url()?>/public/img/logo.png" alt="">
                        <h2 class="form-title" style='text-align:left;'>Login</h2>
                        <div class="alert">
                            
                        </div>
                        <div class="form-group" style='margin-top:10px;'>
                            <label for="email">No Handphone</label>
                            <input type="text" class="form-input input_number" name="nohp" id="nohp" placeholder="Masukkan No hp" />
                        </div>
                        <div class="form-group" style='margin-top:10px;'>
                            <label for="password">Password</label>
                            <input type="password" class="form-input" name="password" id="notelp" placeholder="Masukkan Password" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Login" />
                            <!-- <a href="<?php echo base_url()?>/resetpassword">reset password</a> -->
                        </div>
                    </form>
                    <p class="loginhere">
                        Belum punya akun ? <a href="<?php echo base_url()?>/pendaftaran" class="loginhere-link">Daftar disini</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?php echo base_url()?>/public/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>/public/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>