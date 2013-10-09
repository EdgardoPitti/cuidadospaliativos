<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$etnia = new Accesatabla('etnia');
	$zona = new Accesatabla('zona');
	$tipopaciente = new Accesatabla('tipo_paciente');
	$estadocivil = new Accesatabla('estados_civiles');
	$nacionalidades = new Accesatabla('nacionalidades');
	$sexo = new Accesatabla('sexo');
	$ds = new Diseno();

	$cont.='

			<form action="./?url=agregardatospaciente" method="post" style="display:block;">
						<fieldset>
							<legend align="center">
								<h3 style="background:#f4f4f4;padding:10px;">Sistema de Captura de Datos de Atención Domiciliaria</h3>
							</legend>
							<div class="row-fluid">
								<div style="float:left;wi dth:50%;mi n-width:510px;" class="span6">
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
																			
		$n = $nacionalidades->buscardonde('ID_NACIONALIDAD > 0');
		while($n){
				$cont.='
																<option value="'.$nacionalidades->obtener('ID_NACIONALIDAD').'">'.$ds->latino($nacionalidades->obtener('NACIONALIDAD')).'</option>
				';
				$n = $nacionalidades->releer();
		}
	$cont.='												</select>
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
													</tr>
													<tr>
														<td align="right" >Tipo de Sangre: </td>
														<td align="center">
															<select id="tiposangre" name="tiposangre" style="width:100px">
																<option value="0"></option>';
																				
		$x = $tiposangre->buscardonde("ID_TIPO_SANGUINEO > 0");
		while($x){
				$cont.='
																<option value="'.$tiposangre->obtener('ID_TIPO_SANGUINEO').'">'.$tiposangre->obtener('TIPO_SANGRE').'</option>
				';
				$x = $tiposangre->releer();
		}													
		$cont.='											</select>
														</td>
															<td>Lugar de Nacimiento: </td>
															<td><input type="text" id="lugarnacimiento" name="lugarnacimiento"></td>
														</tr>
														<tr>
															<td align="right">Estado Civil: </td>
															<td align="center">
																<select id="estadocivil" name="estadocivil" style="width:100px">
																	<option value="0"></option>';
		$ec = $estadocivil->buscardonde('ID_ESTADO_CIVIL > 0');
		while ($ec){
				$cont.='
																	<option value="'.$estadocivil->obtener('ID_ESTADO_CIVIL').'">'.$estadocivil->obtener('ESTADO_CIVIL').'</option>
				';
				$ec = $estadocivil->releer();
		}
																		
		$cont.='
																</select>
															</td>
															<td align="right">Sexo:</td>
															<td align="center">
																<select id="sexo" name="sexo">
																	<option value=""></option>';
		$s = $sexo->buscardonde('ID_SEXO > 0');
		while($s){
			$cont .= '
																	<option value="'.$sexo->obtener('ID_SEXO').'">'.$sexo->obtener('SEXO').'</option>
			';
			$s = $sexo->releer();
		}
	$cont.='													</select>
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
															<td><select id="tipopaciente" name="tipopaciente">
																	<option value="0"></option>';
		$t = $tipopaciente->buscardonde('ID_TIPO_PACIENTE');
		while ($t){
			$cont.='
																	<option value="'.$tipopaciente->obtener('ID_TIPO_PACIENTE').'">'.$tipopaciente->obtener('TIPO_PACIENTE').'</option>
			';
			$t = $tipopaciente->releer();
		}
		$cont.='																	
																</select>	
															</td>
															<td align="right">N° de Seguro:</td>
															<td><input type="text" id="numeroseguro" name="numeroseguro"></td>
														</tr>
														<tr>
															<td align="right">Ocupacion: </td>
															<td><input type="text" id="ocupacion" name="ocupacion"></td>
															<td align="right">Etnia: </td>
															<td><select id="etnia" name="etnia">
																	<option value="0"></option>';
																	
		$e = $etnia->buscardonde("ID_ETNIA > 0");
		while ($e){
				$cont.='
																	<option value="'.$etnia->obtener('ID_ETNIA').'">'.$etnia->obtener('ETNIA').'</option>
				';
			$e = $etnia->releer();
		}
															
							$cont.='							</select>
															</td>																
														</tr>
													</table>
												</center>
										</fieldset>
									</div>
									<div class="span6" style="f loat:none;">
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
												
$p = $provincias->buscardonde("ID_PROVINCIA > 0");
while($p){
		$cont.='
																<option value="'.$provincias->obtener('ID_PROVINCIA').'">'.$provincias->obtener('PROVINCIA').'</option>
		';
		$p = $provincias->releer();

}
$cont.='													   </select>
														</td>
														<td></td>
														<td align="right">Celular:</td>
														<td><input type="text" id="celular" name="celular"></td>
													</tr>
													<tr>
														<td align="right">Distritos:</td>
														<td id="mostrardistritos" name="mostrardistritos">
															<select style="width:140px"></select>
														</td>
														<td></td>																
														<td align="right">Zona: </td>
														<td><select id="zona" name="zona">
																<option value="0"></option>';
$z = $zona->buscardonde('ID_ZONA > 0');
while($z){
	$cont.='
																<option value="'.$zona->obtener('ID_ZONA').'">'.$zona->obtener('ZONA').'</option>
	';
	$z = $zona->releer();
}

$cont.='														</select>
														</td>
													</tr>
													<tr>
														<td align="right">Corregimientos:</td>
														<td id="mostrarcorregimientos" name="mostrarcorregimientos">
															<select style="width:140px"></select>
														</td>
														<td></td>
														<td>Dirección Detallada:</td>																
														<td align="right"><textarea  class="textarea" id="direcciondetallada" name="direcciondetallada"></textarea></td>
													</tr>
													<tr>
														<td align="right">Residencia Transitoria: </td>
														<td><textarea  class="textarea" id="residenciatransitoria" name="residenciatransitoria"></textarea></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
												</table>
											</center>
										</fieldset>

										<!--	<center>
												<fieldset>
															<legend align="center">
																Datos de Registro Medico
															</legend>
															<center>
																<table>
																	<tr>
																		<td align="right">Programa: </td>
																		<td><select id="programas" name="programas">
																				<option value="0"></option>
																				<option value="1">INFANTIL</option>
																				<option value="2">MATERNAL</option>
																				<option value="3">ADULTO</option>
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

											</center>-->
										</div>	
									</div>	
							<center>			
								<button type="submit" class="btn btn-primary">Registrar</button>
							</center>
					</fieldset>
			</form>';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>