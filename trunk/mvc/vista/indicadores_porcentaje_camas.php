<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$camas = new Accesatabla('cama');
	$rae = new Accesatabla('registro_admision_egreso');
	$comillas = "'";
	$usadas = 0;
	$vacias = 0;
	$sql = 'SELECT COUNT(ID_CAMA) AS cantidad FROM cama';
	$matriz = $ds->db->obtenerarreglo($sql);
	$total = $matriz[0][cantidad];
	$c = $camas->buscardonde('ID_CAMA > 0');
	while($c){
		$r = $rae->buscardonde('ID_CAMA = '.$camas->obtener('ID_CAMA').' AND MUERTE_EN_SOP = 0');
		if($r){
			$usadas++;
			
		}else{
			$vacias++;
		}
		$c = $camas->releer();
	}
	$porcentaje = number_format(($usadas/$total)*100, 1);
	$data .= '
		{
				name: '.$comillas.'Porcentaje de Camas Usadas'.$comillas.',
				y: '.$porcentaje.',
				sliced: true,
				selected: true
		}
	';
	$porcentaje = number_format(($vacias/$total)*100, 1);
	$data .= '
		,['.$comillas.'Porcentajde de Camas sin Usar'.$comillas.', '.$porcentaje.']
	';
	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Pacientes Hospitalizados</h3>';
	$script = '
	<script>
	$(function () {
		var chart;
		
		$(document).ready(function () {
				
				// Build the chart
				$('.$comillas.'#grafica'.$comillas.').highcharts({
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: '.$comillas.'Porcentaje de Camas Utilizadas'.$comillas.'
					},
					tooltip: {
						pointFormat: '.$comillas.'{series.name}: <b>{point.percentage:.1f}%</b>'.$comillas.'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: '.$comillas.'pointer'.$comillas.',
							dataLabels: {
								enabled: true,
								color: '.$comillas.'#000000'.$comillas.',
								connectorColor: '.$comillas.'#000000'.$comillas.',
								format: '.$comillas.'<b>{point.name}</b>: {point.percentage:.1f} %'.$comillas.'
							},
							showInLegend: true
						}
					},
					series: [{
						type: '.$comillas.'pie'.$comillas.',
						name: '.$comillas.'Porcentaje de Camas'.$comillas.',
						data: [
								'.$data.'
						]
					}]
				});
			});
			
		});
	</script>
	<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/highcharts.js'.$comillas.'></script>	
	<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/modules/exporting.js'.$comillas.'></script>';
	$cont.='<br><div id="grafica" style="min-width: 310px; height: 500px;"></div>
			'.$script.'';
	$ds->contenido($cont);
	$ds->mostrar();

?>