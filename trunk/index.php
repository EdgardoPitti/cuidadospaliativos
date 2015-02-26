<?php SESSION_START();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es-ES">
	<head>	
		<meta  content="text/html; charset=utf-8" />
		<title>Gesti&oacute;n de Cuidados Paliativos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href="./iconos/logo_medicina.ico" type="image/x-icon" rel="shortcut icon" />
		<!--CSS: Menú Principal-->	
		<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/bootstrap-timepicker.min.css" rel="stylesheet"/>
		<link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
      <link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />          
      <script type="text/javascript" src="js/jquery.js"></script>   
      <script type="text/javascript" src="js/jquery.validate.js"></script>
      
      <script type="text/javaScript">
            $().ready(function() {
                // Utilizado para el validar required de una vista
                $("#form").validate();               				    
            });            
      </script>
      <script type="text/javascript">
        $('document').ready(function() {
				var inputs = document.getElementsByTagName('input');
				var x = 0;					
				for(var i=0; i<inputs.length; i++){
					if(inputs[i].getAttribute('type')=='date'){
						x++;
					}					
				}
				if(x > 0){
        		 if( $('input[type=date]')[0].type != 'date' ){
				    	$('input[type=date]').datepicker({ 				    		
				    		dateFormat: 'yy-mm-dd', 
				    		changeMonth: true, 
				    		changeYear: true, 
				    		yearRange: "1930:2100",
				    		monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
				    		monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
				    		dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
				    		dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ] 
				    	});
				  } 
				}
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
		<script src="js/modernizr.js"></script>			
		<script type="text/javascript">
			window.onload = function() {
			    // get the form and its input elements
			    var form = document.forms[0],
			        inputs = form.elements;

			    // if no autofocus, put the focus in the first field
			    if (!Modernizr.input.autofocus) {
			        inputs[0].focus();
			    }
			    // if required not supported, emulate it
			    if (!Modernizr.input.required) {			    	
			        form.onsubmit = function() {
			            var required = [], att, val;
			            // loop through input elements looking for required
			            for (var i = 0; i < inputs.length; i++) {
			                att = inputs[i].getAttribute('required');
			                // if required, get the value and trim whitespace
			                if (att != null) {
			                    val = inputs[i].value;
			                    // if the value is empty, add to required array
			                    if (val.replace(/^\s+|\s+$/g, '') == '') {
			                        required.push(inputs[i].name);
			                    }
			                }
			            }
			            // show alert if required array contains any elements
			            if (required.length > 0) {
			                alert('ERROR: Existen campos obligatorios'); 
			            	$('form').validate();
			                // prevent the form from being submitted
			                return false;
			            }
			        };
			    }
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#hora_inicio').timepicker({
					minuteStep: 1				
				});
				$('#hora_fin').timepicker({
					minuteStep: 1				
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
							Gesti&oacute;n de Cuidados Paliativos Panam&aacute;
						</h1>
					</div>
				</div>
			</div>
			  
			
			<?php 	include_once('./mvc/controlador/controlador.php'); new Controlador();?>
					
			<!--Pie de Página-->
		    <div class="row-fluid">
		        <div class="span12">
		            <div class="page-footer marketing-container">  
							<div class="featurette">
								<img class="featurette-image pull-right" src="./iconos/UTP.png" style="width:40px;height:40px;margin-top:-5px;">
						      <img class="featurette-image pull-right" src="./iconos/giseslogotrans.png" style="width:100px;border-radius:7px;margin:-3px 5px 0px;">
								<p class="lead" style="padding-top:4px">Derechos Reservados 2013-2014</p>
						   </div> 
			
		            </div>
		        </div>
		    </div>

		</div>	
	</body>
	
	<script src="js/bootstrap.js"></script>	
	<script src='js/show_hide.js'></script>
	<script src="js/get.js"></script>	
	<script src="js/bootstrap-timepicker.min.js"></script>
	<script src='js/overthrow/overthrow-detect.js'></script>	
	<script src="js/overthrow/overthrow-polyfill.js"></script>
	<script src="js/overthrow/overthrow-toss.js"></script>
	<script src="js/overthrow/overthrow-init.js"></script>
	<script src="js/overthrow/anchorscroll.overthrow.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/autocompletar.js"></script>
	<script src='js/jquery.autocomplete.js'></script>  <!-- Scripts para el Autocomplete -->
</html>
