<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$sala = new Accesatabla('sala');
	$id = $_GET['id'];
	if(empty($id)){
		$sala->nuevo();
	}else{
		$sala->buscardonde('ID_SALA = '.$id.'');
	}
	$sala->colocar("SALA", $_POST['sala']);
	$sala->salvar();
	include_once('./mvc/vista/salas.php');
	echo '<SCRIPT LANGUAGE="javascript">location.href="./?url=salas&id='.$id.'"</SCRIPT>';
?>