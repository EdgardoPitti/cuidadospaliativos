<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/Diseno.php');
	$ds = new Diseno();
	$equipos = new Accesatabla('equipo_medico');
	$detalle_equipo = new Accesatabla('detalle_equipo_medico');
	$datos = new Accesatabla('datos_profesionales_salud');
	$profesional = new Accesatabla('profesionales_salud');
	$especialidades = new Accesatabla('especialidades_medicas');
	
	$cont.='
		<center>
					<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Equipos M&eacute;dicos</h3>
					<label for="search_string">Buscar Id Equipo M&eacute;dico:</label> <input type="text" id="search_string" Placeholder="Filtrar" />
					<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
					<table class="table2 borde-tabla table-hover" id="equipomedico">
						<thead>
							<tr class="fd-table">
								<th style="min-width:20px;">#</th>
								<th class="id_equipo_medico">ID Equipo M&eacute;dico</th>	
								<th>Profesionales</th>
								<th>Especialidades</th>
								<th style="min-width:20px;"></th>
							</tr>
						</thead>
						<tbody>';
	$n = 1;
	$e = $equipos->buscardonde('ID_EQUIPO_MEDICO > 0');
	while($e){
		$d = $detalle_equipo->buscardonde('ID_EQUIPO_MEDICO = '.$equipos->obtener('ID_EQUIPO_MEDICO').'');
		while($d){
			$profesional->buscardonde('ID_PROFESIONAL = '.$detalle_equipo->obtener('ID_PROFESIONAL').'');
			$datos->buscardonde('ID_PROFESIONAL = '.$detalle_equipo->obtener('ID_PROFESIONAL').'');
			$especialidades->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$profesional->obtener('ID_ESPECIALIDAD_MEDICA').'');
			$segundo_nombre = $datos->obtener('SEGUNDO_NOMBRE');
			$segundo_apellido = $datos->obtener('APELLIDO_MATERNO');
			$cont.='
						<tr>
							<td><strong>'.$n.'</strong></td>
							<td>'.$equipos->obtener('ID_EQUIPO_MEDICO').'</td>
							<td>'.$datos->obtener('NO_CEDULA').' '.$datos->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$datos->obtener('APELLIDO_PATERNO').' '.$segundo_apellido[0].'.</td>
							<td>'.$especialidades->obtener('DESCRIPCION').'</td>
							<td><a href="./?url=equipos&id='.$equipos->obtener('ID_EQUIPO_MEDICO').'&sbm=5"><img src="./iconos/search.png"></a></td>
						</tr>
			';
			$n++;
			$d = $detalle_equipo->releer();
		}
		$e = $equipos->releer();
	}	
	$cont.='
					</tbody>
				</table>
			</div>
			<a href="./?url=equipos&sbm=5" title="A&ntilde;adir Equipo M&eacute;dico" class="btn btn-primary">Agregar Equipo M&eacute;dico</a>
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
				$('.$comillas.'#equipomedico tr'.$comillas.').show();
				
				//esto es para revisar si tenemos algo que buscar, sino, que no lo haga.
				if(search.length>0)
				{
				// con la clase .id_equipo_medico le decimos en cual de las celdas buscar y si no coincide, ocultamos el tr que contiene a esa celda. 
				$("#equipomedico tr td.id_equipo_medico").not(":Contains('.$comillas.'"+search+"'.$comillas.')").parent().hide();
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