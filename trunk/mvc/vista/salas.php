<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$sala = new Accesatabla('sala');
	$id = $_GET['id'];
	if(!empty($id)){
		$img = '<a href="./?url=salas" title="A&ntilde;adir Sala"><img src="./iconos/plus.png"></a><br><br>';
	}
	$cont.='
			<center>			
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Salas</h3>
				<table class="table2 borde-tabla table-hover">
					<tr>
						<th>#</th>
						<th>Sala</th>
						<th></th>
					</tr>
				';
	$s = $sala->buscardonde('ID_SALA > 0');
	$n = 1;
	while($s){
		$cont.='
					<tr>
						<td>'.$n.'.</td>
						<td>'.$sala->obtener('SALA').'</td>
						<td><a href="./?url=salas&id='.$sala->obtener('ID_SALA').'"><img src="./iconos/search.png"></a></td>
					</tr>
		';
		$n++;
		$s = $sala->releer();
	}
	$sala->buscardonde('ID_SALA = '.$id.'');
	$cont.='
				</table>
				'.$img.'
				<form method="POST" action="./?url=addsala&id='.$id.'">
					Sala: <input type="text" id="sala" name="sala" placeholder="Sala" value="'.$sala->obtener('SALA').'" required><br>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>