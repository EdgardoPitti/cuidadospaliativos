<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$autenticacion = new Accesatabla('datos_autenticacion_usuario');
	$usuarios = new Accesatabla('usuarios');
	
	$idpregunta = $_POST['pregunta'];
	$respuesta = $_POST['respuesta'];
	$idusuario = $_POST['id'];
	$pass = $_POST['pass'];
	
	if(!empty($pass)){
		$usuarios->buscardonde('ID_USUARIO = '.$idusuario.'');
		$usuarios->colocar("CLAVE_ACCESO", $_POST['pass']);
		$usuarios->salvar();
		echo '<script language="javascript">location.href="./?url=login"</script>';
	}else{
		$autenticacion->buscardonde('ID_USUARIO = '.$idusuario.'');
		if($idpregunta == $autenticacion->obtener('ID_PREGUNTA') AND $respuesta == $autenticacion->obtener('RESPUESTA')){
			$usuarios->buscardonde('ID_USUARIO = '.$idusuario.'');
			echo '<center><h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Recuperaci&oacute;n de Acceso</h3>
						<form method="POST" action="./?url=validar">
							<table>
								<tr>
									<td>Contrase&ntilde;a Nueva: </td>
									<td><input type="password" id="pass" name="pass"></td>
								</tr>							
							</table>
							<input type="hidden" id="id" name="id" value="'.$idusuario.'">
							<button type="submit" class="btn btn-primary">Enviar</button>
						</form>
					</center>
			';
			
		}else{
			echo '<script language="javascript">location.href="./?url=recuperar_acceso"</script>';
		}
	}
?>