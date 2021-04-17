<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
  <link rel="icon" type="image/png" href="images/icons/icon.ico"/>
  <title>Acessar o site</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="login/login.css">
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <?php 
  session_start();
  if((!isset($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
    session_unset();
  }else{
    echo "<script>window.location.href = 'anuncios.php';</script>";
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



    <main class="mainmain">

      <div class="container">
        <div class="forms-container">
          <div class="signin-signup">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="sign-in-form">
              <h2 class="title">Quebra-Galho</h2>
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="email" name="email" placeholder="Email" required>
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="senha" placeholder="Senha" required>
              </div>
              <?php
              if (isset($_POST['loginlogin'])){
                include_once "conectar.php";
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                if($conecta->connect_error === TRUE){    
                  die("Deu erro na conexão ". $conecta->connect_error);
                }
                $tenta_achar = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
                $resultado = $conecta->query($tenta_achar);
                if ($resultado->num_rows > 0){
                  $_SESSION['email'] = $email;
                  $_SESSION['senha'] = $senha;
                  header('location:anuncios.php');
                }
                else{
                  session_unset();
                  session_destroy();
                  unset($_POST['loginlogin']);
                  echo ' <div class="flex-sb-m w-full" style="justify-content: center;">
                  <div class="alert alert-warning fade show" role="alert">
                  <strong>Erro!</strong> Verifique os dados informados!
                  </div>
                  </div><br>';
                }
              }
              ?>
              <input type="submit" value="Continuar" name="loginlogin" class="btn solid" />
              <p class="social-text">Esqueceu a senha? <a href="recuperacao.php" class="aa">Clique aqui!</a></p>
            </form>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="sign-up-form">
              <h2 class="title">Cadastrar</h2>
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="name" name="nome" placeholder="Nome" required>
              </div>
              <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="senha" placeholder="Senha" required>
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="senha2" placeholder="Confimar Senha" required>
              </div>
              <?php
              if (isset($_POST['cadastroenviado'])){
                            //Receber as informações via formulario
                include_once "conectar.php";
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $senha2 = $_POST['senha2'];
                            //Inserir registro
                if ($senha == $senha2){
                  if (empty($email) || empty($senha) || empty($senha2)){
                    echo ' <div class="flex-sb-m w-full" style="justify-content: center;">
                    <div class="alert alert-warning fade show" role="alert">
                    <strong>Erro!</strong> Algum campo esta vazio, escreva algo!
                    </div>
                    </div><br>';
                  }else{
                    $sql = "INSERT INTO usuario(email,senha,escolha,cpf,membro,nome,avatar,sexo, escolaridade, estado) VALUES('$email','$senha','0',NULL, '0', '$nome', 'user.png', 'Selecione', 'Selecione', 'Selecione')";
                    if ($conecta->query($sql) === TRUE) {
                      echo ' <div class="flex-sb-m w-full" style="justify-content: center;">
                      <div class="alert alert-success fade show" role="alert">
                      <strong>Sucesso!</strong> Usuário registrado com sucesso!
                      </div>
                      </div><br>';
                    } else{
                      echo ' <div class="flex-sb-m w-full" style="justify-content: center;">
                      <div class="alert alert-warning fade show" role="alert">
                      <strong>Erro!</strong> O usuário informado já existe!
                      </div>
                      </div><br>';
                    }
                  }
                }else{
                  echo ' <div class="flex-sb-m w-full" style="justify-content: center;">
                  <div class="alert alert-danger fade show" role="alert">
                  <strong>Erro!</strong> As senhas não correspondem!
                  </div>
                  </div><br>';
                }
                $conecta->close();
              }
              ?>
              <input type="submit" name="cadastroenviado" class="btn solid" value="Criar" />
            </form>
          </div>
        </div>

        <div class="panels-container">
          <div class="panel left-panel">
            <div class="content">
              <h3>Novo aqui ?</h3>
              <p>Crie uma conta rápido e fácil!</p>
              <button class="btn transparent" id="sign-up-btn">criar</button>
            </div>
            <img src="login/imgg/log.svg" class="image" alt="" />
          </div>
          <div class="panel right-panel">
            <div class="content">
              <h3>Já possui uma conta?</h3>
              <p>Clique aqui para acessar o quebra-galho.</p>
              <button class="btn transparent" id="sign-in-btn">Entrar</button>
            </div>
            <img src="login/imgg/register.svg" class="image" alt="" />
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="login/app.js"></script>
</body>
</html>