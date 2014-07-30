<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$escala = new Accesatabla('escala_edmont');
	$datoscompletado = new Accesatabla('completado');
	$paciente = new Accesatabla('datos_pacientes');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$residencia = new Accesatabla('residencia_habitual');

	$sbm = $_GET['sbm'];
	$idp = $_GET['idp'];
	$tipocompletado = $_POST['completado'];

	
	if($tipocompletado == 2){
		$datoscompletado->nuevo();
		$datoscompletado->colocar('CEDULA', $_POST['cedfamiliar']);
		$datoscompletado->colocar('PRIMER_NOMBRE', $_POST['primernombrefamiliar']);
		$datoscompletado->colocar('SEGUNDO_NOMBRE', $_POST['segundonombrefamiliar']);
		$datoscompletado->colocar('APELLIDO_PATERNO', $_POST['apellidopaternofamiliar']);
		$datoscompletado->colocar('APELLIDO_MATERNO', $_POST['apellidomaternofamiliar']);
		$datoscompletado->colocar('DIRECCION', $_POST['direccionfamiliar']);
		$datoscompletado->colocar('TELEFONO', $_POST['telefonofamiliar']);
		$datoscompletado->colocar('CELULAR', $_POST['celularfamiliar']);
		$datoscompletado->colocar('PARENTESCO', $_POST['parentesco']);
		$datoscompletado->colocar('ID_SEXO', $_POST['sexoflia']);
		$datoscompletado->salvar();
	}
	
	if($tipocompletado == 4){
		$datoscompletado->nuevo();
		$datoscompletado->colocar('CEDULA', $_POST['cedula']);
		$datoscompletado->colocar('PRIMER_NOMBRE', $_POST['primernombre']);
		$datoscompletado->colocar('SEGUNDO_NOMBRE', $_POST['segundonombre']);
		$datoscompletado->colocar('APELLIDO_PATERNO', $_POST['apellidopaterno']);
		$datoscompletado->colocar('APELLIDO_MATERNO', $_POST['apellidomaterno']);
		$datoscompletado->colocar('DIRECCION', $_POST['direccion']);
		$datoscompletado->colocar('TELEFONO', $_POST['telefono']);
		$datoscompletado->colocar('CELULAR', $_POST['celular']);
		$datoscompletado->colocar('ID_SEXO', $_POST['sexo']);
		$datoscompletado->salvar();
	}

	
	$fecha = $ds->dime('agno').'-'.$ds->dime('mes').'-'.$ds->dime('dia').'';
	

	$escala->nuevo();
	$escala->colocar('ID_PACIENTE', $idp);

	if($tipocompletado == 1 or $tipocompletado == 3){
		if($tipocompletado == 1){
			$paciente->buscardonde('NO_CEDULA = "'.$_POST['cedpaciente'].'"');
			$escala->colocar('ID_COMPLETADO', $paciente->obtener('ID_PACIENTE'));
		}else{
			$profesional->buscardonde('NO_CEDULA = "'.$_POST['cedprofesional'].'"');
			$escala->colocar('ID_COMPLETADO', $paciente->obtener('ID_PROFESIONAL'));
		}
	}else{
		$sql = 'SELECT MAX(ID_COMPLETADO) as id FROM completado';
		$matriz = $ds->db->obtenerarreglo($sql);
		$id = $matriz[0][id];
		$escala->colocar('ID_COMPLETADO', $id);
	}

	$escala->colocar('TIPO_COMPLETADO', $tipocompletado);
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

	//echo '<script>location.href="./?url=escala_edmont&sbm='.$sbm.'"</script>';
?>