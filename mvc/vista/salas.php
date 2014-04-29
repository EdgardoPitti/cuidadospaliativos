<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$sala = new Accesatabla('sala');
	$id = $_GET['id'];
	$comillas = "'";
	if(!empty($id)){
		$img = '<a href="./?url=salas&sbm=5" title="A&ntilde;adir Sala"><img src="./iconos/plus.png"></a><br><br>';
	}
	$cont.='
			<center>			
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Editar Salas</h3>
				<label for="search_string">Buscar Sala:</label> <input type="text" id="search_string" Placeholder="Filtrar" />
				<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
					<table class="table2 borde-tabla table-hover" id="salas">
						<thead>
							<tr class="fd-table">
								<th>#</th>
								<th>Sala</th>
								<th style="min-width:20px;"></th>
							</tr>
						</thead>
						<tbody>
				';
	$s = $sala->buscardonde('ID_SALA > 0');
	$n = 1;
	while($s){
		$cont.='
					<tr>
						<td><strong>'.$n.'.</strong></td>
						<td class="nombresala">'.$sala->obtener('SALA').'</td>
						<td><a href="./?url=salas&id='.$sala->obtener('ID_SALA').'"><img src="./iconos/search.png"></a></td>
					</tr>
		';
		$n++;
		$s = $sala->releer();
	}
	$sala->buscardonde('ID_SALA = '.$id.'');
	$cont.='
						</tbody>						
					</table>
				</div>
				'.$img.'
				<form method="POST" action="./?url=addsala&id='.$id.'&sbm=5">
					Sala: <input type="text" id="sala" name="sala" placeholder="Sala" value="'.$sala->obtener('SALA').'" required><br>
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
				$('.$comillas.'#salas tr'.$comillas.').show();
				
				//esto es para revisar si tenemos algo que buscar, sino, que no lo haga.
				if(search.length>0)
				{
				// con la clase .nombresala le decimos en cual de las celdas buscar y si no coincide, ocultamos el tr que contiene a esa celda. 
				$("#salas tr td.nombresala").not(":Contains('.$comillas.'"+search+"'.$comillas.')").parent().hide();
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