<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$usuarios = new Accesatabla('usuarios');
	$grupo = new Accesatabla('grupos_usuarios');
	$profesionales = new Accesatabla('profesionales_salud');
	$datos_profesional = new Accesatabla('datos_profesionales_salud');
	$pacientes = new Accesatabla('pacientes');
	$datos_paciente = new Accesatabla('datos_pacientes');
	$pregunta = new Accesatabla('preguntas_seguridad');
	$preferencias = new Accesatabla('preferencias_recuperacion_acceso');
	$autenticacion = new Accesatabla('datos_autenticacion_usuario');
	$id = $_GET['id'];
	$comillas = "'";
	
	if(!empty($id)){
		$img = '<a href="./?url=usuarios&sbm=5" title="A&ntilde;adir Usuario Administrador" class="btn btn-primary">A&ntilde;adir Usuario Administrador</a><br><br>';
	}
	
	$cont.='
			<script>
				function habilitar(value)
				{
					if(value != "1" || value != true)
					{
						// habilitamos
						document.getElementById("respuesta").disabled=false;
					}else{
						// deshabilitamos
						document.getElementById("respuesta").disabled=true;
					}
				}				
			</script>
			<center>
				<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Agregar Administradores o Editar Usuarios</h3>		
				<label for="search_string">Buscar No. de Identificaci&oacuten:</label> <input type="text" id="search_string" Placeholder="Filtrar" />
				<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
					<table class="table2 borde-tabla table-hover" id="usuarios">
						<thead>
							<tr class="fd-table">
								<th>#</th>		
								<th>No de Identificaci&oacute;n</th>
								<th>C&eacute;dula</th>
								<th>Paciente/Profesional</th>
								<th>Grupo de Usuario</th>
								<th style="min-width:20px;"></th>
							</tr>
						</thead>
						<tbody>
						';
	$u = $usuarios->buscardonde('ID_USUARIO > 0');
	$n = 1;
	while($u){
		$pr = $profesionales->buscardonde('ID_USUARIO = '.$usuarios->obtener('ID_USUARIO').'');
		$p = $pacientes->buscardonde('ID_USUARIO = '.$usuarios->obtener('ID_USUARIO').'');
		if($p){
			$datos_paciente->buscardonde('ID_PACIENTE = '.$pacientes->obtener('ID_PACIENTE').'');
			$segundo_nombre = $datos_paciente->obtener('SEGUNDO_NOMBRE');
			$apellido_materno = $datos_paciente->obtener('APELLIDO_MATERNO');
			$nombre = $datos_paciente->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$datos_paciente->obtener('APELLIDO_PATERNO').' '.$apellido_materno[0].'.';
			$cedula = $datos_paciente->obtener('NO_CEDULA');
		}
		if($pr){
			$datos_profesional->buscardonde('ID_PROFESIONAL = '.$profesionales->obtener('ID_PROFESIONAL').'');
			$segundo_nombre = $datos_profesional->obtener('SEGUNDO_NOMBRE');
			$apellido_materno = $datos_profesional->obtener('APELLIDO_MATERNO');
			$nombre = $datos_profesional->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$datos_profesional->obtener('APELLIDO_PATERNO').' '.$apellido_materno[0].'.';
			$cedula = $datos_profesional->obtener('NO_CEDULA');
		}
		if($pr == 0 && $p == 0){
			$nombre = 'Administrador';
			$cedula = 'Administrador';
		}
		$grupo->buscardonde('ID_GRUPO_USUARIO = '.$usuarios->obtener('ID_GRUPO_USUARIO').'');
		$cont.='
							<tr>
								<td><strong>'.$n.'.</strong></td>
								<td class="identificacion">'.$usuarios->obtener('NO_IDENTIFICACION').'</td>
								<td>'.$cedula.'</td>
								<td>'.$nombre.'</td>
								<td>'.$grupo->obtener('DESCRIPCION').'</td>
								<td><a href="./?url=usuarios&id='.$usuarios->obtener('ID_USUARIO').'&sbm=5"><img src="./iconos/search.png"></a></td>
							</tr>
		';
		$n++;
		$u = $usuarios->releer();
	}
	$usuarios->buscardonde('ID_USUARIO = '.$id.'');
	$preferencias->buscardonde('ID_USUARIO = '.$id.'');
	$autenticacion->buscardonde('ID_USUARIO = '.$id.'');
	$cont.='
						</tbody>
					</table>
				</div>
					'.$img.'
				<form id="form" method="POST" action="./?url=addusuario&id='.$id.'&sbm=5" >
					<table>
						<tr>
							<td>No de Identificaci&oacute;n: </td>
							<td><input type="text" id="no_identificacion" name="no_identificacion" placeholder="No de Identificaci&oacute;n" value="'.$usuarios->obtener('NO_IDENTIFICACION').'" required="required"></td>
						</tr>
						<tr>
							<td>Clave de Acceso: </td>
							<td><input type="text" id="clave" name="clave" placeholder="Clave de Acceso" value="'.$usuarios->obtener('CLAVE_ACCESO').'" required="required"></td>
						</tr>';

	if($preferencias->obtener('USAR_PREGUNTA_SEGURIDAD') == 1){
			$preguntas = 'selected';
	}
	if($preferencias->obtener('USAR_TELEFONO_PREFERENCIAL') == 1){
			$telefono = 'selected';
	}
	if($preferencias->obtener('USAR_EMAIL_PREFERENCIAL') == 1){
			$email = 'selected';
	}  	
	$idpregunta = $autenticacion->obtener('ID_PREGUNTA');
	$respuesta = $autenticacion->obtener('RESPUESTA');	
	$cont.='
				
						<tr>
							<td>Recuperaci&oacute;n de Acceso: </td>
							<td>
								<select name="preferencia" id="preferencia" required="required">
									<option value="0"></option>
									<option value="1" '.$preguntas.'>Pregunta</option>
									<option value="3" '.$email.'>Correo</option>
								</select>	
							</td>
						</tr>
						<tr>
							<td>Correo Electr&oacute;nico: </td>
							<td><input type="text" id="correo" name="correo" value="'.$autenticacion->obtener('E_MAIL_PREFERENCIAL').'"></td>
						</tr>
						<tr>
							<td>Tel&eacute;fono: </td>
							<td><input type="text" id="telefono" name="telefono" value="'.$autenticacion->obtener('TELEFONO_PREFERENCIAL').'"></td>
						</tr>
						<tr>
							<td>Pregunta de Recuperaci&oacute;n: </td>
							<td><select  id="pregunta" name="pregunta" onChange="habilitar(this.value);">
											<option value=""></option>';
	$p = $pregunta->buscardonde('ID_PREGUNTA > 0');
	while($p){
		if($pregunta->obtener('ID_PREGUNTA') == $idpregunta){
			if($idpregunta == 1){
				$disable = 'disabled';
			}
			$selected = 'selected';
		}else{
			$selected = '';
		}
		$cont.='
											<option value="'.$pregunta->obtener('ID_PREGUNTA').'" '.$selected.'>'.$pregunta->obtener('PREGUNTA').'</option>
		';
		$p = $pregunta->releer();
	}
	$cont.='
									</select>
							</td>
						</tr>                                                                   
						<tr>
							<td>Respuesta pregunta: </td>
							<td><input type="text" id="respuesta" name="respuesta" placeholder="Respuesta Pregunta" value="'.$respuesta.'" '.$disable.'></td>
						</tr>
					</table>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>			
			</center>
	';
	$cont.='
		<script language="JavaScript" type="text/JavaScript">
			// Con estas 3 líneas sobreescribimos el Constains para que no sea case sensitive pues por default en jquery  viene con case sensitive. Si no lo pones, queda como Case sensitive
			$.expr['.$comillas.':'.$comillas.'].Contains = function(x, y, z){
				return jQuery(x).text().toLowerCase().indexOf(z[3].toLowerCase())>=0;
			};

			// cada que escribamos, vamos a revisar lo que hay escrito 
			$('.$comillas.'#search_string'.$comillas.').keyup(function() 
			{
				//tomamos el valor que tiene el input
				var search = $('.$comillas.'#search_string'.$comillas.').val();
				//mostramos todos los valores, para despues ir ocultando los que no coinciden
				$('.$comillas.'#usuarios tr'.$comillas.').show();
				
				//esto es para revisar si tenemos algo que buscar, sino, que no lo haga.
				if(search.length>0)
				{
				// con la clase .identificacion le decimos en cual de las celdas buscar y si no coincide, ocultamos el tr que contiene a esa celda. 
				$("#usuarios tr td.identificacion").not(":Contains('.$comillas.'"+search+"'.$comillas.')").parent().hide();
				}
			});
		</script>
	
	';
	if($_SESSION['idgu'] <> 1){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>