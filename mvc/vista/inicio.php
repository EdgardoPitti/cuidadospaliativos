<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont = '<center>
				<div class="row-fluid" style="margin-top:130px;">
					<div class="span12">
						<h1 style="color:#0066CC;line-height:50px">Bienvenido al Sistema de Red Social de Cuidados Paliativos</h1>
						<small style="color:#a3a3a3;font-size:18px;">Seleccione de la barra inferior la categor&iacute;a a la que desea acceder</small>		
					</div>
				</div>		
			</center>';
	$ds->contenido($cont);
	$ds->mostrar();
?>