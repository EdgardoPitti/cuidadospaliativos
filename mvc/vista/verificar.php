<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$usuarios = new Accesatabla('usuarios');
	$usuario = $_POST['username'];
	$pass = $_POST['password'];
	$sesiones = new Accesatabla('sesiones_usuarios');
	$u = $usuarios->buscardonde('NO_IDENTIFICACION = "'.$usuario.'" AND CLAVE_ACCESO = "'.$pass.'"');
	if($u){
		$_SESSION['idu'] = $usuarios->obtener('ID_USUARIO');
		$_SESSION['idgu'] = $usuarios->obtener('ID_GRUPO_USUARIO');
		$_SESSION['user'] = $usuarios->obtener('NO_IDENTIFICACION');
		$hora = $ds->dime('hora');
		$minutos = $ds->dime('minuto');
		if($hora < 10){
			$hora = '0';
			$hora .= $ds->dime('hora');
		}
		if($minutos < 10){
			$minutos = '0'; 
			$minutos .=  $ds->dime('minuto');
		}
		$fecha .= $ds->dime('agno').'-'.$ds->dime('mes').'-'.$ds->dime('dia').'/';
		$fecha .= $hora.':'.$minutos.'';
		$sesiones->nuevo();
		$sesiones->colocar("ID_USUARIO", $usuarios->obtener('ID_USUARIO'));
		$sesiones->colocar("FECHA_SESION", $fecha);
		$sesiones->colocar("IP_USUARIO", $ds->ip());
		$sesiones->salvar();
		include_once('./mvc/vista/inicio.php');
		echo '<SCRIPT LANGUAGE="javascript">location.href = "./?url=inicio"</SCRIPT>';
	}else{
		$_SESSION['idu'] = '';
		$_SESSION['idgu'] = '';
		$_SESSION['user'] = '';
		$_SESSION['errorlogin'] = '<center><div class="alert alert-error"><a class="close" data-dismiss="alert" href="#" title="Cerrar">x</a>Usuario o Contrase&ntilde;a Incorrecto!<br></div></center>';
		include_once('./mvc/vista/login.php');
		echo '<SCRIPT LANGUAGE="javascript">location.href = "./"</SCRIPT>';
	}
?>