<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$rvd = new Accesatabla('registro_visitas_domiciliarias');
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
	
			$fecha = '"';
			$fecha .= $_POST['fecha'];
			$fecha .= '"';
			$rvd->nuevo();
			$rvd->colocar("FECHA", $fecha);
			$rvd->colocar("ID_INSTITUCION", $_POST['institucion']);
			$rvd->colocar("ID_EQUIPO_MEDICO", $_POST['id_equipo']);
			$rvd->salvar();
			$sql = 'SELECT MAX(ID_RVD) AS id FROM registro_visitas_domiciliarias';
			$matriz = $ds->db->obtenerarreglo($sql);
			$_SESSION[idrvd] = $matriz[0][id];	
		}
		$rvd->buscardonde('ID_RVD = '.$id.'');

		$idequipo = $rvd->obtener('ID_EQUIPO_MEDICO');
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
			$rvd->buscardonde('ID_RVD = '.$id.'');
			$sql = 'SELECT COUNT(ID_RVD) AS cantidad FROM detalle_registro_visitas_domiciliarias WHERE ID_RVD = '.$id.'';
			$arreglo = $ds->db->obtenerArreglo($sql);
			$horas = $arreglo[0][cantidad]/2;
			$rvd->colocar('HORAS_DE_ATENCION', $horas);
			$rvd->salvar();
			
		}
		echo '<script>location.href="./?url=domiciliarias_registro_visitas&id='.$id.'&sbm=1"</script>';
	}
?>