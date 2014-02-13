<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	$cont='
		<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Agenda de Citas M&eacute;dicas</h3>
		<div class="row-fluid" style="width: 100%; height: 600px; overflow-y: scroll;">
			<div class="span2">
				<article class="agenda">
					<center>
						<h2>'.$ds->dime('dia es').'</h2>
						<h1>'.$ds->dime('dia').'</h1>
						<h5>'.$ds->dime('mes-'.$ds->dime('mes').'').' '.$ds->dime('agno').'</h5>
					</center>
				</article>
				<center>
					<a href="#" class="btn" style="margin-top:10px" title="Notificar a Paciente">Notificar a Paciente</a>
				</center>	';
				$next = explode("-",$ds->diasig($ds->dime('dia'), $ds->dime('mes'),$ds->dime('agno')));	
				$cont.='
				<article class="agenda">
					<center>
						<h2>'.$ds->diasdespues('1').'</h2>
						<h1>'.$next[2].'</h1>
						<h5>'.$ds->dime('mes-'.(int)$next[1].'').' '.$next[0].'</h5>
					</center>
				</article>
				<center>
					<a href="#" class="btn" style="margin-top:10px" title="Notificar a Paciente">Notificar a Paciente</a>
				</center>';
				$next = explode("-",$ds->diasig($next[2], $next[1],$next[0]));	
				$cont.='
				<article class="agenda">
					<center>
						<h2>'.$ds->diasdespues('2').'</h2>
						<h1>'.$next[2].'</h1>
						<h5>'.$ds->dime('mes-'.(int)$next[1].'').' '.$next[0].'</h5>
					</center>
				</article>
				<center>
					<a href="#" class="btn" style="margin-top:10px" title="Notificar a Paciente">Notificar a Paciente</a>
				</center>';
				$next = explode("-",$ds->diasig($next[2], $next[1],$next[0]));	
				$cont.='
				<article class="agenda">
					<center>
						<h2>'.$ds->diasdespues('3').'</h2>
						<h1>'.$next[2].'</h1>
						<h5>'.$ds->dime('mes-'.(int)$next[1].'').' '.$next[0].'</h5>
					</center>
				</article>
				<center>
					<a href="#" class="btn" style="margin-top:10px" title="Notificar a Paciente">Notificar a Paciente</a>
				</center>';
				$next = explode("-",$ds->diasig($next[2], $next[1],$next[0]));	
				$cont.='
				<article class="agenda">
					<center>
						<h2>'.$ds->diasdespues('4').'</h2>
						<h1>'.$next[2].'</h1>
						<h5>'.$ds->dime('mes-'.(int)$next[1].'').' '.$next[0].'</h5>
					</center>
				</article>
				<center>
					<a href="#" class="btn" style="margin-top:10px" title="Notificar a Paciente">Notificar a Paciente</a>
				</center>';
				$next = explode("-",$ds->diasig($next[2], $next[1],$next[0]));	
				$cont.='
				<article class="agenda">
					<center>
						<h2>'.$ds->diasdespues('5').'</h2>
						<h1>'.$next[2].'</h1>
						<h5>'.$ds->dime('mes-'.(int)$next[1].'').' '.$next[0].'</h5>
					</center>
				</article>
				<center>
					<a href="#" class="btn" style="margin-top:10px" title="Notificar a Paciente">Notificar a Paciente</a>
				</center>
			</div>
			<div class="span10" style="margin-top:10px;">
				<div class="overflow" id="overflow-movil">
					<table class="table borde-tabla">';
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
		$cont.='		
						<tr>
							<td width="70px" style="background:#d9d9d9;font-weight:bold;padding-top:15px">'.$cero.''.$horas.':'.$minutos.' '.$s.'</td>
							<td style="width:350px;text-align:left;padding-top:10px;text-align:center;"><input type="text" style="width:120px" name="paciente"></td>
							<td width="40px" style="padding-top:15px"><input type="checkbox" name=""></td>
							<td width="40px" style="padding-top:15px"><input type="checkbox" name=""></td>
							<td width="40px" style="padding-top:15px"><input type="checkbox" name=""></td>
						</tr>';
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
	$cont.='
					</table>
				</div>
			</div>
		</div>
	';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>