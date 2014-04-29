<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$sala = new Accesatabla('sala');
	$id = $_GET['id'];
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><SCRIPT languague="JAVASCRIPT">location.href = "./?url=inicio"</SCRIPT>';
	}else{
		if(empty($id)){
			$sala->nuevo();
		}else{
			$sala->buscardonde('ID_SALA = '.$id.'');
		}
		$sala->colocar("SALA", $_POST['sala']);
		$sala->salvar();
		echo '<SCRIPT LANGUAGE="javascript">location.href="./?url=salas&id='.$id.'&sbm=5"</SCRIPT>';
	}
?>