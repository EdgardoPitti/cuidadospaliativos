<? SESSION_START();?>
<html>
<head>
	<title>Red Social Cuidados Paliativos</title>
	<style type="text/css"><!--@import url("./css/gradientes.css");-->	</style>
	<style type="text/css"><!--@import url("./css/tabs.css");-->	</style>
	<script src="jquery.js"></script>
	<script src="funciones.js"></script>
	<script src="funcionbuscar.js"></script>
	<script type="text/javascript">
		function tab(pestana,panel){
			pst 	= document.getElementById(pestana);
			pnl 	= document.getElementById(panel);
			psts	= document.getElementById("tabs").getElementsByTagName("li");
			pnls	= document.getElementById("paneles").getElementsByTagName("section");
			// eliminamos las clases de las pesta�as
			for(i=0; i< psts.length; i++){
				psts[i].className = "";
			}	
			// A�adimos la clase "actual" a la pesta�a activa
			pst.className = "actual";
			// eliminamos las clases de las pesta�as
			for(i=0; i< pnls.length; i++){
				pnls[i].style.display = "none";	
			}
			// A�adimos la clase "actual" a la pesta�a activa
			pnl.style.display = "block";
		}
	</script>
</head>
<body class="fdbody">
	<div class="contenedor">
		<header class="sombrahdr">
			<h3>Universidad Tecnol�gica de Panam�</h3>
		</header>
		<!-- ===================================== -->
		
		<?php include_once('./mvc/controlador/controlador.php'); new Controlador();?>
				
		<!-- ===================================== -->
		<!--Pie de P�gina-->
		<footer class="sombraftr">
			<div>
				Pie de P�gina
			</div>
		</footer>
	</div>
</body>
</html>