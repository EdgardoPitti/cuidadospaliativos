<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	$soap = new Accesatabla('soap');
	$det_soap = new Accesatabla('detalle_soap');
	$imp_diag = new Accesatabla('impresion_diagnostica');
	$det_imp_diag = new Accesatabla('detalle_impresion_diagnostica');
	$trazabilidad = new Accesatabla('trazabilidad');
	$cuidados = new Accesatabla('cuidados_tratamientos');
	$recetas = new Accesatabla('recetas_medicas');
	$det_recetas = new Accesatabla('detalle_receta');	
		
	$idp = $_GET['id'];
	$idsoap = $_GET['idsoap'];	
	$t = $_GET['t'];
	$sw = $_GET['sw'];	
	$id_impresion = $_GET['idimp'];
	$cuidado = $_GET['idc'];
	$receta = $_GET['idr'];
	
	$fecha = '"';
	$fecha .= $ds->dime('fecha');
	$fecha .= '"';
	
	if(empty($idsoap)) {
		$soap->nuevo();		
	}else{
		$soap->buscardonde('ID_SOAP = '.$idsoap.'');		
	}
	$idtrazabilidad = $idp.'_'.$ds->dime("agno")."/".$ds->dime("mes")."/".$ds->dime("dia");
	if($sw == 1){
		$trazabilidad->colocar('ID_TRAZABILIDAD', $idtrazabilidad);
		$trazabilidad->colocar('ID_PACIENTE', $idp);
		$trazabilidad->colocar('FECHA', $fecha);
		$trazabilidad->salvar();
		
		$soap->colocar('ID_TRAZABILIDAD', $idtrazabilidad);
		$soap->colocar('ID_PACIENTE', $idp);
		$soap->colocar('FECHA', $ds->dime('fecha'));
		$soap->colocar('MOTIVO_CONSULTA', $_POST['motivo']);	
	}elseif($sw == 2){		
		$soap->colocar('OBJETIVO_CONSULTA', $_POST['objetivo']);	
	}
	$soap->salvar();

	if($sw == 3) {
		if(empty($id_impresion)){
			$imp_diag->nuevo();			
			$imp_diag->colocar('ID_PACIENTE', $idp);
			$imp_diag->colocar('FECHA', $ds->dime('fecha'));	
			$imp_diag->colocar('ID_TRAZABILIDAD', $idtrazabilidad);
			$imp_diag->salvar();		
			
			$sql = 'SELECT MAX(ID_IMPRESION_DIAGNOSTICA) AS id FROM impresion_diagnostica';
			$matriz = $ds->db->obtenerArreglo($sql);
			$id_impresion = $matriz[0][id];		
				
		}
		
		$det_imp_diag->nuevo();			
		$det_imp_diag->colocar('ID_IMPRESION_DIAGNOSTICA', $id_impresion);		
		$det_imp_diag->colocar('ID_CIE10', $_POST['cie1']);
		$det_imp_diag->colocar('OBSERVACION',$_POST['observaciones']);
		$det_imp_diag->salvar();
		
		$det_soap->buscardonde('ID_SOAP = '.$idsoap.'');
		$det_soap->colocar('ID_IMPRESION_DIAGNOSTICA', $id_impresion);
		$det_soap->salvar();
		
		$impresion_diag = '&impresion='.$id_impresion.'';
		
	}elseif($sw == 4) {
		if(empty($cuidado)) {		
			$cuidados->nuevo();
		}else {
			$cuidados->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$cuidado.'');					
		}
		$cuidados->colocar('ID_PACIENTE', $idp);
		$cuidados->colocar('ID_TRAZABILIDAD', $idtrazabilidad);
		$cuidados->colocar('FECHA', $ds->dime('fecha'));
		$cuidados->colocar('CUIDADOS', $_POST['cuidados']);
		$cuidados->salvar();									
		
		$sql = 'SELECT MAX(ID_CUIDADOS_TRATAMIENTOS) AS id FROM cuidados_tratamientos';
		$matriz = $ds->db->obtenerArreglo($sql);
		$id_cuidado = $matriz[0][id];
		
		$det_soap->buscardonde('ID_SOAP = '.$idsoap.'');
		$det_soap->colocar('ID_CUIDADOS_TRATAMIENTOS', $id_cuidado);
		$det_soap->salvar();
		
		$idc = '&idc='.$id_cuidado.'';
		$idr = '&idr='.$receta.'';
			
	}elseif($sw == 5){
		if(empty($receta)) {
			$recetas->colocar('ID_CUIDADOS_TRATAMIENTOS', $cuidado);
			$recetas->colocar('ID_PACIENTE', $idp);
			$recetas->colocar('ID_PROFESIONAL', $_SESSION['idp']);
			$recetas->colocar('ID_TRAZABILIDAD', $idtrazabilidad);
			$recetas->colocar('FECHA_RECETA', $_POST['fechareceta']);
			$recetas->salvar();
		}
		$sql = 'SELECT MAX(ID_RECETA) AS ID FROM recetas_medicas';
		$matriz = $ds->db->obtenerArreglo($sql);
		$id_receta = $matriz[0][ID];
		if(!empty($_GET['rid'])) {
			echo $_GET['rid'];
			$det_recetas->buscardonde('ID_DETALLE_RECETA = '.$_GET['rid'].'');		
		}else {
			$det_recetas->nuevo();
		}
		$det_recetas->colocar('ID_RECETA', $id_receta);
		$det_recetas->colocar('ID_MEDICAMENTO', $_POST['idmedicamentos']);
		$det_recetas->colocar('ID_FORMA', $_POST['forma']);
		$det_recetas->colocar('CONCENTRACION', $_POST['concentracion']);
		$det_recetas->colocar('ID_UNIDAD', $_POST['unidad']);
		$det_recetas->colocar('ID_DOSIS', $_POST['verbos']);
		$det_recetas->colocar('DOSIS', $_POST['cantdosis']);
		$det_recetas->colocar('ID_FRECUENCIA_TRATAMIENTO', $_POST['frecuencia']);
		$det_recetas->colocar('ID_VIA', $_POST['via']);
		$det_recetas->colocar('TRATAMIENTO', $_POST['tratamiento']);
		$det_recetas->colocar('ID_PERIODO_TRATAMIENTO', $_POST['periodo']);
		$det_recetas->colocar('OTRAS_INDICACIONES', $_POST['observaciones']);
		$det_recetas->salvar();
		
		$idr = '&idr='.$id_receta.'';
		$idc = '&idc='.$cuidado.'';
		
	}elseif($sw == 6) {
		$soap->buscardonde('ID_SOAP = '.$idsoap.'');	
		$soap->colocar('OBSERVACIONES', $_POST['observaciones']);
		$soap->salvar();	
	}
	if(empty($idsoap)){
		$sql = 'SELECT max(ID_SOAP) as id FROM soap';
		$matriz = $ds->db->obtenerArreglo($sql);
		$id = $matriz[0][id];
	}else {
		$id = $idsoap;	
	}
	echo '<script>location.href="./?url=soap&id='.$idp.'&t='.$t.'&idsoap='.$id.''.$impresion_diag.''.$idc.''.$idr.'"</script>';
?>
