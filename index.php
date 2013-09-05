<? SESSION_START();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">


	<head>	
		<meta content="text/html; charset=utf-8" />
		<title>Cuidados Paliativos</title>
		
		
		<script src="./js/modernizr.custom.js"></script>
		<link rel="shortcut icon" href="./favicon.ico" />
		
		<!--CSS: Menú Principal-->
		<link rel="stylesheet" type="text/css" href="./css/default.css" />
		<link rel="stylesheet" type="text/css" href="./css/component.css" />
		
		
		<style type="text/css"><!--@import url("./css/tabs.css");-->	</style>

		<script src="./js/jquery.js"></script>
		<script src="./js/funciones.js"></script>
		<!--<script src="./js/funcionbuscar.js"></script> -->
		
		<style type="text/css"><!--@import url("./css/gradientegnral.css");-->	</style>
		<link rel="stylesheet" href="./css/jquery-ui.css"/>		
		<script src="./js/jquery-1.9.1.js"></script>
		<script src="./js/jquery-ui.js"></script>	
		<script>
			$(function() {
			$( "#tabs" ).tabs();
			});
		</script>
		<script>
			$(function() {
			$( "#tabs2" ).tabs();
			});
		</script>		
		<script>
			$(function() {
			$( "#tabs3" ).tabs();
			});
		</script>
		<script>
			$(function() {
			$( "#accordion" ).accordion();
			});
		</script>
		<!--Script: Contenido
		
		<script> 
			function enlace(url) 
			{ 	// Quitar alerta cuando se pasen los url de los submenus 
				//alert("Los enlaces para los submenus se pasan en la funcion Enlace() del Javascript");
			
			// La función de abajo habilita el url de los enlaces para los submenus
			// cuando se pasan como parámetros dinámicos a este Javascript
			// HABILITAR cuando se tengan los urls
				ventana.location.href = url;
			} 
		</script>-->

	</head>

	<body class="cbp-spmenu-push">
	
			<!--Barra de Inicio-->
			<div class="container">
			
				<!--Barra Principal-->
				<header class="clearfix">
					<h1>Red Social de Cuidados Paliativos Panam&aacute</h1>
				</header>
				
				<!--Barra de Sesión-->
				<div class="main">
					<div id="barlogged"></div>
				</div>
			</div>
			

			
			<!--Atención Domiciliaria-->
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
				<!--Título: Grupo de Menú-->
				<h3>Menu Atenci&oacuten Domiciliaria</h3>
					<!--Sub-Menú Nivel A-->
					<a href=".?url=registrovisitasdomiciliaria">Registro de Visitas Domiciliarias</a>
						<!--Sub-Menú Nivel B-->
						<ul>
							<li><a href="">Capturar Datos</a></li>
							<li><a href="javascript:enlace('#');">Agenda</a></li>
						</ul>
						
					<a href="#">Registro de Actividades Diarias</a>
					<a href="./?url=domiciliaria_surco">Surco</a>
					<a href="#">Indicadores</a>
					
						<ul>
							<li><a href="javascript:enlace('#');">Total de Visitas Realizadas</a></li>
							<li><a href="javascript:enlace('#');">Tiempo Promedio por Visita</a></li>
							<li><a href="javascript:enlace('#');">N&deg de Visitas x Paciente Seg&uacuten Diagn&oacutestico</a></li>
							<li><a href="javascript:enlace('#');">Activadades Realizadas por Visitas</a></li>
						</ul>
			</nav>
			
			
			<!--Atención Ambulatoria-->
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s2">
				<!--Título: Grupo de Menú-->
				<h3>Menu Atenci&oacuten Ambulatoria</h3>
					<!--Sub-Menú Nivel A-->
					<a href="#">Registro Diario de Actividades </a>
						<!--Sub-Menú Nivel B-->
						<ul>
							<li><a href="./?url=ambulatoria_capturardatos">Capturar Datos</a></li>
							<li><a href="javascript:enlace('#');">Agenda</a></li>
						</ul>
					<a href="">Contacto Telef&oacutenico</a>
						<ul>
							<li><a href="./?url=ambulatoria_atencionalpaciente">Atenci&oacuten al Paciente</a></li>
							<li><a href="javascript:enlace('#');">Interconsulta</a></li>
						</ul>
					<a href="#">Indicadores</a>
						<ul>
							<li><a href="javascript:enlace('#');">Frecuentaci&oacuten P/F a la Instalación</a></li>
							<li><a href="javascript:enlace('#');">Activadades Realizadas por Paciente</a></li>
						</ul>
			</nav>
			
			
			<!--Atención Hospitalaria-->
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s3">
				<!--Título: Grupo de Menú-->
				<h3>Menu Atenci&oacuten Hospitalaria</h3>
					<!--Sub-Menú Nivel A-->
					<a href="#">RAE</a>
						<!--Sub-Menú Nivel B-->
						<ul>
							<li><a href="./?url=hospitalaria_rae_capturardatos">Capturar Datos</a></li>
							<li><a href="./?url=hospitalaria_rae_evolucion">Evoluci&oacuten</a></li>
						</ul>
					<a href="#">Indicadores</a>
						<ul>
							<li><a href="javascript:enlace('#');">Porcentaje de Hospitalizados referidos de Consulta externa</a></li>
							<li><a href="javascript:enlace('#');">Razones de Readmisiones</a></li>
						</ul>
			</nav>
			
			
			<!--Red Social-->
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s4">
			
				<!--Título: Grupo de Menú-->
				<h3>Red Social</h3>
					<a href="#">Mis Grupos</a>
					<a href="#">Comunidades</a>
					<a href="#">Eventos</a>
					<a href="#">Especialistas</a>
			</nav>
			
			<!--Marco del contenido-->
			<div class="contentpanel" >
					
				<?php include_once('./mvc/controlador/controlador.php'); new Controlador();?>
			
			</div>
			

			<!--Menú Principal-->
			<div class="botones">
				
					 <section class="buttonset" style="display: inline; width: 100px; margin-left:0%;">
						<ul style="display: inline;">
							<li style="display: inline;">
								<button id="show1" alt="Atenci&oacuten Domiciliaria">
									<img href="" src="./iconos/atencion_domiciliaria.png" style="width:25%; height:25%;"></img>
								</button>
							</li>
										
							<li style="display: inline;">
								<button id="show2" alt="Atenci&oacuten Ambulatoria" style="float: rigth;">
									<img href="" src="./iconos/atencion_ambulatoria.png" style="width:25%; height:25%;"></img>
								</button>
							</li>
							
							<li style="display: inline;">
								<button id="show3" alt="Atenci&oacuten Hospitalaria" style="float: rigth;">
									<img href="" src="./iconos/atencion_hospitalaria.png" style="width:25%; height:25%;"></img>
								</button>
							</li>
										
							<li style="display: inline;" style="float: rigth;">
								<button id="show4" alt="Red social" style="float: rigth;">
									<img href="" src="./iconos/social.png" style="width:25%; height:25%;"></img>
								</button>
							</li>
						</ul>
					</section>
	
			</div>
			
		
			<!--Pie de página-->
			<div id="footer">
				<img src="../../imgs/gises.png" alt="gises" title="gises" />
				<p>Derechos Reservados 2013-2014</p>
			</div>
			
			<!-- Script Menu-->
			<script src="./js/classie.js"></script>
			<script>
				var menu1 = document.getElementById( 'cbp-spmenu-s1' ),
					menu2 = document.getElementById( 'cbp-spmenu-s2' ),
					menu3 = document.getElementById( 'cbp-spmenu-s3' ),
					menu4 = document.getElementById( 'cbp-spmenu-s4' ),
					showLeft = document.getElementById( 'show1' ),
					showRight = document.getElementById( 'show2' ),
					showTop = document.getElementById( 'show3' ),
					showBottom = document.getElementById( 'show4' ),
					body = document.body;

				showLeft.onclick = function() {
					classie.toggle( this, 'active' );
					classie.toggle( menu1, 'cbp-spmenu-open' );
					disableOther( 'show1' );
				};
				showRight.onclick = function() {
					classie.toggle( this, 'active' );
					classie.toggle( menu2, 'cbp-spmenu-open' );
					disableOther( 'show2' );
				};
				showTop.onclick = function() {
					classie.toggle( this, 'active' );
					classie.toggle( menu3, 'cbp-spmenu-open' );
					disableOther( 'show3' );
				};
				showBottom.onclick = function() {
					classie.toggle( this, 'active' );
					classie.toggle( menu4, 'cbp-spmenu-open' );
					disableOther( 'show4' );
				};
				
				function disableOther( button ) {
					if( button !== 'show1' ) {
						classie.toggle( showLeft, 'disabled' );
					}
					if( button !== 'show2' ) {
						classie.toggle( showRight, 'disabled' );
					}
					if( button !== 'show3' ) {
						classie.toggle( showTop, 'disabled' );
					}
					if( button !== 'show4' ) {
						classie.toggle( showBottom, 'disabled' );
					}
					
				}
			</script>
	</body>
</html>
