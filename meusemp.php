<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
  <link rel="icon" type="image/png" href="images/icons/icon.ico"/>
  <title>Meus anúncios</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
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
    $id = $exibe["idUser"];
    $choose = $exibe["escolha"];
    if ($choose == "0"){
      echo "<script>window.location.href = 'escolha.php';</script>";
    }
    if($choose == "1"){
      echo "<script>window.location.href = 'anuncios.php';</script>";
    }
    $perfil = $exibe["avatar"];
    $namec = $exibe["nome"];
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
      <ul>
        <li class="passando">
          <a href="anuncios.php">
            <span class="ti-home"></span>
            <span>Anúncios</span>
          </a>
        </li>
        <li class="passando">
          <a href="info.php">
            <span class="ti-settings"></span>
            <span>Conta</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div class="maain-content">
    <header>
      <div class="seearch-wrapper">
        <span class="ti-search" hidden></span>
        <input type="search" placeholder="Search" name="" hidden>
      </div> 

      <div class="soocial-icons">
        <span class="ti-bell poointer"></span>
        <span class="ti-comments poointer"></span>
        <div class="poointer">
          <img src="images/img_perfil/<?php echo $perfil;?>">
        </div>
        <p class="nome_ poointer" id="dropdownMenuButton2" data-bs-toggle="dropdown"><?php echo $namec;?>
          <i class="fas fa-caret-down"></i>
        </p>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
          <?php
            if ($choose == "1"){
              echo '<li><a class="dropdown-item" href="meus.php">Meus anúncios</a></li>';
            }else{
              echo '<li><a class="dropdown-item" href="meusemp.php">Meus autônomos</a></li>';
            }
          ?>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="desconectar.php">Sair</a></li>
        </ul>
      </div>
    </header>

    <main class="main">

      <h2 class="daash-title">Meus autônomos</h2>

        <div class="daash-cards">
          <?php
          $i=0;
          //$sql = mysqli_query($conecta, "select * from usuario INNER JOIN anuncio ON usuario.idUser = anuncio.idUser WHERE email = '$logado'");
          $sql = mysqli_query($conecta, "select * from anuncio INNER JOIN usuario ON anuncio.idUser = usuario.idUser WHERE contratante='$id'");
          while($exibe = mysqli_fetch_assoc($sql)){
            $idPostagem[$i] = $exibe["idAnuncio"];
            $nomeA[$i] = $exibe["nome"];
            $nomeB[$i] = $exibe["sobrenome"];
            $emprego[$i] = $exibe["emprego"];

            echo '  <div class="caard-single">
                      <div class="caard-body">
                        <span class="ti-briefcase"></span>
                        <div>
                          <h4>'.$nomeA[$i]." ".$nomeB[$i].'</h4>
                          <h5>'.$emprego[$i].'</h5>
                        </div>
                      </div>
                      <div class="caard-footer">
                          <button class="butao d-flex justify-content-center align-items-center">Mensagem</button>
                      </div>
                    </div>';
            $i++;
          }
          ?> 
        </div>
    </main>
  </div>
  <script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>
  <script type="text/javascript" src="//assets.locaweb.com.br/locastyle/2.0.6/javascripts/locastyle.js"></script>
  <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>