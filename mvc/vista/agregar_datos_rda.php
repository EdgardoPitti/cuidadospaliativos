<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$rda = new Accesatabla('registro_diario_actividades');
	$equipo = new Accesatabla('equipo_medico');
	$detalle_equipo = new Accesatabla('detalle_equipo_medico');
	$profesional = new Accesatabla('profesionales_salud');
	$datos_profesional = new Accesatabla('datos_profesionales_salud');
	$detalle_rda = new Accesatabla('detalle_rda');
	$datos_paciente = new Accesatabla('datos_pacientes');
	$trazabilidad = new Accesatabla('trazabilidad');
	$diagnostico = new Accesatabla('diagnostico');	
	$detallediagnostico = new Accesatabla('detalle_diagnostico');
	$actividad = new Accesatabla('actividad');
	$_SESSION[errorprof] = '';
	$_SESSION[errorpa] = '';
	$sw = $_GET['sw'];
	$id = $_GET['id'];
		
	if(empty($id)){
		$equipo->nuevo();
		$equipo->salvar();
		$sql = 'SELECT max(ID_EQUIPO_MEDICO) as id FROM equipo_medico';
		$matriz = $ds->db->obtenerArreglo($sql);
		$idequipo = $matriz[0][id];

		$fecha .= '"';
		$fecha .= $_POST['fecharda'];
		$fecha .= '"';
		$rda->nuevo();
		$rda->colocar('FECHA', $fecha);
		$rda->colocar('ID_INSTITUCION', $_POST['institucionrda']);
		$rda->colocar('ID_EQUIPO_MEDICO', $idequipo);
		$rda->colocar('HORAS_DE_ATENCION', $_POST['horas']);
		$rda->salvar();

		$sql = 'SELECT MAX(ID_RDA) as id from registro_diario_actividades';
		$matriz = $ds->db->obtenerArreglo($sql);
		$idrda = $matriz[0][id];
		$_SESSION[idrda] = $idrda;
	}
	$rda->buscardonde('ID_RDA = '.$id.'');
	
	$idequipo = $rda->obtener('ID_EQUIPO_MEDICO');
	if($sw == 2){
		$datos_profesional->buscardonde('NO_CEDULA = "'.$_POST['cedprofesional'].'"');
		$profesional->buscardonde('ID_PROFESIONAL = '.$datos_profesional->obtener('ID_PROFESIONAL').'');
		if($detalle_equipo->buscardonde('ID_EQUIPO_MEDICO = '.$idequipo.' AND ID_PROFESIONAL = '.$datos_profesional->obtener('ID_PROFESIONAL').'')){
			$_SESSION[errorprof] = '<div style="color:RED;padding-top:10px">Este profesional ya existe en el equipo</div>';
		}else{
			$detalle_equipo->nuevo();
			$detalle_equipo->colocar('ID_EQUIPO_MEDICO', $idequipo);
			$detalle_equipo->colocar('ID_PROFESIONAL', $datos_profesional->obtener('ID_PROFESIONAL'));
			$detalle_equipo->colocar('ID_ESPECIALIDAD_MEDICA', $profesional->obtener('ID_ESPECIALIDAD_MEDICA'));
			$detalle_equipo->salvar();	
			$_SESSION[errorprof] = '';
		}
	}
	if($sw == 3){
		$datos_paciente->buscardonde('NO_CEDULA = "'.$_POST['cedpaciente'].'"');
		$idpaciente = $datos_paciente->obtener('ID_PACIENTE');
		if($detalle_rda->buscardonde('ID_PACIENTE = '.$idpaciente.' AND ID_RDA = '.$id.'')){
			$_SESSION[errorpa] = '<div style="color:RED;padding-top:7px">Este paciente ya existe en esta Actividad</div>';
		}else{
				
			$diagnostico->nuevo();
			$diagnostico->salvar();
			$sql = 'SELECT max(ID_DIAGNOSTICO) as id FROM diagnostico';
			$matriz = $ds->db->obtenerArreglo($sql);
			$iddiagnostico = $matriz[0][id];
			
			$datos_profesional->buscardonde('NO_CEDULA = "'.$_POST['cedprofesional2'].'"');
			
			
			$detallediagnostico->nuevo();
			$detallediagnostico->colocar('ID_DIAGNOSTICO', $iddiagnostico);
			$detallediagnostico->colocar('ID_CIE10', $_POST['cie10']);
			$detallediagnostico->colocar('ID_FRECUENCIA', $_POST['frecdiag']);
			$detallediagnostico->colocar('ID_PROFESIONAL', $datos_profesional->obtener('ID_PROFESIONAL'));
			$detallediagnostico->colocar('OBSERVACION', $_POST['observacion']);
			$detallediagnostico->salvar();
			
			$fecha = '"';
			$fecha .= $ds->dime('agno').'-'.$ds->dime('mes').'-'.$ds->dime('dia');
			$fecha .= '"';	
			$idtrazabilidad = $idpaciente.'_'.$ds->dime('agno').'/'.$ds->dime('mes').'/'.$ds->dime('dia');
			$trazabilidad->nuevo();
			$trazabilidad->colocar("ID_TRAZABILIDAD", $idtrazabilidad);
			$trazabilidad->colocar("ID_PACIENTE", $idpaciente);
			$trazabilidad->colocar("FECHA",$fecha);
			$trazabilidad->salvar();
			
			$datos_profesional->buscardonde('NO_CEDULA = "'.$_POST['cedprofesional3'].'"');
			$a = $actividad->buscardonde('ACTIVIDAD = "'.$_POST['actividad'].'" AND ID_FRECUENCIA = '.$_POST['frecact'].' AND ID_PROFESIONAL = '.$datos_profesional->obtener('ID_PROFESIONAL').'');
			if($a){
				$idactividad = $actividad->obtener('ID_ACTIVIDAD');
			}else{
				$actividad->nuevo();
				$actividad->colocar('ACTIVIDAD', $_POST['actividad']);
				$actividad->colocar('ID_FRECUENCIA', $_POST['frecact']);
				$actividad->colocar('ID_PROFESIONAL', $datos_profesional->obtener('ID_PROFESIONAL'));
				$actividad->salvar();
				$sql = 'SELECT max(ID_ACTIVIDAD) as id FROM actividad';
				$matriz = $ds->db->obtenerArreglo($sql);
				$idactividad = $matriz[0][id];
			}
			
			$detalle_rda->nuevo();
			$detalle_rda->colocar('ID_RDA', $id);
			$detalle_rda->colocar('ID_ZONA', $_POST['zona']);
			$detalle_rda->colocar('ID_PACIENTE', $idpaciente);
			$detalle_rda->colocar('ID_TRAZABILIDAD', $idtrazabilidad);
			$detalle_rda->colocar('ID_FRECUENCIA', $_POST['frecuencia']);
			$detalle_rda->colocar('ID_TIPO_ATENCION', $_POST['tipo_atencion']);
			$detalle_rda->colocar('ID_DIAGNOSTICO', $iddiagnostico);
			$detalle_rda->colocar('ID_ACTIVIDAD', $idactividad);
			$detalle_rda->colocar('ID_ESTADO_PACIENTE', $_POST['estado']);
			$detalle_rda->colocar('REFERIDO_PACIENTE', $_POST['referido']);
			$detalle_rda->salvar();
			$_SESSION[errorpa] = '';
		}
	}
	include_once('./mvc/vista/domiciliarias_registro_actividades.php');
?>