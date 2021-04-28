<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Input Struk</title>

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
                    <form action="<?php echo base_url()."/".$action?>" method="POST" id="signup-form" class="signup-form" enctype="multipart/form-data">
                        <img class="logo" src="<?php echo base_url()?>/public/img/logo.png" alt="">
                        <h2 class="form-title" >Input struk</h2>
                        <h1 style='text-align:center;'>
                            Selamat Datang Kembali <br><span style='color:#db2082;font-size: 24px;font-family: "Frankfurter";'><strong><?php echo $customer->companyname? $customer->companyname: $customer->phone;?></strong></span>  
                         </h1>
                         <div class="alert">
                            
                        </div>
                        <!-- <div class="form-group">
                            <label for="nama">No Telpon:</label>
                            <input type="text" class="form-input" name="notelp" id="notelp" placeholder="Masukkan nomor telpon" />
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-input" name="nama" id="nama" placeholder="Masukkan nama" disabled/>
                        </div> -->
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
    <script>

    // let tanggalFull=new Date();
    // let hari =tanggalFull.getDate();
    // let bulan= tanggalFull.getMonth()+1;
    // let tahun = tanggalFull.getFullYear();
    // console.log(`${hari}/${bulan}/${tahun}`);


    document.getElementById('tgltransaksi').valueAsDate = new Date();


    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>