<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$ds = new Diseno();
	$especialidad = new Accesatabla('especialidades_medicas');
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$interconsulta = new Accesatabla('interconsulta');
	$profesional = new Accesatabla('profesionales_salud');
	$datosprofesional = new Accesatabla('datos_profesionales_salud');
	$especialidad = new Accesatabla('especialidades_medicas');
	$sbm = $_GET['sbm'];
	$cedula = $_POST['cedula'];
	if(!empty($cedula) and !($personas->buscardonde('NO_CEDULA = "'.$cedula.'"'))){
		$sw = 1;
	}else if(empty($cedula)){
		$cedula = $_GET['idp'];
	}
	$ds = new Diseno();
	$cont='
			<center>
				<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;"> Interconsulta</h3>
				<form class="form-search" method="POST" action="./?url=ambulatoria_interconsulta&sbm='.$sbm.'">
					<div class="input-group">
					  Buscar paciente: <input type="search" class="form-control" id="busqueda" placeholder="C&eacute;dula o Nombre" name="cedula" required>
					  <span class="input-group-btn">
						<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
					  </span>
					</div>
				</form>
			</center>';
	if ($sw == 1 AND !empty($cedula)){
			$cont.='<center>Paciente no encontrado...<a href="./?url=nuevopaciente&sbm=5"><img src="./iconos/add_profesional.png" title="Añadir Paciente"></a></center>';
	}else if($sw == 0 AND !empty($cedula)){ 
		$personas->buscardonde('NO_CEDULA = "'.$cedula.'" OR ID_PACIENTE = "'.$cedula.'"');
		$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$personas->obtener('ID_RESIDENCIA_HABITUAL').'');
		$tiposangre->buscardonde('ID_TIPO_SANGUINEO = '.$personas->obtener('ID_TIPO_SANGUINEO').'');
		$provincias->buscardonde('ID_PROVINCIA = '.$residencia->obtener('ID_PROVINCIA').'');
		$distritos->buscardonde('ID_DISTRITO = '.$residencia->obtener('ID_DISTRITO').'');
		$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$residencia->obtener('ID_CORREGIMIENTO').'');
		if ($personas->obtener('ID_SEXO') == 1){
			$sexo = 'MASCULINO';
		}else{
			$sexo = 'FEMENINO';
		}
		if($personas->obtener('ID_TIPO_PACIENTE')){
			$asegurado = 'ASEGURADO';
		}else{
			$asegurado = 'NO ASEGURADO';
		}
		list($anio, $mes, $dia) = explode("-", $personas->obtener('FECHA_NACIMIENTO'));
	$cont.='<center>
			<div class="row-fluid">
				<div class="span6" id="paciente">
					<fieldset>
						<legend>
							Paciente
						</legend>
							<table class="table2">											
								<tr>
									<td colspan="3"><h5>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</h5></td>
								</tr>
								<tr>
									<td>'.$personas->obtener('NO_CEDULA').'</td>
									<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
									<td>'.$sexo.'</td>
								</tr>
								<tr>
									<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
									<td>'.$asegurado.'</td>
									<td>'.$ds->edad($dia,$mes,$anio).' A&ntilde;os</td>
								</tr>
							</table>
					</fieldset>
				</div>
				<div class="span6" id="direccion">
					<fieldset>
						<legend>
							Direcci&oacute;n
						</legend>
							<table class="table2" style="height:86px;">
								<tr>
									<td>'.$distritos->obtener('DISTRITO').' , '.$provincias->obtener('PROVINCIA').'</td>
								</tr>
								<tr>
									<td>'.$corregimientos->obtener('CORREGIMIENTO').' , '.$residencia->obtener('DETALLE').'</td>
								</tr>
							</table>
					</fieldset>
				</div>	
			</div>';
			$i = $interconsulta->buscardonde('ID_PACIENTE = '.$personas->obtener('ID_PACIENTE').' ORDER BY FECHA');
			if($i){
				$cont.='
					<br>
					<div class="overflow overthrow" style="max-height:150px;">
								<table class="table2 borde-tabla table-hover">
									<thead>
										<tr class="fd-table">
											<th>#</th>
											<th>Fecha</th>
											<th>Profesional</th>
											<th>Especialidad</th>
											<th>Observacion / Comentario</th>
										</tr>
									</thead>
									<tbody>';
				$n = 1;
				while($i){								
					$profesional->buscardonde('ID_PROFESIONAL = '.$interconsulta->obtener('ID_PROFESIONAL').'');
					$datosprofesional->buscardonde('ID_PROFESIONAL = '.$interconsulta->obtener('ID_PROFESIONAL').'');
					$especialidad->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$profesional->obtener('ID_ESPECIALIDAD_MEDICA').'');
					$segundo_nombre = $datosprofesional->obtener('SEGUNDO_NOMBRE');
					$segundo_apellido = $datosprofesional->obtener('APELLIDO_MATERNO');
					$cont.='
											<tr>
												<td>'.$n.'.</td>
												<td>'.$interconsulta->obtener('FECHA').'</td>
												<td>'.$datosprofesional->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$datosprofesional->obtener('APELLIDO_PATERNO').' '.$segundo_apellido[0].'.</td>
												<td>'.$especialidad->obtener('DESCRIPCION').'</td>
												<td>'.$interconsulta->obtener('OBSERVACIONES').'</td>
											</tr>';
					$n++;
					$i = $interconsulta->releer();
				}
				$cont.='
									</tbody>
								</table>
					</div>';
			}
			$cont.='
			
			<br><div style="width:100%;max-width:600px;">
				<form id="form" method="POST" action="./?url=agregar_interconsulta&idp='.$personas->obtener('ID_PACIENTE').'">
				<table width="100%">
					<tr align="center">
						<td>Fecha: </td>
						<td><input type="date" placeholder="AAAA-MM-DD" id="fecha" name="fecha" required></td>
					</tr>
					<tr align="center">
						<td>Observaciones/Comentarios</td>
						<td><textarea id="obs_coment" name="obs_coment" class="textarea2" style="width:90%;h eight:70px;"></textarea></td>
					</tr>
				</table>
			</div><br>
			<button type="submit" class="btn btn-primary" >Agregar</button>
			</center>	
	
	';
	}
	
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>