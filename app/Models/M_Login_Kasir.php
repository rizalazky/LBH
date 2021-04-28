<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Login_Kasir extends Model
{
    public function __construct()
    {
        helper('PostToNetsuite');
    }
    
    public function login($username,$password,$location){
        $cek=login_multi_loc($username,$password,$location);
        return $cek;
    }


}
