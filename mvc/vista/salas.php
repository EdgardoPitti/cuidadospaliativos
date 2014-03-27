<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont.='
			<center>			
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Salas</h3>				
				<form method="POST" action="./?url=addsala">
					Sala: <input type="text" id="sala" name="sala" placeholder="Sala"><br>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>