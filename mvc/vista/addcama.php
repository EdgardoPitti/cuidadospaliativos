<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$cama = new Accesatabla('cama');
	
	$cama->nuevo();
	$cama->colocar("CAMA", $_POST['cama']);
	$cama->colocar("ID_SALA", $_POST['sala']);
	$cama->salvar();
	include_once('./mvc/vista/camas.php');
	echo '<SCRIPT languague="JAVASCRIPT">location.href = "./?url=camas"</SCRIPT>'
?>