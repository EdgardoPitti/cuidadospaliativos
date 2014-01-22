<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	$cont='
		<div style="position:relative"> 
			<img src="./iconos/cuidadospaliativos.jpg" style="width:1500px;height:100%">
			<div class="row-fluid">
				<div class="span4 offset8 well" style="position:absolute;right:80px;top:100px;opacity:0.9;">
					<legend>Iniciar Sesión</legend>
					<div class="alert alert-error">
						<a class="close" data-dismiss="alert" href="#">×</a>Usuario o Contraseña Incorrecto!
					</div>
					<form method="POST" action="./?url=verificar" accept-charset="UTF-8" >						
						<center>
							<div class="row-fluid">
								<div class="span10">
									<table class="tabla-datos">
										<tr>
											<td>Usuario:</td> 
											<td><input type="text" id="username" name="username"></td>
										</tr>
									</table>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span10">
									<table class="tabla-datos">
										<tr>
											<td>Contraseña:</td> 
											<td><input type="password" id="password" name="password"></td>
										</tr>
									</table>
								</div>
							</div>
																
						</center>
						<button type="submit" name="submit" class="btn btn-success btn-block"><b>Iniciar</b></button>
					</form>    
				</div>
			</div>
		</div>';
				
	$ds->contenido($cont);
	$ds->mostrar();
?>