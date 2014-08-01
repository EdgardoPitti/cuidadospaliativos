<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$escala = new Accesatabla('escala_edmont');
	$paciente = new Accesatabla('datos_pacientes');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$residencia = new Accesatabla('residencia_habitual');

	$sbm = $_GET['sbm'];
	$idp = $_GET['idp'];
		
	
	$fecha = $ds->dime('agno').'-'.$ds->dime('mes').'-'.$ds->dime('dia').'';

	$escala->nuevo();
	$escala->colocar('ID_PACIENTE', $idp);
	$escala->colocar('COMPLETADO_POR', $_POST['completado']);
	$escala->colocar('TIPO_CATEGORIA', $_POST['categoria']);
	$escala->colocar('FECHA', $fecha);
	$escala->colocar('DOLOR', $_POST['dolor']);
	$escala->colocar('CANSANCIO', $_POST['cansancio']);
	$escala->colocar('NAUSEA', $_POST['nausea']);
	$escala->colocar('DEPRESION', $_POST['depresion']);
	$escala->colocar('ANSIEDAD', $_POST['ansiedad']);
	$escala->colocar('SOMNOLENCIA', $_POST['somnolencia']);
	$escala->colocar('APETITO', $_POST['apetito']);
	$escala->colocar('BIENESTAR', $_POST['bienestar']);
	$escala->colocar('AIRE', $_POST['aire']);
	$escala->colocar('DORMIR', $_POST['dormir']);
	$escala->salvar();

	echo '<script>location.href="./?url=escala_edmont&sbm='.$sbm.'";alert("ESAS almacenado exitosamente");</script>';
?>