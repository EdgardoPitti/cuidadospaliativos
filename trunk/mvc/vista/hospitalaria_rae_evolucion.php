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
			<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Registro de Admisión-Egreso (RAE)</h3>
		</center>
	  ';
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
					  Buscar paciente: <input type="search" class="form-control" placeholder="Cédula" name="buscar" id="busqueda">
					  <span class="input-group-btn">
						<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
					  </span>
					</div>
				</form>
			</center>';
		if($sw == 1){
			$cont.='<center>
						Paciente no Encotrado...<a href="./?url=hospitalaria_rae_capturardatos"><img src="./iconos/add_profesional.png" title="A&ntilde;adir"></a>
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
						<legend>
							Responsable del Paciente
						</legend>
						
						<div class="row-fluid">
							<div class="span6">
								<table class="table">
									<tbody>
										<tr>
											<td style="text-align:left;padding-left:17%;">Nombre:</td>														
										</tr>
										<tr>
											<td><input type="text" id="nombreresponsable" name="nombreresponsable"></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="span6">
								<table class="table">
									<tbody>
										<tr>
											<td style="text-align:left;padding-left:17%;">Apellido:</td>	
										</tr>
										<tr>
											<td><input type="text" id="apellidoresponsable" name="apellidoresponsable"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						
						<div class="row-fluid">
							<div class="span6">
								<table class="table">
									<tbody>
										<tr>
											<td style="text-align:left;padding-left:17%;">Parentesco:</td>
										</tr>	
										<tr>	
											<td><input type="text" id="parentesco" name="parentesco"></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="span6">
								<table class="table">
									<tbody>
										<tr>
											<td style="text-align:left;padding-left:17%;">Dirección:</td>
										</tr>
										<tr>
											<td><textarea class="textarea" id="direccionresponsable" name="direccionresponsable"></textarea></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div class="row-fluid">
							<div class="span6">
								<table class="table">
									<tbody>
										<tr>
											<td style="text-align:left;padding-left:17%;">Teléfono:</td>
										</tr>
										<tr>
											<td><input type="text" id="telefonoresponsable" name="telefonoresponsable"></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="span6"></div>
						</div>
					</fieldset>		
					<center style="margin-top:10px">
						<button type="submit" class="btn btn-primary">Registrar</button>
					</center>
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
			$cont.='
					<div style="float:right;"><i>'.$fecha.', '.$ds->dime('hora').':'.$ds->dime('minuto').'</i></div>
					<div class="row-fluid" style="float:none;clear:both;">
						<div class="span6">
							<fieldset>
								<legend>
									Paciente
								</legend>
									<table class="table2">											
										<tr>
											<td colspan="3"><h5>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</h5></td>
										</tr>
										<tr>
											<td>'.$personas->obtener('NO_CEDULA').'</td>
											<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
											<td>'.$sexo.'</td>
										</tr>
										<tr>
											<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
											<td>'.$asegurado.'</td>
											<td>'.$ds->edad($dia,$mes,$anio).' Años</td>
										</tr>
									</table>
							</fieldset>
						</div>
						<div class="span6">
							<fieldset>
								<legend>
									Dirección
								</legend>
									<table class="table2" style="height:86px;">
										<tr>
											<td>'.$distritos->obtener('DISTRITO').' , '.$provincias->obtener('PROVINCIA').'</td>
										</tr>
										<tr>
											<td>'.$corregimientos->obtener('CORREGIMIENTO').' , '.$residencia->obtener('DETALLE').'</td>
										</tr>
									</table>
							</fieldset>
						</div>	
					</div>
					
					
					<h3 class="fondo_azul">Datos de Referencia</h3>
					<div class="row-fluid">
						<div class="span6">
							<table class="tabla-datos">
								<tr>
									<td>Institución:</td>
									<td><select id="institucion" name="institucion">
											<option value="0"></option>';
												
		$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
		while($i){
			$cont .= '
											<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$instituciones->obtener('DENOMINACION').' - '.$instituciones->obtener('LUGAR').'</option>
			';
			$i = $instituciones->releer();
		}
		$cont.='
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div class="span6">
							<table class="tabla-datos">
								<tr>
									<td>Referido de:</td>
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
						</div>
					</div>
					
					<h3 class="fondo_azul">Datos de Hospitalización</h3>
					<div class="row-fluid">
						<div class="span6">
							<table class="table" align="center">
								<tr>
									<td style="line-height:15px">Diagnóstico de Admisión:</td>
									<td><input type="text" id="diagnosticoadmision" name="diagnosticoadmision"></td>
								</tr>
							</table>
						</div>
						<div class="span6">
							<table class="table" align="center">
								<tr>
									<td style="line-height:15px">Diagnóstico de Egreso:</td>
									<td><input type="text" id="diagnosticoegreso" name="diagnosticoegreso"></td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="span6">
							<table class="table" align="center">
								<tr>
									<td style="line-height:15px">Tratamiento:</td>
									<td><input type="text" id="tratamiento" name="tratamiento"></td>
								</tr>
							</table>
						</div>
						<div class="span6">
							<table class="table" align="center">
								<tr>
									<td style="line-height:15px">Condición de Salida:</td>
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
						</div>
					</div>
										
					<h3 class="fondo_azul">Datos de Evolución</h3>
					<div class="row-fluid">
						<div class="span12">
							<textarea id="evolucion" name="evolucion" class="textarea2" style="width:98%;height:50px;border-color:#ccc;"></textarea>
						</div>
					</div>
					
						<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:10px;float:right;">Registrar</button>
				</form>';					
		}
	}

	$ds->contenido($cont);
	$ds->mostrar();
?>