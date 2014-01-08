<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$datos = new Accesatabla('datos_pacientes');
	$residencia = new Accesatabla('residencia_habitual');
	$responsable = new Accesatabla('responsable_paciente');
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
	
	$cont.='<center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Sistema de Captura de Datos de Atenci&oacute;n Hospitalaria</h3>
			</center>
	';
	if (empty($busqueda)){
		$cont.='
					<center>					
						<div class="row-fluid">
							<div class="span12">
								<form method="POST" action="./?url=hospitalaria_rae_capturardatos">
									<input type="text" id="busqueda" name="busqueda" placeholder="Buscar Paciente" class="search-query" /> <button type="submit" class="btn"><img src="./iconos/search.png"></button>
								</form>
							</div>
						</div>
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
		$responsable->buscardonde('ID_PACIENTE = '.$datos->obtener('ID_PACIENTE').'');
	}
    $cont.='

			<form action="./?url=agregardatospaciente&sw=1" method="post" style="display:block;">
				<div class="row-fluid">
					<div class="span6">
						<fieldset>
							<legend>
								Datos de Identificaci&oacute;n
							</legend>
								<table class="table">
									<tbody>
										<tr>
											<td style="text-align:left;padding-left:17%;">C&eacute;dula:</td>														
										</tr>
										<tr>
											<td><input type="text" id="cedula" name="cedula" value="'.$busqueda.'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Nacionalidad:</td>
										</tr>
										<tr>
											<td><select id="nacionalidad" name="nacionalidad">
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
		$cont.='								</select>
											</td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Tipo De Paciente</td>
										</tr>
										<tr>
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
		$cont.='								</select>	
											</td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">N&ordm; de Seguro:</td>	
										</tr>
										<tr>
											<td><input type="text" id="numeroseguro" name="numeroseguro" value="'.$datos->obtener('SEGURO_SOCIAL').'"></td>
										</tr>
									</tbody>
								</table>
						</fieldset>
					</div>
					<div class="span6">
						<fieldset>
							<legend>
								Datos Personales Del Paciente
							</legend>
								<table class="table">
									<tbody>
										<tr>
											<td style="text-align:left;padding-left:17%;">Primer Nombre:</td>														
										</tr>
										<tr>
											<td><input type="text" id="primernombre" name="primernombre" value="'.$datos->obtener('PRIMER_NOMBRE').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Segundo Nombre:</td>
										</tr>
										<tr>
											<td><input type="text" id="segundonombre" name="segundonombre" value="'.$datos->obtener('SEGUNDO_NOMBRE').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Primer Apellido:</td>
										</tr>
										<tr>
											<td><input type="text" id="primerapellido" name="primerapellido" value="'.$datos->obtener('APELLIDO_PATERNO').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Segundo Apellido:</td>
										</tr>
										<tr>
											<td><input type="text" id="segundoapellido" name="segundoapellido" value="'.$datos->obtener('APELLIDO_MATERNO').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Fecha de Nacimiento:</td>	
										</tr>
										<tr>
											<td><input type="date" id="fechanacimiento" name="fechanacimiento" value="'.$datos->obtener('FECHA_NACIMIENTO').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Lugar de Nacimiento:</td>	
										</tr>
										<tr>
											<td><input type="text" id="lugarnacimiento" name="lugarnacimiento" value="'.$datos->obtener('LUGAR_NACIMIENTO').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Sexo:</td>	
										</tr>
										<tr>
											<td>
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
													<option value="'.$sexo->obtener('ID_SEXO').'" '.$value.'>'.$sexo->obtener('SEXO').'</option>';
			$s = $sexo->releer();
		}
	$cont.='									</select>
											</td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Tipo de Sangre:</td>	
										</tr>
										<tr>
											<td>
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
		$cont.='								</select>
											</td>
										</tr>
										<tr>
										<td style="text-align:left;padding-left:17%;">Etnia:</td>
									</tr>
									<tr>
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
															
							$cont.='		</select>
										</td>
									</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Ocupaci&oacute;n:</td>	
										</tr>
										<tr>
											<td><input type="text" id="ocupacion" name="ocupacion" value="'.$datos->obtener('OCUPACION').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Estado Civil:</td>	
										</tr>
										<tr>
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
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Nombre Padre:</td>	
										</tr>
										<tr>
											<td><input type="text" id="nombrepadre" name="nombrepadre" value="'.$datos->obtener('NOMBRE_PADRE').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Nombre Madre:</td>	
										</tr>
										<tr>
											<td><input type="text" id="nombremadre"  name="nombremadre" value="'.$datos->obtener('NOMBRE_MADRE').'"></td>
										</tr>
									</tbody>
								</table>
						</fieldset>				
					</div>
				</div>	
				<div class="row-fluid">
					<div class="span6">
						<fieldset>
							<legend>
								Datos de Contacto/Direcci�n
							</legend>
							<table class="table">
								<tbody>
									<tr>
										<td style="text-align:left;padding-left:17%;">Correo Electr&oacute;nico:</td>
									</tr>
									<tr>
										<td><input type="text" id="correo" name="correo" value="'.$datos->obtener('E_MAIL').'"></td>
									</tr>
									<tr>
										<td  style="text-align:left;padding-left:17%;">Tel&eacute;fono:</td>
									</tr>
									<tr>
										<td><input type="text" id="telefono" name="telefono" value="'.$datos->obtener('TELEFONO_CASA').'"></td>
									</tr>
									<tr>
										<td  style="text-align:left;padding-left:17%;">Celular:</td>
									</tr>
									<tr>
										<td><input type="text" id="celular" name="celular" value="'.$datos->obtener('TELEFONO_CELULAR').'"></td>
									</tr>	
									<tr>
										<td style="text-align:left;padding-left:17%;">Provincia:</td>
									</tr>
									<tr>
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
												<option value="'.$provincias->obtener('ID_PROVINCIA').'" '.$value.'>'.$provincias->obtener('PROVINCIA').'</option>';
		$p = $provincias->releer();
}
$cont.='								   </select>
										</td>
									</tr>
									<tr>
										<td style="text-align:left;padding-left:17%;">Distrito:</td>
									</tr>
									<tr>
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
									</tr>
									<tr>
										<td style="text-align:left;padding-left:17%;">Corregimiento:</td>
									</tr>
									<tr>
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
$cont.='									</select>
										</td>
									</tr>
									<tr>
										<td style="text-align:left;padding-left:17%;">Zona:</td>
									</tr>
									<tr>
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

