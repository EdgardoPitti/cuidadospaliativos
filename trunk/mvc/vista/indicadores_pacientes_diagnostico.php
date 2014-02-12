<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Pacientes por Diagn&oacute;stico</h3>
			<center>
				Gr&aacute;fica:
				Barra &nbsp;<input type="radio" id="filtro_diagnostico" name="filtro_diagnostico" value="0">&nbsp; 
				Pastel &nbsp;<input type="radio" id="filtro_diagnostico1" name="filtro_diagnostico" value="1">&nbsp; 
				Linea &nbsp;<input type="radio" id="filtro_diagnostico2" name="filtro_diagnostico" value="2">
			<div id="mostrargrafica"></div>
			</center>		
	';
	$ds->contenido($cont);
	$ds->mostrar();
?>