<?php

  require_once "api/config/config.php";
  require_once "api/ServiceAPI.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>indexoffy-api-cep-aberto</title>

      <?php include("template/design.php");?>
    
  </head>
  <body>

      <?php include("template/header.php");?>

      <main role="main">

        <?php include("template/content-top.php");?>

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

    </main>

    <?php include("template/footer.php");?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="packages/bootstrap/bootstrap.bundle.min.js"></script>

  </body>
</html>
