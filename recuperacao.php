<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Recuperar senha</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="login/login.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
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
                        <h2 class="title">Digite seu email</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <?php  
                        if(isset($_POST['esqueci'])){
                            include_once "conectar.php";
                            $email    = $_POST['email'];
                            $assunto  = 'Recuperacao de Senha';
                                // verifica se o e-mail está no cadastrado no sistem    
                            try{
                                $tenta_achar = "SELECT * FROM usuario WHERE email='$email'";
                                $sql = mysqli_query($conecta, "select * from usuario where email ='$email'");
                                $resultadosss = $conecta->query($tenta_achar);
                                if ($resultadosss->num_rows == 1){
                                    while($exibe = mysqli_fetch_assoc($sql)){
                                        $senhaUser = $exibe["senha"];
                                    }
                                    
                                    require_once('envia-email/PHPMailer/class.phpmailer.php');
                                    
                                    $Email = new PHPMailer();
                                    $Email->SetLanguage("br");
                                        $Email->IsSMTP(); // Habilita o SMTP 
                                        $Email->SMTPSecure = 'tls';
                                        $Email->SMTPAuth = true; //Ativa e-mail autenticado
                                        $Email->Host = 'smtp.gmail.com'; // Servidor de envio # verificar qual o host correto com a hospedagem as vezes fica como smtp.
                                        $Email->Port = '587'; // Porta de envio - verificar com o servidor
                                        $Email->Username = 'root.thuask@gmail.com'; //e-mail que será autenticado
                                        $Email->Password = 'Needforspeedcarbon2019'; // senha do email
                                        // ativa o envio de e-mails em HTML, se false, desativa.
                                        $Email->IsHTML(true); 
                                        // email do remetente da mensagem
                                        $Email->From = 'root.thuask@gmail.com';
                                        // nome do remetente do email
                                        $Email->FromName = utf8_decode($email);
                                        // Endereço de destino do emaail, ou seja, pra onde você quer que a mensagem do formulário vá?
                                        $Email->AddReplyTo($email, 'Quebra-Galho');
                                        $Email->AddAddress($email); // para quem será enviada a mensagem
                                        // informando no email, o assunto da mensagem
                                        $Email->Subject = utf8_decode($assunto);
                                        // Define o texto da mensagem (aceita HTML)
                                        $Email->Body .= "Seguem os dados para acesso do Sistema:<br /><br />
                                        <strong>Senha:</strong> $senhaUser<br /><br />
                                        
                                        <strong>Obs:</strong> Voc&ecirc; n&atilde;o precisa responder &agrave; este e-mail
                                        
                                        ";
                                        // verifica se está tudo ok com oa parametros acima, se nao, avisa do erro. Se sim, envia.
                                        if(!$Email->Send()){
                                            echo '<div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Erro ao enviar!</strong> Houve um problema ao recuperar sua senha.
                                            </div>';
                                            echo "Erro: " . $Email->ErrorInfo;
                                        }else{
                                            echo '<div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Sucesso!</strong> Uma mensagem com as informações de acesso foi enviada p/ o e-mail informado.
                                            </div>';
                                        }
                                    }else{
                                        echo '  <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Erro!</strong> O e-mail digitado não consta no sistema.
                                        </div>';}
                                    }catch(PDOException $e){
                                        echo $e;
                                    }   
                            }// se clicar
                            ?> 
                            <input type="submit" name="esqueci" class="btn solid" />
                        </form>
                    </div>
                </div>
                <div class="panels-container">
                    <div class="panel left-panel">
                        <div class="content">
                            <h3>Já possui uma conta?</h3>
                            <p>Clique aqui para acessar o quebra-galho.</p>
                            <a href="index.php"><button class="btn transparent">Entrar</button></a>
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