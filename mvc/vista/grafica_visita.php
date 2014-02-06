 <?php
	include_once('../modelo/Accesatabla.php');
	include_once('../modelo/diseno.php');
	$ds = new Diseno();
	$visitas = new Accesatabla('registro_visitas_domiciliarias');
	$detalle = new Accesatabla('detalle_registro_visitas_domiciliarias');
	$filtro = $_POST['filtro'];
	$tipo = $_POST['tipo'];
	$comillas = "'";
	$comillad = '"';
	if($tipo == 0){
		$grafica = 'Column3D';
	}else if($tipo == 1){
		$grafica = 'Pie3D';
	}else{
		$grafica = 'Spline';
	}
	if($filtro > 6){
		$var .= '{"chart": { "caption" : "Registro de Visitas Domiciliarias" ,	"xAxisName" : "Meses del Año '.$filtro.'", "yAxisName" : "Cantidad de Visitas",	"numberPrefix" : "Pacientes: " },"data" : [ ';
		$x = 1;
		while($x < 13){
			$v = $visitas->buscardonde('FECHA BETWEEN "'.$filtro.'-'.$x.'-01" AND "'.$filtro.'-'.$x.'-31"');
			$cantidad = 0;
			while($v){
				$sql = 'SELECT COUNT(ID_RVD) AS cantidad FROM detalle_registro_visitas_domiciliarias WHERE ID_RVD = '.$visitas->obtener('ID_RVD').'';
				$matriz = $ds->db->obtenerarreglo($sql);
				$cantidad += $matriz[0][cantidad];
				$v = $visitas->releer();
			}
			if($x == 1){
				$var .= '{ "label" : "'.$ds->dime('mes-'.$x.'').'", "value" : "'.$cantidad.'" }';
			}else{
				$var .=',{ "label" : "'.$ds->dime('mes-'.$x.'').'", "value" : "'.$cantidad.'" }';
			}
			$x++;
			$cantidad = 0;
		}
	}else{
		$var .= '{"chart": { "caption" : "Registro de Visitas Domiciliarias" ,	"xAxisName" : "Años", "yAxisName" : "Cantidad de Visitas",	"numberPrefix" : "Pacientes: " },"data" : [ ';
		$start = $ds->dime('agno') - $filtro;
		$x = 1;
		while($start <= $ds->dime('agno')){
			$cantidad = 0;
			$v = $visitas->buscardonde('FECHA BETWEEN "'.$start.'-01-01" AND "'.$start.'-12-31"');
			while($v){
				$sql = 'SELECT COUNT(ID_RVD) AS cantidad FROM detalle_registro_visitas_domiciliarias WHERE ID_RVD = '.$visitas->obtener('ID_RVD').'';
				$matriz = $ds->db->obtenerarreglo($sql);
				$cantidad += $matriz[0][cantidad];
				$v = $visitas->releer();
			}
			if($x == 1){
					$var .= '{ "label" : "Año '.$start.'", "value" : "'.$cantidad.'" }';
			}else{
					$var .=',{ "label" : "Año '.$start.'", "value" : "'.$cantidad.'" }';
			}
			$cantidad = 0;
			$x++;
			$start++;
		}
	}
	$var .= ']}';
	$cont.= '<script type="text/javascript" src="./Charts/FusionCharts.js"></script>
			<div id="chartContainer">PowerCharts XT will load here!</div>	
			<script type="text/javascript">
				<!--
					var myChart = new FusionCharts("./Charts/'.$grafica.'.swf","myChartId", "100%", "500", "0");
					myChart.setJSONData('.$comillas.''.$var.''.$comillas.');
					myChart.render("chartContainer");   
				-->  
			</script>      
			';
	echo $cont;
	echo $start;
?>