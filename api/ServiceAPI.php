<?php

require_once "config/config.php";

class ServiceAPI {

  private $key = null;
  private $error = false;

  function __construct($key = null) {
    if (!empty($key)) $this->key = $key;
  }

  function request($endpoint = null, $params = null) {
    $uri = "https://www.cepaberto.com/api/v3/". $endpoint . "?". $endpoint . "=" . $params;

    if (!empty($params)){
      $ch = curl_init();
      $timeout = 5;
      curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . $this->key));
      curl_setopt ($ch, CURLOPT_URL, $uri);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
      $file_contents = curl_exec($ch);
      curl_close($ch);
  
      return $file_contents;
    
    } else {
      $this->error = true;
      return false;
    }
        
  } 

  function getCep($cep){
    $data = $this->request('cep', $cep);

    if (!empty($data)){
      return $data;
    }
    
  }

  function getAddress($address){
    
    $array = [
      "estado" => "RS",
      "cidade" => "Flores da Cunha",
    ];

    if (is_array($array)){
      foreach ($array as $tipkey => $value){
        if (empty($value)) continue;
        $address .= $tipkey . '=' . urldecode($value) . '&';
      }
    }

    $params = substr($address, 0, -1);
    $data = $this->request('address', $params);
    
  }

}

$api = new ServiceAPI(API_KEY);
echo $api->getAddress('97950000');

?>
