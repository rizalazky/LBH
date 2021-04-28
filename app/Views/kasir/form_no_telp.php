<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/css/style.css">
</head>

<body style="background-image: url('<?php echo base_url()?>/public/img/banner.jpeg');background-size: cover;min-height: 99vh;">

    <!-- <img class="banner" src="<?php echo base_url()?>/public/img/banner.jpeg" alt=""> -->
    <div class="main">
        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <button class='btn-logout'><a href="<?php echo base_url()?>/kasir/logout">Logout</a></button>
            <div class="container">
                <div class="signup-content">
                    <form action="<?php echo base_url('/kasir')?>" method="POST" id="signup-form" class="signup-form">
                        <img class="logo" src="<?php echo base_url()?>/public/img/logo.png" alt="">
                        <h2 class="form-title" style='text-align:left;'>Cari Pelanggan</h2>
                        <div class="alert">
                            
                        </div>
                        <div class="form-group" style='margin-top:10px;'>
                            <input type="text" class="form-input input_number" name="noTelp" id="notelp" placeholder="Masukkan nomor telpon" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Submit" />
                        </div>
                    </form>
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