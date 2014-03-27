<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$servicio = new Accesatabla('servicios_medicos');
	
	$servicio->nuevo();
	$servicio->colocar("DESCRIPCION", $_POST['servicio']);
	$servicio->colocar("ID_TIEMPO_ATENCION", $_POST['tiempo']);
	$servicio->salvar();
	
	include_once('./mvc/vista/servicios.php');
	echo '<SCRIPT LANGUAGE="javascript">location.href="./?url=servicios"</SCRIPT>';
	
?>