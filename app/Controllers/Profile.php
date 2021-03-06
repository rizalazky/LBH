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
        $noHp=session()->get('user_customer')->phone;
        // die($noHp);
        $getFrom = $this->netsuite_models->getCustomer($noHp);
        // $data['promo']=array(
        //     array(
        //         "img"=>"https://via.placeholder.com/600/92c952",
        //         "desc"=>"Promo 1 Description"
        //     ),
        //     array(
        //         "img"=>"https://via.placeholder.com/600/771796",
        //         "desc"=>"Promo 2 Description"
        //     ),
        //     array(
        //         "img"=>"https://via.placeholder.com/600/24f355",
        //         "desc"=>"Promo 3 Description"
        //     ),
        // );
        $idRec =session()->get('user_customer')->internalid;
        $getHistoryReward = $this->netsuite_models->getHistoryReward($idRec);
        // var_dump($getHistoryReward);
        // die;
        $poin=0;
        $kupon=0;
        // var_dump($getHistoryReward);
        foreach ($getHistoryReward as $key) {
            $poin+= $key->poin > 0 ? $key->poin : 0 ;
            $kupon+= $key->totalKupon >0 ? $key->totalKupon : 0;
        }
        $data['poin']=$poin;
        $data['kupon']=$kupon;
        $data['user_customer']=$getFrom;
        $getPromo = $this->netsuite_models->getPromo();
        // var_dump($getPromo);die;
        $data['promo']=$getPromo;
        session()->set('user_customer',$getFrom);
        return view('home',$data);
    }

    public function profile(){
        $noHp=session()->get('user_customer')->phone;
   
        $getFrom = $this->netsuite_models->getCustomer($noHp);
       
        session()->set('user_customer',$getFrom);
        $data['user_customer']=$getFrom;
        
        return view('profile_user',$data);
    }

    public function inputStruck(){
        $session=session();
        $data['action']='profile/inputstruck';
       
        $data['customer']=$session->get('customer');
        if(isset($_POST['submit'])){
            $jmlPembelanjaan=preg_replace('/[^0-9]/', '', $_POST['jmlbelanja']);
            
            $nostruk=$_POST['nostruk'];
            $tgltransaksi=explode("-",$_POST['tgltransaksi']);

            $file = $this->request->getFile('fotostruk');
                     
            if ($file->getError())
            {
                echo "<script>alert('".$file->getErrorString()."');window.location.href='".base_url()."/profile/inputstruck'</script>"; 
            }else{
                $filename = $file->getName();
                $tempfile = $file->getTempName(); 

                $directoryUpload ='public/img/imgstruk/';
                $upload=$file->move($directoryUpload,$session->get('user_customer')->phone.'-'.$filename);
                if($upload){      
                    // tanda 
                    $dt=array(
                        "type"=> "earn_loyalty",
                        "tgl_transaksi"=>$tgltransaksi[1]."/".$tgltransaksi[2]."/".$tgltransaksi[0],
                        "amount_trx"=> $jmlPembelanjaan,
                        "no_struk"=>$nostruk,
                        "img_struk"=> base_url('/'.$directoryUpload.''.$session->get('user_customer')->phone.'-'.$filename),
                        "estimasi_point"=> "",
                        "phone"=> $session->get('user_customer')->phone,
                        "loc_trx"=>"",
                        "item_reward"=>'',
                        "id_customer"=>$session->get('user_customer')->internalid
                    );
                    $postToNS = $this->netsuite_models->postToNetsuite($dt);
                    $object=(array)json_decode($postToNS);
                    if($object[1]->status=='succes'){
                        // return redirect()->to('/profile/inputstruck');
                        echo "<script>alert('Berhasil Disimpan');window.location.href='".base_url()."/profile/inputstruck'</script>";
                    }
                   
                }
            }
        }else{
            return view('inputstruk',$data);
        }
    }

    public function history(){
        $idRec=session()->get('user_customer')->internalid;
        
        $getHistoryReward = $this->netsuite_models->getHistoryReward($idRec);
        // var_dump($getHistoryReward);die;
        // $data['history_reward']=array_reverse((array) $getHistoryReward);
        $data['history_reward']=(array) $getHistoryReward;
   
        return view('history',$data);
    }

    public function daftarhadiah(){
        
        $getAllHadiah = $this->netsuite_models->getAllHadiah();
        // var_dump($getAllHadiah);
        // die;
        $data['daftar_hadiah']=(array) $getAllHadiah;
        // $data['daftar_hadiah']=$daftarHadiah;
        return view('daftar_hadiah',$data);
    }

    public function form_anak($jml)
    {
        if($jml =="" || $jml == 0){
            echo "<script>alert('jumlah anak harus diisi');window.location.href='".base_url('/profile')."'</script>";
        }
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
            return redirect()->to('/profile/form_anak/'.session()->get('user_customer')->jumlahanak);
        }else{
            echo "<script>alert('Gagal Update Data Customer');window.location.href='".base_url('/profile/profile')."'</script>";
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
            return redirect()->to('/profile/profile');
        }else{
            echo "<script>alert('Gagal Update Data Customer');window.location.href='".base_url('/profile/profile')."'</script>";
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
