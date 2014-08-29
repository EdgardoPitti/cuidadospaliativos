<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');

	$ds = new Diseno();
	$t = $_GET['t'];
	$idpaciente = $_GET['id'];
	$idsoap = $_GET['idsoap'];
	if(!empty($idsoap)) {
		$ids = '&idsoap='.$idsoap.'';
	}else {
		$ids='';						
	}
	
	$datos_escala = new Accesatabla('escala_edmonton');
	$paciente = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$soap = new Accesatabla('soap');
	$det_soap = new Accesatabla('detalle_soap');
	
	$paciente->buscardonde('ID_PACIENTE = '.$idpaciente.'');
	if ($paciente->obtener('ID_SEXO') == 1){
		$sexo = 'MASCULINO';
	}else{
		$sexo = 'FEMENINO';
	}
	list($anio, $mes, $dia) = explode("-", $paciente->obtener('FECHA_NACIMIENTO'));
	
	$soap->buscardonde('ID_SOAP = '.$idsoap.'');
	$sql = 'SELECT MAX(ID_ESCALA) AS ID FROM detalle_soap WHERE ID_SOAP = '.$idsoap.'';
	$arreglo = $ds->db->obtenerArreglo($sql);
	$idescala = $arreglo[0][ID];
	$datos_escala->buscardonde('ID_ESCALA = '.$idescala.'');	
									
	$cont.='
				<div class="row-fluid">
					<a href="./?url=menu_categorias&id='.$idpaciente.'" class="btn btn-primary pull-left" style="float:left;position:relative;top:-5px;left:10px;" title="Regresar"><i class="icon-arrow-left icon-white"></i></a>
				</div>
				<div class="row-fluid">
					<div class="span4" style="margin-bottom:5px;">
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
												<td><strong>'.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('SEGUNDO_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').' '.$paciente->obtener('APELLIDO_MATERNO').'</strong></td>
											</tr>
											<tr>
												<td>'.$paciente->obtener('NO_CEDULA').'</td>
											</tr>
											<tr>													
												<td>'.$ds->edad($dia,$mes,$anio).' A&ntilde;os</td>									
											</tr>
											</tr>
												<td>'.$sexo.'</td>
											<tr>
											<tr>
												<td><strong>Cuidador:</strong> '.$paciente->obtener('CUIDADOR').'</td>
											</tr>
											<tr>
												<td><strong>Parentezco:</strong> '.$paciente->obtener('PARENTEZCO_CUIDADOR').'</td>
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
				
				<div class="row-fluid">
					<div class="panel panel-primary">
						<div class="panel-header">
							<h5>Subjetivo</h5>
						</div>
						<div class="panel-body">							
							<center>';
							if(empty($motivo)){
								$value = $soap->obtener('MOTIVO_CONSULTA');								
							}else{
								$value = '';									
							}
							$cont.='
								<form class="form-inline" method="POST" action="./?url=agregarsoap&id='.$idpaciente.'&sw=1&t='.$t.''.$ids.'">
									Motivo de la Consulta:
									<textarea name="motivo" placeholder="Motivo de la Consulta">'.$value.'</textarea>
									<button type="submit" class="btn btn-primary" style="margin-top:10px">Guardar</button>
								</form>
							</center>
						</div>
					</div> 
				</div>
				<div class="row-fluid">
					<div class="panel panel-primary">
						<div class="panel-header">
							<h5>Objetivo</h5>
						</div>
						<div class="panel-body">
							<center>';
							if(empty($motivo)){						
								$value = $soap->obtener('OBJETIVO_CONSULTA');
							}else{
								$value = '';							
							}
							$cont.='
								<form class="form-inline" method="POST" action="./?url=agregarsoap&id='.$idpaciente.'&sw=2&t='.$t.''.$ids.'">
									Objetivo de la Consulta:
									<textarea name="objetivo" placeholder="Objetivo de la Consulta">'.$value.'</textarea>
									<button type="submit" class="btn btn-primary" style="margin-top:10px">Guardar</button>
								</form>
							</center>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="panel panel-primary">
						<div class="panel-header">
							<h5>ESAS-R</h5>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="span2 offset4">
									<table class="table2">											
										<tr>
											<td align="center">
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
											</tr>
										</table>							
									</div>
									<div class="span2">
										<center style="margin-bottom:15px;">
											<a href="./?url=escala_edmont&idp='.$idpaciente.'&sw=1'.$ids.'" class="btn btn-primary">Escala EDMONTON</a>
										</center>								
									</div>
								</div>
							</div>						
					</div>
				</div>
				<div class="row-fluid">
					<div class="panel panel-primary">
						<div class="panel-header">
							<h5>Impresi&oacute;n Diagn&oacute;stica</h5>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="span8 offset2">
									<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
										<table class="table2 borde-tabla">
											<thead>											
												<tr class="fd-table">
													<th>Diagn&oacute;stico</th>
													<th>CIE-10</th>
													<th>Observaciones</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="text" name="diagnostico1" id="diagnostico1"></td>
													<td><input type="text" name="cie1" id="cie1" readonly></td>
													<td><input type="text" name="observaciones" id="observaciones"></td>
													<td><a href="" class="btn btn-primary" title="A&ntilde;adir Diagn&oacute;stico">A&ntilde;adir Diagn&oacute;stico</a></td>
												</tr>
											</tbody>
										</table>
									</div>					
								</div>
							</div>			
						</div>
					</div>				
				</div>
				<div class="row-fluid">
					<div class="panel panel-primary">
						<div class="panel-header">
							<h5>Cuidados/Tratamientos</h5>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="span3 offset4 bordediv">
									<table class="table2" style="margin-right:20px">											
										<tr>
											<td>Cuidados</td>
										</tr>
										<tr>
											<td><textarea name="cuidados" placeholder="Cuidados"></textarea></td>
										</tr>
									</table>					
								</div>
								<div class="span2">
									<table class="table2">											
										<tr>
											<td>Medicamentos</td>
										</tr>
										<tr>
											<td>
												<input type="text" name="medicamentos" id="medicamentos" placeholder="Medicamentos">
												<input type="hidden" name="idmedicamentos" id="idmedicamentos">
											</td>										
										</tr>
										<tr>											
											<td><button type="submit" class="btn btn-primary">Guardar</button></td>
										</tr>
									</table>	
								</div>
							</div>			
						</div>
					</div>				
				</div>
				<div class="row-fluid">
					<div class="panel panel-primary">
						<div class="panel-header">
							<h5>Observaciones</h5>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="span3 offset4">
									<table class="table2">											
										<tr>
											<td>Observaciones</td>
										</tr>
										<tr>
											<td><textarea name="observaciones" placeholder="Observaciones"></textarea></td>
										</tr>
									</table>										
								</div>
								<div class="span2">
									<table class="table2">											
										<tr>
											<td>SURCO</td>
										</tr>
										<tr>
											<td><a href="./?url=domiciliaria_surco&idp='.$idpaciente.'" class="btn btn-primary">SURCO</a></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>';
	
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>
