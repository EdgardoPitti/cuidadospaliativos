<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	$vias = new Accesatabla('vias_administracion');
	$idsoap = $_GET['idsoap'];	
	$idimp = $_GET['idimp'];
	
	$vias->nuevo();
	$vias->colocar('ABREVIATURA', $_POST['abreviatura']);
	$vias->colocar('DESCRIPCION', $_POST['desc_medicamento']);
	$vias->salvar();
	
	echo '<script>alert("Medicamento Almacenado Correctamente");location.href="./?url=soap&idsoap='.$idsoap.'&impresion='.$idimp.'"</script>';
?>