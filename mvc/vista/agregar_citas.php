<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	
	$ds = new Diseno();
	$profesional = new Accesatabla('datos_profesionales_salud');
	$pacientes = new Accesatabla('datos_pacientes');
	$citas_medicas = new Accesatabla('citas_medicas');
	$equipo = new Accesatabla('equipo_medico');
	$detalle_equipo = new Accesatabla('detalle_equipo_medico');
	$profesionales_salud = new Accesatabla('profesionales_salud');
	if($_SESSION['idgu'] == 2){
		$msj = '';
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$id = $_GET['id'];
		$hora = $_POST['hora'];
		$fecha = $_POST['fecha'];
		$cedprofesional = $_POST['cedprofesional'];
		$cedpaciente = $_POST['cedpaciente'];
		$profesional->buscardonde('NO_CEDULA = "'.$cedprofesional.'"');
		$pacientes->buscardonde('NO_CEDULA = "'.$cedpaciente.'"');
		$c = $citas_medicas->buscardonde('FECHA = '.$fecha.' AND HORA = "'.$hora.'" AND ID_PACIENTE = '.$pacientes->obtener('ID_PACIENTE').' AND RESERVADA = 1');
		if($c){
			$msj = 'Este Paciente ya tiene cita para esta fecha y hora.';
		}else{
			if(empty($id)){				
					$citas_medicas->nuevo();	
					$citas_medicas->colocar("HORA", $hora);
										
			}else{
					$citas_medicas->buscardonde('ID_CITA = '.$id.'');
					$msj = 'Cita Editada correctamente.';
			}
			$citas_medicas->colocar("ID_PACIENTE", $pacientes->obtener('ID_PACIENTE'));				
			$citas_medicas->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
			$citas_medicas->colocar("ID_SERVICIO", $_POST['servicio']);
			$citas_medicas->colocar("ID_EQUIPO_MEDICO", $_POST['cod_equipo']);
			$citas_medicas->colocar("FECHA", '"'.$fecha.'"');
			$citas_medicas->colocar("RESERVADA", $_POST['reservada']);
			$citas_medicas->salvar();
			
			if(empty($id)){
				$sql = 'SELECT MAX(ID_CITA) AS id FROM citas_medicas';
				$matriz = $ds->db->obtenerarreglo($sql);
				$id = $matriz[0][id];
				$msj = 'Cita Salvada correctamente.';
			}
		}
		echo '<script language="javascript">alert("'.$msj.'")</script><script>location.href="./?url=nueva_cita&id='.$id.'&h='.$h.'&sbm=1"</script>';
	}
?>