<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$tiposangre = new Accesatabla('tipos_de_sangre');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$etnia = new Accesatabla('etnia');
	$ds = new Diseno();
	$cont.='

			<form action="./?url=" method="post">
					<center>
						<fieldset>
							<legend>
								Capturar Datos
							</legend>
								<table width="100%">
									<tr>
										<td>
											<fieldset>
												<legend>
													Datos de Identificacion
												</legend>
												<center>
													<table cellpadding="10">
															<tr>
																<td >N° de tarjeta de Seguimiento:  </td>
																<td><input type="text" id="tarjetaseguimiento" name="tarjetaseguimiento"><br></td>
															</tr>
															<tr>
																<td align="center">N° de Cedula:</td>
																<td><input type="text" id="cedula" name="cedula"><br></td>
															</tr>
															<tr>
																<td align="center">Nacionalidad:</td>
																<td><input type="text" id="cedula" name="cedula"><br></td>
															</tr>
													</table>
													Tipo de Paciente: <input type="radio" id="tipo" name="tipo"> Asegurado <input type="radio" id="tipo" name="tipo"> No Asegurado
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
															<td align="center">Nombre: </td>
															<td><input type="text" id="nombre" name="nombre"><br></td>
														</tr>														
														<tr>
															<td align="center">Apellido: </td>
															<td><input type="text" id="apellido" name="apellido"><br></td>
														</tr>														
														<tr>
															<td>Fecha de Nacimiento: </td>
															<td><input type="date" id="fechanacimiento" name="fechanacimiento"><br></td>
														</tr>
													</table>
														Sexo: <input type="radio" id="sexo" name="sexo"> Masculino <input type="radio" id="sexo" name="sexo"> Femenino<br>
														Tipo de Sangre: <select id="tiposangre" name="tiposangre">
																			<option value="0"></option>';
																			
	$x = $tiposangre->buscardonde("id > 0");
	while($x){
			$cont.='
																			<option value="'.$tiposangre->obtener('id').'">'.$tiposangre->obtener('tipo_sangre').'</option>
			';
			$x = $tiposangre->releer();
	}													
	$cont.='															</select>
													
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
															<td align="center">Provincia: </td>
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
															<td align="center">Distritos:</td>
															<td id="mostrardistritos" name="mostrardistritos">
																<select style="width:140px"></select>
															</td>
														</tr>
														<tr>
															<td align="center">Corregimientos:</td>
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
															<td>Etnia: </td>
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
															<td>Programa: </td>
															<td><select id="programas" name="programas">
																	<option value="0"></option>
																	<option value="1">Infantil</option>
																	<option value="2">Maternal</option>
																	<option value="3">Adulto</option>
																</select>
															</td>
														</tr>
														<tr>
															<td>Categoria: </td>
															<td id="mostrarcategorias" name="mostrarcategorias"><select style="width:140px"></select></td>
														</tr>
													</table>
											</center>
											</fieldset>
										</td>
									</tr>

								</table>
								<button type="submit">Enviar</button>
						</fieldset>
					</center>
					
			</form>';
	
	$ds->nav($_SESSION['nav']);
	$ds->izq($_SESSION['aside']);
	$ds->contenido($cont);
	$ds->mostrar();
?>