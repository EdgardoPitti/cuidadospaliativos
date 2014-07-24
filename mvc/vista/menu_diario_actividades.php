<?php

	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();

	 $ds->contenido('VISTA MENU DIARIO DE ACTIVIDADES');
	 $ds->mostrar();




?>