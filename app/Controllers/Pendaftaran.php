<?php

namespace App\Controllers;

use App\Models\NetsuiteModels;
use Error;
use PhpParser\Node\Stmt\Echo_;

class Pendaftaran extends BaseController
{
    // public function console_log($data)
    // {
    //     $output = $data;
    //     if (is_array($output))
    //         $output = implode(',', $output);

    //     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    // }

    protected $netsuite_models;

    public function __construct()
    {
        $this->netsuite_models = new NetsuiteModels();
        helper('form');
    }
    public function index()
    {
        return view('pendaftaran');
    }
    
    public function register()
    {
        if (isset($_POST['submit'])) {
            $namalengkap=isset($_POST['namalengkap']) ? $_POST['namalengkap'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $nohp = isset($_POST['notelp']) ? $_POST['notelp'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $password2 = isset($_POST['ulangpassword']) ? $_POST['ulangpassword'] : '';
        
            if($password == $password2){
                $data=array(
                    "type"=> "register_customer",
                    "record"=> "customer",
                    "get_email"=> $email,
                    "get_phone"=> $nohp,
                    "company_name"=>$namalengkap,
                    "password"=>$password
                ); 

                // var_dump($data);
                // die;
    
                if ($namalengkap !== '' && $nohp) {
                    $postTo = $this->netsuite_models->postToNetsuite($data);
                    $postTo = json_decode($postTo); 
                    // var_dump($postTo);
                    // die;
                    if($postTo->status == "succes"){
                        // $data=array(
                        //     "companyname"=>$namalengkap,
                        //     "email"=>$email,
                        //     "phone"=>$nohp,
                        //     "internalid"=>$balikan->record_id,
                        // );
                        // // $getFrom = $this->netsuite_models->getCustomer($noHp);
                        
                        // session()->set('user_customer',$data);
                        return redirect()->to('/login');
                    }else{
                        die('Error');
                    }
                } else {
                    echo "<script>alert('Nama Lengkap dan Nomer Handphone harap Diisi');window.location.href='".base_url('/pendaftaran')."'</script>";
                }
            }else{
                echo "<script>alert('Kombinasi Password Tidak Cocok');window.location.href='".base_url('/pendaftaran')."'</script>";	
            }
            
            
        } else {
            echo view('pendaftaran ', $data);
        }
    }
}
