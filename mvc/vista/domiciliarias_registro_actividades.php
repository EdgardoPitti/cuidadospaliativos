<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$frec = new Accesatabla('frecuencia');
	$tipo_at = new Accesatabla('tipo_atencion');
	
	$ds = new Diseno();
	$cedula = $_POST['cedula'];
	
	$sw = 0;
	
	$cont='
		<center>
			<fieldset>
				<legend align="center">
					<h3 style="background:#f4f4f4;padding:10px;">Registro Diario de Actividades</h3>
				</legend>';
				
	if(!empty($cedula) and !$personas->buscardonde('NO_CEDULA = "'.$cedula.'"')){			
		$sw = 1;					
	}
	if(empty($cedula) or $sw == 1){	
		$cont.='
				Introduzca el número de cédula del paciente, y añada las observaciones pertinentes.<br><br>
				<form class="form-search" method="POST" action="./?url=domiciliarias_registro_actividades">
					<div class="input-group">
					  Buscar paciente: <input type="search" class="form-control" placeholder="Cédula" name="cedula" id="cedula">
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
				</center>
				<div class="row-fluid" style="margin-top:15px;">
					<div class="span12">
						<form method="POST" action="./?url=addregistroactividad"
						<table width="100%">
							<tr>
								<td>Frecuentación: </td>
								<td>
									<select id="frecuencia" name="frecuencia">
										<option value=""></option>';
				$x = $frec->buscardonde('ID_FRECUENCIA > 0');						
				while($x){
					$cont.='			<option value="'.$frec->obtener('ID_FRECUENCIA').'">'.$frec->obtener('FRECUENCIA').'</option>';
					$x = $frec->releer();
				}
			$cont.='	
									</select>
								</td>
								<td>Tipo de Atención: </td>
								<td>
									<select id="tipoatencion" name="tipoatencion">
										<option value=""></option>';
				$y = $tipo_at->buscardonde('ID_TIPO_ATENCION');						
				while($y){
					$cont.='			<option value="'.$tipo_at->obtener('ID_TIPO_ATENCION').'">'.$tipo_at->obtener('TIPO_ATENCION').'</option>';
					$y = $tipo_at->releer();
				}
			$cont.='				
									</select>
								</td>
							</tr>
							<tr>
								<td>Diagnóstico: </td>
								<td><input type="text" name="diagnostico" id="diagnostico"></td>
								<td>Frecuentación: </td>
								<td>
									<select id="frec_diag" name="frec_diag">
										<option value=""></option>';
				$x = $frec->buscardonde('ID_FRECUENCIA > 0');						
				while($x){
					$cont.='			<option value="'.$frec->obtener('ID_FRECUENCIA').'">'.$frec->obtener('FRECUENCIA').'</option>';
					$x = $frec->releer();
				}
			$cont.='	
									</select>
								</td>
							</tr>
							<tr>
								<td>Actividad: </td>
								<td><input type="text" name="actividad" id="actividad"></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>';
	}		
	
	$cont.='	
					
				</fieldset>	
			</center>';
				
	$ds->contenido($cont);
	$ds->mostrar();
?>