<?php
	include_once('../modelo/Accesatabla.php');
	$distritos = new Accesatabla('distritos');
	include_once('../modelo/diseno.php');
	$pg = new Diseno();
	$cont = '<select id="distritos" name="distritos"  style="width:140px">
				<option value="0"></option>';
	$d = $distritos->buscardonde('id_provincia = '.$idprovincia.'');
	while($d){
		$cont.='<option value="'.$distritos->obtener('ID_DISTRITO').'">'.$distritos->obtener('DISTRITO').'</option>';
		$d = $distritos->releer();
	}
	$cont.='</select>';
	echo $pg->latino($cont);
?>
<script src="./js/jquery.js"></script>
<script src="./js/funciones.js"></script>
