<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$servicios = new Accesatabla('servicios_medicos');
	$citas = new Accesatabla('citas_medicas');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$profesional_salud = new Accesatabla('profesionales_salud');
	$paciente = new Accesatabla('datos_pacientes');
	$equipo = new Accesatabla('detalle_equipo_medico');
	$especialidades = new Accesatabla('especialidades_medicas');
	$id = $_SESSION['cita'];
	if(empty($id)){
		$id = $_GET['id'];
		
	}
	$hora = $_SESSION['hora_'.$_GET['h'].''];
	$fecha = $_SESSION['fecha'][2].'/'.$_SESSION['fecha'][1].'/'.$_SESSION['fecha'][0].'';
	if(!empty($id)){
		$citas->buscardonde('ID_CITA = '.$id.'');
		$profesional->buscardonde('ID_PROFESIONAL = '.$citas->obtener('ID_PROFESIONAL').'');
		$paciente->buscardonde('ID_PACIENTE = '.$citas->obtener('ID_PACIENTE').'');
		$readonly = 'readonly';
		$disabled = 'disabled';
		$hora = $citas->obtener('HORA');
		$fecha = $citas->obtener('FECHA');
		if($citas->obtener('RESERVADA') == 1){
			$si = 'checked';
			$no = '';
		}else{
			$no = 'checked';
			$si = '';
		}
	}
	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Nueva Cita</h3>	
			<center>
				<table>
					<tr>
						<td><b>Fecha: </b></td>
						<td>'.$fecha.'</td>
					</tr>
					<tr>
						<td><b>Hora: </b></td>
						<td>'.$hora.'</td>
					</tr>
				</table>
			</center>
			<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Datos</h3>	
			<form method="POST" action="./?url=agregar_citas&id='.$id.'">
				<center>
					<table>
						<tr>
							<td>Paciente:</td>
							<td><input type="text" id="paciente" name="paciente" value="'.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('SEGUNDO_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').' '.$paciente->obtener('APELLIDO_MATERNO').'" placeholder="Buscar Paciente" '.$readonly.'><br><input type="text" id="cedpaciente" name="cedpaciente" value="'.$paciente->obtener('NO_CEDULA').'" placeholder="C&eacute;dula Paciente" readonly></td>
						</tr>
						<tr>
							<td>Profesional:</td>
							<td><input type="text" id="profesional" name="profesional" value="'.$profesional->obtener('PRIMER_NOMBRE').' '.$profesional->obtener('SEGUNDO_NOMBRE').' '.$profesional->obtener('APELLIDO_PATERNO').' '.$profesional->obtener('APELLIDO_MATERNO').'" placeholder="Buscar Profesional" '.$readonly.'><br><input type="text" id="cedprofesional" name="cedprofesional" value="'.$profesional->obtener('NO_CEDULA').'" placeholder="C&eacute;dula Profesional" readonly></td>
						</tr>
						<tr>
							<td>Servicio:</td>
							<td><select id="servicio" name="servicio" '.$disabled.'>
									<option value=""></option>							
					';
	$x = $servicios->buscardonde('ID_SERVICIO > 0');
	while($x){
		if($servicios->obtener('ID_SERVICIO') == $citas->obtener('ID_SERVICIO')){
			$selected = 'selected';
		}else{
			$selected = '';
		}
		$cont.='
									<option value="'.$servicios->obtener('ID_SERVICIO').'" '.$selected.'>'.$servicios->obtener('DESCRIPCION').'</option>
		';
		$x = $servicios->releer();
	}
	$cont.='
								</select>
							</td>
						</tr>
						<tr>
							<td>Reservada:</td>
							<td><input type="radio" id="reservada" name="reservada" value="1" checked '.$si.'> Si <br><input type="radio" id="reservada" name="reservada" value="0" '.$no.'> No </td>
						</tr>
						<tr>
							<td><input style="display:none;" type="text" id="fecha" name="fecha" value="'.$fecha.'"></td>
							<td><input style="display:none;" type="text" id="hora" name="hora" value="'.$hora.'"></td>
						</tr>
					</table>
					<br>
					<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;">Enviar</button><br>
					</form>
					<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Equipo M&eacute;dico</h3>	
					<form method="POST" action="./?url=agregar_citas&id='.$id.'&sw=1">
						<table>';
	if(!empty($id)){
		$e = $equipo->buscardonde('ID_EQUIPO_MEDICO = '.$citas->obtener('ID_EQUIPO_MEDICO').'');
		if($e){
			$cont.='		<tr>
								<th>Profesional</th>
								<th>&nbsp;&nbsp</th>
								<th>Especialidad</th>
							</tr>';
		}
		while($e){
			$profesional->buscardonde('ID_PROFESIONAL = '.$equipo->obtener('ID_PROFESIONAL').'');
			$profesional_salud->buscardonde('ID_PROFESIONAL = '.$equipo->obtener('ID_PROFESIONAL').'');
			$especialidades->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$profesional_salud->obtener('ID_ESPECIALIDAD_MEDICA').'');
			$segundo_nombre = $profesional->obtener('SEGUNDO_NOMBRE');
			$segundo_apellido = $profesional->obtener('APELLIDO_MATERNO');
			$cont.='
							<tr>
								<td align="center">'.$profesional->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$profesional->obtener('APELLIDO_PATERNO').' '.$segundo_apellido[0].'.</td>
								<td></td>
								<td align="center">'.$especialidades->obtener('DESCRIPCION').'</td>
							</tr>
			';
			$e = $equipo->releer();
		}
		$button = '<button style="background:none;border:none;"><img src="./iconos/add_profesional.png" title="Guardar Profesional"></button>';
	}else{
		$button = '';
	}
	$cont.='
					</table>
						<table class="tabla-datos">
							<tr align="center">
								<td>Buscar Profesional:</td>
								<td>
									<input type="text" id="profesional2" name="profesional2" placeholder="Buscar Profesional">
									<input type="text" id="cedprofesional2" name="cedprofesional2" placeholder="C&eacute;dula Profesional" readonly>
								</td>
								<td>'.$button.'</td>
							</tr>					
						</table>
						<center>'.$_SESSION['error'].'</center>
					</form>	
					<a href="./?url=domiciliaria_agenda" class="btn btn-default">Volver Agenda</a>
				</center>
		';
	$_SESSION['hora_'.$_GET['h'].''] = '';
	$_SESSION['fecha'] = '';
	$_SESSION['cita'] = '';
	$_SESSION['error'] = '';
	$ds->contenido($cont);
	$ds->mostrar();
?>