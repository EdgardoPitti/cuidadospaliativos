<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$cama = new Accesatabla('cama');
	$id = $_GET['id'];
	if(empty($id)){
		$cama->nuevo();	
	}else{
		$cama->buscardonde('ID_CAMA = '.$id.'');
	}
	$cama->colocar("CAMA", $_POST['cama']);
	$cama->colocar("ID_SALA", $_POST['sala']);
	$cama->salvar();
	include_once('./mvc/vista/camas.php');
	echo '<SCRIPT languague="JAVASCRIPT">location.href = "./?url=camas&id='.$id.'"</SCRIPT>'
?>