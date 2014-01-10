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
	$_SESSION[error] = '';
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
		include_once('./mvc/vista/domiciliarias_registro_actividades.php');
	}
	$rda->buscardonde('ID_RDA = '.$id.'');
	
	$idequipo = $rda->obtener('ID_EQUIPO_MEDICO');
	if($sw == 2){
		$datos_profesional->buscardonde('NO_CEDULA = "'.$_POST['profesional'].'"');
		$profesional->buscardonde('ID_PROFESIONAL = '.$datos_profesional->obtener('ID_PROFESIONAL').'');
		if($detalle_equipo->buscardonde('ID_EQUIPO_MEDICO = '.$idequipo.' AND ID_PROFESIONAL = '.$datos_profesional->obtener('ID_PROFESIONAL').'')){
			$_SESSION[error] = '<div style="color:RED;">Este profesional ya existe en el equipo</div>';
		}else{
			$detalle_equipo->nuevo();
			$detalle_equipo->colocar('ID_EQUIPO_MEDICO', $idequipo);
			$detalle_equipo->colocar('ID_PROFESIONAL', $datos_profesional->obtener('ID_PROFESIONAL'));
			$detalle_equipo->colocar('ID_ESPECIALIDAD_MEDICA', $profesional->obtener('ID_ESPECIALIDAD_MEDICA'));
			$detalle_equipo->salvar();	
			$_SESSION[error] = '';
		}
		include_once('./mvc/vista/domiciliarias_registro_actividades.php');
	}
	if($sw = 3){
		/*$detalle_rda->colocar();
		$detalle_rda->colocar();
		$detalle_rda->colocar();
		$detalle_rda->colocar();*/
		include_once('./mvc/vista/domiciliarias_registro_actividades.php');
	}
?>