<?php	
	$buscar =$_POST['b'];
	
	if (!empty($buscar)){
		buscar($buscar);
	}
	function buscar($b){
		include_once('../modelo/diseno.php');
		$ds = new Diseno();
		include_once('../modelo/Accesatabla.php');
		$distritos = new Accesatabla('distritos');
		include_once('../modelo/db.php');
		$db = new Db();
		
		$sql = $distritos->buscardonde('descripcion LIKE "%'.$b.'%"');
		$contar = $distritos->totalfilas();
		if($contar == 0){
			
			echo $ds->latino('<option value="0">No se encontró el distrito "<b>'.$b.'</b>".</option>');
		}else{				
			
			while($sql){	
			
				echo '<option value="'.$distritos->obtener('id').'">'.$distritos->obtener('descripcion').'</option>';
				$sql = $distritos->releer();
			}
		}
	}	
?>