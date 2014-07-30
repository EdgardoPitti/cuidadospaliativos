<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');
	$paciente = new Accesatabla('datos_pacientes');
	$tiposanguineo = new Accesatabla('tipos_sanguineos');
	$corregimientos = new Accesatabla('corregimientos');
	$distritos = new Accesatabla('distritos');
	$provincias = new Accesatabla('provincias');
	$residencia = new Accesatabla('residencia_habitual');

	$busqueda = $_POST['buscar'];
	$idpaciente = $_GET['idp'];
	$sbm = $_GET['sbm'];
	$cont='

		<link rel="stylesheet" href="./css/jquery-ui.css">
		<link rel="stylesheet" href="./css/styles.css">
		<center>
			<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">ESAS</h3>
		
			<form class="form-search" method="POST" action="./?url=escala_edmont&sbm='.$sbm.'">
				<div class="input-group">
					<table>  		
		  				<tr>
		  					<td>Paciente:</td>
		  					<td><input type="search" class="form-control" placeholder="Nombre o C&eacute;dula" name="buscar" id="busqueda"></td>
		  					<td><button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button></td>
			  			</tr>
			  		</table>			  			
			  	</div>			    
			</form>
		</center>';
	if(!empty($busqueda)){

		$paciente->buscardonde('NO_CEDULA = "'.$busqueda.'"');
		$tiposanguineo->buscardonde('ID_TIPO_SANGUINEO = '.$paciente->obtener('ID_TIPO_SANGUINEO').'');
		$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$paciente->obtener('ID_RESIDENCIA_HABITUAL').'');
		$distritos->buscardonde('ID_DISTRITO = '.$residencia->obtener('ID_DISTRITO').'');
		$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$residencia->obtener('ID_CORREGIMIENTO').'');
		$provincias->buscardonde('ID_PROVINCIA = '.$residencia->obtener('ID_PROVINCIA').'');
		if($paciente->obtener('ID_SEXO') == 1){
			$sexo = 'MASCULINO';
		}else{
			$sexo = 'FEMENINO';
		}
		if($paciente->obtener('ID_TIPO_PACIENTE') == 1){
			$asegurado = 'ASEGURADO';
		}else{
			$asegurado = 'NO ASEGURADO';
		}

		list($agno, $mes, $dia) = explode("-", $paciente->obtener('FECHA_NACIMIENTO'));
		$cont.='
		<div class="row-fluid">
			<div class="span6">
				<fieldset>
					<legend>
						Paciente
					</legend>
						<table class="table2">											
							<tr>
								<td colspan="3"><h5>'.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('SEGUNDO_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').' '.$paciente->obtener('APELLIDO_MATERNO').'</h5></td>
							</tr>
							<tr>
								<td>'.$paciente->obtener('NO_CEDULA').'</td>
								<td>'.$tiposanguineo->obtener('TIPO_SANGRE').'</td>
								<td>'.$sexo.'</td>
							</tr>
							<tr>
								<td>'.$dia.'/'.$mes.'/'.$agno.'</td>
								<td>'.$asegurado.'</td>
								<td>'.$ds->edad($dia,$mes,$agno).' A&ntilde;os</td>
							</tr>
						</table>
				</fieldset>
			</div>
			<div class="span6">
				<fieldset>
					<legend>
						Direcci&oacute;n
					</legend>
						<table class="table2" style="height:86px;">
							<tr>
								<td>'.$distritos->obtener('DISTRITO').' , '.$provincias->obtener('PROVINCIA').'</td>
							</tr>
							<tr>
								<td>'.$corregimientos->obtener('CORREGIMIENTO').' , '.$residencia->obtener('DETALLE').'</td>
							</tr>
						</table>
				</fieldset>
			</div>	
		</div>	
		<form method="POST" action="./?url=agregar_escala_edmont&sbm='.$sbm.'&idp='.$paciente->obtener('ID_PACIENTE').'" >
			<center style="margin-top:5px;">
				<table>
					<tr>
		  				<td>Completado por:</td>
		  				<td colspan="2"> 
			  				<select name="completado" id="completado">
			  					<option value="0">SELECCIONAR</option>
			  					<option value="1">PACIENTE</option>
								<option value="2">FAMILIAR DEL PACIENTE</option>
								<option value="3">PROFESIONAL M&Eacute;DICO</option>
								<option value="4">ASISTIDO POR EL CUIDADOR</option>
			  				</select>
			  			</td>
			  		</tr>
		  			<tr>
		  				<td>Categor&iacute;a:</td>
		  				<td colspan="2"> 
			  				<select name="categoria" id="categoria">
			  					<option value="0">SELECCIONAR</option>
			  					<option value="1">DOMICILIARIA</option>
								<option value="2">AMBULATORIA</option>
								<option value="3">HOSPITALARIA</option>
			  				</select>
			  			</td>
			  		</tr>
			  	</table>
		  	</center>';
	}
	$cont.='
			<center>
				<!-- Buscar Paciente que completa -->
				<div class="row" id="patient" style="display:none">
					<div class="span6 offset3 input-group" style="margin-bottom:10px;">
						<strong>Buscar Paciente:</strong> <input type="search" name="paciente" id="paciente"><input type="hidden" id="cedpaciente" name="cedpaciente" placeholder="C&eacute;dula Paciente">
					</div>					
				</div>	
				<!-- Agregar datos del familiar que completa -->	
				<div class="row-fluid" id="familiar" style="display:none;margin-bottom:10px">
					<div class="price-box">
						<div class="form-pricing">
							<h3 style="text-align:center">Datos del Familiar</h3><hr>
							<div class="row">
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">C&eacute;dula:</td>														
											</tr>
											<tr>
												<td><input type="text" id="cedfamiliar" name="cedfamiliar" placeholder="C&eacute;dula"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Primer Nombre:</td>
											</tr>									
											<tr>
												<td><input type="text" id="primernombrefamiliar" name="primernombrefamiliar" placeholder="Primer Nombre"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Segundo Nombre:</td>														
											</tr>
											<tr>
												<td><input type="text" id="segundonombrefamiliar" name="segundonombrefamiliar" placeholder="Segundo Nombre"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Apellido Paterno:</td>
											</tr>									
											<tr>
												<td><input type="text" id="apellidopaternofamiliar" name="apellidopaternofamiliar" placeholder="Apellido Paterno"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Apellido Materno:</td>														
											</tr>
											<tr>
												<td><input type="text" id="apellidomaternofamiliar" name="apellidomaternofamiliar" placeholder="Apellido Materno"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Sexo:</td>														
											</tr>
											<tr>
												<td>
													<select  id="sexoflia" name="sexoflia">
														<option value="0">SELECCIONAR</option>
														<option value="1">MASCULINO</option>
														<option value="2">FEMENINO</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>								
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Direcci&oacute;n:</td>														
											</tr>
											<tr>
												<td><input type="text" id="direccionfamiliar" name="direccionfamiliar" placeholder="Direcci&oacute;n"></td>
											</tr>
										</tbody>
									</table>																
								</div>
								<div class="span6">
									<table class="table">
										<tbody>

											<tr>
												<td style="text-align:left;padding-left:17%;">Tel&eacute;fono:</td>
											</tr>									
											<tr>
												<td><input type="text" id="telefonofamiliar" name="telefonofamiliar" placeholder="Tel&eacute;fono"></td>
											</tr>
										</tbody>
									</table>										
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Celular:</td>														
											</tr>
											<tr>
												<td><input type="text" id="celularfamiliar" name="celularfamiliar" placeholder="Celular"></td>
											</tr>
										</tbody>
									</table>																	
								</div>
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Parentesco:</td>														
											</tr>
											<tr>
												<td><input type="text" id="parentesco" name="parentesco" placeholder="Parentesco"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Buscar medico que completa -->
				<div class="row" id="professional" style="display:none;">
					<div class="span6 offset3 input-group" style="margin-bottom:10px;">
						<strong>Buscar Profesional:</strong> <input type="search" name="profesional" id="profesional"><input type="hidden" id="cedprofesional" name="cedprofesional" placeholder="C&eacute;dula Profesional">
					</div>
				</div>
				<!-- Agregar Del cuidador que completa -->
				<div class="row-fluid" id="asistido" style="display:none;margin-bottom:10px;">
					<div class="price-box">
						<div class="form-pricing">
							<h3 style="text-align:center">Datos del Cuidador</h3><hr>	
							<div class="row">
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">C&eacute;dula:</td>														
											</tr>
											<tr>
												<td><input type="text" id="cedula" name="cedula" placeholder="C&eacute;dula"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Primer Nombre:</td>
											</tr>									
											<tr>
												<td><input type="text" id="primernombre" name="primernombre" placeholder="Primer Nombre"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Segundo Nombre:</td>														
											</tr>
											<tr>
												<td><input type="text" id="segundonombre" name="segundonombre" placeholder="Segundo Nombre"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Apellido Paterno:</td>
											</tr>									
											<tr>
												<td><input type="text" id="apellidopaterno" name="apellidopaterno" placeholder="Apellido Paterno"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Apellido Materno:</td>														
											</tr>
											<tr>
												<td><input type="text" id="apellidomaterno" name="apellidomaterno" placeholder="Apellido Materno"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Sexo:</td>														
											</tr>
											<tr>
												<td>
													<select  id="sexo" name="sexo">
														<option value="0">SELECCIONAR</option>
														<option value="1">MASCULINO</option>
														<option value="2">FEMENINO</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>								
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Direcci&oacute;n:</td>														
											</tr>
											<tr>
												<td><input type="text" id="direccion" name="direccion" placeholder="Direcci&oacute;n"></td>
											</tr>
										</tbody>
									</table>								
								</div>
								<div class="span6">									
									<table class="table">
										<tbody>

											<tr>
												<td style="text-align:left;padding-left:17%;">Tel&eacute;fono:</td>
											</tr>									
											<tr>
												<td><input type="text" id="telefono" name="telefono" placeholder="Tel&eacute;fono"></td>
											</tr>
										</tbody>
									</table>																		
								</div>
							</div>
							<div class="row">
								<div class="span6">
									<table class="table">
										<tbody>
											<tr>
												<td style="text-align:left;padding-left:17%;">Celular:</td>														
											</tr>
											<tr>
												<td><input type="text" id="celular" name="celular" placeholder="Celular"></td>
											</tr>
										</tbody>
									</table>	
								</div>
								<div class="span6">
								</div>
							</div>
						</div>
					</div>
				</div>
			</center>
			<div class="price-box">
				<div class="form-pricing">
				  <!-- Slider DOLOR  -->
		          <div class="price-slider">
		            <h4 class="great">DOLOR</h4>
		            <div class="span12">
						<div id="slider" style="width:90%;"></div>
					 	<div style="width:90%">
						 	<span size="8" style="float:left;">Sin Dolor</span>
						  	<span size="8" style="float:right;">M&aacute;ximo Dolor</span>
						</div>
		              
		            </div>
		          </div>
				  <!-- Intensidad en números-->
		            <div class="form-group span12" style="text-align:center">
		              <label for="dolor" class="control-label">Intensidad de Dolor: </label>
					  
					 <!-- muestra valor de intensidad -->
		              <div>
						<input type="hidden" name="dolor" id="dolor">
		                <p class="price lead" id="dolor-label" align="center"></p> 
		              </div>
		            </div>
				  <!-- FIN Slider DOLOR  -->
				  
				  
				  <!-- Slider CANSANCIO  -->
				    <div class="price-slider">
						<h4 class="great">CANSANCIO</h4>
						<div class="span12">
							<div id="slider2" style="width:90%;"></div>
					 		<div style="width:90%">
								<span size="8" style="float:left;">Sin Cansancio</span>
								<span size="8" style="float:right;">M&aacute;ximo Cansancio</span>
							</div>
						</div>
					</div>
						  <!-- Intensidad en números-->
		            <div class="form-group span12" style="text-align:center">
		              <label for="Cansancio" class="control-label">Intensidad de Cansancio: </label>
					  
					 <!-- muestra valor de intensidad de cansancio -->
		              <div>
		                <input type="hidden" name="cansancio" id="cansancio">
		                <p class="price lead" id="cansancio-label"></p> 
		              </div>
		            </div>
					<!-- FIN Slider Cansancio  -->
					
					<!-- Slider NÁUSEAS	-->
				    <div class="price-slider">
						<h4 class="great">N&Aacute;USEA</h4>
						<div class="span12">
							<div id="slider3" style="width:90%;"></div>
					 		<div style="width:90%">
								<span size="8" style="float:left;">Sin N&aacute;usea</span>
								<span size="8" style="float:right;">M&aacute;ximo N&aacute;usea</span>
							</div>
						</div>
					</div>
						  <!-- Intensidad en números-->
		            <div class="form-group span12" style="text-align:center">
		              <label for="nausea" class="control-label">Intensidad de  la N&aacute;usea: </label>
					  
					 <!-- muestra valor de intensidad de nausea -->
		              <div>
		                 <input type="hidden" id="nausea" name="nausea">
		                <p class="price lead" id="nausea-label"></p> 
		              </div>
		            </div>
					<!-- FIN Slider nausea-->
					
					<!-- Slider DEPRESIÓN-->
				    <div class="price-slider">
						<h4 class="great">DEPRESI&Oacute;N</h4>
						<div class="span12">
							<div id="slider4" style="width:90%;"></div>
					 		<div style="width:90%">
								<span size="8" style="float:left;">Sin Depresi&oacute;n</span>
								<span size="8" style="float:right;">M&aacute;ximo Depresi&oacute;n</span>
							</div>
						</div>
					</div>
						  <!-- Intensidad en números-->
		            <div class="form-group span12" style="text-align:center">
		              <label for="depresion" class="control-label">Intensidad de Depresi&oacute;n: </label>
					  
					 <!-- muestra valor de intensidad de nausea -->
		              <div>
		                 <input type="hidden" id="depresion" name="depresion">
		                <p class="price lead" id="depresion-label"></p> 
		              </div>
		            </div>
					<!-- FIN Slider DEPRESIÓN-->
					
					
					<!-- Slider ANSIEDAD-->
				    <div class="price-slider">
						<h4 class="great">ANSIEDAD</h4>
						<div class="span12">
							<div id="slider5" style="width:90%;"></div>
					 		<div style="width:90%">
								<span size="8" style="float:left;">Sin Ansiedad</span>
								<span size="8" style="float:right;">M&aacute;xima Ansiedad</span>
							</div>
						</div>
					</div>
						  <!-- Intensidad en números-->
		            <div class="form-group span12" style="text-align:center">
		              <label for="ansiedad" class="control-label">Intensidad de ansiedad: </label>
					  
					 <!-- muestra valor de intensidad de ansiedad -->
		              <div>
		                 <input type="hidden" id="ansiedad" name="ansiedad">
		                <p class="price lead" id="ansiedad-label"></p> 
		              </div>
		            </div>
					<!-- FIN Slider ANSIEDAD-->
					
					
					<!-- Slider somnolencia-->
				    <div class="price-slider">
						<h4 class="great">SOMNOLENCIA</h4>
						<div class="span12">
							<div id="slider6" style="width:90%;"></div>
					 		<div style="width:90%">
								<span size="8" style="float:left;">Sin Somnolencia</span>
								<span size="8" style="float:right;">M&aacute;ximo Somnolencia</span>
							</div>
						</div>
					</div>
						  <!-- Intensidad en números-->
		            <div class="form-group span12" style="text-align:center">
		              <label for="somnolencia" class="control-label">Intensidad de somnolencia: </label>
					  
					 <!-- muestra valor de intensidad de ansiedad -->
		              <div>
		                 <input type="hidden" id="somnolencia" name="somnolencia">
		                <p class="price lead" id="somnolencia-label"></p> 
		              </div>
		            </div>
					<!-- FIN Slider SOMNOLENCIA-->
					
					
						<!-- Slider Apetito-->
				    <div class="price-slider">
						<h4 class="great">APETITO</h4>
						<div class="span12">
							<div id="slider7" style="width:90%;"></div>
					 		<div style="width:90%">
								<span size="8" style="float:left;">Sin Apetito</span>
								<span size="8" style="float:right;">Buen Apetito</span>
							</div>
						</div>
					</div>
						  <!-- Intensidad en números-->
		            <div class="form-group span12" style="text-align:center">
		              <label for="apetito" class="control-label">Intensidad de apetito: </label>
					  
					 <!-- muestra valor de intensidad de apetito -->
		              <div>
		                 <input type="hidden" id="apetito" name="apetito">
		                <p class="price lead" id="apetito-label"></p> 
		              </div>
		            </div>
					<!-- FIN Slider APETITO-->
					
					
				  <!-- Slider BIENESTAR-->
				    <div class="price-slider">
						<h4 class="great">BIENESTAR	</h4>
						<div class="span12">
							<div id="slider8" style="width:90%;"></div>
					 		<div style="width:90%">
								<span size="8" style="float:left;">M&aacute;ximo Bienestar	</span>
								<span size="8" style="float:right;">M&aacute;ximo Malestar</span>
							</div>
						</div>
					</div>
						  <!-- Intensidad en números-->
		            <div class="form-group span12" style="text-align:center">
		              <label for="bienestar" class="control-label">Intensidad de Bienestar: </label>
					  
					 <!-- muestra valor de intensidad de apetito -->
		              <div>
		                 <input type="hidden" id="bienestar" name="bienestar">
		                <p class="price lead" id="bienestar-label"></p> 
		              </div>
		            </div>
					<!-- FIN Slider bienestar-->
					
					
					  <!-- Slider aire-->
				    <div class="price-slider">
						<h4 class="great">AIRE	</h4>
						<div class="span12">
							<div id="slider9" style="width:90%;"></div>
					 		<div style="width:90%">
								<span size="8" style="float:left;">Sin Falta de Aire</span>
								<span size="8" style="float:right;">M&aacute;xima Falta de Aire</span>
							</div>
						</div>
					</div>
						  <!-- Intensidad en números-->
		            <div class="form-group span12" style="text-align:center">
		              <label for="aire" class="control-label">Intensidad de Aire: </label>
					  
					 <!-- muestra valor de intensidad de apetito -->
		              <div>
		                 <input type="hidden" id="aire" name="aire">
		                <p class="price lead" id="aire-label"></p> 
		              </div>
		            </div>
					<!-- FIN Slider aire-->
					
					  <!-- Slider dormir-->
				    <div class="price-slider">
						<h4 class="great">DORMIR	</h4>
						<div class="span12">
							<div id="slider10" style="width:90%;"></div>
					 		<div style="width:90%">
								<span size="8" style="float:left;">Facilidad para Dormir</span>
								<span size="8" style="float:right;">M&aacute;ximo Dificultad para Dormir</span>
							</div>
						</div>
					</div>
						  <!-- Intensidad en números-->
		            <div class="form-group span12" style="text-align:center">
		              <label for="dormir" class="control-label">Intensidad de Dormir: </label>
					  
					 <!-- muestra valor de intensidad de dormir -->
		              <div>
		                 <input type="hidden" id="dormir" name="dormir">
		                <p class="price lead" id="dormir-label"></p> 
		              </div>
		            </div>
					<!-- FIN Slider aire-->
					
					
					<button type="submit" class="btn btn-primary btn-block">Guardar</button>			
		    	</div>
		    </div>
        </form>
	   	 
	    <script src="./js/bootstrap.min.js"></script>
		<script src="./js/jquery-ui.min.js"></script>
		<script src="./js/slider.js"></script>		
	';

	$ds->contenido($cont);
	$ds->mostrar();
?>