<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$personas = new Accesatabla('personas');
	$tiposangre = new Accesatabla('tipos_de_sangre');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$cedula = $_POST['cedula'];
	$ds = new Diseno();
	if (Empty($cedula)){
		$cont='

				<form method="POST" action="./?url=domiciliaria_surco">
					<table>
						<tr>
							<td></td>
							<td align="center">Buscar Paciente</td>
							<td></td>
						</tr>
						<tr>
							<td>Cedula:</td>
							<td><input type="search" id="cedula" name="cedula"></td>
							<td><button>Buscar</button></td>
						</tr>						
					</table><br><br>
				</form>
			';
	}else{
		$personas->buscardonde('cedula = "'.$cedula.'"');
		$tiposangre->buscardonde('id = '.$personas->obtener('id_tipo_de_sangre').'');
		$provincias->buscardonde('id = '.$personas->obtener('id_provincia_residencia').'');
		$distritos->buscardonde('id = '.$personas->obtener('id_distrito_residencia').'');
		$corregimientos->buscardonde('id = '.$personas->obtener('id_corregimiento_residencia').'');
		if ($personas->obtener('femenino')){
			$sexo = 'Femenino';
		}else{
			$sexo = 'Masculino';
		}
		list($anio, $mes, $dia) = explode("-", $personas->obtener('fecha_de_nacimiento'));
		$cont=' 
				<table width="100%">
					<tr>
						<td>
							<fieldset>
								<legend>
									Paciente
								</legend>
									<center>
										<table>
											<tr>
												<td>'.$personas->obtener('primer_nombre').' '.$personas->obtener('segundo_nombre').'</td>
												<td>'.$personas->obtener('primer_apellido').' '.$personas->obtener('segundo_apellido').'</td>
											</tr>
											<tr>
												<td>'.$cedula.'</td>
												<td>'.$tiposangre->obtener('tipo_sangre').'</td>
											</tr>
											<tr>
												<td>'.$sexo.'</td>
												<td>'.$personas->obtener('ocupacion').'</td>
											</tr>
											<tr>
												<td>'.$ds->edad($dia,$mes,$anio).'</td>
												<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
											</tr>
										</table>
									</center>
							</fieldset>
						</td>
						<td>
							<fieldset>
								<legend>
									Dirección
								</legend>
									<center>
										<table>
											<tr>
												<td>&nbsp</td>
											</tr>
											<tr>
												<td>'.$distritos->obtener('descripcion').' , '.$provincias->obtener('descripcion').'</td>
											</tr>
											<tr>
												<td>'.$corregimientos->obtener('descripcion').' , '.$personas->obtener('direccion_detallada').'</td>
											</tr>
											<tr>
												<td>&nbsp</td>
											</tr>
										</table>
									</center>
							</fieldset>
						</td>
					</tr>
				</table>
		';
	}
	
	$cont.='
		<form method="POST" action="./?url=">
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Referencia</a></li>
					<li><a href="#tabs-2">Respuesta a la Referencia</a></li>
				</ul>
				
				<div id="tabs-1">
					<button>Imprimir</button>
					<button>Descargar</button>
					<fieldset>
						<legend style="font-weight:bold;font-size:bold">Datos de Referencia</legend>
						<table class="tabla-datos">
							<tr>
								<td>Instalación que Refiere:</td>
								<td></td>
								<td>Servicio Médico al que se refiere:</td>
								<td></td>
							</tr>
							<tr>
								<td>Instalación Receptora:</td>
								<td></td>
								<td>Clasificación de la Atención solicitada:</td>
								<td></td>
							</tr>
							<tr>
								<td>Motivo de Referencia:</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</fieldset>	
					<div id="accordion">
						<h3>Historial del Paciente</h3>
						<div>
							<table class="tabla-datos" width="100%">
								<tr>
									<td>Anamnesis:</td>
									<td colspan="7"></td>
								</tr>
								<tr>
									<td colspan="8"><textarea></textarea></td>
								</tr>
								<tr>
									<td style="width:100px;">Examen Físico:</td>
									<td colspan="7"></td>										
								</tr>
							</table>	
							<table class="tabla showinput" cellspacing="0">
								<tr>
									<th>Hora</th>
									<th>PA</th>
									<th>FC</th>
									<th>FR</th>
									<th>FCF</th>
									<th>T°</th>
									<th>Peso<small>(Kg)</small></th>
									<th>Talla<small>(mts)</small></th>
									
								</tr>
								<tr  align="center">
									<td>10:30 A.M.</td>
									<td><input style="width:40px;" type="text" name="pa"/></td>
									<td><input style="width:40px;" type="text" name="fc"/></td>
									<td><input style="width:40px;" type="text" name="fr"/></td>
									<td><input style="width:40px;" type="text" name="fcf"/></td>
									<td><input style="width:40px;" type="text" name="temperatura"/></td>
									<td><input style="width:40px;" type="text" name="peso"/></td>
									<td><input style="width:40px;" type="text" name="talla"/></td>
									<td style="background:#fafafa;border:1px solid #fafafa;"><a href="./?url=registrar" title="Registrar"></a> </td>
								</tr>
							</table>
						</div>
						<h3>Resultado de Exámenes/Diagnóstico</h3>
						<div>
							<div id="tabs2">
								<ul>
									<li><a href="#tabs2-1">BHC</a></li>
									<li><a href="#tabs2-2">Urin</a></li>
									<li><a href="#tabs2-3">Heces</a></li>
									<li><a href="#tabs2-4">Glicemia</a></li>
									<li><a href="#tabs2-5">Creatinina</a></li>
									<li><a href="#tabs2-6">N. de U.</a></li>
									<li><a href="#tabs2-7">Electrolitos</a></li>
									<li><a href="#tabs2-8">Amilasa</a></li>
								</ul>
								<div id="tabs2-1">
									<table class="tabla-datos" width="100%">
										<tr>
											<td>
												<table>
													<tr>
														<td>Diagnóstico:</td>
														<td class="showinput"><input type="text" name="hallaz_diag"></input></td>
													</tr>
													<tr>
														<td>CIE-10</td>
														<td>
															<select>
																<option value="1">opcion 1</option>
																<option value="2">opcion 2</option>																				
															</select>
														</td>
													</tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Tratamiento/Complicaciones</td></tr>
													<tr><td><textarea style="width:164px;height:50px;"></textarea></td></tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Observaciones:</td></tr>
													<tr><td><textarea style="width:160px;height:50px;"></textarea></td></tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
								<div id="tabs2-2">
									<table class="tabla-datos" width="100%">
										<tr>
											<td>
												<table>
													<tr>
														<td>Diagnóstico:</td>
														<td class="showinput"><input type="text" name="hallaz_diag"></input></td>
													</tr>
													<tr>
														<td>CIE-10</td>
														<td>
															<select>
																<option value="1">opcion 1</option>
																<option value="2">opcion 2</option>																				
															</select>
														</td>
													</tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Tratamiento/Complicaciones</td></tr>
													<tr><td><textarea style="width:164px;height:50px;"></textarea></td></tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Observaciones:</td></tr>
													<tr><td><textarea style="width:160px;height:50px;"></textarea></td></tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
								<div id="tabs2-3">
									<table class="tabla-datos" width="100%">
										<tr>
											<td>
												<table>
													<tr>
														<td>Diagnóstico:</td>
														<td class="showinput"><input type="text" name="hallaz_diag"></input></td>
													</tr>
													<tr>
														<td>CIE-10</td>
														<td>
															<select>
																<option value="1">opcion 1</option>
																<option value="2">opcion 2</option>																				
															</select>
														</td>
													</tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Tratamiento/Complicaciones</td></tr>
													<tr><td><textarea style="width:164px;height:50px;"></textarea></td></tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Observaciones:</td></tr>
													<tr><td><textarea style="width:160px;height:50px;"></textarea></td></tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
								<div id="tabs2-4">
									<table class="tabla-datos" width="100%">
										<tr>
											<td>
												<table>
													<tr>
														<td>Diagnóstico:</td>
														<td class="showinput"><input type="text" name="hallaz_diag"></input></td>
													</tr>
													<tr>
														<td>CIE-10</td>
														<td>
															<select>
																<option value="1">opcion 1</option>
																<option value="2">opcion 2</option>																				
															</select>
														</td>
													</tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Tratamiento/Complicaciones</td></tr>
													<tr><td><textarea style="width:164px;height:50px;"></textarea></td></tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Observaciones:</td></tr>
													<tr><td><textarea style="width:160px;height:50px;"></textarea></td></tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
								<div id="tabs2-5">
									<table class="tabla-datos" width="100%">
										<tr>
											<td>
												<table>
													<tr>
														<td>Diagnóstico:</td>
														<td class="showinput"><input type="text" name="hallaz_diag"></input></td>
													</tr>
													<tr>
														<td>CIE-10</td>
														<td>
															<select>
																<option value="1">opcion 1</option>
																<option value="2">opcion 2</option>																				
															</select>
														</td>
													</tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Tratamiento/Complicaciones</td></tr>
													<tr><td><textarea style="width:164px;height:50px;"></textarea></td></tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Observaciones:</td></tr>
													<tr><td><textarea style="width:160px;height:50px;"></textarea></td></tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
								<div id="tabs2-6">
									<table class="tabla-datos" width="100%">
										<tr>
											<td>
												<table>
													<tr>
														<td>Diagnóstico:</td>
														<td class="showinput"><input type="text" name="hallaz_diag"></input></td>
													</tr>
													<tr>
														<td>CIE-10</td>
														<td>
															<select>
																<option value="1">opcion 1</option>
																<option value="2">opcion 2</option>																				
															</select>
														</td>
													</tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Tratamiento/Complicaciones</td></tr>
													<tr><td><textarea style="width:164px;height:50px;"></textarea></td></tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Observaciones:</td></tr>
													<tr><td><textarea style="width:160px;height:50px;"></textarea></td></tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
								<div id="tabs2-7">
									<table class="tabla-datos" width="100%">
										<tr>
											<td>
												<table>
													<tr>
														<td>Diagnóstico:</td>
														<td class="showinput"><input type="text" name="hallaz_diag"></input></td>
													</tr>
													<tr>
														<td>CIE-10</td>
														<td>
															<select>
																<option value="1">opcion 1</option>
																<option value="2">opcion 2</option>																				
															</select>
														</td>
													</tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Tratamiento/Complicaciones</td></tr>
													<tr><td><textarea style="width:164px;height:50px;"></textarea></td></tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Observaciones:</td></tr>
													<tr><td><textarea style="width:160px;height:50px;"></textarea></td></tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
								<div id="tabs2-8">
									<table class="tabla-datos" width="100%">
										<tr>
											<td>
												<table>
													<tr>
														<td>Diagnóstico:</td>
														<td class="showinput"><input type="text" name="hallaz_diag"></input></td>
													</tr>
													<tr>
														<td>CIE-10</td>
														<td>
															<select>
																<option value="1">opcion 1</option>
																<option value="2">opcion 2</option>																				
															</select>
														</td>
													</tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Tratamiento/Complicaciones</td></tr>
													<tr><td><textarea style="width:164px;height:50px;"></textarea></td></tr>
												</table>
											</td>
											<td>
												<table>
													<tr><td>Observaciones:</td></tr>
													<tr><td><textarea style="width:160px;height:50px;"></textarea></td></tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<h3>Datos del Profesional</h3>
						<div>
							<table class="showinput">
								<tr>
									<td colspan="4">Nombre de quien refiere:</td>									
								</tr>
								<tr>
									<td style="width:100px;"><input type="text" name="refiere"/></td>
									<td><input type="radio" name="galeno">Médico Gral.</input></td>										
									<td><input type="radio" name="galeno">Odontólogo</input></td>										
									<td><input type="radio" name="galeno">Médico Especializado</input></td>										
								</tr>
								<tr>
									<td colspan="4">Nombre del Receptor:</td>										
								</tr>
								<tr>
									<td style="width:100px;"><input type="text" name="receptor"/></td>
									<td colspan="3">(Solo en caso de urgencias y hospitalización)</td>
								</tr>
							</table>
						</div>
					</div>	
				</div>
				<div id="tabs-2">
					<table class="tabla-datos" width="100%">
						<tr>
							<td style="width:90px">Institución que Responde:</td>
							<td>
								<select>
									<option value="1">hospital</option>
									<option value="2">hospital</option>
									<option value="3">hospital</option>
								</select>
							</td>
							<td>Instalación Receptora:</td>
							<td>
								<select>
									<option value="1">centro de salud</option>
									<option value="2">centro de salud</option>
									<option value="3">centro de salud</option>
								</select>
							</td>
						</tr>
					</table>
					<div id="accordion">
		
					<div>
						<div id="tabs3">
							<center>
							
							<ul>
								<li><a href="#tabs3-1">Hallazgos Clínicos</a></li>
								<li><a href="#tabs3-2">Diagnóstico</a></li>
								<li><a href="#tabs3-3">Recomendaciones/Plan Terapéutico</a></li>
							</ul>
							</center>
							<div id="tabs3-1">
								<table>
									<tr>
										<td>
											Hallazgos Clinicos
										</td>
									</tr>
									<tr>
										<td>
											<textarea  id="hallazgos_clinicos" name="hallazgos_clinicos"cols="150" rows="10"></textarea>
										</td>
									</tr>
									
								</table>
							</div>
							<div id="tabs3-2">
								<center>
									<table>
										<tr>
											<td>
												<table>
													<tr>
														<td>Diagnóstico: </td>
														<td><input type="text" id=diagnostico_respuesta""></td>
													</tr>
													<tr>
														<td>CIE-10: </td>
														<td><input type="text"></td>
													</tr>
												</table>
												Observaciones:<br>
												<textarea rows="5" cols="35"></textarea>
											</td>
											<td>
												&nbsp;
												&nbsp;
												&nbsp;
												&nbsp;
											</td>
											<td>
												<table>
													<tr>
													Manejo y Tratamiento:<br>
													<textarea rows="9" cols="35"></textarea>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</center>
							</div>
							<div id="tabs3-3">
								<center>
									<table>
										<tr>
											<td>Reevaluación especializada: </td>
											<td><input type="radio" id="reevaluacion" name="reevaluacion" value="0">Si</td>
											<td><input type="radio" id="reevaluacion" name="reevaluacion" value="1">No</td>
											<td>&nbsp&nbsp&nbsp</td>
											<td>&nbsp&nbsp&nbsp</td>
											<td>&nbsp&nbsp&nbsp</td>
											<td>&nbsp&nbsp&nbsp</td>
											<td>Fecha: </td>
											<td>&nbsp&nbsp&nbsp</td>
											<td>&nbsp&nbsp&nbsp</td>
											<td><input type="date" id="fecharecomendacion" name="fecharecomendacion"></td>
										</tr>
									</table>
									Observaciones:<br>									
									<textarea id="observacionrecomendacion" name="observacionrecomendacion" rows="5" cols="50"></textarea>
								</center>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
			<button>Enviar</button>
		</form>
	';	
		
	$ds->contenido($cont);
	$ds->mostrar();
?>