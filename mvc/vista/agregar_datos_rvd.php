<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$rvd = new Accesatabla('registro_visitas_domiciliarias');
	$equipo = new Accesatabla('equipo_medico');
	$detalle_equipo = new Accesatabla('detalle_equipo_medico');
	$profesional = new Accesatabla('profesionales_salud');
	$datos_profesional = new Accesatabla('datos_profesionales_salud');
	$detalle_rvd = new Accesatabla('detalle_registro_visitas_domiciliarias');
	$paciente = new Accesatabla('datos_pacientes');
	$progama = new Accesatabla('programa');
	$categoria = new Accesatabla('categoria');
	$trazabilidad = new Accesatabla('trazabilidad');
	$id = $_GET['id'];
	$sw = $_GET['sw'];
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><SCRIPT languague="JAVASCRIPT">location.href = "./?url=inicio"</SCRIPT>';
	}else{
		if(empty($id)){
			$equipo->nuevo();
			$equipo->salvar();
			$sql = 'SELECT max(ID_EQUIPO_MEDICO) as id FROM equipo_medico';
			$matriz = $ds->db->obtenerArreglo($sql);
			$idequipo = $matriz[0][id];
			$fecha = '"';
			$fecha .= $_POST['fecha'];
			$fecha .= '"';
			$rvd->nuevo();
			$rvd->colocar("FECHA", $fecha);
			$rvd->colocar("ID_INSTITUCION", $_POST['institucion']);
			$rvd->colocar("ID_EQUIPO_MEDICO", $idequipo);
			$rvd->colocar("HORAS_DE_ATENCION", $_POST['horas']);
			$rvd->salvar();
			$sql = 'SELECT MAX(ID_RVD) AS id FROM registro_visitas_domiciliarias';
			$matriz = $ds->db->obtenerarreglo($sql);
			$_SESSION[idrvd] = $matriz[0][id];	
		}
		$rvd->buscardonde('ID_RVD = '.$id.'');

		$idequipo = $rvd->obtener('ID_EQUIPO_MEDICO');
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
			$paciente->buscardonde('NO_CEDULA = "'.$_POST['cedpaciente'].'"');
			$idpaciente = $paciente->obtener('ID_PACIENTE');
			if($detalle_rvd->buscardonde('ID_PACIENTE = '.$idpaciente.' AND ID_RVD = '.$id.'')){
				$_SESSION[errorpa] = '<div style="color:RED;padding-top:7px">Este paciente ya existe en esta Visita</div>';
			}else{
				$fecha = '"';
				$fecha .= $ds->dime('agno').'-'.$ds->dime('mes').'-'.$ds->dime('dia');
				$fecha .= '"';	
				$idtrazabilidad = $idpaciente.'_'.$ds->dime('agno').'/'.$ds->dime('mes').'/'.$ds->dime('dia');
				$trazabilidad->nuevo();
				$trazabilidad->colocar("ID_TRAZABILIDAD", $idtrazabilidad);
				$trazabilidad->colocar("ID_PACIENTE", $idpaciente);
				$trazabilidad->colocar("FECHA",$fecha);
				$trazabilidad->salvar();
				
				$categoria->buscardonde('ID_CATEGORIA = '.$_POST['categoria'].'');
				$detalle_rvd->nuevo();
				$detalle_rvd->colocar("ID_RVD", $id);
				$detalle_rvd->colocar("ID_PACIENTE", $idpaciente);
				$detalle_rvd->colocar("ID_TRAZABILIDAD", $idtrazabilidad);
				$detalle_rvd->colocar("ID_PROGRAMA", $categoria->obtener('ID_PROGRAMA'));
				$detalle_rvd->colocar("ID_CATEGORIA", $_POST['categoria']);
				$detalle_rvd->colocar("OBSERVACIONES", $_POST['observacion']);
				$detalle_rvd->salvar();
				$_SESSION[errorpa] = '';
			}
		}
		include_once('./mvc/vista/domiciliarias_registro_visitas.php');
	}
?>