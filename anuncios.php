<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
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
          <li><a class="dropdown-item" href="#">Alguma coisa</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="desconectar.php">Sair</a></li>
        </ul>
      </div>
    </header>

    <main class="main">

      <h2 class="daash-title">Overview</h2>

      <div class="daash-cards">
        <!-- Colocar o loop dos trabalhadores no banco -->
        <div class="caard-single">
          <div class="caard-body">
            <span class="ti-briefcase"></span>
            <div>
              <h4>Thiago Almeida</h4>
              <h5>Programador</h5>
            </div>
          </div>
          <div class="caard-footer">
            <a href="">Ver mais</a>
          </div>
        </div>

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
                    <th>InicioStart Date</th>
                    <th>End Date</th>
                    <th>Team</th>
                    <th>Status</th>
                  </tr>    
                </thead>
                <tbody>
                  <tr>
                    <td>App Development</td>
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
                  </tr>
                </tbody>
              </table>
            </div>

            
          </div>

          <div class="suummary">
            <div class="suummary-card">
              <div class="suummary-single">
                <span class="ti-id-badge"></span>
                <div>
                  <h5>196</h5>
                  <small>Number of staff</small>
                </div>
              </div>
              <div class="suummary-single">
                <span class="ti-calendar"></span>
                <div>
                  <h5>16</h5>
                  <small>Number of leave</small>
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
            <div class="bday-card">
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
            </div>
          </div>
        </div>

      </section>

    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>