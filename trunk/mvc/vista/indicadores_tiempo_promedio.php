<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$visitas = new Accesatabla('registro_visitas_domiciliarias');
	$visitas1 = new Accesatabla('registro_visitas_domiciliarias');
	$detalle = new Accesatabla('detalle_registro_visitas_domiciliarias');
	$comillas = "'";
	$script='
		<script type="text/javascript">
			$(function () {
        $('.$comillas.'#grafica'.$comillas.').highcharts({
            chart: {
                type: '.$comillas.'column'.$comillas.'
            },
            title: {
                text: '.$comillas.'Tiempo promedio empleado por Visitas'.$comillas.'
            },
            subtitle: {
                text: '.$comillas.'Datos obtenidos de Registro de Visitas Domiciliarias'.$comillas.'
            },
            xAxis: {
                categories: [
                    '.$comillas.'Ene'.$comillas.',
                    '.$comillas.'Feb'.$comillas.',
                    '.$comillas.'Mar'.$comillas.',
                    '.$comillas.'Abr'.$comillas.',
                    '.$comillas.'May'.$comillas.',
                    '.$comillas.'Jun'.$comillas.',
                    '.$comillas.'Jul'.$comillas.',
                    '.$comillas.'Ago'.$comillas.',
                    '.$comillas.'Sep'.$comillas.',
                    '.$comillas.'Oct'.$comillas.',
                    '.$comillas.'Nov'.$comillas.',
                    '.$comillas.'Dic'.$comillas.'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: '.$comillas.'Prom. de Horas Usadas'.$comillas.'
                }
            },
            tooltip: {
				 backgroundColor: {
					linearGradient: [0, 0, 0, 60],
					stops: [
						[0, '.$comillas.'#FFFFFF'.$comillas.'],
						[1, '.$comillas.'#E0E0E0'.$comillas.']
					]
				},
				borderWidth: 1,
				borderColor: '.$comillas.'#AAA'.$comillas.',
                headerFormat: '.$comillas.'<span style="font-size:10px">{point.key}</span><table>'.$comillas.',
                pointFormat: '.$comillas.'<tr><td style="color:{series.color};padding:0">{series.name}: </td>'.$comillas.' +
                    '.$comillas.'<td style="padding:0"><b>{point.y:.1f} Horas</b></td></tr>'.$comillas.',
                footerFormat: '.$comillas.'</table>'.$comillas.',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
					shadow:true
                }
            },
			series:[';
	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Tiempo Promedio empleado por Visitas</h3>
			<center>';
	$variable = $_POST['variable1'];
	if(empty($variable)){
		$variable = 2014;
	}
	$cont.='
					<form method="POST" action="./?url=indicadores_tiempo_promedio&sbm=1">
							Desde el A&ntilde;o: <input style="width:60px;" type="number" id="variable1" name="variable1" min="2013" max="'.$ds->dime('agno').'" value="2013"><br>
							<center>
								<button type="submit" class="btn btn-primary">Enviar</button>
							</center>							
					</form>
					';
	
	$cont.='<div id="grafica" style="min-width: 310px; height: 500px;"></div>';
	$x = 1;
	while($variable <= $ds->dime('agno')){
		$pacientes = 0;
		$mes = 1;
		if($x == 1){
			$datos .= '{
				name: '.$comillas.''.$variable.''.$comillas.',
                data: [';
		}else{
			$datos .= ',{
				name: '.$comillas.''.$variable.''.$comillas.',
                data: [';
		}
		
		while($mes < 13){
			$sql = 'SELECT SUM(HORAS_DE_ATENCION) AS horas FROM registro_visitas_domiciliarias WHERE FECHA BETWEEN "'.$variable.'-'.$mes.'-01" AND "'.$variable.'-'.$mes.'-31"'; 
			$matriz = $ds->db->obtenerarreglo($sql);
			$horas = $matriz[0][horas];
			$v = $visitas->buscardonde('FECHA BETWEEN "'.$variable.'-'.$mes.'-01" AND "'.$variable.'-'.$mes.'-31"');
			while($v){
				$sql = 'SELECT COUNT(SECUENCIA) AS cantidad FROM detalle_registro_visitas_domiciliarias WHERE ID_RVD = '.$visitas->obtener('ID_RVD').'';
				$matriz = $ds->db->obtenerarreglo($sql);
				$pacientes += $matriz[0][cantidad];
				$v = $visitas->releer();
			}
			if($pacientes == 0){
				$promedio = 0;
			}else{
				$promedio = ($horas/$pacientes);
			}
			if($mes == 1){
				$datos .= $promedio;
			}else{
				$datos .= ','.$promedio;
			}
			$mes++;
		}
		$x = 0;
		$datos.=']}';
		$variable++;
	}
	$script.=$datos;
    $script.='
            ]
        });
    });
	</script>
	<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/highcharts.js'.$comillas.'></script>	
	<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/grid.js'.$comillas.'></script>	
	<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/modules/exporting.js'.$comillas.'></script>
	';
	$cont.='
			</center>'.$script.'
	';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>