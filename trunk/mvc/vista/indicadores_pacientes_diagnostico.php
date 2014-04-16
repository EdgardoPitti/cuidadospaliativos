<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$diagnostico = new Accesatabla('detalle_diagnostico');
	$cie = new Accesatabla('cie10');
	$datos = '';
	$categorias = '';
	$comillas = "'";
	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Pacientes por Diagn&oacute;stico</h3>		
	';
	$condicion = '';
	$n = 1;
	$total = 0;
	$x = $diagnostico->buscardonde('SECUENCIA > 0');
	while($x){
		$sql = 'SELECT COUNT(SECUENCIA) AS cantidad FROM detalle_diagnostico WHERE ID_CIE10 = "'.$diagnostico->obtener('ID_CIE10').'"';
		$matriz = $ds->db->obtenerarreglo($sql);
		$cantidad = $matriz[0][cantidad];
		$cie->buscardonde('ID_CIE10 = "'.$diagnostico->obtener('ID_CIE10').'"');	
		if($n == 1){
			$datos .= $cantidad;
			$n = 0;
			$categorias .='
				  '.$comillas.''.$cie->obtener('DESCRIPCION').''.$comillas;
		}else{
			$datos .= ','.$cantidad;
			$categorias .=',
					  '.$comillas.''.$cie->obtener('DESCRIPCION').''.$comillas;
		}
		$total += $cantidad;
		$condicion .= ' AND ID_CIE10 != "'.$diagnostico->obtener('ID_CIE10').'"';
		$x = $diagnostico->buscardonde('SECUENCIA > 0 '.$condicion.'');
		$cantidad = 0;		
	}
	$cont.='<div id="grafica" style="min-width: 310px; height: 500px;"></div>';
	$datos.=']}';
	$script='
		<script type="text/javascript">
			$(function () {
        $('.$comillas.'#grafica'.$comillas.').highcharts({
            chart: {
                type: '.$comillas.'column'.$comillas.'
            },
            title: {
                text: '.$comillas.'Cantidad de Personas segun Diagnostico'.$comillas.'
            },
            subtitle: {
                text: '.$comillas.'Datos obtenidos de Registro de Visitas Domiciliarias'.$comillas.'
            },
            xAxis: {
                categories: [
					'.$categorias.'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: '.$comillas.'Cantidad de Personas'.$comillas.'
                }
            },
            tooltip: {
                headerFormat: '.$comillas.'<span style="font-size:10px">{point.key}</span><table>'.$comillas.',
                pointFormat: '.$comillas.'<tr><td style="color:{series.color};padding:0">{series.name}: </td>'.$comillas.' +
                    '.$comillas.'<td style="padding:0"><b>{point.y} Personas</b></td></tr>'.$comillas.',
                footerFormat: '.$comillas.'</table>'.$comillas.',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0,
                    borderWidth: 0,
					shadow:true
                }
            },
			series:[{
				name: '.$comillas.'Personas'.$comillas.',
				data: ['.$datos.'
            ]
        });
    });
	</script>
	<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/highcharts.js'.$comillas.'></script>	
	<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/grid.js'.$comillas.'></script>	
	<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/modules/exporting.js'.$comillas.'></script>
	';
	if($total == 0){
		$cont = '
			<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Pacientes por Diagn&oacute;stico</h3>
			<center style="font-size:16px;color:red;"><h3>No existen datos para graficar.</h3></center>';
	}
	$cont.=$script;
	$ds->contenido($cont);
	$ds->mostrar();
?>