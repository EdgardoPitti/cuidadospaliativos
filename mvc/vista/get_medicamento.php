<?php
	include_once('../modelo/db.php');
	$db = new Db();
		
   $id_receta = $_GET['receta'];
   	
	
	$det = $db->obtenerArreglo('SELECT * FROM detalle_receta WHERE ID_DETALLE_RECETA = '.$id_receta.'');		
	$med = $db->obtenerArreglo('SELECT * FROM medicamentos WHERE ID_MEDICAMENTO = '.$det[0][ID_MEDICAMENTO]);	
	
	if(!empty($det[0][OTRAS_INDICACIONES])){
		$indicaciones = $det[0][OTRAS_INDICACIONES];	
	}else {
		$indicaciones = '';	
	}
	$data = array(
		'receta' => $det[0][ID_DETALLE_RECETA],
		'medicid' => $det[0][ID_MEDICAMENTO],
		'medicamento' => $med[0][DESCRIPCION],
		'dosis' => $det[0][ID_DOSIS],
		'cantidad' => $det[0][DOSIS],
		'frecuencia' => $det[0][ID_FRECUENCIA_TRATAMIENTO],
		'tratamiento' => $det[0][TRATAMIENTO],
		'via' => $det[0][ID_VIA],	
		'periodo' => $det[0][ID_PERIODO_TRATAMIENTO],
		'indicaciones' => UTF8_encode($indicaciones)
	);
	echo json_encode($data);	
?>
