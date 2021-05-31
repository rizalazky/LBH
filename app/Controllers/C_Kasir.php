<?php

namespace App\Controllers;
// CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NetsuiteModels;
use Error;
use PhpParser\Node\Stmt\Echo_;


class C_Kasir extends BaseController
{
    protected $netsuite_models;

    public function __construct()
    {
        $this->netsuite_models = new NetsuiteModels();
        helper('form');
    }


    
	public function index()
	{
        $session=session();
        
        $session->remove('customer');
        $session->remove('hadiah');
        $session->remove('earn_loyalty');
        if(isset($_POST['submit'])){
            $noHp=$_POST['noTelp'];
            $getFrom = $this->netsuite_models->getCustomer($noHp);
            // var_dump($getFrom);
            // die;
            if($getFrom->value =='found'){
                $session->set('customer',$getFrom);
                return redirect()->to('/kasir/inputstruk');
            }else{
                $_SESSION['nohp'] = $noHp;
                return redirect()->to('/kasir/pendaftaran');
            }
        }else{
            return view('kasir/form_no_telp');
        }
	}

    public function pendaftaran(){
        $data = [];
        $session=session();
        if (isset($_POST['submit'])) {
            
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $noTelp = isset($_POST['notelp']) ? $_POST['notelp'] : '';
            $namalengkap=isset($_POST['namalengkap']) ? $_POST['namalengkap'] : '';

            if($namalengkap !='' &&  $noTelp !=''){
                $data=array(
                    "type"=> "create_user",
                    "record"=> "customer",
                    "first_name"=>"",
                    "last_name"=>"",
                    "get_email"=> $email,
                    "get_phone"=> $noTelp,
                    "company_name"=>$namalengkap
                ); 
                $postTo = $this->netsuite_models->postToNetsuite($data);
                $balikan=json_decode($postTo);
                // var_dump($balikan);
                // die;
                if($balikan->status =='succes'){
                    $dataSess=array(
                        "companyname"=>$namalengkap,
                        "phone"=>$noTelp,
                        "email"=>$email,
                        "internalid"=>$balikan->record_id,
                    );
                    $toObject=json_decode(json_encode($dataSess),false);
                   
                    $session->set('customer',$toObject);
                    return redirect()->to('/kasir/inputstruk');
                }else{
                    echo $balikan->status;
                    
                    echo '<script>alert("'.$balikan->message.'")</script>';
                    $data['action']='kasir/pendaftaran';
                    return view('kasir/pendaftaran',$data);
                   
                }
            }else{
               
                echo '<script>alert("Harap Mengisi semua Inputan")</script>';
                return view('kasir/pendaftaran', $data);
                
            }
            
        } else {
            // GET METHOD
            $data['action']='kasir/pendaftaran';
            return view('kasir/pendaftaran',$data);
        }
    }


    public function inputStruck(){
        $session=session();
        $data['action']='kasir/inputstruk';
       
        $data['customer']=$session->get('customer');
        if(isset($_POST['submit'])){
            $jmlPembelanjaan=preg_replace('/[^0-9]/', '', $_POST['jmlbelanja']);
            // echo $session->get('user')->location;
            // die;
            $nostruk=$_POST['nostruk'];
            $tgltransaksi=explode("-",$_POST['tgltransaksi']);
            
            $file = $this->request->getFile('fotostruk');
                     
            if ($file->getError())
            {
                echo "<script>alert('".$file->getErrorString()."');window.location.href='".base_url()."/kasir/inputstruk'</script>"; 
            }else{
                $filename = $file->getName();
                $tempfile = $file->getTempName(); 

                $directoryUpload ='public/img/imgstruk/';
                $upload=$file->move($directoryUpload,$session->get('customer')->phone.'-'.$filename);
                if($upload){      
                    // tanda 
                    $dt=array(
                        "type"=> "earn_loyalty",
                        "tgl_transaksi"=>$tgltransaksi[1]."/".$tgltransaksi[2]."/".$tgltransaksi[0],
                        "amount_trx"=> $jmlPembelanjaan,
                        "no_struk"=>$nostruk,
                        "img_struk"=> base_url('/'.$directoryUpload.''.$session->get('customer')->phone.'-'.$filename),
                        "estimasi_point"=> "",
                        "phone"=> $session->get('customer')->phone,
                        "loc_trx"=>$session->get('user')->location,
                        "item_reward"=>'',
                        "id_customer"=>$session->get('customer')->internalid
                    );
                    // die(var_dump($dt));
                    if($jmlPembelanjaan >= 500000 || $session->get('user')->location == 13){
                        $session->set('input_struck_form',$dt);
                        return redirect()->to('/kasir/pilihhadiah');
                    }else{
                        $postToNS = $this->netsuite_models->postToNetsuite($dt);
                        $object=(array)json_decode($postToNS);
                        
                     
                        $object[1]->poin =floor($object[1]->poin);
                        $session->set('earn_loyalty',$object[1]);
                        if($object[1]->status=='succes'){
                            return redirect()->to('/kasir/terimakasih');
                        }
                    }
                }
            }
        }else{
           
            return view('kasir/inputstruk',$data);
        }
    }

