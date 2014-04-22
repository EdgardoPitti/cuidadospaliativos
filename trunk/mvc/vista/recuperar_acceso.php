<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$usuarios = new Accesatabla('usuarios');
	$preferencias = new Accesatabla('preferencias_recuperacion_acceso');
	$autenticacion = new Accesatabla('datos_autenticacion_usuario');
	$pregunta = new Accesatabla('preguntas_seguridad');
	$u = $usuarios->buscardonde('NO_IDENTIFICACION = "'.$_POST['usuario'].'"');
	$cont.='<center><h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Recuperaci&oacute;n de Acceso</h3>';
	if($u){
		//$_SESSION['idu'] = $usuarios->obtener('ID_USUARIO');
		$preferencias->buscardonde('ID_USUARIO = '.$usuarios->obtener('ID_USUARIO').'');
		$autenticacion->buscardonde('ID_USUARIO = '.$usuarios->obtener('ID_USUARIO').'');
		if($preferencias->obtener('USAR_PREGUNTA_SEGURIDAD') == 1){
			$cont.='
				<form method="POST" action="./?url=validar">
					<table>
						<tr>
							<td>Elija la Pregunta:</td>
							<td><select id="pregunta" name="pregunta">
									<option value=""></option>';
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
							<td><input type="text" id="respuesta" name="respuesta"><input type="hidden" id="id" name="id" value="'.$usuarios->obtener('ID_USUARIO').'"></td>
						</tr>
					</table>
					<button type="submit" class="btn btn-primary">Enviar</button>
				</form>
			';
		
		}elseif($preferencias->obtener('USAR_EMAIL_PREFERENCIAL') == 1){
			$cont.= 'Sus datos han sido enviado a su correo.<br><br>
						<a href="./?url=login">Ir a Login.</a>
			
			';
			//mail("'.$autenticacion->obtener('E_MAIL_PREFERENCIAL').'","Recuperacion de Acceso","Sus datos son <br>Usuario: $usuarios->obtener('NO_IDENTIFICACION')<br>Password: '.$usuarios->obtener('CLAVE_ACCESO').'");
		}elseif($preferencias->obtener('USAR_TELEFONO_PREFERENCIAL') == 1){
			$cont.= 'Tel&eacute;fono: '.$autenticacion->obtener('TELEFONO_PREFERENCIAL').'<br><br>
						<a href="./?url=login">Ir a Login.</a>';
		}else{
			$cont.='<script language="javascript">location.href="./?url=login"</script>';
		}
	
	}else{
	
		$cont.='
				<form method="POST" action="./?url=recuperar_acceso">
					Introduzca el nombre de Usuario: <input type="text" id="usuario" name="usuario" required> 
						<button type="submit" class="btn btn-primary">Enviar</button>
				</form>';
	}
	$cont.='</center>';
	$ds->contenido($cont);
	$ds->mostrar();
?>