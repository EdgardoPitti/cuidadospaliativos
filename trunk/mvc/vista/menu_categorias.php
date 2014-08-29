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
					<a href="./?url=inicio" class="btn btn-primary pull-left" style="float:left;position:relative;top:-5px;left:10px;" title="Regresar"><i class="icon-arrow-left icon-white"></i></a>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<fieldset>
							<legend>
								Datos del Paciente
							</legend>
								<div class="row-fluid" style="margin-top:-15px;">
									<div class="span6">
										<center>
											<img src="./iconos/paciente.png" style="max-height:110px">
										</center>
									</div>
									<div class="span6">
										<table>											
											<tr>
												<td><strong>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</strong></td>
											</tr>
											<tr>
												<td>'.$personas->obtener('NO_CEDULA').'</td>
											</tr>
											<tr>													
												<td>'.$ds->edad($dia,$mes,$anio).' A&ntilde;os</td>									
											</tr>
											</tr>
												<td>'.$sexo.'</td>
											<tr>
											<tr>
												<td><strong>Cuidador:</strong> '.$personas->obtener('CUIDADOR').'</td>
											</tr>
											<tr>
												<td><strong>Parentezco:</strong> '.$personas->obtener('PARENTEZCO_CUIDADOR').'</td>
											</tr>
										</table>
									</div>								
								</div>								
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
