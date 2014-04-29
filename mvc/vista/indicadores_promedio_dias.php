<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$rae = new Accesatabla('registro_admision_egreso');
	
	$comillas = "'";
	$script='
		<script type="text/javascript">
			$(function () {
        $('.$comillas.'#mostrargrafica'.$comillas.').highcharts({
            chart: {
                type: '.$comillas.'column'.$comillas.'
            },
            title: {
                text: '.$comillas.'Promedio de Dias de Estancia'.$comillas.'
            },
            subtitle: {
                text: '.$comillas.'Datos obtenidos de Registro de Amisi&oacute;n Egresos'.$comillas.'
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
                    text: '.$comillas.'Promedio de Dias'.$comillas.'
                }
            },
            tooltip: {
                headerFormat: '.$comillas.'<span style="font-size:10px">{point.key}</span><table>'.$comillas.',
                pointFormat: '.$comillas.'<tr><td style="color:{series.color};padding:0">{series.name}: </td>'.$comillas.' +
                    '.$comillas.'<td style="padding:0"><b>{point.y} Dias</b></td></tr>'.$comillas.',
                footerFormat: '.$comillas.'</table>'.$comillas.',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0,
                    borderWidth: 0,
					shadow: true
                }
            },
			series:[';
	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Promedio de Dias de Estancia</h3>
			<center>';
	$variable = $_POST['variable1'];
	if(empty($variable)){
		$variable = 2014;
	}
	$cont.='
					
					<form method="POST" action="./?url=indicadores_promedio_dias&sbm=3">
							Desde el A&ntilde;o: <input style="width:60px;" type="number" id="variable1" name="variable1" min="2013" max="'.$ds->dime('agno').'" value="2013"><br>
							<center>
								<button type="submit" class="btn btn-primary" >Enviar</button>
							</center>							
					</form>
					';
	$cont.='<div id="mostrargrafica" style="min-width: 310px; height: 500px;"></div>';
	$total = 0;
	$x = 1;
	while($variable <= $ds->dime('agno')){
		$mes = 1;
		$datos .='';
		if($x == 1){
			$datos .= '{
				name: '.$comillas.''.$variable.''.$comillas.',
                data: [';
				$x = 0;
		}else{
			$datos .= ',{
				name: '.$comillas.''.$variable.''.$comillas.',
                data: [';
		}
		while($mes < 13){
			$cantidad = 0;
			$sql = 'SELECT SUM(TOTAL_DIAS_ESTANCIA) AS cantidad FROM registro_admision_egreso WHERE FECHA BETWEEN "'.$variable.'-'.$mes.'-01" AND "'.$variable.'-'.$mes.'-31"';
			$matriz = $ds->db->obtenerarreglo($sql);
			$cantidad = $matriz[0][cantidad];
			if(empty($cantidad)){
				$cantidad = 0;
			}
			if($mes == 1){
				$datos .= $cantidad;
				$total = $cantidad + $total;
			}else{
				$datos .= ','.$cantidad;
				$total = $cantidad + $total;
			}
			$cantidad = 0;
			$mes++;
		}
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
	if(empty($total)){
		$cont = '<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Promedio de Dias de Estancia</h3>
		<center style="font-size:16px;color:red;"><h3>No existen datos para graficar.</h3></center>';
	}
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>