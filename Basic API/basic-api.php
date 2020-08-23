<?php

class ServiceAPI {

    private $key = 'Your_Access_Token';
    private $error = false;

    // Function responsible for making requests in the API and returning the information in json.
    function request($uri, $request) {

        if (!empty($uri)){
            $ch = curl_init();
            $timeout = 5;
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . $this->key)); // Access token for request.
            curl_setopt ($ch, CURLOPT_URL, $uri); // Request URL.
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // Limit time.
            curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, $request); // HTPP Request Type.
            $file_contents = curl_exec($ch);
            curl_close($ch);
    
            return $file_contents;
        
        } else {
            $this->error = true;
            return false;
        }

    } 

    // Preparation of parameters and URL for searching zip codes.
    function getCep(){
        
        $request = "GET";
        $params = 'cep=95010000';
        $uri = "https://www.cepaberto.com/api/v3/cep?". $params;
        
        if (!empty($params)){
            return $this->request($uri, $request);
        }
        
    }

    // Preparation of parameters and URL for search of Addresses.
    function getAddress(){

        $link = null;
        $request = "GET";
        $params = array(
            "estado" => "RS",
            "cidade" => "Flores da Cunha",
        );

        if (is_array($params)){
            foreach ($params as $type_key => $value){
                if (empty($value)) continue;
                $link .= $type_key . '=' . urlencode($value) . '&';
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

    // Preparation of parameters and URL for listing cities in a state.
    function getCities(){
      
        $request = "GET";
        $params = 'RS';
        $uri = "https://www.cepaberto.com/api/v3/cities?estado=". $params;
    
        if (!empty($params)){
            return $this->request($uri, $request);
        }
    }

}
    /*===============================TEST================================*/
    
    $api = new ServiceAPI();
    echo "<p style='color: #062cfb'>getCep </p>" . $api->getCep();
    sleep(1);
    echo "<p style='color: #062cfb'>getAddress </p>" . $api->getAddress();
    sleep(1);
    echo "<p style='color: #062cfb'>getCities </p>" . $api->getCities();

    /*===============================TEST================================*/

?>
