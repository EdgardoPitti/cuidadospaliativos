<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');

	$ds = new Diseno();
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$datos_escala = new Accesatabla('escala_edmonton');
	$soap = new Accesatabla('soap');
	$det_soap = new Accesatabla('detalle_soap');
	$idpaciente = $_GET['id'];
	
	$personas->buscardonde('ID_PACIENTE = '.$idpaciente.'');
	$tiposangre->buscardonde('ID_TIPO_SANGUINEO = '.$personas->obtener('ID_TIPO_SANGUINEO').'');
	$sql = 'SELECT max(ID_SOAP) as ID from soap WHERE ID_PACIENTE = '.$idpaciente.'';
	$matriz = $ds->db->obtenerArreglo($sql);
	$id_soap = $matriz[0][ID];
	$soap->buscardonde('ID_SOAP = '.$id_soap.'');
	$det_soap->buscardonde('ID_SOAP = '.$id_soap.'');
	list($agno, $month, $day) = explode("-", $soap->obtener('FECHA'));
	
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
				<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;"><a href="./?url=inicio" class="btn btn-primary pull-left" style="position:relative;top:-5px;left:10px;" title="Regresar"><i class="icon-arrow-left icon-white"></i></a>Historial Cl&iacute;nico</h3>					
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
										<td><b>'.$day.' / '.$ds->dime('mes-'.$month).' / '.$agno.'</b></td>
									</tr>
									<tr>
										<td><b>Motivo Consulta:</b> '.$soap->obtener('MOTIVO_CONSULTA').'</td>
									</tr>
									<tr>
										<td style="text-align:left;font-weight:bold;padding-left:10px;">Cuidados y Tratamientos</td>
										
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
										<td><b>'.$day.' / '.$ds->dime('mes-'.$month).' / '.$agno.'</b></td>
									</tr>
									<tr>
										<td>';
							$datos_escala->buscardonde('ID_ESCALA = '.$det_soap->obtener('ID_ESCALA').'');
							
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
										
							$cont.='	</td>
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
