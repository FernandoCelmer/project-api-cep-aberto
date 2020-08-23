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

            <div class="col-12">
              <div class="callout callout-info d-none">
                  <h5><i class="fa fa-info"></i> Note:</h5>
                  ...
              </div>
            </div>

            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">GET Cep</h3>
                      </div>
                        <div class="card-body">
                            <div class="input-group input-group">
                                <input class="form-control form-control-lg" type="text" id="cep" placeholder="CEP">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-pesquisar-cep" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title">GET Endereço</h3>
                      </div>
                      <form role="form">
                        <div class="card-body">
                            <div class="input-group input-group">
                                <select class="form-control form-control-lg" disabled>
                                    <option value=""></option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                    <option value="DF">Distrito Federal</option>
                                </select>
                                <input class="form-control form-control-lg" placeholder="Cidade" disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" disabled><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

              <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Informações</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fa fa-file-code-o mr-1"></i>Json</strong>
                    <p class="json" id="local"></p>
                </div>
              </div>

              </div>
            </section>

            </div>
        </div>

    </div>
        <?php include("template/footer.php");?>
    </div>
        <?php include("template/scripts.php");?>
    </body>

    <script>

      $(() => {
          $(".btn-pesquisar-cep").on("click", function(){             
            var param = $("#cep").val();  

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'app/index.php',
                async: true,
                data: {
                  param: param,
                  tip: "cep"},
                success: function(response){
                  console.log(response);
                  
                  var texto = JSON.stringify(response);
                  const local = document.querySelector("#local")
                  local.innerHTML = texto

                }
            }
            );

          })
      });
    </script>

</html>
