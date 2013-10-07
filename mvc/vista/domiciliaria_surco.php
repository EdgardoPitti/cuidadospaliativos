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
	$cie = new Accesatabla('cie10');
	$sw = 0;
	$cedula = $_POST['cedula'];
	if(!empty($cedula) and !($personas->buscardonde('NO_CEDULA = "'.$cedula.'"'))){
		$sw = 1;
	}
	$ds = new Diseno();
	$cont='
		<fieldset>
			<legend align="center">
				<h3 style="background:#f4f4f4;padding:10px;"> Sistema Único de Referencia y Contrarreferencia</h3>
			</legend>';
	if (Empty($cedula) or $sw == 1){
		$cont.='
			<center>
			<form class="form-search" method="POST" action="./?url=domiciliaria_surco">
				<!--Buscar Paciente  <input type="search" id="cedula" placeholder="Cédula" name="cedula" class="input-medium search-query"> <button type="submit" class="btn">Buscar</button><br><br>-->
				<div class="input-group">
				  Buscar paciente: <input type="search" class="form-control" id="cedula" placeholder="Cédula" name="cedula">
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
		$cont.='<center>
				<table width="80%">
					<tr>
						<td width="50%">
							<fieldset>
								<legend>
									Paciente
								</legend>
									<table width="100%">											
										<tr>
											<td colspan="3"><h5>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</h5></td>
										</tr>
										<tr align="left">
											<td>'.$cedula.'</td>
											<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
											<td>'.$sexo.'</td>
										</tr>
										<tr align="left">
											<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
											<td>'.$asegurado.'</td>
											<td>'.$ds->edad($dia,$mes,$anio).'</td>
										</tr>
									</table>
							</fieldset>
						</td>
						<td>
							<fieldset>
								<legend>
									Dirección
								</legend>
									<table width="100%">
										<tr>
											<td>'.$distritos->obtener('DISTRITO').' , '.$provincias->obtener('PROVINCIA').'</td>
										</tr>
										<tr>
											<td>'.$corregimientos->obtener('CORREGIMIENTO').' , '.$residencia->obtener('DETALLE').'</td>
										</tr>
									</table>
							</fieldset>
						</td>
					</tr>
				</table>
				</center>
				<form method="POST" action="./?url=agregardatosurco&id='.$personas->obtener('ID_PACIENTE').'">
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">Referencia</a></li>
						<li><a href="#tabs-2">Respuesta a la Referencia</a></li>
					</ul>
					
					<div id="tabs-1">
						<button type="submit" class="btn btn-default">Imprimir</button>
						<button type="submit" class="btn btn-default">Descargar</button>
						<fieldset>
							<legend style="font-weight:bold;font-size:bold">Datos de Referencia</legend>
							<table class="tabla-datos">
								<tr>
									<td>Instalación que Refiere:</td>
									<td><select id="instalacionrefiere" name="instalacionrefiere" height="125px">
											<option value=""></option>';
			$i = $instituciones->buscardonde('ID_INSTITUCION > 0');
			while($i){
				$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$instituciones->obtener('ID_CORREGIMIENTO').'');
				$tipoinstitucion->buscardonde('ID_TIPO_INSTITUCION = '.$instituciones->obtener('ID_TIPO_INSTITUCION').'');
				$cont .= '
											<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$tipoinstitucion->obtener('TIPO_INSTITUCION').'-'.$instituciones->obtener('LUGAR').'-'.$corregimientos->obtener('CORREGIMIENTO').'</option>
				';
				$i = $instituciones->releer();
			}
			$cont.='
										</select>
									</td>
									<td>Servicio Médico al que se refiere:</td>
									<td><select id="serviciomedico" name="serviciomedico">
											<option value=""></option>';
			$s = $servicios->buscardonde('ID_SERVICIO > 0');
			while($s){
				$cont.='
											<option value="'.$servicios->obtener('ID_SERVICIO').'">'.$servicios->obtener('DESCRIPCION').'</option>
				';
				$s = $servicios->releer();
			}
			$cont.='					</select>
									</td>
								</tr>
								<tr>
									<td>Instalación Receptora:</td>
									<td><select id="instalacionreceptora" name="instalacionreceptora">
											<option value=""></option>';
				$i = $instituciones->buscardonde('ID_INSTITUCION > 0');
				while($i){
				$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$instituciones->obtener('ID_CORREGIMIENTO').'');
				$tipoinstitucion->buscardonde('ID_TIPO_INSTITUCION = '.$instituciones->obtener('ID_TIPO_INSTITUCION').'');
				$cont .= '
											<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$tipoinstitucion->obtener('TIPO_INSTITUCION').'-'.$instituciones->obtener('LUGAR').'-'.$corregimientos->obtener('CORREGIMIENTO').'</option>
				';
				$i = $instituciones->releer();
			}
			$cont.='						
										</select>
									</td>
									<td>Clasificación de la Atención solicitada:</td>
									<td><select id="clasificacionatencion" name="clasificacionatencion">
											<option value=""></option>';
			$c = $clasificacion->buscardonde('ID_CLASIFICACION_ATENCION_SOLICITADA');
			while($c){
				$cont.='
											<option value="'.$clasificacion->obtener('ID_CLASIFICACION_ATENCION_SOLICITADA').'">'.$clasificacion->obtener('CLASIFICACION_ATENCION_SOLICITADA').'</option>
				';
				$c = $clasificacion->releer();
			}
											
			$cont.='					</select>
									</td>
								</tr>
								<tr>
									<td>Motivo de Referencia:</td>
									<td><select id="motivoreferencia" name="motivoreferencia">
											<option value=""></option>';
			$m = $motivoreferencia->buscardonde('ID_MOTIVO_REFERENCIA > 0');
			while($m){
				$cont.='
											<option value="'.$motivoreferencia->obtener('ID_MOTIVO_REFERENCIA').'">'.$motivoreferencia->obtener('MOTIVO_REFERENCIA').'</option>
				';
				$m = $motivoreferencia->releer();
			}
			$cont.='										
										</select>
									</td>
									<td></td>
									<td></td>
								</tr>
							</table>
						</fieldset>	
						<div id="accordion">
							<h3>Historial del Paciente</h3>
							<div>
								<table class="tabla-datos" width="100%">
									<tr>
										<td>Anamnesis:</td>
										<td>Observaciones:</td>
									</tr>
									<tr>
										<td><textarea class="textarea" width="100%" id="anamnesis" name="anamnesis"></textarea></td>

										<td><textarea class="textarea" width="100%" id="observaciones" name="observaciones"></textarea></td>
									</tr>
									<tr>
										<td style="width:100px;">Examen Físico:</td>
										<td colspan="7"></td>										
									</tr>
								</table>	
									<table class="tabla" cellspacing="0">
										<tr>
											<th>Hora</th>
											<th>PA</th>
											<th>FC</th>
											<th>FR</th>
											<th>FCF</th>
											<th>T°</th>
											<th>Peso<small>(Kg)</small></th>
											<th>Talla<small>(mts)</small></th>
											
										</tr>
										<tr  align="center">
											<td><input style="width:50px;" type="text" name="hora" value="'.$ds->dime('hora').':'.$ds->dime('minuto').'"></td>
											<td><input style="width:50px;" type="text" name="pa"/></td>
											<td><input style="width:50px;" type="text" name="fc"/></td>
											<td><input style="width:50px;" type="text" name="fr"/></td>
											<td><input style="width:50px;" type="text" name="fcf"/></td>
											<td><input style="width:50px;" type="text" name="temperatura"/></td>
											<td><input style="width:50px;" type="text" name="peso"/></td>
											<td><input style="width:50px;" type="text" name="talla"/></td>
										</tr>
									</table>
							</div>
							<h3>Resultado de Exámenes/Diagnóstico</h3>
							<div>
								<div id="tabs2">
									<ul>
										<li><a href="#tabs2-1">BHC</a></li>
										<li><a href="#tabs2-2">Urin</a></li>
										<li><a href="#tabs2-3">Heces</a></li>
										<li><a href="#tabs2-4">Glicemia</a></li>
										<li><a href="#tabs2-5">Creatinina</a></li>
										<li><a href="#tabs2-6">N. de U.</a></li>
										<li><a href="#tabs2-7">Electrolitos</a></li>
										<li><a href="#tabs2-8">Amilasa</a></li>
									</ul>
									<div id="tabs2-1">
										<table class="tabla-datos">
											<tr align="center">
												<td align="right"> Diagnóstico:</td>
												<td><input type="text" name="diagnosticobhc" id="diagnosticobhc"></input></td>
												<td>Tratamiento/Complicaciones</td>		
											</tr>	
											<tr align="center">
												<td align="right">CIE-10: </td>
												<td><input type="text" id="ciebhc" name="ciebhc" size="5"></td>
												<td><textarea id="complicacionesbhc"  name="complicacionesbhc" class="textarea"></textarea></td>										
										</table>
									</div>
									<div id="tabs2-2">
										<table class="tabla-datos">
											<tr align="center">
												<td align="right"> Diagnóstico:</td>
												<td><input type="text" name="diagnosticourin" id="diagnosticourin"></input></td>
												<td>Tratamiento/Complicaciones</td>		
											</tr>	
											<tr align="center">
												<td align="right">CIE-10:</td>
												<td>
													<input type="text" id="cieurin" name="cieurin">
												</td>
												<td><textarea id="complicacionesurin" name="complicacionesurin" class="textarea"></textarea></td>									
										</table>
									</div>
									<div id="tabs2-3">
										<table class="tabla-datos">
											<tr align="center">
												<td align="right"> Diagnóstico:</td>
												<td><input type="text" name="diagnosticoheces" id="diagnosticoheces"></input></td>
												<td>Tratamiento/Complicaciones</td>		
											</tr>	
											<tr align="center">
												<td align="right">CIE-10:</td>
												<td>
													<input type="text" id="cieheces" name="cieheces">
												</td>
												<td><textarea id="complicacionesheces" name="complicacionesheces" class="textarea"></textarea></td>										
										</table>
									</div>
									<div id="tabs2-4">
										<table class="tabla-datos">
											<tr align="center">
												<td align="right"> Diagnóstico:</td>
												<td><input type="text" name="diagnosticoglice" id="diagnosticoglice"></input></td>
												<td>Tratamiento/Complicaciones</td>		
											</tr>	
											<tr align="center">
												<td align="right">CIE-10:</td>
												<td>
													<input type="text" id="cieglice" name="cieglice">
												</td>
												<td><textarea id="complicacionesglice" name="complicacionesglice" class="textarea"></textarea></td>										
										</table>
									</div>
									<div id="tabs2-5">
										<table class="tabla-datos">
											<tr align="center">
												<td align="right"> Diagnóstico:</td>
												<td><input type="text" name="diagnosticocrea" id="diagnosticocrea"></input></td>
												<td>Tratamiento/Complicaciones</td>		
											</tr>	
											<tr align="center">
												<td align="right">CIE-10:</td>
												<td>
													<input type="text" id="ciecrea" name="ciecrea">
												</td>
												<td><textarea id="complicacionescrea" name="complicacionescrea" class="textarea"></textarea></td>
										</table>
									</div>
									<div id="tabs2-6">
										<table class="tabla-datos">
											<tr align="center">
												<td align="right"> Diagnóstico:</td>
												<td><input type="text" name="diagnosticondeu" id="diagnosticondeu"></input></td>
												<td>Tratamiento/Complicaciones</td>		
											</tr>	
											<tr align="center">
												<td align="right">CIE-10:</td>
												<td>
													<input type="text" id="ciendu" name="ciendu">
												</td>
												<td><textarea id="complicacionesn" name="complicacionesn" class="textarea"></textarea></td>									
										</table>
									</div>
									<div id="tabs2-7">
										<table class="tabla-datos">
											<tr align="center">
												<td align="right"> Diagnóstico:</td>
												<td><input type="text" name="diagnosticoelec" id="diagnosticoelec"></input></td>
												<td>Tratamiento/Complicaciones</td>		
											</tr>	
											<tr align="center">
												<td align="right">CIE-10:</td>
												<td>
													<input type="text" id="cieelec" name="cieelec">
												</td>
												<td><textarea id="complicacioneselec"  name="complicacioneselec" class="textarea"></textarea></td>
										</table>
									</div>
									<div id="tabs2-8">
										<table class="tabla-datos">
											<tr align="center">
												<td align="right"> Diagnóstico:</td>
												<td><input type="text" name="diagnosticoami" id="diagnosticoami"></input></td>
												<td>Tratamiento/Complicaciones</td>		
											</tr>	
											<tr align="center">
												<td align="right">CIE-10:</td>
												<td>
													<input type="text" id="cieami" name="cieami">
												</td>
												<td><textarea id="complicacionesami" name="complicacionesami" class="textarea"></textarea></td>
										</table>
									</div>
								</div>
							</div>
							<h3>Datos del Profesional</h3>
							<div>
								<table class="tabla-datos">
									<tr>
										<td align="right">Nombre de quien refiere:</td>
