<nav style="background:#006400/*#126F47 #00995D*/ !important; box-shadow: 10px 5px 15px black;" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <img style="border-radius:50%; width:50px; margin:0 1%;" src="img/logo-unimed.png" alt=""><a href="home" class="navbar-brand">UNILearning <span style="color:#FFF;"></span></a>
  <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div id="my-nav" class="collapse navbar-collapse">
    <ul style="display: flex; align-items: center;" class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" style="color:#FFF;" href="home">Inicio<span class="sr-only"></span></a>
      </li>
      <?php
      require_once("model/usuario_dao.php");
      $Lista = $usuario->buscar_usuario_adm();
      $cont = 0;
      foreach ($Lista as $user) {
        if ($_SESSION['matricula'] == $user[1]) {
          $cont = 1;
          $statusadm = $user[3];
        } // compara se ah usuarios com permissão para visualizar a opção postar
      }

      if ($cont != 0 && $statusadm == 0) { // caso o contador for diferente de 0 é pq ele encontrou alguem dentro da busca 

      ?>
        <li class="nav-item active">
          <a class="nav-link" style="color:#FFF;" href="postar">Postar<span class="sr-only"></span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" style="color:#FFF;" href="meus_treinamentos">Meus Treinamentos<span class="sr-only"></span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" style="color:#FFF;" href="cadastro_assunto">Novo Assunto<span class="sr-only"></span></a>
        </li>
      <?php
      }
      ?>
      <li class="nav-item active">
        <a class="nav-link" style="color:#FFF;" href="logout.php">Sair<span class="sr-only"></span></a>
      </li>
    </ul>
  </div>
</nav>