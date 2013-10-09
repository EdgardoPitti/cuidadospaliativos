<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$paciente = new Accesatabla('datos_pacientes');
	$condicionsalida = new Accesatabla('condicion_salida');
	$instituciones = new Accesatabla('institucion');
	$tipoinstitucion = new Accesatabla('tipo_institucion');
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$provincias = new Accesatabla('provincias');
	$referido = new Accesatabla('referido');
	$responsable = new Accesatabla('responsable_paciente');
	$ds = new Diseno();
	$buscar = $_POST['buscar'];
	$idpaciente = $_GET['id'];
	$sw = 0;
	$cont.='
	  <center>
	  <fieldset>
		<legend><h3 style="background:#f4f4f4;padding:10px;">Registro de Admisión-Egreso (RAE) </h3></legend>';
	if(!empty($buscar)){
		if(!$paciente->buscardonde('NO_CEDULA = "'.$buscar.'"')){
			$sw = 1;
		}
	}
	if((empty($buscar) or $sw == 1) and empty($idpaciente)){
		$cont.='
			<center>
				<form class="form-search" method="POST" action="./?url=hospitalaria_rae_evolucion">
					<div class="input-group">
					  Buscar paciente: <input type="search" class="form-control" id="cedula" placeholder="Cédula" name="buscar" id="buscar">
					  <span class="input-group-btn">
						<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
					  </span>
					</div>
				</form>
			</center>';
		if($sw == 1){
			$cont.='<center>
						<a href="./?url=hospitalaria_rae_capturardatos">Paciente no Encotrado...Añadir</a>
					</center>
			';
		}
		
	}else{
		
		if(!empty($idpaciente)){
			$personas->buscardonde('ID_PACIENTE = '.$idpaciente.'');
		}else{
			$personas->buscardonde('NO_CEDULA = "'.$buscar.'"');
		}
		if(!$responsable->buscardonde('ID_PACIENTE = '.$personas->obtener('ID_PACIENTE').'')){
		$cont.='	
			<form method="POST" action="./?url=agregardatospaciente&id='.$personas->obtener('ID_PACIENTE').'">
					<fieldset>
						<center>
						<legend>
							Responsable del Paciente
						</legend>
						<table>
							<tr>
								<td align="right">Nombre: </td>
								<td><input type="text" id="nombreresponsable" name="nombreresponsable"></td>
								<td>&nbsp;</td>
								<td align="right">Apellido: </td>
								<td><input type="text" id="apellidoresponsable" name="apellidoresponsable"></td>
							</tr>
							<tr>
								<td>Parentesco:</td>
								<td><input type="text" id="parentesco" name="parentesco"></td>
								<td></td>
								<td>Direccion:</td>
								<td><textarea class="textarea" id="direccionresponsable" name="direccionresponsable"></textarea></td>
							</tr>
							<tr>
								<td>Telefono:</td>
								<td><input type="text" id="telefonoresponsable" name="telefonoresponsable"></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
						</center>
					</fieldset>		
					<button type="submit" class="btn btn-primary">Registrar</button>
			</form>								
			';
		}else{
			$cont.='
				<form method="POST" action="./?url=agregar_datos_rae&idpac='.$personas->obtener('ID_PACIENTE').'">';
									
			$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$personas->obtener('ID_RESIDENCIA_HABITUAL').'');
			$tiposangre->buscardonde('ID_TIPO_SANGUINEO = '.$personas->obtener('ID_TIPO_SANGUINEO').'');
			$provincias->buscardonde('ID_PROVINCIA = '.$residencia->obtener('ID_PROVINCIA').'');
			$distritos->buscardonde('ID_DISTRITO = '.$residencia->obtener('ID_DISTRITO').'');
			$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$residencia->obtener('ID_CORREGIMIENTO').'');
			if ($personas->obtener('ID_SEXO') == 1){
				$sexo = 'MASCULINO';
			}else{
				$sexo = 'FEMENINO';
			}
			if($personas->obtener('ID_TIPO_PACIENTE')){
				$asegurado = 'ASEGURADO';
			}else{
				$asegurado = 'NO ASEGURADO';
			}
			list($anio, $mes, $dia) = explode("-", $personas->obtener('FECHA_NACIMIENTO'));
			$fecha = $ds->dime('dia').' de '.$ds->dime('mes-'.$ds->dime('mes').'').' de '.$ds->dime('año');
			$cont.='<center>
					<div style="float:right;"><i>'.$fecha.', '.$ds->dime('hora').':'.$ds->dime('minuto').'</i></div>
					<table width="100%">
						<tr>
							<td width="50%">
								<fieldset>
									<legend>
										Paciente
									</legend>		
										<table width="100%">	
											<tr>
												<td colspan="3"><h5>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</h5></td>
											</tr>
											<tr align="left">
												<td>'.$buscar.'</td>
												<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
												<td>'.$sexo.'</td>
											</tr>
											<tr align="left">
												<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
												<td>'.$asegurado.'</td>
												<td>'.$ds->edad($dia,$mes,$anio).'</td>
											</tr>
										</table>
								</fieldset>
							</td>
							<td>
								<fieldset>
									<legend>
										Dirección
									</legend>
										<table width="100%">
											<tr>
												<td>'.$distritos->obtener('DISTRITO').' , '.$provincias->obtener('PROVINCIA').'</td>
											</tr>
											<tr>
												<td>'.$corregimientos->obtener('CORREGIMIENTO').' , '.$residencia->obtener('DETALLE').'</td>
											</tr>
										</table>
								</fieldset>
							</td>
						</tr>
					</table>
					</center>
					
						<table width="100%">
							<tr>
								<td class="fondo_azul">
									Datos de Referencia
								</td>
							</tr>
							<tr>
								<td>
									<center>
										<table style="font-size:14px;" width="100%">
											<tr>
												<td>Institución:</td>
												<td><select id="institucion" name="institucion">
														<option value="0"></option>';
															
					$i = $instituciones->buscardonde('ID_INSTITUCION > 0');
					while($i){
						$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$instituciones->obtener('ID_CORREGIMIENTO').'');
						$tipoinstitucion->buscardonde('ID_TIPO_INSTITUCION = '.$instituciones->obtener('ID_TIPO_INSTITUCION').'');
						$cont .= '
														<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$tipoinstitucion->obtener('TIPO_INSTITUCION').'-'.$instituciones->obtener('LUGAR').'-'.$corregimientos->obtener('CORREGIMIENTO').'</option>
						';
						$i = $instituciones->releer();
					}
					$cont.='
													</select>
												</td>
												<td></td>
												<td>Referido de: </td>
												<td><select id="referido" name="referido">
														<option value="0"></option>';
					$r = $referido->buscardonde('ID_REFERIDO > 0');
					while($r){
						$cont.='
														<option value="'.$referido->obtener('ID_REFERIDO').'">'.$referido->obtener('REFERIDO').'</option>
						';
						$r = $referido->releer();
					}
					$cont.='
													</select>
												</td>
											</tr>
										</table>
									</center>					
								</td>
							</tr>
							<tr>
								<td class="fondo_azul">
									Datos de Hospitalización
								</td>
							</tr>							
							<tr>
								<td>
									<table style="font-size:14px" width="100%">
										<tr align="center">
											<td>Diagnóstico de Admisión:</td>
											<td>Diagnóstico de Egreso:</td>
											<td>Tratamiento: </td>
											<td>Condición de Salida: </td>
										</tr>
										<tr align="center">
											<td><textarea id="diagnosticoadmision" name="diagnosticoadmision"  style="width:100%;max-width:150px;height:50px;border-color:#ccc;"></textarea></td>
											<td><textarea id="diagnosticoegreso" name="diagnosticoegreso"  style="width:100%;max-width:150px;height:50px;border-color:#ccc;"></textarea></td>
											<td><textarea id="tratamiento" name="tratamiento"  style="width:100%;max-width:150px;height:50px;border-color:#ccc;"></textarea></td>
											<td>
												<select id="condicionsalida" name="condicionsalida">
													<option value="0"></option>';
				$c = $condicionsalida->buscardonde('ID_CONDICION_SALIDA > 0');
				while($c){
						$cont.='
													<option value="'.$condicionsalida->obtener('ID_CONDICION_SALIDA').'">'.$condicionsalida->obtener('CONDICION_SALIDA').'</option>
							';
						$c = $condicionsalida->releer();
				}					
				$cont.='						</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="fondo_azul">
									Datos de Evolución
								</td>
							</tr>
							<tr>
								<td>
									<table style="font-size:14px" width="100%">
										<tr>
											<td>Evolución:</td>
										</tr>
										<tr>
											<td><textarea id="evolucion" name="evolucion" style="width:98%;height:50px;border-color:#ccc;"></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:10px;float:right;">Registrar</button>
					</form>
				</fieldset>	
				';		
			
		}


	}

	$ds->contenido($cont);
	$ds->mostrar();
?>