<?php
    include_once "conectar.php";

	$iddapost = $_POST['iddapost'];
	$id = $_POST['id'];

	$sql = "UPDATE anuncio SET status='Contratado', contratante='$id' WHERE idAnuncio='$iddapost'";
	$conecta->query($sql);
    unset($sql);
    header('location:anuncios.php');
?>