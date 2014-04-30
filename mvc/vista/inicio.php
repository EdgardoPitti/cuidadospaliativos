<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont = '<center>
				<div class="row-fluid margin-inicio" sty le="margin-top:130px;">
					<div class="span12">
						<h1 style="color:#0066CC;line-height:50px">Bienvenido al Sistema de Red Social de Cuidados Paliativos de Panam&aacute;</h1>
						<small style="color:#a3a3a3;font-size:18px;text-shadow:1px 0px 0px #d3d3d3;">Seleccione de la barra inferior la categor&iacute;a a la que desea acceder.</small>		
					</div>
				</div>		
			</center>';
	$ds->contenido($cont);
	$ds->mostrar();
?>