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
	$referido = new Accesatabla('referido');
	$especialidad = new Accesatabla('especialidades_medicas');
	
	$ds = new Diseno();
	$sw = 0;
	
	$buscar = $_POST['buscar'];
	
	$cont.='
	  <center>
	  <fieldset>
		<legend><h3 style="background:#f4f4f4;padding:10px;">Contacto Telef�nico</h3></legend>';
	if(!empty($buscar) and !$personas->buscardonde('NO_CEDULA = "'.$buscar.'"')){			
		$sw = 1;					
	}
	if(empty($buscar) or $sw == 1){	
		if($sw == 1){
			$agnadir='
					<a href="./?url=hospitalaria_rae_capturardatos">Paciente no Encotrado...A�adir</a>';	
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
				<center>
					<table width="80%">
						<tr>
							<td width="50%">
								<fieldset>
									<legend>
										Paciente
									</legend>
										<table width="100%">											
											<tr>
												<td colspan="3"><h5>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</h5></td>
											</tr>
											<tr align="left">
												<td>'.$cedula.'</td>
												<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
												<td>'.$sexo.'</td>
											</tr>
											<tr align="left">
												<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
												<td>'.$asegurado.'</td>
												<td>'.$ds->edad($dia,$mes,$anio).'</td>
											</tr>
										</table>
								</fieldset>
							</td>
							<td>
								<fieldset>
									<legend>
										Direcci�n
									</legend>
										<table width="100%">
											<tr>
												<td>'.$distritos->obtener('DISTRITO').' , '.$provincias->obtener('PROVINCIA').'</td>
											</tr>
											<tr>
												<td>'.$corregimientos->obtener('CORREGIMIENTO').' , '.$residencia->obtener('DETALLE').'</td>
											</tr>
										</table>
								</fieldset>
							</td>
						</tr>
					</table>
				</center>';
	}		
	
	$cont.='
			<div class="row-fluid">
				<div class="span12">
					<!--REFERENCIA-->
					<div class="tabbable" id="tabs-1">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">Atenci�n al Paciente</a></li>
							<li><a href="#tab2" data-toggle="tab">Interconsulta</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">
								<div align="right">
									<form class="form-search" method="POST" action="./?url=ambulatoria_atencionalpaciente">
										<div class="input-group">
										  Buscar paciente: <input type="search" class="form-control" placeholder="C�dula" name="buscar" id="buscar">
										  <span class="input-group-btn">
											<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
										  </span>
										</div>
										'.$agnadir.'
									</form>
								</div>
								'.$mostrar.'
								<table width="100%" class="table">
									<tr>
										<td width="50%" style="border-top-color:#fff;">
											<fieldset>
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
																	<input id="acordeon1-1" name="accordion_sub" type="radio" />
																	<label for="acordeon1-1">Atenci�n Domiciliaria</label>
																	
																	<div>
																		<ul>
																			<li><a>Actividades realizadas</a></li>
																			<li><a>Medicamentos Suministrados</a></li>
																		</ul>
																	</div>
																</div>	
															</div>
														</article>
												
													</div>
												</div>
											</fieldset>
										</td>
										<td style="border-top-color:#fff;">
											<!--AGREGAR OBSERVACIONES-->
											<form method="POST" action="./?url=agregar_observacion">
												<div id="ag_obser" class="modal hide fade in" style="display: none; ">  
													<div class="modal-header">  
														<a class="close" data-dismiss="modal">�</a>  
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
											<form method="POST" action="./?url=agregar_resp_interconsulta">
												<div id="res_inter" class="modal hide fade in" style="display: none; ">  
													<div class="modal-header">  
														<a class="close" data-dismiss="modal">�</a>  
														<h4>Responder Interconsulta</h4>  
													</div>  
													<div class="modal-body" align="center">  
														<h5>C�digo de Interconsulta:</h5>  
														<input type="text" name="cod_interconsulta"/>
														<h5>Observaciones:</h5>                
														<input type="text" name="observaciones"/>
													</div>  
													<div class="modal-footer">  
														<button type="submit" class="btn btn-primary">Guardar</button>  
														<button type="submit" class="btn" data-dismiss="modal">Cerrar</button>  
													</div>  
												</div>  
											</form>	
											
											<center>
												<div class="centrar_botones">
													<p><a data-toggle="modal" href="#ag_obser" class="btn btn-primary">Agregar Observaciones</a></p>  
													<p><a data-toggle="modal" href="#res_inter" class="btn btn-primary">Responder Interconsulta</a></p>  
												</div>
											</center>
										</td>
									</tr>
								</table>						
							</div>
							
							<div class="tab-pane" id="tab2">
								<form class="form-search" method="POST" action="./?url=">						
									<div class="input-group">
									  Buscar paciente: <input type="search" class="form-control" id="nom_ced" placeholder="C�dula o Nombre" name="nom_ced">
									  <span class="input-group-btn">
										<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
									  </span>
									</div>
								</form>
								<center style="width:100%;max-width:600px;">
									<table width="100%">
										<tr align="center">
											<td>Especialista en: </td>
											<td>
												<select id="especialidad" name="especialidad">
													<option value="0"></option>';
									$x = $especialidad->buscardonde('ID_ESPECIALIDAD_MEDICA > 0');				
									while($x){
											$cont.='
													<option value="'.$especialidad->obtener('ID_ESPECIALIDAD_MEDICA').'">'.$especialidad->obtener('DESCRIPCION').'</option>';
											$x = $especialidad->releer();		
									}		
										$cont.='			
												</select>
											</td>
										</tr>
										<tr align="center">
											<td align="center">Nombre:</td>
											<td id="mostrarespecialista" name="mostrarespecialista">
												<select style="width:150px"></select>
											</td>
										</tr>
										<tr width="50%">
											<td colspan="2">Observaciones/Comentarios</td>
										</tr>
										<tr width="50%">
											<td colspan="2"><textarea id="obs_coment" name="obs_coment" style="width:98%;height:70px;border-color:#ccc;"></textarea></td>
										</tr>
									</table>
								</center>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</fieldset>';
	
	$script = $ds->js('datos_profesionales_salud', 'nom_ced', 'NO_CEDULA', '', 'PRIMER_NOMBRE', 'APELLIDO_PATERNO', 'APELLIDO_MATERNO');
	$cont.=$script;
	$ds->contenido($cont);
	$ds->mostrar();
?>