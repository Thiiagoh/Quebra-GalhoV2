<?php
    include_once "conectar.php";
    $nome_emprego = $_POST['nome_emprego'];
    $nome_detalhes = $_POST['nome_detalhes'];
    $iddaconta = $_POST['iddaconta'];
    $deletar = $_POST['deletar'];
    $deletar2 = $_POST['deletar2'];
    $deletarInteresse = $_POST['deletarinteresse'];
    $conta = $_POST['conta'];
    $opcao = $_POST['opcao'];

    $iddapost = $_POST['contratarPostagem'];
    $id = $_POST['contratarPostagemId'];
	switch ($opcao) {
	    case 0:
    		$add = "UPDATE anuncio SET emprego='$nome_emprego', detalhes='$nome_detalhes' WHERE idAnuncio='$iddaconta'";
    		$conecta->query($add);
	    	unset($opcao);
	    	header('location:meus.php');
	    	break;
	   	case 1:
            $conecta->query($deletar);
            $conecta->query($deletar2);
            header('location:meus.php');
            break;
        case 2:
            $sql = "UPDATE anuncio SET status='Em aberto', contratante='' WHERE idAnuncio='$iddapost'";
            $conecta->query($sql);
            $conecta->query($deletarInteresse);
            header('location:meusemp.php');
            break;
        case 3:
            $sql = "UPDATE anuncio SET status='Pendente', contratante='$id' WHERE idAnuncio='$iddapost'";
            $conecta->query($sql);
            header('location:meusemp.php');
            break;
        case 4:
            $sql = "UPDATE usuario SET membro='Membro', dataMembro=DATE_ADD(now(), INTERVAL 30 DAY) WHERE idUser='$conta'";
            $conecta->query($sql);
            header('location:assinar.php');
            break;
        case 5:
            $sql = "UPDATE usuario SET membro='Vip', dataMembro=DATE_ADD(now(), INTERVAL 30 DAY) WHERE idUser='$conta'";
            $conecta->query($sql);
            header('location:assinar.php');
            break;
        case 6:
            $sql = "UPDATE anuncio SET status='Contratado' WHERE idAnuncio='$iddapost'";
            $conecta->query($sql);
            header('location:meus.php');
            break;
	}
?>