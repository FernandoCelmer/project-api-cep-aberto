<?php

require_once "config/config.php";

class ServiceAPI {

    private $key = null;
    private $error = false;

    function __construct($key = null) {
        if (!empty($key)) $this->key = $key;
    }

    function request($url, $request) {
        
        if (!empty($url)){
            $ch = curl_init();
            $timeout = 5;
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . $this->key));
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, $request);
            $file_contents = curl_exec($ch);
            curl_close($ch);

            return $file_contents;

        } else {
            $this->error = true;
            return false;
        }

    } 

    function getCep($params){
        $request = "GET";
        $url = "https://www.cepaberto.com/api/v3/cep?". $params;

        if (!empty($params)){
            return $this->request($url, $request);
        }

    }

    function getAddress($params){
        $request = "GET";
        $link = [];

        if (is_array($params)){
            foreach ($params as $tipkey => $value){
                if (empty($value)) continue;
                $link .= $tipkey . '=' . urlencode($value) . '&';
            }
        }

        $params = substr($link, 0, -1);
    
        if (!empty($params)){
            $url = "https://www.cepaberto.com/api/v3/address?". $params;
            return $this->request($url, $request);
        } else {
            $this->error = true;
            return false;
        }
    
    }

    }

?>
