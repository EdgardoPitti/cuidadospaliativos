<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$interconsulta = new Accesatabla('interconsulta');
	$respuesta = new Accesatabla('respuesta_interconsulta');
	$profesional = new Accesatabla('profesionales_salud');
	$datosprofesional = new Accesatabla('datos_profesionales_salud');
	$especialidad = new Accesatabla('especialidades_medicas');
	$atencion = new Accesatabla('atencion_paciente');






?>