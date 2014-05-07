<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	if($_SESSION['idgu'] <> 3){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><SCRIPT languague="JAVASCRIPT">location.href = "./?url=inicio"</SCRIPT>';
	}else{
		$interconsulta = new Accesatabla('interconsulta');
		$interconsulta->colocar("FECHA", $_POST['fecha']);
		$interconsulta->colocar("ID_PROFESIONAL", $_SESSION['idp']);
		$interconsulta->colocar("ID_PACIENTE", $_GET['idp']);
		$interconsulta->colocar("OBSERVACIONES", $_POST['obs_coment']);
		$interconsulta->salvar();
		echo '<SCRIPT LANGUAGE="javascript">alert("Interconsulta Almacenada Correctamente."); location.href = "./?url=ambulatoria_interconsulta&idp='.$_GET['idp'].'&sbm=2";</SCRIPT>';
	}
?>