<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$esp_medicas = new Accesatabla('especialidades_medicas');
	$datos_prof_salud = new Accesatabla('datos_profesionales_salud');
	
	$cont = '
		<fieldset>
			<legend align="center">
				<h3 style="background:#f4f4f4;padding:10px;">Profesional de la Salud</h3>
			</legend>
			<center>
				<form method="POST" action="./?url=agregardatosprofesional">	
					<table>
						<tr>
							<td>Cédula: </td>
							<td><input type="text" name="cedula" id="cedula" required></td>
						</tr>
						<tr>	
							<td>Primer Nombre: </td>
							<td><input type="text" name="primernombre" id="primernombre" required></td>
						</tr>
						<tr>
							<td>Segundo Nombre: </td>
							<td><input type="text" name="segnombre" id="segnombre"></td>
						</tr>
						<tr>	
							<td>Apellido Paterno: </td>
							<td><input type="text" name="primerapellido" id="primerapellido" required></td>
						</tr>
						<tr>
							<td>Apellido Materno: </td>
							<td><input type="text" name="segapellido" id="segapellido"></td>
						</tr>
						<tr>	
							<td>No de Idoneidad: </td>
							<td><input type="text" name="idoneidad" id="idoneidad"></td>
						</tr>
						<tr>
							<td>No de Registro: </td>
							<td><input type="text" name="registro" id="registro"></td>
						</tr>
						<tr>	
							<td>Teléfono de Casa: </td>
							<td><input type="text" name="telefono" id="telefono"></td>
						</tr>
						<tr>
							<td>Teléfono Celular: </td>
							<td><input type="text" name="celular" id="celular"></td>
						</tr>
						<tr>	
							<td>Correo Electrónico: </td>
							<td><input type="text" name="email" id="email"></td>
						</tr>
						<tr>
							<td>Especialidad Médica: </td>
							<td>
								<select name="especialidad" id="especialidad">
									<option value=""> </option>';
						$x = $esp_medicas->buscardonde('ID_ESPECIALIDAD_MEDICA');			
						while($x){
							$cont.='<option value="'.$esp_medicas->obtener('ID_ESPECIALIDAD_MEDICA').'">'.$esp_medicas->obtener('DESCRIPCION').'</option>';
							$x = $esp_medicas->releer();
						}
						$cont.='			
								</select>
							</td>
						</tr>
					</table>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>	
			</center>
		</fieldset>
	
	';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>