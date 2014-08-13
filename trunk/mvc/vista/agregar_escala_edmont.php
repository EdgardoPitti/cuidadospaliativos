<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$escala = new Accesatabla('escala_edmonton');

	$sbm = $_GET['sbm'];
	$idp = $_GET['idp'];
	if($ds->dime('dia') < 10){
		$dia = '0'.$ds->dime('dia');	
	}else {
		$dia = $ds->dime('dia');	
	}
	if($ds->dime('mes') < 10) {
		$mes = '0'.$ds->dime('mes');
	}else{
		$mes = $ds->dime('mes');
	}
	$fecha = $ds->dime('agno').'-'.$mes.'-'.$dia.'';

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

	echo '<script>alert("ESAS-R almacenado exitosamente");location.href="./?url=escala_edmont&sbm='.$sbm.'";</script>';
?>
