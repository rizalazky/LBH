<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Detail Data Anak</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url('/public')?>/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url('/public')?>/css/detail_anakpage.css">
</head>

<body>

    <!-- <img class="banner" src="<?php echo base_url('/public')?>/img/banner.jpeg" alt=""> -->
    <div class="main">
            <div class="header">
                <img class="logo" src="<?php echo base_url() ?>/public/img/logo.png" alt="">
                <div class="navigation">
                    <a class="btn" style='text-decoration:none;' href="<?php echo base_url()?>/logout">Logout</a>
                </div>
            </div>
            <div class="container">
                <a class="btn" style='text-decoration:none;' href="<?php echo base_url()?>/profile/">Back</a>
                <!-- <button type="button" name="add" id="add" class="btn btn-success">Tambah</button> -->
                <div id="dynamic_field">
                    <?php 
                    if($user_customer->jumlahanak){
                        for($i=0 ;$i<$user_customer->jumlahanak;$i++) {
                    ?>
                        <div class="form">
                            <!-- <button class="btn_remove">x</button> -->
                            <form  method="POST" action="<?php echo base_url()?>/profile/save_anak">
                                <div class="signup-content">
                                    <h2 class="form-title">Detail Anak</h2>
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
                                            if($detail_data_anak[$i]){
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
    <script src="<?php echo base_url('/public')?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('/public')?>/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<script>
    $(document).ready(function() {
        var i = 2;
        $('#add').click(function() {
            let htmlForm=`
            <div class="form" id="form_${i}">
                        <button class="btn_remove" id="${i}">x</button>
                        <form  method="POST" action="<?php echo base_url()?>/profile/detail_anak/save">
                            <div class="signup-content">
                                <h2 class="form-title">Detail Anak</h2>
                                    <div class="form-group">
                                        <label for="nama">Nama Anak: ${i}</label>
                                        <input type="text" class="form-input" name="namaanak[]" id="namaanak" placeholder="Masukkan nama anak" />
                                        <label for="nama">Tgl Lahir:</label>
                                        <input type="date" class="form-input" name="tgllahir[]" id="tgllahir" placeholder="Masukkan tanggal lahir anak" />
                                        <label for="nama">Jenis Kelamin:</label>
                                        <select name="jeniskelamin" class="form-input" id="">
                                            <option value="1">Laki-Laki</option>
                                            <option value="2">Perempuan</option>
                                        </select>
                                        <input type="submit" name="submit" id="submit" class="form-submit" value="Save" />
                                    </div>
                                <!-- <button type="button" name="add" id="add" class="btn btn-success">Save</button> -->
                            </div>
                        </form>
                    </div>
            `;
            let formLama='<div class="addData" id="rowData' + i + '"> <div class="form-group">     <label for="nama">Nama Anak : ' + i + '</label>    <input type="text" class="form-input" name="namaanak[]" id="namaanak" placeholder="Masukkan nama anak" /></div><div class="form-group">    <label for="nama">Tgl Lahir:</label>    <input type="text" class="form-input" name="tgllahir[]" id="tgllahir" placeholder="Masukkan tanggal lahir anak" /></div><div class="form-group">    <label for="nama">Jenis Kelamin:</label>    <input type="text" class="form-input" name="notelp[]" id="notelp" placeholder="Masukkan jenis kelamin anak" /></div><button name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></div> '
            i++;
            $('#dynamic_field').append(htmlForm);
        });
        $(document).on('click', '.btn_remove', function(e) {
            var button_id = $(this).attr('id');
            // console.log("MASUK : " + button_id)
            console.log(e)
            $('#form_' + button_id + '').remove();
            i--;
        });
    })
</script>