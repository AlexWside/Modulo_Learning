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

    <title>UNILearning - Visualizações do Treinamento</title>
    <style>
        body {
            background-color: #fff;
            background-image: url('img/bg2.jpg');
        }

        .btn {

            border-radius: 30px;
            margin: 0.5%;
            border: solid;
            background-color: #008000;
            color: #FFF;
            width: 10em;
            height: 3em;
            
        }
        @media print{
            .titulo{
                -webkit-print-color-adjust: economy; color:black !important;
            } 
            .table{
                -webkit-print-color-adjust: economy;color: black !important;
            }
            .print, .btn{
                display: none;
            }
        }
        .titulo {
            margin-top: 1.5em;
            background-color: #126F47;
            height: 5em;
            color: #fff;
            display:flex;
            
             justify-content:center;
             align-items: center;
        }
        .print{
            color:red;
            background-color: #fff;
            border-radius:10px;
            border:none; 
            float: left;
            font-size: 1.2em;
            margin-left: 2em;
            width: 2em;
            height: 2em;
        }
    </style>
</head>

<body>
    <?php
    require_once("model/arquivo_dao.php");
    $curso = $arquivo->buscar_video_id($_POST['id_curso']);
    
    ?>
    <div class="titulo">
        <h4><?= $curso['titulo'] ?></h4>
        <button class="print" onClick="window.print()"><i class="fas fa-print"></i></button>
    </div>
    <table class="table table-light">
        <tbody>
            <tr>
                <td>
                    Nome
                </td>
                <td>
                    Matricula
                </td>
                <td>
                    setor
                </td>
                <td>
                    Data
                </td>
                <td>
                    Avaliação
                </td>
                <td>
                    Status
                </td>
            </tr>

            <?php
            require_once("model/usuario_dao.php");
            $lista = $usuario->buscar_conclusoes($_POST['id_curso']);
            foreach ($lista as $user) {
            ?>
                <tr>
                    <td>
                        <?= $usuario->buscar_nome_usuario($user[1])['nome'] ?>
                    </td>
                    <td>
                        <?= $user[1] ?>
                    </td>
                    <td>
                        <?= $user[3] ?>
                    </td>
                    <td>
                        <?= $user[4] ?>
                    </td>
                    <td>
                    <?= $user[5] ?>/5
                    </td>
                    <td>
                        Concluido <span style="color:#008000;"><i class="fas fa-check-circle"></i></span>
                    </td>
                </tr>

            <?php
            }
            ?>
<!---teste ---->
            <?php
            $usuarios_permitidos = $arquivo->buscar_permissao($_POST['id_curso']);
            foreach ($usuarios_permitidos as $usuarios_pendentes) {
                $bool = false;
                foreach($lista as $user){
                    if($user[1] == $usuarios_pendentes['matricula']){
                        $bool = true;
                    }
                }// fim foreach bool
                if($bool == false){
                ?>
                    <tr>
                        <td>
                            <?= $usuario->buscar_nome_usuario($usuarios_pendentes['matricula'])['nome'] ?>
                        </td>
                        <td>
                            <?= $usuarios_pendentes['matricula'] ?>
                        </td>
                        <td>
                            <?= $usuario->buscar_nome_usuario($usuarios_pendentes['matricula'])['grupo'] ?>
                        </td>
                        <td>
                            ---
                        </td>
                        <td>
                            ---
                        </td>
                        <td>
                            Pendente <span style="color:red;"><i class="fas fa-times-circle"></i></span>
                        </td>
                    </tr>
    
                <?php
                    }
                }
                ?>
<!---teste ---->          
        </tbody>
    </table>

    <div class="text-center">


        <button class="btn">
            <a style="color:#FFF; text-decoration:none;padding:25px 60px;" href="meus_treinamentos"> OK</a>
        </button>

    </div>

</body>

</html>