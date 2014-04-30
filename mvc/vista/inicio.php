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
	$horas = '8';
	$minutos = '00';
	$s = 'AM';
	$sw = 0;
	for($x=0;$x<20;$x++){
		if($horas < 10){
			$cero = '0';
		}else{
			$cero = '';
		}
		if($horas == 12 AND $minutos == 00){
			$s = 'MD';
		}else{
			if($horas == 12 AND $minutos == 30){
				$s = 'PM';
			}
		}
		$hora = ''.$cero.''.$horas.':'.$minutos.' '.$s.'';
		$_SESSION['hora_'.$x.''] = $hora;
		if($sw == 1){
			if($minutos == 30){
				$horas++;
			}
			$minutos = '00';
			$sw = 0;
		}else{
			$minutos = 30;
			$sw = 1;
		}
		if($horas > 12){
			$horas = 1;
			$s = 'PM';
		}
	}
	$ds->contenido($cont);
	$ds->mostrar();
?>