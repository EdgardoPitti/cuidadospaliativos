<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$tiposangre = new Accesatabla('tipos_de_sangre');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$etnia = new Accesatabla('etnia');
	$estadocivil = new Accesatabla('estadocivil');
	$nacionalidades = new Accesatabla('nacionalidades');
	$parentesco = new Accesatabla('parentesco');
	$ds = new Diseno();
	$cont.='

			<form action="./?url=agregardatosdomiciliaria" method="post">
						<fieldset>
							<legend>
								Capturar Datos
							</legend>
							<fieldset>
												<legend>
													Datos de Identificacion/Personales del Paciente
												</legend>
												<center>
													<table>
															<tr>
																<td align="right">N� de Cedula:</td>
																<td><input type="text" id="cedula" name="cedula"><br></td>

																<td align="right">Nacionalidad:</td>
																<td><select id="nacionalidad" name="nacionalidad" style="width:160px">
																		<option value="0"></option>';
																		
	$n = $nacionalidades->buscardonde('id > 0');
	while($n){
			$cont.='
																		<option value="'.$nacionalidades->obtener('id').'">'.$ds->latino($nacionalidades->obtener('nacionalidad')).' - '.$ds->latino($nacionalidades->obtener('pais')).'</option>
			';
			$n = $nacionalidades->releer();
	}
	$cont.='														</select>
																</td>
															</tr>
															<tr>
																<td align="right">Primer Nombre: </td>
																<td><input type="text" id="primernombre" name="primernombre"><br></td>
																<td align="right">Segundo Nombre: </td>
																<td><input type="text" id="segundonombre" name="segundonombre"><br></td>
															</tr>														
															<tr>
																<td align="right">Primer Apellido: </td>
																<td><input type="text" id="primerapellido" name="primerapellido"><br></td>
																<td align="right">Segundo Apellido: </td>
																<td><input type="text" id="segundoapellido" name="segundoapellido"><br></td>
															</tr>																												
															<tr>
																<td>Fecha de Nacimiento: </td>
																<td><input type="date" id="fechanacimiento" name="fechanacimiento"><br></td>
																<td align="right" >Tipo de Sangre: </td>
																<td align="center"><select id="tiposangre" name="tiposangre" style="width:100px">
																						<option value="0"></option>';
																			
	$x = $tiposangre->buscardonde("id > 0");
	while($x){
			$cont.='
																						<option value="'.$tiposangre->obtener('id').'">'.$tiposangre->obtener('tipo_sangre').'</option>
			';
			$x = $tiposangre->releer();
	}													
	$cont.='																	</select></td>
															</tr>
															<tr>
																<td align="right">Estado Civil: </td>
																<td align="center"><select id="estadocivil" name="estadocivil" style="width:100px">
																						<option value="0"></option>';
	$ec = $estadocivil->buscardonde('id > 0');
	while ($ec){
			$cont.='
																						<option value="'.$estadocivil->obtener('id').'">'.$estadocivil->obtener('descripcion').'</option>
			';
			$ec = $estadocivil->releer();
	}
																	
	$cont.='
																					</select>
																</td>
																<td align="right">Sexo:</td>
																<td align="center"><select id="sexo" name="sexo">
																		<option value=""></option>
																		<option value="0">Masculino</option>
																		<option value="1">Femenino</option>
																	</select>
																</td>
															</tr>
															<tr>
																<td align="right">Nombre Padre:</td>
																<td><input type="text" id="nombrepadre" name="nombrepadre"></td>															
																<td align="right">Nombre Madre:</td>
																<td><input type="text" id="nombremadre"  name="nombremadre"></td>

															</tr>	
															<tr>															
																<td align="right">Tipo de Paciente:</td>
																<td><input type="radio" id="tipo" name="tipo" value="1" checked>Asegurado</td>
																<td align="right">N� de Seguro:</td>
																<td><input type="text" id="numeroseguro" name="numeroseguro"></td>
															</tr>
															<tr>
																<td></td>
																<td><input type="radio" id="tipo" name="tipo" value="0"> No Asegurado</td>
																<td align="right">Ocupacion: </td>
																<td><input type="text" id="ocupacion" name="ocupacion"></td>
															</tr>
														</table>
													</center>
												</fieldset>
												<fieldset>
													<legend>
														Datos de Contacto/Direccion
													</legend>
													<center>
														<table>
															<tr>
																<td>Correo Electr�nico:</td>
																<td><input type="text" id="correo" name="correo"></td>
																<td align="right">Telefono:</td>
																<td><input type="text" id="telefono" name="telefono"></td>
															</tr>
															<tr>
																<td align="right">Provincia: </td>
																<td>
																	<select id="provincias" name="provincias">
																		<option value="0"></option>';
															
													
	$p = $provincias->buscardonde("id > 0");
	while($p){
			$cont.='
																		<option value="'.$provincias->obtener('id').'">'.$provincias->obtener('descripcion').'</option>
			
			';
			$p = $provincias->releer();

	}
		$cont.='												   </select>
																</td>
																<td align="right">Corregimientos:</td>
																<td id="mostrarcorregimientos" name="mostrarcorregimientos">
																	<select style="width:140px"></select>
																</td>
																
															</tr>
															<tr>
																<td align="right">Distritos:</td>
																<td id="mostrardistritos" name="mostrardistritos">
																	<select style="width:140px"></select>
																</td>
																<td align="right"></td><td> Direcci�n Detallada:</td>
															</tr>
															<tr>
																<td align="right">Informante: </td>
																<td><input type="text" id="nombreinformante" name="nombreinformante"></td>
																<td><select id="parentescoinformante" name="parentescoinformante">
																		<option value="0"></option>';
	$p = $parentesco->buscardonde('id > 0');
	while($p){
			$cont.='													<option value="'.$parentesco->obtener('id').'">'.$parentesco->obtener('descripcion').'</option>';
			$p = $parentesco->releer();
	}
		$cont.='													</select></td>
																<td><textarea id="direcciondetallada" name="direcciondetallada" rows="2" cols="16"></textarea></td>
															</tr>
														</table>
													</center>
												</fieldset>
												<table width="100%">
													<tr>
														<td width="50%">
															<fieldset>
																<legend>
																	Lugar de Nacimiento
																</legend>
																<table>
																	<tr>
																		<td>&nbsp</td>
																		<td>&nbsp</td>
																		<td>&nbsp</td>
																	</tr>
																	<tr>
																		<td align="right">Provincia Nacimiento:</td>
																		<td><select id="provinciasnacimiento" name="provinciasnacimiento">
																				<option value="0"></option>';
	$p = $provincias->buscardonde('id > 0');
	while($p){
			$cont.='
																				<option value="'.$provincias->obtener('id').'">'.$provincias->obtener('descripcion').'</option>
			';
			$p = $provincias->releer();
	}
																	
				$cont.='													</select>
																		</td>
																	<tr>
																	</tr>
																		<td align="right">Distrito Nacimiento: </td>
																		<td id="mostrardistritosnacimiento" name="mostrardistritosnacimiento">
																			<select style="width:140px"></select>
																		</td>
																	</tr>
																	<tr>
																		<td align="right">Corregimiento Nacimiento: </td>
																		<td id="mostrarcorregimientosnacimiento" name="mostrarcorregimientosnacimiento">
																			<select style="width:140px"></select>
																		</td>
																	</tr>
																	<tr>
																		<td>&nbsp</td>
																		<td>&nbsp</td>
																		<td>&nbsp</td>
																	</tr>
																</table>
															</fieldset>
														</td>
														<td>
															<fieldset>
																<legend>
																	En caso de Emergencia: 
																</legend>
																	<center>
																		<table>
																			<tr>
																				<td align="right">Nombres:</td>
																				<td><input type="text" id="nombresemergencia" name="nombresemergencia"></td>
																				<td><select id="parentescoemergencia" name="parentescoemergencia">
																						<option value="0"></option>';
	$p = $parentesco->buscardonde('id > 0');
	while($p){
			$cont.='																	<option value="'.$parentesco->obtener('id').'">'.$parentesco->obtener('descripcion').'</option>';
			$p = $parentesco->releer();
	}
	$cont.='																		</select>
																				</td>
																			</tr>
																			<tr>
																				<td>Apellidos: </td>
																				<td><input type="text" id="apellidosemergencia" name="apellidosemergencia"></td>
																				<td></td>
																			</tr>
																			<tr>
																				<td>Telefono: </td>
																				<td><input type="text" id="telefonoemergencia" name="telefonoemergencia"></td>
																				<td></td>
																			</tr>
																			<tr>
																				<td>Direccion: </td>
																				<td><textarea id="direccionemergencia" name="direccionemergencia" rows="1" cols="20"></textarea></td>
																				
																			</tr>
																		</table>
																	</center>
															</fieldset>
														</td>
													</tr>
												</table>
								<button type="submit">Enviar</button>
						</fieldset>

			</form>';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>