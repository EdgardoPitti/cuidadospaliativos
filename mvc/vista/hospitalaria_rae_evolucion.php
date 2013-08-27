<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont='
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
						<table style="font-size:12px">
								<tr>
									as
								</tr>
						</table>
					</div>
				<h3>Datos de Evolución</h3>
					<div>
						<table style="font-size:12px">
								<tr>
									as
								</tr>
						</table>
					</div>
			</div>
	';
	$ds->contenido($cont);
	$ds->mostrar();


?>