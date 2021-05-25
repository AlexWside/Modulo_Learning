<?php
session_start();
require_once('autentica_sessao.php');
require_once("model/arquivo_dao.php");

if (!isset($_SESSION['matricula'])) {
  die('Sem sessao! Favor logar novamente.');
}

if (!isset($_POST['id_curso'])) {
  die('Sem parametros para continuar.');
}

$result['status'] = "";
$result['msg'] = "";

if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
  if (!isset($_SESSION['matricula'])) {
    die('Sem sessao! Favor logar novamente.');
  }

  if ($arquivo->adicionar_edicao($_POST)) {
    $result['status'] = true;
    $result['msg'] = "Video editar com sucesso.";
  } else {
    $result['status'] = false;
    $result['msg'] = "Erro ao editar video.";
  }
}

$video = $arquivo->buscar_video_id($_POST['id_curso']);

if (empty($video)) {
  die('Erro retornar video.');
}

//echo "<pre>"; print_r($video); exit;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNILearning - Editar Descrição</title>
  <!-- Font google -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <!-- CSS BOOT -->
  <script src="https://kit.fontawesome.com/f1745b5607.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="img/logo-unimed.png" type="image/x-icon">

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

    .preview {
      background: black;
      border-radius: 5px;
      padding: 1em;
      margin-bottom: 10px;
      display: flex;
      justify-content: center;

      color: #fff;
    }

    .icon-rec {
      float: right;
      color: red;
      font-size: 18px;
      animation: cor-rec ease 0.8s infinite alternate;

    }

    @keyframes cor-rec {
      from {
        color: red;
      }

      to {
        color: black;
      }
    }

    .span {
      color: red;
    }
  </style>
</head>

<body>
  <?php include_once('navbar.php'); ?>
  <div style="display:flex; justify-content: center; margin:2%; margin-top:7em;" class="container-sm">

    <form method="post" action="" onSubmit="return valida_dados(this)" enctype="multipart/form-data">
      <!--inicio preview-->
      <input type="hidden" name="acao" value='editar'>
      <input type="hidden" name="id_curso" value=<?= $video['id'] ?>>
      <div class="preview">
        <div class="text-left" style="float:left;">preview</div>
        <video width="400" height="200" controls autoplay controlsList="nodownload">
          <source src="<?= $video['diretorio'] ?>">
          Navegador incompativel.
        </video>
        <div class="icon-rec">&nbsp &nbsp &nbsp<i class="fas fa-record-vinyl"></i> </div>
      </div>
      <!--fim preview-->
      <div class="alert alert-info" role="alert">
        CAMPO DE EDIÇÃO DE TITULOS PARA ALTERAR O VIDEO INATIVE O POST<BR>
        ATUAL E REALIZE UMA NOVA POSTAGEM COM O VIDEO DESEJADO.
      </div>
      <div class="mb-4">
        <label style="background-color: none; width:none; color: none;" for="titulo">Titulo:<span class="span">*</span></label>
        <input class="bordas-inputs" value='<?= $video['titulo'] ?>' type="text" id="titulo" name="titulo" maxlength="70">
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
          <?php } ?>
        </select>
      </div>

      <!---->
      <div class="mb-4">
        <label style="background-color: none; width:none; color: none;" for="tipo">Tipo:<span class="span">*</span></label>
        <input class="bordas-inputs" value=<?= $video['tipo'] ?> type="text" id="tipo" name="tipo" maxlength="30">
      </div>
      <div class="mb-4">
        <label style="background-color: none; width:none; color: none;" for="subtipo">Sub-Tipo:</label>
        <input class="bordas-inputs" type="text" value='<?= $video['subtipo'] ?>' id="subtipo" name="subtipo" maxlength="30">
      </div>
      <div class="mb-4">
        <label style="background-color: none; width:none; color: none;" for="tempo">Duração:<span class="span">*</span></label>
        <input class="bordas-inputs" style="width:3em !important" type="number" value=<?= $video['tempo'] ?> min="1" id="tempo" name="tempo"> <span>minutos</span>
      </div>
      <div class="mb-4">
        <label style="background-color: none; width:none; color: none;" for="my-textarea">Descricao</label>
        <textarea id="my-textarea" class="form-control bordas-inputs" name="descricao" rows="3" maxlength="100"><?= $video['descricao'] ?></textarea>
      </div>


      <div style="float:right;margin-top:10%;">
        <!--div dos botões-->

        <input type="submit" style="background-color:#006400;" class="btn btn-primary" value="Concluir" />

        <button style="padding:5.8px 0;" class="btn btn-danger"><a style="color:#fff; text-decoration:none; margin:0; padding:10px 16px;" href="home">Voltar</a></button>
      </div>
      <!--fim div botões-->

      <?php if (!empty($result['status']) &&  $result['status'] = true) { ?>
        <div class="alert alert-success" role="alert">
          <?php echo $result['msg']; ?>
        </div>
      <?php } else if (!empty($result['status']) &&  $result['status'] = false) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $result['msg']; ?>
        </div>
      <?php } ?>
    </form>

  </div>


  <!--teste-->

  <script src="js/validar_campos.js"></script>
</body>

</html>