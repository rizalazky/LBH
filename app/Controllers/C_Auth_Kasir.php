<?php

namespace App\Controllers;

use App\Models\M_Login_Kasir;
use App\Models\NetsuiteModels;
use Error;
use PhpParser\Node\Stmt\Echo_;


class C_Auth_Kasir extends BaseController
{
    protected $M_Login;
    protected $netsuite_models;

    public function __construct()
    {
        $this->netsuite_models = new NetsuiteModels();
        $this->M_Login = new M_Login_Kasir();
        helper('form');
    }

    public function index(){
        $getAllLocation = $this->netsuite_models->getAllLocation();
        
        $data['dataLocation']=$getAllLocation;
        // die(var_dump($getAllLocation));
        return view('kasir/login',$data);
    }

    public function auth()
    {
        $session = session();

        $getAllLocation = $this->netsuite_models->getAllLocation();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $location = $this->request->getVar('location');
        $lokasiId =$location;
        foreach ($getAllLocation as $dt) {
            if($dt->location == $location){
                $lokasiId =$dt->id;       
            }
        }
        $data = $this->M_Login->login($username,$password,$location);
        // var_dump($data);
        if($data->username){
            $ses_data = [
                'email'       => '',
                'username'    => $username,
                'logged_in'   => TRUE,
                'location'    =>$location,
                'location_id' =>$lokasiId
            ];
            $data->location_id=$lokasiId;
            // var_dump($data);
            // die;
            $session->set('user',$data);
            return redirect()->to('/kasir');
        }else{
            // die(var_dump($data));
            echo "<script>alert('Kombinasi Username,password dan lokasi tidak ditemukan');window.location.href='".base_url()."/kasir/login'</script>";
            $session->setFlashdata('msg', 'Email not Found');
            // return redirect()->to('/kasir/login');
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/kasir/login');
    }
    
}
