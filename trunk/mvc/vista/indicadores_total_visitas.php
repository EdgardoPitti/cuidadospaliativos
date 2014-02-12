<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Total de Visitas Realizadas</h3>
			<center>';
	$variable = $_POST['variable1'];
	if(empty($variable)){
		$variable = 2014;
	}
	$cont.='
					<form method="POST" action="./?url=indicadores_total_visitas">
							Desde el A&ntilde;o: <input style="width:60px;" type="number" id="variable1" name="variable1" min="2013" max="'.$ds->dime('agno').'" value="2013"><br>
							<center>
								<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;">Enviar</button>
							</center>							
					</form>
					';
	}
	$cont.='
					<div id="mostrargrafica">
					</div>
				</center>
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>