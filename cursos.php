<?php
session_start();
require_once('autentica_sessao.php');


require_once("model/Assunto_dao.php");

if (!isset($_SESSION)) {
  die('Sem sessao! Favor logar novamente.');
}

if (!isset($_POST['id_assunto'])) {
  die('Sem parametros para continuar.');
}
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
  <title>UNILearning - Cursos</title>
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

    .titulo {
      margin-top: 2.5em;
      margin-left: 2em;
      color: #fff;
      font-weight: 800;
      text-shadow: 2px 2px 2px black;
    }
  </style>
</head>

<body>
  <div class="principal">


    <?php include_once('navbar.php'); ?>

    <!--fim da navbar-->


    <h2 class="titulo"><?= $Assunto->buscar_assunto_id($_POST['id_assunto'])['nome'] ?> :</h2>
    <!-- Carousel wrapper -->
    <div id="carouselMultiItemExample" class="carousel slide carousel-dark " data-mdb-ride="carousel">
      <!-- Controls -->

      <!-- Inner -->
      <div class="carousel-inner py-4">
        <!-- Single item -->
        <div class="carousel-item active">
          <div class="container">
            <div class="row">


              <?php
              require_once("model/arquivo_dao.php");
              $Lista = $arquivo->buscar_video();
              //echo "<pre>"; print_r($Lista); exit;
              foreach ($Lista as $treinamento) { // inicio geral item
                $usuarios_permitidos = $arquivo->buscar_permissao($treinamento['id']);
                $bool = false; // variavel de controle
                foreach ($usuarios_permitidos as $permitido) { // foreach busca todos da lista de permitidos
                  if ($permitido['matricula'] == $_SESSION['matricula']) { // compara com cada um dos que vem da API
                    $bool = true; // muda o status da variavel de controle caso encontre 
                  } // fim if de status
                }
                if ($treinamento['status'] == 0 && $_POST['id_assunto'] == $treinamento['assunto'] && $bool == true) { // if configuração de exibição
              ?>
                  <!-- inicio de um item forech-->
                  <div class="col-lg-4 d-none d-lg-block">
                    <div style="border-radius:10px;margin-top:2em; height:430px; box-shadow: 10px 5px 5px black; font-size: 14px; " class="card">
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
                        <div><b>Título:</b>   <?= $treinamento['titulo'] ?></div>
                        <div class="card-title"><b>Assunto:</b>  <?= $Assunto->buscar_assunto_id($treinamento['assunto'])['nome'] ?></div>
                        <div class="card-title"><b>Tipo:</b> <?= $treinamento['tipo'] ?></div>
                        <div class="card-title"><b>Sub-Tipo:</b>  <?= $treinamento['subtipo'] ?></div>
                        <div class="card-title"><b>Duração:</b>  <?= $treinamento['tempo'] ?> minutos</div>
                        <?php // tag para buscar se usuario já concluiu o curso
                        require_once("model/usuario_dao.php");
                        $conclusao = $usuario->buscar_conclusao($_SESSION['matricula'], $treinamento['id']);
                        if ($conclusao != null) {


                        ?>
                          <div style="color:green;"> <b>TREINAMENTO CONCLUIDO</b>  <i class="fas fa-check-circle"></i> </div>
                          <div style="color:green;"> <?=$conclusao['avaliacao']?> <i class="fas fa-star"></i></div>
                        <?php // fim  tag para saber se usuario concluiu o curso
                        }else{
                        ?>
                        <div style="color:red;"> <b>PENDENTE DE CONCLUSÃO</b>  <i class="fas fa-times-circle"></i></div>
                        <?php
                        }
                        ?>
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
              <?php      } // if configuração de exibição
              } // fim geral do item
              ?>
              <!-- fim de um item foreach -->
            </div>
          </div>
        </div>
        <!-- fim de um item html-->
      </div>
      <!-- Carousel wrapper -->





    </div>

</body>
<footer>
  <center style="color:#fff; margin-top:4em;"> BETA TESTE 0.2</center>
</footer>
</html>