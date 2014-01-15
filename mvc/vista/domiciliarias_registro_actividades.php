<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$instituciones = new Accesatabla('institucion');
	$rda = new Accesatabla('registro_diario_actividades');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$detalle_rda = new Accesatabla('detalle_rda');
	$equipo = new Accesatabla('detalle_equipo_medico');
	$especialidad = new Accesatabla('especialidades_medicas');
	$zona = new Accesatabla('zona');
	$frecuencia = new Accesatabla('frecuencia');
	$tipo_atencion = new Accesatabla('tipo_atencion');
	$estado_paciente = new Accesatabla('estado_paciente');
	$paciente = new Accesatabla('datos_pacientes');
	$diagnostico = new Accesatabla('detalle_diagnostico');
	$cie10 = new Accesatabla('cie10');
	$actividad = new Accesatabla('actividad');
	$cont.='
		<center>
			<fieldset>
				<legend align="center">
					<h3 style="background:#f4f4f4;padding:10px;">Registro Diario de Actividades</h3>
				</legend>
				<div class="row-fluid" style="margin-top:15px;">
					<div class="span2"></div>
					<div class="span8">';

	$idrda = $_GET['id'];
	if(empty($idrda)){
		$idrda = $_SESSION[idrda];
	}
	if(empty($idrda)){
	
		$cont.='
			
						<form method="POST" action="./?url=agregar_datos_rda">
							<table width="100%">
								<tr>
									<td>Fecha: </td>
									<td><input type="date" id="fecharda" name="fecharda"></td>
								</tr>
								<tr>
									<td>Institucion:</td>
									<td><select id="institucionrda" name="institucionrda">
											<option value=""></option>';
			
		$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
		while($i){
			$cont.='
											<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$instituciones->obtener('DENOMINACION').'</option>
			';
			$i = $instituciones->releer();
		}
		$cont.='						
										</select>
									</td>
								</tr>
								<tr>
									<td>Horas de Atenci&oacuten:</td>
									<td><input type="number" id="horas" name="horas" min="1" max="24" style="width:50px;" value="1"> horas</td>
								</tr>
							</table>
							<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;">Guardar</button>							
						</form>';	
	
	}else{
		$rda->buscardonde('ID_RDA = '.$idrda.'');
		$instituciones->buscardonde('ID_INSTITUCION = '.$rda->obtener('ID_INSTITUCION').'');
		$cont.='			<table width="100%">
								<tr align="center">
									<td>Fecha: '.$rda->obtener('FECHA').'</td>
								</tr>
								<tr align="center">
									<td>Instalacion: '.$instituciones->obtener('DENOMINACION').'<td>
								</tr>
								<tr align="center">
									<td>Horas de Atencion: '.$rda->obtener('HORAS_DE_ATENCION').' horas</td>
								</tr>
							</table>';
		$e = $equipo->buscardonde('ID_EQUIPO_MEDICO = '.$rda->obtener('ID_EQUIPO_MEDICO').'');
		$n = 1;
		if($e){
			$cont.='	
							
							<h3 style="background:#f4f4f4;padding:10px;">Equipo Medico</h3>
							<table width="100%">
								<tr align="center">
									<th>N°</th>
									<th>Especialidad Medica</th>
									<th>Profesional</th>
									<th></th>
								</tr>';
			while($e){
				$especialidad->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$equipo->obtener('ID_ESPECIALIDAD_MEDICA').'');
				$profesional->buscardonde('ID_PROFESIONAL = '.$equipo->obtener('ID_PROFESIONAL').'');
				$cont.='
								<tr align="center">
									<td>'.$n.'.</td>
									<td>'.$especialidad->obtener('DESCRIPCION').'</td>
									<td>'.$profesional->obtener('PRIMER_NOMBRE').' '.$profesional->obtener('SEGUNDO_NOMBRE').' '.$profesional->obtener('APELLIDO_PATERNO').' '.$profesional->obtener('APELLIDO_MATERNO').'</td>
									<td></td>
								</tr>
				
					';
				$n++;
				$e = $equipo->releer();
			}			
			$cont.='</table>';
		}else{
			$cont.='<br><div style="color:RED;">No existe equipo m&eacute;dico para esta Actividad</div>';
		}
		$cont.='
					<form method="POST" action="./?url=agregar_datos_rda&sw=2&id='.$idrda.'">
							<br>Nuevo Profesional:	<input type="text" id="profesional" name="profesional" placeholder="Buscar Profesional">&nbsp;<input type="text" id="cedprofesional" name="cedprofesional" placeholder="C&eacute;dula Profesional" readonly>
							
							<button style="background:none;border:none;"><img src="./iconos/add_profesional.png" title="Guardar Profesional"></button>
							'.$_SESSION[errorprof].'
					</form><h3 style="background:#f4f4f4;padding:10px;">Pacientes</h3>';
		$cont.='
					<form method="POST" action="./?url=agregar_datos_rda&sw=3&id='.$idrda.'">';
		if($detalle_rda->buscardonde('ID_RDA = '.$idrda.'')){
			$cont.='
							<table class="table">
								<tr>
									<th>Zona</th>
									<th>Paciente</th>
									<th>Frec.</th>
									<th>Tipo de Atenci&oacute;n</th>
									<th>Diagn&oacute;stico</th>
									<th>Diag./Prof.</th>
									<th>Actividad</th>
									<th>Act./Prof.</th>
									<th>Estado</th>
									<th>Referido</th>
									
								</tr>';
		
		}
		$z = $zona->buscardonde('ID_ZONA > 0');
		while($z){
				$zon .='
											<option value="'.$zona->obtener('ID_ZONA').'">'.$zona->obtener('ZONA').'</option>
				';
				$z = $zona->releer();
		}
		$f = $frecuencia->buscardonde('ID_FRECUENCIA > 0');
		while($f){
			$frec .='
											<option value="'.$frecuencia->obtener('ID_FRECUENCIA').'">'.$frecuencia->obtener('FRECUENCIA').'</option>
			';
			$f = $frecuencia->releer();
		}
		$t = $tipo_atencion->buscardonde('ID_TIPO_ATENCION > 0');
		while($t){
			$tipoatencion .='
											<option value="'.$tipo_atencion->obtener('ID_TIPO_ATENCION').'">'.$tipo_atencion->obtener('TIPO_ATENCION').'</option>
			';
			$t = $tipo_atencion->releer();
		}
		$e = $estado_paciente->buscardonde('ID_ESTADO_PACIENTE > 0');
		while($e){
			$estado .='
											<option value="'.$estado_paciente->obtener('ID_ESTADO_PACIENTE').'">'.$estado_paciente->obtener('ESTADO_PACIENTE').'</option>
			';
			$e = $estado_paciente->releer();
		}
		$n = 1;
		$d = $detalle_rda->buscardonde('ID_RDA = '.$idrda.'');
		while($d){
			$zona->buscardonde('ID_ZONA = '.$detalle_rda->obtener('ID_ZONA').'');
			$paciente->buscardonde('ID_PACIENTE = '.$detalle_rda->obtener('ID_PACIENTE').'');
			$frecuencia->buscardonde('ID_FRECUENCIA = '.$detalle_rda->obtener('ID_FRECUENCIA').'');
			$tipo_atencion->buscardonde('ID_TIPO_ATENCION = '.$detalle_rda->obtener('ID_TIPO_ATENCION').'');
			$diagnostico->buscardonde('ID_DIAGNOSTICO = '.$detalle_rda->obtener('ID_DIAGNOSTICO').'');
			$cie10->buscardonde('ID_CIE10 = "'.$diagnostico->obtener('ID_CIE10').'"');
			$actividad->buscardonde('ID_ACTIVIDAD = '.$detalle_rda->obtener('ID_ACTIVIDAD').'');
			$estado_paciente->buscardonde('ID_ESTADO_PACIENTE = '.$detalle_rda->obtener('ID_ESTADO_PACIENTE').'');
			$segundonombre = $paciente->obtener('SEGUNDO_NOMBRE');
			$segundoapellido = $paciente->obtener('APELLIDO_MATERNO');
			if($detalle_rda->obtener('REFERIDO_PACIENTE') == 0){
				$referido = 'No Referido';
			}else{
				$referido = 'Dentro de la Inst.';
			}
			$cont.='
								<tr>
									<td>'.$zona->obtener('ZONA').'</td>
									<td>'.$paciente->obtener('PRIMER_NOMBRE').' '.$segundonombre[0].'. '.$paciente->obtener('APELLIDO_PATERNO').' '.$segundoapellido[0].'.</td>
									<td>'.$frecuencia->obtener('FRECUENCIA').'</td>
									<td>'.$tipo_atencion->obtener('TIPO_ATENCION').'</td>
									<td>'.$cie10->obtener('DESCRIPCION').'</td>';
			$profesional->buscardonde('ID_PROFESIONAL = '.$diagnostico->obtener('ID_PROFESIONAL').'');
			$segundonombre = $profesional->obtener('SEGUNDO_NOMBRE');
			$segundoapellido = $profesional->obtener('APELLIDO_MATERNO');
			$cont.='
									<td>'.$profesional->obtener('PRIMER_NOMBRE').' '.$segundonombre[0].'. '.$profesional->obtener('APELLIDO_PATERNO').' '.$segundoapellido[0].'.</td>
									<td>'.$actividad->obtener('ACTIVIDAD').'</td>';
			$profesional->buscardonde('ID_PROFESIONAL = '.$actividad->obtener('ID_PROFESIONAL').'');
			$segundonombre = $profesional->obtener('SEGUNDO_NOMBRE');
			$segundoapellido = $profesional->obtener('APELLIDO_MATERNO');
			$cont.='
									<td>'.$profesional->obtener('PRIMER_NOMBRE').' '.$segundonombre[0].'. '.$profesional->obtener('APELLIDO_PATERNO').' '.$segundoapellido[0].'.</td>
									<td>'.$estado_paciente->obtener('LETRA_ESTADO').'</td>
									<td>'.$referido.'</td>
								</tr>
			';
			$d = $detalle_rda->releer();
			$n++;
		}
		$cont.='
							</table>
		';
		$cont.='
							<table>
								<tr>
									<td><fieldset>
											<legend>Paciente</legend>
												<table>
													<tr>
														<td>Buscar: </td>
														<td><input type="text" id="paciente" name="paciente" placeholder="Buscar Paciente"><br><input type="text" id="cedpaciente" name="cedpaciente" placeholder="C&eacute;dula Paciente" readonly></td>
													</tr>
													<tr>
														<td>Zona: </td>
														<td><select id="zona" name="zona">
																<option value=""></option>'.$zon.'</select></td>
													</tr>
													<tr>
														<td>Frecuencia: </td>
														<td><select id="frecuencia" name="frecuencia">
																<option value=""></option>'.$frec.'<select>
														</td>
													<tr>
													</tr>
														<td>Tipo de Atenci&oacute;n: </td>
														<td><select id="tipo_atencion" name="tipo_atencion">
																<option value=""></option>'.$tipoatencion.'</select>
														</td>												
													</tr>
												</table>
										</fieldset>
									</td>
									<td>
										&nbsp;
										&nbsp;
										&nbsp;
										&nbsp;
										&nbsp;
									</td>
									<td>
										<fieldset>
											<legend>Diagn&oacute;stico</legend>
												<table>
													<tr>
														<td>Diagn&oacute;stico: </td>
														<td><input type="text" id="diagnostico" name="diagnostico" placeholder="Diagn&oacute;stico"><br>
															<input type="text" id="cie10" name="cie10" placeholder="CIE10" readonly>
														</td>
													<tr>
													</tr>
														<td>Frecuencia: </td>
														<td><select id="frecdiag" name="frecdiag">
																<option value=""></option>
																'.$frec.'
															</select>
														</td>
													<tr>
													</tr>
														<td>Profesional: </td>
														<td><input type="text" name="profesional2" id="profesional2" placeholder="Buscar Profesional"><br><input type="text" id="cedprofesional2" name="cedprofesional2" placeholder="C&eacute;dula Profesional" readonly></td>
													<tr>
													</tr>
														<td>Observaci&oacute;n: </td>
														<td><textarea class="textarea" id="observacion" name="observacion"></textarea></td>
													</tr>
												</table>
											
										</fieldset>
									
									</td>
									<td>
										&nbsp;
										&nbsp;
										&nbsp;
										&nbsp;
										&nbsp;
									</td>
									<td>
										<fieldset>
											<legend>
												Otros
											</legend>
											<table>
												<tr>
													<td>Actividad: </td>
													<td><input type="text" name="actividad" id="actividad"></td>
												</tr>
												<tr>
													<td>Frecuencia: </td>
													<td><select id="frecact" name="frecact">
															<option value=""></option>
															'.$frec.'
														</select>
													</td>
												</tr>
												<tr>
													<td>Profesional: </td>
													<td><input type="text" name="profesional3" id="profesional3" placeholder="Buscar Profesional"><br><input type="text" id="cedprofesional3" name="cedprofesional3" placeholder="C&eacute;dula Profesional" readonly></td>
												</tr>
												<tr>
													<td>Estado: </td>
													<td><select id="estado" name="estado">
															<option value=""></option>
															'.$estado.'
														</select>
													</td>
												</tr>
												<tr>
													<td>Referido: </td>
													<td><select id="referido" name="referido">
															<option value=""></option>
															<option value="0">No Referido</option>
															<option value="1">Dentro de la Inst.</option>
														</select>
													</td>
												</tr>
											</table>
										</fieldset>
									</td>		
								</tr>
							</table>
							<button style="background:none;border:none;"><img src="./iconos/add_profesional.png" title="Guardar Paciente"></button>
							'.$_SESSION[errorpa].'
					</form>';
	}
	$cont.='
					</div>
					<div class="span2"></div>
				</div>					
				</fieldset>	
		</center>';
	$_SESSION[idrda] = '';
	$ds->contenido($cont);
	$ds->mostrar();
?>