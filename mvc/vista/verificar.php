<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$usuarios = new Accesatabla('usuarios');
	$usuario = $_POST['username'];
	$pass = $_POST['password'];
	$u = $usuarios->buscardonde('NO_IDENTIFICACION = "'.$usuario.'" AND CLAVE_ACCESO = "'.$pass.'"');
	if($u){
		$_SESSION['idu'] = $usuarios->obtener('ID_USUARIO');
		include_once('./mvc/vista/inicio.php');
	}else{
		$_SESSION['idu'] = '';
		$_SESSION['errorlogin'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#" title="Cerrar">x</a>Usuario o Contrase&ntilde;a Incorrecto!</div>';
		include_once('./mvc/vista/login.php');
	}
	
?>