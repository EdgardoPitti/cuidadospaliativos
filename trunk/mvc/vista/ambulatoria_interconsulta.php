<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$especialidad = new Accesatabla('especialidades_medicas');
	$cont='
		<center>
			<h3 style="background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;">Interconsulta</h3>	
			<form class="form-search" method="POST" action="./?url=">						
				<div class="input-group">
				  <input type="search" class="form-control" id="busqueda" placeholder="Buscar paciente" name="nom_ced">
				  <span class="input-group-btn">
					<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
				  </span>
				</div>
			</form>
			<div style="width:100%;max-width:600px;">
				<table width="100%">
					<tr align="center">
						<td>Especialista en: </td>
						<td>
							<select id="especialidad" name="especialidad">
								<option value="0"></option>';
				$x = $especialidad->buscardonde('ID_ESPECIALIDAD_MEDICA > 0');				
				while($x){
						$cont.='
								<option value="'.$especialidad->obtener('ID_ESPECIALIDAD_MEDICA').'">'.$especialidad->obtener('DESCRIPCION').'</option>';
						$x = $especialidad->releer();		
				}		
					$cont.='			
							</select>
						</td>
					</tr>
					<tr align="center">
						<td align="center">Nombre:</td>
						<td id="mostrarespecialista" name="mostrarespecialista">
							<select style="width:150px"></select>
						</td>
					</tr>
				</table>
				<div class="row-fluid">
					<div class="span6">
						Observaciones/Comentarios
					</div>
					<div class="span6">
						<textarea id="obs_coment" name="obs_coment" class="textarea2" style="width:90%;h eight:70px;"></textarea>
					</div>
				</div>
			</div>
		</center>	
	
	';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>