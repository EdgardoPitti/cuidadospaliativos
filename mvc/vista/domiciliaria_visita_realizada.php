<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$rvd = new Accesatabla('registro_visitas_domiciliarias');
	$institucion = new Accesatabla('institucion');
	$detalle = new Accesatabla('detalle_registro_visitas_domiciliarias');
	
	$inicio = $_POST['inicio'];
	$final = $_POST['final'];
	$cont.='
		<div class="row-fluid">
			<div class="span12">
				<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Registro de Visitas Domiciliarias</h3>
				<center>
					<form method="POST" action="./?url=domiciliaria_visita_realizada&sbm=1">
						<table class="tabla-datos">						
							<tr>
								<th>Filtrar</th>
							</tr>
							<tr align="center">
								<td>
									<input type="date" name="inicio" id="test" size="120px"> hasta <input type="date" id="test" name="final">
									<button class="btn btn-default" style="margin-bottom:10px;"type="submit"><img src="./iconos/search.png"/></button>
								</td>
							</tr>					
						</table>
						
					</form>
				</center>';
			$n = 1;
			if(empty($inicio) OR empty($final)){
				$r = $rvd->buscardonde('ID_RVD > 0 ORDER BY FECHA');
				$p = '';				
			}else{
				$r = $rvd->buscardonde('FECHA BETWEEN "'.$inicio.'" AND "'.$final.'"  ORDER BY FECHA');
				if($r <> 0){
					if(!empty($inicio) and !empty($final)){
						$cont.='<div style="float:right;margin-bottom:4px;" >
									<a href="datospdf.php?visita=1&inicio='.$inicio.'&final='.$final.'&imprimir=1" class="btn btn-default" target="_blank" ><img src="./iconos/imprimir.png" width="24px"> Imprimir</a>
									<a href="datospdf.php?visita=1&inicio='.$inicio.'&final='.$final.'" class="btn" title="Descargar"><img src="./iconos/download.png" width="24px"> Descargar</a> 
								</div>';
					}			
				}
				$p = ' desde '.$inicio.' hasta '.$final.'';				
			}
						
			$cont.='
				
				<center style="float:none;clear:both;">
					';
			$cont.='<div class="overflow overthrow">';
			if($r){
				$cont.='
					
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
							</thead>
							<tbody>
				';
			}else{
				$cont.='<div style="color:red;">No estan registradas Actividades '.$p.'.</div>';
			}
			while($r){
				$institucion->buscardonde('ID_INSTITUCION = '.$rvd->obtener('ID_INSTITUCION').'');
				$cont.='
							
								<tr>
									<td><b>'.$n.'</b></td>
									<td><b>'.$rvd->obtener('FECHA').'</b></td>
									<td>'.$institucion->obtener('DENOMINACION').'</td>';
					$sql = 'SELECT COUNT(SECUENCIA) as cantidad FROM `detalle_equipo_medico` where  ID_EQUIPO_MEDICO = '.$rvd->obtener('ID_EQUIPO_MEDICO').'';
					$matriz = $ds->db->obtenerarreglo($sql);
					$cont.='
									<td>'.$matriz[0][cantidad].'</td>
							';
					$sql = 'SELECT COUNT(SECUENCIA) AS cantidad FROM `detalle_registro_visitas_domiciliarias` where ID_RVD = '.$rvd->obtener('ID_RVD').'';
					$matriz = $ds->db->obtenerarreglo($sql);
					$cont.='
									<td>'.$matriz[0][cantidad].'</td>
									<td>'.$rvd->obtener('HORAS_DE_ATENCION').'</td>
									<td><a href="./?url=domiciliarias_registro_visitas&id='.$rvd->obtener('ID_RVD').'&sbm=1"><img src="./iconos/search.png"></a></td>
								</tr>';
				$r = $rvd->releer();
				$n++;
			}
			$cont.='
							</tbody>
						</table>
					</div>
				</center>
				<center>
					<a href="./?url=domiciliarias_registro_visitas&sbm=1" title="Agregar Nuevo Registro" class="btn btn-primary">Agregar</a>
				</center>
			</div>
		</div>
		';
		
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>