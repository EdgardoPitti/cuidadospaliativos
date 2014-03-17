<?php
	include_once('../modelo/Accesatabla.php');
	$distritos = new Accesatabla('distritos');
	include_once('../modelo/diseno.php');
	$pg = new Diseno(); 
	$cont.='	<option value="0"></option>';
	$d = $distritos->buscardonde('id_provincia = '.$_GET['idprovincia'].'');
	while($d){
		$cont.='<option value="'.$distritos->obtener('ID_DISTRITO').'">'.$distritos->obtener('DISTRITO').'</option>';
		$d = $distritos->releer();
	}
	
	echo $pg->latino($cont);
?>
