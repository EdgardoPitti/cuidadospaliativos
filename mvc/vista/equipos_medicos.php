<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/Diseno.php');
	$ds = new Diseno();
	$equipos = new Accesatabla('equipo_medico');
	$detalle_equipo = new Accesatabla('detalle_equipo_medico');
	$datos = new Accesatabla('datos_profesionales_salud');
	$profesional = new Accesatabla('profesionales_salud');
	$especialidades = new Accesatabla('especialidades_medicas');
	
	$cont.='
		<center>
					<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Equipos M&eacute;dicos</h3>
					<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
					<table class="table2 borde-tabla table-hover">
					<thead>
						<tr class="fd-table">
							<th>#</th>
							<th>ID Equipo M&eacute;dico</th>	
							<th>Profesionales</th>
							<th>Especialidades</th>
							<th style="min-width:20px;"></th>
						</tr>
					</thead>
					<tbody>';
	$n = 1;
	$e = $equipos->buscardonde('ID_EQUIPO_MEDICO > 0');
	while($e){
		$d = $detalle_equipo->buscardonde('ID_EQUIPO_MEDICO = '.$equipos->obtener('ID_EQUIPO_MEDICO').'');
		while($d){
			$profesional->buscardonde('ID_PROFESIONAL = '.$detalle_equipo->obtener('ID_PROFESIONAL').'');
			$datos->buscardonde('ID_PROFESIONAL = '.$detalle_equipo->obtener('ID_PROFESIONAL').'');
			$especialidades->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$profesional->obtener('ID_ESPECIALIDAD_MEDICA').'');
			$segundo_nombre = $datos->obtener('SEGUNDO_NOMBRE');
			$segundo_apellido = $datos->obtener('APELLIDO_MATERNO');
			$cont.='
						<tr>
							<td><strong>'.$n.'</strong></td>
							<td>'.$equipos->obtener('ID_EQUIPO_MEDICO').'</td>
							<td>'.$datos->obtener('NO_CEDULA').' '.$datos->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$datos->obtener('APELLIDO_PATERNO').' '.$segundo_apellido[0].'.</td>
							<td>'.$especialidades->obtener('DESCRIPCION').'</td>
							<td><a href="./?url=equipos&id='.$equipos->obtener('ID_EQUIPO_MEDICO').'&sbm=5"><img src="./iconos/search.png"></a></td>
						</tr>
			';
			$n++;
			$d = $detalle_equipo->releer();
		}
		$e = $equipos->releer();
	}	
	$cont.='
					</tbody>
				</table>
			</div>
			<a href="./?url=equipos&sbm=5" title="A&ntilde;adir Equipo M&eacute;dico"><img src="./iconos/plus.png"></a>
		</center>
	';
	if($_SESSION['idgu'] <> 1){
		$cont='';
		echo '<script language="javascript">location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}	
?>