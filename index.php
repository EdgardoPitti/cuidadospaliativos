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
	<link href="css/gradientes.css" rel="stylesheet">
	
		<style type="text/css"><!--@import url("./css/gradientegnral.css");-->	</style>
		<link rel="stylesheet" href="./css/jquery-ui.css"/>	
		
		<script src="./js/jquery.js"></script>
		<script src="./js/funciones.js"></script>
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
			$(function(){
				$("#tabs3").tabs();
			});
		</script>
		<script>
			$(function() {
			$( "#accordion" ).accordion();
			});
		</script>
		<script>
			$(function() {
			$( "#accordion2" ).accordion();
			});
		</script>
		<script>
			$(function() {
			$( "#accordion4" ).accordion();
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
						<h1>
							Red Social de Cuidados Paliativos Panam&aacute;
						</h1>
					</div>
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="span12">					
					<!--Nav-->
					<div class="navbar" style="margin-bottom:5px;">
						<div class="navbar-inner">
							<div class="container-fluid">
								<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar collapsed"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a href="#" class="brand">Bienvenido</a>
								<div class="nav-collapse navbar-responsive-collapse collapse">									
									<ul class="nav pull-right">
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
									</ul>
								</div>
							</div>
						</div>
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
									<a href="./?url=domiciliaria_capturardatos"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Capturar Datos</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Agenda</i></a>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-inner" style="background-color:#afdefa;border: 1px solid #258ECD;">
								<a href="#"><b style="font-size:1.2em;">Registro de Actividades Diarias</b></a>
							</div>
							<div class="accordion-inner" style="background-color:#afdefa;border: 1px solid #258ECD;margin-top:2px;">
								<a href="./?url=domiciliaria_surco"><b style="font-size:1.2em;">Surco</b></a>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#accordion-element-229392"><b>Indicadores</b></a>
							</div>
							<div id="accordion-element-229392" class="accordion-body collapse">
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Total de Visitas Realizadas</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Tiempo Promedio por Visita</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">N&deg de Visitas x Paciente Seg&uacute;n Diagn&oacute;stico</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Activadades Realizadas por Visitas</i></a>
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
									<a href="./?url=ambulatoria_capturardatos"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Capturar Datos</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Agenda</i></a>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-element-603068"><b>Contacto Telef&oacute;nico</b></a>
							</div>
							<div id="accordion-element-603068" class="accordion-body in collapse">
								<div class="accordion-inner">
									<a href="./?url=ambulatoria_atencionalpaciente"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Atenci&oacute;n al Paciente</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Interconsulta</i></a>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-element-229393"><b>Indicadores</b></a>
							</div>
							<div id="accordion-element-229393" class="accordion-body collapse">
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Frecuentaci&oacuten P/F a la Instalaci&oacute;n</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Activadades Realizadas por Paciente</i></a>
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
									<a href="./?url=hospitalaria_rae_capturardatos"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Capturar Datos</i></a>
								</div>
								<div class="accordion-inner">
									<a href="./?url=hospitalaria_rae_evolucion"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Evoluci&oacute;n</i></a>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-3" href="#accordion-element-229394"><b>Indicadores</b></a>
							</div>
							<div id="accordion-element-229394" class="accordion-body collapse">
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Porcentaje de Hospitalizados referidos de Consulta externa</i></a>
								</div>
								<div class="accordion-inner">
									<a href="#"><i style="font-size:1.1em; font-weight:bold;padding-left:10px;">Razones de Readmisiones</i></a>
								</div>
							</div>
						</div>
					</div>
				
					
					<!--RED SOCIAL-->
					<div class="accordion" id="mostrar_ocultar4" style="display:none" >
						<h3>Red Social</h3><hr>
						<div class="accordion-group">
							<div class="accordion-body">
								<div class="accordion-inner" style="background-color:#afdefa;border: 1px solid #258ECD;">
									<a href="#"><b style="font-size:1.2em;">Mis Grupos</b></a>
								</div>	
								<div class="accordion-inner" style="background-color:#afdefa;border: 1px solid #258ECD;margin-top:2px;">
									<a href="#"><b style="font-size:1.2em;">Comunidades</b></a>
								</div>
								<div class="accordion-inner" style="background-color:#afdefa;border: 1px solid #258ECD;margin-top:2px;">	
									<a href="#"><b style="font-size:1.2em;">Eventos</b></a>
								</div>
								<div class="accordion-inner" style="background-color:#afdefa;border: 1px solid #258ECD;margin-top:2px;">
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
						<b>Derechos Reservados 2013-2014</b>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
