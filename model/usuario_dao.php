<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

require_once('controler/PDO_CON.php');

// inicio da classe usuario
class Usuario
{

    private $PDO;
    public function __construct($PDO)
    {
        $this->PDO = $PDO; // passagem da conexão pelo parametro do contrutor 

    } // fim construtor 



    public function buscar_usuario_adm() //pdo
    {
        $sql = "SELECT * FROM permissao_adm";
        $result = $this->PDO->query($sql);
        $rows = $result->fetchAll();
        return $rows;
    } // fim busca os usuarios com permissão adm 



    public function adicionar_conclusao($idcurso) //pdo
    {
        $matricula = $_SESSION['matricula'];
        $setusuario = $_SESSION['set_usuario'];

        $sql = "INSERT INTO concluido (matricula_usuario,id_curso,set_usuario,created) VALUES(:matricula,:idcurso,:setor, now())";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':idcurso', $idcurso);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':setor', $setusuario);

        $result = $stmt->execute();

        if (!$result) {
            var_dump($stmt->errorInfo());
            exit;
        }
        return true;
    } // fim funçõo adicionar registro



    public function adicionar_avaliacao($avaliacao, $idcurso) //pdo
    {
        $matricula = $_SESSION['matricula'];

        $sql = "UPDATE concluido SET avaliacao = :avaliacao where  id_curso = :idcurso and matricula_usuario = :matricula";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':avaliacao', $avaliacao);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':idcurso', $idcurso);

        $result = $stmt->execute();

        if (!$result) {
            var_dump($stmt->errorInfo());
            exit;
        }

        return true;
    } //  fim adicionar avaliacao 



    public function buscar_conclusao($matricula, $idcurso) //pdo
    {
        $sql = "SELECT * FROM concluido where matricula_usuario = '" . $matricula . "' and id_curso = '" . $idcurso . "' ";
        $result = $this->PDO->query($sql);
        $rows = $result->fetch();
        return $rows;
    } // fim funçõo Buscar conclusao matricula



    public function buscar_conclusoes($idcurso) //pdo
    {
        $sql = "SELECT * FROM concluido where id_curso = '" . $idcurso . "' ";
        $result = $this->PDO->query($sql);
        $rows = $result->fetchAll();
        return $rows;
    } // fim funçõo Buscar conclusao matricula



    public function buscar_nome_usuario($matricula) // api
    {
        require_once './ROTAS/curl.php';
        $url = "DIGITE AQUI A URL DA API";
        $params = "";
        $tipo = 'GET';
        $autenticado = curl($url, $params, $tipo);
        return  $autenticado[$matricula];
    } // fim funçõo Buscar nome usuario pela matricula



    public function login($usuario, $senha) // api
    {

        require_once './ROTAS/curl.php';

        $url = "DIGITE AQUI A URL DA API";

        $params = array('senha' => $senha);

        $tipo = 'POST';

        $resposta = curl($url, $params, $tipo);

        if ($resposta['msg'] == 'autenticado') {
            $url = "DIGITE AQUI A URL DA API";
            $params = "";
            $tipo = 'GET';
            $autenticado = curl($url, $params, $tipo);

            return  $autenticado[$usuario];
        } else {

            return null;
        }
    } // fim login



    function buscar_todos_usuarios() // api
    {
        require_once './ROTAS/curl.php';
        $url = "DIGITE AQUI A URL DA API";
        $params = "";
        $tipo = 'GET';
        $resposta = curl($url, $params, $tipo);
        return $resposta;
    }
} // fim classe usuario



$usuario = new Usuario($PDO);// instância do objeto usuario