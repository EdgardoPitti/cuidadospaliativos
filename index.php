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
	<script type="text/javascript" src="./js/funciones.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>	
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
		<script>
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico2").keypress(function() {
                       palabra = $("#diagnostico2").val(); // Completa la palabra
                    });
                    $("#diagnostico2").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });  
					$("#diagnostico2").result(function(event, data, formatted) {
                        $("#cie2").val(data[1]); 
                    });   
            });	  
		</script>		
		<script>
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
		<script>
            $('document').ready(function() {
                    var palabra =""; // Término a buscar
                    // Evento al escribir sobre el cuadro de texto
                    $("#diagnostico1").keypress(function() {
                       palabra = $("#diagnostico1").val(); // Completa la palabra
                    });
                    $("#diagnostico1").autocomplete("./mvc/vista/listaCIE10.php?buscar="+palabra, {                        
                        matchContains: true,
                        mustMatch: true,
                        selectFirst: false
                    });
					$("#diagnostico1").result(function(event, data, formatted) {
                        $("#cie1").val(data[1]); 
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
		
		<script type="text/javascript">
			function TamVentana() {
			  var Tamanyo = [0, 0];
			  if (typeof window.innerWidth != 'undefined')
			  {
				Tamanyo = [
					window.innerWidth,
					window.innerHeight
				];
			  }
			  else if (typeof document.documentElement != 'undefined'
				  && typeof document.documentElement.clientWidth !=
				  'undefined' && document.documentElement.clientWidth != 0)
			  {
			 Tamanyo = [
					document.documentElement.clientWidth,
					document.documentElement.clientHeight
				];
			  }
			  else   {
				Tamanyo = [
					document.getElementsByTagName('body')[0].clientWidth,
					document.getElementsByTagName('body')[0].clientHeight
				];
			  }
			  return Tamanyo;
			}
			window.onresize = function() {
			  var Tam = TamVentana();
			  if(Tam[0] <= 480){
				document.getElementById("scroll-movil").style.display:"none";
			  }
			};
		</script>
		<script type="text/javascript">
			/*var isWin = (navigator.userAgent.indexOf("Win") != -1);
			var isMac = (navigator.userAgent.indexOf("Mac") != -1);
			var isUnix = (navigator.userAgent.indexOf("X11") != -1);
			if(isWin == true || isMac == true){
				document.getElementById("scroll-movil").style.display:"none";
				
			}else{				
				document.getElementById("scroll-movil").style.display:"block";
			}*/
		</script>
		<script>
			var touch = true;
			window.onload = function(){
				oScroll.debug = true;
				cargarScrollMovil([["id", "overflow-movil", "hv"]]);
			}; 
			
			/* SCROLL PARA MOVILES QUE NO SOPORTAN OVERFLOW ------------------------------------------------
			 * Se carga en todo caso en dispositivos que soporten touchevent, independientemente
			 * de que tengan o no control de overflow.
			 * El argumento objetivos de cargarScrollMovil() es un array de arrays, uno para
			 * cada clase o elemento. con las siguientes posiciones:
			 * 0: string "cls" o "id" para clase o identificador
			 * 1: string nombre de clase o identificador
			 * 2: string "h", "v" o "hv" para indicar scroll horizontal, vertical o ambos. Opcional, valor
			 *    inicial "v". Con minúsculas se carga si el contenido sobrepasa el ancho o alto. Con
			 *    mayúsculas se cargan siempre.
			 * 3: string para incorporar estilo a los botones. Opcional, valor inicial "".
			 */

			function cargarScrollMovil(objetivos) {
				try {
					//Antes usaba navigator.userAgent para detectar Android 2.x pero ahora le pondremos
					//botones de scroll a cualquier navegador que soporte eventos de toque. La variable
					//oScroll.debug se pone a true en el window.onload de una página para probar
					//este componenente en navegadores que no soporten eventos de toque
					if (touch || oScroll.debug) {
						//El argumento hv puede ser "h", "v" o "hv". Si es con mayúsculas inserta el scroll
						//en cualquier caso. Con minúsculas sólo si el contenido es mayor.
						function construirScroll(scmovs, hv, style) {
							var htmls = [];
							for (var i=0, maxi=scmovs.length; i<maxi; i++) {
								var objetivo = scmovs[i];
								var sgte = objetivo.nextSibling;
								//No lo cargamos si ya está cargado o si el contenido es vacío
								if ((objetivo.innerHTML.length==0)||
									(!(sgte && sgte.className && (sgte.className=="scroll-movil")))){
									var ow, sw, oh, sh;
									var H = (hv.indexOf("H")>-1);
									var V = (hv.indexOf("V")>-1);
									var h = (hv.indexOf("h")>-1);
									var v = (hv.indexOf("v")>-1);
									if (h) h = (h && (objetivo.scrollWidth > objetivo.offsetWidth));
									if (v) v = (v && (objetivo.scrollHeight > objetivo.offsetHeight));
									var html = "";
									if (h || H) html += htmlH;       
									if (v || V) html += htmlV;
									if (html != "") {
										var sty = 'st yle="display:block; ' + style + '"';
										html = '<div class="scroll-movil" id="scroll-movil"' + sty + '>' +
												html + '</div>';
										htmls[htmls.length] = [scmovs[i], html];
									}
									
								} 
							} 
							for (var i=0, maxi=htmls.length; i<maxi; i++){
								htmls[i][0].insertAdjacentHTML("afterend", htmls[i][1]);
							}
						}   
						var estilo = "";
						var prefijos = ["moz", "webkit", "ms", "o"];
						for (var i=0, max=prefijos.length; i<max; i++){
							estilo += "-" + prefijos[i] + "-user-select: none; ";  
						}
						estilo += "user-select: none; ";
						var arr = [[1,-1],[1,1],[0,-1],[0,1]];
						var flechas = ["l", "r", "u", "d"];
						var htmlH = "", htmlV = "";
						//Antes tenía solo ontouchstart y ontouchend, pero Chrome 32 trata ambos
						//eventos incluso en un navegador de sobremesa sin consultar si el dispositivo
						//acepta eventos de toque. Esto es porque ya hay dispositivos que pueden aceptar
						//TouchEvents y MouseEvents al mismo tiempo.
						for (var i=0,maxi=arr.length; i<maxi; i++){
							var cad = '<button class="scroll-movil-boton" ' +
							'ontouchstart="iniciarScrollMovil(event,' + arr[i][0] + ',' + arr[i][1] + ')" ' +
							'onmousedown="iniciarScrollMovil(event,' + arr[i][0] + ',' + arr[i][1] + ')" ' +                
							'ontouchend="pararScrollMovil(event)" ' +
							'onmouseup="pararScrollMovil(event)" ' +                
							'style="' + estilo + '" unselectable="on">&' + flechas[i] + 'Arr;</button>';
							if (i<2){
								htmlH += cad;
							} else {
								htmlV += cad;
							}
						}
						for (var i=0, maxi=objetivos.length; i<maxi; i++) {
							var clsId = objetivos[i][0];
							var nombre = objetivos[i][1];
							var hv = "v";
							if (objetivos[i].length>2) hv = objetivos[i][2];
							var style = "";
							if (objetivos[i].length>3) style = 'style="' + objetivos[i][3] + '"';
							if (clsId=="cls") {
								construirScroll(document.getElementsByClassName(nombre), hv, style);
							} else {
								var elemento = document.getElementById(nombre);
								if (elemento) construirScroll([elemento], hv, style);
							}
						}
					}

				} catch(e) {
					alert(e.message);
					//no capturamos nada
				}
			}

			/* Objeto que contiene variables temporales que se inicializan con touchstart y así
			 * poder usarlas mientras se mantiene el toque hasta touchend. La variable debug permite
			 * evitar document.createEvent("TouchEvent") en cargarScrollMovil() y poder verlo 
			 * funcionando en navegadores NO móviles como Chrome y su facilidad para simular
			 * user-agent.
			 */
			oScroll = {
				interval: null,
				elemento: null,
				mm: 0,    
				hv: 0,
				debug: false
			};

			function iniciarScrollMovil(event, hv, masMenos) {
				if (event.preventDefault) event.preventDefault();
				oScroll.interval = window.clearInterval(oScroll.interval);
				oScroll.interval = null;    
				var elemento = event.target || event.srcElement;
				var padre = elemento.parentNode || elemento.parentElement;
				oScroll.elemento = padre.previousSibling;
				var estiloActual = oScroll.elemento.currentStyle || 
					document.defaultView.getComputedStyle(oScroll.elemento, null) ;
				var salto = Math.round(parseInt(estiloActual["height"])/5);
				if (salto<48) salto = 48;
				oScroll.mm = salto * masMenos;
				oScroll.hv = hv;
				oScroll.interval = window.setInterval(function(){
					if (oScroll.hv==0) {
						//en vertical
						oScroll.elemento.scrollLeft = 0;
						oScroll.elemento.scrollTop += oScroll.mm;
					} else {
						//en horizontal
						oScroll.elemento.scrollLeft += oScroll.mm;
					}           
				
				}, 100);
			}

			function pararScrollMovil(event){
				if (event.preventDefault) event.preventDefault();
				oScroll.interval = window.clearInterval(oScroll.interval);
				oScroll.interval = null;    
			}

		   
		</script>
	</head>
	<body> 				
		<div class="container-fluid">
					
			<div class="row-fluid" >
				<div class="span12">
					<div class="page-header">
						<h1 style="line-height:35px;">	
							<p>Red Social de Cuidados Paliativos Panam&aacute;</p>
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
			
			<div class="row-fluid">
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