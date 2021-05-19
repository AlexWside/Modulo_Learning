<?php 
    session_start();
    require_once("model/usuario_dao.php");

    $login = $usuario->login( $_POST['login'], $_POST['senha'] );
    

    if($login != null ){
    $_SESSION['autentication']= 's';   
    $_SESSION['matricula'] =   $login['matricula'];
    $_SESSION['nm_usuario'] = $login['nome'];
    $_SESSION['set_usuario'] = $login['grupo'];
    header('Location: carregamento');
    }
    

   //$_SESSION['autentication']= 'n'; pendente de tratamento
    
   //header('Location: index.php?return=Invalido');
?>
