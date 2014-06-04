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
	$equipos = new Accesatabla('equipo_medico');
	$especialidades = new Accesatabla('especialidades_medicas');
	$id = $_GET['id'];
	$c = $_GET['c'];
	if(empty($c)){

		if($_SESSION['fecha'][2] < 10){
			$dia .= '0';
			$dia .= $_SESSION['fecha'][2];
		}else{
			$dia = $_SESSION['fecha'][2];
		}

		if($_SESSION['fecha'][1] < 10){
			$mes .= '0';
			$mes .= $_SESSION['fecha'][1];
		}else{
			$mes = $_SESSION['fecha'][1];
		}

		$fecha = $_SESSION['fecha'][0].'-'.$mes.'-'.$dia.'';

	}else{
		$fecha = $_SESSION['fecha'][0].'-'.$_SESSION['fecha'][1].'-'.$_SESSION['fecha'][2].'';

	}
	
	if(!empty($id)){
		$citas->buscardonde('ID_CITA = '.$id.'');
		$readonly = 'readonly';
		$disabled = 'disabled';
		$fecha = $citas->obtener('FECHA');
		$idequipo = $citas->obtener('ID_EQUIPO_MEDICO');
		if($citas->obtener('RESERVADA') == 1){
			$si = 'checked';
			$no='';
		}else{
			$no = 'checked';
			$si='';
		}
	}
	$hora = '<select id="hora" name="hora">
				<option></option>
	';
	for($x=0;$x<20;$x++){
		if($_GET['h'] == $x){
			$selected = 'selected';
		}else{
			$selected = '';
		}
		$hora .= '<option value="'.$_SESSION['hora_'.$x.''].'" '.$selected.'>'.$_SESSION['hora_'.$x.''].'</option>';
	
	}
	$hora.=	'</select>';
	
	$cont.='<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Nueva Cita</h3>	
			<form id="form" method="POST" action="./?url=agregar_citas&sbm=1">
				<div class="row-fluid">
					<div class="span6" align="center">
						<h5 style="background:#f4f4f4;padding-top:3px;padding-bottom:3px;width:100%;text-align:center;">Paso 1:</h5>
						<label for="fecha">Seleccione la fecha: </label>
						<input type="date" name="fecha" id="fecha" value="'.$fecha.'" max="2025-12-31" min="2010-12-31"required="required">
					</div>
					<div class="span6" align="center" >
						<h5 style="background:#f4f4f4;padding-top:3px;padding-bottom:3px;width:100%;text-align:center;">Paso 2:</h5>
						<label for="cod_equipo">Seleccione el equipo m&eacute;dico: </label>
						<select id="cod_equipo" name="cod_equipo" required>
							<option value="0">SELECCIONE EQUIPO</option>';
	$e = $equipos->buscardonde('ID_EQUIPO_MEDICO > 0');
	while($e){
		if($idequipo == $equipos->obtener('ID_EQUIPO_MEDICO')){
			$selected = 'selected';
		}else{
			$selected = '';
		}
		$cont.='
							<option value="'.$equipos->obtener('ID_EQUIPO_MEDICO').'" '.$selected.'>'.$equipos->obtener('ID_EQUIPO_MEDICO').'</option>
		';
		$e = $equipos->releer();
	}
	$cont.='
						</select>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<h5 style="background:#f4f4f4;padding-top:3px;padding-bottom:3px;width:100%;text-align:center;">Paso 3:</h5>
						Seleccione el paciente: 
						<div class="overflow overthrow" style="width: 100%; min-height: 150px; overflow-y: auto;">
							<table class="table2 borde-tabla">
								<thead>
									<tr class="fd-table">
										<th style="min-width:120px">Hora</th>
										<th style="min-width:250px">Paciente</th>
										<th style="min-width:250px">Profesional</th>
										<th style="min-width:250px">Servicio</th>
										<th style="min-width:100px">Reservada</th>										
									</tr>
								</thead>
								<tbody>';
				$c = $citas->buscardonde('FECHA = "'.$fecha.'" AND ID_EQUIPO_MEDICO = '.$idequipo.'');
				while($c){
					$profesional->buscardonde('ID_PROFESIONAL = '.$citas->obtener('ID_PROFESIONAL').'');
					$paciente->buscardonde('ID_PACIENTE = '.$citas->obtener('ID_PACIENTE').'');
					$servicios->buscardonde('ID_SERVICIO = '.$citas->obtener('ID_SERVICIO').'');

					
					$cont.='		<tr>
										<td>'.$citas->obtener('HORA').'</td>
										<td>'.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('SEGUNDO_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').' '.$paciente->obtener('APELLIDO_MATERNO').'</td>
										<td>'.$profesional->obtener('PRIMER_NOMBRE').' '.$profesional->obtener('SEGUNDO_NOMBRE').' '.$profesional->obtener('APELLIDO_PATERNO').' '.$profesional->obtener('APELLIDO_MATERNO').'</td>
										<td>'.$servicios->obtener('DESCRIPCION').'</td>
										<td>
											<input type="radio" id="reservada" name="reservada" value="1" '.$si.'> Si <input type="radio" id="reservada" name="reservada" value="0" '.$no.'> No 
										</td>
									</tr>';
					$c = $citas->releer();
				}
				
				$cont.='			<tr>
										<td>'.$hora.'</td>
										<td><input type="text" id="paciente" name="paciente" placeholder="Buscar Paciente"  required><br><input type="text" id="cedpaciente" name="cedpaciente" placeholder="C&eacute;dula Paciente" readonly></td>
										<td><input type="text" id="profesional" name="profesional" placeholder="Buscar Profesional" required><br><input type="text" id="cedprofesional" name="cedprofesional" placeholder="C&eacute;dula Profesional" readonly></td>
										<td>
											<select id="servicio" name="servicio" required="required">
												<option value="">SELECCIONE SERVICIO</option>';
							$x = $servicios->buscardonde('ID_SERVICIO > 0');
							while($x){
								$cont.='
												<option value="'.$servicios->obtener('ID_SERVICIO').'" '.$selected.'>'.$servicios->obtener('DESCRIPCION').'</option>
								';
								$x = $servicios->releer();
							}
							$cont.='
											</select>
										</td>
										<td>
											<input type="radio" id="reservada" name="reservada" value="1" checked> Si <input type="radio" id="reservada" name="reservada" value="0"> No 
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<center>
							<button type="submit" class="btn btn-primary" style="margin-top:8px;">Agregar Nuevo Paciente</button><br>
							<a  href="./?url=domiciliaria_agenda&sbm=1" class="btn btn-primary" style="margin-top:8px;">Ir Agenda</a>
						</center>
					</div>
				</div>
			</form>';

			
	$_SESSION['fecha'] = '';
	$_SESSION['fecha_1'] = '';
	$_SESISON['hora'] = '';
	$_SESSION['cita'] = '';
	$_SESSION['error_profesional'] = '';
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>