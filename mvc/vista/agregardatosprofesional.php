<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$datos_prof_salud = new Accesatabla('datos_profesionales_salud');
	$prof_salud = new Accesatabla('profesionales_salud');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();

	$prof_salud->nuevo();
	$prof_salud->colocar('ID_ESPECIALIDAD_MEDICA',$_POST['especialidad']);	
	$prof_salud->salvar();
	
	$sql = 'SELECT MAX(ID_PROFESIONAL) AS id FROM profesionales_salud';
	$id = $ds->db->obtenerArreglo($sql);
		

	$datos_prof_salud->nuevo();
	$datos_prof_salud->colocar('ID_PROFESIONAL',$id[0][id]);
	$datos_prof_salud->colocar('NO_CEDULA',$_POST['cedula']);
	$datos_prof_salud->colocar('PRIMER_NOMBRE',$_POST['primernombre']);
	$datos_prof_salud->colocar('SEGUNDO_NOMBRE',$_POST['segnombre']);
	$datos_prof_salud->colocar('APELLIDO_PATERNO',$_POST['primerapellido']);
	$datos_prof_salud->colocar('APELLIDO_MATERNO',$_POST['segapellido']);
	$datos_prof_salud->colocar('NO_IDONEIDAD',$_POST['idoneidad']);
	$datos_prof_salud->colocar('NO_REGISTRO',$_POST['registro']);
	$datos_prof_salud->colocar('TELEFONO_CASA',$_POST['telefono']);
	$datos_prof_salud->colocar('TELEFONO_CELULAR',$_POST['celular']);
	$datos_prof_salud->colocar('E_MAIL',$_POST['email']);
	$datos_prof_salud->salvar();
	include_once('./mvc/vista/inicio.php');
?>