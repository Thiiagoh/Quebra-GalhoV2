<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
  <link rel="icon" type="image/png" href="images/icons/icon.ico"/>
  <title>Informações Pessoais</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <style type="text/css">
    input[type='file'] {
      display: none
    }

    /* Aparência que terá o seletor de arquivo */
    .seletor {
      font-family: 'Poppins', sans-serif;
      font-size: 12px;
      cursor: pointer;
    }
  </style>
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
  }
  $tenta_achar = "SELECT * FROM usuario WHERE idUser='$id'";
  $resultado = $conecta->query($tenta_achar);
  if ($resultado->num_rows >= 1){
    $trocado = mysqli_query($conecta, "select * from usuario where idUser ='$id'");
    while($exibe = mysqli_fetch_assoc($trocado)){
      $nome = $exibe["nome"];
      $sobrenome = $exibe["sobrenome"];
      $sexo = $exibe["sexo"];
      $email = $exibe["emailcontato"];
      $escolaridade = $exibe["escolaridade"];
      $endereco = $exibe["endereco"];
      $complemento = $exibe["complemento"];
      $cidade = $exibe["cidade"];
      $estado = $exibe["estado"];
      $cep = $exibe["cep"];
      // $descricao = $exibe["descricao"];
      $numero = $exibe["numero"];
      $avatar = $exibe["avatar"];
    }
  }else{
    $nome = "";
    $sobrenome = "";
    $sexo = "Selecione";
    $email = "";
    $escolaridade = "selecione";
    $endereco = "";
    $complemento = "";
    $cidade = "";
    $estado = "Selecione";
    $cep = "";
    // $descricao = "";
    $numero = "";
    $avatar = "user.png";
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
        <a href="assinar.php">
          <li class="passando">
            <span class="ti-star"></span>
            <span>Assinatura</span>
          </li>
        </a>
        <a href="#">
          <li class="passando active">
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
              echo '<li><a class="dropdown-item" href="meusemp.php">Meus interesses</a></li>';
            }
          ?>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="desconectar.php">Sair</a></li>
        </ul>
      </div>

    </header>

    <main class="main">
      <h2 class="daash-title" style="margin-bottom: -30px;">Informações Pessoais</h2>
      <section class="reecent">
        <div class="aactivity-grid">
          <?php
          if (isset($_POST['enviado'])){
            $nome = $_POST['nome'];
            $sobrenome = $_POST['sobrenome'];
            $sexo = $_POST['sexo'];
            $email = $_POST['email'];
            $grau = $_POST['grau'];
            $endereco = $_POST['endereco'];
            $complemento = $_POST['complemento'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $cep = $_POST['cep'];
            // $descricao = $_POST['descricao'];
            $numero = $_POST['numero'];

        //Conectar no mysql
            $conecta = mysqli_connect($nome_servidor, $nome_usuario, $senhaBanco, $nome_banco);
            // $sql = "UPDATE usuario SET nome='$nome', sobrenome='$sobrenome', sexo='$sexo', emailcontato='$email', escolaridade='$grau', endereco='$endereco', complemento='$complemento', cidade='$cidade', estado='$estado', cep='$cep', descricao='$descricao', numero='$numero' WHERE idUser='$id'"; COMPLETO COM DESCRICAO

            $sql = "UPDATE usuario SET nome='$nome', sobrenome='$sobrenome', sexo='$sexo', emailcontato='$email', escolaridade='$grau', endereco='$endereco', complemento='$complemento', cidade='$cidade', estado='$estado', cep='$cep', numero='$numero' WHERE idUser='$id'";
            if ($conecta->query($sql) === TRUE) {
              echo '  <div class="flex-sb-m w-full" style="justify-content: center;">
              <div class="alert alert-success fade show" role="alert">
              <strong>Sucesso!</strong> Informações atualizadas com sucesso!
              </div>
              </div><br>';
            }else{
              echo ' <div class="flex-sb-m w-full" style="justify-content: center;">
              <div class="alert alert-warning fade show" role="alert">
              <strong>Erro!</strong> Falha ao atualizar!
              </div>
              </div><br>';
            }
            $conecta->close();
          }
          ?>
          <?php 
          if (isset($_POST['enviar-formulario'])):
            $formatosPermitidos = array("png", "jpeg", "jpg");
            $extensao = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            if (in_array($extensao, $formatosPermitidos)):
              $pasta = "images/img_perfil/";
              $temporario = $_FILES['avatar']['tmp_name'];
              $novoNome = uniqid().".$extensao";
              if(move_uploaded_file($temporario, $pasta.$novoNome)):
                $sql = "UPDATE usuario SET avatar='$novoNome' WHERE idUser='$id'";
                if ($conecta->query($sql) === TRUE) {
                  if($avatar != "user.png"){
                    unlink("images/img_perfil/".$avatar);
                    $avatar = $novoNome;
                  }
                  echo ' <div class="flex-sb-m w-full" style="justify-content: center;">
                  <div class="alert alert-success fade show" role="alert">
                  <strong>Sucesso!</strong> Sua foto foi enviada.
                  </div>
                  </div><br>';

                }else{
                  echo ' <div class="flex-sb-m w-full" style="justify-content: center;">
                  <div class="alert alert-danger fade show" role="alert">
                  <strong>Erro ao enviar!</strong> Sua foto não foi enviada.
                  </div>
                  </div><br>';
                }

              else:
                echo ' <div class="flex-sb-m w-full" style="justify-content: center;">
                <div class="alert alert-danger fade show" role="alert">
                <strong>Erro ao enviar!</strong> Sua foto não foi enviada.
                </div>
                </div><br>';
              endif;
            else:
              echo ' <div class="flex-sb-m w-full" style="justify-content: center;">
              <div class="alert alert-warning fade show" role="alert">
              <strong>Erro ao enviar!</strong> Formato inválido.
              </div>
              </div><br>';
            endif;
          endif;
          ?>
          <div class="aactivity-card">
            <div class="aactivity-card-info">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group row g-3">
                  <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Nome*</label>
                    <input type="text" maxlength="30" name="nome" value="<?php echo $nome;?>" class="form-control" id="inputEmail4" placeholder="Nome" required>
                  </div>
                  <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Sobrenome*</label>
                    <input type="text" name="sobrenome" value="<?php echo $sobrenome;?>" class="form-control" id="inputPassword4" placeholder="Sobrenome" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Selecione o sexo</label>
                  <select name="sexo" class="form-control" id="exampleFormControlSelect1">
                    <option value="<?php echo $sexo;?>"><?php echo $sexo;?></option>
                    <option value="Feminino">Feminino</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Outro">Outro</option>
                  </select>
                </div>
                <div class="form-group row g-3">
                  <div class="col-md-6">
                    <label for="exampleFormControlInput1">Email de contato*</label>
                    <input type="email" name="email" value="<?php echo $email;?>" class="form-control" id="exampleFormControlInput1" placeholder="nome@exemplo.com">
                  </div>
                  <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Número de telefone*</label>
                    <input type="text" name="numero" value="<?php echo $numero;?>" class="form-control cel-sp-mask" id="exampleFormControlInput1" placeholder="(00) 00000-0000" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Selecione o seu grau de escolaridade</label>
                  <select name="grau" value="<?php echo $escolaridade;?>" class="form-control" id="exampleFormControlSelect1">
                    <option value="<?php echo $escolaridade;?>"><?php echo $escolaridade;?></option>
                    <option value="Ensino Fundamental">Ensino Fundamental</option>
                    <option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
                    <option value="Ensino Médio">Ensino Médio</option>
                    <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                    <option value="Ensino Superior">Ensino Superior</option>
                    <option value="Ensino Superior Completo">Ensino Superior Completo</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputAddress">Endereço</label>
                  <input type="text" name="endereco" value="<?php echo $endereco;?>" class="form-control" id="inputAddress" placeholder="Rua dos Bobos, nº 0">
                </div>
                <div class="form-group">
                  <label for="inputAddress2">Complemento</label>
                  <input type="text" name="complemento" value="<?php echo $complemento;?>" class="form-control" id="inputAddress2" placeholder="Apartamento, hotel, casa, etc.">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">Cidade*</label>
                    <input type="text" name="cidade" value="<?php echo $cidade;?>" placeholder="Cidade" class="form-control" id="inputCity" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputEstado">Estado*</label>
                    <select id="inputEstado" name="estado"  class="form-control" required>
                      <option value="<?php echo $estado;?>"><?php echo $estado;?></option>
                      <option value="Acre">Acre</option>
                      <option value="Alagoas">Alagoas</option>
                      <option value="Amapá">Amapá</option>
                      <option value="Amazonas">Amazonas</option>
                      <option value="Bahia">Bahia</option>
                      <option value="Ceará">Ceará</option>
                      <option value="Distrito Federal">Distrito Federal</option>
                      <option value="Espirito Santo">Espirito Santo</option>
                      <option value="Goiás">Goiás</option>
                      <option value="Maranhão">Maranhão</option>
                      <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                      <option value="Mato Grosso">Mato Grosso</option>
                      <option value="Minas Gerai">Minas Gerais</option>
                      <option value="Pará">Pará</option>
                      <option value="Paraíba">Paraíba</option>
                      <option value="Paraná">Paraná</option>
                      <option value="Pernambuco">Pernambuco</option>
                      <option value="Piauí">Piauí</option>
                      <option value="Rio de Janeiro">Rio de Janeiro</option>
                      <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                      <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                      <option value="Rondônia">Rondônia</option>
                      <option value="Roraima">Roraima</option>
                      <option value="Santa Catarina">Santa Catarina</option>
                      <option value="São Paulo">São Paulo</option>
                      <option value="Sergipe">Sergipe</option>
                      <option value="Tocantins">Tocantins</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="inputCEP">CEP*</label>
                    <input type="cep" name="cep" value="<?php echo $cep;?>" placeholder="11111-111" class="form-control cep-mask" id="inputCEP" required>
                  </div>
                </div>
                <button type="submit" name="enviado" class="poointer btn btn-primary">Salvar</button>
              </form>
            </div>

          </div>

          <div class="suummary">
            <!-- <div class="suummary-card">
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
            </div> -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
              <div class="bday-card">
                <div class="bday-flex">
                  <img class="bday-img" src="images/img_perfil/<?php echo $avatar;?>">
                  <div class="bday-info">
                    <h5>Foto de Perfil</h5>
                    <label class="seletor" for='selecao-arquivo'>Selecionar um arquivo</label>
                    <input name="avatar" id='selecao-arquivo' type='file'>
                  </div>
                </div>
                <div class="teext-center">
                  <button name="enviar-formulario" type="submit" class="poointer">Enviar</button>
                </div>
              </div>
            </form>
          </div>
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