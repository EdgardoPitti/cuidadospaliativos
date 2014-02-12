<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$cont.='<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;">Total de Visitas Realizadas</h3>
			<center>
			';
	if($_POST['filtro_tipo'] == 1){
		$variable = $_POST['variable'];
	}else if($_POST['filtro_tipo'] == 0){
		$variable = $_POST['variable1'];
	}
	if(empty($variable)){
		$cont.='
						<form method="POST" action="./?url=indicadores_total_visitas">
							Filtrar por: 
							A&ntilde;o &nbsp;<input type="radio" id="filtro_tipo1" name="filtro_tipo" value="0">&nbsp; Mes &nbsp;<input type="radio" id="filtro_tipo" name="filtro_tipo" value="1"><br> 
							<div id="mostrar" style="display:none">
									A&ntilde;o: <input style="width:60px;" type="number" id="variable" name="variable" min="2000" max="2050" value="'.$ds->dime('agno').'"><br>
									<center>
										<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;">Enviar</button>
									</center>							
							</div>
							<div id="ocultar" style="display:none">
									A&ntilde;os Anteriores: <input style="width:40px;" type="number" id="variable1" name="variable1" min="1" max="5" value="1"><br>
									<center>
										<button type="submit" class="btn btn-primary" style="font-size:12px;margin-top:8px;">Enviar</button>
									</center>							
							</div>
						</form>
						';
	}else{
		$cont.='
			<center>
				Grafica :
				Barra &nbsp;<input type="radio" id="filtro_visitas" name="filtro_visitas" value="0">&nbsp; 
				Pastel &nbsp;<input type="radio" id="filtro_visitas1" name="filtro_visitas" value="1">&nbsp; 
				Linea &nbsp;<input type="radio" id="filtro_visitas2" name="filtro_visitas" value="2">
				<input style="display:none;" type="text" id="var" name="var" value="'.$variable.'">
			</center>
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