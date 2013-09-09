<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$personas = new Accesatabla('personas');
	$tiposangre = new Accesatabla('tipos_de_sangre');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$cedula = $_POST['cedula'];
	$ds = new Diseno();
	$cont='
		<fieldset>
			<legend align="center">
				<h3 style="background:#f4f4f4;"> Sistema Único de Referencia y Contrarreferencia</h3>
			</legend>';
	if (Empty($cedula)){
		$cont.='
			<form class="form-search" method="POST" action="./?url=domiciliaria_surco">
				<!--Buscar Paciente  <input type="search" id="cedula" placeholder="Cédula" name="cedula" class="input-medium search-query"> <button type="submit" class="btn">Buscar</button><br><br>-->
				<div class="input-group">
				  <input type="search" class="form-control" id="cedula" placeholder="Cédula" name="cedula">
				  <span class="input-group-btn">
					<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
				  </span>
				</div>
				
			</form>';
	}else{
		$personas->buscardonde('cedula = "'.$cedula.'"');
		$tiposangre->buscardonde('id = '.$personas->obtener('id_tipo_de_sangre').'');
		$provincias->buscardonde('id = '.$personas->obtener('id_provincia_residencia').'');
		$distritos->buscardonde('id = '.$personas->obtener('id_distrito_residencia').'');
		$corregimientos->buscardonde('id = '.$personas->obtener('id_corregimiento_residencia').'');
		if ($personas->obtener('femenino')){
			$sexo = 'Femenino';
		}else{
			$sexo = 'Masculino';
		}
		if($personas->obtener('asegurado')){
			$asegurado = 'Asegurado';
		}else{
			$asegurado = 'No Asegurado';
		}
		list($anio, $mes, $dia) = explode("-", $personas->obtener('fecha_de_nacimiento'));
		$cont.=' <table width="100%">
					<tr>
						<td>
							<fieldset>
								<legend>
									Paciente
								</legend>
									<table width="100%">											
										<tr>
											<td colspan="3"><h5>'.$personas->obtener('primer_nombre').' '.$personas->obtener('segundo_nombre').' '.$personas->obtener('primer_apellido').' '.$personas->obtener('segundo_apellido').'</h5></td>
										</tr>
										<tr align="left">
											<td>'.$cedula.'</td>
											<td>'.$tiposangre->obtener('tipo_sangre').'</td>
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
											<td>'.$distritos->obtener('descripcion').' , '.$provincias->obtener('descripcion').'</td>
										</tr>
										<tr>
											<td>'.$corregimientos->obtener('descripcion').' , '.$personas->obtener('direccion_detallada').'</td>
										</tr>
									</table>
							</fieldset>
						</td>
					</tr>
				</table>
				
				
		';
	}
	
	$cont.='
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
							<td></td>
							<td>Servicio Médico al que se refiere:</td>
							<td></td>
						</tr>
						<tr>
							<td>Instalación Receptora:</td>
							<td></td>
							<td>Clasificación de la Atención solicitada:</td>
							<td></td>
						</tr>
						<tr>
							<td>Motivo de Referencia:</td>
							<td></td>
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
								<td colspan="7"></td>
							</tr>
							<tr>
								<td colspan="8"><textarea class="textarea" width="100%"></textarea></td>
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
									<td>10:30 A.M.</td>
									<td><input style="width:70px;" type="text" name="pa"/></td>
									<td><input style="width:70px;" type="text" name="fc"/></td>
									<td><input style="width:70px;" type="text" name="fr"/></td>
									<td><input style="width:70px;" type="text" name="fcf"/></td>
									<td><input style="width:70px;" type="text" name="temperatura"/></td>
									<td><input style="width:70px;" type="text" name="peso"/></td>
									<td><input style="width:70px;" type="text" name="talla"/></td>
									<td style="background:transparent;border:1px solid #fafafa;"><a class="btn btn-xs" href="./?url=registrar" title="Registrar">Registrar</a></td>
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
										<td><input type="text" name="hallaz_diag"></input></td>
										<td>Tratamiento/Complicaciones</td>		
										<td>Observaciones:</td>
									</tr>	
									<tr align="center">
										<td align="right">CIE-10</td>
										<td>
											<select>
												<option value="1">opcion 1</option>
												<option value="2">opcion 2</option>																				
											</select>
										</td>
										<td><textarea class="textarea"></textarea></td>
										<td><textarea class="textarea"></textarea></td>										
								</table>
							</div>
							<div id="tabs2-2">
								<table class="tabla-datos">
									<tr align="center">
										<td align="right"> Diagnóstico:</td>
										<td><input type="text" name="hallaz_diag"></input></td>
										<td>Tratamiento/Complicaciones</td>		
										<td>Observaciones:</td>
									</tr>	
									<tr align="center">
										<td align="right">CIE-10</td>
										<td>
											<select>
												<option value="1">opcion 1</option>
												<option value="2">opcion 2</option>																				
											</select>
										</td>
										<td><textarea class="textarea"></textarea></td>
										<td><textarea class="textarea"></textarea></td>										
								</table>
							</div>
							<div id="tabs2-3">
								<table class="tabla-datos">
									<tr align="center">
										<td align="right"> Diagnóstico:</td>
										<td><input type="text" name="hallaz_diag"></input></td>
										<td>Tratamiento/Complicaciones</td>		
										<td>Observaciones:</td>
									</tr>	
									<tr align="center">
										<td align="right">CIE-10</td>
										<td>
											<select>
												<option value="1">opcion 1</option>
												<option value="2">opcion 2</option>																				
											</select>
										</td>
										<td><textarea class="textarea"></textarea></td>
										<td><textarea class="textarea"></textarea></td>										
								</table>
							</div>
							<div id="tabs2-4">
								<table class="tabla-datos">
									<tr align="center">
										<td align="right"> Diagnóstico:</td>
										<td><input type="text" name="hallaz_diag"></input></td>
										<td>Tratamiento/Complicaciones</td>		
										<td>Observaciones:</td>
									</tr>	
									<tr align="center">
										<td align="right">CIE-10</td>
										<td>
											<select>
												<option value="1">opcion 1</option>
												<option value="2">opcion 2</option>																				
											</select>
										</td>
										<td><textarea class="textarea"></textarea></td>
										<td><textarea class="textarea"></textarea></td>										
								</table>
							</div>
							<div id="tabs2-5">
								<table class="tabla-datos">
									<tr align="center">
										<td align="right"> Diagnóstico:</td>
										<td><input type="text" name="hallaz_diag"></input></td>
										<td>Tratamiento/Complicaciones</td>		
										<td>Observaciones:</td>
									</tr>	
									<tr align="center">
										<td align="right">CIE-10</td>
										<td>
											<select>
												<option value="1">opcion 1</option>
												<option value="2">opcion 2</option>																				
											</select>
										</td>
										<td><textarea class="textarea"></textarea></td>
										<td><textarea class="textarea"></textarea></td>										
								</table>
							</div>
							<div id="tabs2-6">
								<table class="tabla-datos">
									<tr align="center">
										<td align="right"> Diagnóstico:</td>
										<td><input type="text" name="hallaz_diag"></input></td>
										<td>Tratamiento/Complicaciones</td>		
										<td>Observaciones:</td>
									</tr>	
									<tr align="center">
										<td align="right">CIE-10</td>
										<td>
											<select>
												<option value="1">opcion 1</option>
												<option value="2">opcion 2</option>																				
											</select>
										</td>
										<td><textarea class="textarea"></textarea></td>
										<td><textarea class="textarea"></textarea></td>										
								</table>
							</div>
							<div id="tabs2-7">
								<table class="tabla-datos">
									<tr align="center">
										<td align="right"> Diagnóstico:</td>
										<td><input type="text" name="hallaz_diag"></input></td>
										<td>Tratamiento/Complicaciones</td>		
										<td>Observaciones:</td>
									</tr>	
									<tr align="center">
										<td align="right">CIE-10</td>
										<td>
											<select>
												<option value="1">opcion 1</option>
												<option value="2">opcion 2</option>																				
											</select>
										</td>
										<td><textarea class="textarea"></textarea></td>
										<td><textarea class="textarea"></textarea></td>										
								</table>
							</div>
							<div id="tabs2-8">
								<table class="tabla-datos">
									<tr align="center">
										<td align="right"> Diagnóstico:</td>
										<td><input type="text" name="hallaz_diag"></input></td>
										<td>Tratamiento/Complicaciones</td>		
										<td>Observaciones:</td>
									</tr>	
									<tr align="center">
										<td align="right">CIE-10</td>
										<td>
											<select>
												<option value="1">opcion 1</option>
												<option value="2">opcion 2</option>																				
											</select>
										</td>
										<td><textarea class="textarea"></textarea></td>
										<td><textarea class="textarea"></textarea></td>										
								</table>
							</div>
						</div>
					</div>
					<h3>Datos del Profesional</h3>
					<div>
						<table class="tabla-datos" width="100%">
							<tr align="center">
								<td width="25%">Nombre de quien refiere:</td>									
							</tr>
							<tr align="center">
								<td><input type="text" name="refiere"/></td>
								<td><input type="radio" name="galeno">  Médico Gral.</input></td>										
								<td><input type="radio" name="galeno">  Odontólogo</input></td>										
								<td><input type="radio" name="galeno">  Médico Especializado</input></td>										
							</tr>
							<tr align="center">
								<td width="25%">Nombre del Receptor:</td>										
							</tr>
							<tr align="center">
								<td width="25%"><input type="text" name="receptor"/></td>
								<td width="25%"><i>(Solo en caso de urgencias y hospitalización)</i></td>
								<td colspan="2"></td>
							</tr>
						</table>
				</div>
			</div>
				<button type="submit" class="btn btn-primary btn-lg" style="margin-top:10px;">Registrar</button>
			</div>
			
			<div id="tabs-2">
				<button type="submit" class="btn btn-default">Imprimir</button>
				<button type="submit" class="btn btn-default">Descargar</button>
				<table class="tabla-datos" width="100%">
					<tr>
						<td style="width:90px">Institución que Responde:</td>
						<td>
							<select>
								<option value="1">hospital</option>
								<option value="2">hospital</option>
								<option value="3">hospital</option>
							</select>
						</td>
						<td>Instalación Receptora:</td>
						<td>
							<select>
								<option value="1">centro de salud</option>
								<option value="2">centro de salud</option>
								<option value="3">centro de salud</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="4" style="color:#fff;background:#47a3da;margin-top:5px;padding:10px;font-size:13px;font-weight:bold;text-shadow: #000 1px 1px 1px;">Respuesta a la Referencia</td>
					</tr>	
				</table>
			</div>
		</div>
	</fieldset>
	';	
		
	$ds->contenido($cont);
	$ds->mostrar();
?>