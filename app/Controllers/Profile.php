<?php

namespace App\Controllers;

use App\Models\NetsuiteModels;
use Error;
use PhpParser\Node\Stmt\Echo_;

class Profile extends BaseController
{

    protected $netsuite_models;

    public function __construct()
    {
        $this->netsuite_models = new NetsuiteModels();
        helper('form');
    }

    public function index()
    {
        // var_dump(session()->get());die;
        $noHp=session()->get('user_customer')->phone;
        $getFrom = $this->netsuite_models->getCustomer($noHp);
        $idRec=$getFrom->internalid;
        
        $getHistoryReward = $this->netsuite_models->getHistoryReward($idRec);
        // $getHistoryReward->hadiah;
        // die;
        // var_dump($getHistoryReward);die;
        $data['history_reward']=(array) $getHistoryReward;
        // var_dump($data['history_reward']);
        // die;
        $data['user_customer']=$getFrom;

        
        return view('profile_user',$data);
    }

    public function form_anak()
    {
        $noHp=session()->get('user_customer')->phone;
        $getFrom = $this->netsuite_models->getCustomer($noHp);
        $data['user_customer']=$getFrom;
        $idRec=$getFrom->internalid;
        $getDetailAnak=$this->netsuite_models->getDetailAnak($idRec);
       
        $data['detail_data_anak']=$getDetailAnak;
        // var_dump($data['detail_data_anak'][3]);
        // die;
        return view('form_anak',$data);
    }

    public function save_anak(){
        $id=$_POST['id'];
        $namaanak=$_POST['namaanak'];
        $gender=$_POST['jeniskelamin'];
        
        $date=explode("-",$_POST['tgllahir']);
        $tanggallahir = $date[1] .'/'.$date[2].'/'.$date[0];

        $data=array(
            "type"=> "save_detail_anak",
            "id_customer"=>session()->get('user_customer')->internalid,
            "id_anak"=>$id,
            "nama_anak"=>$namaanak,
            "tanggal_lahir"=>$tanggallahir,
            "gender_anak"=>$gender
        );

        $postTo = $this->netsuite_models->postToNetsuite($data);
        $results =json_decode($postTo);             
       
        if($results->status=="succes"){
            return redirect()->to('/profile/form_anak');
        }else{
            echo "<script>alert('Gagal Update Data Customer');window.location.href='".base_url('/profile')."'</script>";
        }
    }

    public function save(){
        $namalengkap = $_POST['namalengkap'];
        $email = $_POST['email'];
        $notelp = $_POST['notelp'];
        
        $alamat = $_POST['alamat'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $tiktok = $_POST['tiktok'];
        $whatsapp = $_POST['whatsapp'];
        $jumlahanak = $_POST['jumlahanak'];
        $id=session()->get('user_customer')->internalid;

        $date=explode("-",$_POST['tgllahir']);
        $tanggallahir = $date[1] .'/'.$date[2].'/'.$date[0];
        // die($tanggallahir);

        $data=array(
            "type"=> "edit_customer",
            "id_customer"=>$id,
            "get_email"=>$email,
            "phone"=>$notelp,
            "company_name"=>$namalengkap,
            "tanggallahir"=>$tanggallahir,
            "facebook"=>$facebook,
            "tiktok"=>$tiktok,
            "whatsapp"=>$whatsapp,
            "instagram"=>$instagram,
            "jumlahanak"=>$jumlahanak,
            "alamat"=>$alamat,
            "record"=>"customer",
        );
        $postTo = $this->netsuite_models->postToNetsuite($data);
        $results =json_decode($postTo);             
        // echo $results ->status;
        // var_dump($results);
        // die;
        if($results->status=="succes"){
            // session()->set('user_customer',$data);
            return redirect()->to('/profile');
        }else{
            echo "<script>alert('Gagal Update Data Customer');window.location.href='".base_url('/profile')."'</script>";
        }
    }

    public function post_profile()
    {
        if (isset($_POST['submit'])) {
            $length_nama_anak = count($_POST['namaanak']);
            $firstname = isset($_POST['namadepan']) ? $_POST['namadepan'] : '';
            $lastname = isset($_POST['namabelakang']) ? $_POST['namabelakang'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';

            $dataTemp = array();
            for ($i = 0; $i < $length_nama_anak; $i++) {
                $nama_anak_arr = $_POST['namaanak'][$i];
                array_push($dataTemp, $nama_anak_arr);
            }

            if ($firstname !== '' && $lastname='' && $email='' && $length_nama_anak) {
                $postTo = $this->netsuite_models->postToCustomer($firstname, $lastname, $email);
            } else {
                echo $firstname;
                die('error');
            }
            return redirect()->to('/');
        } else {
            echo view('profile_user');
        }
    }
}
