<?php

require_once "api/config/config.php";
require_once "api/ServiceAPI.php";

$array = [
    "estado" => "RS",
    "cidade" => "Flores da Cunha",
  ];

$api = new ServiceAPI(API_KEY);
echo $api->getAddress($array);

?>