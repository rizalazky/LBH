<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pendaftaran</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url()?>/publicfonts/material-icon/css/material-design-iconic-font.min.css">

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
                    <form action="<?php echo base_url()?>/pendaftaran/register" method="POST" id="signup-form" class="signup-form">
                        <img class="logo" src="/img/logo.png" alt="">
                        <h2 class="form-title">Form Pendaftaran</h2>
                        <div class="alert">
                            
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-input input_textOnly" name="namalengkap" id="namalengkap" placeholder="Masukkan nama lengkap" />
                        </div>
                        <div class="form-group">
                            <label for="nama">Email:</label>
                            <input type="email" class="form-input" name="email" id="email" placeholder="Masukkan Email" />
                        </div>
                        <div class="form-group">
                            <label for="nama">No Telp:</label>
                            <input type="text" class="form-input" name="notelp" id="notelp" placeholder="Masukkan no telp"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Password:</label>
                            <input type="password" class="form-input" name="password" id="password" placeholder="Masukkan Password"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Ketik Ulang Password:</label>
                            <input type="password" class="form-input" name="ulangpassword" id="ulangpassword" placeholder="Masukkan Ulang Password"/>
                        </div>
           
                        <div class="form-group">
                            <input type="submit" id='submit' name="submit" id="submit" class="form-submit" value="Daftar"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Sudah punya Akun ? <a href="<?php echo base_url()?>/login" class="loginhere-link">Login disini</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?php echo base_url()?>/public/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>/public/js/main.js"></script>
    <script>
        
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>