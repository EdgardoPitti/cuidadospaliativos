<?php
	include_once('./mvc/modelo/Accesatabla.php');
		
	$det_receta = new Accesatabla('detalle_receta');
	$idsoap = $_GET['idsoap'];	
	$idimp = $_GET['idimp'];
	$idreceta = $_GET['receta'];
	$idpaciente = $_GET['id'];
	$t = $_GET['t'];
	$idc = $_GET['idc'];
	$idr = $_GET['idr'];
	
	$det_receta->buscardonde('ID_DETALLE_RECETA = '.$idreceta);
	$det_receta->colocar('ID_MEDICAMENTO', $_POST['idmedicamento']);
	$det_receta->colocar('ID_FORMA', $_POST['forma']);
	$det_receta->colocar('CONCENTRACION', $_POST['concentracion']);
	$det_receta->colocar('ID_UNIDAD', $_POST['unidad']);
	$det_receta->colocar('ID_DOSIS', $_POST['verbos']);
	$det_receta->colocar('DOSIS', $_POST['cantdosis']);
	$det_receta->colocar('ID_FRECUENCIA_TRATAMIENTO', $_POST['frecuencia']);
	$det_receta->colocar('ID_VIA', $_POST['via']);
	$det_receta->colocar('TRATAMIENTO', $_POST['tratamiento']);
	$det_receta->colocar('ID_PERIODO_TRATAMIENTO', $_POST['periodo']);
	$det_receta->colocar('OTRAS_INDICACIONES', $_POST['observaciones']);
	$det_receta->salvar();
	
	echo '<script>location.href="./?url=soap&idsoap='.$idsoap.'&id='.$idpaciente.'&impresion='.$idimp.'&t='.$t.'&idc='.$idc.'&idr='.$idr.'"</script>';
?>