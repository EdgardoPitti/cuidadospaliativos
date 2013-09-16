<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
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
	$mostrar='block';
	$cont.='
	  <center>
	  <fieldset>
		<legend><h3 style="background:#f4f4f4;">Contacto Telefónico</h3></legend>';
	/*	
	if(empty($buscar)){
		if(!$paciente->buscardonde('NO_CEDULA = "'.$buscar.'"')){			
			$agnadir.='
						<a href="./?url=hospitalaria_rae_capturardatos">Paciente no Encotrado...Añadir</a>';
		}
		echo asdasdas;
	}else{
		$mostrar='none';
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
	}		*/
	
	$cont.='
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Atención al Paciente</a></li>
					<li><a href="#tabs-2">Interconsulta</a></li>
				</ul>
				<div id="tabs-1" style="font-size:12px;">
					<div align="right">
						<form class="form-search" method="POST" action="./?url=ambulatoria_atencionalpaciente">
							<div class="input-group">
							  Buscar paciente: <input type="search" class="form-control" id="cedula" placeholder="Cédula" name="buscar" id="buscar">
							  <span class="input-group-btn">
								<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
							  </span>
							</div>
							'.$agnadir.'
						</form>
					</div>
						<center style="display:'.$mostrar.';">
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
						<table width="100%">
							<tr>
								<td width="50%">
									<fieldset>
										<legend>
											Resumen Médico
										</legend>
										<div id="accordion">
											<h3>8/7/2013</h3>
											<div>
												<div id="accordion2">
													<h3>Atención Domiciliaria</h3>
													<div>
														<ul>
															<li><a>Actividades realizadas</a></li>
															<li><a>Medicamentos Suministrados</a></li>
														</ul>
													</div>
												</div>
											</div>	
										
											<h3>8/8/2013</h3>
											<div>
												<div id="accordion4">
													<h3>Atención Domiciliaria</h3>
													<div>
														<ul>
															<li><a>Actividades realizadas</a></li>
															<li><a>Medicamentos Suministrados</a></li>
														</ul>
													</div>
												</div>
											</div>	
										</div>
									</fieldset>
								</td>
								<td></td>
							</tr>
						</table>
				</div>	
				
				<div id="tabs-2">
					<section>
						<form method="POST" action="./?url">
							<table width="55%">
								<tr>
									<td><input type="search" class="search" id="buscar" placeholder="Buscar Paciente"  name="busc_paciente"/></td>
									<td><input type="radio" name="selectipo">Nombre</input></td>
									<td><input type="radio" name="selectipo">Cédula</input></td>
								</tr>
							</table>
						</form>
					</section>
				</div>
			</div>
		</fieldset>

				';
	$ds->contenido($cont);
	$ds->mostrar();
?>