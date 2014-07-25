<?php

	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();

	$cont.='

		<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Men&uacute; de Diario de Actividades</h3>		


			<center>
				<div class="centrar_botones">
					<p><a href="./?url=domiciliarias_diario_actividades&sbm=7&t=1" class="btn btn-primary">Domiciliaria - Diario de Actividades</a></p>  
					<p><a href="./?url=domiciliarias_diario_actividades&sbm=7&t=2" class="btn btn-primary">Ambulatoria - Diario de Actividades</a></p>  
					<p><a href="./?url=domiciliarias_diario_actividades&sbm=7&t=3" class="btn btn-primary">Hospitalaria - Diario de Actividades</a></p>  
				</div>
			</center>
	';

	$ds->contenido($cont);
	$ds->mostrar();

?>