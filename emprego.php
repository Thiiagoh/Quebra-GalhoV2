<?php
    include_once "conectar.php";
    $nome_emprego = $_POST['nome_emprego'];
	$nome_detalhes = $_POST['nome_detalhes'];
    $idcaconta = $_POST['iddaconta'];

    $sql = "INSERT INTO anuncio(emprego, idUser, detalhes) VALUES('$nome_emprego', '$idcaconta', '$nome_detalhes')";
    $conecta->query($sql);
    unset($sql);
    header('location:anuncios.php');
?>

