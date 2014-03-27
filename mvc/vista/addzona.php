<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$zona = new Accesatabla('zona');
	$zona->nuevo();
	$zona->colocar("ZONA", $_POST['zona']);
	$zona->salvar();
	include_once('./mvc/vista/zonas.php');
	echo '<script language="javascript">location.href="./?url=zonas"</script>';
?>