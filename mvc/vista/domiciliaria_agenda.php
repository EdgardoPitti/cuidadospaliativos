<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	$cont='
		<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Agenda de Citas M&eacute;dicas</h3>
		<div class="row-fluid">
			<div class="span2">
				<article>
					<center>
						<h2>'.$ds->dime('dia es').'</h2>
						<h1>'.$ds->dime('dia').'</h1>
						<h5>'.$ds->dime('mes-'.$ds->dime('mes').'').' '.$ds->dime('agno').'</h5>
					</center>
				</article>
				<center>
					<a href="#" class="btn" style="margin-top:10px" title="Notificar a Paciente">Notificar a Paciente</a>
				</center>
			</div>
			<div class="span10">
				<div class="overflow" id="overflow-movil">
					<table class="table borde-tabla">
						<tr>
							<td width="50px" style="background:#d9d9d9;font-weight:bold">08:00 AM</td>
							<td width="350px">ASDA</td>
							<td width="40px"><input type="checkbox" name=""></td>
							<td width="40px"><input type="checkbox" name=""></td>
							<td width="40px"><input type="checkbox" name=""></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>