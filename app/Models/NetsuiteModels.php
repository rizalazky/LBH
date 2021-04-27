<?php

namespace App\Models;

use CodeIgniter\Model;

class NetsuiteModels extends Model
{
    public function __construct()
    {
        helper('PostToNetsuite');
    }
  
    public function postToCustomer($namadepan, $namabelakang, $email,$noTelp)
    {
        $data=array(
            "type"=> "create_user",
            "record"=> "customer",
            "first_name"=>$namadepan,
            "last_name"=>$namabelakang,
            "get_email"=> $email,
            "get_phone"=> $noTelp,
            "company_name"=>$namadepan ." ".$namabelakang
        );   
        $send=sendOrderToNS($data);
        return $send;
    }

  

    public function postToNetsuite($data){
        return sendOrderToNS($data);
    }

    public function getCustomer($phone){
        // $data=array(
        //     "phone_number"=>$phone
        // );
        return getCustomer($phone);
    }

    public function getHadiah($location){
        $array=getHadiah($location);
        return $array;
    }

    public function getAllLocation(){
        return getAllLocation();
    }

    public function getPromo(){
        return getPromo();
    }


    public function getDetailAnak($idRec){
        return getDetailAnak($idRec);
    }

    public function getHistoryReward($idRec){
        return getHistoryReward($idRec);
    }


}
