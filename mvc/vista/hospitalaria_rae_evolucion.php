<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$condicionsalida = new Accesatabla('condiciones_de_salida');
	$ds = new Diseno();
	$buscar = $_POST['buscar'];
	$cont.='
		<h3>Registro de Admisión-Egreso (RAE)</h3><br><br>
		<form method="POST" action="./?url=hospitalaria_rae_evolucion">
			<input type="search" id="buscar" name="buscar">
			<input type="radio" id="tipobusqueda" name="tipobusqueda" value="0" select> Cédula
			<input type="radio" id="tipobusqueda" name="tipobusqueda" value="1"> Nombre
			<button>Enviar</button>
		</form>
	';
	$cont.='
		<form method="POST" action="./?url=">
				<div id="accordion">
					<h3>Datos de Referencia</h3>
						<div>
							<table style="font-size:12px">
								<tr>
									<td>Institución:</td>
									<td><input type="text" id="institucion" name="institucion"></td>
									<td></td>
									<td>Referido de: </td>
									<td><select id="referidode">
											<option value="0"></option>
											<option value="1">Consulta Exter.</option>
											<option value="2">Urgencia</option>
											<option value="3">Otra Institución</option>
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
											<td align="center"><textarea id="diagnosticoadmision" name="diagnosticoadmision"></textarea></td>
											<td align="center"><textarea id="diagnosticoegreso" name="diagnosticoegreso"></textarea></td>
											<td align="center"><textarea id="tratamiento" name="tratamiento"></textarea></td>
											<td align="center"><select id="condicionsalida" name="condicionsalida">
													<option value="0"></option>';
$c = $condicionsalida->buscardonde('id > 0');
while($c){
		$cont.='
													<option value="'.$condicionsalida->obtener('id').'">'.$condicionsalida->obtener('descripcion').'</option>
		';
		$c = $condicionsalida->releer();
}					
	$cont.='									</select>
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
										<td><textarea id="evolucion" name="evolucion" rows="3" cols="122" ></textarea></td>
									</tr>
							</table>
						</div>
				</div>
			<button>Enviar</button>
		</form>
	';
	$ds->contenido($cont);
	$ds->mostrar();


?>