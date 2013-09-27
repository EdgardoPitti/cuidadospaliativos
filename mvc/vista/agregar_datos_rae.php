<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$rae = new Accesatabla('registro_admision_egreso');
	$trazabilidad = new Accesatabla('trazabilidad');
	$referido = new Accesatabla('referido');
	$sala = new Accesatabla('sala');
	$cama = new Accesatabla('cama');
	$diag_adm = new Accesatabla('diagnostico_admision');
	$diag_eg = new Accesatabla('diagnostico_egreso');
	$condicion_salida = new Accesatabla('condicion_salida');
	$motivo_salida = new Accesatabla('motivo_salida');
	$profesional = new Accesatabla('datos_profesionales_salud');
	
	$idpaciente = $_GET['idpac'];
	$fecha = $ds->dime('año').'-'.$ds->dime('mes').'-'.$ds->dime('dia');
	echo $fechaactual = '"'.$fecha.'"';
	
	$trazabilidad->nuevo();
	$trazabilidad->colocar("ID_PACIENTE", $idpaciente);
	$trazabilidad->colocar("FECHA", $fechaactual);
	$trazabilidad->salvar();
	
	$trazabilidad->buscardonde('ID_PACIENTE = '.$idpaciente.'');
	$idtrazabilidad = $trazabilidad->obtener('ID_TRAZABILIDAD');
	
	$sql = 'SELECT max(ID_SALA) as id FROM sala';	
	$ids = $ds->db->obtenerArreglo($sql);
	
	$sqlc = 'SELECT max(ID_CAMA) as id FROM cama WHERE ID_SALA = '.$ids[0][id].'';	
	$idc = $ds->db->obtenerArreglo($sqlc);
	
	$sql_da='SELECT max(ID_DIAGNOSTICO_ADMISION) AS id_da FROM diagnostico_admision';
	$id_da = $ds->db->obtenerArreglo($sql_da);
	
	$sql_de='SELECT max(ID_DIAGNOSTICO_EGRESO) AS id_de FROM diagnostico_egreso';
	$id_de = $ds->db->obtenerArreglo($sql_de);
	
	$rae->nuevo();
	$rae->colocar("FECHA", $fechaactual);
	$rae->colocar("ID_PACIENTE", $idpaciente);
	$rae->colocar("ID_TRAZABILIDAD", $idtrazabilidad);
	$rae->colocar("ID_REFERIDO", $_POST['referido']);
	$rae->colocar("ID_SALA", $ids[0][id]);
	$rae->colocar("ID_CAMA", $idc[0][id]);
	$rae->colocar("ID_DIAGNOSTICO_ADMISION", $id_da[0][id_da]);
	$rae->colocar("ID_DIAGNOSTICO_EGRESO", $id_de[0][id_de]);
	$rae->colocar("ID_CONDICION_SALIDA",$_POST['condicionsalida']);
	$rae->colocar("ID_MOTIVO_SALIDA",2);
	$rae->colocar("ID_PROFESIONAL",2);
	$rae->colocar("TOTAL_DIAS_ESTANCIA",3);
	$rae->salvar();
	
	include_once('./mvc/vista/inicio.php');
?>