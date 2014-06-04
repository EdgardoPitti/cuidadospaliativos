<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$salas = new Accesatabla('sala');
	$cama = new Accesatabla('cama');
	$id = $_GET['id'];
	$comillas = "'";
	if(!empty($id)){
		$img = '<a href="./?url=camas" title="A&ntilde;adir Cama"><img src="./iconos/plus.png"></a><br><br>';
	}
	$cont.='
			<center>
				<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Agregar Camas</h3>
				<label for="search_string">Buscar No. de Cama:</label> <input type="text" id="search_string" Placeholder="Filtrar" />
				<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
					<table class="table2 borde-tabla table-hover" id="camas">
						<thead>
							<tr class="fd-table">
								<th>#</th>
								<th>Cama</th>
								<th>Sala</th>
								<th style="min-width:20px;"></th>
							</tr>
						</thead>
						<tbody>
						';
	$c = $cama->buscardonde('ID_CAMA > 0');
	$n = 1;
	while($c){
		$salas->buscardonde('ID_SALA = '.$cama->obtener('ID_SALA').'');
		$cont.='
							<tr>
								<td><strong>'.$n.'</strong></td>
								<td class="nocama">'.$cama->obtener('CAMA').'</td>
								<td>'.$salas->obtener('SALA').'</td>
								<td><a href="./?url=camas&id='.$cama->obtener('ID_CAMA').'"><img src="./iconos/search.png"></a></td>
							</tr>
		';
		$n++;
		$c = $cama->releer();
	}
	$cama->buscardonde('ID_CAMA = '.$id.'');

	$cont.='
						</tbody>
					</table>
				</div>
				'.$img.'
				<form id="form" method="POST" action="./?url=addcama&id='.$id.'">
					<table>
						<tr>
							<td>Cama: </td>
							<td><input type="text" id="cama"  name="cama" placeholder="Cama" value="'.$cama->obtener('CAMA').'" required></td>
						</tr>
						<tr>
							<td>Sala: </td>
							<td><select id="sala" name="sala" required="required">
									<option value="">SELECCIONE SALA</option>';
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
				$('.$comillas.'#camas tr'.$comillas.').show();
				
				//esto es para revisar si tenemos algo que buscar, sino, que no lo haga.
				if(search.length>0)
				{
					// con la clase .nocama le decimos en cual de las celdas buscar y si no coincide, ocultamos el tr que contiene a esa celda. 
					$("#camas tr td.nocama").not(":Contains('.$comillas.'"+search+"'.$comillas.')").parent().hide();				
				}

			});
		</script>';
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>