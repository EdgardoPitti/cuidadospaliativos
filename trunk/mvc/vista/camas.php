<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$salas = new Accesatabla('sala');
	$cama = new Accesatabla('cama');
	$id = $_GET['id'];
	if(!empty($id)){
		$img = '<a href="./?url=camas" title="A&ntilde;adir Cama"><img src="./iconos/plus.png"></a><br><br>';
	}
	$cont.='
			<center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Agregar Camas</h3>
				<table class="table2 borde-tabla table-hover">
					<tr>
						<th>#</th>
						<th>Cama</th>
						<th>Sala</th>
						<th></th>
					</tr>';
	$c = $cama->buscardonde('ID_CAMA > 0');
	$n = 1;
	while($c){
		$salas->buscardonde('ID_SALA = '.$cama->obtener('ID_SALA').'');
		$cont.='
					<tr>
						<td>'.$n.'</td>
						<td>'.$cama->obtener('CAMA').'</td>
						<td>'.$salas->obtener('SALA').'</td>
						<td><a href="./?url=camas&id='.$cama->obtener('ID_CAMA').'"><img src="./iconos/search.png"></a></td>
					</tr>
		';
		$n++;
		$c = $cama->releer();
	}
	$cama->buscardonde('ID_CAMA = '.$id.'');

	$cont.='
				</table>
				'.$img.'
				<form method="POST" action="./?url=addcama&id='.$id.'">
					<table>
						<tr>
							<td>Cama: </td>
							<td><input type="text" id="cama"  name="cama" placeholder="Cama" value="'.$cama->obtener('CAMA').'" required></td>
						</tr>
						<tr>
							<td>Sala: </td>
							<td><select id="sala" name="sala">
									<option value=""></option>';
	$s = $salas->buscardonde('ID_SALA > 0');
	while($s){
		if($salas->obtener('ID_SALA') == $cama->obtener('ID_SALA')){
			$select = 'selected';
		}else{
			$select = '';
		}
		$cont.='
									<option value="'.$salas->obtener('ID_SALA').'" '.$select.'>'.$salas->obtener('SALA').'</option>
		';
		$s = $salas->releer();
	}
	$cont.='									
								</select>
							</td>
						</tr>
					</table>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>			
			</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>