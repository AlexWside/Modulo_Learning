<?php
session_start();
require_once('autentica_sessao.php');
require_once("model/usuario_dao.php");

//////////
if (!isset($_SESSION['matricula'])) {
    die('Sem sessao! Favor logar novamente.');
}


$id_curso = $_POST['id_curso'];



//acao de estrelas
if (isset($_POST['acao']) && $_POST['acao'] == 'avaliar') {

    //echo "<pre>"; print_r($_POST); exit;
    if ($usuario->buscar_conclusao($_SESSION['matricula'], $id_curso)) {// imicio adiciona conclusão
        echo ("<div style='color:#fff;'>Treinamento concluido</div>");
    } else {
        if ($usuario->adicionar_conclusao($id_curso)) {
            echo "<div style='color:#fff;'>Treinamento concluido com sucesso!!!</div>";
        } else {
            die("Erro a concluir video");
        }
    }// adiciona conclusão


    if ($usuario->adicionar_avaliacao($_POST['estrelas'], $id_curso)) {// inicio adiciona avaliação
        header('Location:home');
    } else {
        die('Erro ao avaliar o video');
    }// fim adiociona avaliação
    

}



//////
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo-unimed.png">
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
    <!---estrelinhas -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <!--fim estrelinha -->
    <title>UNILearning - Avaliação</title>
    <style>
        body {
            background-image: url('img/bg2.jpg');
            font-family: 'Poppins', sans-serif;
        }

        .btn {

            border-radius: 30px;
            margin: 0.5%;
            border: none;
            background-color: #008000;
            color: #FFF;
            width: 10em;
            height: 3em;

        }

        .container-parabens {
            width: 100%;
            margin-top: 10em;
            color: #fff;


        }

        h1 {
            font-size: 8em;
        }
    </style>

</head>

<body>

    <div class="text-center container-parabens">
        <h1>PARABÉNS</h1>
        <center>
            <div id="rateYo"></div>
        </center>
        <p>você concluiu este treinamento, avalie seu treinamento aqui.</p>



        <form action="" method="POST">
            <input type="hidden" name="acao" value='avaliar'>
            <input type="hidden" name="id_curso" value=<?= $id_curso ?>>
            <input type="hidden" name="estrelas" id="estrelas" value='5'>
            <button type="submit" style="background-color:#008000;" class="btn">
                OK
            </button>
        </form>


    </div>


    <script>
        $(function() {

            $("#rateYo").rateYo({
                rating: 5.0
            });

        });
        // inicializações//  <a style="color:#FFF; text-decoration:none;padding:25px 60px;" href="home"> OK</a>
        $(function() {

            $("#rateYo").rateYo({
                starWidth: "150px"
            });

            // Getter
            var starWidth = $("#rateYo").rateYo("option", "starWidth"); //returns 40px

            // Setter
            $("#rateYo").rateYo("option", "starWidth", "50px"); //returns a jQuery Element
        });

        //
        $(function() {

            $("#rateYo").rateYo()
                .on("rateyo.set", function(e, data) {
                    document.getElementById('estrelas').value = data.rating;
                });
        });
    </script>
</body>

</html>