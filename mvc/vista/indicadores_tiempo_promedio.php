<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$visitas = new Accesatabla('registro_visitas_domiciliarias');
	$visitas1 = new Accesatabla('registro_visitas_domiciliarias');
	$detalle = new Accesatabla('detalle_registro_visitas_domiciliarias');
	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Tiempo Promedio empleado por Visitas</h3>
			<center>';
	$variable = $_POST['variable1'];
	if(empty($variable)){
		$variable = 2014;
	}
	$cont.='
					<form method="POST" action="./?url=indicadores_tiempo_promedio">
							Desde el A&ntilde;o: <input style="width:60px;" type="number" id="variable1" name="variable1" min="2013" max="'.$ds->dime('agno').'" value="2013"><br>
							<center>
								<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;">Enviar</button>
							</center>							
					</form>
					';
	$sql = 'SELECT SUM(HORAS_DE_ATENCION) AS horas FROM registro_visitas_domiciliarias';
	$matriz = $ds->db->obtenerarreglo($sql);
	$horas_totales = $matriz[0][horas];
	$cont.='<div id="grafica" style="min-width: 310px; height: 500px;"></div>
				<pre id="tsv" style="display:none">Browser Version	Total Market Share';
	while($variable <= $ds->dime('agno')){
		$pacientes = 0;
		$mes = 1;
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
				$porcentaje = 0;
			}else{
				$porcentaje = $horas/$pacientes;
			}
			$cont .= '
'.$variable.' '.$ds->dime('mes-'.$mes.'').'	'.number_format($porcentaje, 2, '.', '').'%';
			$mes++;
		}
		$variable++;
	}
	$cont.='</pre>
				</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>