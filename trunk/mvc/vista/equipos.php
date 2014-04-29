<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$equipos = new Accesatabla('equipo_medico');
	$detalle_equipo = new Accesatabla('detalle_equipo_medico');
	$profesional = new Accesatabla('profesionales_salud');
	$datos = new Accesatabla('datos_profesionales_salud');
	$especialidades = new Accesatabla('especialidades_medicas');
	$id = $_GET['id'];
	$cont.='
			<center>
				<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;"><a href="./?url=equipos_medicos&sbm=5" class="btn btn-primary" style="float:left;position:relative;top:-5px;left:10px;" title="Regresar"><i class="icon-arrow-left icon-white"></i></a>Equipos M&eacute;dicos</h3>';
	if(!empty($id)){
		$cont.='
				ID Equipo Medico = '.$id.'<br>
				<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
					<table class="table2 borde-tabla table-hover">
						<thead>
							<tr class="fd-table">
								<th>#</th>		
								<th>C&eacute;dula</th>
								<th>Profesional</th>
								<th>Especialidad</th>
							</tr>
						</thead>
						<tbody>';
		$n = 1;
		$d = $detalle_equipo->buscardonde('ID_EQUIPO_MEDICO = '.$id.'');
		while($d){
			$profesional->buscardonde('ID_PROFESIONAL = '.$detalle_equipo->obtener('ID_PROFESIONAL').'');
			$datos->buscardonde('ID_PROFESIONAL = '.$detalle_equipo->obtener('ID_PROFESIONAL').'');
			$especialidades->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$profesional->obtener('ID_ESPECIALIDAD_MEDICA').'');
			$segundo_nombre = $datos->obtener('SEGUNDO_NOMBRE');
			$segundo_apellido = $datos->obtener('APELLIDO_MATERNO');
			$cont.='
								<tr>
									<td><strong>'.$n.'</strong></td>
									<td>'.$datos->obtener('NO_CEDULA').'</td>
									<td>'.$datos->obtener('PRIMER_NOMBRE').' '.$segundo_nombre[0].'. '.$datos->obtener('APELLIDO_PATERNO').' '.$segundo_apellido[0].'.</td>
									<td>'.$especialidades->obtener('DESCRIPCION').'</td>
								</tr>
			';
			$n++;
			$d = $detalle_equipo->releer();
		}	
		$cont.='
						</tbody>
					</table>
				</div>
				';
	}else{
		$cont.='<i>(Agregue un Profesional para crear un Equipo M&eacute;dico Nuevo).</i>';
	
	}	
	$cont.= $_SESSION['error'];
	$cont.='
			<form class="form-control" method="POST" action="./?url=addequipo"><br>
				<input type="hidden" id="id" name="id" value="'.$id.'">
				<label>Nombre Profesional:</label>
				<input type="search" class="form-control" id="profesional" name="profesional" placeholder="Buscar Profesional">
				<input type="text" id="cedprofesional" name="cedprofesional" placeholder="C&eacute;dula Profesional" readonly><br>
				<button class="btn btn-primary" title="Agregar Profesional">Agregar Profesional</button>					
			</form>
			';
				
	$cont.='
			</center>
	';
	
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
	$_SESSION['error']='';
?>