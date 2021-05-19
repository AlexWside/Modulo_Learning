<?php
session_start();
require_once("model/Assunto_dao.php");
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);


if($nome != null){
    $Assunto->adicionar_assunto($nome,$_SESSION['nm_usuario']);
}else{
 header('Location:cadastro_assunto?params=null');
}

    
