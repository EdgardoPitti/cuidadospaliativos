<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$rae = new Accesatabla('registro_admision_egreso');
	$referido = new Accesatabla('referido');
	$comillas = "'";
	$sql = 'SELECT COUNT(ID_REGISTRO_ADMISION_EGRESO) AS cantidad FROM registro_admision_egreso';
	$matriz = $ds->db->obtenerarreglo($sql);
	$total = $matriz[0][cantidad];
	if($total == 0){
		$total = 1;
		$script = '<center style="font-size:16px;color:red;"><h3>No existen datos para graficar</h3></center>';
	}
	$sw = 1;
	$r = $referido->buscardonde('ID_REFERIDO > 0');
	while($r){
		$sql = 'SELECT COUNT(ID_REGISTRO_ADMISION_EGRESO) AS cantidad FROM registro_admision_egreso WHERE ID_REFERIDO = '.$referido->obtener('ID_REFERIDO').'';
		$matriz = $ds->db->obtenerarreglo($sql);
		$cantidad = $matriz[0][cantidad];
		$porcentaje = number_format(($cantidad/$total)*100, 1);
		
		if($sw){
			$data .= '
				{
						name: '.$comillas.''.$referido->obtener('REFERIDO').''.$comillas.',
                        y: '.$porcentaje.',
                        sliced: true,
                        selected: true
				}
			';
			$sw = 0;
		}else{
			$data .= '
				,['.$comillas.''.$referido->obtener('REFERIDO').''.$comillas.', '.$porcentaje.']
			';
		}
		$r = $referido->releer();
	}
	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Pacientes Hospitalizados</h3>';
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
								text: '.$comillas.'Porcentaje de Hospitalizados por Referencia'.$comillas.'
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
									showInLegend: true,
									shadow:true
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