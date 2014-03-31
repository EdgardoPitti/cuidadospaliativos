<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$usuarios = new Accesatabla('usuarios');
	$grupo = new Accesatabla('grupos_usuarios');
	$id = $_GET['id'];
	if(!empty($id)){
		$img = '<a href="./?url=usuarios" title="A&ntilde;adir Usuario"><img src="./iconos/plus.png"></a><br><br>';
	}
	$cont.='
			<center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Agregar o Editar Usuarios</h3>		
				<table class="table2 borde-tabla table-hover">
					<tr>
						<th>#</th>					
						<th>No de Identificaci&oacute;n</th>
						<th>Clave de Acceso</th>
						<th>Grupo de Usuario</th>
						<th></th>
					</tr>';
	$u = $usuarios->buscardonde('ID_USUARIO > 0');
	$n = 1;
	while($u){
		$grupo->buscardonde('ID_GRUPO_USUARIO = '.$usuarios->obtener('ID_GRUPO_USUARIO').'');
		$cont.='
					<tr>
						<td>'.$n.'.</td>
						<td>'.$usuarios->obtener('NO_IDENTIFICACION').'</td>
						<td>******</td>
						<td>'.$grupo->obtener('DESCRIPCION').'</td>
						<td><a href="./?url=usuarios&id='.$usuarios->obtener('ID_USUARIO').'"><img src="./iconos/search.png"></a></td>
					</tr>
		';
		$n++;
		$u = $usuarios->releer();
	}
	$usuarios->buscardonde('ID_USUARIO = '.$id.'');
	$cont.='
				</table>
					'.$img.'
				<form method="POST" action="./?url=addusuario&id='.$id.'">
					<table>
						<tr>
							<td>No de Identificaci&oacute;n: </td>
							<td><input type="text" id="no_identificacion" name="no_identificacion" placeholder="No de Identificaci&oacute;n" value="'.$usuarios->obtener('NO_IDENTIFICACION').'" required></td>
						</tr>
						<tr>
							<td>Clave de Acceso: </td>
							<td><input type="text" id="clave" name="clave" placeholder="Clave de Acceso" value="'.$usuarios->obtener('CLAVE_ACCESO').'" required></td>
						</tr>
						<tr>
							<td>Grupo de Usuario: </td>
							<td>
								<select id="grupo" name="grupo">
									<option value=""></option>';
	$g = $grupo->buscardonde('ID_GRUPO_USUARIO > 0');
	while($g){
		if($grupo->obtener('ID_GRUPO_USUARIO') == $usuarios->obtener('ID_GRUPO_USUARIO')){
			$selected = 'selected';
		}else{
			$selected = '';
		}
		$cont.='
									<option value="'.$grupo->obtener('ID_GRUPO_USUARIO').'" '.$selected.'>'.$grupo->obtener('DESCRIPCION').'</option>
		';
		$g = $grupo->releer();	
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