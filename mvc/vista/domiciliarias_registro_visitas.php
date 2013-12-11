<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	
	$ds = new Diseno();
	$cedula = $_POST['cedula'];
	
	$sw = 0;
	
	$cont='
		<center>
			<fieldset>
				<legend align="center">
					<h3 style="background:#f4f4f4;padding:10px;">Registro Diario de Visitas</h3>
				</legend>';
				
	if(!empty($cedula) and !$personas->buscardonde('NO_CEDULA = "'.$cedula.'"')){			
		$sw = 1;					
	}
	if(empty($cedula) or $sw == 1){	
		$cont.='
				Introduzca el número de cédula del paciente, y añada las observaciones pertinentes.<br><br>
				<form class="form-search" method="POST" action="./?url=domiciliarias_registro_visitas">
					<div class="input-group">
					  Buscar paciente: <input type="search" class="form-control" placeholder="Cédula" name="cedula" id="busqueda">
					  <span class="input-group-btn">
						<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
					  </span>
					</div>
				</form>
			
		';
		if($sw == 1){
			$cont.='
					<a href="./?url=domiciliaria_capturardatos">Paciente no Encotrado...Añadir</a>';	
		}
	}else{
		$personas->buscardonde('NO_CEDULA = "'.$cedula.'"');
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
		$cont .='
				<center>
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
				</center>';
	}		
	
	$cont.='	
				</fieldset>	
			</center>';
				/*
	if(!empty($cedula)){
		$personas->buscardonde('cedula = "'.$cedula.'"');
		if($personas->obtener('femenino')){
			$sexo = 'Femenino';
		}else{
			$sexo = 'Masculino';
		}
		$cont.='
				<table width="100%">
					<tr>
						<td width="50%">
							<fieldset>
								<legend>
									Datos Generales del Paciente
								</legend>
								<center>
									<table>
										<tr>
											<td align="right">Cedula: </td>
											<td>&nbsp</td>
											<td>'.$cedula.'</td>
										</tr>
										<tr>
											<td align="right">Nombres: </td>
											<td></td>
											<td>'.$personas->obtener('primer_nombre').' '.$personas->obtener('segundo_nombre').'</td>
										</tr>
										<tr>
											<td align="right">Apellidos: </td>
											<td></td>
											<td>'.$personas->obtener('primer_apellido').' '.$personas->obtener('segundo_apellido').'</td>
										</tr>
										<tr>
											<td align="right">Tipo de Sangre: </td>
											<td></td>
											<td>'.$sangre->renombrar($personas->obtener('id_tipo_de_sangre'), tipo_sangre).'</td>
										</tr>
										<tr>
											<td align="right">Sexo: </td>
											<td></td>
											<td>'.$sexo.'</td>
										</tr>
										<tr>
											<td align="right">Nacionalidad: </td>
											<td></td>
											<td>'.$nacionalidades->renombrar($personas->obtener('id_nacionalidad'), nacionalidad).'</td>
										</tr>
										<tr>
											<td align="right">Etnia: </td>
											<td></td>
											<td>'.$etnia->renombrar($personas->obtener('id_etnia'), descripcion).'</td>
										</tr>
									</table>
								</center>
							</fieldset>
						</td>
						<td width="50%">
							<fieldset>
								<legend>
									Añadir Observaciones
								</legend>
								<form method="POST" action="./?url=">
									<textarea id="observaciones" name="observaciones" rows="8" cols="45"></textarea>
									<button>Añadir</button>
								</form>
								
							</fieldset>
						</td>
					</tr>
				</table>
		';
	}*/
	$ds->contenido($cont);
	$ds->mostrar();


?>