<<<<<<< .mine
										<td  id="refiere" align="center"><input type="text" id="nombrerefiere"name="nombrerefiere"/></td>
=======
										<td  id="refiere"align="center"><input type="text" id="nombrerefiere" name="nombrerefiere"/></td>
>>>>>>> .r147
										<td></td>									
									</tr>
									<tr>
										<td align="right">Nombre del Receptor:</td>		
										<td align="center"><input type="text" name="receptor"/></td>
										<td><i>(Solo en caso de urgencias y hospitalización)</i></td>
									</tr>
								</table>
						</div>
					</div>
						<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:1px;float:right;">Registrar</button>
					</div>
					</form>
					<form method="POST" action="./?url=respuesta_referencia">	
						<div id="tabs-2">
							<button type="submit" class="btn btn-default">Imprimir</button>
							<button type="submit" class="btn btn-default">Descargar</button>
							<table class="tabla-datos" width="100%">
								<tr>
									<td style="wid th:90px">Institución que Responde:</td>
									<td><select id="institucionresponde" name="institucionresponde">
											<option value=""></option>';
											
			$i = $instituciones->buscardonde('ID_INSTITUCION > 0');
			while($i){
				$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$instituciones->obtener('ID_CORREGIMIENTO').'');
				$tipoinstitucion->buscardonde('ID_TIPO_INSTITUCION = '.$instituciones->obtener('ID_TIPO_INSTITUCION').'');
				$cont .= '
												<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$tipoinstitucion->obtener('TIPO_INSTITUCION').'-'.$instituciones->obtener('LUGAR').'-'.$corregimientos->obtener('CORREGIMIENTO').'</option>
				';
				$i = $instituciones->releer();
			}
			$cont.='
										</select>
									</td>
									<td>Instalación Receptora:</td>
									<td><select id="instalacionrepectora" name="instalacionreceptora">
											<option value=""></option>';
											
			$i = $instituciones->buscardonde('ID_INSTITUCION > 0');
			while($i){
				$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$instituciones->obtener('ID_CORREGIMIENTO').'');
				$tipoinstitucion->buscardonde('ID_TIPO_INSTITUCION = '.$instituciones->obtener('ID_TIPO_INSTITUCION').'');
				$cont .= '
												<option value="'.$instituciones->obtener('ID_INSTITUCION').'">'.$tipoinstitucion->obtener('TIPO_INSTITUCION').'-'.$instituciones->obtener('LUGAR').'-'.$corregimientos->obtener('CORREGIMIENTO').'</option>
				';
				$i = $instituciones->releer();
			}
			$cont.='
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4" class="fondo_azul">Respuesta a la Referencia</td>
								</tr>	
							</table>
							<div id="tabs3">
								<ul>
									<li><a href="#tabs3-1">Hallazgos Clínicos</a></li>
									<li><a href="#tabs3-2">Diagnóstico</a></li>
									<li><a href="#tabs3-3">Recomendaciones/Plan Terapéutico</a></li>
								</ul>							
								<div id="tabs3-1" style="font-size:12px;">
									<span style="font-size:12px;">Hallazgos Clínicos:</span>
									<textarea style="width:99%;height:100px;margin-right:10px;border-color:#ccc;"></textarea> 
								</div>
								<div id="tabs3-2" style="font-size:12px;">
									<center>
									<table width="50%">
										<tr>
											<td>
												<table width="50%">
													<tr width="100px">
														<td>Diagnóstico: </td>
														<td><input type="text" name="diagnosticorespuesta" id="diagnosticorespuesta"></td>
													</tr>
													<tr>
														<td>CIE-10: </td>
														<td><input type="text" id="cierespuesta" name="cierespuesta"></td>
													</tr>
													<tr>
														<td colspan="2">
															Observaciones:<br>
															<textarea name="observaciones2" style="min-width:300px;height:50px;border-color:#ccc;"></textarea>
														</td>
													</tr>
												</table>
											</td>
											<td>
												<table style="margin-left:20px;">
													<tr>
														<td>
															Manejo y Tratamiento:<br>
															<textarea name="manejo_tratamiento" style="min-width:300px;height:120px;border-color:#ccc;"></textarea>														
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									</center>
								</div>
								<div id="tabs3-3" style="font-size:12px;">
									<center>
										<table width="80%">
											<tr>
												<td>Reevaluación especializada: </td>
												<td class="radio"><input type="radio" name="reev_esp"/> Sí</td>
												<td class="radio"><input type="radio" name="reev_esp"/> No</td>
												<td>Fecha:</td>
												<td><input type="date" name="fecha"/></td>
											</tr>
											<tr>
												<td colspan="5">
													Observaciones: <br>
													<textarea name="observaciones_recomendaciones" style="width:100%;height:100px;border-color:#ccc;margin-right:10px;"></textarea>	
												</td>	
											</tr>
										</table>
									</center>	
								</div>
							</div>	
							<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;">+Nueva Nota</button>
							<button type="submit" class="btn btn-primary" style="font-size:12px;float:right;margin-top:8px;">Agregar</button>							
						</div>
					</form>	
				</div>
			</fieldset>
			';	
	}
	$ds->contenido($cont);
	$ds->mostrar();
?>
