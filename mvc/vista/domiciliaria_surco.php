<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();

	$tab1="'tab_01'";
	$tab2 = "'tab_02'";
	$panel1 = "'panel_01'";
	$panel2 = "'panel_02'";
	
	$cont='
		<fieldset style="height:530px;">
			<legend style="font-size:17px;font-weight:bold;" align="center">Sistema Único de Referencia y Contrarreferencia</legend>
			<table width="95%" style="margin:10px auto;border:1px solid #a3a3a3; background:#fafafa;">
				<tr>
					<td style="width:150px;border:1px solid #a3a3a3;">
						<table class="tabla-datos">
							<tr>
								<td colspan="3"><strong>Fulanito de Tal</strong></td>
							</tr>
							<tr>
								<td>4-125-634</td>
								<td>O+</td>
								<td>Masculino</td>
							</tr>
							<tr>
								<td>15/09/1979</td>
								<td>Asegurado</td>
								<td>34 años</td>
							</tr>
						</table>
					</td>
					<td style="width:200px;border:1px solid #a3a3a3;">
						<table class="tabla-datos">
							<tr>
								<td colspan="3"><strong>Datos de Contacto/Dirección:</strong></td>
							</tr>
							<tr>
								<td colspan="3">Panamá La Chorrera</td>
							</tr>
							<tr>
								<td colspan="3">Barrio Colón, Casa 2250, Calle Matuna</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<div id="panel">
				<ul id="tabs">
					<li id="tab_01"><a href="#" onclick="tab('.$tab1.','.$panel1.');">Referencia</a></li>
					<li id="tab_02"><a href="#" onclick="tab('.$tab2.','.$panel2.');">Respuesta a la Referencia</a></li>
				</ul>
				<div id="paneles">
					<form method="POST" action="./?">
						<section id="panel_01" class="acordeon">
							<div>
								<input type="radio" id = "de-1" checked name="ac">
									<label for="de-1">Datos de Referencia</label>
								</input>
								<article class="tab-height1">
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
								</article>								
							</div>
							<div>
								<input type="radio" id = "de-2" name="ac">
									<label for="de-2">Historial del Paciente</label>
								</input>
								<article class="tab-height2">
									<table class="tabla-datos">
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
											<td style="background:#fafafa;border:1px solid #fafafa;"><a href="./?url=registrar" title="Registrar"><img src="./iconos/add.gif"/></a> </td>
										</tr>
									</table>
								</article>
							</div>
							<div>
								<input type="radio" id = "de-3" name="ac">
									<label for="de-3">Resultados de Exámenes/Diagnóstico</label>
								</input>
								<article class="tab-height3">
									<!-- Segunda Pestaña -->
									<div class="contenedor-tabs">
										<span class="diana" id="bhc"></span>
											<div class="tab">
												<a href="#bhc" class="tab-e">BHC</a>
												<div>
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
										<span class="diana" id="urin"></span>
											<div class="tab">
												<a href="#urin" class="tab-e">Urin</a>
												<div>
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
										<span class="diana" id="hec"></span>
											<div class="tab">
												<a href="#hec" class="tab-e">Heces</a>
												<div>
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
										<span class="diana" id="glic"></span>
											<div class="tab">
												<a href="#glic" class="tab-e">Glicemia</a>
												<div>
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
										<span class="diana" id="creat"></span>
											<div class="tab">
												<a href="#creat" class="tab-e">Creatinina</a>
												<div>
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
										<span class="diana" id="ndeu"></span>
											<div class="tab">
												<a href="#ndeu" class="tab-e">N de U</a>
												<div>
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
										<span class="diana" id="elect"></span>
											<div class="tab">
												<a href="#elect" class="tab-e">Electrolitos</a>
												<div>
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
										<span class="diana" id="amil"></span>
											<div class="tab">
												<a href="#amil" class="tab-e">Amilasa</a>
												<div>
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
									<!-- Fin de Segunda Pestaña -->
								</article>
							</div>
							<div>
								<input type="radio" id = "de-4" name="ac">
									<label for="de-4">Datos del Profesional</label>
								</input>
								<article class="tab-height4">
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
								</article>
							</div>						
						<div class="showinput" align="right"><input type="submit" name="registrar" value="Registrar" title="Registrar"/></div>
						</section>
					</form>
					<form method="POST" action="./?url">
						<section id="panel_02">
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
								<tr>
									<td colspan="4" style="color:#fff;background:#6383c2;margin-top:5px;padding:10px;font-size:13px;font-weight:bold;text-shadow: #000 1px 1px 1px;">Respuesta a la Referencia</td>
								</tr>	
							</table>	
							<div class="contenedor-tabs">
								<span class="diana" id="hacli"></span>
									<div class="tab">
										<a class="tab-e" href="#hacli" >Hallazgos Clínicos</a>
										<div>
											<textarea style="width:580px;min-height:50px;"></textarea>
										</div>
									</div>
								<span class="diana" id="diag"></span>
									<div class="tab">
										<a class="tab-e" href="#diag">Diagnóstico</a>
										<div>
											<table width="90%" class="showinput" class="tabla-datos" cellpadding="0" cellspacing="0">
												<tr>
													<td>
														<table>
															<tr>
																<td style="width:50px;">Diagnóstico:</td>
																<td class="showinput"><input type="text" name="diagnostico"/></td>
															</tr>
															<tr>
																<td>CIE-10:</td>
																<td class="showinput"><input type="text" name="cie10"/></td>
															</tr>
															<tr>
																<td colspan="2">Observaciones:</td>																
															</tr>
															<tr>
																<td colspan="2"><textarea style="width:260px;height:40px;"></textarea></td>
															</tr>
														</table>
													</td>													
													<td>
														<table>
															<tr>
																<td colspan="2">Manejo y Tratamiento:</td>
															</tr>
															<tr rowspan="3">
																<td colspan="2"><textarea style="width:270px;height:87px;"></textarea></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</div>
									</div>
								<span class="diana" id="plantera"></span>
									<div class="tab">
										<a class="tab-e" href="#plantera">Recomendaciones/Plan Terapéutico</a>
										<div>
											<table class="tabla-datos">
												<tr>
													<td style="width:120px">Reevaluación especializada:</td>
													<td><input type="radio" name="reeval1">Sí</input></td>
													<td><input type="radio" name="reeval1">No</input></td>
													<td colspan="2"></td>
													<td>Fecha:</td>
													<td><input type="date"/></td>
												</tr>
												<tr>
													<td colspan="7">Observaciones</td>
												</tr>
												<tr>
													<td colspan="7"><textarea style="width:550px;height:40px;"></textarea></td>
												</tr>
											</table>
										</div>
									</div>		
							</div>
							<div class="showinput" align="right" style="margin-top:40px;">
								<input type="submit" name="nuevanota" value="+Nueva Nota" title="Añadir Nueva Nota"/>
								<input type="submit" name="agregar" value="Agregar" title="Agregar"/>
							</div>
						</section>
					</form>
				</div>
				<!-- Script para marcar el primer tab seleccionado de la 1era pestaña-->
				<script type="text/javascript">
					tab("tab_01","panel_01");
				</script>
			</div>
			<!--Fin del Contenido-->
		</fieldset>';	
		
	$ds->contenido($cont);
	$ds->mostrar();
?>