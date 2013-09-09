<? SESSION_START();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<head>	
		<meta content="text/html; charset=utf-8" />
		<title>Cuidados Paliativos</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="./js/modernizr.custom.js"></script>
		<link rel="shortcut icon" href="./favicon.ico" />
		
	<!--CSS: Menú Principal-->	
	
	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/js nuevos/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	
		<style type="text/css"><!--@import url("./css/gradientegnral.css");-->	</style>
		<link rel="stylesheet" href="./css/jquery-ui.css"/>	
		
		<script src="./js/jquery.js"></script>
		<script src="./js/funciones.js"></script>
		<script src="./js/funcionbuscar.js"></script>
		<script type="text/javascript" src="js/js nuevos/jquery.min.js"></script>
		<script type="text/javascript" src="js/js nuevos/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/js nuevos/scripts.js"></script>		
		<script src="./js/jquery-1.9.1.js"></script>
		<script src="./js/jquery-ui.js"></script>	
		
		<!--<link  rel="stylesheet" href="./jquery-ui-1.10.3.custom/development-bundle/demos/demos.css"/>-->
	
	 <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	  <!--[if lt IE 9]>
		<script src="js/js nuevos/html5shiv.js"></script>
	  <![endif]-->	
	  
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
			$( "#accordion" ).accordion();
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

	<body> <!--class="cbp-spmenu-push"--> 
	
			<!--Barra de Inicio--
			<div class="container">
			
				<!--Barra Principal--
				<header class="clearfix">
					<h1>Red Social de Cuidados Paliativos Panam&aacute</h1>
				</header>
				
				<!--Barra de Sesión--
				<div class="main">
					<div id="barlogged">Bienvenido</div>
				</div>
			</div>
			
			
			<!--Atención Domiciliaria--
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
				<!--Título: Grupo de Menú--
				<h3>Menu Atenci&oacuten Domiciliaria</h3>
					<!--Sub-Menú Nivel A--
					<a href=".?url=registrovisitasdomiciliaria">Registro de Visitas Domiciliarias</a>
						<!--Sub-Menú Nivel B--
						<ul>
							<li><a href="./?url=domiciliaria_capturardatos">Capturar Datos</a></li>
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
			
			<!--Atención Ambulatoria--
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s2">
				<!--Título: Grupo de Menú--
				<h3>Menu Atenci&oacuten Ambulatoria</h3>
					<!--Sub-Menú Nivel A--
					<a href="#">Registro Diario de Actividades </a>
						<!--Sub-Menú Nivel B--
						<ul>
							<li><a href="javascript:enlace('#');">Capturar Datos</a></li>
							<li><a href="javascript:enlace('#');">Agenda</a></li>
						</ul>
					<a href="#">Contacto Telef&oacutenico</a>
						<ul>
							<li><a href="javascript:enlace('#');">Atenci&oacuten al Paciente</a></li>
							<li><a href="javascript:enlace('#');">Interconsulta</a></li>
						</ul>
					<a href="#">Indicadores</a>
						<ul>
							<li><a href="javascript:enlace('#');">Frecuentaci&oacuten P/F a la Instalación</a></li>
							<li><a href="javascript:enlace('#');">Activadades Realizadas por Paciente</a></li>
						</ul>
			</nav>
			
			<!--Atención Hospitalaria--
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s3">
				<!--Título: Grupo de Menú--
				<h3>Menu Atenci&oacuten Hospitalaria</h3>
					<!--Sub-Menú Nivel A--
					<a href="#">RAE</a>
						<!--Sub-Menú Nivel B--
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
			
			<!--Red Social--
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s4">
			
				<!--Título: Grupo de Menú--
				<h3>Red Social</h3>
					<a href="#">Mis Grupos</a>
					<a href="#">Comunidades</a>
					<a href="#">Eventos</a>
					<a href="#">Especialistas</a>
			</nav>
			
			<!--Marco del contenido--
			<div class="contentpanel" >
				
			</div>

			<!--Menú Principal--
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
			
			<!--Pie de página--
			<div id="footer">
				<img src="../../imgs/gises.png" alt="gises" title="gises" />
				<p>Derechos Reservados 2013-2014</p>
			</div>
			
			<!-- Script Menu--
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
			</script>-->
			
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="page-header">
						<h1>
							Red Social de Cuidados Paliativos Panam&aacute;
						</h1>
					</div>
				</div>
			</div>
			
			
			
			
			<div class="row-fluid">
				<!--Aside-->
				<div class="span2">
					<!--DOMICILIARIA-->
					<div class="accordion" id="mostrar_ocultar1" id="accordion-1" style="display:none;">
						<h3>Men&uacute; Atenci&oacute;n Domiciliaria</h3><hr>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#accordion-element-603066"><b>Registro de Visitas Domiciliarias</b></a>
							</div>
							<div id="accordion-element-603066" class="accordion-body in collapse">
								<div class="accordion-inner">
									<a href="./?url=domiciliaria_capturardatos"><i style="font-size:1.1em; font-weight:bold;">Capturar Datos</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">Agenda</i></a>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-inner" style="border: 1px solid #258ECD;">
								<a href="#"><b style="font-size:1.2em;">Registro de Actividades Diarias</b></a>
							</div>
							<div class="accordion-inner" style="border: 1px solid #258ECD;margin-top:2px;">
								<a href="./?url=domiciliaria_surco"><b style="font-size:1.2em;">Surco</b></a>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#accordion-element-229392"><b>Indicadores</b></a>
							</div>
							<div id="accordion-element-229392" class="accordion-body collapse">
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">Total de Visitas Realizadas</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">Tiempo Promedio por Visita</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">N&deg de Visitas x Paciente Seg&uacute;n Diagn&oacute;stico</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">Activadades Realizadas por Visitas</i></a>
								</div>
							</div>
						</div>
					</div>
					
					<!--AMBULATORIA-->
					<div class="accordion" id="mostrar_ocultar2" id="accordion-2"  style="display:none">
						<h3>Men&uacute; Atenci&oacute;n Ambulatoria</h3><hr>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-element-603067"><b>Registro Diario de Actividades </b></a>
							</div>
							<div id="accordion-element-603067" class="accordion-body in collapse">
								<div class="accordion-inner">
									<a href="./?url=ambulatoria_capturardatos"><i style="font-size:1.1em; font-weight:bold;">Capturar Datos</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">Agenda</i></a>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-element-603068"><b>Contacto Telef&oacute;nico</b></a>
							</div>
							<div id="accordion-element-603068" class="accordion-body in collapse">
								<div class="accordion-inner">
									<a href="./?url=ambulatoria_atencionalpaciente"><i style="font-size:1.1em; font-weight:bold;">Atenci&oacute;n al Paciente</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">Interconsulta</i></a>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-element-229393"><b>Indicadores</b></a>
							</div>
							<div id="accordion-element-229393" class="accordion-body collapse">
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">Frecuentaci&oacuten P/F a la Instalaci&oacute;n</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">Activadades Realizadas por Paciente</i></a>
								</div>
							</div>
						</div>
					</div>
					
					<!--HOSPITALARIA-->
					<div class="accordion" id="mostrar_ocultar3" id="accordion-3" style="display:none">
						<h3>Men&uacute; Atenci&oacute;n Hospitalaria</h3><hr>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-3" href="#accordion-element-603069"><b>RAE</b></a>
							</div>
							<div id="accordion-element-603069" class="accordion-body in collapse">
								<div class="accordion-inner">
									<a href="./?url=hospitalaria_rae_capturardatos"><i style="font-size:1.1em; font-weight:bold;">Capturar Datos</i></a>
								</div>
								<div class="accordion-inner">
									<a href="./?url=hospitalaria_rae_evolucion"><i style="font-size:1.1em; font-weight:bold;">Evoluci&oacute;n</i></a>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-3" href="#accordion-element-229394"><b>Indicadores</b></a>
							</div>
							<div id="accordion-element-229394" class="accordion-body collapse">
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">Porcentaje de Hospitalizados referidos de Consulta externa</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;">Razones de Readmisiones</i></a>
								</div>
							</div>
						</div>
					</div>
				
					
					<!--RED SOCIAL-->
					<div class="accordion" id="mostrar_ocultar4" style="display:none" >
						<h3>Red Social</h3><hr>
						<div class="accordion-group">
							<div class="accordion-body">
								<div class="accordion-inner">
									<a href="#"><b style="font-size:1.2em;">Mis Grupos</b></a>
								</div>	
								<div class="accordion-inner">
									<a href="#"><b style="font-size:1.2em;">Comunidades</b></a>
								</div>
								<div class="accordion-inner">	
									<a href="#"><b style="font-size:1.2em;">Eventos</b></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><b style="font-size:1.2em;">Especialistas</b></a>
								</div>
							</div>
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
								<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar collapsed"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> <a href="#" class="brand">Atenciones</a>
								<div class="nav-collapse navbar-responsive-collapse collapse">
									<ul class="nav">
										<li class="">
											<a href="#" id="show1"><img src="./iconos/atencion_domiciliaria.png"style="width:30px; heigth:30px;"/> Domiciliaria</a>
										</li>
										<li class="">
											<a href="#" id="show2"><img src="./iconos/atencion_ambulatoria.png" style="width:30px; heigth:30px;"/> Ambulatoria</a>
										</li>
										<li class="">
											<a href="#" id="show3"><img src="./iconos/atencion_hospitalaria.png" style="width:30px; heigth:30px;"/> Hospitalaria</a>
										</li>
										<li class="">
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
						Derechos Reservados 2013-2014
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
