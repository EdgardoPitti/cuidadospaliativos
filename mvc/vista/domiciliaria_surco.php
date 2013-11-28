<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$instituciones = new Accesatabla('institucion');
	$tipoinstitucion = new Accesatabla('tipo_institucion');
	$clasificacion = new Accesatabla('clasificacion_atencion_solicitada');
	$servicios = new Accesatabla('servicios_medicos');
	$motivoreferencia = new Accesatabla('motivo_referencia');
	$cie = new Accesatabla('cie10');
	$tipoexamen = new Accesatabla('tipo_examen');
	$frecuencia = new Accesatabla('frecuencia');
	$sw = 0;
	$cedula = $_POST['cedula'];
	if(!empty($cedula) and !($personas->buscardonde('NO_CEDULA = "'.$cedula.'"'))){
		$sw = 1;
	}
	$ds = new Diseno();
	$cont='
			<center>
				<h3 style="background:#f4f4f4;padding:10px;"> Sistema Único de Referencia y Contrarreferencia</h3>
			</center>';
	if (Empty($cedula) or $sw == 1){
		$cont.='
			<center>
			<form class="form-search" method="POST" action="./?url=domiciliaria_surco">
				<div class="input-group">
				  Buscar paciente: <input type="search" class="form-control" id="busqueda" placeholder="Cédula o Nombre" name="cedula" required>
				  <span class="input-group-btn">
					<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
				  </span>
				</div>
			</form>
			</center>';
		if($sw){
			$cont.='<center><a href="./?url=domiciliaria_capturardatos">Paciente no encontrado...Añadir</a></center>';
		}
	}else{
		$personas->buscardonde('NO_CEDULA = "'.$cedula.'"');
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
		$cont.='<center>
				<table width="100%">
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
											<td>'.$ds->edad($dia,$mes,$anio).' Años</td>
										</tr>
									</table>
							</fieldset>
						</td>
						<td>
							<fieldset>
								<legend>
									Dirección
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
				</center>
				
					<!--REFERENCIA-->
					<div class="tabbable" id="tabs-1">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">Referencia</a></li>
							<li><a href="#tab2" data-toggle="tab">Respuesta a la Referencia</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">
							  <form method="POST" action="./?url=agregardatosurco&id='.$personas->obtener('ID_PACIENTE').'">
								<button type="submit" class="btn btn-default">Imprimir</button>
								<button type="submit" class="btn btn-default">Descargar</button>
								
								<div class="acordeon" style="margin-top:15px;">
									<div>
										<input id="acordeon1" name="accordion" type="radio"/>
										<label for="acordeon1">Datos Referencia</label>
										<article>
											<table class="tabla-datos">
												<tr>
													<td>Instalación que Refiere:</td>
													<td><select id="instalacionrefiere" name="instalacionrefiere" height="125px" required>
															<option value=""></option>';
							$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
							while($i){
								$cont .= '
															<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$instituciones->obtener('DENOMINACION').'</option>
								';
								$i = $instituciones->releer();
							}
						$cont.='
														</select>
													</td>
													<td>Servicio Médico al que se refiere:</td>
													<td><select id="serviciomedico" name="serviciomedico">
															<option value=""></option>';
						$s = $servicios->buscardonde('ID_SERVICIO > 0');
						while($s){
							$cont.='
															<option value="'.$servicios->obtener('ID_SERVICIO').'">'.$servicios->obtener('DESCRIPCION').'</option>
							';
							$s = $servicios->releer();
						}
						$cont.='
														</select>
													</td>
												</tr>
												<tr>
													<td>Instalación Receptora:</td>
													<td><select id="instalacionreceptora" name="instalacionreceptora">
															<option value=""></option>';
							$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
							while($i){
								$cont .= '
															<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$instituciones->obtener('DENOMINACION').'</option>
								';
								$i = $instituciones->releer();
							}
						$cont.='
														</select>
													</td>
													<td>Clasificación de la Atención solicitada:</td>
													<td><select id="clasificacionatencion" name="clasificacionatencion">
															<option value=""></option>';
						$c = $clasificacion->buscardonde('ID_CLASIFICACION_ATENCION_SOLICITADA');
						while($c){
							$cont.='
															<option value="'.$clasificacion->obtener('ID_CLASIFICACION_ATENCION_SOLICITADA').'">'.$clasificacion->obtener('CLASIFICACION_ATENCION_SOLICITADA').'</option>
							';
							$c = $clasificacion->releer();
						}
														
						$cont.='	
														</select>
													</td>
												</tr>
												<tr>
													<td>Motivo de Referencia:</td>
													<td><select id="motivoreferencia" name="motivoreferencia">
															<option value=""></option>';
						$m = $motivoreferencia->buscardonde('ID_MOTIVO_REFERENCIA > 0');
						while($m){
							$cont.='
															<option value="'.$motivoreferencia->obtener('ID_MOTIVO_REFERENCIA').'">'.$motivoreferencia->obtener('MOTIVO_REFERENCIA').'</option>
							';
							$m = $motivoreferencia->releer();
						}
						$cont.='		
														</select>
													</td>
													<td></td>
													<td></td>
												</tr>
											</table>
										</article>
									</div>
									<div>
										<input id="acordeon2" name="accordion" type="radio" />
										<label for="acordeon2">Historial del Paciente</label>
										<article>	
											<table class="tabla-datos" width="100%">
												<tr>
													<td>Anamnesis:</td>
													<td>Observaciones:</td>
												</tr>
												<tr>
													<td><textarea class="textarea" width="100%" id="anamnesis" name="anamnesis"></textarea></td>
													<td><textarea class="textarea" width="100%" id="observaciones" name="observaciones"></textarea></td>
												</tr>
												<tr>
													<td style="width:100px;">Examen Físico:</td>
													<td colspan="7"></td>										
												</tr>
											</table>	
											<table class="tabla">
												<tr class="fd-table">
													<th>Hora</th>
													<th>Presión Arterial</th>
													<th>Frecuencia Cardiaca</th>
													<th>Frecuencia Respiratoria</th>
													<th>Frecuencia Cardiaca Fetal</th>
													<th>Temperatura</th>
													<th>Peso<small>(Kg)</small></th>
													<th>Talla<small>(mts)</small></th>
												</tr>
												<tr  align="center">
													<td><input style="width:50px;" type="text" name="hora" value="'.$ds->dime('hora').':'.$ds->dime('minuto').'"></td>
													<td><input style="width:50px;" type="text" name="pa"/></td>
													<td><input style="width:50px;" type="text" name="fc"/></td>
													<td><input style="width:50px;" type="text" name="fr"/></td>
													<td><input style="width:50px;" type="text" name="fcf"/></td>
													<td><input style="width:50px;" type="text" name="temperatura"/></td>
													<td><input style="width:50px;" type="text" name="peso"/></td>
													<td><input style="width:50px;" type="text" name="talla"/></td>
												</tr>
											</table>
										</article>	
									</div>
									<div>
										<input id="acordeon3" name="accordion" type="radio" />
										<label for="acordeon3">Resultado de Exámenes/Diagnóstico</label>
										<article>
											<table class="table">
												<tr>
													<th>Tipo de Examen</th>
													<th>Diagnóstico</th>
													<th>CIE-10</th>
													<th>Frecuencia</th>
													<th>Tratamiento</th>
													<th>Fecha del Examen</th>
												</tr>	';
				$x = $tipoexamen->buscardonde('ID_TIPO_EXAMEN > 0');
				while($x){
					$nomb_examen = $tipoexamen->obtener('ID_TIPO_EXAMEN');
					 $cont.='
												<tr>
													<td>'.$tipoexamen->obtener('TIPO_EXAMEN').'</td>
													<td><input type="text" name="diagnostico'.$nomb_examen.'" id="diagnostico'.$nomb_examen.'"></td>
													<td><input type="text" name="cie'.$nomb_examen.'" id="cie'.$nomb_examen.'" size="5"></td>
													<td><select name="frec'.$nomb_examen.'" id="frec'.$nomb_examen.'">
															<option value=""></option>
													';
														
					$f = $frecuencia->buscardonde('ID_FRECUENCIA > 0');
					while($f){
						$cont.='							<option value="'.$frecuencia->obtener('ID_FRECUENCIA').'">'.$frecuencia->obtener('FRECUENCIA').'</option>';
						$f = $frecuencia->releer();
					}
					$cont.='
														</select></td>
													<td><input type="text" name="tratamiento'.$nomb_examen.'" id="tratamiento'.$nomb_examen.'"></td>
													<td><input type="date" name="fec_examen_'.$nomb_examen.'" id="fec_examen_'.$nomb_examen.'"></td>
												</tr>';
					
					$x = $tipoexamen->releer();
				}
				$cont.='
											</table>
										</article>	
									</div>
									
									<div>
										<input id="acordeon4" name="accordion" type="radio" />
										<label for="acordeon4">Datos del Profesional</label>
										<article>
											<table class="tabla-datos">
												<tr>
													<td align="right">Nombre de quien refiere:</td>
													<td  id="refiere"align="center"><input type="text" id="nombrerefiere" name="nombrerefiere"/></td>
													<td></td>									
												</tr>
												<tr>
													<td align="right">Nombre del Receptor:</td>		
													<td align="center"><input type="text" name="receptor"/></td>
													<td><i>(Solo en caso de urgencias y hospitalización)</i></td>
												</tr>
											</table>
										</article>
									</div>
								</div>
								
								<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:1px;float:right;">Registrar</button>
							   </form>
							</div>
							<!--RESPUESTA A LA REFERENCIA -->
							<div class="tab-pane" id="tab2">
								<form method="POST" action="./?url=respuesta_referencia">	
									<button type="submit" class="btn btn-default">Imprimir</button>
									<button type="submit" class="btn btn-default">Descargar</button>							
									<table class="tabla-datos" width="100%">
										<tr>
											<td style="wid th:90px">Institución que Responde:</td>
											<td><select id="institucionresponde" name="institucionresponde">
													<option value=""></option>';
													
					$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
					while($i){
						$cont .= '
													<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$instituciones->obtener('DENOMINACION').'</option>
						';
						$i = $instituciones->releer();
					}
					$cont.='			
												</select>
											</td>
											<td>Instalación Receptora:</td>
											<td><select id="instalacionrepectora" name="instalacionreceptora">
													<option value=""></option>';
													
					$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
					while($i){
						$cont .= '
													<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$instituciones->obtener('DENOMINACION').'</option>
						';
						$i = $instituciones->releer();
					}
					$cont.='
													
												</select>
											</td>
										</tr>	
									</table>
									<div class="acordeon">
										<div>
											<input type="radio" name="acc" id="acc-1">
											<label for="acc-1">Hallazgos Clínicos</label>
											<article>
												<center>
													<table width="100%">
														<tr>
															<td>
																<center>
																	<table>
																		<tr>
																			<td>Diagnóstico: </td>
																			<td><input type="text" name="diagnosticorespuesta" id="diagnosticorespuesta"></td>
																		</tr>
																		<tr>
																			<td>CIE-10: </td>
																			<td><input type="text" id="cierespuesta" name="cierespuesta"></td>
																		</tr>
																		<tr>
																			<td colspan="2">
																				Observaciones:<br>
																				<textarea name="observaciones2" style="max-width:300px;height:50px;border-color:#ccc;"></textarea>
																			</td>
																		</tr>
																	</table>
																</center>	
															</td>
															<td>
																<center>
																	<table style="ma rgin-left:20px;">
																		<tr>
																			<td>
																				Manejo y Tratamiento:<br>
																				<textarea name="manejo_tratamiento" style="max-width:300px;height:120px;border-color:#ccc;"></textarea>														
																			</td>
																		</tr>
																	</table>
																</center>	
															</td>
														</tr>
													</table>
												</center>
											</article>
										</div>
										<div>
											<input type="radio" name="acc" id="acc-2">
											<label for="acc-2">Datos del Profesional</label>
											<article>
												<center>
													<table width="80%">
														<tr>
															<td>Reevaluación especializada: </td>
															<td class="radio"><input type="radio"  style="display:block" name="reev_esp" id="reev_esp"/> Sí</td>
															<td class="radio"><input type="radio" style="display:block" name="reev_esp" id="reev_esp"/> No</td>
															<td>Fecha:</td>
															<td><input type="date" name="fecha"/></td>
														</tr>
														<tr>
															<td colspan="5">
																Observaciones: <br>
																<textarea name="observaciones_recomendaciones" style="width:100%;height:50px;border-color:#ccc;margin-right:10px;"></textarea>	
															</td>	
														</tr>
													</table>
												</center>
											</article>
										</div>
									</div>	
									
									<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;">+Nueva Nota</button>
									<button type="submit" class="btn btn-primary" style="font-size:12px;float:right;margin-top:8px;">Agregar</button>							
								</form>	
							</div>	
						</div>
					
				</div>
			';	
	}
	$ds->contenido($cont);
	$ds->mostrar();
?>
