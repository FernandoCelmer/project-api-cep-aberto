<?php

require_once "config/config.php";

class ServiceAPI {

  private $key = null;
  private $error = false;

  function __construct($key = null) {
    if (!empty($key)) $this->key = $key;
  }

  function request($endpoint = null, $params = null) {
    $uri = "https://www.cepaberto.com/api/v3/". $endpoint . "?". $params;

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

  function getCep($cep = null){
    
    $params = 'cep='. $cep;
    
    if (!empty($cep)){
      return $this->request('cep', $params);
    }
    
  }

  function getAddress($address = null){

    if (is_array($address)){
      foreach ($address as $tipkey => $value){
        if (empty($value)) continue;
        $link .= $tipkey . '=' . urlencode($value) . '&';
      }
    }

    $params = substr($link, 0, -1);
    
    if (!empty($params)){
      return $this->request('address', $params);
    } else {
      $this->error = true;
      return false;
    }
    
  }

}

?>
