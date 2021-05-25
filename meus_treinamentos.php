<?php
session_start();
//require_once('usuarios.php');
require_once('autentica_sessao.php');

require_once("model/Assunto_dao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/estilo.css">
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
  <title>UNILearning - Meus Treinamentos</title>
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
      <!-- Controls -->

      <!-- Inner -->
      <div class="carousel-inner py-4">
        <!-- Single item -->
        <div class="carousel-item active">
          <div style="margin-top:2em;" class="container">
            <div class="row">


              <?php
              require_once("model/arquivo_dao.php");
              $Lista = $arquivo->buscar_video_usuario($_SESSION['matricula']);
              foreach ($Lista as $treinamento) {
              ?>
                <!-- inicio de um item forech-->
                <div class="col-lg-4 d-none d-lg-block">
                  <div style="border-radius:10px; margin-top:2em; height:480px; box-shadow: 10px 5px 5px black; font-size: 14px;" class="card">
                    <?php
                    if (!$treinamento['diretorio'] == null) {

                    ?>
                      <div class="meu-container">
                        <!---teste-->

                        <form action="reprodutor.php" method="POST">
                          <input type="hidden" name="id_curso" value=<?= $treinamento['id'] ?>>
                          <input type="hidden" name="url" value='home'>


                          <!--teste-->
                          <button style="color:#fff; text-decoration:none; background:none; border:none; justify-content:center;" type="submit">
                            <img class="tumbnail" src="img/playimage.png" class="card-img-top" alt="..." />
                          </button>
                        </form>
                      </div>

                    <?php
                    }
                    ?>
                    <div class="card-body text-left">
                      <div>Titulo: <?= $treinamento['titulo'] ?></div>
                      <div class="card-title">Assunto: <?= $Assunto->buscar_assunto_id($treinamento['assunto'])['nome'] ?></div>
                      <div class="card-title">Tipo: <?= $treinamento['tipo'] ?></div>
                      <div class="card-title">Sub-Tipo: <?= $treinamento['subtipo'] ?></div>
                      <div class="card-title">Duração: <?= $treinamento['tempo'] ?> minutos</div>
                     
                      <p class="card-text">
                        <?= $treinamento['descricao'] ?>
                      </p>

                      <?php

                      if ($_SESSION['matricula'] == $treinamento['matricula_usuario']) { // inicio botões de usuario adm
                        require('menu_adm.php');
                      }  // fim botões usuario adm
                      ?>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
              <!-- fim de um item foreach -->
            </div>
          </div>
        </div>
        <!-- fim de um item -->
      </div>
      <!-- Carousel wrapper -->





    </div>

</body>
<footer>
  <center style="color:#fff; margin-top:4em;"> BETA TESTE 0.2</center>
</footer>
</html>