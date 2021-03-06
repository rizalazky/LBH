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
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/css/profile_user.css">
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
            <form action="<?php echo base_url()."/".$action?>" method="POST" id="signup-form" class="form" enctype="multipart/form-data">
                        <h2 class="form-title" >Input struk</h2>
                         <div class="alert">
                            
                        </div>
                        <div class="form-group">
                            <label for="nama">Jumlah Pembelanjaan:</label>
                            <input type="text" class="form-input" name="jmlbelanja" id="jmlbelanja" placeholder="Masukkan jumlah belanja" />
                        </div>
                        <div class="form-group">
                            <label for="nama">No Struk:</label>
                            <input type="text" class="form-input" name="nostruk" id="nostruk" placeholder="Masukkan no struk" />
                        </div>
                        <div class="form-group">
                            <label for="nama">Foto Struk:</label>
                            <input type="file" class="form-input" name="fotostruk" id="fotostruk" placeholder="Upload Foto Struk" />
                        </div>
                        <div class="form-group">
                            <label for="nama">Tanggal Transaksi:</label>
                            <input type="date" class="form-input" name="tgltransaksi" id="tgltransaksi" placeholder="Masukkan tgl transaksi" />
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="btn-profile" value="Submit" />
                        </div>
                    </form>
            </div> 
        </div>
    </div>
    <!-- JS -->
    <script src="<?php echo base_url() ?>/public/vendor/jquery/jquery.min.js"></script>
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

      document.getElementById('tgltransaksi').valueAsDate = new Date();
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>