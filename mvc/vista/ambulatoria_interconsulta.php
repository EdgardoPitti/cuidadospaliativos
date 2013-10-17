<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$especialidad = new Accesatabla('especialidades_medicas');
	$cont='
		<center>
			<fieldset>
				<legend><h3 style="background:#f4f4f4;padding:10px;">Interconsulta</h3></legend>
					<form class="form-search" method="POST" action="./?url=">						
						<div class="input-group">
						  Buscar paciente: <input type="search" class="form-control" id="nom_ced" placeholder="Cédula o Nombre" name="nom_ced">
						  <span class="input-group-btn">
							<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
						  </span>
						</div>
					</form>
					<center style="width:100%;max-width:600px;">
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
							<tr width="50%">
								<td colspan="2">Observaciones/Comentarios</td>
							</tr>
							<tr width="50%">
								<td colspan="2"><textarea id="obs_coment" name="obs_coment" style="width:98%;height:70px;border-color:#ccc;"></textarea></td>
							</tr>
						</table>
					</center>
			</fieldset>
		</center>	
	
	';
	
	$ds->contenido($cont);
	$ds->mostrar();
?>