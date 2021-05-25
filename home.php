<?php
session_start();
require_once('autentica_sessao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" href="img/logo-unimed.png" type="image/x-icon">
  <!-- Font google -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <!-- CSS only -->
  <script src="https://kit.fontawesome.com/f1745b5607.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <title>UNILearning - Treinamentos</title>
  <style>
    * {
      font-family: 'Poppins', sans-serif;


    }

    .mini_galeria {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    body {
      background-image: url('img/bg1.jpg');
      background-attachment: fixed;
    }

    /* Esconde o input */
    input[type='file'] {
      display: none
    }

    /* Aparência que terá o seletor de arquivo */
    label {
      background-color: #3498db;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
      margin: 10px;
      padding: 6px 20px;
      width: 40em;
    }

    .tumbnail {
      width: 5em;
      height: 5em;
      margin-top: 3em;
      padding: 1em 0;
    }

    .tumbnail:hover {
      width: 6em;
      height: 6em;
      margin-top: 2em;
      padding: 1em 0;
    }

    .meu-container {
      display: flex;
      flex-direction: row;
      justify-content: center;
    }
  </style>
</head>

<body>

  <div class="principal">

    <?php include_once('navbar.php'); ?>


    <!--fim da navbar-->

    <!-- Carousel wrapper -->
    <div id="carouselMultiItemExample" class="carousel slide carousel-dark " data-mdb-ride="carousel">


      <div class="carousel-inner py-4">
        <!-- Single item -->
        <div class="carousel-item active">
          <div style="margin-top:2em;" class="container">
            <div class="row">

              <?php
              $cont_assunto = 0;// variavel de controle para verificar se o array de assuntos vira vazio
              require_once("model/Assunto_dao.php");

              $busca_usuario_assunto = $Assunto->buscar_usuario_assunto();
              // echo "<pre>" . print_r($busca_usuario_assunto[1]) ; exit;
              foreach ($busca_usuario_assunto as $item) { // inicio geral item 

                if ($Assunto->buscar_assunto_id($item['assunto'])['status'] == 0) {
                  $cont_assunto = 1;//  variavel de controle recebe valor caso tenha treinamentos para o usuario 

              ?>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div style="border-radius:10px; margin-top:2em; height:150px; box-shadow: 10px 5px 5px black; font-size: 16px; " class="card">

                      <div class="card-body text-center">
                        <div class="meu-container">


                          <form action="cursos" method="POST">
                            <input type="hidden" name="id_assunto" value=<?= $item['assunto'] ?>>
                            <input type="hidden" name="url" value='home'>
                            <button style="color:#006400; text-decoration:none; background:none; border:none; justify-content:center; font-size:3.5em" type="submit">
                              <i class="fas fa-chalkboard-teacher"></i>
                            </button>
                          </form>

                        </div>
                        <div> <?= $Assunto->buscar_assunto_id($item['assunto'])['nome'] ?> <span>(<?=$Assunto->buscar_usuario_assunto_coint($item['assunto'])?>)</span></div>
                      </div>
                    </div>
                  </div>
                <?php } // fim if status assunto
              }// fim foreach
              if ($cont_assunto == 0) {// caso continue vazio apos o filtro o usuario não tem treunamentos liberados
                ?>
                <center style="margin-top:4em; color:white;">
                  <h4>Nenhum treinamento liberado para você no momento, entre em contato com os Administradores do sistema.</h4>
                </center>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <!-- fim de um item html-->
      </div>
      <!-- Carousel wrapper -->


    </div>


</body>
<footer>
  <center style="color:#fff; margin-top:30%;"> BETA TESTE 0.2</center>
</footer>
</html>