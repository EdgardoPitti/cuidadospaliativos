<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$sala = new Accesatabla('sala');
	$sala->nuevo();
	$sala->colocar("SALA", $_POST['sala']);
	$sala->salvar();
	include_once('./mvc/vista/salas.php');
	echo '<SCRIPT LANGUAGE="javascript">location.href="./?url=salas"</SCRIPT>';
?>