<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	$cont.= '<h1 align="center">Vista no encontrada</h1>';
				
	$ds->contenido($cont);
	$ds->mostrar();
?>