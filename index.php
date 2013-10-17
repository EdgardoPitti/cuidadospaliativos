<? SESSION_START();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<head>	
		<meta content="text/html; charset=utf-8" />
		<title>Cuidados Paliativos</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!--CSS: Menú Principal-->	
	
	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	
	<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
	
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script src="./js/funciones.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>	
	<script type='text/javascript' src="./js/jquery-1.9.1.js"></script>
	<script type='text/javascript' src='./js/jquery-1.8.3.js'></script>
	  
	<!-- Scripts para el Autocomplete -->
	<link rel="stylesheet" type="text/css" href="./css/jquery.autocomplete.css"/>        
	<script type='text/javascript' src='./js/jquery.autocomplete.js'></script>   

	<!-- Estas funciónes realizan el llamado via AJAX para el autocompletado 
	del formulario con base en un término o palabra que el usuario 
	indique en la medida que vaya digitando en el cuadro de texto -->
		<script type="text/javascript">
		
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticobhc").keypress(function() {
                       palabra = $("#diagnosticobhc").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnosticobhc").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnosticobhc").result(function(event, data, formatted) {
                        $("#ciebhc").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticourin").keypress(function() {
                       palabra = $("#diagnosticourin").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnosticourin").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnosticourin").result(function(event, data, formatted) {
                        $("#cieurin").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticoheces").keypress(function() {
                       palabra = $("#diagnosticoheces").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnosticoheces").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnosticoheces").result(function(event, data, formatted) {
                        $("#cieheces").val(data[1]); 
                    });                   
            });	            
        </script>	
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticoglice").keypress(function() {
                       palabra = $("#diagnosticoglice").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnosticoglice").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnosticoglice").result(function(event, data, formatted) {
                        $("#cieglice").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticocrea").keypress(function() {
                       palabra = $("#diagnosticocrea").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnosticocrea").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnosticocrea").result(function(event, data, formatted) {); 
                        $("#ciecrea").val(data[1]); 
                    });                   
            });	            
        </script>	
			
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticondeu").keypress(function() {
                       palabra = $("#diagnosticondeu").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnosticondeu").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnosticondeu").result(function(event, data, formatted) {
                        $("#ciendu").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticoelec").keypress(function() {
                       palabra = $("#diagnosticoelec").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnosticoelec").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnosticoelec").result(function(event, data, formatted) {
                        $("#cieelec").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticoami").keypress(function() {
                       palabra = $("#diagnosticoami").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnosticoami").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnosticoami").result(function(event, data, formatted) { 
                        $("#cieami").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticorespuesta").keypress(function() {
                       palabra = $("#diagnosticorespuesta").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnosticorespuesta").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnosticorespuesta").result(function(event, data, formatted) {
                        $("#cierespuesta").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
				var palabra =""; // Término a buscar
				// Evento al escribir sobre el cuadro de texto
				$("#nombrerefiere").keypress(function() {
				   palabra = $("#nombrerefiere").val(); // Completa la palabra
				});
				$("#nombrerefiere").autocomplete("./mvc/vista/buscar_personal.php?buscar="+palabra, {                        
					matchContains: true,
					mustMatch: true,
					selectFirst: false
				});             
            });	            
        </script>

		<script>
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticoadmision").keypress(function() {
                       palabra = $("#diagnosticoadmision").val(); // Completa la palabra
                    });
                    $("#diagnosticoadmision").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });             
            });	  
		</script>
		<script>
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnosticoegreso").keypress(function() {
                       palabra = $("#diagnosticoegreso").val(); // Completa la palabra
                    });
                    $("#diagnosticoegreso").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });             
            });	  
		</script>
		<script>
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#busqueda").keypress(function() {
                       palabra = $("#busqueda").val(); // Completa la palabra
                    });

                    $("#busqueda").autocomplete("./mvc/vista/buscar_pacientes.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
					$("#busqueda").result(function(event, data, formatted) {
                        $("#busqueda").val(data[1]); 
                    });    
            });	            
        </script>	
		<script>
			$(function(){
			  $("#show1").click(function(){
				$("#mostrar_ocultar1").toggle("1000");
				$("#mostrar_ocultar2").hide();
				$("#mostrar_ocultar3").hide();
				$("#mostrar_ocultar4").hide();
			  });
			   $("#show2").click(function(){
				$("#mostrar_ocultar2").toggle("1000");
				$("#mostrar_ocultar1").hide();
				$("#mostrar_ocultar3").hide();
				$("#mostrar_ocultar4").hide();
			  });
			   $("#show3").click(function(){
				$("#mostrar_ocultar3").toggle("1000");
				$("#mostrar_ocultar2").hide();
				$("#mostrar_ocultar1").hide();
				$("#mostrar_ocultar4").hide();
			  });
			   $("#show4").click(function(){
				$("#mostrar_ocultar4").toggle("1000");
				$("#mostrar_ocultar1").hide();
				$("#mostrar_ocultar3").hide();
				$("#mostrar_ocultar2").hide();
			  });
			});
		</script>
	</head>
	<body> 			
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="page-header">
						<h1 style="line-height:35px;">
							Red Social de Cuidados Paliativos Panam&aacute;
						</h1>
					</div>
				</div>
			</div>
			
			<!--Navegación Superior-->
			<div class="row-fluid">
				<div class="span12">
					<ul class="nav nav-pills" style="float:right;margin-top:4px;">
						<li>
							<a href="#">M&eacute;dico</a>
						</li>
						<li class="dropdown pull-right">
							<a href="#" data-toggle="dropdown" class="dropdown-toggle">Configuraci&oacute;n <strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li><a href="./?url=addmedico">Agregar M&eacute;dico</a></li>
								<li class="divider"></li>
								<li><a href="#">Enlace separado</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="row-fluid">
				<!--Aside-->
				<div class="span2">
				
					<!--DOMICILIARIA-->					
					<div class="css_acordeon" id="mostrar_ocultar1" id="accordion-1" style="display:none;">			
						<h3>Men&uacute; Atenci&oacute;n Domiciliaria</h3><hr>
						<div style="margin-bottom:2px;">
							<input id="ac-1" name="acordeon" type="radio" />
							<label for="ac-1">Registro de Visitas Domiciliarias</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=domiciliaria_capturardatos"><i>Capturar Datos</i></a></li>	
									<li><a class="sublink" href="#"><i>Agenda</i></a></li>				
								</ul>
							</article>	
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=domiciliarias_registro_actividades">Registro de Actividades Diarias</a></li>
							</ul>
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=domiciliaria_surco">Surco</a></li>
							</ul>
						</div>
						<div style="margin-bottom:10px;">
							<input id="ac-2" name="acordeon" type="radio" />
							<label for="ac-2">Indicadores</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url="><i>Total de Visitas Realizadas</i></a></li>
									<li><a class="sublink" href="#"><i>Tiempo Promedio por Visita</i></a></li>
									<li><a class="sublink" href="#"><i>N&deg de Visitas x Paciente Seg&uacute;n Diagn&oacute;stico</i></a></li>
									<li><a class="sublink" href="#"><i>Activadades Realizadas por Visitas</i></a></li>								
								</ul>
							</article>	
						</div>
					</div>	
					
					<!--AMBULATORIA-->
					<div class="css_acordeon" id="mostrar_ocultar2" id="accordion-2" style="display:none;">			
						<h3>Men&uacute; Atenci&oacute;n Ambulatoria</h3><hr>
						<div style="margin-bott om:2px;">
							<input id="ac-3" name="acordeon" type="radio" />
							<label for="ac-3">Registro Diario de Actividades</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=ambulatoria_capturardatos"><i>Capturar Datos</i></a></li>	
									<li><a class="sublink" href="#"><i>Agenda</i></a></li>				
								</ul>
							</article>	
						</div>
						<div>
							<input id="ac-4" name="acordeon" type="radio" />
							<label for="ac-4">Contacto Telef&oacute;nico</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=ambulatoria_atencionalpaciente"><i>Atenci&oacute;n al Paciente</i></a></li>
									<li><a class="sublink" href="./?url=ambulatoria_interconsulta"><i>Interconsulta</i></a></li>								
								</ul>
							</article>	
						</div>
						<div style="margin-bottom:10px;">
							<input id="ac-5" name="acordeon" type="radio" />
							<label for="ac-5">Indicadores</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url="><i>Frecuentaci&oacuten P/F a la Instalaci&oacute;n</i></a></li>
									<li><a class="sublink" href="#"><i>Activadades Realizadas por Paciente</i></a></li>								
								</ul>
							</article>	
						</div>
					</div>	
						
					<!--HOSPITALARIA-->
					<div class="css_acordeon" id="mostrar_ocultar3" id="accordion-3" style="display:none;">			
						<h3>Men&uacute; Atenci&oacute;n Hospitalaria</h3><hr>
						<div style="margin-bott om:2px;">
							<input id="ac-6" name="acordeon" type="radio" />
							<label for="ac-6">RAE</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=hospitalaria_rae_capturardatos"><i>Capturar Datos</i></a></li>	
									<li><a class="sublink" href="./?url=hospitalaria_rae_evolucion"><i>Evoluci&oacute;n</i></a></li>				
								</ul>
							</article>	
						</div>
						<div style="margin-bottom:10px;">
							<input id="ac-7" name="acordeon" type="radio" />
							<label for="ac-7">Indicadores</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url="><i>Porcentaje de Hospitalizados referidos de Consulta externa</i></a></li>
									<li><a class="sublink" href="#"><i>Razones de Readmisiones</i></a></li>								
								</ul>
							</article>	
						</div>
					</div>	
					
					<!--RED SOCIAL-->
					<div class="css_acordeon" id="mostrar_ocultar4" id="accordion-4" style="display:none;">	
					<h3>Red Social</h3><hr>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="#">Mis Grupos</a></li>
							</ul>
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="#">Comunidades</a></li>
							</ul>
						</div>					
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="#">Eventos</a></li>
							</ul>
						</div>	
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="#">Especialistas</a></li>
							</ul>
						</div>	
					</div>	
				</div>
			
				<!--Contenido-->
				
				<?php include_once('./mvc/controlador/controlador.php'); new Controlador();?>
				
			</div>
			
			<div class="row-fluid">
				<div class="span12">					
					<!--Nav-->
					<div class="navbar">
						<div class="navbar-inner">
							<div class="container-fluid">
								<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar collapsed">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</a> 
									<a href="#" class="brand">Atenciones</a>	
								<div class="nav-collapse navbar-responsive-collapse collapse">
									<ul class="nav">										
										<li>
											<a href="#" id="show1"><img src="./iconos/atencion_domiciliaria.png"style="width:30px; heigth:30px;"/> Domiciliaria</a>
										</li>
										<li>
											<a href="#" id="show2"><img src="./iconos/atencion_ambulatoria.png" style="width:30px; heigth:30px;"/> Ambulatoria</a>
										</li>
										<li>
											<a href="#" id="show3"><img src="./iconos/atencion_hospitalaria.png" style="width:30px; heigth:30px;"/> Hospitalaria</a>
										</li>
										<li>
											<a href="#" id="show4"><img src="./iconos/social.png" style="width:30px; heigth:30px;"/> Red Social</a>
										</li>
									</ul>
									<!--<ul class="nav pull-right">
										<li>
											<a href="#">M&eacute;dico</a>
										</li>
										<li class="divider-vertical">
										</li>
										<li class="dropdown">
											 <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-cog"></i>Configuraci&oacute;n<strong class="caret"></strong></a>
											<ul class="dropdown-menu">
												<li>
													<a href="#">configurar</a>
												</li>										
											</ul>
										</li>
									</ul>-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!--Pie de Página-->
			<div class="row-fluid">
				<div class="span12">
					<div class="page-footer">
						<b>Derechos Reservados 2013-2014</b>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>