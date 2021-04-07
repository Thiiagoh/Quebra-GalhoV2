<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
  <link rel="icon" type="image/png" href="images/icons/icon.ico"/>
  <title>Quebra-Galho</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <?php 
  session_start();
  if((!isset($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
    session_unset();
    echo "<script>window.location.href = 'index.php';</script>";
  }
  $logado = $_SESSION['email'];
  include_once "conectar.php";
  $sql = mysqli_query($conecta, "select * from usuario where email ='$logado'");
  while($exibe = mysqli_fetch_assoc($sql)){
    $choose = $exibe["escolha"];
    if ($choose == "0"){
      echo "<script>window.location.href = 'escolha.php';</script>";
    }
    $perfil = $exibe["avatar"];
    $namec = $exibe["nome"];
    $idConta = $exibe["idUser"];
  }
  ?>
</head>
<body>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Criar Anúncio de Serviço</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="emprego.php" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleFormControlInput1">Emprego</label>
              <input class="form-control" type="text" name="nome_emprego" placeholder="Informe o emprego" maxlength="45" required>
              <input type="text" name="iddaconta" value="<?php echo $idConta; ?>" hidden>
            </div>
            
            <div class="form-group">
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Detalhes</label>
                <textarea style="resize: vertical;" name="nome_detalhes" class="form-control" id="message-text"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="insertdata" class="btn btn-primary btn-sm poointer">Adicionar</button>
            <button type="button" class="btn btn-secondary btn-sm poointer" data-bs-dismiss="modal">Fechar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Limite máximo atingido</h3>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="emprego.php" method="POST">
          <div class="modal-body">
            <h4>Seje membro e tenha mais anúncios</h4>
            <p>Clique <a href="planos.php" class="tooltip-test" style="color: #ff8484;" title="Tooltip">aqui</a> para ver os planos disponiveis.</p>
          </div>
          <div class="modal-footer">
            <button type="submit" id="insertdata" class="btn btn-primary btn-sm poointer">Adicionar</button>
            <button type="button" class="btn btn-secondary btn-sm poointer" data-bs-dismiss="modal">Fechar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
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
        <li class="passando active">
          <a href="#">
            <span class="ti-home"></span>
            <span>Anúncios</span>
          </a>
        </li>
        <!-- <li>
          <a href="">
            <span class="ti-face-smile"></span>
            <span>Team</span>
          </a>
        </li>
        <li>
          <a href="">
            <span class="ti-agenda"></span>
            <span>Tasks</span>
          </a>
        </li>
        <li>
          <a href="">
            <span class="ti-clipboard"></span>
            <span>Leaves</span>
          </a>
        </li>
        <li>
          <a href="">
            <span class="ti-folder"></span>
            <span>Projects</span>
          </a>
        </li>
        <li>
          <a href="">
            <span class="ti-time"></span>
            <span>Timesheet</span>
          </a>
        </li>
        <li>
          <a href="">
            <span class="ti-book"></span>
            <span>Contacts</span>
          </a>
        </li> -->
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
        <span class="ti-search"></span>
        <input type="search" placeholder="Search" name="">
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

      <?php
        $iii=0;
        $sqll = mysqli_query($conecta, "select * from anuncio where status='Contratado'");
        while($exibe = mysqli_fetch_assoc($sqll)){
          $iii++;
        }

        $ii=0;
        $sql = mysqli_query($conecta, "select * from anuncio INNER JOIN usuario ON anuncio.idUser = usuario.idUser where email='$logado'");
        while($exibe = mysqli_fetch_assoc($sql)){
          $ii++;
        }
       
        if ($choose == "1"){
          if($ii < 2){
            echo '  <div class="btn-add">
                    <a href="#">
                        <button class="float-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          <i class="fas fa-plus"></i>
                        </button>
                      </a>
                    </div>';
          }else{
            echo '  <div class="btn-add">
                    <a href="#">
                        <button class="float-button" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                          <i class="fas fa-plus"></i>
                        </button>
                      </a>
                    </div>';
          }
        }
      ?>
      <h2 class="daash-title">Trabalhadores</h2>
      <div class="daash-cards">
        <?php
        $i=0;
        $sql = mysqli_query($conecta, "select * from anuncio INNER JOIN usuario ON anuncio.idUser = usuario.idUser");
        while($exibe = mysqli_fetch_assoc($sql)){
          $idPostagem[$i] = $exibe["idAnuncio"];
          $nomeA[$i] = $exibe["nome"];
          $nomeB[$i] = $exibe["sobrenome"];
          $emprego[$i] = $exibe["emprego"];
          $statusss[$i] = $exibe["status"];

          if($statusss[$i] == "Em aberto"){
            echo '  <div class="caard-single">
                      <div class="caard-body">
                        <span class="ti-briefcase"></span>
                        <div>
                          <h4>'.$nomeA[$i]." ".$nomeB[$i].'</h4>
                          <h5>'.$emprego[$i].'</h5>
                        </div>
                      </div>
                      <div class="caard-footer">
                        <form action="dados.php" method="GET">
                          <button name="id" value="'.$idPostagem[$i].'" class="butao d-flex justify-content-center align-items-center">Ver mais</button>
                        </form>
                      </div>
                    </div>';
          $i++;
          }
        }
        ?> 
      </div>
      <section class="reecent">
        <div class="aactivity-grid">
          <div class="aactivity-card">
            <h3>Atividade recente</h3>
            <div class="taable-responsive">
              <table>
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Emprego</th>
                    <th>Data de início</th>
                    <th>Contratante</th>
                    <th>Status</th>
                  </tr>    
                </thead>
                <tbody>
                  <?php
                  $x=0;
                  $sql = mysqli_query($conecta, "select * from anuncio INNER JOIN usuario ON anuncio.idUser = usuario.idUser");
                  while($exibe = mysqli_fetch_assoc($sql)){
                    $idPostagem[$x] = $exibe["idAnuncio"];
                    $nomeA[$x] = $exibe["nome"];
                    $nomeB[$x] = $exibe["sobrenome"];
                    $emprego[$x] = $exibe["emprego"];
                    $status[$x] = $exibe["status"];
                    $datinha[$x] = date('d/m/Y',  strtotime($exibe["dataInicio"]));
                    $contratante[$x] = $exibe["contratante"];
                  
                    $con = mysqli_query($conecta, "select * from usuario where idUser='$contratante[$x]'");
                    while($exibir = mysqli_fetch_assoc($con)){
                      $nomeConA = $exibir["nome"];
                      $nomeConB = $exibir["sobrenome"];
                    }

                    if(empty($nomeConA) == true or empty($nomeConB) == true){
                      $nomeConA = "";
                      $nomeConB = "";
                    }

                    if($status[$x] == "Em aberto"){
                      $estilo[$x] = "warning";
                    }else{
                      $estilo[$x] = "success";
                    }
                    echo '<tr>
                            <td>'.$nomeA[$x]." ".$nomeB[$x].'</td>
                            <td>'.$emprego[$x].'</td>
                            <td>'.$datinha[$x].'</td>
                            <td>'.$nomeConA." ".$nomeConB.'</td>
                            <td>
                              <span class="baadge '.$estilo[$x].'">'.$status[$x].'</span>
                            </td>
                          </tr>';

                    $x++;
                  }
                  ?> 
                  
                  <!-- <tr>
                    <td>Front-end Design</td>
                    <td>15 Aug, 2020</td>
                    <td>22 Aug, 2020</td>
                    <td class="td-team">
                      <div class="iimg-1"></div>
                      <div class="iimg-2"></div>
                      <div class="iimg-3"></div>
                    </td>
                    <td>
                      <span class="baadge warning">Processing</span>
                    </td>
                  </tr>
                  <tr>
                    <td>Web Development</td>
                    <td>15 Aug, 2020</td>
                    <td>22 Aug, 2020</td>
                    <td class="td-team">
                      <div class="iimg-1"></div>
                      <div class="iimg-2"></div>
                      <div class="iimg-3"></div>
                    </td>
                    <td>
                      <span class="baadge success">Success</span>
                    </td>
                  </tr>
                  <tr>
                    <td>Logo Design</td>
                    <td>15 Aug, 2020</td>
                    <td>22 Aug, 2020</td>
                    <td class="td-team">
                      <div class="iimg-1"></div>
                      <div class="iimg-2"></div>
                      <div class="iimg-3"></div>
                    </td>
                    <td>
                      <span class="baadge warning">Processing</span>
                    </td>
                  </tr>
                  <tr>
                    <td>Server setup</td>
                    <td>15 Aug, 2020</td>
                    <td>22 Aug, 2020</td>
                    <td class="td-team">
                      <div class="iimg-1"></div>
                      <div class="iimg-2"></div>
                      <div class="iimg-3"></div>
                    </td>
                    <td>
                      <span class="baadge success">Success</span>
                    </td>
                  </tr> -->
                </tbody>
              </table>
            </div>

            
          </div>

          <div class="suummary">
            <div class="suummary-card">
              <div class="suummary-single">
                <span class="ti-id-badge"></span>
                <div>
                  <h5><?php echo $i;?></h5>
                  <small>Número de anúncios</small>
                </div>
              </div>
              <div class="suummary-single">
                <span class="ti-calendar"></span>
                <div>
                  <h5><?php echo $iii;?></h5>
                  <small>Número de contratados</small>
                </div>
              </div>
              <div class="suummary-single">
                <span class="ti-face-smile"></span>
                <div>
                  <h5>12</h5>
                  <small>Profile update request</small>
                </div>
              </div>
            </div>
            <!-- <div class="bday-card">
              <div class="bday-flex">
                <div class="bday-img"></div>
                <div class="bday-info">
                  <h5>Dwayne F. Sanders</h5>
                  <small>Birthday Today</small>
                </div>
              </div>
              <div class="teext-center">
                <button>
                  <span class="ti-gift"></span>
                  Wish him
                </button>
              </div>
            </div> -->
          </div>
        </div>

      </section>

    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>