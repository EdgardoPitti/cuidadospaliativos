<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
		
		$_SESSION['nav'] = '
				<li class="linker"><a href=".?url=">Inicio</a></li>
				<li class="linker"><a href="#">Atenciones</a>
					<ul class="fdgrissub">
						<li class="linkersub"><a href="#">Domiciliaria</a></li>
						<li class="linkersub"><a href="#">Ambulatoria</a></li>
						<li class="linkersub"><a href="#">Hospitalaria</a></li>
					</ul>
				</li>
				<li class="linker"><a href="#">Transacciones</a></li>
				<li class="linker"><a href="#">Configuraci�n</a></li>
				<li class="linker"><a href="#">Contactenos</a></li>';
		$_SESSION['aside'] ='
				
					<div>
						<input type="radio" id = "acor-1" name="rb">
							<label for="acor-1">Registro de Visitas Domiciliaria</label>
						</input>
						<article class="de-peq">
							<ul>	
								<li><a class="a" href="./?url=domiciliaria_capturardatos">Capturar Datos</a></li>
								<li><a class="a" href="#">Agenda</a></li>
							</ul>
						</article>
					</div>
					<div class="acor_link">
						<a href="#">Registro de Actividades Diarias</a>
					</div>
					<div class="acor_link">
						<a href="./?url=domiciliaria_surco">Sistema �nico de Referencia y Contra-Referencia (SURCO)</a>
					</div>
					<div>
						<input type="radio" id = "acor-2" name="rb">
							<label for="acor-2">Indicadores</label>
						</input>
						<article class="de-gra">
							<ul>
								<li><a class="a" href="#">Total de visitas realizadas</a></li>
								<li><a class="a" href="#">Tiempo promedio por visita</a></li>
								<li><a class="a" href="#">N�mero de visitas por paciente seg�n diagn�stico</a></li>
								<li><a class="a" href="#">Actividades realizadas por visitas</a></li>
							</ul>
						</article>
					</div>';
					
					
					
		
	$ds->nav($_SESSION['nav'] );
	$ds->aside($_SESSION['aside'] );
	//$ds->cont($cont);
	$ds->mostrar();
?>