$cont.='									</select>
										</td>
									</tr>
									<tr>
										<td style="text-align:left;padding-left:17%;">Direcci&oacute;n Detallada:</td>
									</tr>
									<tr>
										<td><textarea  class="textarea" id="direcciondetallada" name="direcciondetallada" >'.$residencia->obtener('DETALLE').'</textarea></td>
									</tr>
									<tr>
										<td style="text-align:left;padding-left:17%;">Residencia Transitoria:</td>
									</tr>
									<tr>
										<td><textarea  class="textarea" id="residenciatransitoria" name="residenciatransitoria">'.$datos->obtener('RESIDENCIA_TRANSITORIA').'</textarea></td>
									</tr>
								</tbody>
							</table>
						</fieldset>	
					</div>					
					<div class="span6">
						<fieldset>
							<legend>
								Responsable del Paciente
							</legend>
							<table class="table">
								<tbody>
									<tr>
										<td style="text-align:left;padding-left:17%;">Nombre:</td>
									</tr>
									<tr>
										<td><input type="text" id="nombreresponsable" name="nombreresponsable" value="'.$responsable->obtener('NOMBRE_CONTACTO').'" required></td>
									</tr>
									<tr>
										<td style="text-align:left;padding-left:17%;">Apellido:</td>
									</tr>
									<tr>
										<td><input type="text" id="apellidoresponsable" name="apellidoresponsable" value="'.$responsable->obtener('APELLIDO_CONTACTO').'" required></td>
									</tr>
									<tr>
										<td style="text-align:left;padding-left:17%;">Parentesco:</td>
									</tr>
									<tr>
										<td><input type="text" id="parentesco" name="parentesco" value="'.$responsable->obtener('PARENTESCO_CONTACTO').'" required></td>
									</tr>
									<tr>
										<td style="text-align:left;padding-left:17%;">Direccion:</td>
									</tr>
									<tr>
										<td><textarea class="textarea" id="direccionresponsable" name="direccionresponsable">'.$responsable->obtener('DIRECCION_CONTACTO').'</textarea></td>
									</tr>
									<tr>
										<td style="text-align:left;padding-left:17%;">Tel&eacute;fono:</td>
									</tr>
									<tr>
										<td><input type="text" id="telefonoresponsable" name="telefonoresponsable" value="'.$responsable->obtener('TELEFONO_CONTACTO').'" required></td>
									</tr>
								</tbody>
							</table>
					</div>		
				</div>	
				<center style="margin-top:8px;">			
					<button type="submit" class="btn btn-primary">Registrar</button>
				</center>
			</form>';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>