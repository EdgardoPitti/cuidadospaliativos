<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$diagnostico = new Accesatabla('diagnostico');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$respuesta = new Accesatabla('respuesta_referencia');
	$detallediagnostico = new Accesatabla('detalle_diagnostico');
	$idsurco = $_GET['id'];
	$idp = $_GET['idp'];
	$profesional->buscardonde('NO_CEDULA = "'.$_POST['cedprofesional2'].'"');
	
	$diagnostico->nuevo();
	$diagnostico->salvar();

	$sql = 'SELECT max(ID_DIAGNOSTICO) as id FROM diagnostico';
	$matriz = $ds->db->obtenerArreglo($sql);
	$iddiagnostico = $matriz[0][id];
	
	$detallediagnostico->nuevo();
	$detallediagnostico->colocar("ID_DIAGNOSTICO", $iddiagnostico);
	$detallediagnostico->colocar("ID_CIE10", $_POST['cierespuesta']);
	$detallediagnostico->colocar("ID_FRECUENCIA", $_POST['frecuenciarespuesta']);
	$detallediagnostico->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
	$detallediagnostico->colocar("OBSERVACION", $_POST['observrespuesta']);
	$detallediagnostico->salvar();
	
	$respuesta->nuevo();
	$respuesta->colocar("FECHA", $_POST['fecharespuesta']);
	$respuesta->colocar("ID_DIAGNOSTICO", $iddiagnostico);
	$respuesta->colocar("HALLAZGOS_CLINICOS", $_POST['hallazgosclinicos']);
	$respuesta->colocar("TRATAMIENTO", $_POST['manejo_tratamiento']);
	$respuesta->colocar("REEVALUACION_ESPECIALIZADA", $_POST['reev_esp']);
	$respuesta->colocar("INSTITUCION_RESPONDE", $_POST['institucionrespondereceptora']);
	$respuesta->colocar("INSTALACION_RECEPTORA", $_POST['instalacionreceptorarespuesta']);
	$respuesta->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
	$respuesta->colocar("ID_SURCO", $idsurco);
	$respuesta->salvar();
	echo '<script>location.href="./?url=domiciliaria_surco&sbm=1&idp='.$idp.'"</script>'
?>