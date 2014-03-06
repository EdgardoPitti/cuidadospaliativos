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

	$sw = $_GET['sw'];
	$id = $_GET['id'];
	$hora = $_POST['hora'];
	$fecha = $_POST['fecha'];
	$date = explode("/", $fecha);
	$fecha = '"';
	$fecha .= $date[2].'-'.$date[1].'-'.$date[0];
	$fecha .= '"';	
	$cedprofesional = $_POST['cedprofesional'];
	$cedpaciente = $_POST['cedpaciente'];
	$profesional->buscardonde('NO_CEDULA = "'.$cedprofesional.'"');
	$c = $citas_medicas->buscardonde('FECHA = '.$fecha.' AND HORA = "'.$hora.'" AND ID_PROFESIONAL = '.$profesional->obtener('ID_PROFESIONAL').'');
	echo 'FECHA = '.$fecha.' AND HORA = "'.$hora.'" AND ID_PROFESIONAL = '.$profesional->obtener('ID_PROFESIONAL').'';
	if($c){
		$_SESSION['error_profesional'] = '<div style="color:red;">Este Profesional ya tiene cita para esta hora.</div>';
		$_SESSION['fecha_1'] = $_POST['fecha'];
	}else{
		if(empty($id)){
				$equipo->nuevo();
				$equipo->salvar();
			
				$pacientes->buscardonde('NO_CEDULA = "'.$cedpaciente.'"');
				$profesional->buscardonde('NO_CEDULA = "'.$cedprofesional.'"');
				
				$sql = 'SELECT MAX(ID_EQUIPO_MEDICO) AS id FROM equipo_medico';
				$matriz = $ds->db->obtenerarreglo($sql);
				$idequipo = $matriz[0][id];
				
				$citas_medicas->nuevo();
				$citas_medicas->colocar("ID_PACIENTE", $pacientes->obtener('ID_PACIENTE'));
				$citas_medicas->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
				$citas_medicas->colocar("ID_SERVICIO", $_POST['servicio']);
				$citas_medicas->colocar("ID_EQUIPO_MEDICO", $idequipo);
				$citas_medicas->colocar("FECHA", $fecha);
				$citas_medicas->colocar("HORA", $hora);
				$citas_medicas->colocar("RESERVADA", $_POST['reservada']);
				$citas_medicas->salvar();
					
				$sql = 'SELECT MAX(ID_CITA) AS id FROM citas_medicas';
				$matriz = $ds->db->obtenerarreglo($sql);
				
			}else{
				$citas_medicas->buscardonde('ID_CITA = '.$id.'');
				$citas_medicas->colocar("RESERVADA", $_POST['reservada']);
				$citas_medicas->salvar();
				$matriz[0][id] = $id;
				if($sw == 1){
					$citas_medicas->buscardonde('ID_CITA = '.$id.'');
					$profesional->buscardonde('NO_CEDULA = "'.$_POST['cedprofesional2'].'"');
					$profesionales_salud->buscardonde('ID_PROFESIONAL = '.$profesional->obtener('ID_PROFESIONAL').'');
					$idequipo = $citas_medicas->obtener('ID_EQUIPO_MEDICO');
					$d = $detalle_equipo->buscardonde('ID_EQUIPO_MEDICO = '.$idequipo.' AND ID_PROFESIONAL = '.$profesional->obtener('ID_PROFESIONAL').'');
					if($d){
						$_SESSION['error'] = '<b style="color:red;">Este profesional ya existe en el equipo.</b>';
					}else{
						$detalle_equipo->nuevo();
						$detalle_equipo->colocar("ID_EQUIPO_MEDICO", $idequipo);
						$detalle_equipo->colocar("ID_PROFESIONAL", $profesional->obtener('ID_PROFESIONAL'));
						$detalle_equipo->colocar("ID_ESPECIALIDAD_MEDICA", $profesionales_salud->obtener('ID_ESPECIALIDAD_MEDICA'));
						$detalle_equipo->salvar();
					}
				}
			}
	
	}

	$_SESSION['cita'] = $matriz[0][id];
	include_once('./mvc/vista/nueva_cita.php')
?>