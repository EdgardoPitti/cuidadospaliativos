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
			<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Registro Diario de Actividades</h3>
				<div class="row-fluid" style="margi n-top:15px;">					
					<div class="span12">';

	$idrda = $_GET['id'];
	if(empty($idrda)){
		$idrda = $_SESSION[idrda];
	}
	if(empty($idrda)){
	
		$cont.='
			
						<form method="POST" action="./?url=agregar_datos_rda">
							<table width="40%" >
								<tr>
									<td>Fecha:</td>
									<td align="center"><input type="date" id="fecharda" name="fecharda"></td>
								</tr>
								<tr>
									<td>Institucion:</td>
									<td align="center"><select id="institucionrda" name="institucionrda">
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
									<td>Horas de Atenci&oacute;n:</td>
									<td align="center"><input type="number" id="horas" name="horas" min="1" max="24" style="width:50px;" value="1"> horas</td>
								</tr>
							</table>
							<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;">Guardar</button>							
						</form>';	
	
	}else{
		$rda->buscardonde('ID_RDA = '.$idrda.'');
		$instituciones->buscardonde('ID_INSTITUCION = '.$rda->obtener('ID_INSTITUCION').'');
		$cont.='			<table width="100%">
								<tr align="center">
									<td><b>Fecha:</b> '.$rda->obtener('FECHA').'</td>
								</tr>
								<tr align="center">
									<td><b>Instalacion:</b> '.$instituciones->obtener('DENOMINACION').'<td>
								</tr>
								<tr align="center">
									<td><b>Horas de Atencion:</b> '.$rda->obtener('HORAS_DE_ATENCION').' horas</td>
								</tr>
							</table>';
		$e = $equipo->buscardonde('ID_EQUIPO_MEDICO = '.$rda->obtener('ID_EQUIPO_MEDICO').'');
		$n = 1;
		if($e){
			$cont.='	
							
							<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Equipo Médico</h3>
							<table class="tabla-datos">
								<tr align="center">
									<th>N°</th>
									<th>Especialidad Medica</th>
									<th>Profesional</th>
								</tr>';
			while($e){
				$especialidad->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$equipo->obtener('ID_ESPECIALIDAD_MEDICA').'');
				$profesional->buscardonde('ID_PROFESIONAL = '.$equipo->obtener('ID_PROFESIONAL').'');
				$cont.='
								<tr align="center">
									<td>'.$n.'.</td>
									<td>'.$especialidad->obtener('DESCRIPCION').'</td>
									<td>'.$profesional->obtener('PRIMER_NOMBRE').' '.$profesional->obtener('SEGUNDO_NOMBRE').' '.$profesional->obtener('APELLIDO_PATERNO').' '.$profesional->obtener('APELLIDO_MATERNO').'</td>									
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
				<form class="form-search" method="POST" action="./?url=agregar_datos_rda&sw=2&id='.$idrda.'">
					<div class="input-group">
					 <br> Nuevo Profesional: <input type="search" class="form-control" id="profesional" name="profesional" placeholder="Buscar Profesional">&nbsp;<input type="text" id="cedprofesional" name="cedprofesional" placeholder="C&eacute;dula Profesional" readonly>
					  <span class="input-group-btn">
						<button style="background:none;border:none;"><img src="./iconos/add_profesional.png" title="Guardar Profesional"></button>
						'.$_SESSION[errorprof].'
					  </span>
					</div>
				</form>
		
		
					
					
					<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Pacientes</h3>
					
					<form method="POST" action="./?url=agregar_datos_rda&sw=3&id='.$idrda.'">';
		if($detalle_rda->buscardonde('ID_RDA = '.$idrda.'')){
			$cont.='
					<div style="max-width=1024px;overflow-x:auto">
							<table class="table2">
								<tr class="fd-table">
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
						</div>
		</center>
		';
		$cont.='
							<div class="row-fluid">
								<div class="span4">
									<fieldset>
										<legend>Paciente</legend>	
										<table class="table">
											<tbody>
												<tr>
													<td style="text-align:left;padding-left:17%;">Buscar:</td>														
												</tr>
												<tr>
													<td>
														<input type="text" id="paciente" name="paciente" placeholder="Buscar Paciente"><br>
														<input type="text" id="cedpaciente" name="cedpaciente" placeholder="C&eacute;dula Paciente" readonly>
													</td>
												</tr>
												<tr>
													<td style="text-align:left;padding-left:17%;">Zona: </td>														
												</tr>
												<tr>
													<td>
														<select id="zona" name="zona">
															<option value=""></option>
															'.$zon.'
														</select>
													</td>
												</tr>
												<tr>
													<td style="text-align:left;padding-left:17%;">Frecuencia: </td>														
												</tr>
												<tr>
													<td>
														<select id="frecuencia" name="frecuencia">
															<option value=""></option>
															'.$frec.'
														</select>
													</td>
												</tr>
												<tr>
													<td style="text-align:left;padding-left:17%;">Tipo de Atenci&oacute;n:</td>														
												</tr>
												<tr>
													<td>
														<select id="tipo_atencion" name="tipo_atencion">
															<option value=""></option>
															'.$tipoatencion.'
														</select>
													</td>	
												</tr>
											</tbody>
										</table>										
									</fieldset>
								</div>
								
								<div class="span4">
									<fieldset>
										<legend>Diagn&oacute;stico</legend>			
										<table class="table">
											<tbody>
												<tr>
													<td style="text-align:left;padding-left:17%;">Diagn&oacute;stico: </td>														
												</tr>
												<tr>
													<td>
														<input type="text" id="diagnostico" name="diagnostico" placeholder="Diagn&oacute;stico"><br>
														<input type="text" id="cie10" name="cie10" placeholder="CIE10" readonly>
													</td>
												</tr>
												<tr>
													<td style="text-align:left;padding-left:17%;">Frecuencia: </td>														
												</tr>
												<tr>
													<td>
														<select id="frecdiag" name="frecdiag">
															<option value=""></option>
															'.$frec.'
														</select>
													</td>
												</tr>
												<tr>
													<td style="text-align:left;padding-left:17%;">Profesional: </td>														
												</tr>
												<tr>
													<td>
														<input type="text" name="profesional2" id="profesional2" placeholder="Buscar Profesional"><br>
														<input type="text" id="cedprofesional2" name="cedprofesional2" placeholder="C&eacute;dula Profesional" readonly>
													</td>
												</tr>
												<tr>
													<td style="text-align:left;padding-left:17%;">Observaci&oacute;n: </td>														
												</tr>
												<tr>
													<td><textarea class="textarea" id="observacion" name="observacion" placeholder="Observaci&oacute;n"></textarea></td>
												</tr>
											</tbody>
										</table>
									</fieldset>
								</div>
								
								<div class="span4">
									<fieldset>
										<legend>Otros</legend>
										<table class="table">
											<tbody>
												<tr>
													<td style="text-align:left;padding-left:17%;">Actividad: </td>														
												</tr>
												<tr>
													<td><input type="text" name="actividad" id="actividad" placeholder="Actividad"></td>
												</tr>
												<tr>
													<td style="text-align:left;padding-left:17%;">Frecuencia: </td>														
												</tr>
												<tr>
													<td>
														<select id="frecact" name="frecact">
															<option value=""></option>
															'.$frec.'
														</select>
													</td>
												</tr>
												<tr>
													<td style="text-align:left;padding-left:17%;">Profesional: </td>														
												</tr>
												<tr>
													<td>
														<input type="text" name="profesional3" id="profesional3" placeholder="Buscar Profesional"><br>
														<input type="text" id="cedprofesional3" name="cedprofesional3" placeholder="C&eacute;dula Profesional" readonly>
													</td>
												</tr>
												<tr>
													<td style="text-align:left;padding-left:17%;">Estado: </td>														
												</tr>
												<tr>
													<td>
														<select id="estado" name="estado">
															<option value=""></option>
															'.$estado.'
														</select>
													</td>
												</tr>
												<tr>
													<td style="text-align:left;padding-left:17%;">Referido: </td>														
												</tr>
												<tr>
													<td>
														<select id="referido" name="referido">
															<option value=""></option>
															<option value="0">No Referido</option>
															<option value="1">Dentro de la Inst.</option>
														</select>
													</td>
												</tr>
											</tbody>
										</table>
																
									</fieldset>
								</div>
							</div>
		
							<center>
								<button style="background:none;border:none;padding-top:7px"><img src="./iconos/add_profesional.png" title="Guardar Paciente"></button>
								'.$_SESSION[errorpa].'
							</center>
					</form>';
	}
	$cont.='
					</div>
				</div>			
		';
	$_SESSION[idrda] = '';
	$ds->contenido($cont);
	$ds->mostrar();
?>