<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	$cont='
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
				<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
			</div>
		</div>
	
	';	
		
	$ds->contenido($cont);
	$ds->mostrar();
?>