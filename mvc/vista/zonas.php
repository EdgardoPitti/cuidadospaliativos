<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$zonas = new Accesatabla('zona');
	$id = $_GET['id'];
	$comillas = "'";
	
	if(!empty($id)){
		$img = '<a href="./?url=zonas&sbm=5" title="A&ntilde;adir Zonas"><img src="./iconos/plus.png"></a><br><br>';
	}
	$cont.='
			<center>
				<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Agregar Zonas</h3>
				<label for="search_string">Buscar Zonas:</label> <input type="text" id="search_string" Placeholder="Filtrar" />
				<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
					<table class="table2 borde-tabla table-hover" id="zonas">
						<thead>
							<tr class="fd-table">
								<th>#</th>
								<th>Zona</th>
								<th style="min-width:20px"></th>
							</tr>
						</thead>
						<tbody>';
	$z = $zonas->buscardonde('ID_ZONA > 0');
	$n=1;
	while($z){
		$cont.='
							<tr>
								<td>'.$n.'.</td>
								<td class="nombzona">'.$zonas->obtener('ZONA').'</td>
								<td><a href="./?url=zonas&id='.$zonas->obtener('ID_ZONA').'"><img src="./iconos/search.png"></a></td>					
							</tr>
		';
		$n++;
		$z = $zonas->releer();
	}
	$zonas->buscardonde('ID_ZONA = '.$id.'');
	$cont.='		
						</tbody>
					</table>
				</div>
				'.$img.'
				<form id="form" method="POST" action="./?url=addzona&id='.$id.'&sbm=5">
					Zona: <input type="text" id="zona" name="zona" placeholder="Nombre de la Zona" value="'.$zonas->obtener('ZONA').'" required><br>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</center>
			
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
				$('.$comillas.'#zonas tr'.$comillas.').show();
				
				//esto es para revisar si tenemos algo que buscar, sino, que no lo haga.
				if(search.length>0)
				{
				// con la clase .nombzona le decimos en cual de las celdas buscar y si no coincide, ocultamos el tr que contiene a esa celda. 
				$("#zonas tr td.nombzona").not(":Contains('.$comillas.'"+search+"'.$comillas.')").parent().hide();
				}

			});
		</script>	
			
	';
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>