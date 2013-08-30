<?php
	include_once('../modelo/Accesatabla.php');
	$corregimientos = new Accesatabla('corregimientos');
	include_once('../modelo/diseno.php');
	$pg = new Diseno();
	$cont = '<select id="corregimientosnacimieno" name="corregimientosnacimiento" style="width:140px">
				<option value="0"></option>
			';
	$d = $corregimientos->buscardonde('id_distrito = '.$iddistrito.'');
	while($d){
		$cont.='<option value="'.$corregimientos->obtener('id').'">'.$corregimientos->obtener('descripcion').'</option>';
		$d = $corregimientos->releer();
	}
	$cont.='</select>';
	echo $pg->latino($cont);	
?>