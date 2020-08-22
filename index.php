<?php

  require_once "api/config/config.php";
  require_once "api/ServiceAPI.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>indexoffy-api-cep-aberto</title>

    <?php include("template/design.php");?>
  
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <?php include("template/header.php");?>
        <?php include("template/content-top.php");?>

        <div class="content">
            <div class="container">

            <?php

              $array = [
                  "estado" => "RS",
                  "cidade" => "Flores da Cunha",
                ];

              $api = new ServiceAPI(API_KEY);
              $local = $api->getAddress($array);

              foreach ($array as $local) {
                echo "<br> " . $local;
              }

            ?>

            </div>
        </div>

    </div>
        <?php include("template/footer.php");?>
    </div>
        <?php include("template/scripts.php");?>
    </body>
</html>
