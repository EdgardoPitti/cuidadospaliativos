<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$rda = new Accesatabla('registro_diario_actividades');
	$institucion = new Accesatabla('institucion');
	$detalle = new Accesatabla('detalle_rda');
	
	$inicio = $_POST['inicio'];
	$final = $_POST['final'];
	$cont.='
		<div class="row-fluid">
			<div class="span12">
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Registro Diario de Actividades</h3>
				<center>
					<form method="POST" action="./?url=domiciliarias_diario_actividades">
						Filtrar de <input type="date" name="inicio"> hasta <input type="date" name="final">
						<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
					</form>
				</center>
				<div style="overflow-x:auto;">
					<table class="table2 borde-tabla">
						<tr class="fd-table">
							<th>#</th>
							<th>Fecha</th>
							<th>Institucion</th>
							<th>Profesionales</th>
							<th>Pacientes Atendidos</th>
							<th>Horas de Atencion</th>
							<th style="background:transparent;border:0;min-width:25px;"></th>
						</tr>';
		$n = 1;
		$n = 1;
		if(empty($inicio) OR empty($final)){
			$r = $rda->buscardonde('ID_RDA > 0');
		}else{
			$r = $rda->buscardonde('FECHA BETWEEN "'.$inicio.'" AND "'.$final.'"');
		}
		while($r){
			$institucion->buscardonde('ID_INSTITUCION = '.$rda->obtener('ID_INSTITUCION').'');
			$cont.='
						<tr al ign="center">
							<td><b>'.$n.'</b></td>
							<td><b>'.$rda->obtener('FECHA').'</b></td>
							<td>'.$institucion->obtener('DENOMINACION').'</td>';
			$sql = 'SELECT COUNT(SECUENCIA) as cantidad FROM `detalle_equipo_medico` where  ID_EQUIPO_MEDICO = '.$rda->obtener('ID_EQUIPO_MEDICO').'';
			$matriz = $ds->db->obtenerarreglo($sql);
			$cont.='
							<td>'.$matriz[0][cantidad].'</td>
					';
			$sql = 'SELECT COUNT(SECUENCIA) AS cantidad FROM `detalle_rda` where ID_RDA = '.$rda->obtener('ID_RDA').'';
			$matriz = $ds->db->obtenerarreglo($sql);
			$cont.='
							<td>'.$matriz[0][cantidad].'</td>
							<td>'.$rda->obtener('HORAS_DE_ATENCION').'</td>
							<td style="border:0;"><a href="./?url=domiciliarias_registro_actividades&id='.$rda->obtener('ID_RDA').'"><img src="./iconos/search.png"></a></td>
						</tr>
			';
			$r = $rda->releer();
			$n++;
		}
		$cont.='
					</table>
				</div>
				<center>
					<a href="./?url=domiciliarias_registro_actividades" title="Agregar Nuevo Registro"><img src="./iconos/registro.png"></a>
				</center>
			</div>
		</div>
		';
	$ds->contenido($cont);
	$ds->mostrar();
?>