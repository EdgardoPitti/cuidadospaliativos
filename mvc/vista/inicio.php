<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont = '';
	$ds->contenido($cont);
	$ds->mostrar();
?>