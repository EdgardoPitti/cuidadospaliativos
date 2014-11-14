<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$usuarios = new Accesatabla('usuarios');
	$usuarios->buscardonde('ID_USUARIO = '.$_GET['id'].'');
	$usuarios->colocar("TERMINOS", "1");
	$usuarios->salvar();
	$_SESSION['terminos'] =  1;
	echo '<script>location.href="./?url=inicio";</script>';
?>
