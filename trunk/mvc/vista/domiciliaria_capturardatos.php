<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$tiposangre = new Accesatabla('tipos_de_sangre');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$etnia = new Accesatabla('etnia');
	$estadocivil = new Accesatabla('estadocivil');
	$ds = new Diseno();
	$cont.='

			<form action="./?url=agregardatosdomiciliaria" method="post">
						<fieldset>
							<legend>
								Capturar Datos
							</legend>
								<table width="100%" border="1">
									<tr>
										<td>
											<fieldset>
												<legend>
													Datos de Identificacion
												</legend>
												<center>
													<table >
															<tr>
																<td >N° de tarjeta de Seguimiento:  </td>
																<td><input type="text" id="tarjetaseguimiento" name="tarjetaseguimiento"><br></td>
															</tr>
															<tr>
																<td align="right">N° de Cedula:</td>
																<td><input type="text" id="cedula" name="cedula"><br></td>
															</tr>
															<tr>
																<td align="right">Nacionalidad:</td>
																<td><input type="text" id="cedula" name="cedula"><br></td>
															</tr>
													</table>
													Tipo de Paciente: <input type="radio" id="tipo" name="tipo" value="1" checked> Asegurado <input type="radio" id="tipo" name="tipo" value="0"> No Asegurado<br>
													N° de Seguro: <input type="text" id="numeroseguro" name="numeroseguro"><br>
												</center>
											</fieldset>
										</td>
										<td>
											<fieldset>
												<legend>
													Datos Personales del Paciente
												</legend>
												<center>
													<table >
														<tr>
															<td align="right">Primer Nombre: </td>
															<td><input type="text" id="primernombre" name="primernombre"><br></td>
														</tr>														
														<tr>
															<td align="right">Segundo Nombre: </td>
															<td><input type="text" id="segundonombre" name="segundonombre"><br></td>
														</tr>														
														<tr>
															<td align="right">Primer Apellido: </td>
															<td><input type="text" id="primerapellido" name="primerapellido"><br></td>
														</tr>														
														<tr>
															<td align="right">Segundo Apellido: </td>
															<td><input type="text" id="segundoapellido" name="segundosapellido"><br></td>
														</tr>																												
														<tr>
															<td>Fecha de Nacimiento: </td>
															<td><input type="date" id="fechanacimiento" name="fechanacimiento"><br></td>
														</tr>
														<tr>
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
	$cont.='															</select></td>
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
															</td>
														</tr>
														<tr>
															<td align="right">Nombre Padre:</td>
															<td><input type="text" id="nombrepadre" name="nombrepadre"></td>
														</tr>
														<tr>
															<td align="right">Nombre Madre:</td>
															<td><input type="text" id="nombremadre"  name="nombremadre"></td>
														</tr>
														<tr>
															<td align="right">Ocupacion: </td>
															<td><input type="text" id="ocupacion" name="ocupacion"></td>
														</tr>
														<tr>
														</tr>
													</table>
														Sexo: <input type="radio" id="sexo" name="sexo" value="m" checked> Masculino <input type="radio" id="sexo" name="sexo" value="f"> Femenino<br>	
												</center>
												
											</fieldset>
										</td>
									</tr>
									<tr>
										<td>
											<fieldset>
												<legend>
													Datos de Contacto/Direccion
												</legend>
												<center>
													<table>
														<tr>
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
														</tr>
														<tr>
															<td align="right">Distritos:</td>
															<td id="mostrardistritos" name="mostrardistritos">
																<select style="width:140px"></select>
															</td>
														</tr>
														<tr>
															<td align="right">Corregimientos:</td>
															<td id="mostrarcorregimientos" name="mostrarcorregimientos">
																<select style="width:140px"></select>
															</td>
														</tr>															
													</table>
													Direccion Detallada:<br>
													<textarea></textarea>
												</center>
											</fieldset>
										</td>
										<td>
											<fieldset>
												<legend>
													Datos de Registro Medico
												</legend>
												<center>
													<table>
														<tr>
															<td align="right">Etnia: </td>
															<td><select id="etnia" name="etnia">
																	<option value="0"></option>
																';
	$e = $etnia->buscardonde("id > 0");
	while ($e){
			$cont.='
																	<option value="'.$etnia->obtener('id').'">'.$etnia->obtener('descripcion').'</option>
			';
		$e = $etnia->releer();
	}
														
			$cont.='											</select>
															</td>
														</tr>
														<tr>
															<td align="right">Programa: </td>
															<td><select id="programas" name="programas">
																	<option value="0"></option>
																	<option value="1">Infantil</option>
																	<option value="2">Maternal</option>
																	<option value="3">Adulto</option>
																</select>
															</td>
														</tr>
														<tr>
															<td align="right">Categoria: </td>
															<td id="mostrarcategorias" name="mostrarcategorias"><select style="width:140px"></select></td>
														</tr>
													</table>
											</center>
											</fieldset>
										</td>
									</tr>
									<tr>
										<td>
											<fieldset>
												<legend>
													Lugar de Nacimiento
												</legend>
												<center>
													<table>
														<tr>
															<td align="right">Provincia:</td>
															<td><select id="provinciasnacimiento" name="provinciasnacimiento">
																	<option value="0"></option>';
	$p = $provincias->buscardonde('id > 0');
	while($p){
			$cont.='
																	<option value="'.$provincias->obtener('id').'">'.$provincias->obtener('descripcion').'</option>
			';
			$p = $provincias->releer();
	}
																	
			$cont.='											</select>
															</td>
														</tr>
														<tr>
															<td align="right">Distrito: </td>
															<td id="mostrardistritosnacimiento" name="mostrardistritosnacimiento">
																<select style="width:140px"></select>
															</td>
														</tr>
														<tr>
															<td align="right">Corregimiento: </td>
															<td id="mostrarcorregimientosnacimiento" name="mostrarcorregimientosnacimiento">
																<select style="width:140px"></select>
															</td>
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
	
	$ds->nav($_SESSION['nav']);
	$ds->izq($_SESSION['aside']);
	$ds->contenido($cont);
	$ds->mostrar();
?>