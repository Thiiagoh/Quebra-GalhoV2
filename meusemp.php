<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
  <link rel="icon" type="image/png" href="images/icons/icon.ico"/>
  <title>Meus Interesses</title>
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
  $off="hidden";

  $existePen = '<span class="ti-bell poointer"></span>';
  $xi=0;
  $sql = mysqli_query($conecta, "select * from usuario INNER JOIN anuncio ON usuario.idUser = anuncio.idUser WHERE email = '$logado'");
  while($exibe = mysqli_fetch_assoc($sql)){
    $status[$xi] = $exibe["status"];
    if($status[$xi] == "Pendente"){
      $existePen = '
      <a href="meus.php">
      <span class="ti-bell poointer"></span>
      <div class="bolinha"></div>
      </a>';    
    }
    $xi++;
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
        <a href="anuncios.php">
          <li class="passando">
            <span class="ti-home"></span>
            <span>An??ncios</span>
          </li>
        </a>
        <a href="assinar.php">
          <li class="passando">
            <span class="ti-star"></span>
            <span>Assinatura</span>
          </li>
        </a>
        <a href="info.php">
          <li class="passando">
            <span class="ti-settings"></span>
            <span>Conta</span>
          </li>
        </a>
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
        <?php echo $existePen;?>
        <!-- <span class="ti-comments poointer"></span> -->
        <div class="poointer">
          <img src="images/img_perfil/<?php echo $perfil;?>">
        </div>
        <p class="nome_ poointer" id="dropdownMenuButton2" data-bs-toggle="dropdown"><?php echo $namec;?>
          <i class="fas fa-caret-down"></i>
        </p>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
          <?php
            if ($choose == "1"){
              echo '<li><a class="dropdown-item" href="meus.php">Meus an??ncios</a></li>';
            }else{
              echo '<li><a class="dropdown-item" href="meusemp.php">Meus interesses</a></li>';
            }
          ?>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="desconectar.php">Sair</a></li>
        </ul>
      </div>
    </header>

    <main class="main">

      <h2 class="daash-title">Meus Interesses</h2>

        <div class="daash-cards">
          <?php
          $i=0;
          //$sql = mysqli_query($conecta, "select * from usuario INNER JOIN anuncio ON usuario.idUser = anuncio.idUser WHERE email = '$logado'");
          $sql = mysqli_query($conecta, "select i.idInteresse, i.idUser, i.idAnuncio, a.emprego, u.nome, u.sobrenome, a.status from interesse i INNER JOIN anuncio a ON i.idAnuncio = a.idAnuncio INNER JOIN usuario u ON a.idUser = u.idUser where i.idUser='$id'");
          while($exibe = mysqli_fetch_assoc($sql)){
            $idPostagem[$i] = $exibe["idAnuncio"];
            $idInteresse[$i] = $exibe["idInteresse"];
            $nomeA[$i] = $exibe["nome"];
            $nomeB[$i] = $exibe["sobrenome"];
            $emprego[$i] = $exibe["emprego"];
            $status[$i] = $exibe["status"];

            $delet[$i] = "DELETE FROM interesse WHERE idInteresse='$idInteresse[$i]'";

            if($status[$i] == "Em aberto"){
              echo '  <div class="caard-single">
                        <div class="caard-body">
                          <span class="ti-briefcase"></span>
                          <div>
                            <h4>'.$nomeA[$i]." ".$nomeB[$i].'</h4>
                            <h5>'.$emprego[$i].'</h5>
                          </div>
                        </div>
                        <form action="empregorem.php" method="POST">
                          <div class="caard-footer">
                            <input type="text" name="deletarinteresse" value="'.$delet[$i].'" hidden>
                            <input type="text" name="contratarPostagem" value="'.$idPostagem[$i].'" hidden>
                            <input type="text" name="contratarPostagemId" value="'.$id.'" hidden>       
                            <button class="butao d-flex justify-content-center align-items-center" type="submit" name="opcao" value="3">Pedir contato</button>
                            <button class="butaored d-flex justify-content-center align-items-center" type="submit" name="opcao" value="2">Remover</button>
                          </div>
                        </form>
                      </div>';
            }elseif ($status[$i] == "Pendente"){
              echo '  <div class="caard-single">
                        <div class="caard-body">
                          <span class="ti-briefcase"></span>
                          <div>
                            <h4>'.$nomeA[$i]." ".$nomeB[$i].'</h4>
                            <h5>Pedido enviado, Pendente...</h5>
                          </div>
                        </div>
                        <form action="empregorem.php" method="POST">
                          <div class="caard-footer">
                            <input type="text" name="deletarinteresse" value="'.$delet[$i].'" hidden>
                            <input type="text" name="contratarPostagem" value="'.$idPostagem[$i].'" hidden>
                            <input type="text" name="contratarPostagemId" value="'.$id.'" hidden>       
                            <button class="butaored d-flex justify-content-center align-items-center" type="submit" name="opcao" value="2">Remover</button>
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
        <h2 class="daash-title" <?php echo $off;?>>Pedidos Aceitos</h2>

        <div class="daash-cards">
          <?php
          $p=0;
          //$sql = mysqli_query($conecta, "select * from usuario INNER JOIN anuncio ON usuario.idUser = anuncio.idUser WHERE email = '$logado'");
          $sql = mysqli_query($conecta, "select i.idInteresse, i.idUser, i.idAnuncio, a.emprego, a.detalhes, u.nome, u.sobrenome, u.cidade, u.estado, u.emailcontato, u.numero, a.status from interesse i INNER JOIN anuncio a ON i.idAnuncio = a.idAnuncio INNER JOIN usuario u ON a.idUser = u.idUser where i.idUser='$id'");
          while($exibe = mysqli_fetch_assoc($sql)){
            $idPostagem[$p] = $exibe["idAnuncio"];
            $idInteresse[$p] = $exibe["idInteresse"];
            $nomeA[$p] = $exibe["nome"];
            $nomeB[$p] = $exibe["sobrenome"];
            $emprego[$p] = $exibe["emprego"];
            $detalhe[$p] = $exibe["detalhes"];
            $cidade[$p] = $exibe["cidade"];
            $estado[$p] = $exibe["estado"];
            $emailcontato[$p] = $exibe["emailcontato"];
            $telefone[$p] = $exibe["numero"];
            $status[$p] = $exibe["status"];

            $delet[$p] = "DELETE FROM interesse WHERE idInteresse='$idInteresse[$p]'";

            if($status[$p] == "Contratado"){
              echo '<div class="modal fade" id="a'.$idPostagem[$p].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Informa????es do Aut??nomo</h5>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Nome: '.$nomeA[$p]." ".$nomeB[$p].'</label>
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Emprego: '.$emprego[$p].'</label>
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Detalhes: '.$detalhe[$p].'</label>
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Cidade: '.$cidade[$p].'</label>
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Estado: '.$estado[$p].'</label>
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Email de contato: '.$emailcontato[$p].'</label>
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Telefone: '.$telefone[$p].'</label>
                                </div>
                                
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button"  class="btn btn-secondary btn-sm poointer" data-bs-dismiss="modal">Fechar</button>
                              </div>
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
                          <div class="caard-footer">
                            <button data-bs-toggle="modal" data-bs-target="#a'.$idPostagem[$p].'" class="butao d-flex justify-content-center align-items-center">Entrar em contato</button>
                            <form action="empregorem.php" method="POST">
                            <input type="text" name="deletarinteresse" value="'.$delet[$p].'" hidden>
                            <input type="text" name="contratarPostagem" value="'.$idPostagem[$p].'" hidden>
                            <input type="text" name="contratarPostagemId" value="'.$id.'" hidden>
                            <button class="butaored d-flex justify-content-center align-items-center" type="submit" name="opcao" value="2">Remover</button>
                          </div>
                        </form>
                      </div>';
            }
            $p++;
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