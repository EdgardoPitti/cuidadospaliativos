<?php
	include_once('../modelo/Accesatabla.php');
	$cie = new Accesatabla('cie10');
	$c = $cie->buscardonde('id_cie10 like "'.$idcie.'%"');
	$cont.='<select id="cie" name="cie" style="width:80px;">';
	while($c){
		$cont.='
				<option value="'.$cie->obtener('ID_CIE10').'">'.$cie->obtener('ID_CIE10').'</option>
		';
		$c = $cie->releer();
	}
	$cont.='</select>';
	echo $cont;
	
?><script src="./js/jquery.js"></script>