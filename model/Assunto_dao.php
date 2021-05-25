<?php

require_once('controler/PDO_CON.php');

class Assunto
{

   private $PDO;

   public function __construct($PDO)
   {
      $this->PDO = $PDO; // passagem da conexão pelo parametro do contrutor 
   } // fim construtor 

   public function adicionar_assunto($nome) //pdo
   {
      $matricula_usuario  = $_SESSION['matricula'];
      $sql = "INSERT INTO assunto (nome,usuario_matricula,created) VALUES(:nome, :matricula,now())";
      $stmt = $this->PDO->prepare($sql);
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':matricula', $matricula_usuario);

      $result = $stmt->execute();

      if (!$result) {
         var_dump($stmt->errorInfo());
         exit;
      }
      header('Location:home');
   } // fim funçõo adicionar registro


   public function buscar_assunto() //pdo
   {

      $sql = "SELECT * FROM assunto ";
      $result = $this->PDO->query($sql);
      $rows = $result->fetchAll();
      return $rows;
   } // fim funçõo Buscar Todos


   public function desativar_assunto($id, $url) //pdo
   {
      $sql = "UPDATE assunto SET status = '1' where  id = :id";

      $stmt = $this->PDO->prepare($sql);
      $stmt->bindParam(':id', $id);
      $result = $stmt->execute();
      if (!$result) {
         var_dump($stmt->errorInfo());
         exit;
      }
   } // fim funçõo desativar assunto

   public function ativar_assunto($id, $url) //pdo
   {
      $sql = "UPDATE assunto SET status = '0' where  id = :id";

      $stmt = $this->PDO->prepare($sql);
      $stmt->bindParam(':id', $id);
      $result = $stmt->execute();
      if (!$result) {
         var_dump($stmt->errorInfo());
         exit;
      }
   } // fim funçõo ativar assunto


   public function buscar_usuario_assunto() //pdo
   {

      $matricula = $_SESSION['matricula'];

      $sql = "SELECT DISTINCT a.assunto 
      FROM arquivos a,permissao_video b 
      WHERE a.id = b.id_video and b.matricula = '" . $matricula . "' and a.status = 0";

      $result = $this->PDO->query($sql);
      $rows = $result->fetchAll();
      return $rows;
   } // fim funçõo Buscar Todos

   public function buscar_usuario_assunto_coint($assunto) //pdo
   {

      $matricula = $_SESSION['matricula'];

      $sql = "SELECT a.assunto 
      FROM arquivos a,permissao_video b 
      WHERE a.id = b.id_video and b.matricula = '" . $matricula . "' and a.status = 0 and a.assunto = '" . $assunto . "'";

      $result = $this->PDO->query($sql);
      $rows = $result->fetchAll();
      return count($rows);
   } // contador para fins futeis

   public function buscar_assunto_id($id) //pdo
   {
      $sql = "SELECT * FROM assunto where id = '" . $id . "' ";

      $result = $this->PDO->query($sql);
      $rows = $result->fetch();
      return $rows;
   } // fim funçõo Buscar nome usuario pela matricula




} //fim da classe

$Assunto = new Assunto($PDO);//instancia o objeto assunto
