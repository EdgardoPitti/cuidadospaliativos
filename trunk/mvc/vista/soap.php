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
	$vias = new Accesatabla('vias_administracion');	
	$frecuencia = new Accesatabla('frecuencias_tratamientos');
	$verbos = new Accesatabla('verbos_recetas');
	$unidad = new Accesatabla('unidades_medida');
	$periodo = new Accesatabla('periodo_tratamiento');
	
	$paciente->buscardonde('ID_PACIENTE = '.$idpaciente.'');
	if ($paciente->obtener('ID_SEXO') == 1){
		$sexo = 'MASCULINO';
	}else{
		$sexo = 'FEMENINO';
	}
	list($anio, $mes, $dia) = explode("-", $paciente->obtener('FECHA_NACIMIENTO'));
	
	$soap->buscardonde('ID_SOAP = '.$idsoap.'');
	$sql = 'SELECT MAX(ID_ESCALA) AS ID FROM escala_edmonton WHERE ID_PACIENTE = '.$idpaciente.'';
	$arreglo = $ds->db->obtenerArreglo($sql);
	$idescala = $arreglo[0][ID];
	$datos_escala->buscardonde('ID_ESCALA = '.$idescala.'');	
									
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
								<div class="row-fluid" style="margin-top:-15px;padding-bottom:5px;">
									<div class="span6">
										<center>
											<img src="./iconos/paciente.png" style="max-height:110px"><br>
											<a href="#" class="btn btn-primary">Historial Cl&iacute;nico</a>
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
											$det_soap->buscardonde('ID_SOAP = '.$idsoap.'');
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
														<td><input type="text" name="diagnostico1" id="diagnostico1"></td>
														<td><input type="text" name="cie1" id="cie1" readonly></td>
														<td><input type="text" name="observaciones" id="observaciones"></td>
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
									<div class="span3 offset3 bordediv">
										<table class="table2" style="margin-right:20px">											
											<tr>
												<td><h4>Cuidados</h4></td>
											</tr>
											<tr>
												<td><textarea name="cuidados" placeholder="Cuidados"></textarea></td>
											</tr>
										</table>					
									</div>
									<div class="span4">
										<h4 style="text-align:left;">Tratamientos</h4>
												Medicamentos:												
												<input type="text" name="medicamentos" id="medicamentos" placeholder="Medicamentos">
												<input type="hidden" name="idmedicamentos" id="idmedicamentos"><a data-toggle="modal" href="#add_medicamento" class="btn btn-primary"><i class="icon-plus icon-white"></i> A&ntilde;adir a listado</a><br><br>
												Fecha: <input type="date" name="fechareceta" id="fechareceta"  placeholder="AAAA-MM-DD"> <br><br>
												Forma: 
												<select name="forma" id="forma">
													<option value="0">Forma Farmaceutica</option>
													';										
											$x = $formas->buscardonde('ID_TIPO_FORMA > 0');																								
											while($x){
												$cont.='
													<option value="'.$formas->obtener('ID_TIPO_FORMA').'">'.$formas->obtener('DESCRIPCION').'</option>											
												';
												$x = $formas->releer();
											}
												$cont.='
												</select>
												Concentraci&oacute;n: <input type="text" name="concentracion" id="concentracion" style="width:45px">
												<select name="unidad" id="unidad">
													<option value="0">Unidad</option>';										
											$x = $unidad->buscardonde('ID_TIPO_UNIDAD > 0');																								
											while($x){
												$cont.='
													<option value="'.$unidad->obtener('ID_TIPO_UNIDAD').'">'.$unidad->obtener('DESCRIPCION').'</option>											
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
												$cont.='
													<option value="'.$verbos->obtener('ID_VERBO').'">'.$verbos->obtener('DESCRIPCION').'</option>											
												';
												$x = $verbos->releer();
											}
												$cont.='
												</select>
												<input style="width:45px;" type="text" name="cantdosis" id="cantdosis">
												<select name="frecuencia" id="frecuencia" style="width:70px">
													<option value="0">Frec.</option>';										
											$x = $frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO > 0');																								
											while($x){
												$cont.='
													<option value="'.$frecuencia->obtener('ID_FRECUENCIA_TRATAMIENTO').'">'.$frecuencia->obtener('ABREVIATURA').'</option>											
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
												$cont.='
													<option value="'.$vias->obtener('ID_VIA').'">'.$vias->obtener('ABREVIATURA').'</option>											
												';
												$x = $vias->releer();
											}
												$cont.='
												</select>												
												<br><br>
												Tratamiento por: <input type="text" name="tratamiento" id="tratamiento" style="width:75px;">
												<select name="periodo" id="periodo">
													<option value="0">Periodo</option>';										
											$x = $periodo->buscardonde('ID_PERIODO > 0');																								
											while($x){
												$cont.='
													<option value="'.$periodo->obtener('ID_PERIODO').'">'.$periodo->obtener('DESCRIPCION').'</option>											
												';
												$x = $periodo->releer();
											}
												$cont.='
												</select><br><br>
												Otras Observaciones: <input type="text" name="observaciones" id="observaciones"><br><br>
												<button type="submit" class="btn btn-primary">Agregar</button>
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
									Abreviatura: <input type="text" name="abreviatura" id="abreviatura" placeholder="Abreviatura"><br><br>
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
