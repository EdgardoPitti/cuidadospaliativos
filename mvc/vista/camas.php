<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$salas = new Accesatabla('sala');
	$cont.='
			<center>
			<fieldset>
				<legend align="center">
					<h3 style="background:#f4f4f4;padding:10px;">Camas</h3>
				</legend>
				<form method="POST" action="./?url=addcama">
					<table>
						<tr>
							<td>Cama: </td>
							<td><input type="text" id="cama"  name="cama" placeholder="Cama" required></td>
						</tr>
						<tr>
							<td>Sala: </td>
							<td><select id="sala" name="sala">
									<option value=""></option>';
	$s = $salas->buscardonde('ID_SALA > 0');
	while($s){
		$cont.='
									<option value="'.$salas->obtener('ID_SALA').'">'.$salas->obtener('SALA').'</option>
		';
		$s = $salas->releer();
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