<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
		
		$_SESSION['nav'] = '
				<li class="linker"><a href="./?url=">Inicio</a></li>
				<li class="linker"><a href="#">Atenciones</a>
					<ul class="fdgrissub">
						<li class="linkersub"><a href="./?url=atencion_domiciliaria">Domiciliaria</a></li>
						<li class="linkersub"><a href="./?url=atencion_ambulatoria">Ambulatoria</a></li>
						<li class="linkersub"><a href="#">Hospitalaria</a></li>
					</ul>
				</li>
				<li class="linker"><a href="#">Transacciones</a></li>
				<li class="linker"><a href="#">Configuración</a></li>
				<li class="linker"><a href="#">Contactenos</a></li>';					
		
	$ds->nav($_SESSION['nav'] );
	//$ds->cont($cont);
	$ds->mostrar();
?>