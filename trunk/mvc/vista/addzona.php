<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$zona = new Accesatabla('zona');
	$id = $_GET['id'];
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><SCRIPT languague="JAVASCRIPT">location.href = "./?url=inicio"</SCRIPT>';
	}else{
		if(empty($id)){
			$zona->nuevo();
		}else{
			$zona->buscardonde('ID_ZONA = '.$id.'');
		}
		$zona->colocar("ZONA", $_POST['zona']);
		$zona->salvar();

		echo '<script language="javascript">location.href="./?url=zonas&id='.$id.'&sbm=5"</script>';
	}
?>