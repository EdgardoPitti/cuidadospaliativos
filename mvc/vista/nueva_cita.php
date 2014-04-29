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
	$id = $_GET['id'];
	
	$hora = $_SESSION['hora_'.$_GET['h'].''];
	$fecha = $_SESSION['fecha'][2].'/'.$_SESSION['fecha'][1].'/'.$_SESSION['fecha'][0].'';
	if(!empty($_SESSION['fecha_1'])){
		$fecha = $_SESSION['fecha_1'];
	}
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
	$cont.='<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Nueva Cita</h3>	
			<form method="POST" action="./?url=agregar_citas&h='.$_GET['h'].'&id='.$id.'&sbm=1">
				<div class="row-fluid">
					<div class="span6" align="center">
						<h5 style="background:#f4f4f4;padding-top:3px;padding-bottom:3px;width:100%;text-align:center;">Paso 1:</h5>
						<label>Seleccione la fecha: </label>
						<input type="date" name="fecha" id="fecha" value="'.$fecha.'" required="required" '.$disabled.'>					
					</div>
					<div class="span6" align="center" >
						<h5 style="background:#f4f4f4;padding-top:3px;padding-bottom:3px;width:100%;text-align:center;">Paso 2:</h5>
						<label>Seleccione el equipo m&eacute;dico: </label>
						<input type="text" name="cod_equipo" id="cod_equipo" placeholder="ID del Equipo M&eacute;dico" value="'.$citas->obtener('ID_EQUIPO_MEDICO').'" required="required" '.$readonly.' >
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<h5 style="background:#f4f4f4;padding-top:3px;padding-bottom:3px;width:100%;text-align:center;">Paso 3:</h5>
						<label>Seleccione el paciente: </label>
						<div class="overflow overthrow" style="width: 100%; min-height: 150px; overflow-y: auto;">
							<table class="table2 borde-tabla">
								<thead>
									<tr class="fd-table">
										<th style="min-width:50px">Hora</th>
										<th style="min-width:250px">Paciente</th>
										<th style="min-width:250px">Profesional</th>
										<th style="min-width:250px">Servicio</th>
										<th style="min-width:100px">Reservada</th>										
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>'.$hora.'<br><input type="hidden" id="hora" name="hora" value="'.$hora.'"></td>
										<td><input type="text" id="paciente" name="paciente" placeholder="Buscar Paciente" value="'.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('SEGUNDO_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').' '.$paciente->obtener('APELLIDO_MATERNO').'" '.$readonly.' required><br><input type="text" id="cedpaciente" name="cedpaciente" value="'.$paciente->obtener('NO_CEDULA').'" placeholder="C&eacute;dula Paciente" readonly></td>
										<td><input type="text" id="profesional" name="profesional" value="'.$profesional->obtener('PRIMER_NOMBRE').' '.$profesional->obtener('SEGUNDO_NOMBRE').' '.$profesional->obtener('APELLIDO_PATERNO').' '.$profesional->obtener('APELLIDO_MATERNO').'" placeholder="Buscar Profesional" '.$readonly.' required><br><input type="text" id="cedprofesional" name="cedprofesional" value="'.$profesional->obtener('NO_CEDULA').'" placeholder="C&eacute;dula Profesional" readonly></td>
										<td>
											<select id="servicio" name="servicio" '.$disabled.' required="required">
												<option value=""></option>';
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
										<td>
											<input type="radio" id="reservada" name="reservada" value="1" checked '.$si.'> Si <input type="radio" id="reservada" name="reservada" value="0" '.$no.'> No 
										</td>
									</tr>
									<tr>										
										<td style="display:none;"><input type="text" id="hora" name="hora" value="'.$hora.'"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<center><button type="submit" class="btn btn-primary" style="margin-top:8px;">Guardar</button></center><br>
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