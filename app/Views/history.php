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
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
    <style>
        .container-table-history{
            /* opacity:0.2; */
            /* background:none; */
        }
        
    </style>

</head>

<body>
    <!-- <img class="banner" src="<?php echo base_url() ?>/public/img/banner.jpeg" alt=""> -->
    <div class="container-historypage">
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
                <div class='container-table-history'>
                    <table width="100%;" id="table-history" class="table table-striped">
                        <thead >
                                <th >Tanggal</th>
                                <th>Total Belanja</th>
                                <th>Hadiah</th>
                                <th>Poin</th>
                                <th>Kupon</th>
                        </thead>
                        <tbody>
                            <?php
                                for ($i=0; $i <  count($history_reward);$i++) { 
                            ?>
                                <tr>
                                    <td><?php echo $history_reward[$i]->tanggal;?></td>
                                    <td><?php echo $history_reward[$i]->amount;?></td>
                                    <td><?php echo $history_reward[$i]->hadiah;?></td>
                                    <td><?php echo $history_reward[$i]->poin;?></td>
                                    <td><?php echo $history_reward[$i]->totalKupon;?></td>
                                </tr>
                            <?php
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
    <!-- JS -->
    <script src="<?php echo base_url() ?>/public/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>/public/js/main.js"></script>
    <script>
        $(document).ready( function () {
            $('#table-history').DataTable();
        } );
        // document.getElementById('tgllahir').valueAsDate = new Date();
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>