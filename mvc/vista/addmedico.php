<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$esp_medicas = new Accesatabla('especialidades_medicas');
	$datos = new Accesatabla('datos_profesionales_salud');
	$profesional = new Accesatabla('profesionales_salud');
	$cedula = $_POST['buscar_cedula'];
	if(empty($cedula)){
		$cedula = $_GET['idp'];
	}
	
	$ds = new Diseno();
	$cont .= '
		
			<center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Agregar o Editar Profesional de la Salud</h3>
				<form class="form-search" method="POST" action="./?url=addmedico&sbm=5">
						<div class="input-group">
						  Buscar Profesional: <input type="search" class="form-control" id="buscar_profesional" placeholder="Cédula o Nombre" name="buscar_cedula">
						  <span class="input-group-btn">
							<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
						  </span>
						</div>
				</form>';
	$d = $datos->buscardonde('NO_CEDULA = "'.$cedula.'" OR ID_PROFESIONAL = "'.$cedula.'"');
	if($d){
		$readonly = 'readonly';
		$profesional->buscardonde('ID_PROFESIONAL = '.$datos->obtener('ID_PROFESIONAL').'');
	}
	$cont.='
				<form method="POST" action="./?url=agregardatosprofesional&idp='.$datos->obtener('ID_PROFESIONAL').'&sbm=5">	
					<table>
						<tr>
							<td>No de C&eacute;dula: </td>
							<td><input type="text" name="cedula" id="cedula" placeholder="No de C&eacute;dula" value="'.$datos->obtener('NO_CEDULA').'" '.$readonly.' required ></td>
						</tr>
						<tr>	
							<td>Primer Nombre: </td>
							<td><input type="text" name="primernombre" id="primernombre" placeholder="Primer Nombre" value="'.$datos->obtener('PRIMER_NOMBRE').'" required></td>
						</tr>
						<tr>
							<td>Segundo Nombre: </td>
							<td><input type="text" name="segnombre" id="segnombre" placeholder="Segundo Nombre" value="'.$datos->obtener('SEGUNDO_NOMBRE').'"></td>
						</tr>
						<tr>	
							<td>Apellido Paterno: </td>
							<td><input type="text" name="primerapellido" id="primerapellido" placeholder="Apellido Paterno" value="'.$datos->obtener('APELLIDO_PATERNO').'" required></td>
						</tr>
						<tr>
							<td>Apellido Materno: </td>
							<td><input type="text" name="segapellido" id="segapellido" placeholder="Apellido Materno" value="'.$datos->obtener('APELLIDO_MATERNO').'"></td>
						</tr>
						<tr>	
							<td>No de Idoneidad: </td>
							<td><input type="text" name="idoneidad" id="idoneidad" placeholder="No de Idoneidad" value="'.$datos->obtener('NO_IDONEIDAD').'"></td>
						</tr>
						<tr>
							<td>No de Registro: </td>
							<td><input type="text" name="registro" id="registro" placeholder="No de Registro" value="'.$datos->obtener('NO_REGISTRO').'"></td>
						</tr>
						<tr>	
							<td>Tel&eacute;fono de Casa: </td>
							<td><input type="text" name="telefono" id="telefono" placeholder="Tel&eacute;fono de Casa" value="'.$datos->obtener('TELEFONO_CASA').'"></td>
						</tr>
						<tr>
							<td>Teléfono Celular: </td>
							<td><input type="text" name="celular" id="celular" placeholder="Tel&eacute;fono Celular" value="'.$datos->obtener('TELEFONO_CELULAR').'"></td>
						</tr>
						<tr>	
							<td>Correo Electrónico: </td>
							<td><input type="text" name="email" id="email" placeholder="Correo Electr&oacute;nico" value="'.$datos->obtener('E_MAIL').'"></td>
						</tr>
						<tr>
							<td>Especialidad Médica: </td>
							<td>
								<select name="especialidad" id="especialidad">
									<option value=""> </option>';
						$x = $esp_medicas->buscardonde('ID_ESPECIALIDAD_MEDICA');			
						while($x){
							if($esp_medicas->obtener('ID_ESPECIALIDAD_MEDICA') == $profesional->obtener('ID_ESPECIALIDAD_MEDICA')){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							$cont.='<option value="'.$esp_medicas->obtener('ID_ESPECIALIDAD_MEDICA').'" '.$selected.'>'.$esp_medicas->obtener('DESCRIPCION').'</option>';
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
	
	';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>