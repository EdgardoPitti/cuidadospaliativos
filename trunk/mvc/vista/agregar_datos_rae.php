<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$rae = new Accesatabla('registro_admision_egreso');
	$trazabilidad = new Accesatabla('trazabilidad');
	$diag_adm = new Accesatabla('diagnostico_admision');
	$detalle_adm = new Accesatabla('detalle_diagnostico_admision');
	$diag_eg = new Accesatabla('diagnostico_egreso');
	$detalle_eg = new Accesatabla('detalle_diagnostico_egreso');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$cama = new Accesatabla('cama');
	
	$idpaciente = $_GET['id'];
	$id = $_GET['r'];
	$cama->buscardonde('ID_CAMA = '.$_POST['cama'].'');
	if(empty($id)){
		$fecha = '"';
		$fecha .= $ds->dime('agno').'-'.$ds->dime('mes').'-'.$ds->dime('dia');
		$fecha .= '"';	
		$idtrazabilidad = $idpaciente.'_'.$ds->dime('agno').'/'.$ds->dime('mes').'/'.$ds->dime('dia');
		$trazabilidad->nuevo();
		$trazabilidad->colocar("ID_TRAZABILIDAD", $idtrazabilidad);
		$trazabilidad->colocar("ID_PACIENTE", $idpaciente);
		$trazabilidad->colocar("FECHA",$fecha);
		$trazabilidad->salvar();
				
		$diag_adm->nuevo();
		$diag_adm->salvar();
		
		$sql = 'SELECT MAX(ID_DIAGNOSTICO_ADMISION) AS id FROM diagnostico_admision';
		$matriz = $ds->db->obtenerarreglo($sql);
		$iddiagadm = $matriz[0][id];
		
		$profesional->buscardonde('NO_CEDULA = "'.$_POST['cedprofesional'].'"');
		
		$detalle_adm->nuevo();
		$detalle_adm->colocar("ID_DIAGNOSTICO_ADMISION", $iddiagadm);
		$detalle_adm->colocar("ID_CIE10", $_POST['cie1']);
		$detalle_adm->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
		$detalle_adm->colocar("OBSERVACION", $_POST['observacion']);
		$detalle_adm->salvar();
		
		$diag_eg->nuevo();
		$diag_eg->salvar();
		
		$sql = 'SELECT MAX(ID_DIAGNOSTICO_EGRESO) AS id FROM diagnostico_egreso';
		$matriz = $ds->db->obtenerarreglo($sql);
		$iddiagegr = $matriz[0][id];
		
		$profesional->buscardonde('NO_CEDULA = "'.$_POST['cedprofesional2'].'"');
		
		$detalle_eg->nuevo();
		$detalle_eg->colocar("ID_DIAGNOSTICO_EGRESO", $iddiagegr);
		$detalle_eg->colocar("ID_FRECUENCIA", $_POST['frecuencia']);
		$detalle_eg->colocar("INFECCION_NOSOCOMIAL", $_POST['infeccion']);
		$detalle_eg->colocar("CAUSA_EXTERNA", $_POST['causa']);
		$detalle_eg->colocar("ID_CIE10", $_POST['cie2']);
		$detalle_eg->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
		$detalle_eg->colocar("OBSERVACION", $_POST['observacion1']);
		$detalle_eg->salvar();	
		
		$profesional->buscardonde('NO_CEDULA = "'.$_POST['cedprofesional3'].'"');			
		
		$rae->nuevo();			
		$rae->colocar("FECHA", $fecha);
		$rae->colocar("ID_PACIENTE", $idpaciente);
		$rae->colocar("ID_TRAZABILIDAD", $idtrazabilidad);
		$rae->colocar("ID_REFERIDO", $_POST['referido']);
		$rae->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
		$rae->colocar("ID_DIAGNOSTICO_ADMISION", $iddiagadm);
		$rae->colocar("ID_DIAGNOSTICO_EGRESO", $iddiagegr);
	}else{
		$rae->buscardonde('ID_REGISTRO_ADMISION_EGRESO = '.$id.'');
	}	
	$rae->colocar("ID_SALA", $cama->obtener('ID_SALA'));
	$rae->colocar("ID_CAMA", $_POST['cama']);
	$rae->colocar("ID_CONDICION_SALIDA",$_POST['condicionsalida']);
	$rae->colocar("ID_MOTIVO_SALIDA", $_POST['motivo']);
	$rae->colocar("MUERTE_EN_SOP", $_POST['muerte']);
	$rae->colocar("AUTOPSIA", $_POST['autopsia']);
	$rae->colocar("FECHA_AUTOPSIA", $_POST['fechautopsia']);
	$rae->colocar("TOTAL_DIAS_ESTANCIA",$_POST['dias']);
	$rae->salvar();
	
	include_once('./mvc/vista/hospitalaria_rae_evolucion.php');
?>