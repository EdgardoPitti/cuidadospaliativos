<?php
	error_reporting(E_ALL & E_NOTICE & E_WARNING & E_DEPRECATED);
	include_once('../modelo/Accesatabla.php');
	
	$profesional = new Accesatabla('datos_profesionales_salud');
	$detalle_rda = new Accesatabla('detalle_rda');
	$zona = new Accesatabla('zona');
	$frecuencia = new Accesatabla('frecuencia');
	$tipo_atencion = new Accesatabla('tipo_atencion');
	$estado_paciente = new Accesatabla('estado_paciente');
	$paciente = new Accesatabla('datos_pacientes');
	$diagnostico = new Accesatabla('detalle_diagnostico');
	$cie10 = new Accesatabla('cie10');
	$actividad = new Accesatabla('actividad');
	
	$idrda = $_GET['rda'];

	$detalle_rda->buscardonde('ID_RDA = '.$idrda.'');

	$zona->buscardonde('ID_ZONA = '.$detalle_rda->obtener('ID_ZONA').'');
	$paciente->buscardonde('ID_PACIENTE = '.$detalle_rda->obtener('ID_PACIENTE').'');
	$frecuencia->buscardonde('ID_FRECUENCIA = '.$detalle_rda->obtener('ID_FRECUENCIA').'');
	$tipo_atencion->buscardonde('ID_TIPO_ATENCION = '.$detalle_rda->obtener('ID_TIPO_ATENCION').'');
	$diagnostico->buscardonde('ID_DIAGNOSTICO = '.$detalle_rda->obtener('ID_DIAGNOSTICO').'');
	$cie10->buscardonde('ID_CIE10 = "'.$diagnostico->obtener('ID_CIE10').'"');
	$actividad->buscardonde('ID_ACTIVIDAD = '.$detalle_rda->obtener('ID_ACTIVIDAD').'');
	$estado_paciente->buscardonde('ID_ESTADO_PACIENTE = '.$detalle_rda->obtener('ID_ESTADO_PACIENTE').'');
	$segundonombre = $paciente->obtener('SEGUNDO_NOMBRE');
	$segundoapellido = $paciente->obtener('APELLIDO_MATERNO');
	$observacion = $diagnostico->obtener('OBSERVACION'); 

	if($detalle_rda->obtener('REFERIDO_PACIENTE') == 0){
		$referido = 'No Referido';
	}else{
		$referido = 'Dentro de la Inst.';
	}

	$profesional->buscardonde('ID_PROFESIONAL = '.$diagnostico->obtener('ID_PROFESIONAL').'');
	$segundonombre = $profesional->obtener('SEGUNDO_NOMBRE');
	$segundoapellido = $profesional->obtener('APELLIDO_MATERNO');
	$prof_diag = $profesional->obtener('PRIMER_NOMBRE').' '.$segundonombre[0].'. '.$profesional->obtener('APELLIDO_PATERNO').' '.$segundoapellido[0].'.';

	$profesional->buscardonde('ID_PROFESIONAL = '.$actividad->obtener('ID_PROFESIONAL').'');
	$segundonombre = $profesional->obtener('SEGUNDO_NOMBRE');
	$segundoapellido = $profesional->obtener('APELLIDO_MATERNO');
	$prof_act = $profesional->obtener('PRIMER_NOMBRE').' '.$segundonombre[0].'. '.$profesional->obtener('APELLIDO_PATERNO').' '.$segundoapellido[0].'.';

	$data = array(
		'zona' 	=> $zona->obtener('ZONA'),
		'paciente' => utf8_encode($paciente->obtener('PRIMER_NOMBRE').' '.$segundonombre[0].'. '.$paciente->obtener('APELLIDO_PATERNO').' '.$segundoapellido[0].'.'),
		'frecuencia' => $frecuencia->obtener('FRECUENCIA'),
		'tipo_atencion' => $tipo_atencion->obtener('TIPO_ATENCION'),
		'cie10' => $cie10->obtener('DESCRIPCION'),
		'prof_diag' => utf8_encode($prof_diag),
		'actividad' => utf8_encode($actividad->obtener('ACTIVIDAD')),
		'prof_act' => utf8_encode($prof_act),
		'estado' => $estado_paciente->obtener('LETRA_ESTADO'),
		'referido' => $referido,
		'observacion' => utf8_encode($observacion)
	);

	echo json_encode($data);
