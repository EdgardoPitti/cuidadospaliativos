<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$personas = new Accesatabla('personas');
	$personas->nuevo();
	$personas->colocar("primer_nombre",$_POST['primernombre']);
	$personas->colocar("segundo_nombre",$_POST['segundonombre']);
	$personas->colocar("primer_apellido",$_POST['primerapellido']);
	$personas->colocar("segundo_apellido",$_POST['segundoapellido']);
	$personas->colocar("cedula",$_POST['cedula']);
	$personas->colocar("id_tipo_de_sangre",$_POST['tiposangre']);
	$personas->colocar("fecha_de_nacimiento",$_POST['fechanacimiento']);
	$personas->colocar("id_nacionalidad",$_POST['nacionalidad']);
	$personas->colocar("asegurado",$_POST['tipo']);
	if ($_POST['tipo'] == 1){
		$personas->colocar("numero_de_seguro",$_POST['numeroseguro']);
	}
	$personas->colocar("id_estado_civil",$_POST['estadocivil']);
	$personas->colocar("nombre_padre",$_POST['nombrepadre']);
	$personas->colocar("nombre_madre",$_POST['nombremadre']);
	$personas->colocar("ocupacion",$_POST['ocupacion']);
	$personas->colocar("femenino",$_POST['sexo']);
	$personas->colocar("telefono",$_POST['telefono']);
	$personas->colocar("id_provincia_residencia",$_POST['provincias']);
	$personas->colocar("id_distrito_residencia",$_POST['distritos']);
	$personas->colocar("id_corregimiento_residencia",$_POST['corregimientos']);
	$personas->colocar("direccion_detallada",$_POST['direcciondetallada']);
	$personas->colocar("id_etnia",$_POST['etnia']);
	$personas->colocar("id_provincia_nacimiento",$_POST['provinciasnacimiento']);
	$personas->colocar("id_distrito_nacimiento",$_POST['distritosnacimiento']);
	$personas->colocar("id_corregimiento_nacimiento",$_POST['corregimientosnacimiento']);
	$personas->salvar();
	echo 'Grabado Exitosamente';
	
?>