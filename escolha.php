<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
  <link rel="icon" type="image/png" href="images/icons/icon.ico"/>
  <title>Escolher Modo de Conta</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <?php 
  session_start();
  include_once "conectar.php";
  if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
    session_unset();
    echo "<script>window.location.href = 'index.php';</script>";
  }
  $logado = $_SESSION['email'];
  $sql = mysqli_query($conecta, "select * from usuario where email ='$logado'");
  while($exibe = mysqli_fetch_assoc($sql)){
    $choose = $exibe["escolha"];
    if ($choose != "0"){
      echo "<script>window.location.href = 'anuncios.php';</script>";
    }
  }
  ?>
</head>
<body>
  <input type="checkbox" id="siidebar-toggle">
  <div class="siidebar">
    <div class="siidebar-header">
      <h3 class="brand">
        <span class="ti-unlink"></span>
        <span>Quebra-Galho</span>
      </h3>
      <label for="siidebar-toggle" class="ti-menu-alt"></label>
    </div>

    <div class="siidebar-menu">
      
    </div>
  </div>

  <div class="maain-content">
    <!-- <header>
      <div class="seearch-wrapper">
        <span class="ti-search"></span>
        <input type="search" placeholder="Search" name="">
      </div>

      <div class="soocial-icons">
        <span class="ti-bell"></span>
        <span class="ti-comments"></span>
        <div></div>
      </div>
    </header> -->

    <main class="main">

      <h2 class="daash-title">Escolher um modo de conta</h2>
      <?php
      if (isset($_POST['escolher'])){
        $escolha = $_POST['escolha'];
        $tenta_achar = "SELECT * FROM usuario WHERE email='$logado'";
        $resultados = $conecta->query($tenta_achar);
        if ($resultados->num_rows == 1){
          if ($escolha == 1){
            $sql = "UPDATE usuario SET escolha='1' WHERE email='$logado'";
            if ($conecta->query($sql) === TRUE){
              echo "<script>window.location.href = 'info.php';</script>";
            }
          }
          if ($escolha == 2){
            $sql = "UPDATE usuario SET escolha='2' WHERE email='$logado'";
            if ($conecta->query($sql) === TRUE){
              echo "<script>window.location.href = 'info.php';</script>";
            }
          }
        }
      }
      $conecta->close();
      ?>
        <div class="daash-cardsteste">
          <div class="caard-single">
            <div class="caard-body">
              <span class="ti-briefcase"></span>
              <div>
                <h4>TRABALHADOR AUTÔNOMO</h4>
                <h5>Procurar uma oportunidade de emprego</h5>
              </div>
            </div>
            <div class="caard-footer">
              <form class="login100-form validate-form flex-sb flex-w" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" name="escolha" value="1" hidden>
                <button name="escolher" class="butao d-flex justify-content-center align-items-center">Escolher</button>
              </form>
            </div>
          </div>

          <div class="caard-single">
            <div class="caard-body">
              <span class="ti-briefcase"></span>
              <div>
                <h4>CONTRATANTE</h4>
                <h5>Buscando contratar profissionais autônomos</h5>
              </div>
            </div>
            <div class="caard-footer">
              <form class="login100-form validate-form flex-sb flex-w" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" name="escolha" value="2" hidden>
                <button name="escolher" class="butao d-flex justify-content-center align-items-center">Escolher</button>
              </form>
            </div>
          </div>
        </div>
    </main>
  </div>
</body>
</html>