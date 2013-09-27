<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$surco = new Accesatabla('surco');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$idpaciente = $_GET['id']
	$trazabilidad = new Accesatabla('trazabilidad');
	$historiapaciente = new Accesatabla('historia_paciente');
	$examenfisico = new Accesatabla('examen_fisico');
	$trazabilidad->colocar("ID_PACIENTE", $);
	$trazabilidad->colocar("FECHA",$ds->dime('año').'-'.$ds->dime('mes').'-'.$ds->dime('dia'));
	$trazabilidad->salvar();
	
	
	$examenfisico->colocar("ID_PACIENTE", $idpaciente);
	$examenfisico->colocar("hora", $_POST['hora']);
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
	$profesional = $_POST['nombrerefiere'];
	list($primernombre, $segundonombre, $primerapellido, $segundoapellido) = explode(" ", $profesional);
	$profesional->buscaradonde('PRIMER_NOMBRE = "'.$primernombre.'" AND SEGUNDO_NOMBRE = "'.$segundonombre.'" AND APELLIDO_PATERNO = "'.$primerapellido.'" AND APELLIDO_MATERNO = "'.$segundoapellido.'"');
	
	
	$sql = 'SELECT max(ID_TRAZABILIDAD) as id FROM trazabilidad';
	$idtrazabilidad = $ds->db->obtenerArreglo($sql);
	$surco->colocar("ID_PACIENTE", $id);
	$surco->colocar("ID_TRAZABILIDAD", $idtrazabilidad[0][id]);
	$surco->colocar("FECHA",$ds->dime('año').'-'.$ds->dime('mes').'-'.$ds->dime('dia'));
	$surco->colocar("INSTALACION_REFIERE", $_POST['']);
	$surco->colocar("INSTALACION_RECEPTORA", $_POST['']);
	$surco->colocar("ID_MOTIVO_REFERENCIA", $_POST['motivoreferencia']);
	$surco->colocar("ID_CLASIFICACION_ATENCION_SOLICITADA", $_POST['clasificacionatencion']);
	$surco->colocar("ID_HISTORIA_PACIENTE", $idhistoriapaciente);
	$surco->colocar("ID_RESULTADOS_EXAMEN_DIAGNOSTICO",);
	$surco->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
	$surco->colocar("ID_RESPUESTA_REFERENCIA",);
	$surco->salvar();


?>