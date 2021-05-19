<?php

require_once('controler/conexao.php');
class Assunto{
    
   private $conn;
   public function __construct ($conn){
       $this ->conn = $conn;// passagem da conexão pelo parametro do contrutor 
   }// fim construtor 
   
   public function adicionar_assunto($nome,$matricula_usuario){
      echo $nome;
      echo $matricula_usuario;
      $result_usuario = "INSERT INTO assunto (nome,usuario_matricula,created) 
      VALUES ('$nome','$matricula_usuario',now())";
      mysqli_query($this->conn,$result_usuario);
      header('Location:home');
   }// fim funçõo adicionar registro


   public function buscar_assunto(){  
       $result_usuario = "SELECT * FROM assunto ";
       $result_bd = $this->conn->query($result_usuario);
       $array=array();
       while( $lista = mysqli_fetch_assoc($result_bd) ){
          $array[] = $lista;
       }
       return $array;
      //header('Location:novo_registro.php');
   }// fim funçõo Buscar Todos


   public function desativar_assunto($parametro,$url){
      $result_usuario = "UPDATE arquivos SET status = '1' where  id = '$parametro'";
      // UPDATE `arquivos` SET `status` = '0' WHERE `arquivos`.`id` = 94;
      mysqli_query($this->conn,$result_usuario);
      header("Location:$url");
     }// fim funçõo desativar assunto

   public function ativar_assunto($parametro,$url){
      $result_usuario = "UPDATE arquivos SET status = '0' where  id = '$parametro'";
      mysqli_query($this->conn,$result_usuario);
      header("Location:$url");
   }// fim funçõo ativar assunto


  public function buscar_usuario_assunto(){   
      $matricula = $_SESSION['matricula'];
      $result_usuario = "SELECT DISTINCT a.assunto 
      FROM arquivos a,permissao_video b WHERE a.id = b.id_video and b.matricula = '$matricula' and a.status = 0";
      //SELECT DISTINCT a.assunto, a.status FROM `arquivos` a,`permissao_video` b WHERE a.id = b.id_video and b.matricula = 'mattst'
      $result_bd = $this->conn->query($result_usuario);

      $array=array();
         while( $lista = mysqli_fetch_assoc($result_bd) ){
            $array[] = $lista;
         }
         return $array;
   }// fim funçõo Buscar Todos



  public function buscar_assunto_id($id){
      $result_usuario = "SELECT * FROM assunto where id = '$id' ";
      $result_bd = $this->conn->query($result_usuario);
      $lista = mysqli_fetch_assoc($result_bd);
      return $lista;
  }// fim funçõo Buscar nome usuario pela matricula




}//fim da classe

   $Assunto = new Assunto($conn);
   

?>