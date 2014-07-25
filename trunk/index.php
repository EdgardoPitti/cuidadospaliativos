<?php SESSION_START();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-ES">
	<head>	
		<meta  content="text/html; charset=utf-8" />
		<title>Cuidados Paliativos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href="./iconos/logo_medicina.ico" type="image/x-icon" rel="shortcut icon" />
		<!--CSS: Menú Principal-->	
		<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./css/jquery.autocomplete.css"/>
               
        <script type="text/javascript" src="js/jquery.js"></script>   
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javaScript">

            $().ready(function() {
                // Utilizado para el validar required de una vista
                $("#form").validate();               
            });
        </script>
		<script type="text/javaScript">

            $().ready(function() {
                //Se aplica si existe un segundo formulario dentro de una misma vista
                $("#form2").validate();               
            });
        </script>        
		<script language="JavaScript" type="text/JavaScript">
			//funcion para la seleccion de dropdown anidados
			$(document).ready(function(){
				$("#provincias").change(function(event){
					var id = $("#provincias").find(':selected').val();
					$("#distritos").load('./mvc/vista/capturardatos_distritos.php?idprovincia='+id);
					$("#corregimientos").load('./mvc/vista/capturardatos_corregimientos.php?iddistrito=0');
				});
				$("#distritos").change(function(event){
					var id = $("#distritos").find(':selected').val();
					$("#corregimientos").load('./mvc/vista/capturardatos_corregimientos.php?iddistrito='+id);
				});				
			});
		</script>
		
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
				$("#buscar_profesional").keypress(function() {
				   palabra = $("#profesional").val(); // Completa la palabra
				});
				$("#buscar_profesional").autocomplete("./mvc/vista/buscar_personal.php?buscar="+palabra, {                        
					matchContains: true,
					mustMatch: true,
					selectFirst: false
				});  
				$("#buscar_profesional").result(function(event, data, formatted) {
					$("#buscar_profesional").val(data[1]);
					
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
			  
			
				<?php 	include_once('./mvc/controlador/controlador.php'); new Controlador();?>
					
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
	
	<script src="js/bootstrap.js"></script>	
	<script src='js/show_hide.js'></script>	
	<script src='js/overthrow/overthrow-detect.js'></script>	
	<script src="js/overthrow/overthrow-polyfill.js"></script>
	<script src="js/overthrow/overthrow-toss.js"></script>
	<script src="js/overthrow/overthrow-init.js"></script>
	<script src="js/overthrow/anchorscroll.overthrow.js"></script>
	<script src='./js/jquery.autocomplete.js'></script>  <!-- Scripts para el Autocomplete -->
</html>
