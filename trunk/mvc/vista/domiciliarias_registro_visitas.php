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
				<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;"><a href="./?url=domiciliaria_visita_realizada&sbm=1" class="btn btn-primary" style="float:left;position:relative;top:-5px;left:10px;" title="Regresar"><i class="icon-arrow-left icon-white"></i></a> Registro de Visitas Domiciliarias</h3>
			';
	if(empty($idrvd)){
		$cont.='
				<center>
					<form method="POST" action="./?url=agregar_datos_rvd&sbm=1">
						<table>
							<tr>
								<td>Fecha: </td>
								<td><input type="date" id="fecha" name="fecha" required="required"></td>
							</tr>
							<tr>
								<td>Instituci&oacute;n: </td>
								<td><select id="institucion" name="institucion" required="required">
										<option value=""></option>
										'.$institucion.'
									</select>
								</td>
							</tr>
							<tr>
								<td>Horas de Atencion: </td>
								<td align="center"><input type="number" id="horas" name="horas" min="1" max="24" style="width:50px;" value="1" required="required"> horas</td>
							</tr>
						</table>						
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
	$cont.='
		<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Pacientes</h3>
			
		<form method="POST" action="./?url=agregar_datos_rvd&sw=3&id='.$idrvd.'&sbm=1">';
		$d = $detalle_rvd->buscardonde('SECUENCIA > 0 AND ID_RVD = '.$idrvd.'');
		if($d){
			$cont.='
			<center>
				<div  class="overflow overthrow">				
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
										<td><input type="text" id="paciente" name="paciente" placeholder="Buscar Paciente" required="required"><br><input type="text" id="cedpaciente" name="cedpaciente" placeholder="C&eacute;dula Paciente" readonly></td>
									</tr>
									<tr>
										<td>Categoria: </td>
										<td><select id="categoria" name="categoria" required="required">
												<option value=""></option>
												'.$categorias.'
											</select>
										</td>
									</tr>
									<tr>
										<td>Observaciones:</td>
										<td><textarea class="textarea" id="observacion" name="observacion" placeholder="Observaciones" required="required"></textarea></td>
									</tr>
								</table>
							</center>
						</fieldset>

					<center>						
						<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;" title="Guardar">Guardar</button>
					</center>
				</form>
		';
	
	}
	
	$_SESSION[idrvd] = '';
	$_SESSION[errorpa] = '';
	$_SESSION[errorprof] = '';
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>