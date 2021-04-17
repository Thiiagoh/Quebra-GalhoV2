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
    $choose = $exibe["escolha"];
    if ($choose == "0"){
      echo "<script>window.location.href = 'escolha.php';</script>";
    }
    if($choose == "2"){
      echo "<script>window.location.href = 'anuncios.php';</script>";
    }
    $perfil = $exibe["avatar"];
    $namec = $exibe["nome"];
  }
  $off="hidden";
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
              echo '<li><a class="dropdown-item" href="#">Meus interesses</a></li>';
            }
          ?>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="desconectar.php">Sair</a></li>
        </ul>
      </div>
    </header>

    <main class="main">

      <h2 class="daash-title">Anúncios ativos</h2>

        <div class="daash-cards">
          <?php
          $i=0;

          $sql = mysqli_query($conecta, "select * from usuario INNER JOIN anuncio ON usuario.idUser = anuncio.idUser WHERE email = '$logado'");
          while($exibe = mysqli_fetch_assoc($sql)){
            $idPostagem[$i] = $exibe["idAnuncio"];
            $nomeA[$i] = $exibe["nome"];
            $nomeB[$i] = $exibe["sobrenome"];
            $emprego[$i] = $exibe["emprego"];
            $detalhes[$i] = $exibe["detalhes"];
            $idUser[$i] = $exibe["idUser"];
            $status[$i] = $exibe["status"];

            $delet[$i] = "DELETE FROM anuncio WHERE idAnuncio='$idPostagem[$i]' AND idUser='$idUser[$i]'";

            if($status[$i] == "Em aberto"){
              echo '<div class="modal fade" id="a'.$idPostagem[$i].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Anúncio de Serviço</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="empregorem.php" method="POST">
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="exampleFormControlInput1">Emprego</label>
                                <input class="form-control" type="text" name="nome_emprego" placeholder="Informe o emprego" value="'.$emprego[$i].'" maxlength="45" required>
                                <input type="text" name="iddaconta" value="'.$idPostagem[$i].'" hidden>
                                <input type="text" name="deletar" value="'.$delet[$i].'" hidden>
                              </div>
                              
                              <div class="form-group">
                                <div class="mb-3">
                                  <label for="message-text" class="col-form-label">Detalhes</label>
                                  <textarea style="resize: vertical;" name="nome_detalhes" class="form-control" id="message-text">'.$detalhes[$i].'</textarea>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="opcao" value="0" class="btn btn-primary btn-sm poointer">Atualizar</button>
                              <button type="submit" name="opcao" value="1" class="btn btn-danger btn-sm poointer">Excluir</button>
                              <button type="button"  class="btn btn-secondary btn-sm poointer" data-bs-dismiss="modal">Fechar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>';

              echo '  <div class="caard-single">
                        <div class="caard-body">
                          <span class="ti-briefcase"></span>
                          <div>
                            <h4>'.$nomeA[$i]." ".$nomeB[$i].'</h4>
                            <h5>'.$emprego[$i].'</h5>
                          </div>
                        </div>
                        <div class="caard-footer">
                            <button data-bs-toggle="modal" data-bs-target="#a'.$idPostagem[$i].'" class="butao d-flex justify-content-center align-items-center">Editar</button>
                        </div>
                      </div>';
            }elseif ($status[$i] == "Pendente"){
              echo '  <div class="caard-single">
                        <div class="caard-body">
                          <span class="ti-briefcase"></span>
                          <div>
                            <h4>'.$nomeA[$i]." ".$nomeB[$i].'</h4>
                            <h5>Alguém está interessado!</h5>
                          </div>
                        </div>
                        <form action="empregorem.php" method="POST">
                          <div class="caard-footer">
                              <input type="text" name="contratarPostagem" value="'.$idPostagem[$i].'" hidden>
                              <button type="submit" name="opcao" value="6" class="butao d-flex justify-content-center align-items-center">Aceitar Pedido</button>
                          </div>
                        </form>
                      </div>';
            }else{
              $off="";
            }
            $i++;
          }
          ?> 
        </div>
      <h2 class="daash-title" <?php echo $off;?>>Anúncios Contratados</h2>

        <div class="daash-cards">
          <?php
          $p=0;
          $sql = mysqli_query($conecta, "select * from usuario INNER JOIN anuncio ON usuario.idUser = anuncio.idUser WHERE email = '$logado'");
          while($exibe = mysqli_fetch_assoc($sql)){
            $idPostagem[$p] = $exibe["idAnuncio"];
            $nomeA[$p] = $exibe["nome"];
            $nomeB[$p] = $exibe["sobrenome"];
            $emprego[$p] = $exibe["emprego"];
            $detalhes[$p] = $exibe["detalhes"];
            $idUser[$p] = $exibe["idUser"];
            $status[$p] = $exibe["status"];
            $contratante[$p] = $exibe["contratante"];

            $delet[$p] = "DELETE FROM anuncio WHERE idAnuncio='$idPostagem[$p]' AND idUser='$idUser[$p]'";

            $delet2[$p] = "DELETE FROM interesse WHERE idAnuncio='$idPostagem[$p]' AND idUser='$contratante[$p]'";
            

            if($status[$p] == "Contratado"){
              echo '<div class="modal fade" id="a'.$idPostagem[$p].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Anúncio de Serviço</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="empregorem.php" method="POST">
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="exampleFormControlInput1">Emprego</label>
                                <input class="form-control" type="text" name="nome_emprego" placeholder="Informe o emprego" value="'.$emprego[$p].'" maxlength="45" required>
                                <input type="text" name="iddaconta" value="'.$idPostagem[$p].'" hidden>
                                <input type="text" name="deletar" value="'.$delet[$p].'" hidden>
                                <input type="text" name="deletar2" value="'.$delet2[$p].'" hidden>
                              </div>
                              
                              <div class="form-group">
                                <div class="mb-3">
                                  <label for="message-text" class="col-form-label">Detalhes</label>
                                  <textarea style="resize: vertical;" name="nome_detalhes" class="form-control" id="message-text">'.$detalhes[$p].'</textarea>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="opcao" value="0" class="btn btn-primary btn-sm poointer">Atualizar</button>
                              <button type="submit" name="opcao" value="1" class="btn btn-danger btn-sm poointer">Excluir</button>
                              <button type="button"  class="btn btn-secondary btn-sm poointer" data-bs-dismiss="modal">Fechar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>';

              echo '  <div class="caard-single">
                        <div class="caard-body">
                          <span class="ti-briefcase"></span>
                          <div>
                            <h4>'.$nomeA[$p]." ".$nomeB[$p].'</h4>
                            <h5>'.$emprego[$p].'</h5>
                          </div>
                        </div>
                        <form action="empregorem.php" method="POST">
                          <div class="caard-footer">
                                <input type="text" name="deletar" value="'.$delet[$p].'" hidden>
                                <input type="text" name="deletar2" value="'.$delet2[$p].'" hidden>

                              <!-- <button class="butao d-flex justify-content-center align-items-center">Entrar em contato</button> -->
                              <button type="submit" name="opcao" value="1" class="butaored d-flex justify-content-center align-items-center">Excluir</button>
                          </div>
                        </form>
                      </div>';
              $p++;
            }
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