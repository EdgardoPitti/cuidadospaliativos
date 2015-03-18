<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');

	$ds = new Diseno();
	$t = $_GET['t'];
	$idpaciente = $_GET['id'];
	$idsoap = $_GET['idsoap'];
	$idc = $_GET['idc']; //id_cuidado
	$idr = $_GET['idrecipe']; //id_receta
	
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
	$profesional = new Accesatabla('profesionales_salud');
	$datosprofesional = new Accesatabla('datos_profesionales_salud');
	$especialidad = new Accesatabla('especialidades_medicas');
	$atencion = new Accesatabla('atencion_paciente');
	
	$paciente->buscardonde('ID_PACIENTE = '.$idpaciente.'');
	if ($paciente->obtener('ID_SEXO') == 1){
		$sexo = 'MASCULINO';
	}else{
		$sexo = 'FEMENINO';
	}

	list($anio, $mes, $dia) = explode("-", $paciente->obtener('FECHA_NACIMIENTO'));
	
	$sql = 'SELECT MAX(ID_SOAP) AS id FROM soap WHERE ID_PACIENTE = '.$idpaciente.'';
	$matriz = $ds->db->obtenerArreglo($sql);	
	$id_soap = $matriz[0][id];
	
	$soap->buscardonde('ID_SOAP = '.$id_soap.'');
	list($agno, $month, $day) = explode("-", $soap->obtener('FECHA'));
	$sql = 'SELECT MAX(ID_ESCALA) AS ID FROM escala_edmonton WHERE ID_PACIENTE = '.$idpaciente.'';
	$arreglo = $ds->db->obtenerArreglo($sql);
	$idescala = $arreglo[0][ID];
	
	$datos_escala->buscardonde('ID_ESCALA = '.$idescala.' AND FECHA = "'.$soap->obtener('FECHA').'"');	//Compara junto a la fecha
	$det_soap->buscardonde('ID_SOAP = '.$id_soap.'');
	
	/*rellenar campos de cuidados y tratamientos*/	
	$cuidados->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS'));	
	$recetas->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS').'');
	$x = $det_recetas->buscardonde('ID_RECETA = '.$recetas->obtener('ID_RECETA').'');
	$medicamentos->buscardonde('ID_MEDICAMENTO = '.$det_recetas->obtener('ID_MEDICAMENTO').'');	
	$medica = $medicamentos->obtener('ID_MEDICAMENTO');
	$cant_trat = 1;
	if(!empty($medica)){
		while($x){
			$medicamentos->buscardonde('ID_MEDICAMENTO = '.$det_recetas->obtener('ID_MEDICAMENTO').'');	
			$frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO = '.$det_recetas->obtener('ID_FRECUENCIA_TRATAMIENTO').'');	
			$periodo->buscardonde('ID_PERIODO = '.$det_recetas->obtener('ID_PERIODO_TRATAMIENTO').'');
			$tratamiento .= $cant_trat++.') '.$det_recetas->obtener('DOSIS').' '.$medicamentos->obtener('DESCRIPCION').' '.$frecuencia->obtener('ABREVIATURA').' POR '.$det_recetas->obtener('TRATAMIENTO').' '.$periodo->obtener('DESCRIPCION').'<br>';
			$x = $det_recetas->releer();
		}
		$cuidado = $cuidados->obtener('CUIDADOS');
	}else{
		$cuidado = 'No posee Cuidado';
		$tratamiento = 'No posee Tratamiento';
	}
	
	if($t == 1) {	
		$opcion = 'Domiciliaria';	
	}elseif($t == 2) {
		$opcion = 'Ambulatoria';	
	}else {
		$opcion = 'Hospitalaria';	
	}
	
	$enlace = '<a href="./?url=menu_categorias&id='.$idpaciente.'" class="btn btn-primary pull-left" style="position:relative;top:-5px;left:10px;" title="Regresar"><i class="icon-arrow-left icon-white"></i></a>';
	$cont.='
				<div class="row-fluid">		
					<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">'.$enlace.' Categor&iacute;a: '.$opcion.'</h3>									
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
											<a href="./?url=historia_clinica&id='.$idpaciente.''.$ids.'&t='.$_GET['t'].'" class="btn btn-primary">Historial Cl&iacute;nico</a>
										</center>
									</div>
									<div class="span6">
										<table>											
											<tr>
												<td><strong>'.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('SEGUNDO_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').' '.$paciente->obtener('APELLIDO_MATERNO').'</strong>&nbsp;<a href="./?url=nuevopaciente&id='.$idpaciente.'&sw=1&s=1&t='.$t.''.$ids.'">(Editar)</a></td>
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
													<td><b>Cuidado:</b> '.$cuidado.'</td>
											</tr>
											<tr>
												<td>
													<div class="overthrow" style="height:45px;overflow:auto;">
														'.$tratamiento.'
													</div>
												</td>									
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
										//$datos_escala->buscardonde('ID_ESCALA = '.$det_soap->obtener('ID_ESCALA').'');
										
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
						</fieldset>
					</div>
				</div>						
				';
			
			$soap->buscardonde('ID_SOAP = '.$idsoap);
			$det_soap->buscardonde('ID_SOAP = '.$idsoap);
			$datos_escala->buscardonde('ID_ESCALA = '.$det_soap->obtener('ID_ESCALA'));
						
			
			if($t == 2){
				$cont.='
						<div class="row-fluid">
							<div class="panel panel-primary">
								<div class="panel-header">
									<h5>Contacto Telef&oacute;nico</h5>
								</div>
								<div class="panel-body">
									<center>
										<p><a data-toggle="modal" href="#ag_obser" class="btn btn-primary">Agregar Observaciones</a></p>  
									</center>
								</div>';
			
					$a = $atencion->buscardonde('ID_PACIENTE = '.$idpaciente.' ORDER BY ID_ATENCION DESC');
					if($a){
							$cont.='
								<center><h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Atenciones del Paciente</h3></center>
									<div class="overflow overthrow" style="max-height:150px;">
										<table class="table2 borde-tabla table-hover">
											<thead>
												<tr class="fd-table">
													<th>#</th>
													<th>Fecha</th>
													<th>Profesional</th>
													<th>Especialidad</th>
													<th>Hora Inicio</th>
													<th>Hora Fin</th>
													<th>Minutos Utilizados</th>
													<th>Motivo</th>
													<th>Observacion</th>
													<th>Tipo Contacto</th>
													<th>E-Mail / Telefono</th>
												</tr>
											</thead>
											<tbody>';
							$n = 1;
							while($a){								
								$profesional->buscardonde('ID_PROFESIONAL = '.$atencion->obtener('ID_PROFESIONAL').'');
								$datosprofesional->buscardonde('ID_PROFESIONAL = '.$atencion->obtener('ID_PROFESIONAL').'');
								$especialidad->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$profesional->obtener('ID_ESPECIALIDAD_MEDICA').'');
								$segundo_nombre = $datosprofesional->obtener('SEGUNDO_NOMBRE');
								$segundo_apellido = $datosprofesional->obtener('APELLIDO_MATERNO');
								if($atencion->obtener('TIPO_CONTACTO') == 1){
									$tipo = 'Tel&eacute;fono';
									$contacto = $atencion->obtener('TELEFONO');
								}else{
									$tipo = 'Correo Electr&oacute;nico';
									$contacto = $atencion->obtener('E_MAIL');
								}
									$cont.='
												<tr>
													<td>'.$n.'.</td>
													<td>'.$atencion->obtener('FECHA').'</td>
													<td>'.$datosprofesional->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$datosprofesional->obtener('APELLIDO_PATERNO').' '.$segundo_apellido[0].'.</td>
													<td>'.$especialidad->obtener('DESCRIPCION').'</td>
													<td>'.$atencion->obtener('HORA_INICIO').'</td>
													<td>'.$atencion->obtener('HORA_FIN').'</td>
													<td>'.$atencion->obtener('MINUTOS_UTILIZADOS').'</td>
													<td>'.$atencion->obtener('MOTIVO').'</td>
													<td>'.$atencion->obtener('OBSERVACION').'</td>
													<td>'.$tipo.'</td>
													<td>'.$contacto.'</td>
												</tr>';
								$n++;
								$a = $atencion->releer();
							}
								$cont.='
											</tbody>
										</table>	
								
									</div>';
						}
				$cont.='		</div>
							</div> 		
							
						<!--AGREGAR OBSERVACIONES-->
						<div id="ag_obser" class="modal hide fade in" style="display: none; ">  						
							<form id="form" method="POST" action="./?url=add_atencion_paciente'.$ids.'&id='.$idpaciente.'&s=1">
								<div class="modal-header">  
									<a class="close" data-dismiss="modal"><i class="icon-remove"></i></a>  
									<h4>Agregar Observaciones</h4>  
								</div>  
								<div class="modal-body" align="center"> 
										<table class="overthrow" style="overflow-y:auto;">
											<tr>
												<td><h5 style="margin-bottom:3px;">Hora Inicio:</h5></td>
												<td>
													<div class="input-append bootstrap-timepicker" style="margin-bottom:0px;">
										            <input type="text" id="hora_inicio" name="hora_inicio" required="required" style="width:112px;marg in-bottom:3px;">
										            <span class="add-on"><i class="icon-time"></i></span>
										        </div>
												</td>
											</tr>
											<tr>
												<td><h5 style="margin-bottom:3px;">Hora Fin:</h5></td>
												<td>
													<div class="input-append bootstrap-timepicker" style="margin-bottom:0px;">
										            <input type="text" id="hora_fin" name="hora_fin" required="required" style="width:112px;marg in-bottom:3px;">
										            <span class="add-on"><i class="icon-time"></i></span>
										        </div>
									        </td>
											</tr>
											<tr>
												<td><h5 style="margin-bottom:3px;">Minutos Utilizados: </h5></td>
												<td><input type="number" id="minutos" name="minutos" min="1" max="360" required="required" style="width:140px;margin-bottom:3px;"></td>
											</tr>
											<tr>
												<td><h5 style="margin-bottom:3px;">Tipo de Contacto: </h5></td>
												<td>
													<select id="tipo" name="tipo" required="required" style="width:140px;margin-bottom:3px;">
														<option value>SELECCIONE TIPO CONTACTO</option>
														<option value="1">Tel&eacute;fono</option>
														<option value="2">Correo Electr&oacute;nico</option>
													</select>
												</td>
											</tr>
											<tr>
												<td><h5 style="margin-bottom:3px;">Tel&eacute;fono: </h5></td>
												<td><input type="text" id="telefono" name="telefono" placeholder="Tel&eacute;fono" style="width:140px;margin-bottom:3px;"></td>
											</tr>
											<tr>
												<td><h5 style="margin-bottom:3px;">Correo Electr&oacute;nico: </h5></td>
												<td><input type="email" id="email" name="email" placeholder="Correo Electr&oacute;nico" style="width:140px;margin-bottom:3px;"></td>
											</tr>
											<tr>
												<td><h5 style="margin-bottom:3px;">Motivo:</h5></td>
												<td><input type="text" name="motivo" required="required" placeholder="Motivo de Atenci&oacute;n" style="width:140px;margin-bottom:3px;"></td>
											</tr>
											<tr>
												<td><h5 style="margin-bottom:3px;">Observaciones:</h5> </td>
												<td><textarea id="observacion" class="textarea" name="observacion" required="required" placeholder="Observaci&oacute;nes" style="height:25px;width:140px;margin-bottom:3px;"></textarea></td>
											</tr>
										</table>										
								</div>  
								<div class="modal-footer">  
									<button type="submit" class="btn btn-primary btn-small">Guardar</button>  
									<button type="submit" class="btn btn-default btn-small" data-dismiss="modal">Cerrar</button>  
								</div>  
							</form>							
						</div>  
							';
			}
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
			$mot_consul = $soap->obtener('MOTIVO_CONSULTA');
			if(!empty($mot_consul)){
				$img = '<img src="./iconos/save.png">';
				$disable_obj = '';				
			}else{
				$img = '';
				$disable_obj = 'disabled="disabled"';
			}
			$cont.='
									<textarea name="motivo" placeholder="Motivo de la Consulta" required="required">'.$soap->obtener('MOTIVO_CONSULTA').'</textarea>'.$img.'
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
			$obj_consul = $soap->obtener('OBJETIVO_CONSULTA');
			if(!empty($obj_consul)){
				$img = '<img src="./iconos/save.png">';
				$disable_esas = '';
				$disable_class = ''; 
			}else{
				$img = '';
				$disable_esas = 'disabled="disabled"';
				$disable_class = 'disabled'; 
			}
			$cont.='
									<textarea name="objetivo" placeholder="Objetivo de la Consulta" required="required" '.$disable_obj.'>'.$soap->obtener('OBJETIVO_CONSULTA').'</textarea>'.$img.'
									<button type="submit" class="btn btn-default" '.$disable_obj.' style="margin-top:10px">Guardar</button>
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
		
		if(!$det_soap->obtener('ID_ESCALA')){			
			$disable_diag = 'disabled="disabled"';					
		}else {
			$disable_diag = '';		
		}
	$cont.='
												</td>										
											</tr>
										</table>							
									</div>
									<div class="span2">
										<center style="margin-bottom:15px;">
											<a href="./?url=escala_edmont&idp='.$idpaciente.'&sw=1'.$ids.'&t='.$_GET['t'].'" class="btn btn-primary '.$disable_class.'" '.$disable_esas.'>Escala EDMONTON</a>
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
								';
								$id_imp_diag = $det_soap->obtener('ID_IMPRESION_DIAGNOSTICA');
								if(!empty($id_imp_diag)) {
									$id_imp = '&idimp='.$det_soap->obtener('ID_IMPRESION_DIAGNOSTICA').'';;								
								}else{
									$id_imp ='';
								}
								$cont.='
									<form method="post" action="./?url=agregarsoap&id='.$idpaciente.''.$ids.'&sw=3&t='.$_GET['t'].''.$id_imp.'">	
										<div class="overflow overthrow" style="max-height:170px;padding:0px 10px 0px 10px;">									
											<table class="table2 borde-tabla">
												<thead>											
													<tr class="fd-table">
														<th style="min-width:150px">CIE-10</th>
														<th style="min-width:150px">Diagn&oacute;stico</th>
														<th style="min-width:150px">Observaciones</th>
														<th style="min-width:100px"></th>
													</tr>
												</thead>	
												<tbody>';
												
									$x = $det_imp_diag->buscardonde('ID_IMPRESION_DIAGNOSTICA = '.$det_soap->obtener('ID_IMPRESION_DIAGNOSTICA').'');
									while($x) {
										$cie10->buscardonde('ID_CIE10 = "'.$det_imp_diag->obtener('ID_CIE10').'"');
										
										$cont.='
												<tr>
													<td>'.$cie10->obtener('ID_CIE10').'</td>
													<td>'.$cie10->obtener('DESCRIPCION').'</td>
													<td>'.$det_imp_diag->obtener('OBSERVACION').'</td>
													<td></td>												
												</tr>											
										';		
										$x = $det_imp_diag->releer();								
									}		
								$cont.='
													<tr>
														<td><input type="text" name="cie1" id="cie1" placeholder="CIE-10" readonly="readonly"></td>
														<td><input type="text" name="diagnostico1" id="diagnostico1" '.$disable_diag.' placeholder="Diagn&oacute;stico" ></td>
														<td><input type="text" name="observaciones" id="observaciones" placeholder="Observaciones" '.$disable_diag.'></td>
														<td><button type="submit" class="btn btn-primary" '.$disable_diag.'><i class="icon-plus icon-white"></i> A&ntilde;adir Diagn&oacute;stico</button></td>
													</tr>
												</tbody>
											</table>
										</div>
									</form>
								</div>		
							</div>			
						</div>
					</div>				
				</div>';
				/*rellenar campos de cuidados y tratamientos*/	
				$id_cuidado = $det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS');
				if($id_cuidado == 0){
					$id_cuidado = '"" AND ID_CUIDADOS_TRATAMIENTOS <> 0';
				}
				$cuidados->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$id_cuidado);	
				$recetas->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$id_cuidado);	
				$idreceta = $recetas->obtener('ID_RECETA');
				if(!empty($idreceta)){
					$enlace = '<a href="datospdf.php?idrecipe='.$recetas->obtener('ID_RECETA').'&imprimir=1" class="btn btn-primary" title="Imprimir" target="_blank" onclick="window.open(this.href); return false;"><i class="icon-print icon-white"></i> Imp. Receta</a><br>';
					$disable_class = ''; 		
				}else{
					$enlace = '';
					$disable_class = 'disabled'; 		
				}
				if(!empty($idc)) {
					$cuidado = '&idc='.$idc.'';				
				}else {
					$cuidado = '';				
				}
				if(!empty($idr)) {
					$receta = '&idrecipe='.$idr.'';
				}else {
					$receta = '';
				}
				$cont.='
				<div class="row-fluid">
					<div class="panel panel-primary">
						<div class="panel-header">
							<h5>Cuidados/Tratamientos</h5>
						</div>
						<div class="panel-body">
							<div class="row-fluid">';
							$id_imp_diag = $det_soap->obtener('ID_IMPRESION_DIAGNOSTICA');
							if(!empty($id_imp_diag)) {																								
								$disable_cuadro = '';															
							}else {														
								$disable_cuadro = 'disabled="disabled"';
							}

							$care = $cuidados->obtener('CUIDADOS');
							if(!empty($care)) {		
									$disable = '';
									$disableClass = '';	
									$img = '<img src="./iconos/save.png">';	
							}else{									
									$disable = 'disabled="disabled"';
									$disableClass = 'disabled';
									$img =''; 	
							}		
							$cont.='
								<div class="span12" style="padding-left:10px;">
									<form class="form-inline" id="form" method="POST" action="./?url=agregarsoap&sw=4&t='.$_GET['t'].'&id='.$idpaciente.''.$ids.''.$cuidado.''.$receta.'">			
										<center>											
											<h4 style="background:#e9e9e9;margin-left:-9px;padding:7px 4px 7px 5px;width:100%;">Cuidados</h4>
											<textarea name="cuidados" placeholder="Cuidados" required="required" '.$disable_cuadro.'>'.$cuidados->obtener('CUIDADOS').'</textarea>'.$img.'
											<div>
												<button type="submit" class="btn btn-default" '.$disable_cuadro.' style="margin-top:5px;">Guardar Cuidado</button>
											</div>
										</center>
									</form>
									<form class="form-inline" id="form" method="POST" action="./?url=agregarsoap&sw=5&t='.$_GET['t'].'&id='.$idpaciente.''.$ids.''.$cuidado.''.$receta.'">
										<center>										
											<h4 style="background:#e9e9e9;margin-left:-9px;padding:7px 4px 7px 5px;width:100%;">Tratamientos</h4>';
											
									$z = $recetas->buscardonde('ID_PACIENTE = '.$idpaciente.' ORDER BY ID_RECETA DESC');																				
									if($z == true){
										$cont.='
											<!-- HISTORIAL DE MEDICAMENTOS -->
											<h4 style="backgr ound:#e9e9e9;margin-left:-9px;padding:7px 4px 7px 5px;width:100%;text-decoration:underline">Historial de Medicamentos</h4>																						
											<div class="overflow overthrow" style="max-height:170px;margin-top:10px;">												
												<table class="table2 borde-tabla">
													<thead>
														<tr class="fd-table">
															<th>Fecha Aplicaci&oacute;n</th>
															<th style="min-width:165px;">Medicamento</th>
															<th>Cant. Dosis</th>
															<th>Frecuencia</th>
															<th>V&iacute;a</th>
															<th>Tratamiento</th>
															<th style="min-width:120px;">Peri&oacute;do</th>
															<th style="min-width:100px;">Otras Observaciones</th>											
														</tr>
													</thead>
													<tbody>';
												while($z) {
													$d = $det_recetas->buscardonde('ID_RECETA = '.$recetas->obtener('ID_RECETA').' ORDER BY ID_DETALLE_RECETA DESC');
													while($d){
														$medicamentos->buscardonde('ID_MEDICAMENTO = '.$det_recetas->obtener('ID_MEDICAMENTO').'');
														$frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO = '.$det_recetas->obtener('ID_FRECUENCIA_TRATAMIENTO').'');
														$vias->buscardonde('ID_VIA = '.$det_recetas->obtener('ID_VIA').'');
														$periodo->buscardonde('ID_PERIODO = '.$det_recetas->obtener('ID_PERIODO_TRATAMIENTO').'');
														$cont.='
															<tr>
																<td>'.$recetas->obtener('FECHA_RECETA').'</td>
																<td>'.$medicamentos->obtener('DESCRIPCION').'</td>
																<td>'.$det_recetas->obtener('DOSIS').'</td>
																<td>'.$frecuencia->obtener('ABREVIATURA').'</td>
																<td>'.$vias->obtener('ABREVIATURA').'</td>
																<td>'.$det_recetas->obtener('TRATAMIENTO').'</td>
																<td>'.$periodo->obtener('DESCRIPCION').'</td>
																<td>'.$det_recetas->obtener('OTRAS_INDICACIONES').'</td>												
															</tr>
														';
														$d = $det_recetas->releer();
													}
													
													$z = $recetas->releer();
												}
									$cont.='
													</tbody>
												</table>
											</div><br>											
									';
									}
									$sql = 'Select max(ID_RECETA) as id from recetas_medicas where ID_PACIENTE = '.$idpaciente.' ';
									$matriz = $ds->db->ObtenerArreglo($sql);									
									$receta_id = $matriz[0][id];
									$det_soap->buscardonde('ID_SOAP = '.$idsoap.'');
									$recetas->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS').' AND ID_CUIDADOS_TRATAMIENTOS <> 0');
									$sw_receta = 0;
									$r=$recetas->obtener('ID_RECETA');
									if(empty($r)){	
										$fecha = $ds->dime('fecha');
									}else{
										$fecha = $recetas->obtener('FECHA_RECETA');
										$sw_receta = 1;
									}
									$sw_form = 0;
									//Recetas
									$cont.='
										<a data-toggle="modal" href="#" data-target="#add_medicamento" class="btn btn-primary '.$disableClass.'"><i class="icon-plus icon-white"></i> A&ntilde;adir Nuevo Medicamento</a><br/><br/>																				
										Fecha: <input type="date" name="fechareceta" id="fechareceta" placeholder="AAAA-MM-DD" '.$disable.' required="required" value="'.$fecha.'">
										</center>
											<div class="overflow overthrow" style="max-height:170px;margin-top:10px;">												
												<table class="table2 borde-tabla">
													<thead>
														<tr class="fd-table">
															<th style="min-width:165px;">Medicamento</th>
															<th>Cant. Dosis</th>
															<th>Frecuencia</th>
															<th>V&iacute;a</th>
															<th>Tratamiento</th>
															<th style="min-width:120px;">Peri&oacute;do</th>
															<th style="min-width:100px;">Otras Observaciones</th>		
															<th></th>												
														</tr>
													</thead>
													<tbody>';
													if($sw_receta == 1){
															$d = $det_recetas->buscardonde('ID_RECETA = '.$receta_id.'');
															While($d){
																$medicamentos->buscardonde('ID_MEDICAMENTO = '.$det_recetas->obtener('ID_MEDICAMENTO').'');
																$frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO = '.$det_recetas->obtener('ID_FRECUENCIA_TRATAMIENTO').'');
																$vias->buscardonde('ID_VIA = '.$det_recetas->obtener('ID_VIA').'');
																$periodo->buscardonde('ID_PERIODO = '.$det_recetas->obtener('ID_PERIODO_TRATAMIENTO').'');
																$cont.='
																	<tr>
																		<td>'.$medicamentos->obtener('DESCRIPCION').'</td>
																		<td>'.$det_recetas->obtener('DOSIS').'</td>
																		<td>'.$frecuencia->obtener('ABREVIATURA').'</td>
																		<td>'.$vias->obtener('ABREVIATURA').'</td>
																		<td>'.$det_recetas->obtener('TRATAMIENTO').'</td>
																		<td>'.$periodo->obtener('DESCRIPCION').'</td>
																		<td>'.$det_recetas->obtener('OTRAS_INDICACIONES').'</td>	
																		<td><a href="#modalMedicamento" onclick="obtener('.$det_recetas->obtener('ID_DETALLE_RECETA').')" id=""  class="btn btn-success btn-small" data-toggle="modal"  title="Editar Tratamiento""><span class="icon-pencil icon-white"></span></a>           </td>
																	</tr>
																
																';
																$d = $det_recetas->releer();
															}
													}else{
														
														$sql = 'SELECT MAX(ID_DETALLE_RECETA) as id from detalle_receta where id_receta = '.$receta_id.'';
														$matriz = $ds->db->obtenerArreglo($sql);
														$id_detalle = $matriz[0][id];
														$x = $det_recetas->buscardonde('ID_DETALLE_RECETA = '.$id_detalle.'');
														
														while($x) {
															$sw_form = 1;
																$medicamentos->buscardonde('ID_MEDICAMENTO = '.$det_recetas->obtener('ID_MEDICAMENTO').'');

																$otra_indic = $det_recetas->obtener('OTRAS_INDICACIONES');
																if(!empty($otra_indic)) {
																	$indicaciones = $det_recetas->obtener('OTRAS_INDICACIONES');													
																}else {
																	$indicaciones = "Ninguna Observaci&oacute;n";													
															}
															$cont.='
																<tr>
																	<td> 
																		<textarea name="medicamentos" id="medicamentos" placeholder="Medicamentos" '.$disable.' required="required" st yle="min-width:115px;">'.$medicamentos->obtener('DESCRIPCION').'</textarea>
																		<input type="hidden" name="idmedicamentos" id="idmedicamentos" value="'.$medicamentos->obtener('ID_MEDICAMENTO').'">			
																	</td>
																	<td><input style="width:45px;" type="text" name="cantdosis" id="cantdosis" '.$disable.' required="required" value="'.$det_recetas->obtener('DOSIS').'"></td>
																	<td>
																		<select name="frecuencia" id="frecuencia" required="required" style="width:70px" '.$disable.'>
																			<option value="0">Frec.</option>';	
															$x = $frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO > 0');																								
															while($x){
																if($frecuencia->obtener('ID_FRECUENCIA_TRATAMIENTO') == $det_recetas->obtener('ID_FRECUENCIA_TRATAMIENTO')){
																	$value = 'selected="selected"';												
																}else {
																	$value = '';
																}		
																$cont.='
																				<option value="'.$frecuencia->obtener('ID_FRECUENCIA_TRATAMIENTO').'" '.$value.'>'.$frecuencia->obtener('ABREVIATURA').'</option>											
																';
																$x = $frecuencia->releer();
															}
															$cont.='
																			</select>			
																		</td>
																		<td>
																			<select name="via" id="via" required="required" '.$disable.' style="width:60px">';
															$x = $vias->buscardonde('ID_VIA > 0');																								
															while($x){	
																if($vias->obtener('ID_VIA') == $det_recetas->obtener('ID_VIA')){
																	$value = 'selected="selected"';												
																}else {
																	$value = '';
																}												
																$cont.='
																				<option value="'.$vias->obtener('ID_VIA').'" '.$value.'>'.$vias->obtener('ABREVIATURA').'</option>											
																';
																$x = $vias->releer();
															}
															$cont.='
																			</select>
																		</td>
																		<td><input type="text" name="tratamiento" id="tratamiento" required="required" '.$disable.' style="width:75px;" value="'.$det_recetas->obtener('TRATAMIENTO').'"></td>
																		<td>
																			<select name="periodo" id="periodo" required="required" style="width:95px;" '.$disable.'>
																				<option value="0">Periodo</option>';										
															$x = $periodo->buscardonde('ID_PERIODO > 0');																								
															while($x){	
																if($periodo->obtener('ID_PERIODO') == $det_recetas->obtener('ID_PERIODO_TRATAMIENTO')){
																	$value = 'selected="selected"';												
																}else {
																	$value = '';
																}												
																$cont.='
																					<option value="'.$periodo->obtener('ID_PERIODO').'" '.$value.'>'.$periodo->obtener('DESCRIPCION').'</option>											
																';
																$x = $periodo->releer();
															}
															$cont.='
																			</select>
																		</td>
																		<td>
																			<textarea name="observaciones" id="observaciones" style="width:110px;" '.$disable.'>'.$indicaciones.'</textarea>	
																		</td>
																		<td>
																			<button type="submit" class="btn btn-default '.$disableClass.'">Agregar</button>												
																		</td>														
																	</tr>
																';
															$x = $det_recetas->releer();
														}

													}
													if($sw_form == 0){
														$cont.='
																<tr>
																	<td> 
																		<textarea name="medicamentos" id="medicamentos" placeholder="Medicamentos" '.$disable.' required="required" st yle="min-width:115px;"></textarea>
																		<input type="hidden" name="idmedicamentos" id="idmedicamentos">			
																	</td>
																	<td><input style="width:45px;" type="text" name="cantdosis" id="cantdosis" '.$disable.' required="required"></td>
																	<td>
																		<select name="frecuencia" id="frecuencia" required="required" style="width:70px" '.$disable.'>
																			<option value="0">Frec.</option>';	
															$x = $frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO > 0');																								
															while($x){
																$cont.='
																				<option value="'.$frecuencia->obtener('ID_FRECUENCIA_TRATAMIENTO').'" '.$value.'>'.$frecuencia->obtener('ABREVIATURA').'</option>											
																';
																$x = $frecuencia->releer();
															}
															$cont.='
																			</select>			
																		</td>
																		<td>
																			<select name="via" id="via" required="required" '.$disable.' style="width:60px">';
															$x = $vias->buscardonde('ID_VIA > 0');																								
															while($x){	
																$cont.='
																				<option value="'.$vias->obtener('ID_VIA').'" '.$value.'>'.$vias->obtener('ABREVIATURA').'</option>											
																';
																$x = $vias->releer();
															}
															$cont.='
																			</select>
																		</td>
																		<td><input type="text" name="tratamiento" id="tratamiento" required="required" '.$disable.' style="width:75px;"></td>
																		<td>
																			<select name="periodo" id="periodo" required="required" style="width:95px;" '.$disable.'>
																				<option value="0">Periodo</option>';										
															$x = $periodo->buscardonde('ID_PERIODO > 0');																								
															while($x){	
																$cont.='
																					<option value="'.$periodo->obtener('ID_PERIODO').'" '.$value.'>'.$periodo->obtener('DESCRIPCION').'</option>											
																';
																$x = $periodo->releer();
															}
															$cont.='
																			</select>
																		</td>
																		<td>
																			<textarea name="observaciones" id="observaciones" style="width:110px;" '.$disable.'></textarea>	
																		</td>
																		<td>
																			<button type="submit" class="btn btn-default '.$disableClass.'">Agregar</button>												
																		</td>														
																	</tr>
																';
													}
													
													
													
													$cont.='
												
													</tbody>
												</table>												
											</div>											
									</form>
									
									<!-- Formulario PopUp para editar receta -->									
									
									<div id="modalMedicamento" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<form method="POST" id="form_receta" class="receta" action="">
										  <div class="modal-header">
										    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
										    <h3 id="myModalLabel">Editar Tratamiento</h3>
										  </div>
										  <div class="modal-body">
										  <center>
										  	<table>
										  		<tbody>
										  			<tr>
										  				<td>Medicamento:</td>
										  				<td>
										  					<input type="text" name="medicamento" id="medicamento" class="medicamento" placeholder="Medicamentos" required="required" style="width:135px;">
													 		<input type="hidden" name="idmedicamento" id="idmedicamento" class="idmedicamento">
										  				</td>
										  			</tr>										  			
										  			<tr>
										  				<td>Cant. Dosis:</td>
										  				<td><input  type="text" name="cantdosis" id="cantdosis" class="cant" required="required" style="width:135px;"></td>
										  			</tr>
										  			<tr>
										  				<td>Frecuencia:</td>
										  				<td>
										  					<select name="frecuencia" id="frecuencia" required="required" class="frec">
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
										  				</td>
										  			</tr>
										  			<tr>
										  				<td>V&iacute;a</td>
										  				<td>
											  				<select name="via" id="via" class="via" required="required">
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
										  				</td>
										  			</tr>
										  			<tr>
										  				<td>Tratamiento:</td>
										  				<td><input type="text" name="tratamiento" id="tratamiento" class="tratamiento" required="required" style="width:135px;"></td>
										  			</tr>
										  			<tr>
										  				<td>Peri&oacute;do</td>
										  				<td>
															<select name="periodo" id="periodo" class="periodo" required="required">
																<option value="0">Periodo</option>';										
										$x = $periodo->buscardonde('ID_PERIODO > 0');																								
										while($x){												
											$cont.='
																<option value="'.$periodo->obtener('ID_PERIODO').'">'.$periodo->obtener('DESCRIPCION').'</option>											
											';
											$x = $periodo->releer();
										}
											$cont.='
															</select>										  				
										  				</td>
										  			</tr>
										  			<tr>
										  				<td>Otras Indicaciones:</td>
										  				<td><textarea name="observaciones" id="observaciones" class="indicacion" style="width:135px;"></textarea></td>
										  			</tr>										  			
										  		</tbody>												    
										  	</table>
										  	</center>
										  </div>
										  <div class="modal-footer">
										    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
										    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
										  </div>
									   </form>
									</div>									
									
								</div>
							</div>			
						</div>
						<form class="form-inline" method="POST" action="./?url=addmedicamento&id='.$idpaciente.''.$ids.''.$id_imp.'&t='.$t.''.$cuidado.''.$receta.'" style="margin:0px">
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
									Nombre del Medicamento: <input type="text" name="desc_medicamento" id="desc_medicamento" placeholder="Nombre del Medicamento">
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
									<form method="POST" action="./?url=agregarsoap&id='.$idpaciente.''.$ids.'&t='.$t.'&sw=6">							
										<table class="table2">											
											<tr>
												<td>Observaciones</td>
											</tr>';
			$obs_soap = $soap->obtener('OBSERVACIONES');
			if(!empty($obs_soap)){
				$img = '<img src="./iconos/save.png">';
			}else{
				$img = '';
			}
			$cont.='
											<tr>
												<td><textarea name="observaciones" placeholder="Observaciones" '.$disable.'>'.$soap->obtener('OBSERVACIONES').'</textarea>'.$img.'</td>
											</tr>
											<tr>
												<td><button type="submit" class="btn btn-default '.$disableClass.'">Guardar</button></td>											
											</tr>
										</table>
									</form>										
								</div>';
			if($t == 1){
							$cont.='
			
								<div class="span2">
									<table class="table2">											
										<tr>
											<td>SURCO</td>
										</tr>
										<tr>
											<td><a href="./?url=domiciliaria_surco&idp='.$idpaciente.''.$ids.'&t='.$_GET['t'].'" class="btn btn-primary '.$disableClass.'">SURCO</a></td>
										</tr>
									</table>
								</div>';
			}
			$cont.='
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
