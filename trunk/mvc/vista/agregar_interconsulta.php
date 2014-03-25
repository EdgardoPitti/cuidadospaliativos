<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$interconsulta = new Accesatabla('interconsulta');
	$interconsulta->colocar("FECHA", $_POST['fecha']);
	$interconsulta->colocar("ID_PROFESIONAL", $_POST['nombre_esp']);
	$interconsulta->colocar("ID_PACIENTE", $_GET['idp']);
	$interconsulta->colocar("OBSERVACIONES", $_POST['obs_coment']);
	$interconsulta->salvar();
	include_once('./mvc/vista/ambulatoria_interconsulta.php');
	echo '<SCRIPT LANGUAGE="javascript">location.href = "./?url=ambulatoria_interconsulta&idp='.$_GET['idp'].'&sbm=2";</SCRIPT>';
?>