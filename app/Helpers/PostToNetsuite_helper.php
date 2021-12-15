<?php

define("NETSUITE_URL", 'https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl');
define("NETSUITE_SCRIPT_ID", '11');
define("NETSUITE_DEPLOY_ID", '2');
define("NETSUITE_ACCOUNT", '7131410');
define("NETSUITE_CONSUMER_KEY", '8ce6f98fbb115b67ae34134671bca711eed87b39128f893c507f89fb97d0ad21');
define("NETSUITE_CONSUMER_SECRET", '069fd315a5ac34b90b1df3db58bd29828cbff37f3769f2ec84a76bfb854e59c1');
define("NETSUITE_TOKEN_ID", 'ad5a7b874b3b3f83613152e0ff1235a29500cd5a46d9e8244df050d38a50cf7a');
define("NETSUITE_TOKEN_SECRET", '4adc68eec587aaa3b73b5ff690e24cea81827a964dde5eae6b8f7a19914e20e2');


function sendOrderToNS($details)
{
    $data_string = json_encode($details);

    $oauth_nonce = md5(mt_rand());
    $oauth_timestamp = time();
    $oauth_signature_method = 'HMAC-SHA256';
    $oauth_version = "1.0";

    $base_string =
        "POST&" . urlencode(NETSUITE_URL) . "&" .
        urlencode(
            "deploy=" . NETSUITE_DEPLOY_ID
                . "&oauth_consumer_key=" . NETSUITE_CONSUMER_KEY
                . "&oauth_nonce=" . $oauth_nonce
                . "&oauth_signature_method=" . $oauth_signature_method
                . "&oauth_timestamp=" . $oauth_timestamp
                . "&oauth_token=" . NETSUITE_TOKEN_ID
                . "&oauth_version=" . $oauth_version
                . "&realm=" . NETSUITE_ACCOUNT
                . "&script=" . NETSUITE_SCRIPT_ID
        );
    $sig_string = urlencode(NETSUITE_CONSUMER_SECRET) . '&' . urlencode(NETSUITE_TOKEN_SECRET);
    $signature = base64_encode(hash_hmac("sha256", $base_string, $sig_string, true));

    $auth_header = "OAuth "
        . 'oauth_signature="' . rawurlencode($signature) . '", '
        . 'oauth_version="' . rawurlencode($oauth_version) . '", '
        . 'oauth_nonce="' . rawurlencode($oauth_nonce) . '", '
        . 'oauth_signature_method="' . rawurlencode($oauth_signature_method) . '", '
        . 'oauth_consumer_key="' . rawurlencode(NETSUITE_CONSUMER_KEY) . '", '
        . 'oauth_token="' . rawurlencode(NETSUITE_TOKEN_ID) . '", '
        . 'oauth_timestamp="' . rawurlencode($oauth_timestamp) . '", '
        . 'realm="' . rawurlencode(NETSUITE_ACCOUNT) . '"';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, NETSUITE_URL . '?&script=' . NETSUITE_SCRIPT_ID . '&deploy=' . NETSUITE_DEPLOY_ID . '&realm=' . NETSUITE_ACCOUNT);
    curl_setopt($ch, CURLOPT_POST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: ' . $auth_header,
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string)
    ]);

    $exec=curl_exec($ch);
    curl_close($ch);
    return $exec;
}



function getCustomer($noHp){
    $oauth_nonce = md5(mt_rand());
    $oauth_timestamp = time();
    $oauth_signature_method = 'HMAC-SHA256';
    $oauth_version = "1.0";

    $base_string =
        "GET&" . urlencode(NETSUITE_URL) ."&".
        urlencode(
            "deploy=" . NETSUITE_DEPLOY_ID
                . "&oauth_consumer_key=" . NETSUITE_CONSUMER_KEY
                . "&oauth_nonce=" . $oauth_nonce
                . "&oauth_signature_method=" . $oauth_signature_method
                . "&oauth_timestamp=" . $oauth_timestamp
                . "&oauth_token=" . NETSUITE_TOKEN_ID
                . "&oauth_version=" . $oauth_version
                . "&phone_number=" . $noHp
                . "&record_type=get_customer"
                . "&script=" . NETSUITE_SCRIPT_ID
        );
    
    $sig_string = urlencode(NETSUITE_CONSUMER_SECRET) . '&' . urlencode(NETSUITE_TOKEN_SECRET);
    $signature = base64_encode(hash_hmac("sha256", $base_string, $sig_string, true));

    $header='Authorization: OAuth realm="'. rawurlencode(NETSUITE_ACCOUNT) .'",'
    .'oauth_consumer_key="'. rawurlencode(NETSUITE_CONSUMER_KEY).'",'
    .'oauth_token="'.rawurlencode(NETSUITE_TOKEN_ID).'",'
    .'oauth_signature_method="'.$oauth_signature_method.'",'
    .'oauth_timestamp="'.$oauth_timestamp.'",'
    .'oauth_nonce="'.$oauth_nonce.'",'
    .'oauth_version="'.$oauth_version.'",'
    .'oauth_signature="'.urlencode($signature).'"';

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=11&deploy=2&phone_number='.$noHp.'&record_type=get_customer',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_POSTFIELDS =>'{
        "phone_number": "'.$noHp.'"
    }',
      CURLOPT_HTTPHEADER => array(
        $header,
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);        
}


