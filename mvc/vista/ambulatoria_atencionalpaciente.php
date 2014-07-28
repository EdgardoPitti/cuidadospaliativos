<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$interconsulta = new Accesatabla('interconsulta');
	$respuesta = new Accesatabla('respuesta_interconsulta');
	$profesional = new Accesatabla('profesionales_salud');
	$datosprofesional = new Accesatabla('datos_profesionales_salud');
	$especialidad = new Accesatabla('especialidades_medicas');
	$atencion = new Accesatabla('atencion_paciente');
	
	$rda = new Accesatabla('registro_diario_actividades');
	$detalle = new Accesatabla('detalle_rda');
	$actividad = new Accesatabla('actividad');
	
	$ds = new Diseno();
	$sw = 0;

	$sbm = $_GET['sbm'];

	$buscar = $_POST['buscar'];
	$id = $_GET['id'];
	if(!empty($id)){
		$personas->buscardonde('ID_PACIENTE = '.$id.'');
		$buscar = $personas->obtener('NO_CEDULA');
	}
	
	$cont.='
	    <center>
			<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Atenci&oacute;n al Paciente</h3>
		</center>
		';
		
	if(!empty($buscar) and !$personas->buscardonde('NO_CEDULA = "'.$buscar.'"')){			
		$sw = 1;					
	}
	if(empty($buscar) or $sw == 1){	
		if($sw == 1){
			$agnadir='
					<a href="./?url=nuevopaciente&sbm=5">Paciente no Encotrado...A&ntilde;adir</a>';	
		}
	}else{
		
		$personas->buscardonde('NO_CEDULA = "'.$buscar.'"');
		$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$personas->obtener('ID_RESIDENCIA_HABITUAL').'');
		$tiposangre->buscardonde('ID_TIPO_SANGUINEO = '.$personas->obtener('ID_TIPO_SANGUINEO').'');
		$provincias->buscardonde('ID_PROVINCIA = '.$residencia->obtener('ID_PROVINCIA').'');
		$distritos->buscardonde('ID_DISTRITO = '.$residencia->obtener('ID_DISTRITO').'');
		$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$residencia->obtener('ID_CORREGIMIENTO').'');
		if ($personas->obtener('ID_SEXO') == 1){
			$sexo = 'MASCULINO';
		}else{
			$sexo = 'FEMENINO';
		}
		if($personas->obtener('ID_TIPO_PACIENTE')){
			$asegurado = 'ASEGURADO';
		}else{
			$asegurado = 'NO ASEGURADO';
		}
		list($anio, $mes, $dia) = explode("-", $personas->obtener('FECHA_NACIMIENTO'));
		$mostrar ='
				<div class="row-fluid">
					<div class="span6">
						<fieldset>
							<legend>
								Paciente
							</legend>
								<table class="table2">											
									<tr>
										<td colspan="3"><h5>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</h5></td>
									</tr>
									<tr>
										<td>'.$buscar.'</td>
										<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
										<td>'.$sexo.'</td>
									</tr>
									<tr>
										<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
										<td>'.$asegurado.'</td>
										<td>'.$ds->edad($dia,$mes,$anio).' Años</td>
									</tr>
								</table>
						</fieldset>
					</div>
					<div class="span6">
						<fieldset>
							<legend>
								Dirección
							</legend>
								<table class="table2" style="height:86px;">
									<tr>
										<td>'.$distritos->obtener('DISTRITO').' , '.$provincias->obtener('PROVINCIA').'</td>
									</tr>
									<tr>
										<td>'.$corregimientos->obtener('CORREGIMIENTO').' , '.$residencia->obtener('DETALLE').'</td>
									</tr>
								</table>
						</fieldset>
					</div>	
				</div>';
	}		
	
	$cont.='
			<div class="row-fluid">
				<div class="span12">					
					<div align="center">
						<form class="form-search" method="POST" action="./?url=ambulatoria_atencionalpaciente&sbm='.$sbm.'">
							<div class="input-group">
							  Buscar paciente: <input type="search" class="form-control" placeholder="C&eacute;dula" name="buscar" id="busqueda">
							  <span class="input-group-btn">
								<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
							  </span>
							</div>
							'.$agnadir.'
						</form>
					</div>
					'.$mostrar.'
					';
	if(!empty($mostrar)){
		$idpaciente = $personas->obtener('ID_PACIENTE');
		$i = $interconsulta->buscardonde('ID_PACIENTE = '.$idpaciente.' ORDER BY FECHA');
		if($i){
				$cont.='
					<br>
					<center><h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Interconsultas</h3></center>
					<div class="overflow overthrow" style="max-height:150px;">
								<table class="table2 borde-tabla table-hover">
									<thead>
										<tr class="fd-table">
											<th>#</th>
											<th>C&oacute;digo Interconsulta</th>
											<th>Fecha</th>
											<th>Profesional</th>
											<th>Especialidad</th>
											<th>Observacion / Comentario</th>
										</tr>
									</thead>
									<tbody>';
				$n = 1;
				while($i){								
					$profesional->buscardonde('ID_PROFESIONAL = '.$interconsulta->obtener('ID_PROFESIONAL').'');
					$datosprofesional->buscardonde('ID_PROFESIONAL = '.$interconsulta->obtener('ID_PROFESIONAL').'');
					$especialidad->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$profesional->obtener('ID_ESPECIALIDAD_MEDICA').'');
					$segundo_nombre = $datosprofesional->obtener('SEGUNDO_NOMBRE');
					$segundo_apellido = $datosprofesional->obtener('APELLIDO_MATERNO');
					$cont.='
											<tr>
												<td>'.$n.'.</td>
												<td>'.$interconsulta->obtener('ID_INTERCONSULTA').'</td>
												<td>'.$interconsulta->obtener('FECHA').'</td>
												<td>'.$datosprofesional->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$datosprofesional->obtener('APELLIDO_PATERNO').' '.$segundo_apellido[0].'.</td>
												<td>'.$especialidad->obtener('DESCRIPCION').'</td>
												<td>'.$interconsulta->obtener('OBSERVACIONES').'</td>
											</tr>';
					$n++;
					$i = $interconsulta->releer();
				}
				$cont.='
									</tbody>
								</table>
					</div>';
			}
		
		$r = $respuesta->buscardonde('ID_PACIENTE = '.$idpaciente.' ORDER BY FECHA');
		if($r){
				$cont.='
					<br>
					<center><h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Respuestas Interconsultas</h3></center>
					<div class="overflow overthrow" style="max-height:150px;">
								<table class="table2 borde-tabla table-hover">
									<thead>
										<tr class="fd-table">
											<th>#</th>
											<th>C&oacute;digo Interconsulta</th>
											<th>Fecha</th>
											<th>Profesional</th>
											<th>Especialidad</th>
											<th>Observacion / Comentario</th>
										</tr>
									</thead>
									<tbody>';
				$n = 1;
				while($r){								
					$profesional->buscardonde('ID_PROFESIONAL = '.$respuesta->obtener('ID_PROFESIONAL').'');
					$datosprofesional->buscardonde('ID_PROFESIONAL = '.$respuesta->obtener('ID_PROFESIONAL').'');
					$especialidad->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$profesional->obtener('ID_ESPECIALIDAD_MEDICA').'');
					$segundo_nombre = $datosprofesional->obtener('SEGUNDO_NOMBRE');
					$segundo_apellido = $datosprofesional->obtener('APELLIDO_MATERNO');
					$cont.='
											<tr>
												<td>'.$n.'.</td>
												<td>'.$respuesta->obtener('ID_INTERCONSULTA').'</td>
												<td>'.$respuesta->obtener('FECHA').'</td>
												<td>'.$datosprofesional->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$datosprofesional->obtener('APELLIDO_PATERNO').' '.$segundo_apellido[0].'.</td>
												<td>'.$especialidad->obtener('DESCRIPCION').'</td>
												<td>'.$respuesta->obtener('OBSERVACIONES').'</td>
											</tr>';
					$n++;
					$r = $respuesta->releer();
				}
				$cont.='
									</tbody>
								</table>
					</div>';
			}
		$a = $atencion->buscardonde('ID_PACIENTE = '.$idpaciente.' ORDER BY FECHA');
		if($a){
				$cont.='
					<br>
					<center><h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Atenciones del Paciente</h3></center>
					<div class="overflow overthrow" style="max-height:150px;">
								<table class="table2 borde-tabla table-hover">
									<thead>
										<tr class="fd-table">
											<th>#</th>
											<th>Fecha</th>
											<th>Profesional</th>
											<th>Especialidad</th>
											<th>Hora Inicio</th>
											<th>Hora Fin</th>
											<th>Minutos Utilizados</th>
											<th>Motivo</th>
											<th>Observacion</th>
											<th>Tipo Contacto</th>
											<th>E-Mail / Telefono</th>
										</tr>
									</thead>
									<tbody>';
				$n = 1;
				while($a){								
					$profesional->buscardonde('ID_PROFESIONAL = '.$atencion->obtener('ID_PROFESIONAL').'');
					$datosprofesional->buscardonde('ID_PROFESIONAL = '.$atencion->obtener('ID_PROFESIONAL').'');
					$especialidad->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$profesional->obtener('ID_ESPECIALIDAD_MEDICA').'');
					$segundo_nombre = $datosprofesional->obtener('SEGUNDO_NOMBRE');
					$segundo_apellido = $datosprofesional->obtener('APELLIDO_MATERNO');
					if($atencion->obtener('TIPO_CONTACTO') == 1){
						$tipo = 'Tel&eacute;fono';
						$contacto = $atencion->obtener('TELEFONO');
					}else{
						$tipo = 'Correo Electr&oacute;nico';
						$contacto = $atencion->obtener('E_MAIL');
					}
					$cont.='
											<tr>
												<td>'.$n.'.</td>
												<td>'.$atencion->obtener('FECHA').'</td>
												<td>'.$datosprofesional->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$datosprofesional->obtener('APELLIDO_PATERNO').' '.$segundo_apellido[0].'.</td>
												<td>'.$especialidad->obtener('DESCRIPCION').'</td>
												<td>'.$atencion->obtener('HORA_INICIO').'</td>
												<td>'.$atencion->obtener('HORA_FIN').'</td>
												<td>'.$atencion->obtener('MINUTOS_UTILIZADOS').'</td>
												<td>'.$atencion->obtener('MOTIVO').'</td>
												<td>'.$atencion->obtener('OBSERVACION').'</td>
												<td>'.$tipo.'</td>
												<td>'.$contacto.'</td>
											</tr>';
					$n++;
					$a = $atencion->releer();
				}
				$cont.='
									</tbody>
								</table>
					</div>';
			}
		$cont.='
				
				<div class="row-fluid">
					<div class="span6">
						<fieldset style="padding:5px">
							<legend>
								Resumen Médico
							</legend>';
		$d = $detalle->buscardonde('ID_PACIENTE = '.$idpaciente.'');
		if($d){
			$x = 1;
			while($d){
				$rda->buscardonde('ID_RDA = '.$detalle->obtener('ID_RDA').'');
				$actividad->buscardonde('ID_ACTIVIDAD = '.$detalle->obtener('ID_ACTIVIDAD').'');
				$datosprofesional->buscardonde('ID_PROFESIONAL = '.$actividad->obtener('ID_PROFESIONAL').'');
				$cont.='
							<div class="acordeon">
								<div>
									<input id="acordeon'.$x.'" name="accordion" type="checkbox" />
									<label for="acordeon'.$x.'">'.$rda->obtener('FECHA').'</label>
									<article>
										<div class="acordeon_gp" style="padding:15px;">
											<div>
												<input id="acordeon1-'.$x.'" name="accordion_sub" type="checkbox" />
												<label for="acordeon1-'.$x.'"><i class="icon-folder-open icon-white"></i> Atención Domiciliaria</label>
												<article style="background:#fdfdfd;">
													<ul style="padding:5px 0 0 5px;">
														<li><i class="icon-file"></i> <a data-toggle="modal" href="#act_'.$x.'">Actividades realizadas</a></li>
														<li><i class="icon-file"></i> <a href="#">Medicamentos Suministrados</a></li>
													</ul>
												</article>
											</div>	
										</div>
										<div id="act_'.$x.'" class="modal hide fade in" style="display: none; ">  
											<div class="modal-header">  
												<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a>  
												<h4>Actividades Realizadas</h4>  
											</div>  
											<div class="modal-body" align="center">  
												<strong>Actividad Realizada</strong><br>
												'.$actividad->obtener('ACTIVIDAD').'<br><br>
												<strong>Profesional Encargado de la Actividad</strong><br>
												'.$datosprofesional->obtener('PRIMER_NOMBRE').' '.$datosprofesional->obtener('SEGUNDO_NOMBRE').' '.$datosprofesional->obtener('APELLIDO_PATERNO').' '.$datosprofesional->obtener('APELLIDO_MATERNO').'
											</div>  
											<div class="modal-footer">  
												<button type="submit" class="btn" data-dismiss="modal">Cerrar</button>  
											</div>  
										</div>  			
									</article>
								</div>
							</div>';
			
				$d = $detalle->releer();
				$x++;
			}
		}else{
			$cont.=  '<center><div style="color:red;">No existe res&uacute;menes para este paciente.</div></center>';
		
		}
			
		$cont.='
						</fieldset>
					</div>';
		if($_SESSION['idgu'] <> 4){

			$cont.='
						<div class="span6">
							<center>
								<div class="centrar_botones">
									<p><a data-toggle="modal" href="#ag_obser" class="btn btn-primary">Agregar Observaciones</a></p>  
									<p><a data-toggle="modal" href="#res_inter" class="btn btn-primary">Responder Interconsulta</a></p>  
								</div>
							</center>
						</div>';
		}
		$cont.='
				</div>
				
				<!--AGREGAR OBSERVACIONES-->
				<form id="form" method="POST" action="./?url=add_atencion_paciente&id='.$idpaciente.'&sbm=2">
					<div id="ag_obser" class="modal hide fade in" style="display: none; ">  						
						<div class="modal-header">  
							<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a>  
							<h4>Agregar Observaciones</h4>  
						</div>  
						<div class="modal-body" align="center"> 
								<table class="overthrow" style="overflow-y:auto;">
									<tr>
										<td><h5 style="margin-bottom:3px;">Hora Inicio:</h5></td>
										<td><input type="time" id="hora_inicio" name="hora_inicio" style="width:140px;margin-bottom:3px;"></td>
									</tr>
									<tr>
										<td><h5 style="margin-bottom:3px;">Hora Fin:</h5></td>
										<td><input type="time" id="hora_fin" name="hora_fin" style="width:140px;margin-bottom:3px;"></td>
									</tr>
									<tr>
										<td><h5 style="margin-bottom:3px;">Minutos Utilizados: </h5></td>
										<td><input type="number" id="minutos" name="minutos" min="1" max="360" required style="width:140px;margin-bottom:3px;"></td>
									</tr>
									<tr>
										<td><h5 style="margin-bottom:3px;">Tipo de Contacto: </h5></td>
										<td>
											<select id="tipo" name="tipo" required style="width:140px;margin-bottom:3px;">
												<option value="0">SELECCIONE TIPO CONTACTO</option>
												<option value="1">Tel&eacute;fono</option>
												<option value="2">Correo Electr&oacute;nico</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><h5 style="margin-bottom:3px;">Tel&eacute;fono: </h5></td>
										<td><input type="text" id="telefono" name="telefono" placeholder="Tel&eacute;fono" style="width:140px;margin-bottom:3px;"></td>
									</tr>
									<tr>
										<td><h5 style="margin-bottom:3px;">Correo Electr&oacute;nico: </h5></td>
										<td><input type="email" id="email" name="email" placeholder="Correo Electr&oacute;nico" style="width:140px;margin-bottom:3px;"></td>
									</tr>
									<tr>
										<td><h5 style="margin-bottom:3px;">Motivo:</h5></td>
										<td><input type="text" name="motivo" required placeholder="Motivo de Atenci&oacute;n" style="width:140px;margin-bottom:3px;"></td>
									</tr>
									<tr>
										<td><h5 style="margin-bottom:3px;">Observaciones:</h5> </td>
										<td><textarea id="observacion" class="textarea" name="observacion" required placeholder="Observaci&oacute;nes" style="height:25px;width:140px;margin-bottom:3px;"></textarea></td>
									</tr>
								</table>										
						</div>  
						<div class="modal-footer">  
							<button type="submit" class="btn btn-primary btn-small">Guardar</button>  
							<button type="submit" class="btn btn-default btn-small" data-dismiss="modal">Cerrar</button>  
						</div>  
					</div>  
				</form>
				
				<!--RESPONDER INTERCONSULTA-->
				<form id="form2" method="POST" action="./?url=add_resp_interconsulta&id='.$idpaciente.'&sbm=2">
					<div id="res_inter" class="modal hide fade in" style="display: none; ">  
						<div class="modal-header">  
							<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a>  
							<h4>Responder Interconsulta</h4>  
						</div>  
						<div class="modal-body" align="center">  
							<h5>Código de Interconsulta:</h5>  
							<input type="text" name="cod_interconsulta" id="cod_interconsulta" required placeholder="C&oacute;digo Interconsulta">
							<h5>Observaciones:</h5>                
							<textarea id="observaciones" name="observaciones" class="textarea" required placeholder="Observaciones"></textarea>
						</div>  
						<div class="modal-footer">  
							<button type="submit" class="btn btn-primary btn-small">Guardar</button>  
							<button type="submit" class="btn btn-default btn-small" data-dismiss="modal">Cerrar</button>  
						</div>  
					</div>  
				</form>	';	
	}
	$cont.='
			</div>
		</div>';
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>