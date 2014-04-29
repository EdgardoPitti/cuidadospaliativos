<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$servicio = new Accesatabla('servicios_medicos');
	$id = $_GET['id'];
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><SCRIPT languague="JAVASCRIPT">location.href = "./?url=inicio"</SCRIPT>';
	}else{
		if(empty($id)){
			$servicio->nuevo();
		}else{
			$servicio->buscardonde('ID_SERVICIO = '.$id.'');
		}

		$servicio->colocar("DESCRIPCION", $_POST['servicio']);
		$servicio->colocar("ID_TIEMPO_ATENCION", $_POST['tiempo']);
		$servicio->salvar();
		
		echo '<SCRIPT LANGUAGE="javascript">location.href="./?url=servicios&id='.$id.'&sbm=5"</SCRIPT>';
	}
?>