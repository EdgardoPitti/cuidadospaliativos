<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$usuarios = new Accesatabla('usuarios');
	$grupo = new Accesatabla('grupos_usuarios');
	$id = $_GET['id'];
	$comillas = "'";
	
	if(!empty($id)){
		$img = '<a href="./?url=usuarios" title="A&ntilde;adir Usuario"><img src="./iconos/plus.png"></a><br><br>';
	}
	
	$cont.='
			<center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Agregar o Editar Usuarios</h3>		
				<label>Buscar No. de Identificaci&oacuten:</label> <input type="text" id="search_string" Placeholder="Filtrar" />
				<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
					<table class="table2 borde-tabla table-hover" id="usuarios">
						<thead>
							<tr class="fd-table">
								<th>#</th>					
								<th>No de Identificaci&oacute;n</th>
								<th>Clave de Acceso</th>
								<th>Grupo de Usuario</th>
								<th style="min-width:20px;"></th>
							</tr>
						</thead>
						<tbody>
						';
	$u = $usuarios->buscardonde('ID_USUARIO > 0');
	$n = 1;
	while($u){
		$grupo->buscardonde('ID_GRUPO_USUARIO = '.$usuarios->obtener('ID_GRUPO_USUARIO').'');
		$cont.='
							<tr>
								<td><strong>'.$n.'.</strong></td>
								<td class="identificacion">'.$usuarios->obtener('NO_IDENTIFICACION').'</td>
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
						</tbody>
					</table>
				</div>
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
	$cont.='
		<script language="JavaScript" type="text/JavaScript">
			// Con estas 3 líneas sobreescribimos el Constains para que no sea case sensitive pues por default en jquery  viene con case sensitive. Si no lo pones, queda como Case sensitive
			$.expr['.$comillas.':'.$comillas.'].Contains = function(x, y, z){
				return jQuery(x).text().toLowerCase().indexOf(z[3].toLowerCase())>=0;
			};

			// cada que escribamos, vamos a revisar lo que hay escrito 
			$('.$comillas.'#search_string'.$comillas.').keyup(function() 
			{
				//tomamos el valor que tiene el input
				var search = $('.$comillas.'#search_string'.$comillas.').val();
				//mostramos todos los valores, para despues ir ocultando los que no coinciden
				$('.$comillas.'#usuarios tr'.$comillas.').show();
				
				//esto es para revisar si tenemos algo que buscar, sino, que no lo haga.
				if(search.length>0)
				{
				// con la clase .identificacion le decimos en cual de las celdas buscar y si no coincide, ocultamos el tr que contiene a esa celda. 
				$("#usuarios tr td.identificacion").not(":Contains('.$comillas.'"+search+"'.$comillas.')").parent().hide();
				}

			});
		</script>
	
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>