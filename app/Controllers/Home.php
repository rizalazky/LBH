<?php

namespace App\Controllers;
use App\Models\NetsuiteModels;

class Home extends BaseController
{

	protected $netsuite_models;

    public function __construct()
    {
        $this->netsuite_models = new NetsuiteModels();
        helper('form');
    }
	public function index()
	{
		return view('company_profile');
	}

	public function login(){
		session()->set('nohp','');
		return view('login');
	}

	public function auth(){
		$noHp=$_POST['nohp'];
		$password=$_POST['password'];
		$getFrom = $this->netsuite_models->getCustomer($noHp);
		// var_dump($getFrom);die;
		if($getFrom->value =='found'){
			if($getFrom->password == $password){
				$date=strtotime($getFrom->tanggallahir);
				$newFormat =date('m/d/Y',$date);
				$getFrom->tanggallahir =$newFormat;
				session()->set('user_customer',$getFrom);
				return redirect()->to('/profile');
			}else{
				echo "<script>alert('Password Salah !!');window.location.href='".base_url('/login')."'</script>";	
			}
		}else{
			// $_SESSION['nohp'] = $noHp;
			session()->set('nohp',$noHp);
			echo "<script>alert('Customer dengan No hp tersebut tidak ditemukan !!');window.location.href='".base_url('/pendaftaran')."'</script>";
		}
	}

	

	public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
