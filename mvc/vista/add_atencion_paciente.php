<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$atencion = new Accesatabla('atencion_paciente');
	$sbm = $_GET['sbm'];
	$id = $_GET['id'];
	if(!empty($_GET['idsoap'])){
		$url = '<script>location.href="./?url=soap&id='.$_GET['id'].'&idsoap='.$_GET['idsoap'].'&t=2"</script>';
	}
	if($_SESSION['idgu'] < 3){
		if($_SESSION['idgu'] == 1){
			$vista = 'ambulatoria_atencionalpaciente&sbm=2&id='.$id.'';
		}else{
			$vista = 'inicio';
		}
		echo '<script>alert("Solo los profesionales pueden registrar las respuestas de las interconsultas."); location.href="./?url='.$vista.'"</script>';
	}else{
		$atencion->colocar("ID_PROFESIONAL", $_SESSION['idp']);
		$atencion->colocar("ID_PACIENTE", $id);
		$atencion->colocar("FECHA", ''.$ds->dime('fecha').'');
		$atencion->colocar("HORA_INICIO", $_POST['hora_inicio']);
		$atencion->colocar("HORA_FIN", $_POST['hora_fin']);
		$atencion->colocar("MINUTOS_UTILIZADOS", $_POST['minutos']);
		$atencion->colocar("OBSERVACION", $_POST['observacion']);
		$atencion->colocar("TIPO_CONTACTO", $_POST['tipo']);
		$atencion->colocar("E_MAIL", $_POST['email']);
		$atencion->colocar("TELEFONO", $_POST['telefono']);
		$atencion->colocar("MOTIVO", $_POST['motivo']);
		$atencion->salvar();
		if(empty($_GET['idsoap'])){
			if($sbm == 8){
				$url = 'contacto_telefonico';
			}else{
				$url = 'ambulatoria_atencionalpaciente';
			}
			echo '<script>alert("Datos Ingresados Correctamente"); location.href="./?url='.$url.'&id='.$id.'&sbm='.$sbm.'"</script>';	
		}else{
			echo $url;
		}
		
	}
?>
