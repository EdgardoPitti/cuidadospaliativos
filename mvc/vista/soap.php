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
		$idsoap = 0;				
	}
	$impresion = $_GET['impresion'];
	if(!empty($impresion)){
		$id_imp = '&idimp='.$impresion.'';		
	}else {
		$id_imp = '';			
	}
	
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
	
	$sql = 'SELECT MAX(ID_SOAP) AS id FROM soap WHERE ID_PACIENTE = '.$idpaciente.' AND ID_SOAP <> '.$idsoap;
	$matriz = $ds->db->obtenerArreglo($sql);
	$id_soap = $matriz[0][id];
	
	$soap->buscardonde('ID_SOAP = '.$id_soap.'');
	list($agno, $month, $day) = explode("-", $soap->obtener('FECHA'));
	$sql = 'SELECT MAX(ID_ESCALA) AS ID FROM escala_edmonton WHERE ID_PACIENTE = '.$idpaciente.'';
	$arreglo = $ds->db->obtenerArreglo($sql);
	$idescala = $arreglo[0][ID];
	
	$datos_escala->buscardonde('ID_ESCALA = '.$idescala.'');	
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
	$cont.='
				<div class="row-fluid">				
					<a href="./?url=menu_categorias&id='.$idpaciente.'" class="btn btn-primary pull-left" style="position:relative;top:-5px;left:10px;" title="Regresar"><i class="icon-arrow-left icon-white"></i></a>	
				</div>				
				<div class="row-fluid">
					<div class="span4" style="margin-bottom:10px;">
						<fieldset>
							<legend>
								Datos del Paciente
							</legend>
								<div class="row-fluid" style="margin-top:-10px;padding-bottom:5px;">
									<div class="span6">
										<center>
											<img src="./iconos/paciente.png" style="max-height:110px"><br>
											<a href="./?url=historia_clinica&id='.$idpaciente.'" class="btn btn-primary">Historial Cl&iacute;nico</a>
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
							</legend>';
							if(empty($id_soap)){
								$cont.='<div style="color:red;text-align:center;height:95px;padding-top:30px;">No se le ha registrado consulta a este paciente.</div>';
							}else{
								$cont.='
									<div style="margin-top:-7px;padding-bottom:5px;">	
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
											<tr>
													<td><b>Cuidado:</b> '.$cuidado.'</td>
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
						<fieldset style="height:168px;">
							<legend>
								ESAS-R
							</legend>
								';										
									if(empty($id_soap)){
										$cont.='<div style="color:red;text-align:center;height:92px;padding-top:30px;">No se ha registrado escalas para este paciente.</div>';
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
													
									$cont.='	
											</div>';
								}
	$cont.='
						</fieldset>
					</div>
				</div>						
				';
			$soap->buscardonde('ID_SOAP = '.$idsoap.'');
			$det_soap->buscardonde('ID_SOAP = '.$idsoap.'');
			$datos_escala->buscardonde('ID_ESCALA = '.$det_soap->obtener('ID_ESCALA').'');
			
			/*rellenar campos de cuidados y tratamientos*/	
			$cuidados->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS'));	
			$recetas->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS').'');
			if(!empty($recetas->obtener('ID_RECETA'))){
				$enlace = '<a href="datospdf.php?idr='.$recetas->obtener('ID_RECETA').'&imprimir=1" class="btn btn-primary" title="Imprimir" target="_blank" onclick="window.open(this.href); return false;"><i class="icon-print icon-white"></i> Imp. Receta</a><br>';			
			}else{
				$enlace = '';			
			}
			$det_recetas->buscardonde('ID_RECETA = '.$recetas->obtener('ID_RECETA').'');
			$medicamentos->buscardonde('ID_MEDICAMENTO = '.$det_recetas->obtener('ID_MEDICAMENTO').'');		
			$verbos->buscardonde('ID_VERBO = '.$det_recetas->obtener('ID_DOSIS').'');
			$frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO = '.$det_recetas->obtener('ID_FRECUENCIA_TRATAMIENTO').'');	
			$periodo->buscardonde('ID_PERIODO = '.$det_recetas->obtener('ID_PERIODO_TRATAMIENTO').'');
			
			$cont.='
				<div class="row-fluid">
					<div class="panel panel-primary">
						<div class="panel-header">
							<h5>Subjetivo</h5>
						</div>
						<div class="panel-body">							
							<center>
								<form class="form-inline" method="POST" action="./?url=agregarsoap&id='.$idpaciente.'&sw=1&t='.$t.''.$ids.'">
									Motivo de la Consulta:
								';
			if(!empty($soap->obtener('MOTIVO_CONSULTA'))){
				$img = '<img src="./iconos/save.png">';
			}
			$cont.='
									<textarea name="motivo" placeholder="Motivo de la Consulta">'.$soap->obtener('MOTIVO_CONSULTA').'</textarea>'.$img.'
									<button type="submit" class="btn btn-default" style="margin-top:10px">Guardar</button>
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
							<center>
								<form class="form-inline" method="POST" action="./?url=agregarsoap&id='.$idpaciente.'&sw=2&t='.$t.''.$ids.'">
									Objetivo de la Consulta:';
			if(!empty($soap->obtener('OBJETIVO_CONSULTA'))){
				$img = '<img src="./iconos/save.png">';
			}else{
				$img = '';
			}
			$cont.='
									<textarea name="objetivo" placeholder="Objetivo de la Consulta">'.$soap->obtener('OBJETIVO_CONSULTA').'</textarea>'.$img.'
									<button type="submit" class="btn btn-default" style="margin-top:10px">Guardar</button>
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
								<div class="overflow overthrow" style="width: 100%;min-height: 100px; overflow: auto;overflow:hidden;">
									<div class="span8 offset2">
										<form method="post" action="./?url=agregarsoap&id='.$idpaciente.''.$ids.'&sw=3'.$id_imp.'">										
											<table class="table2 borde-tabla">
												<thead>											
													<tr class="fd-table">
														<th style="width:220px">Diagn&oacute;stico</th>
														<th style="width:190px">CIE-10</th>
														<th style="width:190px">Observaciones</th>
														<th style="width:100px"></th>
													</tr>
												</thead>	
												<tbody>';
											$x = $det_imp_diag->buscardonde('ID_IMPRESION_DIAGNOSTICA = '.$det_soap->obtener('ID_IMPRESION_DIAGNOSTICA').'');
											while($x) {
												$cie10->buscardonde('ID_CIE10 = "'.$det_imp_diag->obtener('ID_CIE10').'"');
												
												$cont.='
													<tr>
														<td>'.$cie10->obtener('DESCRIPCION').'</td>
														<td>'.$cie10->obtener('ID_CIE10').'</td>
														<td>'.$det_imp_diag->obtener('OBSERVACION').'</td>
														<td></td>												
													</tr>											
												';		
												$x = $det_imp_diag->releer();								
											}		
									$cont.='
													<tr>
														<td><input type="text" name="diagnostico1" id="diagnostico1" placeholder="Diagn&oacute;stico"></td>
														<td><input type="text" name="cie1" id="cie1" placeholder="CIE-10" readonly></td>
														<td><input type="text" name="observaciones" id="observaciones" placeholder="Observaciones"></td>
														<td><button type="submit" class="btn btn-primary"><i class="icon-plus icon-white"></i> A&ntilde;adir Diagn&oacute;stico</button></td>
													</tr>
												</tbody>
											</table>
										</form>
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
								<form class="form-inline" method="POST" action="./?url=agregarsoap&sw=4&id='.$idpaciente.''.$ids.'">			
									<div class="span3 offset3">
										<table class="table2" style="margin-right:20px">											
											<tr>
												<td><h4>Cuidados</h4></td>
											</tr>
											<tr>											
												<td><textarea name="cuidados" placeholder="Cuidados">'.$cuidados->obtener('CUIDADOS').'</textarea></td>
											</tr>
										</table>					
									</div>
									<div class="span4 bordediv" style="margin-left:0px;">
											<h4 style="text-align:left;">Tratamientos</h4>
											'.$enlace.'<br>
												Fecha: <input type="date" name="fechareceta" id="fechareceta"  placeholder="AAAA-MM-DD" value="'.$recetas->obtener('FECHA_RECETA').'"> <br><br>
												Medicamentos:												
												<input type="text" name="medicamentos" id="medicamentos" placeholder="Medicamentos" value="'.$medicamentos->obtener('DESCRIPCION').'">
												<input type="hidden" name="idmedicamentos" id="idmedicamentos" '.$medicamentos->obtener('ID_MEDICAMENTO').'><a data-toggle="modal" href="#add_medicamento" class="btn btn-primary"><i class="icon-plus icon-white"></i> A&ntilde;adir a listado</a><br><br>
												Forma: 
												<select name="forma" id="forma">
													<option value="0">Forma Farmaceutica</option>
													';										
											$x = $formas->buscardonde('ID_TIPO_FORMA > 0');																								
											while($x){
												if($formas->obtener('ID_TIPO_FORMA') == $det_recetas->obtener('ID_FORMA')){
													$value = 'selected';
												}else{
													$value = '';												
												}
												$cont.='
													<option value="'.$formas->obtener('ID_TIPO_FORMA').'" '.$value.'>'.$formas->obtener('DESCRIPCION').'</option>											
												';
												$x = $formas->releer();
											}
												$cont.='
												</select>
												Concentraci&oacute;n: <input type="text" name="concentracion" id="concentracion" value="'.$det_recetas->obtener('CONCENTRACION').'" style="width:45px">
												<select name="unidad" id="unidad">
													<option value="0">Unidad</option>';										
											$x = $unidad->buscardonde('ID_TIPO_UNIDAD > 0');																								
											while($x){
												if($unidad->obtener('ID_TIPO_UNIDAD') == $det_recetas->obtener('ID_UNIDAD')){
													$value = 'selected';
												}else{
													$value = '';												
												}
												$cont.='
													<option value="'.$unidad->obtener('ID_TIPO_UNIDAD').'" '.$value.'>'.$unidad->obtener('ABREVIATURA').'</option>											
												';
												$x = $unidad->releer();
											}
												$cont.='
												</select>
												<br><br>
												Dosis: <select name="verbos" id="verbos">
													<option value="0">Dosis</option>';										
											$x = $verbos->buscardonde('ID_VERBO > 0');																								
											while($x){
												if($verbos->obtener('ID_VERBO') == $det_recetas->obtener('ID_DOSIS')){
													$value = 'selected';
												}else{
													$value = '';												
												}
												$cont.='
													<option value="'.$verbos->obtener('ID_VERBO').'" '.$value.'>'.$verbos->obtener('DESCRIPCION').'</option>											
												';
												$x = $verbos->releer();
											}
												$cont.='
												</select>
												<input style="width:45px;" type="text" name="cantdosis" id="cantdosis" value="'.$det_recetas->obtener('DOSIS').'">
												<select name="frecuencia" id="frecuencia" style="width:70px">
													<option value="0">Frec.</option>';										
											$x = $frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO > 0');																								
											while($x){
												if($frecuencia->obtener('ID_FRECUENCIA_TRATAMIENTO') == $det_recetas->obtener('ID_FRECUENCIA_TRATAMIENTO')){
													$value = 'selected';
												}else{
													$value = '';												
												}
												$cont.='
													<option value="'.$frecuencia->obtener('ID_FRECUENCIA_TRATAMIENTO').'" '.$value.'>'.$frecuencia->obtener('ABREVIATURA').'</option>											
												';
												$x = $frecuencia->releer();
											}
												$cont.='
												</select>											
												V&iacute;a: 
												<select name="via" id="via" style="width:60px">
													<option value="0">V&iacute;a</option>';										
											$x = $vias->buscardonde('ID_VIA > 0');																								
											while($x){
												if($vias->obtener('ID_VIA') == $det_recetas->obtener('ID_VIA')){
													$value = 'selected';
												}else{
													$value = '';												
												}
												$cont.='
													<option value="'.$vias->obtener('ID_VIA').'" '.$value.'>'.$vias->obtener('ABREVIATURA').'</option>											
												';
												$x = $vias->releer();
											}
												$cont.='
												</select>												
												<br><br>
												Tratamiento por: <input type="text" name="tratamiento" id="tratamiento" value="'.$det_recetas->obtener('TRATAMIENTO').'" style="width:75px;">
												<select name="periodo" id="periodo">
													<option value="0">Periodo</option>';										
											$x = $periodo->buscardonde('ID_PERIODO > 0');																								
											while($x){
												if($periodo->obtener('ID_PERIODO') == $det_recetas->obtener('ID_PERIODO_TRATAMIENTO')){
													$value = 'selected';
												}else{
													$value = '';												
												}
												$cont.='
													<option value="'.$periodo->obtener('ID_PERIODO').'" '.$value.'>'.$periodo->obtener('DESCRIPCION').'</option>											
												';
												$x = $periodo->releer();
											}
												$cont.='
												</select><br><br>
												Otras Observaciones: <textarea name="observaciones" id="observaciones">'.$det_recetas->obtener('OTRAS_INDICACIONES').'</textarea><br><br>
												<button type="submit" class="btn btn-default">Agregar</button>
									</div>
								</form>
							</div>			
						</div>
						<form class="form-inline" method="POST" action="./?url=addmedicamento'.$ids.''.$id_imp.'">
							<div id="add_medicamento" class="modal hide fade in" style="display: none; ">  						
								<div class="modal-header">  
									<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a>  
									<h4>A&ntilde;adir Medicamento a Listado</h4>  
								</div>  
								<div class="modal-body" align="center">
									Cuadro Medicamento: <select name="cuadro_medicamento" id="cuadro_medicamento">
																<option value=""></option>';
													$x = $cuadro_medicamento->buscardonde('ID_TIPO_CUADRO > 0');
													while($x){
															$cont.='<option value="'.$cuadro_medicamento->obtener('ID_TIPO_CUADRO').'">'.$cuadro_medicamento->obtener('DESCRIPCION').'</option>';
														$x = $cuadro_medicamento->releer();
													}
													$cont.='
															  </select><br><br>
									Descripci&oacute;n: <input type="text" name="desc_medicamento" id="desc_medicamento" placeholder="Descripci&oacute;n de Medicamento">
								</div>
								<div class="modal-footer">  
									<button type="submit" class="btn btn-primary">Guardar</button>  
									<button type="submit" class="btn btn-default" data-dismiss="modal">Cerrar</button>  
								</div>  
							</div>  
						</form> 
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
									<form method="POST" action="./?url=agregarsoap&id='.$idpaciente.''.$ids.'&sw=5">							
										<table class="table2">											
											<tr>
												<td>Observaciones</td>
											</tr>';
			if(!empty($soap->obtener('OBSERVACIONES'))){
				$img = '<img src="./iconos/save.png">';
			}else{
				$img = '';
			}
			$cont.='
											<tr>
												<td><textarea name="observaciones" placeholder="Observaciones">'.$soap->obtener('OBSERVACIONES').'</textarea>'.$img.'</td>
											</tr>
											<tr>
												<td><button type="submit" class="btn btn-default">Guardar</button></td>											
											</tr>
										</table>
									</form>										
								</div>
								<div class="span2">
									<table class="table2">											
										<tr>
											<td>SURCO</td>
										</tr>
										<tr>
											<td><a href="./?url=domiciliaria_surco&idp='.$idpaciente.''.$ids.'" class="btn btn-primary">SURCO</a></td>
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
