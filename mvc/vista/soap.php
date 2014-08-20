<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');

	$ds = new Diseno();
	$t = $_GET['t'];
	$idpaciente = $_GET['id'];
	
	$datos_escala = new Accesatabla('escala_edmonton');
	$paciente = new Accesatabla('datos_pacientes');
	$sql = 'SELECT MAX(ID_ESCALA) AS ID FROM escala_edmonton WHERE ID_PACIENTE = '.$idpaciente.'';
	$arreglo = $ds->db->obtenerArreglo($sql);
	$idescala = $arreglo[0][ID];
	$datos_escala->buscardonde('ID_ESCALA = '.$idescala.'');
	$paciente->buscardonde('ID_PACIENTE = '.$idpaciente.'');
	$cont.='
				Paciente: '.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').'
				<div class="row-fluid">
					<div class="span12">
						<fieldset>
							<legend>
								Objetivo
							</legend>
								<table class="table2">											
									<tr>
										<td>Motivo de la Consulta:</td>
										<td><textarea name="motivo" placeholder="Motivo de la Consulta"></textarea></td>
										<td><button class="btn btn-primary">Guardar</button></td>
									</tr>
								</table>
						</fieldset>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<fieldset>
							<legend>
								Objetivo
							</legend>
								<table class="table2">											
									<tr>
										<td>Objetivo de la Consulta:</td>
										<td><textarea name="objetivo" placeholder="Objetivo de la Consulta"></textarea></td>
										<td><button class="btn btn-primary">Guardar</button></td>
									</tr>
								</table>
						</fieldset>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<fieldset>
							<legend>
								ESAS-R
							</legend>
								<table class="table2">											
									<tr>
										<td>
										';
	$sw = 0;
	if($datos_escala->obtener('DOLOR') >= 7){
		$cont.= 'Dolor: '.$datos_escala->obtener('DOLOR').'';
		$sw = 1;
	}	
	if($datos_escala->obtener('CANSANCIO') >= 7){
		if($sw == 1){
			$cont.='<br>';
		}else{
			$sw = 1;
		}
		$cont.='Cansancio: '.$datos_escala->obtener('CANSANCIO').'';
	}
	if($datos_escala->obtener('NAUSEA') >= 7){
		if($sw == 1){
			$cont.='<br>';
		}else{
			$sw = 1;
		}
		$cont.='Nausea: '.$datos_escala->obtener('NAUSEA').'';
	}
	if($datos_escala->obtener('DEPRESION') >= 7){
		if($sw == 1){
			$cont.='<br>';
		}else{
			$sw = 1;
		}
		$cont.='Depresion: '.$datos_escala->obtener('DEPRESION').'';
	}
	if($datos_escala->obtener('ANSIEDAD') >= 7){
		if($sw == 1){
			$cont.='<br>';
		}else{
			$sw = 1;
		}
		$cont.='Ansiedad: '.$datos_escala->obtener('ANSIEDAD').'';
	}
	if($datos_escala->obtener('SOMNOLENCIA') >= 7){
		if($sw == 1){
			$cont.='<br>';
		}else{
			$sw = 1;
		}
		$cont.='Somnolencia: '.$datos_escala->obtener('SOMNOLENCIA').'';
	}
	if($datos_escala->obtener('APETITO') >= 7){
		if($sw == 1){
			$cont.='<br>';
		}else{
			$sw = 1;
		}
		$cont.='Apetito: '.$datos_escala->obtener('APETITO').'';
	}
	if($datos_escala->obtener('BIENESTAR') >= 7){
		if($sw == 1){
			$cont.='<br>';
		}else{
			$sw = 1;
		}
		$cont.='Bienestar: '.$datos_escala->obtener('BIENESTAR').'';
	}
	if($datos_escala->obtener('AIRE') >= 7){
		if($sw == 1){
			$cont.='<br>';
		}else{
			$sw = 1;
		}
		$cont.='Aire: '.$datos_escala->obtener('AIRE').'';
	}
	if($datos_escala->obtener('DORMIR') >= 7){
		if($sw == 1){
			$cont.='<br>';
		}else{
			$sw = 1;
		}
		$cont.='Dormir: '.$datos_escala->obtener('DORMIR').'';
	}

	$cont.='
										</td>
										<td><a href="./?url=escala_edmont&idp='.$idpaciente.'&sw=1" class="btn btn-primary">Escala EDMONTON</a></td>
									</tr>
								</table>
						</fieldset>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<fieldset>
							<legend>
								Impresi&oacute;n Diagn&oacute;stica
							</legend>
								<table class="table2">											
									<tr>
										<td>Cuidados</td>
										<td>Medicamentos</td>
									</tr>
									<tr>
										<td><textarea name="cuidados" placeholder="Cuidados"></textarea></td>
										<td><button class="btn btn-primary">Guardado</button></td>
									</tr>
								</table>
						</fieldset>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<fieldset>
							<legend>
								Observaciones
							</legend>
								<table class="table2">											
									<tr>
										<td>Observaciones</td>
										<td>SURCO</td>
									</tr>
									<tr>
										<td><textarea name="observaciones" placeholder="Observaciones"></textarea></td>
										<td><a href="./?url=domiciliaria_surco&idp='.$idpaciente.'" class="btn btn-primary">SURCO</a></td>
									</tr>
								</table>
						</fieldset>
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
