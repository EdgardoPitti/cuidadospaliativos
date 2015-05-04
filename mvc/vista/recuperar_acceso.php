<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$u = '';
	$cont = '';
	$usuarios = new Accesatabla('usuarios');
	$preferencias = new Accesatabla('preferencias_recuperacion_acceso');
	$autenticacion = new Accesatabla('datos_autenticacion_usuario');
	$pregunta = new Accesatabla('preguntas_seguridad');
	if(!empty($_POST['usuario'])){
		$u = $usuarios->buscardonde('NO_IDENTIFICACION = "'.$_POST['usuario'].'"');
	}
	$cont.='<center><h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Recuperaci&oacute;n de Acceso</h3>';
	if($u){
		$_SESSION['idu'] = $usuarios->obtener('ID_USUARIO');
		$preferencias->buscardonde('ID_USUARIO = '.$usuarios->obtener('ID_USUARIO').'');
		$autenticacion->buscardonde('ID_USUARIO = '.$usuarios->obtener('ID_USUARIO').'');
		if($preferencias->obtener('USAR_PREGUNTA_SEGURIDAD') == 1){
			$cont.='
				<center style="min-height:430px;">
					<form id="form" method="POST" action="./?url=validar">
						<table>
							<tr>
								<td>Elija la Pregunta:</td>
								<td><select id="pregunta" name="pregunta">
										<option value="">SELECCIONE PREGUNTA</option>';
				$p = $pregunta->buscardonde('ID_PREGUNTA > 0');
				while($p){
					$cont.='
										<option value="'.$pregunta->obtener('ID_PREGUNTA').'">'.$pregunta->obtener('PREGUNTA').'</option>
										';
					$p = $pregunta->releer();
				}
				$cont.='
									</select>
								</td>
							</tr>						
							<tr>
								<td>Respuesta</td>
								<td><input type="text" id="respuesta" name="respuesta" required="required"><input type="hidden" id="id" name="id" value="'.$usuarios->obtener('ID_USUARIO').'" ></td>
							</tr>
						</table>
						<button type="submit" class="btn btn-primary">Enviar</button>
					</form>
				</center>
			';
		
		}elseif($preferencias->obtener('USAR_EMAIL_PREFERENCIAL') == 1){
			$cont.= 'Sus datos han sido enviado a su correo.<br><br>
						<a href="./?url=login" title="Ir a Login">Ir a Login.</a>			
			';
			$para = $autenticacion->obtener('E_MAIL_PREFERENCIAL');
			$titulo = "Recuperacion de Acceso Sistema de Gestion de Cuidados Paliativos Panama";
			$mensaje = "Sus datos para ingresar al sistema de Gestion de Cuidados Paliativos Panama son: \nUsuario: ".$usuarios->obtener('NO_IDENTIFICACION')."\nPassword: ".$usuarios->obtener('CLAVE_ACCESO')."";
			$cabeceras = 'From: soporte@gisespanama.org';
			mail($para,$titulo,$mensaje,$cabeceras);
		}elseif($preferencias->obtener('USAR_TELEFONO_PREFERENCIAL') == 1){
			$cont.= 'Tel&eacute;fono: '.$autenticacion->obtener('TELEFONO_PREFERENCIAL').'<br><br>
						<a href="./?url=login">Ir a Login.</a>';
		}else{
			$cont.='<script language="javascript">location.href="./?url=login"</script>';
		}
	
	}else{
	
		$cont.='
			<center style="min-height:430px">
				<form id="form2" method="POST" action="./?url=recuperar_acceso">
					<label for="usuario">Introduzca el nombre de Usuario: </label>
						 <input type="text" id="usuario" name="usuario" required><br>
						<button type="submit" class="btn btn-primary">Enviar</button>
				</form>
			</center>';
	}
	$cont.='</center>';

	echo $cont;
?>
