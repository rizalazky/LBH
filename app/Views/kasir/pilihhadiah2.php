<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pilih Hadiah</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url()?>/public/css/stylehadiahpage.css">
</head>

<body>
       
            <div class="container__hadiah">
                <div class="header__hadiah">
                    <button class='btn-logout'><a href="<?php echo base_url()?>/kasir/logout">Logout</a></button>
                    <img class="logo" src="<?php echo base_url()?>/public/img/logo-text.PNG" alt="">
                    <h1 class='header__text'>Pilih Hadiah</h1>
                </div>
                <div class="row__hadiah">
                
                <?php 
                
                if(gettype($dataHadiah)=='array') { for ($i=0; $i < count($dataHadiah); $i++){ ?>
                    <a href='<?php echo base_url('/kasir/pilihhadiah?hadiah='.$dataHadiah[$i]->id)?>' class="hadiah__card">
                        <img src="<?php echo $dataHadiah[$i]->detail->image_url;?>" alt="<?php echo $dataHadiah[$i]->reward_list;?>" class="hadiah__card_img">
                        <div class="hadiah__card__desc">
                            
                            <h4 class='judul_text'><?php echo $dataHadiah[$i]->reward_list;?></h4>
                            <!-- <p class='desc_text'><?php echo $dataHadiah[$i]->id;?></p> -->
                        </div>
                    </a>
                <?php } }?>
                </div>
            </div>


    <!-- JS -->
    <script src="<?php echo base_url()?>/public/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>/public/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>