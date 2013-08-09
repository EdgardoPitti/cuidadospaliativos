<html>
<head>
<title>CSS Tabs</title>
	<style type="text/css"><!--@import url("./css/tabs.css");--></style>
</head>
<body>
	<script type="text/javascript">
		function tab(pestana,panel){
			pst 	= document.getElementById(pestana);
			pnl 	= document.getElementById(panel);
			psts	= document.getElementById("tabs").getElementsByTagName("li");
			pnls	= document.getElementById("paneles").getElementsByTagName("section");
			// eliminamos las clases de las pestañas
			for(i=0; i< psts.length; i++){
				psts[i].className = "";
			}	
			// Añadimos la clase "actual" a la pestaña activa
			pst.className = "actual";
			// eliminamos las clases de las pestañas
			for(i=0; i< pnls.length; i++){
				pnls[i].style.display = "none";	
			}
			// Añadimos la clase "actual" a la pestaña activa
			pnl.style.display = "block";
		}
	</script>
	<div id="panel">
		<ul id="tabs">
			<li id="tab_01"><a href="#" onclick="tab('tab_01','panel_01');">Referencia</a></li>
			<li id="tab_02"><a href="#" onclick="tab('tab_02','panel_02');">Respuesta a la Referencia</a></li>
		</ul>
		<div id="paneles">
			<section id="panel_01" class="acordeon">
				<div>
					<input type="radio" id = "de-1" checked name="rb">
						<label for="de-1">Datos de Referencia</label>
					</input>
					<article class="tab-height1">
						1
					</article>								
				</div>
				<div>
					<input type="radio" id = "de-2" name="rb">
						<label for="de-2">Historial del Paciente</label>
					</input>
					<article class="tab-height1">
						2
					</article>
				</div>
				<div>
					<input type="radio" id = "de-3" name="rb">
						<label for="de-3">Resultados de Exámenes/Diagnóstico</label>
					</input>
					<article class="tab-height">
						<!-- Segunda Pestaña -->
						<div class="contenedor-tabs">
							<span class="diana" id="bhc"></span>
								<div class="tab">
									<a href="#bhc" class="tab-e">BHC</a>
									<div>
										
									</div>
								</div>
							<span class="diana" id="urin"></span>
								<div class="tab">
									<a href="#urin" class="tab-e">Urin</a>
									<div>
									
									</div>
								</div>
							<span class="diana" id="hec"></span>
								<div class="tab">
									<a href="#hec" class="tab-e">Heces</a>
									<div>
									
									</div>
								</div>							
							<span class="diana" id="glic"></span>
								<div class="tab">
									<a href="#glic" class="tab-e">Glicemia</a>
									<div>
										
									</div>
								</div>							
							<span class="diana" id="creat"></span>
								<div class="tab">
									<a href="#creat" class="tab-e">Creatinina</a>
									<div>
						
									</div>
								</div>							
							<span class="diana" id="ndeu"></span>
								<div class="tab">
									<a href="#ndeu" class="tab-e">N de U</a>
									<div>
									
									</div>
								</div>							
							<span class="diana" id="elect"></span>
								<div class="tab">
									<a href="#elect" class="tab-e">Electrolitos</a>
									<div>
									
									</div>
								</div>							
							<span class="diana" id="amil"></span>
								<div class="tab">
									<a href="#amil" class="tab-e">Amilasa</a>
									<div>
									
									</div>
								</div>
						</div>
						<!-- Fin de Segunda Pestaña-->
					</article>
				</div>
				<div>
					<input type="radio" id = "de-4" name="rb">
						<label for="de-4">Datos del Profesional</label>
					</input>
					<article class="tab-height1">
						4
					</article>
				</div>
			</section>
			<section id="panel_02">Opción     2</section>
		</div>
		<!-- Script para marcar el primer tab seleccionado de la 1era pestaña-->
		<script type="text/javascript">
			tab("tab_01","panel_01");
		</script>
	</div>
	<!--Fin del Contenido-->
</body>
</html>