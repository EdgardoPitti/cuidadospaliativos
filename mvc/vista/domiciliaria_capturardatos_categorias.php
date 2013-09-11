<?php
	include_once('../modelo/Accesatabla.php');
	$categorias = new Accesatabla('categoria');
	include_once('../modelo/diseno.php');
	$pg = new Diseno();
	$cont = '<select id="categorias" name="categorias" style="width:140px">
				<option value="0"></option>
			';
	$c = $categorias->buscardonde('ID_PROGRAMA = '.$categoria.'');
	while($c){
		$cont.='<option value="'.$categorias->obtener('ID_CATEGORIA').'">'.$categorias->obtener('CATEGORIA').'</option>';
		$c = $categorias->releer();
	}
	$cont.='</select>';
	echo $pg->latino($cont);	
?>