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
	$frec = new Accesatabla('frecuencia');
	$tipo_at = new Accesatabla('tipo_atencion');
	$instituciones = new Accesatabla('institucion');
	$rda = new Accesatabla('registro_diario_actividades');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$equipo = new Accesatabla('detalle_equipo_medico');
	$especialidad = new Accesatabla('especialidades_medicas');

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
			$cont.='<br><h3>No existe equipo medico para esta Actividad</h3>';
		}
		$cont.='
					<form method="POST" action="./?url=agregar_datos_rda&sw=2&id='.$idrda.'">
							<br>Nuevo Profesional:	<input type="text" id="profesional" name="profesional">
							<button style="background:none;border:none;"><img src="./iconos/add_profesional.png" title="Guardar Profesional"></button>
							'.$_SESSION[error].'
					</form>';
	}
	
	$cont.='
					</div>
					<div class="span2"></div>
				</div>					
				</fieldset>	
		</center>';
				
	$ds->contenido($cont);
	$ds->mostrar();
?>