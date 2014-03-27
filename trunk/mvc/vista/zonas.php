<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont.='
			<center>
			<fieldset>
				<legend align="center">
					<h3 style="background:#f4f4f4;padding:10px;">Zonas</h3>
				</legend>
				<form method="POST" action="./?url=addzona">
					Zona: <input type="text" id="zona" name="zona" placeholder="Nombre de la Zona" required><br>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</fieldset>
			</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>