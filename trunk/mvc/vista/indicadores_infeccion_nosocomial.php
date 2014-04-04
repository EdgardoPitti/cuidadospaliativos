<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$diagnostico = new Accesatabla('detalle_diagnostico_egreso');
	$comillas = "'";
	$sql = 'SELECT COUNT(SECUENCIA) AS cantidad FROM detalle_diagnostico_egreso';
	$matriz = $ds->db->obtenerarreglo($sql);
	$total = $matriz[0][cantidad];
	$sw = 1;
	if($total == 0){
		$total = 1;
		$script = '<center style="font-size:16px;color:red;"><h3>No existen datos para graficar</h3></center>';
	}
	$sql = 'SELECT COUNT(SECUENCIA) AS cantidad FROM detalle_diagnostico_egreso WHERE INFECCION_NOSOCOMIAL = 1';
	$matriz = $ds->db->obtenerarreglo($sql);
	$cantidad = $matriz[0][cantidad];
	$porcentaje = number_format(($cantidad/$total)*100, 1);
	
	$data .= '
			{
					name: '.$comillas.'Con Infeccion Nosocomial'.$comillas.',
					y: '.$porcentaje.',
					sliced: true,
					selected: true
			}
		';
	$sql = 'SELECT COUNT(SECUENCIA) AS cantidad FROM detalle_diagnostico_egreso WHERE INFECCION_NOSOCOMIAL = 0';
	$matriz = $ds->db->obtenerarreglo($sql);
	$cantidad = $matriz[0][cantidad];
	$porcentaje = number_format(($cantidad/$total)*100, 1);
	$data .= '
			,['.$comillas.'Sin Infeccion Nosocomial'.$comillas.', '.$porcentaje.']
		';

	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Infecciones Nosocomiales</h3>';
	if(empty($script)){
		$script = '
		<br><div id="grafica" style="min-width: 310px; height: 500px;"></div>
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
							text: '.$comillas.'Porcentaje de Pacientes con Infecciones Nosocomial'.$comillas.'
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
							name: '.$comillas.'Porcentaje de Personsas'.$comillas.',
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
	}
	$cont.='
			'.$script.'';
	$ds->contenido($cont);
	$ds->mostrar();
?>