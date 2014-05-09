<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$id = $_GET['id'];
	if($_SESSION['idgu'] <> 3){
		if($_SESSION['idgu'] == 1){
			$vista = 'ambulatoria_atencionalpaciente&sbm=2&id='.$id.'';
		}else{
			$vista = 'inicio';
		}
		echo '<script>alert("Solo los profesionales pueden registrar las respuestas de las interconsultas."); location.href="./?url='.$vista.'"</script>';
	}else{
		if($ds->dime('mes') < 10){
			$mes = '0';
		}
		if($ds->dime('hoy es') < 10){
			$dia = '0';
		}
		$mes .= $ds->dime('mes');
		$dia .= $ds->dime('hoy es');
		$fecha = ''.$ds->dime('agno').'-'.$mes.'-'.$dia.'';
		$respuesta = new Accesatabla('respuesta_interconsulta');
		$interconsulta = new Accesatabla('interconsulta');
		$i = $interconsulta->buscardonde('ID_INTERCONSULTA = '.$_POST['cod_interconsulta'].'');
		if($i){
			$respuesta->colocar("ID_INTERCONSULTA", $_POST['cod_interconsulta']);
			$respuesta->colocar("ID_PROFESIONAL", $_SESSION['idp']);
			$respuesta->colocar("FECHA", '"'.$fecha.'"');
			$respuesta->colocar("OBSERVACIONES", $_POST['observaciones']);
			$respuesta->colocar("ID_PACIENTE", $id);
			
			$respuesta->salvar();
			$msj = 'Respuesta de Interconsulta Registrada.';
		}else{
			$msj = 'El codigo de la Interconsulta no existe.';
		}
		echo '<script>alert("'.$msj.'"); location.href="./?url=ambulatoria_atencionalpaciente&id='.$id.'&sbm=2"</script>';	
	}

?>