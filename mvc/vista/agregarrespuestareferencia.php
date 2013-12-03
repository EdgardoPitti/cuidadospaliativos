<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$surco = new Accesatabla('surco');
	$diagnostico = new Accesatabla('diagnostico');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$respuesta = new Accesatabla('respuesta_referencia');
	$idsurco = $_GET['id'];
	
	$profesional->buscardonde('NO_CEDULA = "'.$_POST['profesionalrespuesta'].'"');
	
	$d = $diagnostico->buscardonde('ID_CIE10 = "'.$_POST['cierespuesta'].'" AND ID_FRECUENCIA = '.$_POST['frecuenciarespuesta'].'');
	if($d){
		$iddiagnostico = $diagnostico->obtener('ID_DIAGNOSTICO');
	}else{
		$diagnostico->nuevo();
		$diagnostico->colocar("ID_FRECUENCIA", $_POST['frecuenciarespuesta']);
		$diagnostico->colocar("ID_CIE10", $_POST['cierespuesta']);
		$diagnostico->salvar();

		$sql = 'SELECT max(ID_DIAGNOSTICO) as id FROM diagnostico';
		$matriz = $ds->db->obtenerArreglo($sql);
		$iddiagnostico = $matriz[0][id];
	}
	
	$respuesta->nuevo();
	$respuesta->colocar("FECHA", $_POST['fecharespuesta']);
	$respuesta->colocar("ID_DIAGNOSTICO", $iddiagnostico);
	$respuesta->colocar("HALLAZGOS_CLINICOS", $_POST['hallazgosclinicos']);
	$respuesta->colocar("TRATAMIENTO", $_POST['manejo_tratamiento']);
	$respuesta->colocar("REEVALUACION_ESPECIALIZADA", $_POST['reev_esp']);
	$respuesta->colocar("INSTITUCION_RESPONDE", $_POST['institucionrespondereceptora']);
	$respuesta->colocar("INSTALACION_RECEPTORA", $_POST['instalacionreceptorarespuesta']);
	$respuesta->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
	$respuesta->salvar();
	
	$sql = 'SELECT max(ID_RESPUESTA_REFERENCIA) as id FROM respuesta_referencia';
	$idrespuesta = $ds->db->obtenerArreglo($sql);
	
	$surco->buscardonde('ID_SURCO = '.$idsurco.'');
	$surco->colocar("ID_RESPUESTA_REFERENCIA", $idrespuesta);
	$surco->salvar();
	
	$cont.='
			<center>
				<h1>Datos Salvados Correctamente</h1>
				<a href="./?url=domiciliaria_surco">Click para continuar...</a>
			</center>
			';
	$ds->contenido($cont);
	$ds->mostrar();
?>