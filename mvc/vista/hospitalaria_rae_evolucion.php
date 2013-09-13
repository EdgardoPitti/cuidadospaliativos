<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$condicionsalida = new Accesatabla('condicion_salida');
	$instituciones = new Accesatabla('institucion');
	$tipoinstitucion = new Accesatabla('tipo_institucion');
	$corregimientos = new Accesatabla('corregimientos');
	$referido = new Accesatabla('referido');
	$ds = new Diseno();
	$buscar = $_POST['buscar'];
	$cont.='
	  <center><h3 style="background:#f4f4f4;"> Registro de Admisión-Egreso (RAE)</h3></center>
		<br><br>';
		
	if(empty($buscar)){
		$cont.='
			<center>
				<form class="form-search" method="POST" action="./?url=hospitalaria_rae_evolucion">
					<!--Buscar Paciente  <input type="search" id="cedula" placeholder="Cédula" name="cedula" class="input-medium search-query"> <button type="submit" class="btn">Buscar</button><br><br>-->
					<div class="input-group">
					  Buscar paciente: <input type="search" class="form-control" id="cedula" placeholder="Cédula o Nombre" name="buscar" id="buscar">
					  <span class="input-group-btn">
						<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
					  </span>
					</div>
				</form>
			</center>';
		
	}else{
			$cont.='
				<form method="POST" action="./?url=">
						<div id="accordion">
							<h3>Datos de Referencia</h3>
								<div>
									<table style="font-size:12px">
										<tr>
											<td>Institución:</td>
											<td><select id="institucion" name="institucion">
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
											<td></td>
											<td>Referido de: </td>
											<td><select id="referido" name="referido">
													<option value="0"></option>';
			$r = $referido->buscardonde('ID_REFERIDO > 0');
			while($r){
				$cont.='
													<option value="'.$referido->obtener('ID_REFERIDO').'">'.$referido->obtener('REFERIDO').'</option>
				';
				$r = $referido->releer();
			}
			$cont.='
												</select>
											</td>
											<td>
												<div id="otrainstitucion" name="otrainstitucion">
													&nbsp;
													&nbsp;
													&nbsp;
												</div>
											</td>
										</tr>
									</table>					
								</div>
							<h3>Datos de Hospitalización</h3>
								<div>
									<center>
										<table style="font-size:12px" width="100%">
												<tr>
													<td align="center">Diagnóstico de Admisión:</td>
													<td align="center">Diagnóstico de Egreso:</td>
													<td align="center">Tratamiento: </td>
													<td align="center">Condición de Salida: </td>
												</tr>
												<tr>
													<td align="center"><textarea class="textarea" id="diagnosticoadmision" name="diagnosticoadmision"></textarea></td>
													<td align="center"><textarea class="textarea" id="diagnosticoegreso" name="diagnosticoegreso"></textarea></td>
													<td align="center"><textarea class="textarea" id="tratamiento" name="tratamiento"></textarea></td>
													<td align="center"><select id="condicionsalida" name="condicionsalida">
																			<option value="0"></option>';
			$c = $condicionsalida->buscardonde('id > 0');
			while($c){
					$cont.='
																			<option value="'.$condicionsalida->obtener('id').'">'.$condicionsalida->obtener('descripcion').'</option>
						';
					$c = $condicionsalida->releer();
			}					
			$cont.='												</select>
													</td>
												</tr>
										</table>
									</center>
								</div>
							<h3>Datos de Evolución</h3>
								<div>
									<table style="font-size:12px" width="100%">
											<tr>
												<td>Evolución:</td>
											</tr>
											<tr>
												<td><textarea class="textarea" id="evolucion" name="evolucion" rows="3" cols="122" ></textarea></td>
											</tr>
									</table>
								</div>
						</div>
					<button>Enviar</button>
				</form>
			';
	}

	$ds->contenido($cont);
	$ds->mostrar();


?>