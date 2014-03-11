<?php
	include_once('../modelo/Accesatabla.php');
	$corregimientos = new Accesatabla('corregimientos');
	include_once('../modelo/diseno.php');
	$pg = new Diseno();
	
	$d = $corregimientos->buscardonde('id_distrito = '.$_GET['iddistrito'].'');
	while($d){
		$cont.='<option value="'.$corregimientos->obtener('ID_CORREGIMIENTO').'">'.$corregimientos->obtener('CORREGIMIENTO').'</option>';
		$d = $corregimientos->releer();
	}
	echo $pg->latino($cont);	
?>
