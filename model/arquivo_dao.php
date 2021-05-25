<?php

require_once('controler/PDO_CON.php');

class Arquivo
{

   private $PDO;

   public function __construct($PDO)
   {

      $this->PDO = $PDO; // passagem da conexão pelo parametro do contrutor 
   } // fim construtor 


   public function adicionar_video($nome, $diretorio, $descricao, $titulo, $assunto, $tipo, $subtipo, $tempo) // pdo
   {
      $matricula_usuario = $_SESSION['matricula'];
      $setor = $_SESSION['set_usuario'];

      $sql = "INSERT INTO arquivos 
      (nome,diretorio,descricao,matricula_usuario,
      set_usuario,titulo,assunto,tipo,subtipo,tempo)
      VALUES(:nome, :diretorio, :descricao, :matricula_usuario,
      :set_usuario, :titulo, :assunto, :tipo, :subtipo, :tempo)";
      $stmt = $this->PDO->prepare($sql);
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':diretorio', $diretorio);
      $stmt->bindParam(':descricao', $descricao);
      $stmt->bindParam(':matricula_usuario', $matricula_usuario);
      $stmt->bindParam(':set_usuario', $setor);
      $stmt->bindParam(':titulo', $titulo);
      $stmt->bindParam(':assunto', $assunto);
      $stmt->bindParam(':tipo', $tipo);
      $stmt->bindParam(':subtipo', $subtipo);
      $stmt->bindParam(':tempo', $tempo);
      $result = $stmt->execute();

      if (!$result) {
         var_dump($stmt->errorInfo());
         exit;
      }
      header('Location:home');
   } // fim funçõo adicionar registro


   public function adicionar_permissao($matricula, $id_video) //pdo
   {
      $sql = "INSERT INTO permissao_video (matricula,id_video) VALUES(:matricula, :id_video)";
      $stmt = $this->PDO->prepare($sql);
      $stmt->bindParam(':matricula', $matricula);
      $stmt->bindParam(':id_video', $id_video);

      $result = $stmt->execute();

      if (!$result) {
         var_dump($stmt->errorInfo());
         exit;
      }
   } // fim funçõo adicionar permissao video

   public function buscar_permissao($id_video) //pdo
   {
      $sql = "SELECT * FROM permissao_video where id_video = '" . $id_video . "'";
      $result = $this->PDO->query($sql);
      $rows = $result->fetchAll();
      return $rows;
   } // fim funçõo buscar permissao videoi

   function buscar_usuario_permissao($id_video, $matricula){
      $sql = "SELECT * FROM permissao_video where id_video = '" . $id_video . "' and matricula = '".$matricula."'";
      $result = $this->PDO->query($sql);
      $rows = $result->fetch();
      //echo "<pre>"; print_r($rows); exit;
      return $rows;
   }


   public function apagar_permissao($parametro) //pdo
   {
      $sql = "DELETE FROM permissao_video WHERE id = :id";
      $stmt = $this->PDO->prepare($sql);
      $stmt->bindParam(':id', $parametro);

      $result = $stmt->execute();

      if (!$result) {
         var_dump($stmt->errorInfo());
         exit;
      }
   } // fim funçõo apagar permissao video 



   public function adicionar_edicao($video) //pdo
   {
      $id_curso   = $video['id_curso'];
      $titulo     = $video['titulo'];
      $assunto    = $video['assunto'];
      $tipo       = $video['tipo'];
      $subtipo    = $video['subtipo'];
      $tempo      = $video['tempo'];
      $descricao  = $video['descricao'];
      $matricula_usuario = $_SESSION['matricula'];
      $set_usuario = $_SESSION['set_usuario'];

      $sql = "UPDATE arquivos set 
      descricao = :descricao,
      matricula_usuario = :matricula,
      set_usuario = :set_usuario,
      titulo = :titulo,
      assunto = :assunto,
      tipo = :tipo,
      subtipo = :subtipo,
      tempo = :tempo
      WHERE id = :id";
      $stmt = $this->PDO->prepare($sql);
      $stmt->bindParam(':id', $id_curso);
      $stmt->bindParam(':titulo', $titulo);
      $stmt->bindParam(':assunto', $assunto);
      $stmt->bindParam(':tipo', $tipo);
      $stmt->bindParam(':subtipo', $subtipo);
      $stmt->bindParam(':tempo', $tempo);
      $stmt->bindParam(':descricao', $descricao);
      $stmt->bindParam(':matricula', $matricula_usuario);
      $stmt->bindParam(':set_usuario', $set_usuario);

      $result = $stmt->execute();

      if (!$result) {
         var_dump($stmt->errorInfo());
         exit;
      }

      return true;
   } // fim funçõo adicionar edicao



   public function buscar_video() // pdo
   {

      $sql = "SELECT * FROM arquivos ";
      $result = $this->PDO->query($sql);
      $rows = $result->fetchAll();
      return $rows;
   } // fim funçõo Buscar Todos 




   public function buscar_video_usuario($matricula) // pdo
   {

      $sql = "SELECT * FROM arquivos WHERE matricula_usuario = '" . $matricula . "'";
      $result = $this->PDO->query($sql);
      $rows = $result->fetchAll();
      return $rows;
   } // fim funçõo Busca por usuario




   public function desativar_curso($id, $url) //pdo
   {
      $sql = "UPDATE arquivos SET status = '1' where  id = :id";

      $stmt = $this->PDO->prepare($sql);
      $stmt->bindParam(':id', $id);
      $result = $stmt->execute();
      if (!$result) {
         var_dump($stmt->errorInfo());
         exit;
      }

      header("Location:$url");
   } // fim funçõo desativar curso 



   public function ativar_curso($id, $url) //pdo
   {
      $sql = "UPDATE arquivos SET status = '0' where  id = :id";

      $stmt = $this->PDO->prepare($sql);
      $stmt->bindParam(':id', $id);
      $result = $stmt->execute();
      if (!$result) {
         var_dump($stmt->errorInfo());
         exit;
      }

      header("Location:$url");
   } // fim funçõo ativar curso



   public function buscar_video_id($id) //pdo
   {
      $sql = "SELECT * FROM arquivos where id = '" . $id . "'";
      $result = $this->PDO->query($sql);
      $rows = $result->fetch();

      return $rows;
   } // fim funçõo Buscar video id


} //fim da classe

$arquivo = new Arquivo($PDO); // extanciando objeto da classe 
