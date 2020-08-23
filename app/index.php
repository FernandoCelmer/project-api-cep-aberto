<?php
header('Content-Type: text/html; charset=utf-8');

require_once "../api/config/config.php";
require_once "../api/ServiceAPI.php";

class App{

    function __construct() {

        try{

            $tip = $_POST['tip'];
            $param = $_POST['param'];

            if (!empty($tip) || (!empty($param))){

                if ($tip == "cep"){
                    $response = array("success" => $this->getCep($param));
                    echo json_encode($response);
                } elseif ($tip == "address"){
                    $response = array("success" => $this->getAddress($param));
                    echo json_encode($response);                   
                }

            } 
        
        } catch (Exception $e){

			$response = array(
				'sucesso' => false,
				'mensagem' => $e->getMessage()
			);

		    $this->output
		        ->set_status_header(200)
		        ->set_content_type('application/json', 'utf-8')
		        ->set_output(json_encode($response));
        }

    }

    public function getCep($param){

        $api = new ServiceAPI(API_KEY);
        $local = $api->getCep($param);

        return $local;
    }

    public function getAddress($param){
        
        $api = new ServiceAPI(API_KEY);
        $local = $api->getAddress($param);

        return $local;
    }
}

$api = new App();

?>