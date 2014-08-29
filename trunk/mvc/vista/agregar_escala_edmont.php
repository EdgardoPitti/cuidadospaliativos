<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$escala = new Accesatabla('escala_edmonton');
	$det_soap = new Accesatabla('detalle_soap');
	$sbm = $_GET['sbm'];
	$idp = $_GET['idp'];
	$sw = $_GET['sw'];
	$idsoap = $_GET['idsoap'];
	
	$escala->nuevo();
	$escala->colocar('ID_PACIENTE', $idp);
	$escala->colocar('COMPLETADO_POR', $_POST['completado']);
	$escala->colocar('TIPO_CATEGORIA', $_POST['categoria']);
	$escala->colocar('FECHA', $ds->dime('fecha'));
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
	
	$sql = 'SELECT max(ID_ESCALA) as id FROM escala_edmonton';
	$matriz = $ds->db->obtenerarreglo($sql);
	$id = $matriz[0][id];	
	if(!empty($sw)) {
		$det_soap->nuevo();
		$det_soap->colocar('ID_SOAP', $idsoap);
		$det_soap->colocar('ID_ESCALA', $id);
		$det_soap->salvar();
		echo '<script>alert("ESAS-R almacenado exitosamente");location.href="./?url=soap&id='.$idp.'&idsoap='.$idsoap.'";</script>';	
	}else {
		echo '<script>alert("ESAS-R almacenado exitosamente");location.href="./?url=escala_edmont&sbm='.$sbm.'";</script>';
	}
?>
