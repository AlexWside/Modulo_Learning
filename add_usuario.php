<?php
session_start();
require_once("model/usuario_dao.php");
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$setor = filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_STRING);
$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
$filtrosenha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$senha = password_hash($filtrosenha,PASSWORD_DEFAULT);

    $usuario->adicionar_usuario($nome,$login,$senha,$setor);
