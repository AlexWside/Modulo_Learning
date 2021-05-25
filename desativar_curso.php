<?php
session_start();
require_once("model/arquivo_dao.php");
if (!isset($_SESSION['matricula'])) {
    die('Sem sessao! Favor logar novamente.');
}
$arquivo->desativar_curso($_POST['id'], $_POST['url']);
