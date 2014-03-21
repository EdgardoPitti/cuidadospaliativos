<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont = '<center><h1 style="color:#0066CC;line-height:50px">Bienvenido al Sistema de</h1> <h1 style="color:#0066CC;line-height:50px">Red Social de Cuidados Paliativos</h1></center>';
	$ds->contenido($cont);
	$ds->mostrar();
?>