function getAllLocation(){
    $oauth_nonce = md5(mt_rand());
    $oauth_timestamp = time();
    $oauth_signature_method = 'HMAC-SHA256';
    $oauth_version = "1.0";

    $base_string =
        "GET&" . urlencode(NETSUITE_URL) ."&".
        urlencode(
            "deploy=" . NETSUITE_DEPLOY_ID
                . "&oauth_consumer_key=" . NETSUITE_CONSUMER_KEY
                . "&oauth_nonce=" . $oauth_nonce
                . "&oauth_signature_method=" . $oauth_signature_method
                . "&oauth_timestamp=" . $oauth_timestamp
                . "&oauth_token=" . NETSUITE_TOKEN_ID
                . "&oauth_version=" . $oauth_version
                . "&record_type=masterlocation"
                . "&script=" . NETSUITE_SCRIPT_ID
        );
    
    $sig_string = urlencode(NETSUITE_CONSUMER_SECRET) . '&' . urlencode(NETSUITE_TOKEN_SECRET);
    $signature = base64_encode(hash_hmac("sha256", $base_string, $sig_string, true));

    $header='Authorization: OAuth realm="'. rawurlencode(NETSUITE_ACCOUNT) .'",'
    .'oauth_consumer_key="'. rawurlencode(NETSUITE_CONSUMER_KEY).'",'
    .'oauth_token="'.rawurlencode(NETSUITE_TOKEN_ID).'",'
    .'oauth_signature_method="'.$oauth_signature_method.'",'
    .'oauth_timestamp="'.$oauth_timestamp.'",'
    .'oauth_nonce="'.$oauth_nonce.'",'
    .'oauth_version="'.$oauth_version.'",'
    .'oauth_signature="'.urlencode($signature).'"';

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=11&deploy=2&record_type=masterlocation',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_POSTFIELDS =>'',
      CURLOPT_HTTPHEADER => array(
        $header,
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);        
}

