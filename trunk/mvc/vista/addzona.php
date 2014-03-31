<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$zona = new Accesatabla('zona');
	$id = $_GET['id'];
	if(empty($id)){
		$zona->nuevo();
	}else{
		$zona->buscardonde('ID_ZONA = '.$id.'');
	}
	$zona->colocar("ZONA", $_POST['zona']);
	$zona->salvar();
	include_once('./mvc/vista/zonas.php');
	echo '<script language="javascript">location.href="./?url=zonas&id='.$id.'"</script>';
?>