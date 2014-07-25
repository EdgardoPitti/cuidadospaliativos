<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	include_once('./mvc/modelo/Accesatabla.php');

	$cont='
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="./css/styles.css">
		<center>
			<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Escala de Edmont</h3>
		</center>
		';
		
		$cont.='	
		<center>
			<form class="form-search" method="POST" action="./?url=escala_edmont&sbm=7">
				<div class="input-group">
				  Buscar paciente: <input type="search" class="form-control" placeholder="C&eacute;dula" name="buscar" id="busqueda">

				  <span class="input-group-btn">
					<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
				  </span>
				</div>
			</form>
		</center>
		<div class="price-box">
			<form method="POST" action="./?url=agregar_edmonton&sbm=7" class="form-pricing">
			  <!-- Slider DOLOR  -->
	          <div class="price-slider">
	            <h4 class="great">DOLOR</h4>
	            <div class="span12">
					<div id="slider" style="width:95%;"></div>
				 	<div style="width:95%">
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
						<div id="slider2" style="width:95%;"></div>
				 		<div style="width:95%">
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
						<div id="slider3" style="width:95%;"></div>
				 		<div style="width:95%">
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
						<div id="slider4" style="width:95%;"></div>
				 		<div style="width:95%">
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
						<div id="slider5" style="width:95%;"></div>
				 		<div style="width:95%">
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
						<div id="slider6" style="width:95%;"></div>
				 		<div style="width:95%">
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
						<div id="slider7" style="width:95%;"></div>
				 		<div style="width:95%">
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
						<div id="slider8" style="width:95%;"></div>
				 		<div style="width:95%">
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
						<div id="slider9" style="width:95%;"></div>
				 		<div style="width:95%">
							<span size="8" style="float:left;">Sin Falta de Aire</span>
							<span size="8" style="float:right;">M&aacute; Falta de Aire</span>
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
				 		<div style="width:95%">
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
	        </form> 
	    </div>
	   
	    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
		<script>
		  $(document).ready(function() {			
			$("#slider").slider({
				range: "min",
				animate: true,
				value:0,
				min: 0,
				max: 10,
				step: 1,
				slide: function(event, ui) {
					update(1,ui.value);
				}
		    });
			$("#slider2").slider({
				range: "min",
				animate: true,
				value:0,
				min: 0,
				max: 10,
				step: 1,
				slide: function(event, ui) {
					update(2,ui.value);
				}
		    });
			$("#slider3").slider({
				range: "min",
				animate: true,
				value:0,
				min: 0,
				max: 10,
				step: 1,
				slide: function(event, ui) {
					update(3,ui.value);
				}
		    });  
			$("#slider4").slider({
				range: "min",
				animate: true,
				value:0,
				min: 0,
				max: 10,
				step: 1,
				slide: function(event, ui) {
					update(4,ui.value);
				}
		    });  
			$("#slider5").slider({
				range: "min",
				animate: true,
				value:0,
				min: 0,
				max: 10,
				step: 1,
				slide: function(event, ui) {
					update(5,ui.value);
				}
		    });  
			$("#slider6").slider({
				range: "min",
				animate: true,
				value:0,
				min: 0,
				max: 10,
				step: 1,
				slide: function(event, ui) {
					update(6,ui.value);
				}
		    });  
			$("#slider7").slider({
				range: "min",
				animate: true,
				value:0,
				min: 0,
				max: 10,
				step: 1,
				slide: function(event, ui) {
					update(7,ui.value);
				}
		    });  
			$("#slider8").slider({
				range: "min",
				animate: true,
				value:0,
				min: 0,
				max: 10,
				step: 1,
				slide: function(event, ui) {
					update(8,ui.value);
				}
		    });  
			$("#slider9").slider({
				range: "min",
				animate: true,
				value:0,
				min: 0,
				max: 10,
				step: 1,
				slide: function(event, ui) {
					update(9,ui.value);
				}
		    });  
			$("#slider10").slider({
				range: "min",
				animate: true,
				value:0,
				min: 0,
				max: 10,
				step: 1,
				slide: function(event, ui) {
					update(10,ui.value);
				}
		    });  


			  $("#dolor").val(0);
			  $("#dolor-label").text(0);
			  $("#cansancio").val(0);
			  $("#cansancio-label").text(0);
			  $("#nausea").val(0);
	          $("#nausea-label").text(0);
			  $("#depresion").val(0);
	          $("#depresion-label").text(0);
			  $("#ansiedad").val(0);
	          $("#ansiedad-label").text(0);
			  $("#somnolencia").val(0);
	          $("#somnolencia-label").text(0);
			  $("#apetito").val(0);
	          $("#apetito-label").text(0);
			  $("#bienestar").val(0);
	          $("#bienestar-label").text(0);
			  $("#aire").val(0);
	          $("#aire-label").text(0);
			  $("#dormir").val(0);
	          $("#dormir-label").text(0);
			  update();
            });

			function update(slider, val){
				var $dolor = slider == 1?val:$("#dolor").val();
				var $cansancio = slider == 2?val:$("#cansancio").val();
				var $nausea = slider == 3?val:$("#nausea").val();
				var $depresion = slider == 4?val:$("#depresion").val();
				var $ansiedad = slider == 5?val:$("#ansiedad").val();
				var $somnolencia = slider == 6?val:$("#somnolencia").val();
				var $apetito = slider == 7?val:$("#apetito").val();
				var $bienestar = slider == 8?val:$("#bienestar").val();
				var $aire = slider == 9?val:$("#aire").val();
				var $dormir = slider == 10?val:$("#dormir").val();

				$("#dolor").val($dolor);
				$("#dolor-label").text($dolor);

				$("#cansancio").val($cansancio);
				$("#cansancio-label").text($cansancio);

				$("#nausea").val($nausea);
				$("#nausea-label").text($nausea);

				$("#depresion").val($depresion);
				$("#depresion-label").text($depresion);

				$("#ansiedad").val($ansiedad);
				$("#ansiedad-label").text($ansiedad);

				$("#somnolencia").val($somnolencia);
				$("#somnolencia-label").text($somnolencia);

				$("#apetito").val($apetito);
				$("#apetito-label").text($apetito);

				$("#bienestar").val($bienestar);
				$("#bienestar-label").text($bienestar);

				$("#aire").val($aire);
				$("#aire-label").text($aire);

				$("#dormir").val($dormir);
				$("#dormir-label").text($dormir);
			}
		</script>		
	';

	$ds->contenido($cont);
	$ds->mostrar();
?>