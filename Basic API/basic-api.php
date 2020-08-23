<?php

class ServiceAPI {

    private $key = 'Token';
    private $error = false;

    function request($uri, $request) {

        if (!empty($uri)){
            $ch = curl_init();
            $timeout = 5;
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . $this->key));
            curl_setopt ($ch, CURLOPT_URL, $uri);
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

    function getCep(){
        
        $request = "GET";
        $params = 'cep=95010000';
        $uri = "https://www.cepaberto.com/api/v3/cep?". $params;
        
        if (!empty($params)){
            return $this->request($uri, $request);
        }
        
    }

    function getAddress(){

        $link = null;
        $request = "GET";
        $params = array(
            "estado" => "RS",
            "cidade" => "Flores da Cunha",
        );

        if (is_array($params)){
            foreach ($params as $tipkey => $value){
                if (empty($value)) continue;
                $link .= $tipkey . '=' . urlencode($value) . '&';
            }
        }

        $params = substr($link, 0, -1);
    
        if (!empty($params)){
            $uri = "https://www.cepaberto.com/api/v3/address?". $params;
            return $this->request($uri, $request);
        } else {
            $this->error = true;
            return false;
        }
    
    }

    function getCities(){
      
        $request = "GET";
        $params = 'RS';
        $uri = "https://www.cepaberto.com/api/v3/cities?estado=". $params;
    
        if (!empty($params)){
            return $this->request($uri, $request);
        }
    }

}

    $api = new ServiceAPI();
    echo "<p style='color: #062cfb'>getCep </p>" . $api->getCep();
    sleep(1);
    echo "<p style='color: #062cfb'>getAddress </p>" . $api->getAddress();
    sleep(1);
    echo "<p style='color: #062cfb'>getCities </p>" . $api->getCities();

?>
