<?php
	include_once('../modelo/Accesatabla.php');
	$distritos = new Accesatabla('distritos');
	include_once('../modelo/diseno.php');
	$pg = new Diseno();
	$cont = '<select id="distritos" name="distritos"  style="width:140px">
				<option value="0"></option>
	';
	$d = $distritos->buscardonde('id_provincia = '.$idprovincia.'');
	while($d){
		$cont.='<option value="'.$distritos->obtener('id').'">'.$distritos->obtener('descripcion').'</option>';
		$d = $distritos->releer();
	}
	$cont.='</select>';
	echo $pg->latino($cont);
?>
<script src="jquery.js"></script>
<script src="funciones.js"></script>
