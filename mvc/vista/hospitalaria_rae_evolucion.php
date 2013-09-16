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
	$ds = new Diseno();
	$buscar = $_POST['buscar'];
	$sw = 0;
	$cont.='
	  <center><h3 style="background:#f4f4f4;"> Registro de Admisión-Egreso (RAE)</h3></center>
		<br><br>';
	if(!empty($buscar)){
		if(!$paciente->buscardonde('NO_CEDULA = "'.$buscar.'"')){
			$sw = 1;
		}
	}
	if(empty($buscar) or $sw == 1){
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

			$cont.='
				<form method="POST" action="./?url=">
						<div id="accordion">
							<h3>Datos de Referencia</h3>
								<div>
									<table style="font-size:12px">';
									
		$personas->buscardonde('NO_CEDULA = "'.$buscar.'"');
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
		$cont.='<center>
				<table width="80%">
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
											<td>'.$cedula.'</td>
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
				<form method="POST" action="./?url=">
						<table width="100%">
							<tr>
								<td class="fondo_azul">
									Datos de Referencia
								</td>
							</tr>
							<tr>
								<td>
									<center>
										<table style="font-size:14px;">
											<tr>
												<td>Institución:</td>
												<td><select id="institucion" name="institucion">
														<option value=""></option>';
														
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
									<center>
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
													<td><select id="condicionsalida" name="condicionsalida">
																			<option value="0"></option>';
			$c = $condicionsalida->buscardonde('id > 0');
			while($c){
					$cont.='
																			<option value="'.$condicionsalida->obtener('id').'">'.$condicionsalida->obtener('descripcion').'</option>
						';
					$c = $condicionsalida->releer();
			}					
			$cont.='												</select>
													</td>
												</tr>
										</table>
									</center>
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
			';
	}

	$ds->contenido($cont);
	$ds->mostrar();


?>