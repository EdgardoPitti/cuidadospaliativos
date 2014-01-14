<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$instituciones = new Accesatabla('institucion');
	$tipoinstitucion = new Accesatabla('tipo_institucion');
	$clasificacion = new Accesatabla('clasificacion_atencion_solicitada');
	$servicios = new Accesatabla('servicios_medicos');
	$motivoreferencia = new Accesatabla('motivo_referencia');
	$surco = new Accesatabla('surco');
	$cie = new Accesatabla('cie10');
	$tipoexamen = new Accesatabla('tipo_examen');
	$frecuencia = new Accesatabla('frecuencia');
	$historia = new Accesatabla('historia_paciente');
	$examenfisico = new Accesatabla('examen_fisico');
	$resultado = new Accesatabla('resultados_examen_diagnostico');
	$detallediagnostico = new Accesatabla('detalle_diagnostico');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$sw = 0;
	$cedula = $_POST['cedula'];
	if(!empty($cedula) and !($personas->buscardonde('NO_CEDULA = "'.$cedula.'"'))){
		$sw = 1;
	}
	$ds = new Diseno();
	$cont='
			<center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;"> Sistema Único de Referencia y Contrarreferencia</h3>
			</center>';
	if (Empty($cedula) or $sw == 1){
		$cont.='
			<center>
				<form class="form-search" method="POST" action="./?url=domiciliaria_surco">
					<div class="input-group">
					  Buscar paciente: <input type="search" class="form-control" id="busqueda" placeholder="Cédula o Nombre" name="cedula" required>
					  <span class="input-group-btn">
						<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
					  </span>
					</div>
				</form>
			</center>';
		if($sw){
			$cont.='<center><a href="./?url=domiciliaria_capturardatos">Paciente no encontrado...Añadir</a></center>';
		}
	}else{
		$personas->buscardonde('NO_CEDULA = "'.$cedula.'"');
		$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$personas->obtener('ID_RESIDENCIA_HABITUAL').'');
		$tiposangre->buscardonde('ID_TIPO_SANGUINEO = '.$personas->obtener('ID_TIPO_SANGUINEO').'');
		$provincias->buscardonde('ID_PROVINCIA = '.$residencia->obtener('ID_PROVINCIA').'');
		$distritos->buscardonde('ID_DISTRITO = '.$residencia->obtener('ID_DISTRITO').'');
		$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$residencia->obtener('ID_CORREGIMIENTO').'');
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
					<div class="span6">
						<fieldset>
							<legend>
								Paciente
							</legend>
								<table class="table2">											
									<tr>
										<td colspan="3"><h5>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</h5></td>
									</tr>
									<tr>
										<td>'.$cedula.'</td>
										<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
										<td>'.$sexo.'</td>
									</tr>
									<tr>
										<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
										<td>'.$asegurado.'</td>
										<td>'.$ds->edad($dia,$mes,$anio).' Años</td>
									</tr>
								</table>
						</fieldset>
					</div>
					<div class="span6">
						<fieldset>
							<legend>
								Dirección
							</legend>
								<table class="table2" style="height:86px;">
									<tr>
										<td>'.$distritos->obtener('DISTRITO').' , '.$provincias->obtener('PROVINCIA').'</td>
									</tr>
									<tr>
										<td>'.$corregimientos->obtener('CORREGIMIENTO').' , '.$residencia->obtener('DETALLE').'</td>
									</tr>
								</table>
						</fieldset>
					</div>	
				</div>';
		$s = $surco->buscardonde('ID_PACIENTE = '.$personas->obtener('ID_PACIENTE').'');
		if($s == 1){
			$readonly = 'readonly';
			$disabled = 'disabled';
		}else{
			$readonly = '';
			$disabled = '';
		}
		
				$cont.='
					<!--REFERENCIA-->
					<div class="tabbable" id="tabs-1">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">Referencia</a></li>
							<li><a href="#tab2" data-toggle="tab">Respuesta a la Referencia</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">
							  <form method="POST" action="./?url=agregardatosurco&id='.$personas->obtener('ID_PACIENTE').'">
								<button type="submit" class="btn btn-default">Imprimir</button>
								<button type="submit" class="btn btn-default">Descargar</button>
								
								<div class="acordeon" style="margin-top:15px;">
									<div>
										<input id="acordeon1" name="accordion" type="radio"/>
										<label for="acordeon1">Datos Referencia</label>
										<article>
											<div class="row-fluid">
												<div class="span6">
													<table class="tabla-datos">
														<tr>
															<td>Instalación que Refiere:</td>
															<td><select id="instalacionrefiere" name="instalacionrefiere" height="125px" required '.$disabled.'>
																<option value=""></option>';
								$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
								while($i){
									if($instituciones->obtener('ID_INSTITUCION') == $surco->obtener('INSTALACION_REFIERE')){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									$cont .= '
																<option value="'.$instituciones->obtener('ID_INSTITUCION').'" '.$selected.'>'.$instituciones->obtener('DENOMINACION').'</option>
									';
									$i = $instituciones->releer();
								}
							$cont.='
																</select>
															</td>													
														</tr>
													</table>
												</div>												
												<div class="span6">
													<table class="tabla-datos">
														<tr>
															<td>Servicio Médico al que se refiere:</td>
															<td><select id="serviciomedico" name="serviciomedico" '.$disabled.'>
																	<option value=""></option>';
								$s = $servicios->buscardonde('ID_SERVICIO > 0');
								while($s){
									if($servicios->obtener('ID_SERVICIO') == $surco->obtener('ID_SERVICIO')){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									$cont.='
																	<option value="'.$servicios->obtener('ID_SERVICIO').'" '.$selected.'>'.$servicios->obtener('DESCRIPCION').'</option>
									';
									$s = $servicios->releer();
								}
								$cont.='
																</select>
															</td>
														</tr>
													</table>
												</div>												
											</div>
											<div class="row-fluid">
												<div class="span6">
													<table class="tabla-datos">												
														<tr>
															<td>Instalación Receptora:</td>
															<td><select id="instalacionreceptora" name="instalacionreceptora" '.$disabled.'>
																	<option value=""></option>';
									$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
									while($i){
										if($instituciones->obtener('ID_INSTITUCION') == $surco->obtener('INSTALACION_RECEPTORA')){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										$cont .= '
																	<option value="'.$instituciones->obtener('ID_INSTITUCION').'" '.$selected.'>'.$instituciones->obtener('DENOMINACION').'</option>
										';
										$i = $instituciones->releer();
									}
								$cont.='
																</select>
															</td>
														</tr>
													</table>
												</div>												
												<div class="span6">
													<table class="tabla-datos">												
														<tr>
															<td>Clasificación de la Atención solicitada:</td>
															<td><select id="clasificacionatencion" name="clasificacionatencion" '.$disabled.'>
																	<option value=""></option>';
								$c = $clasificacion->buscardonde('ID_CLASIFICACION_ATENCION_SOLICITADA');
								while($c){
									if($clasificacion->obtener('ID_CLASIFICACION_ATENCION_SOLICITADA') == $surco->obtener('ID_CLASIFICACION_ATENCION_SOLICITADA')){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									$cont.='
																	<option value="'.$clasificacion->obtener('ID_CLASIFICACION_ATENCION_SOLICITADA').'" '.$selected.'>'.$clasificacion->obtener('CLASIFICACION_ATENCION_SOLICITADA').'</option>
									';
									$c = $clasificacion->releer();
								}
																
								$cont.='	
																</select>
															</td>
														</tr>
													</table>
												</div>												
											</div>
											<div class="row-fluid">
												<div class="span6">
													<table class="tabla-datos">																								
														<tr>
															<td>Motivo de Referencia:</td>
															<td><select id="motivoreferencia" name="motivoreferencia" '.$disabled.'>
																	<option value=""></option>';
								$m = $motivoreferencia->buscardonde('ID_MOTIVO_REFERENCIA > 0');
								while($m){
									if($motivoreferencia->obtener('ID_MOTIVO_REFERENCIA') == $surco->obtener('ID_MOTIVO_REFERENCIA')){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									$cont.='
																	<option value="'.$motivoreferencia->obtener('ID_MOTIVO_REFERENCIA').'" '.$selected.'>'.$motivoreferencia->obtener('MOTIVO_REFERENCIA').'</option>
									';
									$m = $motivoreferencia->releer();
								}
								$cont.='		
																</select>
															</td>
														</tr>
													</table>
												</div>												
												<div class="span6"></div>												
											</div>	
										</article>
									</div>
									<div>
										<input id="acordeon2" name="accordion" type="radio" />
										<label for="acordeon2">Historial del Paciente</label>
										<article>	
											<div class="row-fluid">
												<div class="span12">
													<table class="table" style="margin-top:10px;">
														<tr>
															<td>Anamnesis:</td>
															<td>Observaciones:</td>
														</tr>';
						$historia->buscardonde('ID_HISTORIA_PACIENTE = '.$surco->obtener('ID_HISTORIA_PACIENTE').'');
						$examenfisico->buscardonde('ID_EXAMEN_FISICO = '.$historia->obtener('ID_EXAMEN_FISICO').'');
						$cont.='
														<tr>
															<td><textarea class="textarea" style="width:100%; max-width:30%;min-width:60%;" id="anamnesis" name="anamnesis" '.$readonly.'>'.$historia->obtener('ANAMNESIS').'</textarea></td>																												
															<td><textarea class="textarea" style="width:100%;max-width:30%;min-width:60%;" id="observaciones" name="observaciones" '.$readonly.'>'.$historia->obtener('OBSERVACIONES').'</textarea></td>
														</tr>
														<tr>
															<td style="text-align:left" colspan="2">Examen Físico:</td>									
														</tr>
													</table>
												</div>												
											</div>	
											
											<table class="tabla">
												<tr class="fd-table">
													<th>Hora</th>
													<th>Presión Arterial</th>
													<th>Frecuencia Cardiaca</th>
													<th>Frecuencia Respiratoria</th>
													<th>Frecuencia Cardiaca Fetal</th>
													<th>Temperatura</th>
													<th>Peso<small>(Kg)</small></th>
													<th>Talla<small>(mts)</small></th>
												</tr>
												<tr  align="center">
													<td><input style="width:50px;" type="text" name="hora" value="';
												$hora = $examenfisico->obtener('HORA');
												if($hora == ''){
													if($ds->dime('hora') < 10){
													$hora .= '0';
													}
													$hora .= $ds->dime('hora');
													$hora .= ':';
													if($ds->dime('minuto') < 10){
														$hora .= '0';
													}
													$hora .= $ds->dime('minuto');
												}								
										$cont.=		''.$hora.'" '.$readonly.'></td>
													<td><input style="width:50px;" type="text" name="pa" value="'.$examenfisico->obtener('PRESION_ARTERIAL').'" '.$readonly.'></td>
													<td><input style="width:50px;" type="text" name="fc" value="'.$examenfisico->obtener('FRECUENCIA_CARDIACA').'" '.$readonly.'></td>
													<td><input style="width:50px;" type="text" name="fr" value="'.$examenfisico->obtener('FRECUENCIA_RESPIRATORIA').'" '.$readonly.'></td>
													<td><input style="width:50px;" type="text" name="fcf" value="'.$examenfisico->obtener('FRECUENCIA_CARDIACA_FETAL').'" '.$readonly.'></td>
													<td><input style="width:50px;" type="text" name="temperatura" value="'.$examenfisico->obtener('TEMPERATURA').'" '.$readonly.'></td>
													<td><input style="width:50px;" type="text" name="peso" value="'.$examenfisico->obtener('PESO').'" '.$readonly.'></td>
													<td><input style="width:50px;" type="text" name="talla" value="'.$examenfisico->obtener('TALLA').'" '.$readonly.'></td>
												</tr>
											</table>
										</article>	
									</div>
									<div>
										<input id="acordeon3" name="accordion" type="radio" />
										<label for="acordeon3">Resultado de Exámenes/Diagnóstico</label>
										<article>
											<table class="table2">
												<tr>
													<th>Tipo de Examen</th>
													<th>Diagnóstico</th>
													<th>CIE-10</th>
													<th>Frecuencia</th>
													<th>Observaciones</th>
													<th>Tratamiento</th>
													<th>Fecha del Examen</th>
												</tr>	';
				$x = $tipoexamen->buscardonde('ID_TIPO_EXAMEN > 0');
				$n = 1;
				while($x){
					$nomb_examen = $tipoexamen->obtener('ID_TIPO_EXAMEN');
					$resultado->buscardonde('ID_SURCO = '.$surco->obtener('ID_SURCO').' AND ID_TIPO_EXAMEN = '.$tipoexamen->obtener('ID_TIPO_EXAMEN').'');
					if($n == 1){
						$detallediagnostico->buscardonde('ID_DIAGNOSTICO = '.$resultado->obtener('ID_DIAGNOSTICO').'');
						$n = 0;
					}else{
						$detallediagnostico->releer();
					}
					$cie->buscardonde('ID_CIE10 = "'.$detallediagnostico->obtener('ID_CIE10').'"');
					 $cont.='
												<tr>
													<td>'.$tipoexamen->obtener('TIPO_EXAMEN').'</td>
													<td><input type="text" style="width:70px;" name="diagnostico'.$nomb_examen.'" id="diagnostico'.$nomb_examen.'" value="'.$cie->obtener('DESCRIPCION').'" '.$readonly.'></td>
													<td><input type="text" style="width:50px;" name="cie'.$nomb_examen.'" id="cie'.$nomb_examen.'" size="5" value="'.$detallediagnostico->obtener('ID_CIE10').'" readonly></td>
													<td><select name="frec'.$nomb_examen.'" id="frec'.$nomb_examen.'" '.$disabled.'>
															<option value=""></option>
													';
														
					$f = $frecuencia->buscardonde('ID_FRECUENCIA > 0');
					while($f){
						if($frecuencia->obtener('ID_FRECUENCIA') == $detallediagnostico->obtener('ID_FRECUENCIA')){
							$selected = 'selected';
						}else{
							$selected = '';
						}
						$cont.='							<option value="'.$frecuencia->obtener('ID_FRECUENCIA').'" '.$selected.'>'.$frecuencia->obtener('FRECUENCIA').'</option>';
						$f = $frecuencia->releer();
					}
					$cont.='
														</select>
													</td>
													<td><input type="text" style="width:70px;" name="obser'.$nomb_examen.'" id="obser'.$nomb_examen.'" value="'.$detallediagnostico->obtener('OBSERVACION').'" '.$readonly.'></td>
													<td><input type="text" style="width:70px;" name="tratamiento'.$nomb_examen.'" id="tratamiento'.$nomb_examen.'" value="'.$resultado->obtener('TRATAMIENTO').'" '.$readonly.'></td>
													<td><input type="date" style="width:132px;" name="fec_examen_'.$nomb_examen.'" id="fec_examen_'.$nomb_examen.'" value="'.$resultado->obtener('FECHA').'" '.$readonly.'></td>
												</tr>';
					
					$x = $tipoexamen->releer();
				}
				$profesional->buscardonde('ID_PROFESIONAL = '.$surco->obtener('ID_PROFESIONAL').'');
				$cont.='
											</table>
										</article>	
									</div>
									
									<div>
										<input id="acordeon4" name="accordion" type="radio" />
										<label for="acordeon4">Datos del Profesional</label>
										<article>
											<div class="row-fluid" style="margin-top:10px">
												<div class="span6" align="center">Nombre de quien refiere:</div>
												<div class="span6" align="center"><input style="width:135px" type="text" id="nombrerefiere1" name="nombrerefiere1" value="'.$profesional->obtener('PRIMER_NOMBRE').' '.$profesional->obtener('SEGUNDO_NOMBRE').' '.$profesional->obtener('APELLIDO_PATERNO').' '.$profesional->obtener('APELLIDO_MATERNO').'" '.$readonly.'/> <input style="width:135px"  type="text" id="nombrerefiere" name="nombrerefiere" placeholder="C&eacute;dula Profesional"  value="'.$profesional->obtener('NO_CEDULA').'" readonly></div>
											</div>
											<div class="row-fluid">
												<div class="span6" align="center">Nombre del Receptor:</div>
												<div class="span6" align="center"><input style="width:135px" type="text" name="receptor" '.$readonly.'/><br><i><small>(Solo en caso de urgencias y hospitalización)</small></i></div>
											</div>									
										</article>
									</div>
								</div>';
								if($readonly == ''){
									$cont.='<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:1px;float:right;">Registrar</button>';
								}
							$cont.='
							   </form>
							</div>';		
		

				$cont.='
							<!--RESPUESTA A LA REFERENCIA -->
							<div class="tab-pane" id="tab2">
								<form method="POST" action="./?url=agregarrespuestareferencia&id='.$surco->obtener('ID_SURCO').'">	
									<button type="submit" class="btn btn-default">Imprimir</button>
									<button type="submit" class="btn btn-default">Descargar</button>		

									<div class="row-fluid">
										<div class="span6">
											<table class="tabla-datos">
												<tr>
													<td>Institución que Responde:</td>
													<td><select id="institucionresponde" name="institucionrespondereceptora">
															<option value=""></option>';
															
							$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
							while($i){
								$cont .= '
															<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$instituciones->obtener('DENOMINACION').'</option>
								';
								$i = $instituciones->releer();
							}
							$cont.='			
														</select>
													</td>
												</tr>
											</table>
										</div>
										<div class="span6">
											<table class="tabla-datos">
												<tr>
													<td>Instalación Receptora:</td>
													<td><select id="instalacionrepectora" name="instalacionreceptorarespuesta">
															<option value=""></option>';
															
							$i = $instituciones->buscardonde('ID_INSTITUCION > 0 ORDER BY DENOMINACION');
							while($i){
								$cont .= '
															<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$instituciones->obtener('DENOMINACION').'</option>
								';
								$i = $instituciones->releer();
							}
							$cont.='
															
														</select>
													</td>
												</tr>
											</table>
										</div>
									</div>

									<div class="acordeon">
										<div>
											<input type="radio" name="acc" id="acc-1">
											<label for="acc-1">Hallazgos Clínicos</label>
											<article>
												<div class="row-fluid">
													<div class="span6">
														<table class="table2" style="font-size:12px;">
															<tr>
																<td>Diagnóstico:</td>
																<td><input type="text" name="diagnosticorespuesta" id="diagnosticorespuesta"></td>
															</tr>
															<tr>
																<td>CIE-10:</td>
																<td><input type="text" id="cierespuesta" name="cierespuesta" readonly></td>
															</tr>
															<tr>
																<td>Frecuencia:</td>
																<td>
																	<select id="frecuenciarespuesta" name="frecuenciarespuesta">
																		<option value=""></option>';
																
		$f = $frecuencia->buscardonde('ID_FRECUENCIA > 0');
		while($f){
			$cont.='
																		<option value="'.$frecuencia->obtener('ID_FRECUENCIA').'">'.$frecuencia->obtener('FRECUENCIA').'</option>';
			$f = $frecuencia->releer();
		}		
		$cont.='														
																	</select>
																</td>
															</tr>
														</table>
													</div>
													<div class="span6">
														<table class="table2" style="font-size:12px;">
															<tr>
																<td>Hallazgos Clinicos:</td>
																<td><input type="text" id="observrespuesta" name="hallazgosclinicos"></td>
															</tr>
															<tr>
																<td>Observaciones:</td>
																<td><input type="text" id="observrespuesta" name="observrespuesta"></td>
															</tr>
															<tr>
																<td>Manejo y Tratamiento:</td>
																<td><input type="text" id="manejo_tratamiento" name="manejo_tratamiento"></td>
															</tr>
														</table>
													</div>
												</div>
											</article>
										</div>
										<div>
											<input type="radio" name="acc" id="acc-2">
											<label for="acc-2">Datos del Profesional</label>
											<article>
												<center>
													<div class="row-fluid">
														<div class="span6">
															Reevaluación especializada:
														</div>
														<div class="span6">
															<table width="30%">
																<tr>
																	<td style="text-align:center">
																		<input type="radio" style="display:inline-block" name="reev_esp" id="reev_esp" value="1" checked/><span style="padding-top:4px"> Sí </span>
																	</td>
																	<td style="text-align:center">
																		<input type="radio" style="display:inline-block" name="reev_esp" id="reev_esp" value="0"/> <span style="padding-top:4px"> No </span>
																	</td>
																</tr>
															</table>
															
														</div>
													</div>
													<div class="row-fluid">
														<div class="span6">
															Fecha:
														</div>
														<div class="span6">
															<input type="date" name="fecharespuesta"/>
														</div>
													</div>
													<div class="row-fluid">
														<div class="span6">
															Profesional:
														</div>
														<div class="span6">
															<input type="text" id="profesionalrespuesta1" name="profesionalrespuesta1">&nbsp;<input type="text" id="profesionalrespuesta" name="profesionalrespuesta" placeholder="C&eacute;dula Profesional" readonly>
														</div>
													</div>
												</center>
											</article>
										</div>
									</div>	
									<button type="submit" class="btn btn-primary" style="font-size:12px;float:right;margin-top:8px;">Agregar</button>							
								</form>	
							</div>	
				</div>
			';	
	}
	$ds->contenido($cont);
	$ds->mostrar();
?>
