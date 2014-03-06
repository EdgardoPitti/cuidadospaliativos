<?php SESSION_START();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" Content-Type: application/pdf>
	<head>	
		<meta content="text/html; charset=utf-8" />
		<title>Cuidados Paliativos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<link href="./iconos/logo_medicina.ico" type="image/x-icon" rel="shortcut icon" />
		<!--CSS: Menú Principal-->	
		
		<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		<link href="css/print.css" type="text/css" rel="stylesheet" media="print" />
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/funciones.js"></script>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>	
		<script type='text/javascript' src='js/jquery-1.8.3.js'></script>	
		<script type='text/javascript' src='js/show_hide.js'></script>	
		<script type='text/javascript' src='js/overflow.js'></script>	
		<script type='text/javascript' src='js/ajax.js'></script>	

		<!-- Scripts para el Autocomplete -->
		<link rel="stylesheet" type="text/css" href="./css/jquery.autocomplete.css" media="screen"/>        
		<script type='text/javascript' src='./js/jquery.autocomplete.js'></script>   
		
	<!-- Estas funciónes realizan el llamado via AJAX para el autocompletado 
	del formulario con base en un término o palabra que el usuario 
	indique en la medida que vaya digitando en el cuadro de texto -->
		<script type="text/javascript">	
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico1").keypress(function() {
                       palabra = $("#diagnostico1").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnostico1").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnostico1").result(function(event, data, formatted) {
                        $("#cie1").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico2").keypress(function() {
                       palabra = $("#diagnostico2").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnostico2").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnostico2").result(function(event, data, formatted) {
                        $("#cie2").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico3").keypress(function() {
                       palabra = $("#diagnostico3").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnostico3").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnostico3").result(function(event, data, formatted) {
                        $("#cie3").val(data[1]); 
                    });                   
            });	            
        </script>	
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico4").keypress(function() {
                       palabra = $("#diagnostico4").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnostico4").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnostico4").result(function(event, data, formatted) {
                        $("#cie4").val(data[1]); 
                    });                   
            });	            
        </script>				
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico5").keypress(function() {
                       palabra = $("#diagnostico5").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnostico5").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnostico5").result(function(event, data, formatted) {
                        $("#cie5").val(data[1]); 
                    });                   
            });	            
        </script>						
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico6").keypress(function() {
                       palabra = $("#diagnostico6").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnostico6").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnostico6").result(function(event, data, formatted) {
                        $("#cie6").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico7").keypress(function() {
                       palabra = $("#diagnostico7").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnostico7").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnostico7").result(function(event, data, formatted) {
                        $("#cie7").val(data[1]); 
                    });                   
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico8").keypress(function() {
                       palabra = $("#diagnostico8").val(); // Completa la palabra
                    });
                    // Tan pronto se empieza a escribir en el cuadro de texto, se
                    // dispara el evento de autocompletar que hace la consulta al
                    // archivo listaCIE10.php con el término a buscar. En el 
                    // archivo listaCIE10.php, se hace la consulta y se regresan 
                    // las coincidencias de la palabra, completando el texto con
                    // una lista de sugerencias. Igualmente, se reciben, los ID's
                    // que coinciden con los términos buscados.
                    $("#diagnostico8").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
                    // Con base en el valor del término que se ha seleccionado en 
                    // la lista de sugerencias, se pasa a los campos txtAfecciones_val
                    // y txtCIE, el valor del ID del termino seleccionado, que es el 
                    // código CIE10 asignado.
                    $("#diagnostico8").result(function(event, data, formatted) { 
                        $("#cie8").val(data[1]); 
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
                    $("#diagnostico").keypress(function() {
                       palabra = $("#diagnostico").val(); // Completa la palabra
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
                    $("#diagnostico").result(function(event, data, formatted) {
                        $("#cie").val(data[1]); 
                    });                   
            });	            
        </script>				
		<script type="text/javascript">
            $('document').ready(function() {
				var palabra =""; // Término a buscar
				// Evento al escribir sobre el cuadro de texto
				$("#profesional").keypress(function() {
				   palabra = $("#profesional").val(); // Completa la palabra
				});
				$("#profesional").autocomplete("./mvc/vista/buscar_personal.php?buscar="+palabra, {                        
					matchContains: true,
					mustMatch: true,
					selectFirst: false
				});  
				$("#profesional").result(function(event, data, formatted) {
					$("#cedprofesional").val(data[1]);
					
				});				
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
				var palabra =""; // Término a buscar
				// Evento al escribir sobre el cuadro de texto
				$("#profesional2").keypress(function() {
				   palabra = $("#profesional2").val(); // Completa la palabra
				});
				$("#profesional2").autocomplete("./mvc/vista/buscar_personal.php?buscar="+palabra, {                        
					matchContains: true,
					mustMatch: true,
					selectFirst: false
				});  
				$("#profesional2").result(function(event, data, formatted) {
					$("#cedprofesional2").val(data[1]); 
				});				
            });	            
        </script>		
		<script type="text/javascript">
            $('document').ready(function() {
				var palabra =""; // Término a buscar
				// Evento al escribir sobre el cuadro de texto
				$("#profesional3").keypress(function() {
				   palabra = $("#profesional3").val(); // Completa la palabra
				});
				$("#profesional3").autocomplete("./mvc/vista/buscar_personal.php?buscar="+palabra, {                        
					matchContains: true,
					mustMatch: true,
					selectFirst: false
				});  
				$("#profesional3").result(function(event, data, formatted) {
					$("#cedprofesional3").val(data[1]);
				});				
            });	            
        </script>			
		<script type="text/javascript">
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico").keypress(function() {
                       palabra = $("#diagnostico").val(); // Completa la palabra
                    });
                    $("#diagnostico").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    }); 
					$("#diagnostico").result(function(event, data, formatted) {
                        $("#cie10").val(data[1]); 
                    });   					
            });	  
		</script>		
		<script type="text/javascript">
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
		<script type="text/javascript">			
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#paciente").keypress(function() {
                       palabra = $("#paciente").val(); // Completa la palabra
                    });

                    $("#paciente").autocomplete("./mvc/vista/buscar_pacientes.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
					$("#paciente").result(function(event, data, formatted) {
                        $("#cedpaciente").val(data[1]); 
                    });    
            });	            
        </script>	
	</head>
	<body> 				
		<div class="container-fluid">			   
			<div class="row-fluid" id="header">
				<div class="span12">
					<div class="page-header">
						<h1 style="line-height:35px;">	
							Red Social de Cuidados Paliativos Panam&aacute;
						</h1>
					</div>
				</div>
			</div>
			<!--Navegación Superior-->
			<div class="row-fluid" id="sub-header-nav">
				<div class="span12">
					<ul class="nav nav-pills" style="float:right;margin-top:4px;">						
						<li class="dropdown pull-right">
							<a href="#" data-toggle="dropdown" class="dropdown-toggle">Usuario<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<!--li><a href="./?url=addmedico">Agregar M&eacute;dico</a></li-->
								<li><a href="./?url=login">Iniciar Sesi&oacute;n</a></li>
								<li class="divider"></li>
								<li><a href="#">Cerrar Sesi&oacute;n</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>   
			<?php
				$mantener = $_GET['sbm'];
				if(empty($mantener)){
					$display1='none';
					$display2='none';
					$display3='none';
					$display4='none';
				}else{
					if($mantener == 1){
						$display1='block';
						$display2='none';
						$display3='none';
						$display4='none';
					}
					if($mantener == 2){
						$display1='none';
						$display2='block';
						$display3='none';
						$display4='none';
					}
					if($mantener == 3){
						$display1='none';
						$display2='none';
						$display3='block';
						$display4='none';
					}
					if($mantener == 4){
						$display1='none';
						$display2='none';
						$display3='none';
						$display4='block';
					}
				}
			?>
			<div class="row-fluid">  
				<!--Aside-->
				<div class="span2" id="menu">
				
					<!--DOMICILIARIA-->					
					<div class="css_acordeon" id="mostrar_ocultar1" id="accordion-1" style="display:<?php echo $display1; ?>;">			
						<h3>Men&uacute; Atenci&oacute;n Domiciliaria</h3><hr>
						<div style="margin-bottom:2px;">
							<input id="ac-1" name="acordeon" type="radio" />
							<label for="ac-1">Registro de Visitas Domiciliarias</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=domiciliaria_capturardatos&sbm=1" title="Capturar Datos"><i>Capturar Datos</i></a></li>	
									<li><a class="sublink" href="./?url=domiciliaria_visita_realizada&sbm=1" title="Visitas Realizadas"><i>Visitas Realizadas</i></a></li>				
									<li><a class="sublink" href="./?url=domiciliaria_agenda&sbm=1" title="Agenda"><i>Agenda</i></a></li>				
								</ul>
							</article>	
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=domiciliarias_diario_actividades&sbm=1" title="Registro de Actividades Diarias">Registro de Actividades Diarias</a></li>
							</ul>
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=domiciliaria_surco&sbm=1" Title="Sistema &Uacute;nico de Referencia y Contra-Referencia">Surco</a></li>
							</ul>
						</div>
						<div style="margin-bottom:10px;">
							<input id="ac-2" name="acordeon" type="radio" />
							<label for="ac-2">Indicadores</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=indicadores_total_visitas&sbm=1" title="Total de Visitas Realizadas por Periodo de Tiempo"><i>Total de Visitas Realizadas x Periodo de Tiempo</i></a></li>
									<li><a class="sublink" href="./?url=indicadores_tiempo_promedio&sbm=1" title="Tiempo Promedio Empleado por Visita"><i>Tiempo Promedio Empleado por Visita</i></a></li>
									<li><a class="sublink" href="./?url=indicadores_pacientes_diagnostico&sbm=1" title="N&deg de Visitas por Paciente Seg&uacute;n Diagn&oacute;stico"><i>N&deg de Visitas x Paciente Seg&uacute;n Diagn&oacute;stico</i></a></li>
									<li><a class="sublink" href="./?url=indicadores_actividades_realizadas&sbm=1" title="Actividades Realizadas por Visitas"><i>Actividades Realizadas por Visitas</i></a></li>		
								</ul>
							</article>	
						</div>
					</div>	
					
					<!--AMBULATORIA-->
					<div class="css_acordeon" id="mostrar_ocultar2" id="accordion-2" style="display:<?php echo $display2; ?>;">			
						<h3>Men&uacute; Atenci&oacute;n Ambulatoria</h3><hr>
						<div style="margin-bott om:2px;">
							<input id="ac-3" name="acordeon" type="radio" />
							<label for="ac-3">Registro Diario de Actividades</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=ambulatoria_capturardatos&sbm=2" title="Capturar Datos"><i>Capturar Datos</i></a></li>	
									<li><a class="sublink" href="#" title="Agenda"><i>Agenda</i></a></li>				
								</ul>
							</article>	
						</div>
						<div>
							<input id="ac-4" name="acordeon" type="radio" />
							<label for="ac-4">Contacto Telef&oacute;nico</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=ambulatoria_atencionalpaciente&sbm=2" title="Atenci&oacute;n al Paciente"><i>Atenci&oacute;n al Paciente</i></a></li>
									<li><a class="sublink" href="./?url=ambulatoria_interconsulta&sbm=2" title="Interconsulta"><i>Interconsulta</i></a></li>								
								</ul>
							</article>	
						</div>
						<div style="margin-bottom:10px;">
							<input id="ac-5" name="acordeon" type="radio" />
							<label for="ac-5">Indicadores</label>
							<article>	
								<ul>
									<li><a class="sublink" href="#" title="Frecuentaci&oacuten Paciente/Familiar a la Instalaci&oacute;n por Periodo de Tiempo"><i>Frecuentaci&oacuten P/F a la Instalaci&oacute;n x Periodo de Tiempo</i></a></li>
									<li><a class="sublink" href="#" title="N&ordm; de Consultas por Paciente por Unidad de Tiempo"><i>N&ordm; de Consultas por Paciente x Unidad de Tiempo</i></a></li>								
									<li><a class="sublink" href="./?url=indicadores_actividades_realizadas&sbm=2" title="Actividades Realizadas por Paciente"><i>Actividades Realizadas por Paciente</i></a></li>								
								</ul>
							</article>	
						</div>
					</div>	
						
					<!--HOSPITALARIA-->
					<div class="css_acordeon" id="mostrar_ocultar3" id="accordion-3" style="display:<?php echo $display3; ?>;">			
						<h3>Men&uacute; Atenci&oacute;n Hospitalaria</h3><hr>
						<div style="margin-bott om:2px;">
							<input id="ac-6" name="acordeon" type="radio" />
							<label for="ac-6">RAE</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=hospitalaria_rae_capturardatos&sbm=3" title="Capturar Datos"><i>Capturar Datos</i></a></li>	
									<li><a class="sublink" href="./?url=hospitalaria_rae_evolucion&sbm=3" title="Evoluci&oacute;n"><i>Evoluci&oacute;n</i></a></li>				
								</ul>
							</article>	
						</div>
						<div style="margin-bottom:10px;">
							<input id="ac-7" name="acordeon" type="radio" />
							<label for="ac-7">Indicadores</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=indicadores_porcentaje_camas" title="Porcentaje de Ocupaci&oacute;n de Camas"><i>Porcentaje de Ocupaci&oacute;n de Camas</i></a></li>								
									<li><a class="sublink" href="#" title="Giro de Cama"><i>Giro de Cama</i></a></li>								
									<li><a class="sublink" href="#" title="Promedio de D&iacute;as de Estancia"><i>Promedio de D&iacute;as de Estancia</i></a></li>								
									<li><a class="sublink" href="#" title="Porcentaje de egresos"><i>Porcentaje de Egresos</i></a></li>								
									<li><a class="sublink" href="#" title="Razones de Readmisiones"><i>Razones de Readmisiones</i></a></li>								
									<li><a class="sublink" href="./?url=indicadores_infeccion_nosocomial" title="Porcentaje de Infecciones Nosocomiales"><i>Porcentaje de Infecciones Nosocomiales</i></a></li>								
									<li><a class="sublink" href="./?url=indicadores_porcentaje_hospitalizados&sbm=3" title="Porcentaje de Hospitalizados referidos de Consulta externa"><i>Porcentaje de Hospitalizados referidos de Consulta externa</i></a></li>
								</ul>
							</article>	
						</div>
					</div>	
					
					<!--RED SOCIAL   onclick="show_span()"-->
					<div class="css_acordeon" id="mostrar_ocultar4" id="accordion-4"  style="display:<?php echo $display4; ?>;">	
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
				<?php 	include_once('./mvc/controlador/controlador.php'); new Controlador();?>
			
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
											<a href="#" id="show1" title="Atenci&oacute;n Domiciliaria"><img src="./iconos/atencion_domiciliaria.png"style="width:30px; heigth:30px;"/> Domiciliaria</a>
										</li>
										<li>
											<a href="#" id="show2" title="Atenci&oacute;n Ambulatoria"><img src="./iconos/atencion_ambulatoria.png" style="width:30px; heigth:30px;"/> Ambulatoria</a>
										</li>
										<li>
											<a href="#" id="show3" title="Atenci&oacute;n Hospitalaria"><img src="./iconos/atencion_hospitalaria.png" style="width:30px; heigth:30px;"/> Hospitalaria</a>
										</li>
										<li>
											<a href="#" id="show4" title="Red Social"><img src="./iconos/social.png" style="width:30px; heigth:30px;"/> Red Social</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!--Pie de Página-->
			<div class="row-fluid" id="footer">
				<div class="span12">
					<div class="page-footer">
						<b>Derechos Reservados 2013-2014</b>
					</div>
				</div>
			</div>	
		</div>	
	</body>
</html>