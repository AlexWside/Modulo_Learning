<?php
session_start();
require_once("model/arquivo_dao.php");
$video = $arquivo->buscar_video_id($_POST['id_curso']);

$matricula = $_SESSION['matricula'];
$id_curso = $_POST['id_curso'];
$set_usuario = $_SESSION['set_usuario'];

require_once("model/usuario_dao.php");
$usuario->adicionar_conclusao($matricula,$id_curso,$set_usuario);

?>