function getPromo(){
  $oauth_nonce = md5(mt_rand());
  $oauth_timestamp = time();
  $oauth_signature_method = 'HMAC-SHA256';
  $oauth_version = "1.0";

  $base_string =
      "GET&" . urlencode(NETSUITE_URL) ."&".
      urlencode(
          "deploy=" . NETSUITE_DEPLOY_ID
              . "&oauth_consumer_key=" . NETSUITE_CONSUMER_KEY
              . "&oauth_nonce=" . $oauth_nonce
              . "&oauth_signature_method=" . $oauth_signature_method
              . "&oauth_timestamp=" . $oauth_timestamp
              . "&oauth_token=" . NETSUITE_TOKEN_ID
              . "&oauth_version=" . $oauth_version
              . "&record_type=get_promo"
              . "&script=" . NETSUITE_SCRIPT_ID
      );
  
  $sig_string = urlencode(NETSUITE_CONSUMER_SECRET) . '&' . urlencode(NETSUITE_TOKEN_SECRET);
  $signature = base64_encode(hash_hmac("sha256", $base_string, $sig_string, true));

  $header='Authorization: OAuth realm="'. rawurlencode(NETSUITE_ACCOUNT) .'",'
  .'oauth_consumer_key="'. rawurlencode(NETSUITE_CONSUMER_KEY).'",'
  .'oauth_token="'.rawurlencode(NETSUITE_TOKEN_ID).'",'
  .'oauth_signature_method="'.$oauth_signature_method.'",'
  .'oauth_timestamp="'.$oauth_timestamp.'",'
  .'oauth_nonce="'.$oauth_nonce.'",'
  .'oauth_version="'.$oauth_version.'",'
  .'oauth_signature="'.urlencode($signature).'"';

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=11&deploy=2&record_type=get_promo',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_POSTFIELDS =>'',
    CURLOPT_HTTPHEADER => array(
      $header,
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  return json_decode($response);        
}

function getAllHadiah($location){
  
  $oauth_nonce = md5(mt_rand());
  $oauth_timestamp = time();
  $oauth_signature_method = 'HMAC-SHA256';
  $oauth_version = "1.0";

  $base_string =
      "GET&" . urlencode(NETSUITE_URL) ."&".
      urlencode(
          "deploy=" . NETSUITE_DEPLOY_ID
              . "&location_req=".$location
              . "&oauth_consumer_key=" . NETSUITE_CONSUMER_KEY
              . "&oauth_nonce=" . $oauth_nonce
              . "&oauth_signature_method=" . $oauth_signature_method
              . "&oauth_timestamp=" . $oauth_timestamp
              . "&oauth_token=" . NETSUITE_TOKEN_ID
              . "&oauth_version=" . $oauth_version
              . "&record_type=get_hadiah"
              . "&script=" . NETSUITE_SCRIPT_ID
      );
  
  $sig_string = urlencode(NETSUITE_CONSUMER_SECRET) . '&' . urlencode(NETSUITE_TOKEN_SECRET);
  $signature = base64_encode(hash_hmac("sha256", $base_string, $sig_string, true));

  $header='Authorization: OAuth realm="'. rawurlencode(NETSUITE_ACCOUNT) .'",'
  .'oauth_consumer_key="'. rawurlencode(NETSUITE_CONSUMER_KEY).'",'
  .'oauth_token="'.rawurlencode(NETSUITE_TOKEN_ID).'",'
  .'oauth_signature_method="'.$oauth_signature_method.'",'
  .'oauth_timestamp="'.$oauth_timestamp.'",'
  .'oauth_nonce="'.$oauth_nonce.'",'
  .'oauth_version="'.$oauth_version.'",'
  .'oauth_signature="'.urlencode($signature).'"';

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=11&deploy=2&location_req='.$location.'&record_type=get_hadiah',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_POSTFIELDS =>'',
    CURLOPT_HTTPHEADER => array(
      $header,
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  return json_decode($response);        
}


function getDetailAnak($idRec){
    $oauth_nonce = md5(mt_rand());
    $oauth_timestamp = time();
    $oauth_signature_method = 'HMAC-SHA256';
    $oauth_version = "1.0";

    $base_string =
        "GET&" . urlencode(NETSUITE_URL) ."&".
        urlencode(
            "deploy=" . NETSUITE_DEPLOY_ID
                ."&idRec=" . $idRec
                . "&oauth_consumer_key=" . NETSUITE_CONSUMER_KEY
                . "&oauth_nonce=" . $oauth_nonce
                . "&oauth_signature_method=" . $oauth_signature_method
                . "&oauth_timestamp=" . $oauth_timestamp
                . "&oauth_token=" . NETSUITE_TOKEN_ID
                . "&oauth_version=" . $oauth_version
                . "&record_type=get_detail_anak"
                . "&script=" . NETSUITE_SCRIPT_ID
        );
    
    $sig_string = urlencode(NETSUITE_CONSUMER_SECRET) . '&' . urlencode(NETSUITE_TOKEN_SECRET);
    $signature = base64_encode(hash_hmac("sha256", $base_string, $sig_string, true));

    $header='Authorization: OAuth realm="'. rawurlencode(NETSUITE_ACCOUNT) .'",'
    .'oauth_consumer_key="'. rawurlencode(NETSUITE_CONSUMER_KEY).'",'
    .'oauth_token="'.rawurlencode(NETSUITE_TOKEN_ID).'",'
    .'oauth_signature_method="'.$oauth_signature_method.'",'
    .'oauth_timestamp="'.$oauth_timestamp.'",'
    .'oauth_nonce="'.$oauth_nonce.'",'
    .'oauth_version="'.$oauth_version.'",'
    .'oauth_signature="'.urlencode($signature).'"';

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=11&deploy=2&record_type=get_detail_anak&idRec=' . $idRec,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_POSTFIELDS =>'{
        "idRec": "'.$idRec.'"
    }',
      CURLOPT_HTTPHEADER => array(
        $header,
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);        
}


function getHistoryReward($idRec){
    $oauth_nonce = md5(mt_rand());
    $oauth_timestamp = time();
    $oauth_signature_method = 'HMAC-SHA256';
    $oauth_version = "1.0";

    $base_string =
        "GET&" . urlencode(NETSUITE_URL) ."&".
        urlencode(
            "deploy=" . NETSUITE_DEPLOY_ID
                ."&idRec=" . $idRec
                . "&oauth_consumer_key=" . NETSUITE_CONSUMER_KEY
                . "&oauth_nonce=" . $oauth_nonce
                . "&oauth_signature_method=" . $oauth_signature_method
                . "&oauth_timestamp=" . $oauth_timestamp
                . "&oauth_token=" . NETSUITE_TOKEN_ID
                . "&oauth_version=" . $oauth_version
                . "&record_type=get_history_reward"
                . "&script=" . NETSUITE_SCRIPT_ID
        );
    
    $sig_string = urlencode(NETSUITE_CONSUMER_SECRET) . '&' . urlencode(NETSUITE_TOKEN_SECRET);
    $signature = base64_encode(hash_hmac("sha256", $base_string, $sig_string, true));

    $header='Authorization: OAuth realm="'. rawurlencode(NETSUITE_ACCOUNT) .'",'
    .'oauth_consumer_key="'. rawurlencode(NETSUITE_CONSUMER_KEY).'",'
    .'oauth_token="'.rawurlencode(NETSUITE_TOKEN_ID).'",'
    .'oauth_signature_method="'.$oauth_signature_method.'",'
    .'oauth_timestamp="'.$oauth_timestamp.'",'
    .'oauth_nonce="'.$oauth_nonce.'",'
    .'oauth_version="'.$oauth_version.'",'
    .'oauth_signature="'.urlencode($signature).'"';

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=11&deploy=2&record_type=get_history_reward&idRec=' . $idRec,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_POSTFIELDS =>'{
        "idRec": "'.$idRec.'"
    }',
      CURLOPT_HTTPHEADER => array(
        $header,
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);        
}

function login($username,$password,$location){
  $oauth_nonce = md5(mt_rand());
  $oauth_timestamp = time();
  $oauth_signature_method = 'HMAC-SHA256';
  $oauth_version = "1.0";

  $base_string =
      "GET&" . urlencode(NETSUITE_URL) ."&".
      urlencode(
          "deploy=" . NETSUITE_DEPLOY_ID
          . "&location_req=".$location
              . "&oauth_consumer_key=" . NETSUITE_CONSUMER_KEY
              . "&oauth_nonce=" . $oauth_nonce
              . "&oauth_signature_method=" . $oauth_signature_method
              . "&oauth_timestamp=" . $oauth_timestamp
              . "&oauth_token=" . NETSUITE_TOKEN_ID
              . "&oauth_version=" . $oauth_version
              . "&password_req=".$password
              . "&record_type=login"
              . "&script=" . NETSUITE_SCRIPT_ID
              . "&username_req=".$username
      );
  
  $sig_string = urlencode(NETSUITE_CONSUMER_SECRET) . '&' . urlencode(NETSUITE_TOKEN_SECRET);
  $signature = base64_encode(hash_hmac("sha256", $base_string, $sig_string, true));

  $header='Authorization: OAuth realm="'. rawurlencode(NETSUITE_ACCOUNT) .'",'
  .'oauth_consumer_key="'. rawurlencode(NETSUITE_CONSUMER_KEY).'",'
  .'oauth_token="'.rawurlencode(NETSUITE_TOKEN_ID).'",'
  .'oauth_signature_method="'.$oauth_signature_method.'",'
  .'oauth_timestamp="'.$oauth_timestamp.'",'
  .'oauth_nonce="'.$oauth_nonce.'",'
  .'oauth_version="'.$oauth_version.'",'
  .'oauth_signature="'.urlencode($signature).'"';
    $urlnya='https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=11&deploy=2&location_req='.$location.'&record_type=login&username_req='.$username.'&password_req='.$password;

    $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $urlnya,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_POSTFIELDS =>'',
    CURLOPT_HTTPHEADER => array(
      $header,
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);
  // die($urlnya);
  curl_close($curl);
  return json_decode($response);        
}

function login_multi_loc($username,$password,$location){
  $oauth_nonce = md5(mt_rand());
  $oauth_timestamp = time();
  $oauth_signature_method = 'HMAC-SHA256';
  $oauth_version = "1.0";

  $base_string =
      "GET&" . urlencode(NETSUITE_URL) ."&".
      urlencode(
          "deploy=" . NETSUITE_DEPLOY_ID
          . "&location_req=".$location
              . "&oauth_consumer_key=" . NETSUITE_CONSUMER_KEY
              . "&oauth_nonce=" . $oauth_nonce
              . "&oauth_signature_method=" . $oauth_signature_method
              . "&oauth_timestamp=" . $oauth_timestamp
              . "&oauth_token=" . NETSUITE_TOKEN_ID
              . "&oauth_version=" . $oauth_version
              . "&password_req=".$password
              . "&record_type=login_multi"
              . "&script=" . NETSUITE_SCRIPT_ID
              . "&username_req=".$username
      );
  
  $sig_string = urlencode(NETSUITE_CONSUMER_SECRET) . '&' . urlencode(NETSUITE_TOKEN_SECRET);
  $signature = base64_encode(hash_hmac("sha256", $base_string, $sig_string, true));

  $header='Authorization: OAuth realm="'. rawurlencode(NETSUITE_ACCOUNT) .'",'
  .'oauth_consumer_key="'. rawurlencode(NETSUITE_CONSUMER_KEY).'",'
  .'oauth_token="'.rawurlencode(NETSUITE_TOKEN_ID).'",'
  .'oauth_signature_method="'.$oauth_signature_method.'",'
  .'oauth_timestamp="'.$oauth_timestamp.'",'
  .'oauth_nonce="'.$oauth_nonce.'",'
  .'oauth_version="'.$oauth_version.'",'
  .'oauth_signature="'.urlencode($signature).'"';
    $urlnya='https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=11&deploy=2&location_req='.$location.'&record_type=login_multi&username_req='.$username.'&password_req='.$password;

    $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $urlnya,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_POSTFIELDS =>'',
    CURLOPT_HTTPHEADER => array(
      $header,
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);
  // die($urlnya);
  curl_close($curl);
  return json_decode($response);        
}


function getHadiah($location){
  $oauth_nonce = md5(mt_rand());
  $oauth_timestamp = time();
  $oauth_signature_method = 'HMAC-SHA256';
  $oauth_version = "1.0";

  $base_string =
      "GET&" . urlencode(NETSUITE_URL) ."&".
      urlencode(
          "deploy=" . NETSUITE_DEPLOY_ID
              . "&location_req=".$location
              . "&oauth_consumer_key=" . NETSUITE_CONSUMER_KEY
              . "&oauth_nonce=" . $oauth_nonce
              . "&oauth_signature_method=" . $oauth_signature_method
              . "&oauth_timestamp=" . $oauth_timestamp
              . "&oauth_token=" . NETSUITE_TOKEN_ID
              . "&oauth_version=" . $oauth_version
              . "&record_type=showreward"
              . "&script=" . NETSUITE_SCRIPT_ID
      );
  
  $sig_string = urlencode(NETSUITE_CONSUMER_SECRET) . '&' . urlencode(NETSUITE_TOKEN_SECRET);
  $signature = base64_encode(hash_hmac("sha256", $base_string, $sig_string, true));

  $header='Authorization: OAuth realm="'. rawurlencode(NETSUITE_ACCOUNT) .'",'
  .'oauth_consumer_key="'. rawurlencode(NETSUITE_CONSUMER_KEY).'",'
  .'oauth_token="'.rawurlencode(NETSUITE_TOKEN_ID).'",'
  .'oauth_signature_method="'.$oauth_signature_method.'",'
  .'oauth_timestamp="'.$oauth_timestamp.'",'
  .'oauth_nonce="'.$oauth_nonce.'",'
  .'oauth_version="'.$oauth_version.'",'
  .'oauth_signature="'.urlencode($signature).'"';

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=11&deploy=2&location_req='.$location.'&record_type=showreward',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_POSTFIELDS =>'',
    CURLOPT_HTTPHEADER => array(
      $header,
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  
  return json_decode($response);        
}


// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://7131410.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=11&deploy=2&phone_number=085222286430',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'GET',
//   CURLOPT_POSTFIELDS =>'{
//     "phone_number": "12345"
// }',
//   CURLOPT_HTTPHEADER => array(
//     'Authorization: OAuth realm="7131410",oauth_consumer_key="f173bb9a174fe9d259d7c1dcd260456cedb192a7d819ac17c5d9055dbaf2dd78",oauth_token="61bfde99e22637154962606734227c1cafeb76508d9cfda255a63315dd5801f8",oauth_signature_method="HMAC-SHA256",oauth_timestamp="1617976653",oauth_nonce="AzSDutiEgvO",oauth_version="1.0",oauth_signature="G0FENn7NW13w5vQJRjqMSHXFlEGtM0y3fNT4gVtFQVA%3D"',
//     'Content-Type: applic 8

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response;