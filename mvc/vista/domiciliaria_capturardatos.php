<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$datos = new Accesatabla('datos_pacientes');
	$residencia = new Accesatabla('residencia_habitual');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$etnia = new Accesatabla('etnia');
	$zona = new Accesatabla('zona');
	$tipopaciente = new Accesatabla('tipo_paciente');
	$estadocivil = new Accesatabla('estados_civiles');
	$nacionalidades = new Accesatabla('nacionalidades');
	$sexo = new Accesatabla('sexo');
	$ds = new Diseno();
	$busqueda = $_POST['busqueda'];
	$cont.='	<fieldset>
							<legend align="center">
								<h3 style="background:#f4f4f4;padding:10px;">Sistema de Captura de Datos de Atención Domiciliaria</h3>
							</legend>';
	if (empty($busqueda)){
		$cont.='
	
				<center>
					<form method="POST" action="./?url=domiciliaria_capturardatos">
						<table>
							<tr>
								<td>Buscar Paciente:</td>
								<td><input type="text" id="busqueda" name="busqueda"></td>
							</tr>
							
						</table>
						<button type="submit" class="btn btn-primary">Buscar</button>
					</form>
				</center>
		 ';	
	}else{
		$datos->buscardonde('NO_CEDULA = "'.$busqueda.'"');
		$idnacionalidad = $datos->obtener('ID_NACIONALIDAD');
		$idtiposangre = $datos->obtener('ID_TIPO_SANGUINEO');
		$idestadocivil = $datos->obtener('ID_ESTADO_CIVIL');
		$idsexo = $datos->obtener('ID_SEXO');
		$idtipopaciente = $datos->obtener('ID_TIPO_PACIENTE');
		$idetnia = $datos->obtener('ID_ETNIA');
		$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$datos->obtener('ID_RESIDENCIA_HABITUAL').'');
		$idzona = $residencia->obtener('ID_ZONA');
		$idprovincia = $residencia->obtener('ID_PROVINCIA');
		$iddistrito = $residencia->obtener('ID_DISTRITO');
		$idcorregimiento = $residencia->obtener('ID_CORREGIMIENTO');
	}
    $cont.='

			<form action="./?url=agregardatospaciente" method="post" style="display:block;">

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
														<td><input type="text" id="cedula" name="cedula" value="'.$busqueda.'"><br></td>

														<td align="right">Nacionalidad:</td>
														<td><select id="nacionalidad" name="nacionalidad" style="width:160px">
																<option value="0"></option>';
																			
		$n = $nacionalidades->buscardonde('ID_NACIONALIDAD > 0');
		while($n){
				if($nacionalidades->obtener('ID_NACIONALIDAD') == $idnacionalidad){
					$value='selected';
				}else{
					$value='';
				}
				$cont.='
																<option value="'.$nacionalidades->obtener('ID_NACIONALIDAD').'" '.$value.'>'.$ds->latino($nacionalidades->obtener('NACIONALIDAD')).'</option>
				';
				$n = $nacionalidades->releer();
		}
	$cont.='												</select>
														</td>
													</tr>
													<tr>
														<td align="right">Primer Nombre: </td>
														<td><input type="text" id="primernombre" name="primernombre" value="'.$datos->obtener('PRIMER_NOMBRE').'"><br></td>
														<td align="right">Segundo Nombre: </td>
														<td><input type="text" id="segundonombre" name="segundonombre" value="'.$datos->obtener('SEGUNDO_NOMBRE').'"><br></td>
													</tr>														
													<tr>
														<td align="right">Primer Apellido: </td>
														<td><input type="text" id="primerapellido" name="primerapellido" value="'.$datos->obtener('APELLIDO_PATERNO').'"><br></td>
														<td align="right">Segundo Apellido: </td>
														<td><input type="text" id="segundoapellido" name="segundoapellido" value="'.$datos->obtener('APELLIDO_MATERNO').'"><br></td>
													</tr>																												
													<tr>
														<td>Fecha de Nacimiento: </td>
														
														<td><input type="date" id="fechanacimiento" name="fechanacimiento" value="'.$datos->obtener('FECHA_NACIMIENTO').'"><br></td>
													</tr>
													<tr>
														<td align="right" >Tipo de Sangre: </td>
														<td align="center">
															<select id="tiposangre" name="tiposangre" style="width:100px">
																<option value="0"></option>';
																				
		$x = $tiposangre->buscardonde("ID_TIPO_SANGUINEO > 0");
		while($x){
				if($tiposangre->obtener('ID_TIPO_SANGUINEO') == $idtiposangre){
					$value='selected';
				}else{
					$value='';
				}
				$cont.='
																<option value="'.$tiposangre->obtener('ID_TIPO_SANGUINEO').'" '.$value.'>'.$tiposangre->obtener('TIPO_SANGRE').'</option>
				';
				$x = $tiposangre->releer();
		}													
		$cont.='											</select>
														</td>
															<td>Lugar de Nacimiento: </td>
															<td><input type="text" id="lugarnacimiento" name="lugarnacimiento" value="'.$datos->obtener('LUGAR_NACIMIENTO').'"></td>
														</tr>
														<tr>
															<td align="right">Estado Civil: </td>
															<td align="center">
																<select id="estadocivil" name="estadocivil" style="width:100px">
																	<option value="0"></option>';
		$ec = $estadocivil->buscardonde('ID_ESTADO_CIVIL > 0');
		while ($ec){
				if($estadocivil->obtener('ID_ESTADO_CIVIL') == $idestadocivil){
					$value='selected';
				}else{
					$value='';
				}
				$cont.='
																	<option value="'.$estadocivil->obtener('ID_ESTADO_CIVIL').'" '.$value.'>'.$estadocivil->obtener('ESTADO_CIVIL').'</option>
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
			if($sexo->obtener('ID_SEXO') == $idsexo){
				$value='selected';
			}else{
				$value='';
			}
			$cont .= '
																	<option value="'.$sexo->obtener('ID_SEXO').'" '.$value.'>'.$sexo->obtener('SEXO').'</option>
			';
			$s = $sexo->releer();
		}
	$cont.='													</select>
															</td>
														</tr>
														<tr>
															<td align="right">Nombre Padre:</td>
															<td><input type="text" id="nombrepadre" name="nombrepadre" value="'.$datos->obtener('NOMBRE_PADRE').'"></td>															
															<td align="right">Nombre Madre:</td>
															<td><input type="text" id="nombremadre"  name="nombremadre" value="'.$datos->obtener('NOMBRE_MADRE').'"></td>

														</tr>	
														<tr>															
															<td align="right">Tipo de Paciente:</td>
															<td><select id="tipopaciente" name="tipopaciente">
																	<option value="0"></option>';
		$t = $tipopaciente->buscardonde('ID_TIPO_PACIENTE');
		while ($t){
			if($tipopaciente->obtener('ID_TIPO_PACIENTE') == $idtipopaciente){
				$value='selected';
			}else{
				$value='';
			}
			$cont.='
																	<option value="'.$tipopaciente->obtener('ID_TIPO_PACIENTE').'" '.$value.'>'.$tipopaciente->obtener('TIPO_PACIENTE').'</option>
			';
			$t = $tipopaciente->releer();
		}
		$cont.='																	
																</select>	
															</td>
															<td align="right">N° de Seguro:</td>
															<td><input type="text" id="numeroseguro" name="numeroseguro" value="'.$datos->obtener('SEGURO_SOCIAL').'"></td>
														</tr>
														<tr>
															<td align="right">Ocupacion: </td>
															<td><input type="text" id="ocupacion" name="ocupacion" value="'.$datos->obtener('OCUPACION').'"></td>
															<td align="right">Etnia: </td>
															<td><select id="etnia" name="etnia">
																	<option value="0"></option>';
																	
		$e = $etnia->buscardonde("ID_ETNIA > 0");
		while ($e){
				if($etnia->obtener('ID_ETNIA') == $idetnia){
					$value='selected';
				}else{
					$value='';
				}
				$cont.='
																	<option value="'.$etnia->obtener('ID_ETNIA').'" '.$value.'>'.$etnia->obtener('ETNIA').'</option>
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
														<td><input type="text" id="correo" name="correo" value="'.$datos->obtener('E_MAIL').'"></td>
														<td></td>
														<td align="right">Telefono:</td>
														<td><input type="text" id="telefono" name="telefono" value="'.$datos->obtener('TELEFONO_CASA').'"></td>
													</tr>
													<tr>
														<td align="right">Provincia: </td>
														<td>
															<select id="provincias" name="provincias">
																<option value="0"></option>';															
												
$p = $provincias->buscardonde("ID_PROVINCIA > 0");
while($p){
		if($provincias->obtener('ID_PROVINCIA') == $idprovincia){
			$value='selected';
		}else{
			$value='';
		}
		$cont.='
																<option value="'.$provincias->obtener('ID_PROVINCIA').'" '.$value.'>'.$provincias->obtener('PROVINCIA').'</option>
		';
		$p = $provincias->releer();

}
$cont.='													   </select>
														</td>
														<td></td>
														<td align="right">Celular:</td>
														<td><input type="text" id="celular" name="celular" value="'.$datos->obtener('TELEFONO_CELULAR').'"></td>
													</tr>
													<tr>
														<td align="right">Distritos:</td>
														<td id="mostrardistritos" name="mostrardistritos">
															<select style="width:140px" id="distritos" name="distritos">
																	<option value=""></option>';
$d = $distritos->buscardonde('ID_DISTRITO > 0 AND ID_PROVINCIA = '.$idprovincia.'');
while($d){
	if($distritos->obtener('ID_DISTRITO') == $iddistrito){
		$value='selected';
	}else{
		$value='';
	}
	$cont.='
																	<option value="'.$distritos->obtener('ID_DISTRITO').'" '.$value.'>'.$distritos->obtener('DISTRITO').'</option>
	';
	$d = $distritos->releer();
}
$cont.='
															</select>
														</td>
														<td></td>																
														<td align="right">Zona: </td>
														<td><select id="zona" name="zona">
																<option value="0"></option>';
$z = $zona->buscardonde('ID_ZONA > 0');
while($z){
	if($zona->obtener('ID_ZONA') == $idzona){
		$value='selected';
	}else{
		$value='';
	}
	$cont.='
																<option value="'.$zona->obtener('ID_ZONA').'" '.$value.'>'.$zona->obtener('ZONA').'</option>
	';
	$z = $zona->releer();
}

$cont.='														</select>
														</td>
													</tr>
													<tr>
														<td align="right">Corregimientos:</td>
														<td id="mostrarcorregimientos" name="mostrarcorregimientos">
															<select style="width:140px" name="corregimientos">
																<option value=""></option>';
															
$d = $corregimientos->buscardonde('ID_CORREGIMIENTO > 0 AND ID_DISTRITO = '.$iddistrito.'');
while($d){
	if($corregimientos->obtener('ID_CORREGIMIENTO') == $idcorregimiento){
		$value='selected';
	}else{
		$value='';
	}
	$cont.='
																<option value="'.$corregimientos->obtener('ID_CORREGIMIENTO').'" '.$value.'>'.$corregimientos->obtener('CORREGIMIENTO').'</option>
	';
	$d = $corregimientos->releer();
}
$cont.='													</select>
														</td>
														<td></td>
														<td>Dirección Detallada:</td>																
														<td align="right"><textarea  class="textarea" id="direcciondetallada" name="direcciondetallada" >'.$residencia->obtener('DETALLE').'</textarea></td>
													</tr>
													<tr>
														<td align="right">Residencia Transitoria: </td>
														<td><textarea  class="textarea" id="residenciatransitoria" name="residenciatransitoria">'.$datos->obtener('RESIDENCIA_TRANSITORIA').'</textarea></td>
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

			</form>
			</fieldset>';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>