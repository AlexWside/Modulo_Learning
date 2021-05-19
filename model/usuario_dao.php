<?php
require_once('controler/conexao.php');

// inicio da classe usuario
class Usuario{
 
 private $conn;
 public function __construct ($conn){
    $this ->conn = $conn;// passagem da conexão pelo parametro do contrutor 
}// fim construtor 

public function adicionar_usuario($nome,$login,$senha,$setor){
    
    $result_usuario = "INSERT INTO usuario (nome,login,senha,created,setorusuario) VALUES ('$nome','$login','$senha',now(),'$setor')";
    mysqli_query($this->conn,$result_usuario);

   header('Location:index?valor="sucess"');
}// fim funçõo adicionar registro
public function buscar_usuario(){
    
    $result_usuario = "SELECT * FROM usuario";
    $result_bd = $this->conn->query($result_usuario);
    $lista = mysqli_fetch_all($result_bd);
    return $lista;
   
}// fim funçõo Buscar Todos

public function Alterar_senha($parametro, $idusuario){
//echo "<pre>"; print_r($parametro); exit;
    $result_usuario = "UPDATE usuario SET senha = '$parametro' WHERE id = '$idusuario'";
//    echo "<pre>"; print_r($result_usuario); exit;
    $result_bd = $this->conn->query($result_usuario);
   //header('Location:novo_registro.php');
}// fim funçõo Buscar Por Titulo


public function apagar_registro($parametro,$url){
    //echo "<pre>"; print_r($parametro); exit;
    //    echo "<pre>"; print_r($result_usuario); exit;
    $result_usuario = "DELETE FROM usuario WHERE id = '$parametro'";
    mysqli_query($this->conn,$result_usuario);
    header("Location:$url");
    }// fim funçõo Buscar Por Titulo


    public function buscar_usuario_adm(){
    
        $result_usuario = "SELECT * FROM permissao_adm";
        $result_bd = $this->conn->query($result_usuario);
        $lista = mysqli_fetch_all($result_bd);
        return $lista;
       
    }// fim busca os usuarios com permissão adm 

    public function adicionar_conclusao($matricula,$idcurso,$setusuario){
       
        $result_usuario = "INSERT INTO concluido (matricula_usuario,id_curso,set_usuario,created) VALUES ('$matricula','$idcurso','$setusuario',now())";
        mysqli_query($this->conn,$result_usuario);
    
      header('Location:parabens?valor="sucess"');
    }// fim funçõo adicionar registro

    public function buscar_conclusao($matricula,$idcurso ){
       
        $result_usuario = "SELECT * FROM concluido where matricula_usuario = '$matricula' and id_curso = '$idcurso' ";
        $result_bd = $this->conn->query($result_usuario);
        $lista = mysqli_fetch_row($result_bd);
        
        return $lista;
       
       }// fim funçõo Buscar conclusao matricula

       public function buscar_conclusoes($idcurso ){
       
        $result_usuario = "SELECT * FROM concluido where id_curso = '$idcurso' ";
        $result_bd = $this->conn->query($result_usuario);
        $lista = mysqli_fetch_all($result_bd);
        return $lista;
       
       }// fim funçõo Buscar conclusao matricula
       
       public function buscar_nome_usuario($matricula){
        require_once './ROTAS/curl.php';
        $url = "url da api com parametros";
                $params = "" ;
                $tipo = 'GET';
                $autenticado = curl($url, $params, $tipo);
                return  $autenticado[$matricula];
       }// fim funçõo Buscar nome usuario pela matricula

       public function login( $usuario, $senha ){

            require_once './ROTAS/curl.php';

            $url = "url da api com parametros";

            $params = array('senha' => $senha);
            
            $tipo = 'POST';

            //echo "<pre>"; print_r("teste"); exit;

            $resposta = curl($url, $params, $tipo);
            
            if($resposta['msg'] == 'autenticado'){
                $url = "url da api com parametros";
                $params = "" ;
                $tipo = 'GET';
                $autenticado = curl($url, $params, $tipo);

                return  $autenticado[$usuario];
                // echo "<pre>"; print_r($autenticado); exit;
            }else{

                return null;

            }

            //echo "<pre>"; print_r($resposta); exit;
       }// fim login

       function buscar_todos_usuarios (){
        require_once './ROTAS/curl.php';
        $url = ' url da api com parametros';
        $params = "";
        $tipo = 'GET';
        $resposta = curl($url, $params, $tipo);
        return $resposta;
       }

}// fim classe usuario

$usuario = new Usuario($conn);// instância do objeto usuario