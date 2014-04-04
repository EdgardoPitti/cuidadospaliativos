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
					<table class="tabla-datos">						
						<tr>
							<th>Filtrar</th>
						</tr>
						<tr align="center">
							<td>
								<input type="date" name="inicio" size="120px"> hasta <input type="date" name="final">
								<button class="btn btn-default" style="margin-bottom:10px;"type="submit"><img src="./iconos/search.png"/></button>
							</td>
						</tr>					
					</table>
				</form>
			</center>';
	if(empty($inicio) OR empty($final)){
		$r = $rda->buscardonde('ID_RDA > 0');
		$p = '';
	}else{
		$r = $rda->buscardonde('FECHA BETWEEN "'.$inicio.'" AND "'.$final.'"');
		$p = ' desde '.$inicio.' hasta '.$final.'';
	}
	if($r){
		$cont.='
					<div class="overflow overthrow">
						<table class="table2 borde-tabla table-hover">
							<thead>
								<tr class="fd-table">
									<th style="min-width:20px;">#</th>
									<th>Fecha</th>
									<th>Institucion</th>
									<th>Profesionales</th>
									<th>Pacientes Atendidos</th>
									<th>Horas de Atencion</th>
									<th style="min-width:20px;"></th>
								</tr>
							</thead>';
	}else{
		$cont.='<center><div style="color:red;">No estan registradas Actividades'.$p.'.</div></center>';
	}
	$n = 1;
	while($r){
		$institucion->buscardonde('ID_INSTITUCION = '.$rda->obtener('ID_INSTITUCION').'');
		$cont.='
							<tbody>
								<tr>
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
									<td><a href="./?url=domiciliarias_registro_actividades&id='.$rda->obtener('ID_RDA').'&sbm=1" title="Ver o Editar Actividad"><img src="./iconos/search.png"></a></td>
								</tr>
							</tbody>
		';
		$r = $rda->releer();
		$n++;
	}
	$cont.='
					</table>
				</div>
			<center>
				<a href="./?url=domiciliarias_registro_actividades&sbm=1" title="Agregar Nuevo Registro"><img src="./iconos/registro.png"></a>
			</center>
		</div>
	
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>