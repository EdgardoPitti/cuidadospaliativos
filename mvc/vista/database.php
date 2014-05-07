<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	//$sql = 'select d.PRIMER_NOMBRE, d.SEGUNDO_NOMBRE, d.APELLIDO_PATERNO, u.NO_IDENTIFICACION from pacientes p, datos_pacientes d, usuarios u where p.ID_USUARIO = u.ID_USUARIO AND p.ID_PACIENTE = d.ID_PACIENTE';	
	$sql = 'ALTER TABLE `cuidados_paliativos_panama`.`profesionales_salud` ADD COLUMN `ID_USUARIO` INTEGER(11)) UNSIGNED NOT NULL AFTER `ID_ESPECIALIDAD_MEDICA`;';	
	$ds->db->query($sql);
	//echo $ds->verArreglo($ds->db->obtenerArreglo($sql));
	
?>