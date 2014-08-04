<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$rda = new Accesatabla('registro_diario_actividades');
	
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
	$t = $_GET['t'];
	$sbm = $_GET['sbm'];
	if($_SESSION['idgu'] <> 3 AND $_SESSION['idgu'] <> 4){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><SCRIPT languague="JAVASCRIPT">location.href = "./?url=inicio"</SCRIPT>';
	}else{
		if(empty($id)){
			$fecha .= '"';
			$fecha .= $_POST['fecharda'];
			$fecha .= '"';
			$rda->nuevo();
			$rda->colocar('FECHA', $fecha);
			$rda->colocar('ID_INSTITUCION', $_POST['institucionrda']);
			$rda->colocar('ID_EQUIPO_MEDICO', $_POST['equipo_medico']);
			$rda->colocar('TIPO_ATENCION', $t);
			$rda->salvar();

			$sql = 'SELECT MAX(ID_RDA) as id from registro_diario_actividades';
			$matriz = $ds->db->obtenerArreglo($sql);
			$id = $matriz[0][id];
			$_SESSION[idrda] = $id;
		}
		$rda->buscardonde('ID_RDA = '.$id.'');
		
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
				
				
				$detallediagnostico->nuevo();
				$detallediagnostico->colocar('ID_DIAGNOSTICO', $iddiagnostico);
				$detallediagnostico->colocar('ID_CIE10', $_POST['cie10']);
				$detallediagnostico->colocar('ID_FRECUENCIA', $_POST['frecdiag']);
				$detallediagnostico->colocar('ID_PROFESIONAL', $_SESSION['idp']);
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
				
				
				$a = $actividad->buscardonde('ACTIVIDAD = "'.$_POST['actividad'].'" AND ID_FRECUENCIA = '.$_POST['frecact'].' AND ID_PROFESIONAL = '.$_SESSION['idp'].'');
				if($a){
					$idactividad = $actividad->obtener('ID_ACTIVIDAD');
				}else{
					$actividad->nuevo();
					$actividad->colocar('ACTIVIDAD', $_POST['actividad']);
					$actividad->colocar('ID_FRECUENCIA', $_POST['frecact']);
					$actividad->colocar('ID_PROFESIONAL', $_SESSION['idp']);
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
				
				$rda->buscardonde('ID_RDA = '.$id.'');
				$sql = 'SELECT COUNT(ID_RDA) AS cantidad FROM detalle_rda WHERE ID_RDA = '.$id.'';
				$arreglo = $ds->db->obtenerArreglo($sql);
				$horas = $arreglo[0][cantidad]/2;
				$rda->colocar('HORAS_DE_ATENCION', $horas);
				$rda->salvar();
			}
		}
		echo '<script language="javascript">location.href="./?url=domiciliarias_registro_actividades&sbm='.$sbm.'&id='.$id.'&t='.$t.'"</script>';
	}
?>
