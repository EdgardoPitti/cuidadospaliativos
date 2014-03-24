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
	
	$cont='
		<center>
			<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Sistema de Captura de Datos de Atenci&oacute;n Domiciliaria</h3>						
			<div class="row-fluid">
				<div class="span12">
					<form method="POST" aut ocomplete="off"  action="./?url=domiciliaria_capturardatos&sbm=1">
						<input type="text" id="busqueda" name="busqueda" placeholder="Buscar Paciente" class="search-query ac_input" /> <button type="submit" class="btn"><img src="./iconos/search.png"></button>							
					</form>
				</div>
			</div>
		</center>
		
		 ';	
	if(!empty($busqueda)){
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

			<form action="./?url=agregardatospaciente&sbm=1" method="post" style="display:block;position:relative">
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
											<td><input type="text" id="cedula" name="cedula" value="'.$busqueda.'" placeholder="C&eacute;dula"></td>
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
											<td><input type="text" id="numeroseguro" name="numeroseguro" value="'.$datos->obtener('SEGURO_SOCIAL').'" placeholder="N&ordm; Seguro"></td>
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
											<td><input type="text" id="primernombre" name="primernombre" value="'.$datos->obtener('PRIMER_NOMBRE').'" placeholder="Primer Nombre"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Segundo Nombre:</td>
										</tr>
										<tr>
											<td><input type="text" id="segundonombre" name="segundonombre" value="'.$datos->obtener('SEGUNDO_NOMBRE').'" placeholder="Segundo Nombre"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Primer Apellido:</td>
										</tr>
										<tr>
											<td><input type="text" id="primerapellido" name="primerapellido" value="'.$datos->obtener('APELLIDO_PATERNO').'" placeholder="Primer Apellido"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Segundo Apellido:</td>
										</tr>
										<tr>
											<td><input type="text" id="segundoapellido" name="segundoapellido" value="'.$datos->obtener('APELLIDO_MATERNO').'" placeholder="Segundo Apellido"></td>
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
											<td><input type="text" id="lugarnacimiento" name="lugarnacimiento" value="'.$datos->obtener('LUGAR_NACIMIENTO').'" placeholder="Lugar de Nac."></td>
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
											<td><input type="text" id="ocupacion" name="ocupacion" value="'.$datos->obtener('OCUPACION').'" placeholder="Ocupaci&oacute;n"></td>
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
											<td><input type="text" id="nombrepadre" name="nombrepadre" value="'.$datos->obtener('NOMBRE_PADRE').'" placeholder="Nombre Padre"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Nombre Madre:</td>	
										</tr>
										<tr>
											<td><input type="text" id="nombremadre"  name="nombremadre" value="'.$datos->obtener('NOMBRE_MADRE').'" placeholder="Nombre Madre"></td>
										</tr>
									</tbody>
								</table>
								
						</fieldset>		
					</div>
				</div>	
				<div class="row-fluid">
					<div class="span6 posicion-datos">
						<fieldset>
							<legend>
								Datos de Contacto/Direcci&oacute;n
							</legend>									
								<table class="table">
									<tbody>
										<tr>
											<td style="text-align:left;padding-left:17%;">Correo Electr&oacute;nico:</td>
										</tr>
										<tr>
											<td><input type="text" id="correo" name="correo" value="'.$datos->obtener('E_MAIL').'" placeholder="Correo Electr&oacute;nico"></td>
										</tr>
										<tr>
											<td  style="text-align:left;padding-left:17%;">Tel&eacute;fono:</td>
										</tr>
										<tr>
											<td><input type="text" id="telefono" name="telefono" value="'.$datos->obtener('TELEFONO_CASA').'" placeholder="Tel&eacute;fono"></td>
										</tr>
										<tr>
											<td  style="text-align:left;padding-left:17%;">Celular:</td>
										</tr>
										<tr>
											<td><input type="text" id="celular" name="celular" value="'.$datos->obtener('TELEFONO_CELULAR').'" placeholder="Celular"></td>
										</tr>	
										<tr>
											<td style="text-align:left;padding-left:17%;">Provincia:</td>
										</tr>
										<tr>
											<td>
												<select id="provincias" name="provincias"> 
													<option value=""></option>';
								$cont.= 
						$x = $provincias->buscardonde('ID_PROVINCIA > 0');
						while($x){
							if($provincias->obtener('ID_PROVINCIA') == $idprovincia){
								$value='selected';
							}else{
								$value='';
							}
							$cont.='
													<option value="'.$provincias->obtener('ID_PROVINCIA').'" '.$value.'>'.$provincias->obtener('PROVINCIA').'</option>"';
							$x = $provincias->releer();
						}
								$cont.='
												</select>
											</td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Distrito:</td>
										</tr>
										<tr>
											<td>
												<select style="width:140px" id="distritos" name="distritos">
													<option value="0"></option>';
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
$cont.='												</select>
											</td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Corregimiento:</td>
										</tr>
										<tr>
											<td>
												<select style="width:140px" id="corregimientos" name="corregimientos">
													<option value="0"></option>';
																
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
	$cont.='
												</select>
											</td>
										</tr>
										
									</tbody>
								</table>	
									
							<table class="table">
								<tbody>
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
										<td><textarea  class="textarea" id="direcciondetallada" name="direcciondetallada"  placeholder="Direcci&oacute;n Detallada">'.$residencia->obtener('DETALLE').'</textarea></td>
									</tr>
									<tr>
										<td style="text-align:left;padding-left:17%;">Residencia Transitoria:</td>
									</tr>
									<tr>
										<td><textarea  class="textarea" id="residenciatransitoria" name="residenciatransitoria" placeholder="Residencia Transitoria">'.$datos->obtener('RESIDENCIA_TRANSITORIA').'</textarea></td>
									</tr>
								</tbody>
							</table>
						</fieldset>
					</div>					
				</div>	
				
				<center>
					<div class="margen-bt-datos"> 
						<button type="submit" class="btn btn-primary">Registrar</button>
					</div>
				</center>
			</form>
		
		';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>

