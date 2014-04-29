<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$tiempos = new Accesatabla('tiempos_atencion');
	$servicios = new Accesatabla('servicios_medicos');
	$id = $_GET['id'];
	$comillas = "'";
	if(!empty($id)){
		$img = '<a href="./?url=servicios&sbm=5" title="A&ntilde;adir Servicio M&eacute;dico"><img src="./iconos/plus.png"></a><br><br>';
	}
	$cont.='
			<center>
				<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Agregar Servicios M&eacute;dicos</h3>
				<label for="search_string">Buscar Servicio M&eacute;dico:</label> <input type="text" id="search_string" Placeholder="Filtrar" />
				<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
					<table class="table2 borde-tabla table-hover" id="servicios">
						<thead>
							<tr class="fd-table">
								<th>#</th>
								<th>Servicios</th>
								<th>Tiempos de Atenci&oacute;n <i>(MIN)</i></th>
								<th style="min-width:20px;"></th>
							</tr>
						</thead>
						<tbody>';
	$s = $servicios->buscardonde('ID_SERVICIO > 0');
	$n = 1;
	while($s){
		$tiempos->buscardonde('ID_TIEMPO_ATENCION = '.$servicios->obtener('ID_TIEMPO_ATENCION').'');
		$cont.='
							<tr>
								<td>'.$n.'.</td>
								<td class="service">'.$servicios->obtener('DESCRIPCION').'</td>
								<td>'.$tiempos->obtener('DURACION').'</td>
								<td><a href="./?url=servicios&id='.$servicios->obtener('ID_SERVICIO').'"><img src="./iconos/search.png"></a></td>
							</tr>
		';
		$n++;
		$s = $servicios->releer();
	}
	$servicios->buscardonde('ID_SERVICIO = '.$id.'');
	$cont.='
						</tbdoy>
					</table>
				</div>
				'.$img.'
				<form method="POST" action="./?url=addservicio&id='.$id.'&sbm=5">
					<table>
						<tr>
							<td>Servicio M&eacute;dico: </td>
							<td><input type="text" id="servicio" name="servicio" placeholder="Servicio M&eacute;dico" value="'.$servicios->obtener('DESCRIPCION').'" required></td>
						<tr>						
						<tr>
							<td>Tiempo de Atenci&oacute;n: </td>
							<td>
								<select id="tiempo" name="tiempo" required="required">
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
				$('.$comillas.'#servicios tr'.$comillas.').show();
				
				//esto es para revisar si tenemos algo que buscar, sino, que no lo haga.
				if(search.length>0)
				{
				// con la clase .service le decimos en cual de las celdas buscar y si no coincide, ocultamos el tr que contiene a esa celda. 
				$("#servicios tr td.service").not(":Contains('.$comillas.'"+search+"'.$comillas.')").parent().hide();
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