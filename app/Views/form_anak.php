<?php

session_start()

?>

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
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>/public/css/homeuser.css"> -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>/public/css/profile_user.css"> -->
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url('/public')?>/css/detail_anakpage.css">
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
                <a class="btn-back" style='text-decoration:none;' href="<?php echo base_url()?>/profile/profile">Back</a>
                <div id="dynamic_field">
                    <?php 
                    $urutanArray=array("Pertama","Kedua","Ketiga","Keempat","Kelima","Keenam","Ketujuh","Kedelapan","Kesembilan","kesepuluh");
                    if($user_customer->jumlahanak){
                        for($i=0 ;$i<$user_customer->jumlahanak;$i++) {
                    ?>
                        <div class="form">
                            <!-- <button class="btn_remove">x</button> -->
                            <form  method="POST" action="<?php echo base_url()?>/profile/save_anak">
                                <div class="signup-content">
                                    <h2 class="form-title">Anak <?php echo $urutanArray[$i] ? $urutanArray[$i] : $i ;?></h2>
                                        <div class="form-group">
                                            <input type="hidden" class="form-input" name="id" value="<?php echo isset($detail_data_anak[$i])  ?  $detail_data_anak[$i]->id :  ''?>" id="namaanak" placeholder="Masukkan nama anak" />
                                            <label for="nama">Nama Anak:</label>
                                            <input type="text" class="form-input" name="namaanak" value="<?php echo isset($detail_data_anak[$i]) ? $detail_data_anak[$i]->nama_anak : ''?>" id="namaanak" placeholder="Masukkan nama anak" />
                                            <label for="tgllahir">Tgl Lahir:</label>
                                            <?php 
                                            if(isset($detail_data_anak[$i])){
                                                if($detail_data_anak[$i]->tgl_lahir_anak){
                                                    $dateSplit=explode('/',$detail_data_anak[$i]->tgl_lahir_anak);
                                                    $hari=$dateSplit[0] >9 ? $dateSplit[0] : '0'.$dateSplit[0];
                                                    $bulan=$dateSplit[1] > 9 ?$dateSplit[1]: '0'.$dateSplit[1];
                                                    
                                                    $newFormatDate=$dateSplit[2].'-'.$bulan.'-'.$hari ;
                                                    
                                                    $detail_data_anak[$i]->tgl_lahir_anak=$newFormatDate;
                                                }
                                            }
                                            ?>
                                            <input type="date" class="form-input" name="tgllahir" value="<?php echo isset($detail_data_anak[$i]) ? $detail_data_anak[$i]->tgl_lahir_anak: "" ?>" id="tgllahir" placeholder="Masukkan tanggal lahir anak" />
                                            <label for="jeniskelamin">Jenis Kelamin:</label>
                                            <select name="jeniskelamin" class="form-input" name="jeniskelamin">
                                            <?php
                                            if(isset($detail_data_anak[$i])){
                                                if($detail_data_anak[$i]->gender_anak =="1"){
                                                    ?>
                                                    <option value="1" selected>Laki-Laki</option>
                                                    <option value="2" >Perempuan</option>
                                                    <?php
                                                }else

                                                if($detail_data_anak[$i]->gender_anak =="2"){
                                                    ?>
                                                    <option value="1" >Laki-Laki</option>
                                                    <option value="2" selected>Perempuan</option>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <option value="1" >Laki-Laki</option>
                                                    <option value="2">Perempuan</option>
                                                    <?php
                                                }
                                            }else{
                                                ?>
                                                <option value="1" >Laki-Laki</option>
                                                <option value="2">Perempuan</option>
                                                <?php
                                            }
                                            ?>
                                            </select>
                                            <input type="submit" name="submit" id="submit" class="form-submit" value="Save" />
                                        </div>
                                    <!-- <button type="button" name="add" id="add" class="btn btn-success">Save</button> -->
                                </div>
                            </form>
                        </div>
                    <?php  }} ?>
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
</body>

</html>