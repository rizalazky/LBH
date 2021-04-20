<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pendaftaran</title>

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
            <button class='btn-logout'><a href="<?php echo base_url()?>/kasir/logout">Logout</a></button>
            <div class="container">
                <div class="signup-content">
                    <form action="<?php echo base_url()."/".$action?>" method="POST" id="signup-form" class="signup-form">
                        <img class="logo" src="<?php echo base_url()?>/public/img/logo.png" alt="">
                        <h2 class="form-title">Form Pendaftaran</h2>
                        <div class="alert">
                            
                        </div>
                        <!-- <div class="form-group">
                            <label for="nama">Nama Depan:</label>
                            <input type="text" class="form-input input_textOnly" data-nama='Nama Depan' name="namadepan" id="namadepan" placeholder="Masukkan nama depan" />
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Belakang:</label>
                            <input type="text" class="form-input input_textOnly" data-nama='Nama Belakang' name="namabelakang" id="namabelakang" placeholder="Masukkan nama belakang" />
                        </div> -->
                        <div class="form-group">
                            <label for="nama">Nama Lengkap:</label>
                            <input type="text" class="form-input input_textOnly" data-nama='Nama Lengkap' name="namalengkap" id="namalengkap" placeholder="Masukkan nama lengkap" />
                        </div>
                        <div class="form-group">
                            <label for="nama">Email:</label>
                            <input type="text" class="form-input" name="email" id="email" placeholder="Masukkan Email" />
                        </div>
                        <div class="form-group">
                            <label for="nama">No Telp:</label>
                            <input type="text" class="form-input input_number" name="notelp" data-nama='Nomor Telp' id="notelp" placeholder="Masukkan no telp" value="<?php echo $_SESSION['nohp'];?>" />
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <input type="submit" id='submit' name="submit" id="submit" class="form-submit" value="Daftar" />
                        </div>
                        <div class="form-group">
                        <button type="submit" id="submit" class="form-submit" value="Submit">
                            <a style="text-decoration:none;color:white;" href="<?php echo base_url('/kasir/caripelanggan')?>">Kembali Cari Pelanggan</a>
                        </button>
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
    <script>
        
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>