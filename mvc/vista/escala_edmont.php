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
	$escala = new Accesatabla('escala_edmonton');

	$busqueda = $_POST['buscar'];
	$idpaciente = $_GET['idp'];
	$idsoap = $_GET['idsoap'];
	$sbm = $_GET['sbm'];
	$sw = $_GET['sw'];
	/*variables para la segunda pestaña*/
	$tab2 = $_GET['tab2'];
	$search = $_POST['search'];
	
	if(empty($busqueda)){
		$style='style="height:230px;"';	
		$div = '</div>';
	}else{
		$style= '';
		$div = '';	
	}
	if($tab2 == true) {
		$active = 'active';
		$noactive = '';	
	}else {
		$active = '';
		$noactive = 'active';		
	}
	if(!empty($sw)){
		$cont.='
		<div class="row-fluid">
			<a href="./?url=soap&id='.$idpaciente.'&idsoap='.$idsoap.'&t='.$_GET['t'].'" class="btn btn-primary pull-left" style="float:left;position:relative;top:-5px;left:10px;" title="Regresar"><i class="icon-arrow-left icon-white"></i></a>
		</div>';
		$search = 1;
	}
	$cont.='
		<center>
			<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">ESAS-R</h3>
		</center>
		<div class="tabbable" id="tabs-2">
			<ul class="nav nav-tabs">
				<li class="'.$noactive.'"><a href="#tab1" data-toggle="tab">Datos ESAS-R</a></li>
				<li class="'.$active.'"><a href="#tab2" data-toggle="tab">Gr&aacute;fica ESAS-R</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane '.$noactive.'" id="tab1">';
			if(empty($sw)){
				$cont.='	
					<center '.$style.'>
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
					</center>
				'.$div.'';
			
				$condicion = 'NO_CEDULA = "'.$busqueda.'"';
				$sbmenu = '&sbm='.$sbm.'';
				$switch = '';
				$ids = '';			
			}else {		
				$condicion = 'ID_PACIENTE = '.$idpaciente.'';
				$switch = '&sw=1';
				$sbmenu = '';
				$ids = '&idsoap='.$idsoap;
			}	
	if(!empty($busqueda) OR !empty($sw)){

		$paciente->buscardonde($condicion);
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
				<link rel="stylesheet" href="./css/jquery-ui.css">
				<link rel="stylesheet" href="./css/styles.css">
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
				<form method="POST" action="./?url=agregar_escala_edmont'.$sbmenu.'&idp='.$paciente->obtener('ID_PACIENTE').''.$switch.''.$ids.'&t='.$_GET['t'].'" >
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
					  		</tr>';
			if($_GET['t'] == 1){
				$d = 'selected';
			}
			if($_GET['t'] == 2){
				$a = 'selected';
			}
			if($_GET['t'] == 3){
				$h = 'selected';
			}

					  	$cont.='
				  			<tr>
				  				<td>Categor&iacute;a:</td>
				  				<td colspan="2"> 
					  				<select name="categoria" id="categoria">
					  					<option value="0">SELECCIONAR</option>
					  					<option value="1" '.$d.'>DOMICILIARIA</option>
										<option value="2" '.$a.'>AMBULATORIA</option>
										<option value="3" '.$h.'>HOSPITALARIA</option>
					  				</select>
					  			</td>
					  		</tr>
					  	</table>
				  	</center>
					<div class="price-box">
						<div class="form-pricing">
						  <!-- Slider DOLOR  -->
						  <div class="price-slider">
						    <h4 class="great">DOLOR</h4>
		
						    <div class="span12">
									<div id="slider" style="width:95%;"></div>
								 	<div style="width:95%;margin-top:10px">
									 	<span size="8" class="left" style="float:left;">Sin Dolor</span>
									  	<span size="8" class="right" style="float:right;">M&aacute;ximo Dolor</span>
		
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
										<div id="slider2" style="width:95%;"></div>
								 		<div style="width:95%;margin-top:10px">
											<span size="8" class="left" style="float:left;">Sin Cansancio</span>
											<span size="8" class="right" style="float:right;">M&aacute;ximo Cansancio</span>
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
										<div id="slider3" style="width:95%;"></div>
								 		<div style="width:95%;margin-top:10px">
											<span size="8" class="left" style="float:left;">Sin N&aacute;usea</span>
											<span size="8" class="right" style="float:right;">M&aacute;ximo N&aacute;usea</span>
										</div>
									</div>
								</div>
									  <!-- Intensidad en números-->
						    <div class="form-group span12" style="text-align:center">
						      <label for="nausea" class="control-label">Intensidad de N&aacute;usea: </label>
								  
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
										<div id="slider4" style="width:95%;"></div>
								 		<div style="width:95%;margin-top:10px">
											<span size="8" class="left" style="float:left;">Sin Depresi&oacute;n</span>
											<span size="8" class="right" style="float:right;">M&aacute;ximo Depresi&oacute;n</span>
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
										<div id="slider5" style="width:95%;"></div>
								 		<div style="width:95%;margin-top:10px">
											<span size="8" class="left" style="float:left;">Sin Ansiedad</span>
											<span size="8" class="right" style="float:right;">M&aacute;xima Ansiedad</span>
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
										<div id="slider6" style="width:95%;"></div>
								 		<div style="width:95%;margin-top:10px">
											<span size="8" class="left" style="float:left;">Sin Somnolencia</span>
											<span size="8" class="right" style="float:right;">M&aacute;ximo Somnolencia</span>
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
										<div id="slider7" style="width:95%;"></div>
								 		<div style="width:95%;margin-top:10px">
											<span size="8" class="left" style="float:left;">M&aacute;ximo Apetito</span>
											<span size="8" class="right" style="float:right;">Sin Apetito</span>
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
										<div id="slider8" style="width:95%;"></div>
								 		<div style="width:95%;margin-top:10px">
											<span size="8" class="left" style="float:left;">M&aacute;ximo Bienestar	</span>
											<span size="8" class="right" style="float:right;">M&aacute;ximo Malestar</span>
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
										<div id="slider9" style="width:95%;"></div>
								 		<div style="width:95%;margin-top:10px">
											<span size="8" class="left" style="float:left;">Sin Falta de Aire</span>
											<span size="8" class="right" style="float:right;">M&aacute;xima Falta de Aire</span>
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
										<div id="slider10" style="width:95%;"></div>
								 		<div style="width:95%;margin-top:10px">
											<span size="8" class="left" style="float:left;">Facilidad para Dormir</span>
											<span size="8" class="right" style="float:right;">M&aacute;ximo Dificultad para Dormir</span>
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
	   	 
			<script src="./js/jquery-ui.min.js"></script>
			<script src="./js/slider.js"></script>
		</div>';		
	}	
	$comillas = "'";
	$grafica = $_GET['grafica'];
	$cont.='
		<div class="tab-pane '.$active.'" id="tab2">	';
		if(empty($sw)){
			$cont.='
			<center>
				<form class="form-search" method="POST" action="./?url=escala_edmont&sbm='.$sbm.'&tab2=true">
					<div class="input-group">
						<table>  		
					  		<tr>
					  			<td>Paciente:</td>
					  			<td><input type="search" class="form-control" placeholder="Nombre o C&eacute;dula" name="search" id="paciente"><input type="hidden" name="cedpaciente" id="cedpaciente"></td>				
								<td><button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button></td>
				  			</tr>
				  		</table>			  			
				  	</div>			    
				</form>
			</center>';
		}else{
			$grafica = true;
			$switch ='&sw=1';; 
		}
		if($grafica == false) {
			$cedula = $_POST['cedpaciente'];
			$condicion = 'NO_CEDULA = "'.$cedula.'"';
		}else {
			$idp = $_GET['idp'];			
			$condicion = 'ID_PACIENTE = '.$idp.'';
		}	
		if(!empty($search) OR $grafica == true){
			$paciente->buscardonde($condicion);
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
			</div><hr>
			<center>
				<form class="form-search" method="POST" action="./?url=escala_edmont&sbm='.$sbm.'&tab2=true&grafica=true&idp='.$paciente->obtener('ID_PACIENTE').''.$switch.'">
					Graficar desde <input type="date" name="fechainicial" id="fechainicial" placeholder="AAAA-MM-DD"> Hasta <input type="date" name="fechafinal" id="fechafinal" placeholder="AAAA-MM-DD">
					<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>				
				</form>			
			</center>';
		$inicio = $_POST['fechainicial'];
		$final = $_POST['fechafinal'];
		if(!empty($inicio) and !empty($final)) {			
			$x = $escala->buscardonde('ID_PACIENTE = '.$idp.' AND FECHA BETWEEN "'.$inicio.'" AND "'.$final.'" ORDER BY FECHA');
			if($x == 0){
				$script = '
					<center style="color:red;"><h3>No existen datos dentro de '.$inicio.' y '.$final.' para el paciente '.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').'</h3></center>';			
			}else{
				$n = 1;	
				
				while($x) {
					$fecha = explode("-",$escala->obtener('FECHA'));					
					if($n == 1) {														
						$categoria = $comillas.''.$fecha[2].' '.$ds->dime('mes-'.$fecha[1]).''.$comillas;
						$categoriatabla = $fecha[2].' '.$ds->dime('mes-'.$fecha[1]);
						$dolor = $escala->obtener('DOLOR');
						$dolortabla = $dolor;
						if($dolortabla >= 7) {
							$fondodolor = ' style="background:#c00"';
							$dolortabla = '<strong style="color:#fff;">'.$dolortabla.'</strong>';						
						}else {
							$fondodolor = '';						
						}
						$cansancio = $escala->obtener('CANSANCIO');
						$cansanciotabla = $cansancio;
						if($cansanciotabla >= 7) {
							$fondocans = ' style="background:#c00"';
							$cansanciotabla = '<strong style="color:#fff;">'.$cansanciotabla.'</strong>';						
						}else {
							$fondocans = '';						
						}
						$nausea = $escala->obtener('NAUSEA');
						$nauseatabla = $nausea;
						if($nauseatabla >= 7) {
							$fondonausea = ' style="background:#c00"';
							$nauseatabla = '<strong style="color:#fff;">'.$nauseatabla.'</strong>';						
						}else {
							$fondonausea = '';						
						}
						$depresion = $escala->obtener('DEPRESION');
						$depresiontabla = $depresion;
						if($depresiontabla >= 7) {
							$fondodepresion = ' style="background:#c00"';
							$depresiontabla = '<strong style="color:#fff;">'.$depresiontabla.'</strong>';						
						}else {
							$fondodepresion = '';						
						}
						$ansiedad = $escala->obtener('ANSIEDAD');
						$ansiedadtabla = $ansiedad;
						if($ansiedadtabla >= 7) {
							$fondoans = ' style="background:#c00"';
							$ansiedadtabla = '<strong style="color:#fff;">'.$ansiedadtabla.'</strong>';						
						}else {
							$fondoans = '';						
						}
						$somnolencia = $escala->obtener('SOMNOLENCIA');
						$somnolenciatabla = $somnolencia;
						if($somnolenciatabla >= 7) {
							$fondosom = ' style="background:#c00"';
							$somnolenciatabla = '<strong style="color:#fff;">'.$somnolenciatabla.'</strong>';						
						}else {
							$fondosom = '';						
						}
						$apetito = $escala->obtener('APETITO');
						$apetitotabla = $apetito;
						if($apetitotabla >= 7) {
							$fondoapet = ' style="background:#c00"';
							$apetitotabla = '<strong style="color:#fff;">'.$apetitotabla.'</strong>';						
						}else {
							$fondoapet = '';						
						}
						$bienestar = $escala->obtener('BIENESTAR');
						$bienestartabla = $bienestar;
						if($bienestartabla >= 7) {
							$fondobien = ' style="background:#c00"';
							$bienestartabla = '<strong style="color:#fff;">'.$bienestartabla.'</strong>';						
						}else {
							$fondobien = '';						
						}
						$aire = $escala->obtener('AIRE');
						$airetabla = $aire;
						if($airetabla >= 7) {
							$fondoaire = ' style="background:#c00"';
							$airetabla = '<strong style="color:#fff;">'.$airetabla.'</strong>';						
						}else {
							$fondoaire = '';						
						}
						$dormir = $escala->obtener('DORMIR');
						$dormirtabla = $dormir;
						if($dormirtabla >= 7) {
							$fondodormir = ' style="background:#c00"';
							$dormirtabla = '<strong style="color:#fff;">'.$dormirtabla.'</strong>';						
						}else {
							$fondodormir = '';						
						}
						$tabla = '
							<tr>
								<td><strong>'.$categoriatabla.'</strong></td>
								<td'.$fondodolor.'>'.$dolortabla.'</td>
								<td'.$fondocans.'>'.$cansanciotabla.'</td>
								<td'.$fondonausea.'>'.$nauseatabla.'</td>
								<td'.$fondodepresion.'>'.$depresiontabla.'</td>
								<td'.$fondoans.'>'.$ansiedadtabla.'</td>
								<td'.$fondosom.'>'.$somnolenciatabla.'</td>
								<td'.$fondoapet.'>'.$apetitotabla.'</td>
								<td'.$fondobien.'>'.$bienestartabla.'</td>
								<td'.$fondoaire.'>'.$airetabla.'</td>
								<td'.$fondodormir.'>'.$dormirtabla.'</td>							
							</tr>						
						';
						$n = 0;
					}else{						
						$categoria.= ', '.$comillas.''.$fecha[2].' '.$ds->dime('mes-'.$fecha[1]).''.$comillas;
						$categoriatabla = $fecha[2].' '.$ds->dime('mes-'.$fecha[1]);
						$dolor.= ', '.$escala->obtener('DOLOR');
						$dolortabla = $escala->obtener('DOLOR');
						if($dolortabla >= 7) {
							$fondodolor = ' style="background:#c00"';
							$dolortabla = '<strong style="color:#fff;">'.$dolortabla.'</strong>';						
						}else {
							$fondodolor = '';						
						}
						$cansancio.= ', '.$escala->obtener('CANSANCIO');
						$cansanciotabla = $escala->obtener('CANSANCIO');
						if($cansanciotabla >= 7) {
							$fondocans = ' style="background:#c00"';
							$cansanciotabla = '<strong style="color:#fff;">'.$cansanciotabla.'</strong>';	
						}else{
							$fondocans = '';						
						}
						$nausea.= ', '.$escala->obtener('NAUSEA');
						$nauseatabla = $escala->obtener('NAUSEA');
						if($nauseatabla >= 7) {
							$fondonausea = ' style="background:#c00"';
							$nauseatabla = '<strong style="color:#fff;">'.$nauseatabla.'</strong>';	
						}else {
							$fondonausea = '';						
						}
						$depresion.= ', '.$escala->obtener('DEPRESION');
						$depresiontabla = $escala->obtener('DEPRESION');
						if($depresiontabla >= 7) {
							$fondodepresion = ' style="background:#c00"';
							$depresiontabla = '<strong style="color:#fff;">'.$depresiontabla.'</strong>';	
						}else{
							$fondodepresion = '';
						}
						$ansiedad.= ', '.$escala->obtener('ANSIEDAD');
						$ansiedadtabla = $escala->obtener('ANSIEDAD');
						if($ansiedadtabla >= 7) {
							$fondoans = ' style="background:#c00"';
							$ansiedadtabla = '<strong style="color:#fff;">'.$ansiedadtabla.'</strong>';	
						}else {
							$fondoans = '';						
						}
						$somnolencia.= ', '.$escala->obtener('SOMNOLENCIA');
						$somnolenciatabla = $escala->obtener('SOMNOLENCIA');
						if($somnolenciatabla >= 7) {
							$fondosom = ' style="background:#c00"';
							$somnolenciatabla = '<strong style="color:#fff;">'.$somnolenciatabla.'</strong>';	
						}else {
							$fondosom = '';						
						}
						$apetito.= ', '.$escala->obtener('APETITO');
						$apetitotabla = $escala->obtener('APETITO');
						if($apetitotabla >= 7) {
							$fondoapet = ' style="background:#c00"';
							$apetitotabla = '<strong style="color:#fff;">'.$apetitotabla.'</strong>';	
						}else{
							$fondoapet = '';						
						}
						$bienestar.= ', '.$escala->obtener('BIENESTAR');
						$bienestartabla = $escala->obtener('BIENESTAR');
						if($bienestartabla >= 7) {
							$fondobien = ' style="background:#c00"';
							$bienestartabla = '<strong style="color:#fff;">'.$bienestartabla.'</strong>';	
						}else {
							$fondobien = '';						
						}
						$aire.= ', '.$escala->obtener('AIRE');
						$airetabla = $escala->obtener('AIRE');
						if($airetabla >= 7) {
							$fondoaire = ' style="background:#c00"';
							$airetabla = '<strong style="color:#fff;">'.$airetabla.'</strong>';	
						}else {
							$fondoaire = '';						
						}
						$dormir.= ', '.$escala->obtener('DORMIR');
						$dormirtabla = $escala->obtener('DORMIR');
						if($dormirtabla >= 7) {
							$fondodormir = ' style="background:#c00"';
							$dormirtabla = '<strong style="color:#fff;">'.$dormirtabla.'</strong>';	
						}else {
							$fondodormir = '';						
						}
						$tabla.= '
							<tr>
								<td><strong>'.$categoriatabla.'</strong></td>
								<td'.$fondodolor.'>'.$dolortabla.'</td>
								<td'.$fondocans.'>'.$cansanciotabla.'</td>
								<td'.$fondonausea.'>'.$nauseatabla.'</td>
								<td'.$fondodepresion.'>'.$depresiontabla.'</td>
								<td'.$fondoans.'>'.$ansiedadtabla.'</td>
								<td'.$fondosom.'>'.$somnolenciatabla.'</td>
								<td'.$fondoapet.'>'.$apetitotabla.'</td>
								<td'.$fondobien.'>'.$bienestartabla.'</td>
								<td'.$fondoaire.'>'.$airetabla.'</td>
								<td'.$fondodormir.'>'.$dormirtabla.'</td>							
							</tr>						
						';
					}				
					$x = $escala->releer();
				}
				$cont.='
					<div id="grafica" style="min-width: 310px; height: 500px;"></div><br>
					<h3 style="text-align:center">Datos Tabulados</h3><hr>
					<div class="overflow overthrow">
						<table class="table2 borde-tabla table-hover">
							<thead>
								<tr class="fd-table">
									<th>Fecha</th>
									<th>Dolor</th>
									<th>Cansancio</th>
									<th>N&aacute;usea</th>
									<th>Depresi&oacute;n</th>
									<th>Ansiedad</th>
									<th>Somnolencia</th>
									<th>Apetito</th>
									<th>Bienestar</th>
									<th>Aire</th>
									<th>Dormir</th>
								</tr>
							</thead>
							<tbody>
								'.$tabla.'
							</tbody>
						</table>
					</div>					
					';
				$script ='
				<script>				
					$(function () {
			        $('.$comillas.'#grafica'.$comillas.').highcharts({
							chart:{
								type: '.$comillas.'line'.$comillas.'						
							},		            
			            title: {
			                text: '.$comillas.'GRAFICA ESAS-R'.$comillas.',
			                x: -20 //center
			            },
			            subtitle: {
			                text: '.$comillas.'PACIENTE: '.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').''.$comillas.',
			                x: -20
			            },
			            xAxis: {
			                categories: ['.$categoria.']
			            },
			            yAxis: {
			                title: {
			                    text: '.$comillas.'Intensidad'.$comillas.'
			                },		 
			                tickInterval: 1,
			                min: 0,
			                max: 10        
			            },
			            plotOptions: {
					         line: {
					                enableMouseTracking: true
					         }
			                
					      },		           
			            series: [{
			                name: '.$comillas.'Dolor'.$comillas.',
			                data: ['.$dolor.']
			            }, {
			                name: '.$comillas.'Cansancio'.$comillas.',
			                data: ['.$cansancio.']
			            }, {
			                name: '.$comillas.'Nausea'.$comillas.',
			                data: ['.$nausea.']
			            }, {
			                name: '.$comillas.'Depresion'.$comillas.',
			                data: ['.$depresion.']
			            }, {
			                name: '.$comillas.'Ansiedad'.$comillas.',
			                data: ['.$ansiedad.']
			            }, {
			                name: '.$comillas.'Somnolencia'.$comillas.',
			                data: ['.$somnolencia.']
			            }, {
			                name: '.$comillas.'Depresion'.$comillas.',
			                data: ['.$depresion.']
			            }, {
			                name: '.$comillas.'Apetito'.$comillas.',
			                data: ['.$apetito.']
			            }, {
			                name: '.$comillas.'Bienestar'.$comillas.',
			                data: ['.$bienestar.']
			            }, {
			                name: '.$comillas.'Aire'.$comillas.',
			                data: ['.$aire.']
			            }, {
			                name: '.$comillas.'Dormir'.$comillas.',
			                data: ['.$dormir.']
			            }
			            ]
			        });
			    	});
				</script>
				<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/highcharts.js'.$comillas.'></script>	
				<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/grid.js'.$comillas.'></script>	
				<script type='.$comillas.'text/javascript'.$comillas.' src='.$comillas.'./js/modules/exporting.js'.$comillas.'></script>							
				';	
			}		
		}else{
			$script = '<center style="font-size:16px;color:red;"><h3>Ingrese un rango de fechas para graficar la escala.</h3></center>';		
		}
	}
	
	$cont.='
			'.$script.'			
		</div>
	</div>	
	';

	$ds->contenido($cont);
	$ds->mostrar();
?>
