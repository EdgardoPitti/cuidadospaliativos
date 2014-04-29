<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$cama = new Accesatabla('cama');
	$id = $_GET['id'];
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><SCRIPT languague="JAVASCRIPT">location.href = "./?url=inicio"</SCRIPT>';
	}else{
		if(empty($id)){
			$cama->nuevo();	
		}else{
			$cama->buscardonde('ID_CAMA = '.$id.'');
		}
		$cama->colocar("CAMA", $_POST['cama']);
		$cama->colocar("ID_SALA", $_POST['sala']);
		$cama->salvar();
		echo '<SCRIPT languague="JAVASCRIPT">location.href = "./?url=camas&id='.$id.'&sbm=5"</SCRIPT>'
	}
	
?>