<?php
    include_once "conectar.php";
    $nome_emprego = $_POST['nome_emprego'];
    $nome_detalhes = $_POST['nome_detalhes'];
    $iddaconta = $_POST['iddaconta'];
    $deletar = $_POST['deletar'];
    $opcao = $_POST['opcao'];

	switch ($opcao) {
	    case 0:
    		$conecta = mysqli_connect($nome_servidor, $nome_usuario, $senhaBanco, $nome_banco);
    		$add = "UPDATE anuncio SET emprego='$nome_emprego', detalhes='$nome_detalhes' WHERE idAnuncio='$iddaconta'";
    		$conecta->query($add);
	    	unset($opcao);
	    	header('location:meus.php');
	    	break;
	   	case 1:
	        $conecta = mysqli_connect($nome_servidor, $nome_usuario, $senhaBanco, $nome_banco); 
    		$conecta->query($deletar);
    		header('location:meus.php');
	        break;
	}
?>