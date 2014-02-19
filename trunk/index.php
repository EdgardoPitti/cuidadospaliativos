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
		
			
		<!--Contenido-->
		<?php 	include_once('./mvc/controlador/controlador.php'); new Controlador();?>
			
			
			
		</div>
	</body>
</html>