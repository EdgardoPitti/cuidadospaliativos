<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont = '<h1 style="color:#0066CC;"><center>Bienvenido al Sistema de <br><br><br> Red Social de Cuidados Paliativos</center><h1>';
	$ds->contenido($cont);
	$ds->mostrar();
?>