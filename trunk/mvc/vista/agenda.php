<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	$cont='
		<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Agenda de Citas Médicas</h3>
		<div class="row-fluid">
			<div class="span3">
				<article>
					<center>
						<h3>Jueves</h3>
						<h1>30</h1>
						<h5>Enero 2014</h5>
					</center>
				</article>
			</div>
			<div class="span9"></div>
		</div>
	';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>