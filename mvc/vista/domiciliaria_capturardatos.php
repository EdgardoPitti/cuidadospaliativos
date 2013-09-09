<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$tiposangre = new Accesatabla('tipos_de_sangre');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$etnia = new Accesatabla('etnia');
	$estadocivil = new Accesatabla('estadocivil');
	$nacionalidades = new Accesatabla('nacionalidades');
	$ds = new Diseno();
	
	$cont.='

			<form action="./?url=agregardatosdomiciliaria" method="post" style="display:block;">
						<fieldset>
							<legend align="center">
								<h3 style="background:#f4f4f4;">Sistema de Captura de Datos de Atención Domiciliaria</h3>
							</legend>
							<div style="float:left;width:50%;min-width:510px;">
								<fieldset>
												<legend align="center">
													Datos de Identificacion/Personales del Paciente
												</legend>
												<center>
													<table>
															<tr>
																<td align="right">N° de Cedula:</td>
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
																<td style="padding-left:5px;"><input type="radio" id="tipo" name="tipo" value="1" checked> Asegurado</td>
																<td align="right">N° de Seguro:</td>
																<td><input type="text" id="numeroseguro" name="numeroseguro"></td>
															</tr>
															<tr>
																<td></td>
																<td style="padding-left:5px;"><input type="radio" id="tipo" name="tipo" value="0"> No Asegurado</td>
																<td align="right">Ocupacion: </td>
																<td><input type="text" id="ocupacion" name="ocupacion"></td>
															</tr>
														</table>
													</center>
												</fieldset>
											</div>
											<div style="float:none;">
												<fieldset>
													<legend align="center">
														Datos de Contacto/Direccion
													</legend>
													<center>
														<table>
															<tr>
																<td>Correo Electrónico:</td>
																<td><input type="text" id="correo" name="correo"></td>
																<td></td>
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
																<td></td>
																<td>Dirección Detallada:</td>																
																<td align="right"><textarea  class="textarea" id="direcciondetallada" name="direcciondetallada"></textarea></td>
															</tr>
															<tr>
																<td align="right">Distritos:</td>
																<td id="mostrardistritos" name="mostrardistritos">
																	<select style="width:140px"></select>
																</td>	
																<td></td>	
															</tr>
															<tr>
																<td align="right">Corregimientos:</td>
																<td id="mostrarcorregimientos" name="mostrarcorregimientos">
																	<select style="width:140px"></select>
																</td>
																<td></td>
															</tr>
														</table>
													</center>
												</fieldset>
											</div>	
												<center>
												<table width="100%">
													<tr>
														<td width="50%">
															<fieldset>
																<legend align="center">
																	Lugar de Nacimiento
																</legend>
																<center>
																	<table>
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
																	
				$cont.='														</select>
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
																	</table>
																</center>
															</fieldset>
														</td>
														<td>
															<fieldset>
																<legend align="center">
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
														
						$cont.='												</select>
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
												</table>
												</center>
								<button type="submit" class="btn btn-primary">Registrar</button>
						</fieldset>

			</form>';
	
	//$ds->nav($_SESSION['nav']);
	//$ds->izq($_SESSION['aside']);
	$ds->contenido($cont);
	$ds->mostrar();
?>