<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$personas = new Accesatabla('personas');
	$sangre = new Accesatabla('tipos_de_sangre');
	$nacionalidades = new Accesatabla('nacionalidades');
	$etnia = new Accesatabla('etnia');
	$ds = new Diseno();
	$cedula = $_POST['cedula'];
	$cont='
			<center>
				<fieldset>
					<legend>
						Registro de Visitas Domiciliarias
					</legend>
						Introduzca el número de cédula del paciente, y añada las observaciones pertinentes.<br><br>
						<form method="POST" action=".?url=registrovisitasdomiciliaria">Buscar: <input type="search" id="cedula" name="cedula"><button>Buscar</button></form>
				</fieldset>
			</center>
	';
	if(!empty($cedula)){
		$personas->buscardonde('cedula = "'.$cedula.'"');
		if($personas->obtener('femenino')){
			$sexo = 'Femenino';
		}else{
			$sexo = 'Masculino';
		}
		$cont.='
				<table width="100%">
					<tr>
						<td width="50%">
							<fieldset>
								<legend>
									Datos Generales del Paciente
								</legend>
								<center>
									<table>
										<tr>
											<td align="right">Cedula: </td>
											<td>&nbsp</td>
											<td>'.$cedula.'</td>
										</tr>
										<tr>
											<td align="right">Nombres: </td>
											<td></td>
											<td>'.$personas->obtener('primer_nombre').' '.$personas->obtener('segundo_nombre').'</td>
										</tr>
										<tr>
											<td align="right">Apellidos: </td>
											<td></td>
											<td>'.$personas->obtener('primer_apellido').' '.$personas->obtener('segundo_apellido').'</td>
										</tr>
										<tr>
											<td align="right">Tipo de Sangre: </td>
											<td></td>
											<td>'.$sangre->renombrar($personas->obtener('id_tipo_de_sangre'), tipo_sangre).'</td>
										</tr>
										<tr>
											<td align="right">Sexo: </td>
											<td></td>
											<td>'.$sexo.'</td>
										</tr>
										<tr>
											<td align="right">Nacionalidad: </td>
											<td></td>
											<td>'.$nacionalidades->renombrar($personas->obtener('id_nacionalidad'), nacionalidad).'</td>
										</tr>
										<tr>
											<td align="right">Etnia: </td>
											<td></td>
											<td>'.$etnia->renombrar($personas->obtener('id_etnia'), descripcion).'</td>
										</tr>
									</table>
								</center>
							</fieldset>
						</td>
						<td width="50%">
							<fieldset>
								<legend>
									Añadir Observaciones
								</legend>
								<form method="POST" action="./?url=">
									<textarea id="observaciones" name="observaciones" rows="8" cols="45"></textarea>
									<button>Añadir</button>
								</form>
								
							</fieldset>
						</td>
					</tr>
				</table>
		';
	}
	$ds->contenido($cont);
	$ds->mostrar();


?>