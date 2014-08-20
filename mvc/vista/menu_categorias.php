<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');

	$ds = new Diseno();
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	
	$idpaciente = $_GET['id'];
	
	$personas->buscardonde('ID_PACIENTE = '.$idpaciente.'');
	$tiposangre->buscardonde('ID_TIPO_SANGUINEO = '.$personas->obtener('ID_TIPO_SANGUINEO').'');
	
	if ($personas->obtener('ID_SEXO') == 1){
		$sexo = 'MASCULINO';
	}else{
		$sexo = 'FEMENINO';
	}
	if($personas->obtener('ID_TIPO_PACIENTE')){
		$asegurado = 'ASEGURADO';
	}else{
		$asegurado = 'NO ASEGURADO';
	}
	list($anio, $mes, $dia) = explode("-", $personas->obtener('FECHA_NACIMIENTO'));
	$cont.='
				<div class="row-fluid">
					<div class="span4">
						<fieldset>
							<legend>
								Paciente
							</legend>
								<table class="table2">											
									<tr>
										<td colspan="3"><h5>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</h5></td>
									</tr>
									<tr>
										<td>'.$personas->obtener('NO_CEDULA').'</td>
										<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
										<td>'.$sexo.'</td>
									</tr>
									<tr>
										<td>'.$ds->edad($dia,$mes,$anio).' A&ntilde;os</td>									
										<td>'.$personas->obtener('CUIDADOR').'</td>
										<td>'.$personas->obtener('PARENTEZCO_CUIDADOR').'</td>
									</tr>
								</table>
						</fieldset>
					</div>
					<div class="span4">
						<fieldset>
							<legend>
								&Uacute;ltima Consulta
							</legend>
								<table class="table2" style="height:86px;">
									<tr>
										<td></td>
									</tr>
									<tr>
										<td></td>
									</tr>
								</table>
						</fieldset>
					</div>	
					<div class="span4">
						<fieldset>
							<legend>
								ESAS-R
							</legend>
								<table class="table2">											
									<tr>
									</tr>
								</table>
						</fieldset>
					</div>
				</div>		
				<center>
				<div class="centrar_botones">
					<p><a href="./?url=soap&t=1&id='.$idpaciente.'" class="btn btn-primary">Domiciliaria</a></p>  
					<p><a href="./?url=soap&t=2&id='.$idpaciente.'" class="btn btn-primary">Ambulatoria</a></p>  
					<p><a href="./?url=soap&t=3&id='.$idpaciente.'" class="btn btn-primary">Hospitalaria</a></p>  
				</div>
			</center>';

	
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>
