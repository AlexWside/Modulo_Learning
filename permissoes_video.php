<?php
 session_start();
 require_once("model/arquivo_dao.php");
 require_once("model/usuario_dao.php");

 if( isset($_POST['acao']) && $_POST['acao'] == 'editar' ){
   
  
  foreach($_POST['usuarios_permitidos'] as $permitido){
      
  if( $arquivo->adicionar_permissao($permitido,$_POST['id_curso']) ){
      $result['status'] = true;
      $result['msg'] = "Video editar com sucesso.";
  }else{
    $result['status'] = false;
    $result['msg'] = "Erro ao editar video.";
  } 
 }// fim foreach

}// fim post de adicionar 



if( isset($_POST['remocao']) && $_POST['remocao'] == 'editar' ){
  foreach($_POST['remover_permitidos'] as $remover){
      
    if( $arquivo->apagar_permissao($remover) ){
        $result['status'] = true;
        $result['msg'] = "Video editar com sucesso.";
    }else{
      $result['status'] = false;
      $result['msg'] = "Erro ao editar video.";
    } 
   }// fim foreach

}

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
    <title>UNILearning - Permissões</title>
    <!-- daqui pra baixo é o plugin-->
    <script src="vendor/jquery-1.11.3.min.js"></script>
    <script src="vendor/jquery-ui.min.js"></script>
    <script src="dist/jquery.tree-multiselect.js"></script>

    <style>
    body{
        background-image: url('img/bg2.jpg');
    }
      * {
        font-family: 'Poppins', sans-serif;
      }

      .exibicao{
          margin-top:5em;
          padding:2em;
          border-radius:10px;
          background-color:#fff;
      }

      .botao{
          float: right;
          margin:1em
      }
    </style>
    <link rel="stylesheet" href="dist/jquery.tree-multiselect.min.css">
  </head>

  <body>
  <?php include_once('navbar.php'); ?>
    <div class="container exibicao"><!--Inicio da div dos permitidos -->
        <h5>Permitidos</h5>  
      <?php
      $usuarios_permitidos = $arquivo->buscar_permissao($_POST['id_curso']);
      
      ?>
          <form class="container" action="" method="POST">
            <input type="hidden" name="remocao" value='editar'>
            <input type="hidden" name="id_curso" value=<?=$_POST['id_curso']?>>
            <button type="submit" class="btn btn-danger botao">Remover</button>
            <button type="button" style="background-color:red; margin:0.5%;"  class="btn">
            <a style="color:#FFF; text-decoration:none;" href="meus_treinamentos"><i class="fas fa-arrow-circle-left"></i> Voltar</a>
            </button>
            <select id="select-usuarios-permitidos" name="remover_permitidos[]" multiple="multiple">
                <?php foreach($usuarios_permitidos as $permitido){ 
                  ?>
                <option value='<?=$permitido[0]?>' data-section='<?= $usuario->buscar_nome_usuario($permitido[1])['grupo']?>' data-description=<?=$permitido[1]?>><?= $usuario->buscar_nome_usuario($permitido[1])['nome']?></option>
                <?php
                  
              }?>
            </select> 
    </form> 
    </div><!-- FIm da Div dos Permitidos-->




           
    <?php

     //require_once ('./ROTAS/curl.php');
     $bigList = $usuario->buscar_todos_usuarios ();
    //require_once('ROTAS/GET_usuarios.php'); ?>
    <form class="container exibicao" action="" method="POST">
    <h5>Não Permitidos</h5>     
            <input type="hidden" name="acao" value='editar'>
            <input type="hidden" name="id_curso" value=<?=$_POST['id_curso']?>>
            <button type="submit" class="btn btn-primary botao"> Adicionar</button>
            <button type="button" style="background-color:red; margin:0.5%;"  class="btn">
            <a style="color:#FFF; text-decoration:none;" href="meus_treinamentos"><i class="fas fa-arrow-circle-left"></i> Voltar</a>
            </button>
            <select id="select-usuarios" name="usuarios_permitidos[]" multiple="multiple">
                <?php foreach($bigList as $key => $values){  // esse foreach puxa todos os usuarios da API
                  $bool = false; // variavel de controle
                  foreach($usuarios_permitidos as $permitido){ // foreach busca todos da lista de permitidos
                      if($permitido[1] == $key){ // compara com cada um dos que vem da API
                        $bool = true; // muda o status da variavel de controle caso encontre 
                      }// fim if de status
                  }// fim foreach status
                   if( $bool != true){// se mudou de status é porque já tem permissao, não exibe !!!
                  ?>
                <option value='<?=$key?>' data-section='<?=$values['grupo']?>' data-description=<?=$key?>><?=$values['nome']?></option>
                <?php
                   }// fim if de exibição
              }?>
            </select> 
    </form> 

    <script type="text/javascript">
      var $select = $('#select-usuarios');
      var time = new Date();
      console.profile('tree-multiselect');
      $select.treeMultiselect({ enableSelectAll: true, sortable: true, searchable: true });
      console.profileEnd();
      console.log("time elapsed - " + (new Date() - time) + "ms");
    </script>


       <script type="text/javascript">
      var $select = $('#select-usuarios-permitidos');
      var time = new Date();
      console.profile('tree-multiselect');
      $select.treeMultiselect({ enableSelectAll: true, sortable: true, searchable: true });
      console.profileEnd();
      console.log("time elapsed - " + (new Date() - time) + "ms");
    </script>
  </body>
</html>
