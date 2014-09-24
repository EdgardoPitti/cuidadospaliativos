<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');

	$ds = new Diseno();
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$datos_escala = new Accesatabla('escala_edmonton');
	$soap = new Accesatabla('soap');
	$det_soap = new Accesatabla('detalle_soap');
	$cuidados = new Accesatabla('cuidados_tratamientos');
	$recetas = new Accesatabla('recetas_medicas');
	$det_recetas = new Accesatabla('detalle_receta');	
	$medicamentos = new Accesatabla('medicamentos');
	$frecuencia = new Accesatabla('frecuencias_tratamientos');
	$verbos = new Accesatabla('verbos_recetas');
	$periodo = new Accesatabla('periodo_tratamiento');
	$idpaciente = $_GET['id'];
	
	$personas->buscardonde('ID_PACIENTE = '.$idpaciente.'');
	$tiposangre->buscardonde('ID_TIPO_SANGUINEO = '.$personas->obtener('ID_TIPO_SANGUINEO').'');
	$sql = 'SELECT max(ID_SOAP) as ID from soap WHERE ID_PACIENTE = '.$idpaciente.'';
	$matriz = $ds->db->obtenerArreglo($sql);
	$id_soap = $matriz[0][ID];
	$soap->buscardonde('ID_SOAP = '.$id_soap.'');
	list($agno, $month, $day) = explode("-", $soap->obtener('FECHA'));

	$det_soap->buscardonde('ID_SOAP = '.$id_soap.'');
	/*rellenar campos de cuidados y tratamientos*/	
	$cuidados->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS'));	
	$recetas->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS').'');
	$det_recetas->buscardonde('ID_RECETA = '.$recetas->obtener('ID_RECETA').'');
	$medicamentos->buscardonde('ID_MEDICAMENTO = '.$det_recetas->obtener('ID_MEDICAMENTO').'');		
	$verbos->buscardonde('ID_VERBO = '.$det_recetas->obtener('ID_DOSIS').'');
	$frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO = '.$det_recetas->obtener('ID_FRECUENCIA_TRATAMIENTO').'');	
	$periodo->buscardonde('ID_PERIODO = '.$det_recetas->obtener('ID_PERIODO_TRATAMIENTO').'');
	if(!empty($medicamentos->obtener('ID_MEDICAMENTO'))){
		$tratamiento = ''.$verbos->obtener('DESCRIPCION').' '.$det_recetas->obtener('DOSIS').' '.$medicamentos->obtener('DESCRIPCION').' '.$frecuencia->obtener('ABREVIATURA').' POR '.$det_recetas->obtener('TRATAMIENTO').' '.$periodo->obtener('DESCRIPCION').'';
		$cuidado = $cuidados->obtener('CUIDADOS');
	}else{
		$cuidado = 'No posee Cuidado';
		$tratamiento = 'No posee Tratamiento';
	}
	
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
					<a href="./?url=inicio" class="btn btn-primary pull-left" style="position:relative;top:-5px;left:10px;" title="Regresar"><i class="icon-arrow-left icon-white"></i></a>					
				</div>
				<div class="row-fluid">
					<div class="span4">
						<fieldset>
							<legend>
								Datos del Paciente
							</legend>
								<div class="row-fluid" style="margin-top:-10px;padding-bottom:5px">
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
							</legend>';
							if(empty($id_soap)){
								$cont.='<div style="color:red;text-align:center;height:90px;padding-top:30px;">No se le ha registrado consulta a este paciente.</div>';
							}else{
								$cont.='
									<div style="margin-top:-7px;">	
										<table class="table2" style="height:86px;margin-bottom:0px;">
											<tr>
												<td><b>'.$day.' / '.$ds->dime('mes-'.$month).' / '.$agno.'</b></td>
											</tr>
											<tr>
												<td><b>Motivo Consulta:</b> '.$soap->obtener('MOTIVO_CONSULTA').'</td>
											</tr>
											<tr>
												<td style="text-align:left;font-weight:bold;padding-left:10px;">Cuidados y Tratamientos</td>										
											</tr>
											<tr>
													<td><b>Cuidado:</b>'.$cuidado.'</td>
											</tr>
											<tr>
												<td>'.$tratamiento.'</td>									
											</tr>	
										</table>
									</div>';

							}						
							$cont.='
						</fieldset>
					</div>	
					<div class="span4">
						<fieldset>
							<legend>
								ESAS-R
							</legend>
								<div style="padding-bottom:17px">';
								if(empty($id_soap)){
									$cont.='<div style="color:red;text-align:center;height:73px;padding-top:30px;">No se ha registrado escalas para este paciente.</div>';
								}else{
										$cont.='
											<table class="table2">											
												<tr>
													<td><b>'.$day.' / '.$ds->dime('mes-'.$month).' / '.$agno.'</b></td>
												</tr>
											</table>
											<div class="overthrow" style="overflow:auto;height:75px;margin-top:-5px;text-align:center;">';
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
										if($sw == 0) {
											$cont.='No existen valores de ESAS-R para este paciente';						
										}else {
											$cont.= '';						
										}			
										$cont.='	
										</div>';
								}
							$cont.='
								</div>
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
