<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$condicionsalida = new Accesatabla('condicion_salida');
	$instituciones = new Accesatabla('institucion');
	$tipoinstitucion = new Accesatabla('tipo_institucion');
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$interconsulta = new Accesatabla('interconsulta');
	$respuesta = new Accesatabla('respuesta_interconsulta');
	$profesional = new Accesatabla('PROFESIONALES_SALUD');
	$datosprofesional = new Accesatabla('DATOS_PROFESIONALES_SALUD');
	$especialidad = new Accesatabla('ESPECIALIDADES_MEDICAS');
	
	$ds = new Diseno();
	$sw = 0;

	$buscar = $_POST['buscar'];
	$id = $_GET['id'];
	if(!empty($id)){
		$personas->buscardonde('ID_PACIENTE = '.$id.'');
		$buscar = $personas->obtener('NO_CEDULA');
	}
	
	$cont.='
	    <center>
			<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Atenci�n al Paciente</h3>
		</center>
		';
		
	if(!empty($buscar) and !$personas->buscardonde('NO_CEDULA = "'.$buscar.'"')){			
		$sw = 1;					
	}
	if(empty($buscar) or $sw == 1){	
		if($sw == 1){
			$agnadir='
					<a href="./?url=nuevopaciente&sbm=5">Paciente no Encotrado...A�adir</a>';	
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
										<td>'.$cedula.'</td>
										<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
										<td>'.$sexo.'</td>
									</tr>
									<tr>
										<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
										<td>'.$asegurado.'</td>
										<td>'.$ds->edad($dia,$mes,$anio).' A�os</td>
									</tr>
								</table>
						</fieldset>
					</div>
					<div class="span6">
						<fieldset>
							<legend>
								Direcci�n
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
						<form class="form-search" method="POST" action="./?url=ambulatoria_atencionalpaciente&sbm=2">
							<div class="input-group">
							  Buscar paciente: <input type="search" class="form-control" placeholder="C�dula" name="buscar" id="busqueda">
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
		$cont.='
				
				<div class="row-fluid">
					<div class="span6">
						<fieldset style="padding:5px">
							<legend>
								Resumen M�dico
							</legend>
							<div class="acordeon">
								<div>
									<input id="acordeon1" name="accordion" type="checkbox" />
									<label for="acordeon1">Fechas</label>
									<article>
										<div class="acordeon_gp" style="padding:15px;">
											<div>
												<input id="acordeon1-1" name="accordion_sub" type="checkbox" />
												<label for="acordeon1-1"><i class="icon-folder-open icon-white"></i> Atenci�n Domiciliaria</label>
												<article style="background:#fdfdfd;">
													<ul style="padding:5px 0 0 5px;">
														<li><i class="icon-file"></i> <a href="#">Actividades realizadas</a></li>
														<li><i class="icon-file"></i> <a href="#">Medicamentos Suministrados</a></li>
													</ul>
												</article>
											</div>	
										</div>
									</article>
							
								</div>
							</div>
							<div class="acordeon">
								<div>
									<input id="acordeon2" name="accordion" type="checkbox" />
									<label for="acordeon2" style="margin-top:5px">Fechas</label>
									<article>
										<div class="acordeon_gp" style="padding:15px;">
											<div>
												<input id="acordeon2-1" name="accordion_sub" type="checkbox" />
												<label for="acordeon2-1"><i class="icon-folder-open icon-white"></i> Atenci�n Domiciliaria</label>
												<article style="background:#fdfdfd;">
													<ul style="padding:5px 0 0 5px;">
														<li><i class="icon-file"></i> <a href="#">Actividades realizadas</a></li>
														<li><i class="icon-file"></i> <a href="#">Medicamentos Suministrados</a></li>
													</ul>
												</article>
											</div>	
										</div>
									</article>
							
								</div>
							</div>
						</fieldset>
					</div>
					<div class="span6">
						<center>
							<div class="centrar_botones">
								<p><a data-toggle="modal" href="#ag_obser" class="btn btn-primary">Agregar Observaciones</a></p>  
								<p><a data-toggle="modal" href="#res_inter" class="btn btn-primary">Responder Interconsulta</a></p>  
							</div>
						</center>
					</div>
				</div>
				
				<!--AGREGAR OBSERVACIONES-->
				<form method="POST" action="./?url=agregar_observacion&sbm=2">
					<div id="ag_obser" class="modal hide fade in" style="display: none; ">  
						<div class="modal-header">  
							<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a>  
							<h4>Agregar Observaciones</h4>  
						</div>  
						<div class="modal-body" align="center">  
							<h5>Motivo:</h5>  
							<input type="text" name="motivo"/>
							<h5>Observaciones:</h5>                
							<input type="text" name="observaciones"/>
						</div>  
						<div class="modal-footer">  
							<button type="submit" class="btn btn-primary">Guardar</button>  
							<button type="submit" class="btn" data-dismiss="modal">Cerrar</button>  
						</div>  
					</div>  									
				</form>
				
				<!--RESPONDER INTERCONSULTA-->
				<form method="POST" action="./?url=add_resp_interconsulta&id='.$idpaciente.'&sbm=2">
					<div id="res_inter" class="modal hide fade in" style="display: none; ">  
						<div class="modal-header">  
							<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a>  
							<h4>Responder Interconsulta</h4>  
						</div>  
						<div class="modal-body" align="center">  
							<h5>C�digo de Interconsulta:</h5>  
							<input type="text" name="cod_interconsulta" id="cod_interconsulta" required placeholder="C&oacute;digo Interconsulta">
							<h5>Observaciones:</h5>                
							<textarea id="observaciones" name="observaciones" required placeholder="Observaciones"></textarea>
						</div>  
						<div class="modal-footer">  
							<button type="submit" class="btn btn-primary">Guardar</button>  
							<button type="submit" class="btn" data-dismiss="modal">Cerrar</button>  
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