<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();

	$idpaciente = $_GET['id'];	
	$idsoap = $_GET['idsoap'];
	$t = $_GET['t'];
	$datos_escala = new Accesatabla('escala_edmonton');
	$paciente = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');	
	$soap = new Accesatabla('soap');
	$det_soap = new Accesatabla('detalle_soap');
	$imp_diag = new Accesatabla('impresion_diagnostica');
	$det_imp_diag = new Accesatabla('detalle_impresion_diagnostica');
	$cie10 = new Accesatabla('cie10');
	$formas = new Accesatabla('formas_farmaceuticas');
	$cuidados = new Accesatabla('cuidados_tratamientos');
	$recetas = new Accesatabla('recetas_medicas');
	$det_recetas = new Accesatabla('detalle_receta');	
	$medicamentos = new Accesatabla('medicamentos');
	$vias = new Accesatabla('vias_administracion');	
	$frecuencia = new Accesatabla('frecuencias_tratamientos');
	$verbos = new Accesatabla('verbos_recetas');
	$unidad = new Accesatabla('unidades_medida');
	$periodo = new Accesatabla('periodo_tratamiento');
	$cuadro_medicamento = new Accesatabla('tipos_cuadros_medicamentos');
	$medicamentos = new Accesatabla('medicamentos');
	
	$paciente->buscardonde('ID_PACIENTE = '.$idpaciente.'');
	if ($paciente->obtener('ID_SEXO') == 1){
		$sexo = 'MASCULINO';
	}else{
		$sexo = 'FEMENINO';
	}
	list($anio, $mes, $dia) = explode("-", $paciente->obtener('FECHA_NACIMIENTO'));

	$cont='
		<div class="row-fluid">
			<h2 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;"><a href="./?url=soap&id='.$idpaciente.'&t='.$t.'" class="btn btn-primary pull-left" title="Regresar" style="position:relative;top:-5px;left:10px;"><i class="icon-arrow-left icon-white"></i></a>Historia Cl&iacute;nica</h2>	
		</div>
		<div class="row-fluid" style="border:1px solid #e3e3e3;margin-top:-10px;width:99.9%;">
			<div class="span12" style="margin:15px 0px 0px 15px;">					
				<h3 style="text-decoration:underline;">Datos del Paciente</h3>
				<div class="row-fluid">
					<div class="span4">
						Nombre: <span style="text-decoration:underline;">'.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('SEGUNDO_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').' '.$paciente->obtener('APELLIDO_MATERNO').'</span>											
					</div>
					<div class="span4">
						Edad: <span style="text-decoration:underline;">'.$ds->edad($dia,$mes,$anio).' A&ntilde;os </span> Sexo: <span style="text-decoration:underline;">'.$sexo.'</span>									
					</div>
					<div class="span4">
						Cuidador: <span style="text-decoration:underline;">'.$paciente->obtener('CUIDADOR').'</span> Parentezco: <span style="text-decoration:underline;">'.$paciente->obtener('PARENTEZCO_CUIDADOR').'</span>
					</div>				
				</div>
				<div class="row-fluid">
					<h3 style="background:#e9e9e9;padding-top:7px;margin-left:-15px;padding-bottom:7px;width:100%;text-align:center;">Datos SOAP</h3>	
				</div>	
				<div class="overflow overthrow" style="width:94%;">			
					<table class="table2 borde-tabla">
						<thead>
							<tr class="fd-table">
								<th style="min-width:80px;">Fecha</th>
								<th>Consultas</th>
								<th style="min-width:80px;">ESAS-R</th>
								<th>Impresi&oacute;n Diagn&oacute;stica</th>
								<th style="min-width:325px;width:325px;">Cuidados y Tratamientos</th>
								<th>Observaciones</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							';
			$y = $soap->buscardonde('ID_PACIENTE = '.$idpaciente.'');
			if($y == false){
				$cont.='
							<tr>
								<td colspan="7" style="text-align:center;color:#f00">Este paciente no tiene historial registrado.</td>
							</tr>
				';
			}else{

				while($y){
					$cont.='
								<tr>
									<td style="vertical-align:center;">'.$soap->obtener('FECHA').'</td>
									<td>
										<strong>Motivo de la Consulta:</strong> <span style="text-decoration:underline;"> '.$soap->obtener('MOTIVO_CONSULTA').' </span><br>
										<strong>Objetivo de la Consulta:</strong> <span style="text-decoration:underline;"> '.$soap->obtener('OBJETIVO_CONSULTA').' </span>
									</td>
									<td>';
							$det_soap->buscardonde('ID_SOAP = '.$soap->obtener('ID_SOAP').'');
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
								$cont.='No existen valores de ESAS-R registrados';						
							}else {
								$cont.= '';						
							}	
						$cont.='							
									</td>
									<td>';																							
															
								$x = $det_imp_diag->buscardonde('ID_IMPRESION_DIAGNOSTICA = '.$det_soap->obtener('ID_IMPRESION_DIAGNOSTICA').'');
								if(empty($x)) {
									$cont.='No tiene Impresi&oacute;n Diagn&oacute;stica';
								}else{
									$cont.='
										<center>
											<div class="overflow overthrow" style="width:400px;">
												<table class="table2 borde-tabla">
													<thead>
														<tr class="fd-tabla-gris">
															<th style="width:150px;">Diagn&oacute;stico</th>
															<th style="width:50px;">CIE-10</th>
															<th style="width:200px;">Observaci&oacute;n</th>	
														</tr>
													</thead>				
													<tbody style="background:#fff;">
												';										
											while($x) {
												$cie10->buscardonde('ID_CIE10 = "'.$det_imp_diag->obtener('ID_CIE10').'"');
												
											$cont.='
														<tr>
															<td>'.$cie10->obtener('DESCRIPCION').'</td>
															<td>'.$cie10->obtener('ID_CIE10').'</td>
															<td>'.$det_imp_diag->obtener('OBSERVACION').'</td>														
														</tr>';
												$x = $det_imp_diag->releer();								
											}	 
								$cont.='
													</tbody>		
												</table>
											</div>
										</center>';
								}
								$cont.='
									</td>
									';
									//ID_IMPRESION PARA EDITAR
									$impresion = $det_imp_diag->obtener('ID_IMPRESION_DIAGNOSTICA');
									
									$cuidados->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS'));								
									$id_cuid_trat = $det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS');
									if(!empty($id_cuid_trat)) {
										$cuidado = $cuidados->obtener('CUIDADOS');
										$id_cuidado = '&idc='.$cuidados->obtener('ID_CUIDADOS_TRATAMIENTOS');
									}else {
										$cuidado = 'No tiene Cuidados';	
										$id_cuidado = '';
									}
									$cont.='
										<td>
										<strong>Cuidados:</strong> <span style="text-decoration:underline;">'.$cuidado.'</span><br>								
									';
														
							$recetas->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS').'');
							$z = $det_recetas->buscardonde('ID_RECETA = '.$recetas->obtener('ID_RECETA').'');
							$num = 0;
							while($z) {
								$medicamentos->buscardonde('ID_MEDICAMENTO = '.$det_recetas->obtener('ID_MEDICAMENTO').'');								
								$frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO = '.$det_recetas->obtener('ID_FRECUENCIA_TRATAMIENTO').'');	
								$periodo->buscardonde('ID_PERIODO = '.$det_recetas->obtener('ID_PERIODO_TRATAMIENTO').'');
								
								$id_cuid_trat = $det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS');
								if(!empty($id_cuid_trat)) {
									$n = '#'.$num += 1;
									$tratamiento = ''.$det_recetas->obtener('DOSIS').' '.$medicamentos->obtener('DESCRIPCION').' '.$frecuencia->obtener('ABREVIATURA').' POR '.$det_recetas->obtener('TRATAMIENTO').' '.$periodo->obtener('DESCRIPCION').'';
							
									$id_receta = '&idrecipe='.$det_recetas->obtener('ID_RECETA');		
								}else{
									$n = '';
									$tratamiento = 'No tiene Tratamientos M&eacute;dicos';
									$id_receta = '';
								}	
								$cont.='
										<strong>Tratamientos '.$n.':</strong> <span style="text-decoration:underline;">'.$tratamiento.'</span><br><br>';									
							
								$z = $det_recetas->releer();						
							}
							$cont.='
									</td>
									<td>';
										$obs = $soap->obtener('OBSERVACIONES');
										if(empty($obs)) {
											$cont.='No tiene ninguna observaci&oacute;n';				
										}else{
											$cont.= $soap->obtener('OBSERVACIONES');				
										}
									$cont.='
									</td>
									<td>
										<a href="./?url=soap&idsoap='.$soap->obtener('ID_SOAP').'&id='.$idpaciente.'&impresion='.$impresion.''.$id_cuidado.''.$id_receta.'&t='.$t.'" class="btn btn-success btn-small"><i class="icon-pencil icon-white"></i></a>
									</td>
								</tr>';
					$y = $soap->releer();			
				}
			}
			$cont.='
						</tbody>					
					</table>				
				</div>			
			</div>
		</div>		
		';	
	
	$ds->contenido($cont);
	$ds->mostrar();
?>