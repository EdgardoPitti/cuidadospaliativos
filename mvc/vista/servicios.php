<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$tiempos = new Accesatabla('tiempos_atencion');
	$cont.='
			<center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Agregar Servicios M&eacute;dicos</h3>
				<form method="POST" action="./?url=addservicio">
					<table>
						<tr>
							<td>Servicio M&eacute;dico: </td>
							<td><input type="text" id="servicio" name="servicio" placeholder="Servicio M&eacute;dico" required></td>
						<tr>						
						<tr>
							<td>Tiempo de Atenci&oacute;n: </td>
							<td>
								<select id="tiempo" name="tiempo">
									<option value=""></option>';
	$t = $tiempos->buscardonde('ID_TIEMPO_ATENCION');
	while($t){
		$cont.='
									<option value="'.$tiempos->obtener('ID_TIEMPO_ATENCION').'">'.$tiempos->obtener('DURACION').'</option>
		';
		$t = $tiempos->releer();
	}
	$cont.='
								</select>
							</td>
						<tr>
					</table>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>