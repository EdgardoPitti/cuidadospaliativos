<?php
	include_once('./mvc/modelo/Accesatabla.php');
	
	$medicamentos = new Accesatabla('medicamentos');
	$idsoap = $_GET['idsoap'];	
	$idimp = $_GET['idimp'];
		
	$medicamentos->nuevo();
	$medicamentos->colocar('ID_TIPO_CUADRO', $_POST['cuadro_medicamento']);
	$medicamentos->colocar('DESCRIPCION', $_POST['desc_medicamento']);
	$medicamentos->salvar();
	echo '<script>alert("Medicamento Almacenado Correctamente");location.href="./?url=soap&idsoap='.$idsoap.'&impresion='.$idimp.'"</script>';
	
	
?>