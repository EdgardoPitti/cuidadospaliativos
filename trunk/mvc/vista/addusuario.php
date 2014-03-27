<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$usuario = new Accesatabla('usuarios');
	
	$usuario->nuevo();
	$usuario->colocar("NO_IDENTIFICACION", $_POST['no_identificacion']);
	$usuario->colocar("CLAVE_ACCESO", $_POST['clave']);
	$usuario->colocar("ID_GRUPO_USUARIO", $_POST['grupo']);
	$usuario->salvar();
	include_once('./mvc/vista/usuarios.php');
	echo '<SCRIPT LANGUAGE="javascript">location.href = "./?url=usuarios"</SCRIPT>';
?>