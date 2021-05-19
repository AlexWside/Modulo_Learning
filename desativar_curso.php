<?php
session_start();
require_once("model/arquivo_dao.php");
$arquivo->desativar_curso($_POST['id'],$_POST['url']);

?>