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
	$usuarios = new Accesatabla('usuarios');
	$pacientes = new Accesatabla('pacientes');
	$pregunta = new Accesatabla('preguntas_seguridad');
	$preferencias = new Accesatabla('preferencias_recuperacion_acceso');
	$autenticacion = new Accesatabla('datos_autenticacion_usuario');
	$comillas = "'";
	$ds = new Diseno();
	$busqueda = $_POST['busqueda'];
	if(empty($busqueda)){
		$busqueda = $_GET['id'];
	}
	
	$script = '
		<script language="javascript" type="text/javascript">
			$(document).ready(function(){
				$('.$comillas.'input[type="submit"]'.$comillas.').attr('.$comillas.'disabled'.$comillas.','.$comillas.'disabled'.$comillas.');	
			});
			function valida(dato) {
				$('.$comillas.'input[type="submit"]'.$comillas.').removeAttr('.$comillas.'disabled'.$comillas.');
			}
		</script>
	';


	if(!empty($busqueda)){
		$act_boton = $datos->buscardonde('NO_CEDULA = "'.$busqueda.'" OR ID_PACIENTE = '.$busqueda.'');		
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
		$pacientes->buscardonde('ID_PACIENTE = '.$datos->obtener('ID_PACIENTE').'');
		$usuarios->buscardonde('ID_USUARIO = '.$pacientes->obtener('ID_USUARIO').'');
		$autenticacion->buscardonde('ID_USUARIO = '.$pacientes->obtener('ID_USUARIO').'');
		$preferencias->buscardonde('ID_USUARIO = '.$pacientes->obtener('ID_USUARIO').'');
	}
	if(!$act_boton){
		$boton ='<input type="submit" class="btn btn-primary" value="Registrar"/>';
	}else{
		$cont.=$script;
		$cambio ='&ch=1';
		$boton = '<input type="submit" class="btn btn-primary" value="Guardar Cambios"/>';
	}

	$act = $_GET['act'];
	if(!$act){
		$noactive='active';
		$active='';
	}else{
		$active='active';
		$noactive='';
	}

	$cont.='
		<div class="row-fluid">
			<div class="span12">
				<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Sistema de B&uacute;squeda y Captura de Datos de los Pacientes</h3>		
				<div class="tabbable" id="tabs-2">
					<ul class="nav nav-tabs">
						<li class="'.$noactive.'""><a href="#tab1" data-toggle="tab">Buscar</a></li>
						<li class="'.$active.'""><a href="#tab2" data-toggle="tab">Capturar</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane '.$noactive.'" id="tab1">
							<center>		
								<div class="row-fluid">
									<div class="span12">
										<form method="POST" aut ocomplete="off"  action="./?url=nuevopaciente&sbm=5">
											<input type="text" id="busqueda" name="busqueda" placeholder="Buscar Paciente" class="search-query ac_input" /> 
											<button type="submit" class="btn"><img src="./iconos/search.png"></button>							
										</form>
										<table>	
											<tr>
												<td>Nombre: </td>
												<td><input type="text" name="nombre" value="'.$datos->obtener('PRIMER_NOMBRE').'" disabled></td>
											</tr>
											<tr>
												<td>Apellido: </td>
												<td><input type="text" name="nombre" value="'.$datos->obtener('APELLIDO_PATERNO').'" disabled></td>
											</tr>
											<tr>
												<td>Sexo: </td>
												<td>';						
							if($idsexo == 2){
								$value='selected';
								$novalue='';
							}else{
								$novalue='selected';
								$value='';
							}
							$cont.='
													<input type="radio" name="sexo" value="2" '.$value.' disabled> Femenino
													<input type="radio" name="sexo" value="1"  '.$novalue.' readonly> Masculino							
												</td>
											</tr>
											<tr>
												<td>Tipo de Sangre: </td>
												<td>
													<select name="tiposangre" disabled>
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

									$cont.='
													</select>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</center>
						</div>
						<div class="tab-pane '.$active.'" id="tab2">';
	$cont.='
							<center>													
								<div class="row-fluid">
									<div class="span12">
										<form method="POST" aut ocomplete="off"  action="./?url=nuevopaciente&act=1&sbm=5">
											<input type="text" id="busqueda" name="busqueda" placeholder="Buscar Paciente" class="search-query ac_input" /> 
											<button type="submit" class="btn"><img src="./iconos/search.png"></button>							
										</form>
									</div>
								</div>
							</center>
							<form action="./?url=agregardatospaciente&id='.$datos->obtener('ID_PACIENTE').$cambio.'" method="post" style="display:block;position:relative">
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
															<td><input type="text" id="cedula" name="cedula" value="'.$datos->obtener('NO_CEDULA').'" placeholder="C&eacute;dula" onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Nacionalidad:</td>
														</tr>
														<tr>
															<td><select id="nacionalidad" name="nacionalidad" onKeyPress="valida(this.value)" required="required">
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
															<td><select id="tipopaciente" name="tipopaciente"  onKeyPress="valida(this.value)" required="required">
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
															<td><input type="text" id="numeroseguro" name="numeroseguro" value="'.$datos->obtener('SEGURO_SOCIAL').'" placeholder="N&ordm; Seguro"  onKeyPress="valida(this.value)" required="required"></td>
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
															<td><input type="text" id="primernombre" name="primernombre" value="'.$datos->obtener('PRIMER_NOMBRE').'" placeholder="Primer Nombre" onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Segundo Nombre:</td>
														</tr>
														<tr>
															<td><input type="text" id="segundonombre" name="segundonombre" value="'.$datos->obtener('SEGUNDO_NOMBRE').'" placeholder="Segundo Nombre" onKeyPress="valida(this.value)"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Primer Apellido:</td>
														</tr>
														<tr>
															<td><input type="text" id="primerapellido" name="primerapellido" value="'.$datos->obtener('APELLIDO_PATERNO').'" placeholder="Primer Apellido" onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Segundo Apellido:</td>
														</tr>
														<tr>
															<td><input type="text" id="segundoapellido" name="segundoapellido" value="'.$datos->obtener('APELLIDO_MATERNO').'" placeholder="Segundo Apellido" onKeyPress="valida(this.value)"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Fecha de Nacimiento:</td>	
														</tr>
														<tr>
															<td><input type="date" id="fechanacimiento" name="fechanacimiento" value="'.$datos->obtener('FECHA_NACIMIENTO').'" onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Lugar de Nacimiento:</td>	
														</tr>
														<tr>
															<td><input type="text" id="lugarnacimiento" name="lugarnacimiento" value="'.$datos->obtener('LUGAR_NACIMIENTO').'" placeholder="Lugar de Nac." onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Sexo:</td>	
														</tr>
														<tr>
															<td>
																<select id="sexo" name="sexo" onKeyPress="valida(this.value)" required="required">
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
																<select id="tiposangre" name="tiposangre" style="width:100px" onKeyPress="valida(this.value)" required="required">
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
														<td><select id="etnia" name="etnia" onKeyPress="valida(this.value)" required="required">
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
															<td><input type="text" id="ocupacion" name="ocupacion" value="'.$datos->obtener('OCUPACION').'" placeholder="Ocupaci&oacute;n" onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Estado Civil:</td>	
														</tr>
														<tr>
															<td align="center">
																<select id="estadocivil" name="estadocivil" onKeyPress="valida(this.value)" required="required">
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
															<td><input type="text" id="nombrepadre" name="nombrepadre" value="'.$datos->obtener('NOMBRE_PADRE').'" placeholder="Nombre Padre" onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Nombre Madre:</td>	
														</tr>
														<tr>
															<td><input type="text" id="nombremadre"  name="nombremadre" value="'.$datos->obtener('NOMBRE_MADRE').'" placeholder="Nombre Madre" onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Usuario:</td>	
														</tr>
														<tr>
															<td><input type="text" id="usuario"  name="usuario" value="'.$usuarios->obtener('NO_IDENTIFICACION').'" placeholder="Usuario" onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td style="text-align:left;padding-left:17%;">Contrase&ntilde;a:</td>	
														</tr>
														<tr>
															<td><input type="password" id="pass"  name="pass" value="'.$usuarios->obtener('CLAVE_ACCESO').'" placeholder="Contrase&ntilde;a" onKeyPress="valida(this.value)" required="required"></td>
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
															<td><input type="text" id="correo" name="correo" value="'.$datos->obtener('E_MAIL').'" placeholder="Correo Electr&oacute;nico" onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td  style="text-align:left;padding-left:17%;">Tel&eacute;fono:</td>
														</tr>
														<tr>
															<td><input type="text" id="telefono" name="telefono" value="'.$datos->obtener('TELEFONO_CASA').'" placeholder="Tel&eacute;fono" onKeyPress="valida(this.value)" required="required"></td>
														</tr>
														<tr>
															<td  style="text-align:left;padding-left:17%;">Celular:</td>
														</tr>
														<tr>
															<td><input type="text" id="celular" name="celular" value="'.$datos->obtener('TELEFONO_CELULAR').'" placeholder="Celular" onKeyPress="valida(this.value)" required="required"></td>
														</tr>	
														<tr>
															<td style="text-align:left;padding-left:17%;">Provincia:</td>
														</tr>
														<tr>
															<td>
																<select id="provincias" name="provincias" onKeyPress="valida(this.value)" required="required"> 
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
																<select style="width:140px" id="distritos" name="distritos" onKeyPress="valida(this.value)" required="required">
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
																<select style="width:140px" id="corregimientos" name="corregimientos" onKeyPress="valida(this.value)" required="required">
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
														<td><select id="zona" name="zona" onKeyPress="valida(this.value)" required="required">
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
														<td><textarea  class="textarea" id="direcciondetallada" name="direcciondetallada"  placeholder="Direcci&oacute;n Detallada" onKeyPress="valida(this.value)" required="required">'.$residencia->obtener('DETALLE').'</textarea></td>
													</tr>
													<tr>
														<td style="text-align:left;padding-left:17%;">Residencia Transitoria:</td>
													</tr>
													<tr>
														<td><textarea  class="textarea" id="residenciatransitoria" name="residenciatransitoria" placeholder="Residencia Transitoria" onKeyPress="valida(this.value)" required="required">'.$datos->obtener('RESIDENCIA_TRANSITORIA').'</textarea></td>
													</tr>
												</tbody>
											</table>
										</fieldset>
									</div>					
								</div>	
								
								<center>
									<div class="margen-bt-datos"> 
										'.$boton.'
									</div>
								</center>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>
