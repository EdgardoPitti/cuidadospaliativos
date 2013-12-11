<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$rda = new Accesatabla('registro_diario_actividades');
	$equipo = new Accesatabla('equipo_medico');
	$detalle_equipo = new Accesatabla('detalle_equipo_medico');
	$profesional = new Accesatabla('profesionales_salud');
	$datos_profesional = new Accesatabla('datos_profesionales_salud');
	
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
		
		$cont.='
				<center>
					<h1>Datos Salvados Correctamente</h1>
					<a href="./?url=domiciliarias_registro_actividades&id='.$idrda.'">Click para continuar...</a>
				</center>
				';
		$ds->contenido($cont);
		$ds->mostrar();	
	}
	$rda->buscardonde('ID_RDA = '.$id.'');
	$idequipo = $rda->obtener('ID_EQUIPO_MEDICO');
	if($sw == 2){
		$datos_profesional->buscardonde('NO_CEDULA = "'.$_POST['profesional'].'"');
		$detalle_equipo->nuevo();
		$detalle_equipo->colocar('ID_EQUIPO_MEDICO', $idequipo);
		$detalle_equipo->colocar('ID_PROFESIONAL', $datos_profesional->obtener('ID_PROFESIONAL'));
		$detalle_equipo->colocar('ID_ESPECIALIDAD_MEDICA', $_POST['especialidad']);
		$detalle_equipo->salvar();
		$p = $profesional->buscardonde('ID_PROFESIONAL = '.$datos_profesional->obtener('ID_PROFESIONAL').'');
		if($p){
			$e = $profesional->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$_POST['especialidad'].'');
			if(!$e){
				$profesional->nuevo();
				$profesional->colocar('ID_PROFESIONAL',$datos_profesional->obtener('ID_PROFESIONAL'));
				$profesional->colocar('ID_ESPECIALIDAD_MEDICA', $_POST['especialidad']);
				$profesional->salvar();
			}
		}else{
			$profesional->nuevo();
			$profesional->colocar('ID_PROFESIONAL',$datos_profesional->obtener('ID_PROFESIONAL'));
			$profesional->colocar('ID_ESPECIALIDAD_MEDICA', $_POST['especialidad']);
			$profesional->salvar();		
		}
		
		include_once('./mvc/vista/domiciliarias_registro_actividades.php');
	}
?>