<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$usuarios = new Accesatabla('usuarios');
	$grupo = new Accesatabla('grupos_usuarios');
	$cont.='
			<center>
			<fieldset>
				<legend align="center">
					<h3 style="background:#f4f4f4;padding:10px;">Usuarios</h3>
				</legend>
				<form method="POST" action="./?url=addusuario">
					<table>
						<tr>
							<td>No de Identificaci&oacute;n: </td>
							<td><input type="text" id="no_identificacion" name="no_identificacion" placeholder="No de Identificaci&oacute;n" required></td>
						</tr>
						<tr>
							<td>Clave de Acceso: </td>
							<td><input type="text" id="clave" name="clave" placeholder="Clave de Acceso" required></td>
						</tr>
						<tr>
							<td>Grupo de Usuario: </td>
							<td>
								<select id="grupo" name="grupo">
									<option value=""></option>';
	$g = $grupo->buscardonde('ID_GRUPO_USUARIO > 0');
	while($g){
		$cont.='
									<option value="'.$grupo->obtener('ID_GRUPO_USUARIO').'">'.$grupo->obtener('DESCRIPCION').'</option>
		';
		$g = $grupo->releer();	
	}
	$cont.='
								</select>
							</td>
						</tr>
					</table>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</fieldset>
			</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>