    public function redeempost(){
        $session=session();
        $data=$this->request->getVar('data');
        
            $tgltransaksi=date('m/d/Y');
            $fail=false;
            for($i=0;$i<count($data);$i++){
                $poinDibutuhkan=$data[$i]->poinitem;
                $id=$data[$i]->id;
                $dt=array(
                    "type"=> "post_loyalty",
                    "tgl_transaksi"=>$tgltransaksi,
                    "amount_trx"=> 0,
                    "no_struk"=>'',
                    "estimasi_point"=> "",
                    "loc_trx"=>$session->get('user')->location,
                    "item_reward"=>$id,
                    "id_customer"=>$session->get('customer')->internalid,
                    "poin"=>$poinDibutuhkan,
                    "status"=>3
                 );
                
                $postToNS = $this->netsuite_models->postToNetsuite($dt);
                $object=(array)json_decode($postToNS);
                
                if($object && $object['status'] != 'succes'){
                    $fail=true;   
                }
                
            }
            if($fail==true){
                // echo "<script>alert('redeem Berhasil Sipp !!');window.location.href='".base_url()."/kasir/redeem'</script>"; 
                $response=array(
                    "status"=>"FAIL",
                    "msg"=>"gagal upload ke netsuite"
                );
                echo json_encode($response);
            }else{
                $response=array(
                    "status"=>"OKE",
                    "msg"=>"Berhasil Upload Ke Netsuite"
                );
                echo json_encode($response);

            }      
   }

   public function inputpoin(){
    $session=session();
    $poin=$this->request->getVar('poin');
    
        $tgltransaksi=date('m/d/Y');
        $fail=false;
        $dt=array(
            "type"=> "post_loyalty",
            "tgl_transaksi"=>$tgltransaksi,
            "amount_trx"=> 0,
            "no_struk"=>'',
            "estimasi_point"=> "",
            "loc_trx"=>$session->get('user')->location,
            "item_reward"=>"",
            "id_customer"=>$session->get('customer')->internalid,
            "poin"=>$poin,
            "status"=>2
        );
        
        $postToNS = $this->netsuite_models->postToNetsuite($dt);
        $object=(array)json_decode($postToNS);
        
        if($object && $object['status'] == 'succes'){
            echo "<script>alert('Input Poin ".$session->get('customer')->companyname." Sebesar ".$poin." poin berhasil!');window.location.href='".base_url()."/kasir/redeem'</script>"; 
        }else{
            die("Error".$postToNS);
        }      
}


    public function redeem(){
        $session=session();
        
        
            $getAllHadiah = $this->netsuite_models->getAllHadiah();
                
                $idRec =session()->get('customer')->internalid;
                $getHistoryReward = $this->netsuite_models->getHistoryReward($idRec);
               
                $poin=0;
                $kupon=0;
                if($getHistoryReward){
                    foreach ($getHistoryReward as $key) {
                        $po=$key->poin;
                        if($key->status == "Earned"){
                            $poin+= $po;
                        }else if($key->status == "Burn"){
                            $poin=$poin - $po;
                        }
                        
                    }
                }
                $getHadiahToArray=(array) $getAllHadiah;
                // var_dump($getHadiahToArray);
                // echo "<br />";
                $data['customerpoin'] = $poin;
                usort($getHadiahToArray,function($first,$second){
                    return $first->poindibutuhkan < $second->poindibutuhkan;
                });
                $data['daftar_hadiah']=$getHadiahToArray;
                // die(var_dump($getHadiahToArray));
                // die(var_dump($data['daftar_hadiah']));
                return view('kasir/redeem',$data);
        
    }

    public function pilihhadiah(){
        $session=session();
        $lokasi=$session->get('user')->location;
        $data['dataHadiah'] = $this->netsuite_models->getHadiah($lokasi);
        
        if(!empty($_GET['hadiah'])){
            // die(gettype(date('m/d/Y')));
            // post input struk
            $datainputStruk=$session->get('input_struck_form');
            $datainputStruk['item_reward']=$_GET['hadiah'];
          
            $postToNS = $this->netsuite_models->postToNetsuite($datainputStruk);
            $object=(array)json_decode($postToNS);
            // var_dump($datainputStruk);
            // var_dump($object);
            // die;
            $datepost=$datainputStruk['tgl_transaksi'];
          
            // $datepost= $datapost ? $datapost[1]."/".$datapost[0]."/".$datapost[2]:date('m/d/y');
            $id_earn=$object[1]->record_id;
            $id_history=$object[2]->record_id;
            $object[1]->poin =floor($object[1]->poin);
            
            $session->set('earn_loyalty',$object[1]);

            $dt=array(
                    "type"=> "post_reward",
                    "id_customer"=> $session->get('customer')->internalid,
                    "date_post"=> $datepost,
                    "posting_period"=> "",
                    "id_reward"=> $_GET['hadiah'],
                    "location_id"=> $session->get('user')->location,
                    "id_earn"=>$id_earn,
                    "id_history"=>$id_history
            );
            $postHadiah=$this->netsuite_models->postToNetsuite($dt);
            // var_dump($session->get('user')->location);
            // die($postHadiah);
            if($data['dataHadiah']){
                foreach ($data['dataHadiah'] as $key) {
                    if($key->id==$_GET['hadiah'] ){
                        $session->set('hadiah',$key);
                    }
                }  
            }
            return redirect()->to('/kasir/terimakasih');
        }else{
            return view('kasir/pilihhadiah2',$data);
        }
    }

    public function terimakasih(){
        // $session=session();
        // $data['earn_loyalty']=$session->get('earn_loyalty');
        // die(var_dump($data));
        return view('kasir/terimakasih');
    }
    
}
