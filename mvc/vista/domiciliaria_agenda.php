<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$_SESSION['error_profesional'] = '';
	$_SESSION['fecha_1'] = '';
	$citas = new Accesatabla('citas_medicas');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$paciente = new Accesatabla('datos_pacientes');
	$servicio = new Accesatabla('servicios_medicos');
	$equipos = new Accesatabla('equipo_medico');
	$sbm = $_GET['sbm'];

	$c = $_GET['c'];
	$contador = $c;
	for($x=0;$x<$c;$x++){
		if($x == 0){
			$next = explode("-",$ds->diasig($ds->dime('dia'), $ds->dime('mes'),$ds->dime('agno')));	
		}else{
			$next = explode("-",$ds->diasig((int)$next[2], (int)$next[1],(int)$next[0]));	
		}
	}
	if(empty($c)){
		$fecha = ''.$ds->dime('dia es').' '.$ds->dime('dia').' de '.$ds->dime('mes-'.$ds->dime('mes').'').' del '.$ds->dime('agno').'';
		$next[0] = $ds->dime('agno');
		$next[1] = $ds->dime('mes');
		$next[2] = $ds->dime('dia');
		
	}else{
		$fecha = ''.$ds->diasdespues(''.$c.'').' '.$next[2].' de '.$ds->dime('mes-'.$next[1].'').' del '.$next[0].'';
	}
	$date = $next[0].'-'.$next[1].'-'.$next[2];
	$_SESSION['fecha'] = $next;
	if(!empty($_POST['fecha'])){
		$var = explode("-",$_POST['fecha']);
		$fecha = $var[2].' de '.$ds->dime('mes-'.$var[1].'').' del '.$var[0].'';
		$date = $_POST['fecha'];
		$_SESSION['fecha'] = $var;
		$fechaelegida = $_POST['fecha'];
	}else{
		$fechaelegida = $ds->dime('agno').'-'.$ds->dime('mes').'-'.$ds->dime('dia');
	}

	
	$cont='
		<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Agenda de Citas M&eacute;dicas</h3>		
		<center>
			<form method="POST" action="./?url=domiciliaria_agenda&sbm='.$sbm.'">
					Fecha: <input type="date" id="fecha" name="fecha" placeholder="AAAA-MM-DD" max="2025-12-31" min="2010-01-01" value="'.$_POST['fecha'].'"><br>
					ID Equipo M&eacute;dico: <select id="equipo" name="equipo">
												<option value="0">SELECCIONE</option>';
	$e = $equipos->buscardonde('ID_EQUIPO_MEDICO > 0');
	while($e){
		if($_POST['equipo'] == $equipos->obtener('ID_EQUIPO_MEDICO')){
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
					<br>
					<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
			</form>
			<b style="float:none;clear:both">Citas del '.$fecha.'</b>	
		</center>';
		
		$cita_paciente = $citas->buscardonde('FECHA = "'.$date.'" AND RESERVADA = 1');
		if($cita_paciente != false) {
			$cont.='
			<div style="float:right;postion:absolute;right:0px;top:0px;bottom:0px">
				<a href="datospdf.php?agenda=1&imprimir=1&fecha='.$fechaelegida.'" title="Imprimir Agenda" class="btn btn-default" target="_blank" onclick="window.open(this.href); return false;"><img src="./iconos/imprimir.png" width="24px"> Imprimir</a>
				<a href="datospdf.php?agenda=1&fecha='.$fechaelegida.'" title="Descargar Agenda" class="btn btn-default"><img src="./iconos/download.png" width="24px"> Descargar</a>
			</div>';
		}else {
			$cont.='
			<span style="text-align:center;">				
				<div style="color:RED;padding-top:7px">No existen citas registradas en este d&iacute;a.</div>
			</span>';
		}
		$cont.='
		<div class="row-fluid overthrow" style="width: 100%; height: 520px; overflow-y: scroll;float:none;clear:both">
			<div class="span2">
				<a href="./?url=domiciliaria_agenda&sbm='.$sbm.'" title="Ir a Dia" style="background:none;border:none;text-decoration:none;">				
					<article class="agenda">
						<center>
							<h2>'.$ds->dime('dia es').'</h2>
							<h1>'.$ds->dime('dia').'</h1>
							<h5>'.$ds->dime('mes-'.$ds->dime('mes').'').' '.$ds->dime('agno').'</h5>
						</center>
					</article>
				</a>';
	$x = 1; 
	while($x < 6){
		if($x == 1){
			$next = explode("-",$ds->diasig($ds->dime('dia'), $ds->dime('mes'),$ds->dime('agno')));	
		}else{
			$next = explode("-",$ds->diasig($next[2], $next[1],$next[0]));	
		}
		$cont.='
						<a href="./?url=domiciliaria_agenda&c='.$x.'&sbm='.$sbm.'" title="Ir a Dia" style="background:none;border:none;text-decoration:none;">
							<article class="agenda">
								<center>
									<h2>'.$ds->diasdespues(''.$x.'').'</h2>
									<h1>'.$next[2].'</h1>
									<h5>'.$ds->dime('mes-'.(int)$next[1].'').' '.$next[0].'</h5>
								</center>
							</article>
						</a>
						';		
		$x++;
	}
	$cont.='
			</div>
			<div class="span10" style="margin-top:10px;">
				<div class="overflow overthrow">
					<table class="table borde-tabla">';

	for($x=0;$x<20;$x++){
		$hora = $_SESSION['hora_'.$x.''];
		$cont.='
						<tr>
							<td width="70px" style="background:#d9d9d9;font-weight:bold;padding-top:15px">'.$hora.'</td>
		';
		if(empty($_POST['equipo'])){
			$condicion = '';
		}else{
			$condicion = 'AND ID_EQUIPO_MEDICO = '.$_POST['equipo'].'';
		}
		$cita_paciente = $citas->buscardonde('FECHA = "'.$date.'" AND HORA = "'.$hora.'" AND RESERVADA = 1 '.$condicion.'');
		if($cita_paciente){
			$cont.='
								<td>
						<div class="overflow overthrow" style="max-height:170px;padding:0px 5px;" align="center">
							<table class="table2 borde-tabla table-hover" style="width:100%;">
								<thead>
									<tr class="fd-table">
										<th>C&eacute;dula</th>
										<th>Paciente</th>
										<th>Profesional</th>
										<th>Servicio</th>
										<th style="min-width:20px"></th>
									</tr>
								</thead>
			';
			while($cita_paciente){
				$paciente->buscardonde('ID_PACIENTE = '.$citas->obtener('ID_PACIENTE').'');
				$profesional->buscardonde('ID_PROFESIONAL = '.$citas->obtener('ID_PROFESIONAL').'');
				$servicio->buscardonde('ID_SERVICIO = '.$citas->obtener('ID_SERVICIO').'');
				$cont.='
						
								<tbody>
									<tr>
										<td>'.$paciente->obtener('NO_CEDULA').'</td>
										<td>'.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('SEGUNDO_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').' '.$paciente->obtener('APELLIDO_MATERNO').'</td>
										<td>'.$profesional->obtener('PRIMER_NOMBRE').' '.$profesional->obtener('SEGUNDO_NOMBRE').' '.$profesional->obtener('APELLIDO_PATERNO').' '.$profesional->obtener('APELLIDO_MATERNO').'</td>
										<td>'.$servicio->obtener('DESCRIPCION').'</td>
										<td><a href="./?url=nueva_cita&id='.$citas->obtener('ID_CITA').'&sbm='.$sbm.'" title="Editar Cita" class="btn btn-primary"><i class="icon-edit icon-white"></i></a></td>
									</tr>
								</tbody>							
				';
				$cita_paciente = $citas->releer();
			}
			$cont.='			
							</table>
						</div>
									<a href="./?url=nueva_cita&h='.$x.'&sbm='.$sbm.'&c='.$contador.'" title="Nueva Citra a las '.$hora.'"><img src="./iconos/plus.png"></a>
								</td>';
		}else{
			$cont.='		
							<td style="width:350px;height:30px;;text-align:left;padding-top:10px;text-align:center;">
								<a href="./?url=nueva_cita&h='.$x.'&sbm='.$sbm.'&c='.$contador.'" title="Nueva Citra a las '.$hora.'"><img src="./iconos/plus.png"></a>
							</td>';
		}
		$cont.='		</tr>';
		
	}
	$cont.='
					</table>
				</div>
			</div>
		</div>
	';
	
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>
