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
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <title>Reprodutor</title>
    <style>
    body{
        background-color:#FFF;
        font-family: 'Poppins', sans-serif;
    }
    .btn{
       
        border-radius: 30px;
        
        border: none;
        background-color:#008000;
        color:#FFF;
        width:10em;
        height:3em;
        
    }
    #idSubmit:hover{
        color:#FFF;
        background:#3CB371;
        
    }
    video{
        border-style: solid;
        border-size:1em;
        border-radius:10px;
        border-color:white;
        background-color:black;
        margin:2em 0;
        box-shadow: 10px 5px 15px black;
        
    }
    .container-video{
        width:100%;
       
        display: flex;
        justify-content:center;
        overline:none;
        background-image: url('img/bg2.jpg');
        
    }
    </style>

</head>
<body>
<?php

require_once("model/arquivo_dao.php");
$video = $arquivo->buscar_video_id($_POST['id_curso']);

?>
<div class="container-video">



    <video width="800" height="500" controls autoplay controlsList="nodownload" >
    <source src="<?=$video['diretorio']?>" >
    
    Navegador incompativel.
    </video>
    
   
</div>
<button style="background-color:red; margin:0.5%;"  class="btn">
<a style="color:#FFF; text-decoration:none;" href="home"><i class="fas fa-arrow-circle-left"></i> Voltar</a>
</button>


<?php // tag para buscar se usuario já concluiu o curso
require_once("model/usuario_dao.php");
$conclusao = $usuario->buscar_conclusao($_SESSION['matricula'],$video['id']);
    if($conclusao != null){                
?>
     <div style="color:green;float:right;margin:1.2%;"> CURSO CONCLUIDO</div>
<?php // else da verificação
        }else{
?>
<form style="float:right;margin:0.5%;" action="add_conclusao" method="POST">
<input type="hidden" name="id_curso" value=<?=$video['id']?>>
<button  type='submit'  id="idSubmit" class="btn">
    Concluir <i class="fas fa-arrow-circle-right"></i>
</button>
</form>
<?php // fim  tag para saber se usuario concluiu o curso
        }
?>
<script>
// script to timer 
var tempo = ( <?=$video['tempo']?> *1000) *60;
$('#idSubmit').hide();

setTimeout(function(){ 
    $('#idSubmit').show();
}, tempo );

</script>

</body>
</html>