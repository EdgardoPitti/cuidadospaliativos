<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$personas = new Accesatabla('personas');
	$tiposangre = new Accesatabla('tipos_de_sangre');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$ds = new Diseno();
	
	$tab1="'tab_01'";
	$tab2 = "'tab_02'";
	$panel1 = "'panel_01'";
	$panel2 = "'panel_02'";
	
	$cedula = $_POST['cedula'];
	$personas->buscardonde('cedula = "'.$cedula.'"');
	if ($personas->obtener('femenino')){
		$sexo = 'Femenino';
	}else{
		$sexo = 'Masculino';
	}
	if ($personas->obtener('asegurado')){
		$tipo = 'Asegurado';
	}else{
		$tipo = 'No Asegurado';
	}
	list($anio, $mes, $dia) = explode("-", $personas->obtener('fecha_de_nacimiento'));
	$cont.='
		<fieldset>
			<legend>Atención al Paciente</legend>
			<div>
				<div id="paneles">
					<section id="panel_01">
						<div align="right">
							<form method="POST" action="./?url=ambulatoria_atencionalpaciente">
								<input type="search" class="search" id="buscar" name="cedula" placeholder="Buscar Paciente">	
								<button>Buscar</button> 
							</form>
						</div>
						<table width="100%" style="margin:10px auto;border:1px solid #a3a3a3; background:#fafafa;">
							<tr>
								<td style="border:1px solid #a3a3a3;" width="50%">
									<table class="tabla-datos">
										<tr>
											<td colspan="3"><strong>'.$personas->obtener('primer_nombre').' '.$personas->obtener('segundo_nombre').' '.$personas->obtener('primer_apellido').' '.$personas->obtener('segundo_apellido').'</strong></td>
										</tr>
										<tr>
											<td>'.$personas->obtener('cedula').'</td>
											<td>'.$tiposangre->renombrar($personas->obtener('id_tipo_de_sangre'),tipo_sangre).'</td>
											<td>'.$sexo.'</td>
										</tr>
										<tr>
											<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
											<td>'.$tipo.'</td>
											<td>'.$ds->edad($dia,$mes,$anio).'</td>
										</tr>
									</table>
								</td>
								<td style="border:1px solid #a3a3a3;" width="50%">
									<table class="tabla-datos">
										<tr>
											<td colspan="3"><strong>Datos de Contacto/Dirección:</strong></td>
										</tr>
										<tr>
											<td colspan="3">'.$provincias->renombrar($personas->obtener('id_provincia_residencia'), descripcion).', '.$distritos->renombrar($personas->obtener('id_distrito_nacimiento'), descripcion).'</td>
										</tr>
										<tr>
											<td colspan="3">'.$corregimientos->renombrar($personas->obtener('id_corregimiento_nacimiento'), descripcion).', '.$personas->obtener('direccion_detallada').'</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<fieldset style="padding:5px;float:left">
							<legend style="font-size:14px;font-weight:bold;">Resumen Médico</legend>
							<div class="acordeon">
								<div>
									<input type="radio" id = "acor-1" name="resumen_medico">
										<label for="acor-1">08/Mar/2013</label>
									</input>
									<article class="de-gra">
										<input type="radio" id = "acor-1-2" name="resumen_medico1_sub1">
											<label style="margin-left:15px;" for="acor-1-2">Atención Domiciliaria</label>
										</input>
										<article class="de-gra" style="margin-left:25px;list-type-style:none;">
											<ul>	
												<li><p>Actividades Realizadas</p></li>
												<li><p>Medicamentos Suministrados</p></li>
											</ul>
										</article>
									</article>
								</div>
								<div>
									<input type="radio" id = "acor-2" name="resumen_medico">
										<label for="acor-2">02/Dic/2012</label>
									</input>
									<article class="de-gra">
										<input type="radio" id = "acor-2-1" name="resumen_medico2_sub2">
											<label style="margin-left:15px;" for="acor-2-1">Atención Domiciliaria</label>
										</input>
										<article class="de-gra" style="margin-left:25px;list-type-style:none;">	
											<ul style="margin-left:25px;">
												<li><p>Actividades Realizadas</p></li>
												<li><p>Medicamentos Suministrados</p></li>
											</ul>
										</article>
									</article>
								</div>
							</div>
						</fieldset>
						<div class="acor_link" align="center" style="margin:10px 0 0 75px; float:none;">
							<a href="#">Agregar Observaciones</a>
						</div>
						<div class="acor_link" align="center" style="margin:20px 0 0 75px;float:none;">
							<a href="#">Responder Interconsulta</a>
						</div>
					</section>
					
					
					<section id="panel_02">
						<form method="POST" action="./?url">
							<table width="55%">
								<tr>
									<td><input type="search" class="search" id="buscar" placeholder="Buscar Paciente"  name="busc_paciente"/></td>
									<td><input type="radio" name="selectipo">Nombre</input></td>
									<td><input type="radio" name="selectipo">Cédula</input></td>
								</tr>
							</table>
						</form>
					</section>
				</div>
			</div>
		</fieldset>

				';
	$ds->contenido($cont);
	$ds->mostrar();
?>