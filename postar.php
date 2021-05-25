<?php
session_start();
require_once('autentica_sessao.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNILearning - Postar Treinamento</title>
  <!-- Font google -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <!-- CSS BOOT -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="img/logo-unimed.png" type="image/x-icon">
  <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <style>
    /* Esconde o input */

    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-image: url('img/bg1.jpg');
    }

    form {
      background-color: #fff;
      padding: 2em;
      border-radius: 10px;
    }

    input[type='file'] {
      display: none
    }

    /* Aparência que terá o seletor de arquivo */
    .mb-3 label {
      background-color: #006400;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
      margin: 10px;
      padding: 6px 20px;
      width: 40em;
    }

    .bordas-inputs {
      width: 100%;
      border-radius: 5px;
      outline: none;
      border-style: solid;
      border-color: #006400;
    }

    .span {
      color: red;
    }
  </style>
</head>

<body>
  <div style="display:flex; justify-content: center; margin:2%;" class="container-sm">
    <form method="post" action="recebe_upload.php" onSubmit="return valida_dados(this)" enctype="multipart/form-data">
      <div class="mb-3">
        <label style="text-align:center;" for='selecao-arquivo'>>>>selecione o video<<<<< </label>
            <input type="file" id="selecao-arquivo" name="arquivo">
      </div>
      <div class="mb-4">
        <label style="background-color: none; width:none; color: none;" for="titulo">Titulo: <span class="span">*</span></label>
        <input class="bordas-inputs" type="text" id="titulo" name="titulo" maxlength="70">
      </div>

      <!---->
      <div class="mb-2">

        <select class="bordas-inputs" name="assunto" id="assunto">
          <?php
          require("model/Assunto_dao.php");
          $Lista = $Assunto->buscar_assunto();

          foreach ($Lista as $item) {
          ?>
            <option value=<?= $item['id'] ?>><?= $item['nome'] ?></option>
          <?php
          }
          ?>
        </select>
      </div>

      <!---->
      <div class="mb-4">
        <label style="background-color: none; width:none; color: none;" for="tipo">Tipo:<span class="span">*</span></label>
        <input class="bordas-inputs" type="text" id="tipo" name="tipo" maxlength="30">
      </div>
      <div class="mb-4">
        <label style="background-color: none; width:none; color: none;" for="Subtipo">Sub Tipo:</label>
        <input class="bordas-inputs" type="text" id="subtipo" name="subtipo" maxlength="30">
      </div>
      <div class="mb-4">
        <label style="background-color: none; width:none; color: none;" for="tempo">Duração:<span class="span">*</span></label>
        <input class="bordas-inputs" style="width:3em !important" type="number" min="1" id="tempo" name="tempo"> <span>minutos</span>
      </div>


      <div class="mb-4">
        <label style="background-color: none; width:none; color: none;" for="my-textarea">Descricao</label>
        <textarea id="my-textarea" class="form-control bordas-inputs" name="descricao" rows="3" maxlength="100"></textarea>
      </div>


      <div style="float:right;margin-top:10%;">
        <!--div dos botões-->
        <input type="submit" style="background-color:#006400;" class="btn btn-primary" value="Enviar" onclick="waittoinput()" />
        <button style="padding:5.8px 0;" class="btn btn-danger"><a style="color:#fff; text-decoration:none; margin:0; padding:10px 16px;" href="home">Voltar</a></button>
      </div>
      <!--fim div botões-->
      <?php // exibição de erro 
      if (isset($_GET['params'])) {
        if ($_GET['params'] == 'erronull') {
      ?>
          <!-- primeiro caso-->
          <div class="alert alert-danger" role="alert">
            ERRO: Adicione um video para realizar a postagem.
          </div>

        <?php
        } else if ($_GET['params'] == 'erroext') {
        ?>
          <!-- segundo  caso-->
          <div class="alert alert-danger" role="alert">
            ERRO: A extensão da midia selecionada não é MP4.
          </div>

      <?php
        }
      } // fim exibição de erro - fim if verificação se a variavel existe
      ?>
    </form>

  </div>



  <script src="js/validar_campos.js"></script>
</body>

</html>