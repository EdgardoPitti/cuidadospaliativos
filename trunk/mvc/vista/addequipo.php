<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$profesionales = new Accesatabla('profesionales_salud');
	$datos = new Accesatabla('datos_profesionales_salud');
	$equipos = new Accesatabla('equipo_medico');
	$detalle = new Accesatabla('detalle_equipo_medico');
	$id = $_POST['id'];
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><SCRIPT languague="JAVASCRIPT">location.href = "./?url=inicio"</SCRIPT>';
	}else{
		if(empty($id)){
			$equipos->nuevo();
			$equipos->salvar();
			$sql = 'SELECT MAX(ID_EQUIPO_MEDICO) AS id FROM equipo_medico';
			$matriz = $ds->db->obtenerArreglo($sql);
			$id = $matriz[0][id];
		}
		$datos->buscardonde('NO_CEDULA = "'.$_POST['cedprofesional'].'"');
		$profesionales->buscardonde('ID_PROFESIONAL = '.$datos->obtener('ID_PROFESIONAL').'');
		$d = $detalle->buscardonde('ID_EQUIPO_MEDICO = '.$id.' AND ID_PROFESIONAL = '.$profesionales->obtener('ID_PROFESIONAL').'');
		if($d){
				$_SESSION['error'] = '<div style="color:red;">El profesional ya se encuentra incluido en el Equipo M&eacute;dico.</div>';
				$msj = 'El profesional ya se encuentra incluido en el equipo medico y no se puede volver agregar.';
		}else{
				$detalle->nuevo();
				$detalle->colocar("ID_EQUIPO_MEDICO", $id);
				$detalle->colocar("ID_PROFESIONAL", $profesionales->obtener('ID_PROFESIONAL'));
				$detalle->colocar("ID_ESPECIALIDAD_MEDICA", $profesionales->obtener('ID_ESPECIALIDAD_MEDICA'));
				$detalle->salvar();
				$msj = 'Datos Almacenados Correctamente';
		}
		echo '<script language="javascript">alert("'.$msj.'")</script><script language="javascript">location.href="./?url=equipos&id='.$id.'&sbm=5"</script>';
	}
	
?>