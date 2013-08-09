<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	$_SESSION['aside'] ='
				
					<div>
						<input type="radio" id = "acor-ambul1" name="rb">
							<label for="acor-ambul1">Registro Diario de Actividades</label>
						</input>
						<article class="de-peq">
							<ul>	
								<li><a class="a" href="./?url=ambulatoria_capturardatos">Capturar Datos</a></li>
								<li><a class="a" href="#">Agenda</a></li>
							</ul>
						</article>
					</div>
					<div>
						<input type="radio" id = "acor-ambul2" name="rb">
							<label for="acor-ambul2">Contacto Telefónico</label>
						</input>
						<article class="de-peq">
							<ul>
								<li><a class="a" href="#">Atención al Paciente</a></li>
								<li><a class="a" href="#">Interconsulta</a></li>								
							</ul>
						</article>
					</div>
					<div>
						<input type="radio" id = "acor-ambul3" name="rb">
							<label for="acor-ambul3">Indicadores</label>
						</input>
						<article class="de-peq">
							<ul>
								<li><a class="a" href="#">Frecuencia P/F a la instalación</a></li>
								<li><a class="a" href="#">Actividades Realizadas</a></li>
								
							</ul>
						</article>
					</div>';
	
	$tab1="'tab_01'";
	$tab2 = "'tab_02'";
	$panel1 = "'panel_01'";
	$panel2 = "'panel_02'";
	
	
	$cont='
		<fieldset style="height:530px;">
			<legend style="font-size:17px;font-weight:bold;" align="center">Contacto Telefónico</legend>
			<div id="panel">
				<ul id="tabs">
					<li id="tab_01"><a href="#" onclick="tab('.$tab1.','.$panel1.');">Atención al Paciente</a></li>
					<li id="tab_02"><a href="#" onclick="tab('.$tab2.','.$panel2.');">Interconsulta</a></li>
				</ul>
				<div id="paneles">
					<section id="panel_01">
						<div align="right">
							<input type="search" class="search" id="buscar" placeholder="Buscar Paciente"/>	
							<select id="resultado" style="width:145px;">
								
							</select>
						</div>
						<table width="100%" style="margin:10px auto;border:1px solid #a3a3a3; background:#fafafa;">
							<tr>
								<td style="width:150px;border:1px solid #a3a3a3;">
									<table class="tabla-datos">
										<tr>
											<td colspan="3"><strong>Fulanito de Tal</strong></td>
										</tr>
										<tr>
											<td>4-125-634</td>
											<td>O+</td>
											<td>Masculino</td>
										</tr>
										<tr>
											<td>15/09/1979</td>
											<td>Asegurado</td>
											<td>34 años</td>
										</tr>
									</table>
								</td>
								<td style="width:200px;border:1px solid #a3a3a3;">
									<table class="tabla-datos">
										<tr>
											<td colspan="3"><strong>Datos de Contacto/Dirección:</strong></td>
										</tr>
										<tr>
											<td colspan="3">Panamá La Chorrera</td>
										</tr>
										<tr>
											<td colspan="3">Barrio Colón, Casa 2250, Calle Matuna</td>
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
					
		<!-- Script para marcar la primera pestaña-->
		<script type="text/javascript">
			tab("tab_01","panel_01");
		</script>
				';
	
	
	$ds->nav($_SESSION['nav']);
	$ds->izq($_SESSION['aside']);
	$ds->contenido($cont);
	$ds->mostrar();
?>