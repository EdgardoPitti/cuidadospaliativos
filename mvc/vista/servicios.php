<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$tiempos = new Accesatabla('tiempos_atencion');
	$servicios = new Accesatabla('servicios_medicos');
	$id = $_GET['id'];
	if(!empty($id)){
		$img = '<a href="./?url=servicios" title="A&ntilde;adir Servicio M&eacute;dico"><img src="./iconos/plus.png"></a><br><br>';
	}
	$cont.='
			<center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Agregar Servicios M&eacute;dicos</h3>
				<table class="table2 borde-tabla table-hover">
					<tr>
						<th>#</th>
						<th>Servicios</th>
						<th>Tiempos de Atenci&oacute;n <i>(MIN)</i></th>
						<th></th>
					</tr>';
	$s = $servicios->buscardonde('ID_SERVICIO > 0');
	$n = 1;
	while($s){
		$tiempos->buscardonde('ID_TIEMPO_ATENCION = '.$servicios->obtener('ID_TIEMPO_ATENCION').'');
		$cont.='
					<tr>
						<td>'.$n.'.</td>
						<td>'.$servicios->obtener('DESCRIPCION').'</td>
						<td>'.$tiempos->obtener('DURACION').'</td>
						<td><a href="./?url=servicios&id='.$servicios->obtener('ID_SERVICIO').'"><img src="./iconos/search.png"></a></td>
					</tr>
		';
		$n++;
		$s = $servicios->releer();
	}
	$servicios->buscardonde('ID_SERVICIO = '.$id.'');
	$cont.='
				</table>
				'.$img.'
				<form method="POST" action="./?url=addservicio&id='.$id.'">
					<table>
						<tr>
							<td>Servicio M&eacute;dico: </td>
							<td><input type="text" id="servicio" name="servicio" placeholder="Servicio M&eacute;dico" value="'.$servicios->obtener('DESCRIPCION').'" required></td>
						<tr>						
						<tr>
							<td>Tiempo de Atenci&oacute;n: </td>
							<td>
								<select id="tiempo" name="tiempo">
									<option value=""></option>';
	$t = $tiempos->buscardonde('ID_TIEMPO_ATENCION');
	while($t){
		if($tiempos->obtener('ID_TIEMPO_ATENCION') == $servicios->obtener('ID_TIEMPO_ATENCION')){
			$select = 'selected';
		}else{
			$select = '';
		}
		$cont.='
									<option value="'.$tiempos->obtener('ID_TIEMPO_ATENCION').'" '.$select.'>'.$tiempos->obtener('DURACION').'</option>
		';
		$t = $tiempos->releer();
	}
	$cont.='
								</select>
							</td>
						<tr>
					</table>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>