<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$surco = new Accesatabla('surco');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$idpaciente = $_GET['idp'];
	$trazabilidad = new Accesatabla('trazabilidad');
	$historiapaciente = new Accesatabla('historia_paciente');
	$examenfisico = new Accesatabla('examen_fisico');
	$tipoexamen = new Accesatabla('tipo_examen');
	$resultados = new Accesatabla('resultados_examen_diagnostico');
	$diagnostico = new Accesatabla('diagnostico');	
	$detallediagnostico = new Accesatabla('detalle_diagnostico');

	$fecha = '"';
	$fecha .= $ds->dime('año').'-'.$ds->dime('mes').'-'.$ds->dime('dia');
	$fecha .= '"';	
	$idtrazabilidad = $idpaciente.'_'.$ds->dime('año').'/'.$ds->dime('mes').'/'.$ds->dime('dia');
	$trazabilidad->colocar("ID_TRAZABILIDAD", $idtrazabilidad);
	$trazabilidad->colocar("ID_PACIENTE", $idpaciente);
	$trazabilidad->colocar("FECHA",$fecha);
	$trazabilidad->salvar();
		
	$examenfisico->colocar("ID_PACIENTE", $idpaciente);
	$examenfisico->colocar("HORA", $_POST['hora']);
	$examenfisico->colocar("PRESION_ARTERIAL", $_POST['pa']);
	$examenfisico->colocar("FRECUENCIA_CARDIACA", $_POST['fc']);
	$examenfisico->colocar("FRECUENCIA_RESPIRATORIA", $_POST['fr']);
	$examenfisico->colocar("FRECUENCIA_CARDIACA_FETAL", $_POST['fcf']);
	$examenfisico->colocar("TEMPERATURA", $_POST['temperatura']);
	$examenfisico->colocar("PESO", $_POST['peso']);
	$examenfisico->colocar("TALLA", $_POST['talla']);
	$examenfisico->salvar();
	
	$sql = 'SELECT max(ID_EXAMEN_FISICO) as id FROM examen_fisico';
	$idexamenfisico = $ds->db->obtenerArreglo($sql);
	$historiapaciente->colocar("ANAMNESIS", $_POST['anamnesis']);
	$historiapaciente->colocar("ID_EXAMEN_FISICO", $idexamenfisico[0][id]);
	$historiapaciente->colocar("OBSERVACIONES", $_POST['observaciones']);
	$historiapaciente->salvar();

	$sql = 'SELECT max(ID_HISTORIA_PACIENTE) as id FROM historia_paciente';
	$idhistoriapaciente = $ds->db->obtenerArreglo($sql);
	$cedulaprofesional = $_POST['cedprofesional'];
	$profesional->buscardonde('NO_CEDULA = "'.$cedulaprofesional.'"');
	
	
	$sql = 'SELECT max(ID_TRAZABILIDAD) as id FROM trazabilidad';
	$idtrazabilidad = $ds->db->obtenerArreglo($sql);
	$surco->colocar("ID_PACIENTE", $idpaciente);
	$surco->colocar("ID_TRAZABILIDAD", $idtrazabilidad[0][id]);
	$surco->colocar("FECHA",$fecha);
	$surco->colocar("INSTALACION_REFIERE", $_POST['instalacionrefiere']);
	$surco->colocar("INSTALACION_RECEPTORA", $_POST['instalacionreceptora']);
	$surco->colocar("ID_MOTIVO_REFERENCIA", $_POST['motivoreferencia']);
	$surco->colocar("ID_CLASIFICACION_ATENCION_SOLICITADA", $_POST['clasificacionatencion']);
	$surco->colocar("ID_HISTORIA_PACIENTE", $idhistoriapaciente[0][id]);
	$surco->colocar("ID_SERVICIO", $_POST['serviciomedico']);
	$surco->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
	$surco->salvar();

	$sql = 'SELECT max(ID_SURCO) as id FROM surco';
	$idsurco = $ds->db->obtenerArreglo($sql);
	$x = $tipoexamen->buscardonde('ID_TIPO_EXAMEN > 0');
	while($x){
		$diagnostico->nuevo();
		$diagnostico->salvar();
		$sql = 'SELECT max(ID_DIAGNOSTICO) as id FROM diagnostico';
		$matriz = $ds->db->obtenerArreglo($sql);
		$iddiagnostico = $matriz[0][id];
		
		$detallediagnostico->nuevo();
		$detallediagnostico->colocar("ID_DIAGNOSTICO",$iddiagnostico);
		$detallediagnostico->colocar("ID_CIE10", $_POST['cie'.$tipoexamen->obtener('ID_TIPO_EXAMEN').'']);
		$detallediagnostico->colocar("ID_FRECUENCIA", $_POST['frec'.$tipoexamen->obtener('ID_TIPO_EXAMEN').'']);
		$detallediagnostico->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
		$detallediagnostico->colocar("OBSERVACION", $_POST['obser'.$tipoexamen->obtener('ID_TIPO_EXAMEN').'']);
		$detallediagnostico->salvar();
		
		$fecha = '"';
		$fecha .= $_POST['fec_examen_'.$tipoexamen->obtener('ID_TIPO_EXAMEN').''];
		$fecha .= '"';
		$resultados->nuevo();
		$resultados->colocar("ID_TIPO_EXAMEN", $tipoexamen->obtener('ID_TIPO_EXAMEN'));
		$resultados->colocar("ID_DIAGNOSTICO", $iddiagnostico);
		$resultados->colocar("TRATAMIENTO", $_POST['tratamiento'.$tipoexamen->obtener('ID_TIPO_EXAMEN').'']);
		$resultados->colocar("FECHA", $fecha);
		$resultados->colocar("ID_SURCO", $idsurco[0][id]);
		$resultados->salvar();
		$x = $tipoexamen->releer();

	}
	include_once('./mvc/vista/domiciliaria_surco.php');
?>