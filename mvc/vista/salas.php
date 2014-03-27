<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont.='
			<center>
			<fieldset>
				<legend align="center">
					<h3 style="background:#f4f4f4;padding:10px;">Salas</h3>
				</legend>
				<form>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</fieldset>
			</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>