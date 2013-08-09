<?php
	include_once('../modelo/Accesatabla.php');
	$categorias = new Accesatabla('tipos_de_programas');
	include_once('../modelo/diseno.php');
	$pg = new Diseno();
	$cont = '<select id="categorias" name="categorias" style="width:140px">
				<option value="0"></option>
			';
	$c = $categorias->buscardonde('tipo = '.$categoria.'');
	while($c){
		$cont.='<option value="'.$categorias->obtener('id').'">'.$categorias->obtener('detalle').'</option>';
		$c = $categorias->releer();
	}
	$cont.='</select>';
	echo $pg->latino($cont);	
?>