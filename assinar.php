<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <link rel="icon" type="image/png" href="images/icons/icon.ico"/>
    <title>Escolher Assinatura</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/pricing/">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
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
        $id = $exibe["idUser"];
        $choose = $exibe["escolha"];
        if ($choose == "0"){
          echo "<script>window.location.href = 'escolha.php';</script>";
        }
        $perfil = $exibe["avatar"];
        $namec = $exibe["nome"];
        $membro = $exibe["membro"];
      }

      if ($membro == "Gratis"){
        $div1 = "border-primary";
        $div11 = "text-white bg-primary border-primary";
        $div2 = "";
        $div22 = "";
        $div3 = "";
        $div33 = "";
        $gratisNormal = "Plano atual";
        $membroComprado = "Assinar";
        $vipComprado = "Assinar";
      } 
      if ($membro == "Membro"){
        $div1 = "";
        $div11 = "";
        $div2 = "border-primary";
        $div22 = "text-white bg-primary border-primary";
        $div3 = "";
        $div33 = "";
        $gratisNormal = "Gratuitamente";
        $membroComprado = "Plano atual";
        $vipComprado = "Assinar";
      }
      if ($membro == "Vip"){
        $div1 = "";
        $div11 = "";
        $div2 = "";
        $div22 = "";
        $div3 = "border-primary";
        $div33 = "text-white bg-primary border-primary";
        $gratisNormal = "Gratuitamente";
        $membroComprado = "Assinar";
        $vipComprado = "Plano atual";
      }
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
            <span>Anúncios</span>
          </li>
        </a>
        <a href="#">
          <li class="passando active">
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

    <main>
      <section class="reecent">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
          <symbol id="check" viewBox="0 0 16 16">
            <title>Check</title>
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
          </symbol>
        </svg>

        <div class="container py-3">
          <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal">Assinaturas</h1>
            <p class="fs-5 text-muted">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
          </div>

          <main>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
              <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm <?php echo $div1;?>">
                  <div class="card-header py-3 <?php echo $div11?>">
                    <h4 class="my-0 fw-normal">Grátis</h4>
                  </div>
                  <div class="card-body">
                      <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mês</small></h1>
                      <ul class="list-unstyled mt-3 mb-4">
                        <li>2 Anúncios</li>
                        <li>...</li>
                        <li>...</li>
                        <li>...</li>
                      </ul>
                      <button type="button" class="w-100 btn btn-lg btn-outline-primary"><?php echo $gratisNormal;?></button>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm <?php echo $div2;?>">
                  <div class="card-header py-3 <?php echo $$div22;?>">
                    <h4 class="my-0 fw-normal">Básico</h4>
                  </div>
                  <div class="card-body">
                    <form action="empregorem.php" method="POST">
                      <input type="text" name="conta" value="<?php echo $id;?>" hidden>
                      <h1 class="card-title pricing-card-title">$5<small class="text-muted fw-light">/mês</small></h1>
                      <ul class="list-unstyled mt-3 mb-4">
                        <li>5 Anúncios</li>
                        <li>...</li>
                        <li>...</li>
                        <li>...</li>
                      </ul>
                      <button type="submit" name="opcao" value="4" class="w-100 btn btn-lg btn-primary"><?php echo $membroComprado;?></button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm <?php echo $div3;?>">
                  <div class="card-header py-3 <?php echo $div33;?>">
                    <h4 class="my-0 fw-normal">Vip</h4>
                  </div>
                  <div class="card-body">
                    <form action="empregorem.php" method="POST">
                      <input type="text" name="conta" value="<?php echo $id;?>" hidden>
                      <h1 class="card-title pricing-card-title">$10<small class="text-muted fw-light">/mês</small></h1>
                      <ul class="list-unstyled mt-3 mb-4">
                        <li>10 Anúncios</li>
                        <li>...</li>
                        <li>...</li>
                        <li>...</li>
                      </ul>
                      <button type="submit" name="opcao" value="5" class="w-100 btn btn-lg btn-primary"><?php echo $vipComprado;?></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <h2 class="display-6 text-center mb-4">Comparar planos</h2>

            <div class="table-responsive">
              <table class="table text-center">
                <thead>
                  <tr>
                    <th style="width: 34%;"></th>
                    <th style="width: 22%;">Grátis</th>
                    <th style="width: 22%;">Básico</th>
                    <th style="width: 22%;">Vip</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row" class="text-start">Público</th>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                  </tr>
                  <tr>
                    <th scope="row" class="text-start">Privado</th>
                    <td></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                  </tr>
                </tbody>

                <tbody>
                  <tr>
                    <th scope="row" class="text-start">Permissions</th>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                  </tr>
                  <tr>
                    <th scope="row" class="text-start">Sharing</th>
                    <td></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                  </tr>
                  <tr>
                    <th scope="row" class="text-start">Unlimited members</th>
                    <td></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                  </tr>
                  <tr>
                    <th scope="row" class="text-start">Extra security</th>
                    <td></td>
                    <td></td>
                    <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </main>

          
        </div>
        

      </section>
    </main>
  </div>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>
  <script type="text/javascript" src="//assets.locaweb.com.br/locastyle/2.0.6/javascripts/locastyle.js"></script>
  <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>