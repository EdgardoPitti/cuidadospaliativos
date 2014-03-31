<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$zonas = new Accesatabla('zona');
	$id = $_GET['id'];
	if(!empty($id)){
		$img = '<a href="./?url=zonas" title="A&ntilde;adir Zonas"><img src="./iconos/plus.png"></a><br><br>';
	}
	$cont.='
			<center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Agregar Zonas</h3>
				<table class="table2 borde-tabla table-hover">
					<tr>
						<th>#</th>
						<th>Zona</th>
						<th></th>
					</tr>';
	$z = $zonas->buscardonde('ID_ZONA > 0');
	$n=1;
	while($z){
		$cont.='
					<tr>
						<td>'.$n.'.</td>
						<td>'.$zonas->obtener('ZONA').'</td>
						<td><a href="./?url=zonas&id='.$zonas->obtener('ID_ZONA').'"><img src="./iconos/search.png"></a></td>					
					</tr>
		';
		$n++;
		$z = $zonas->releer();
	}
	$zonas->buscardonde('ID_ZONA = '.$id.'');
	$cont.='
				</table>
				'.$img.'
				<form method="POST" action="./?url=addzona&id='.$id.'">
					Zona: <input type="text" id="zona" name="zona" placeholder="Nombre de la Zona" value="'.$zonas->obtener('ZONA').'" required><br>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>