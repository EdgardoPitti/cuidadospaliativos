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
				<left>Buscar Paciente<br><br>
				Cedula: <input type="search" id="cedula" name="cedula"> <button>Buscar</button><br><br>
				</left>
			</form>';
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
		$cont=' <table>
					<tr>
						<td>
							<fieldset>
								<legend>
									Paciente
								</legend>
									'.$personas->obtener('primer_nombre').' '.$personas->obtener('segundo_nombre').' '.$personas->obtener('primer_apellido').' '.$personas->obtener('segundo_apellido').'<br>
									'.$cedula.' &nbsp&nbsp&nbsp '.$tiposangre->obtener('tipo_sangre').'<br>
									'.$sexo.' &nbsp&nbsp&nbsp '.$personas->obtener('ocupacion').'<br>
									'.$ds->edad($dia,$mes,$anio).' &nbsp&nbsp&nbsp '.$dia.'/'.$mes.'/'.$anio.'
							</fieldset>
						</td>
						<td>
							<fieldset>
								<legend>
									Direcci�n
								</legend>
									&nbsp&nbsp<br>
									'.$distritos->obtener('descripcion').' , '.$provincias->obtener('descripcion').'<br>
									'.$corregimientos->obtener('descripcion').' , '.$personas->obtener('direccion_detallada').'<br>
									&nbsp&nbsp
							</fieldset>
						</td>
					</tr>
				</table>
		';
	}
	
	$cont.='
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
							<td>Instalaci�n que Refiere:</td>
							<td></td>
							<td>Servicio M�dico al que se refiere:</td>
							<td></td>
						</tr>
						<tr>
							<td>Instalaci�n Receptora:</td>
							<td></td>
							<td>Clasificaci�n de la Atenci�n solicitada:</td>
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
								<td style="width:100px;">Examen F�sico:</td>
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
								<th>T�</th>
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
					<h3>Resultado de Ex�menes/Diagn�stico</h3>
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
													<td>Diagn�stico:</td>
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
													<td>Diagn�stico:</td>
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
													<td>Diagn�stico:</td>
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
													<td>Diagn�stico:</td>
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
													<td>Diagn�stico:</td>
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
													<td>Diagn�stico:</td>
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
													<td>Diagn�stico:</td>
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
													<td>Diagn�stico:</td>
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
								<td><input type="radio" name="galeno">M�dico Gral.</input></td>										
								<td><input type="radio" name="galeno">Odont�logo</input></td>										
								<td><input type="radio" name="galeno">M�dico Especializado</input></td>										
							</tr>
							<tr>
								<td colspan="4">Nombre del Receptor:</td>										
							</tr>
							<tr>
								<td style="width:100px;"><input type="text" name="receptor"/></td>
								<td colspan="3">(Solo en caso de urgencias y hospitalizaci�n)</td>
							</tr>
						</table>
				</div>
				</div>
				
				
			</div>
			<div id="tabs-2">
				<table class="tabla-datos" width="100%">
					<tr>
						<td style="width:90px">Instituci�n que Responde:</td>
						<td>
							<select>
								<option value="1">hospital</option>
								<option value="2">hospital</option>
								<option value="3">hospital</option>
							</select>
						</td>
						<td>Instalaci�n Receptora:</td>
						<td>
							<select>
								<option value="1">centro de salud</option>
								<option value="2">centro de salud</option>
								<option value="3">centro de salud</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="4" style="color:#fff;background:#47a3da;margin-top:5px;padding:10px;font-size:13px;font-weight:bold;text-shadow: #000 1px 1px 1px;">Respuesta a la Referencia</td>
					</tr>	
				</table>
			</div>
		</div>
	
	';	
		
	$ds->contenido($cont);
	$ds->mostrar();
?>