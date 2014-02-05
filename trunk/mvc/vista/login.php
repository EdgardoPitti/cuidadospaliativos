<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$_SESSION['idu'] = '';
	$cont='
		<div style="position:relative"> 
			<div class="row-fluid">
				<img src="./iconos/cuidadospaliativos.jpg" class="img_login" style="height:auto;">
				<div class="span5 offset7 well pos_img-login">
					<h3 style="text-align:center">Iniciar Sesión</h3><hr>
					'.$_SESSION['errorlogin'].'
					<form method="POST" action="./?url=verificar" accept-charset="UTF-8" >						
						<center>
							<div class="row-fluid">
								<div class="span12">
									<table class="table" width="50%">
										<tr align="center">	
											<td style="padding-top:12px">Usuario:</td>
											<td><input type="text" id="username" name="username" required></td>
										</tr>
										<tr align="center">
											<td style="padding-top:12px">Contraseña:</td>
											<td><input type="password" id="password" name="password" required></td>
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
	$_SESSION['errorlogin'] = '';
	$ds->contenido($cont);
	$ds->mostrar();
?>