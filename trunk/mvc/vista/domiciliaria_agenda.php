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
			</div>
			<div class="span10"></div>
		</div>
	';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>