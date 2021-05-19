<?php

require_once('controler/conexao.php');


class Arquivo{
   
    private $conn;


    public function __construct ($conn){
       $this ->conn = $conn;// passagem da conexão pelo parametro do contrutor 
   }// fim construtor 
   

   public function adicionar_video($nome,$diretorio,$descricao,$matricula_usuario,$setor,$titulo,$assunto,$tipo,$subtipo,$tempo){
       $this ->nome = $nome;
       $this ->diretorio = $diretorio;
       $result_usuario = "INSERT INTO arquivos 
       (nome,diretorio,descricao,matricula_usuario,set_usuario,titulo,assunto,tipo,subtipo,tempo) 
       VALUES ('$nome','$diretorio','$descricao','$matricula_usuario','$setor','$titulo','$assunto','$tipo','$subtipo','$tempo')";
       mysqli_query($this->conn,$result_usuario);
   
      header('Location:home');
   }// fim funçõo adicionar registro


   public function adicionar_permissao($matricula,$id_video){
      
      $result_usuario = "INSERT INTO permissao_video (matricula,id_video) VALUES ('$matricula','$id_video')";
      mysqli_query($this->conn,$result_usuario);
   }// fim funçõo adicionar permissao video

   public function buscar_permissao($id_video){
   $result_usuario = "SELECT * FROM permissao_video where id_video = '$id_video'";
    $result_bd = $this->conn->query($result_usuario);
    $lista = mysqli_fetch_all($result_bd);
    return $lista;
   }// fim funçõo buscar permissao videoi


   public function apagar_permissao($parametro){
      $result_usuario = "DELETE FROM permissao_video WHERE id = '$parametro'";
      mysqli_query($this->conn,$result_usuario);
   }// fim funçõo apagar permissao video 



   public function adicionar_edicao($video){ 
      $id_curso   = $video['id_curso'];
      $titulo     = mysqli_real_escape_string($this->conn,$video['titulo']);
      $assunto    = $video['assunto'];
      $tipo       = $video['tipo'];
      $subtipo    = $video['subtipo'];
      $tempo      = $video['tempo'];
      $descricao  = $video['descricao'];
      $matricula_usuario = $_SESSION['matricula'];
      $set_usuario = $_SESSION['set_usuario'];

      $result_usuario = "UPDATE arquivos SET 
                              descricao = '$descricao' , 
                              matricula_usuario = '$matricula_usuario' , 
                              set_usuario = '$set_usuario', 
                              titulo= '$titulo' , 
                              assunto= '$assunto',
                              tipo = '$tipo',
                              subtipo='$subtipo',
                              tempo = '$tempo' 
                           WHERE id = '$id_curso' ";

 

     if(mysqli_query($this->conn,$result_usuario)){
        return true;
     }else{
        return false;
     }
   }// fim funçõo adicionar edicao



   public function buscar_video(){      
       $result_usuario = "SELECT * FROM arquivos ";
       $result_bd = $this->conn->query($result_usuario);
       $lista = mysqli_fetch_all($result_bd);
       return $lista;
   }// fim funçõo Buscar Todos




   public function buscar_video_usuario($parametro){ 
      $result_usuario = "SELECT * FROM arquivos where matricula_usuario = '$parametro'";
      $result_bd = $this->conn->query($result_usuario);
      $lista = mysqli_fetch_all($result_bd);
      return $lista;
   }// fim funçõo Busca por usuario



   public function apagar_arquivo($parametro,$url){
    $result_usuario = "DELETE FROM arquivos WHERE id = '$parametro'";
   mysqli_query($this->conn,$result_usuario);
   header("Location:$url");
   }// fim funçõo Buscar Por Titulo



   public function desativar_curso($parametro,$url){
      $result_usuario = "UPDATE arquivos SET status = '1' where  id = '$parametro'";
     mysqli_query($this->conn,$result_usuario);
     header("Location:$url");
   }// fim funçõo desativar curso 



   public function ativar_curso($parametro,$url){
      $result_usuario = "UPDATE arquivos SET status = '0' where  id = '$parametro'";
     mysqli_query($this->conn,$result_usuario);
     header("Location:$url");
   }// fim funçõo ativar curso



   public function buscar_video_id($parametro){   
    $result_usuario = "SELECT * FROM arquivos where id = '$parametro'";
    $result_bd = $this->conn->query($result_usuario);
    $lista = mysqli_fetch_assoc($result_bd);
    return $lista;
   }// fim funçõo Buscar video id


}//fim da classe

   $arquivo = new Arquivo($conn); // extanciando objeto da classe 
   

?>