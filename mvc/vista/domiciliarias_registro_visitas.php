<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$instituciones = new Accesatabla('institucion');
	$rvd = new Accesatabla('registro_visitas_domiciliarias');
	$detalle_rvd = new Accesatabla('detalle_registro_visitas_domiciliarias');
	$paciente = new Accesatabla('datos_pacientes');
	$equipo = new Accesatabla('detalle_equipo_medico');
	$especialidad = new Accesatabla('especialidades_medicas');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$programa = new Accesatabla('programa');
	$categoria = new Accesatabla('categoria');
	
	$idrvd = $_GET['id'];
	if(empty($idrvd)){
		$idrvd = $_SESSION[idrvd];
	}
	$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
	while($i){
		$institucion .='
							<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$instituciones->obtener('DENOMINACION').'</option>
		';
		$i = $instituciones->releer();
	}
	$cont.='
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Registro de Visitas Domiciliarias</h3>
			';
	if(empty($idrvd)){
		$cont.='
				<center>
					<form method="POST" action="./?url=agregar_datos_rvd">
						<table>
							<tr>
								<td>Fecha: </td>
								<td><input type="date" id="fecha" name="fecha"></td>
							</tr>
							<tr>
								<td>Instituci&oacute;n: </td>
								<td><select id="institucion" name="institucion">
										<option value=""></option>
										'.$institucion.'
									</select>
								</td>
							</tr>
							<tr>
								<td>Horas de Atencion: </td>
								<td align="center"><input type="number" id="horas" name="horas" min="1" max="24" style="width:50px;" value="1"> horas</td>
							</tr>
						</table>
						<a href="./?url=domiciliaria_visita_realizada" class="btn btn-default" style="margin-top:5px;" title="Regresar">Regresar</a>
						<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;">Guardar</button>
					</form>
				</center>';			
	}else{
		$rvd->buscardonde('ID_RVD = '.$idrvd.'');
		$instituciones->buscardonde('ID_INSTITUCION = '.$rvd->obtener('ID_INSTITUCION').'');
		$cont.='			<table width="100%">
								<tr align="center">
									<td><b>Fecha:</b> '.$rvd->obtener('FECHA').'</td>
								</tr>
								<tr align="center">
									<td><b>Instalaci&oacute;n:</b> '.$instituciones->obtener('DENOMINACION').'<td>
								</tr>
								<tr align="center">
									<td><b>Horas de Atencion:</b> '.$rvd->obtener('HORAS_DE_ATENCION').' horas</td>
								</tr>
							</table>';
		$e = $equipo->buscardonde('ID_EQUIPO_MEDICO = '.$rvd->obtener('ID_EQUIPO_MEDICO').'');
		$n = 1;
		if($e){
			$cont.='	
							
							<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Equipo M&eacute;dico</h3>
							<table class="tabla-datos borde-tabla">
								<tr class="fd-tabla-gris">
									<th>N&ordm;</th>
									<th>Especialidad M&eacute;dica</th>
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
			$cont.='<br><div style="color:RED;text-align:center">No existe equipo m&eacute;dico para esta Actividad</div>';
		}
		$cont.='
			<center>
				<form class="form-search" method="POST" action="./?url=agregar_datos_rvd&sw=2&id='.$idrvd.'">
					<table class="tabla-datos">
						<tr align="center">
							<td>Nombre Profesional:</td>
							<td>
								<input type="search" class="form-control" id="profesional" name="profesional" placeholder="Buscar Profesional">
								<input type="text" id="cedprofesional" name="cedprofesional" placeholder="C&eacute;dula Profesional" readonly>
							</td>
							<td><button style="background:none;border:none;"><img src="./iconos/add_profesional.png" title="Guardar Profesional"></button></td>
						</tr>					
					</table>
					<center>'.$_SESSION[errorprof].'</center>				
				</form>
			</center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Pacientes</h3>
					
				<form method="POST" action="./?url=agregar_datos_rvd&sw=3&id='.$idrvd.'">';
		$d = $detalle_rvd->buscardonde('SECUENCIA > 0 AND ID_RVD = '.$idrvd.'');
		if($d){
			$cont.='
			<center>
				<div  class="overflow" id="overflow-movil">
				
					<table class="table2 borde-tabla table-hover">
						<thead>
							<tr class="fd-table">
								<th>Paciente</th>
								<th>Programa</th>
								<th>Categoria</th>
								<th>Observaciones</th>
							</tr>
						</thead>
				';
				while($d){
					$paciente->buscardonde('ID_PACIENTE = '.$detalle_rvd->obtener('ID_PACIENTE').'');
					$segundon = $paciente->obtener('SEGUNDO_NOMBRE');
					$segundoa = $paciente->obtener('APELLIDO_MATERNO');
					$categoria->buscardonde('ID_CATEGORIA = '.$detalle_rvd->obtener('ID_CATEGORIA').'');
					$programa->buscardonde('ID_PROGRAMA = '.$detalle_rvd->obtener('ID_PROGRAMA').'');
					$cont.='
						<tbody>
							<tr>
								<td>'.$paciente->obtener('PRIMER_NOMBRE').' '.$segundon[0].'. '.$paciente->obtener('APELLIDO_PATERNO').' '.$segundoa[0].'.</td>
								<td>'.$categoria->obtener('CATEGORIA').'</td>
								<td>'.$programa->obtener('PROGRAMA').'</td>
								<td>'.$detalle_rvd->obtener('OBSERVACIONES').'</td>
							</tr>
						</tbody>
					';
					$d = $detalle_rvd->releer();
				}
				$cont.='
					</table>
				</div>
			</center>
			';
		}
		$c = $categoria->buscardonde('ID_CATEGORIA > 0 ORDER BY ID_PROGRAMA');
		while($c){
			$programa->buscardonde('ID_PROGRAMA = '.$categoria->obtener('ID_PROGRAMA').'');
			$categorias .= '
							<option value="'.$categoria->obtener('ID_CATEGORIA').'">'.$categoria->obtener('CATEGORIA').' - '.$programa->obtener('PROGRAMA').'</option>
			';
			$c = $categoria->releer();
		}
		$cont.='
					
						<span style="text-align:center;">'.$_SESSION[errorpa].'</span>
						<fieldset>
							<legend>
								A&ntilde;adir Paciente
							</legend>
							<center>
								<table>
									<tr>
										<td>Paciente: </td> 
										<td><input type="text" id="paciente" name="paciente" placeholder="Buscar Paciente"><br><input type="text" id="cedpaciente" name="cedpaciente" placeholder="C&eacute;dula Paciente" readonly></td>
									</tr>
									<tr>
										<td>Categoria: </td>
										<td><select id="categoria" name="categoria">
												<option value=""></option>
												'.$categorias.'
											</select>
										</td>
									</tr>
									<tr>
										<td>Observaciones:</td>
										<td><textarea class="textarea" id="observacion" name="observacion" placeholder="Observaciones"></textarea></td>
									</tr>
								</table>
							</center>
						</fieldset>

					<center>
						<a href="./?url=domiciliaria_visita_realizada" class="btn btn-default" style="margin-top:5px;" title="Regresar">Regresar</a>
						<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;" title="Guardar">Guardar</button>
					</center>
				</form>
		';
	
	}
	
	$_SESSION[idrvd] = '';
	$_SESSION[errorpa] = '';
	$_SESSION[errorprof] = '';
	$ds->contenido($cont);
	$ds->mostrar();
?>