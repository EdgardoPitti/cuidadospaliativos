<?php
	include_once('../modelo/Accesatabla.php');
	$prof_salud = new Accesatabla('profesionales_salud');
	$dat_prof_salud = new Accesatabla('datos_profesionales_salud');
	include_once('../modelo/diseno.php');
	$ds = new Diseno();
	$cont.='
			<option value="0"></option>';		
	$x = $prof_salud->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$_GET['idespecialidad'].'');
	while($x){
		$dat_prof_salud->buscardonde('ID_PROFESIONAL = '.$prof_salud->obtener('ID_PROFESIONAL').'');			
		$cont.='
			<option value="'.$dat_prof_salud->obtener('ID_PROFESIONAL').'">'.$dat_prof_salud->obtener('PRIMER_NOMBRE').' '.$dat_prof_salud->obtener('APELLIDO_PATERNO').'</option>';
		$x = $prof_salud->releer();
	}		
	echo $ds->latino($cont);
?>