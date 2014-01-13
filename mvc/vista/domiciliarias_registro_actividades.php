<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$tipo_at = new Accesatabla('tipo_atencion');
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
	$referido = new Accesatabla('referido');
	
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
							<br>Nuevo Profesional:	<input type="text" id="profesional" name="profesional">
							<button style="background:none;border:none;"><img src="./iconos/add_profesional.png" title="Guardar Profesional"></button>
							'.$_SESSION[error].'
					</form><h3 style="background:#f4f4f4;padding:10px;">Pacientes</h3>';

		$cont.='
					<form method="POST" action="./?url=agregar_datos_rda&sw=3&id='.$idrda.'">
							<table class="table">
								<tr>
									<th>Zona</th>
									<th>Frec.</th>
									<th>Tipo de Atenci&oacute;n</th>
									<th>Diagn&oacute;stico</th>
									<th>Diag./Frec.</th>
									<th>Diag./Prof.</th>
									<th>Observaci&oacute;n</th>
									<th>Actividad</th>
									<th>Act./Frec.</th>
									<th>Estado</th>
									<th>Referido</th>
									<th>Paciente</th>
								</tr>';
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
		$r = $referido->buscardonde('ID_REFERIDO > 0');
		while($r){
			$ref .='
											<option value="'.$referido->obtener('ID_REFERIDO').'">'.$referido->obtener('REFERIDO').'</option>
			';
			$r = $referido->releer();
		}
		$n = 1;
		$d = $detalle_rda->buscardonde('ID_RDA = '.$idrda.'');
		while($d){
			$cont.='
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
			';
			$d = $detalle_rda->releer();
			$n++;
		}
		$cont.='
								<tr>
									<td><select id="zona" name="zona">
											<option value=""></option>'.$zon.'</select></td>
									<td><select id="frecuencia" name="frecuencia">
											<option value=""></option>'.$frec.'<select>
									</td>
									<td><select id="tipo_atencion" name="tipo_atencion">
											<option value=""></option>'.$tipoatencion.'</select>
									</td>
									<td><input type="text" id="diagnostico" name="diagnostico"></td>
									<td><select id="frecdiag" name="frecdiag">
											<option value=""></option>
											'.$frec.'
										</select>
									</td>
									<td><input type="text" name="profesionaldiag" id="profesionaldiag"></td>
									<td><textarea class="textarea" id="observacion" name="observacion"></textarea></td>
									<td></td>
									<td><select id="frecact" name="frecact">
											<option value=""></option>
											'.$frec.'
										</select>
									</td>
									<td><select id="estado" name="estado">
											<option value=""></option>
											'.$estado.'
										</select>
									</td>
									<td><select id="referido" name="referido">
											<option value=""></option>
											'.$ref.'
										</select>
									</td>
									<td><input type="text" name="busqueda" id="busqueda">&nbsp;<button style="background:none;border:none;"><img src="./iconos/add_profesional.png" title="Guardar Paciente"></button></td>
								</tr>
							</table>
							
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