<?php
	
	$cont='
		<div class="row-fluid" style="margin-top:10px;">
			<div class="span12 margen-login">
				<div style="position:relative"> 
					<div class="row-fluid">
						<img src="./iconos/cuidadospaliativos.jpg" class="img_login">
						<div class="span4 offset8 pos_img-login fondo_login">
							<h3 style="text-align:center">Iniciar Sesi&oacute;n</h3><hr>
							';
	$cont.= $_SESSION['errorlogin'];
	$cont.='
							<form method="POST" action="./?url=verificar" accept-charset="UTF-8" >						
								<center>
									<div class="input-prepend">
									  <span class="add-on"><i class="icon-user"></i></span>
									  <input type="text" id="username" name="username" placeholder="Usuario" required>
									</div><br>
									<div class="input-prepend">
									  <span class="add-on"><i class="icon-lock"></i></span>
									  <input type="password" id="password" name="password" placeholder="Contrase&ntilde;a" required>
									</div>																		
									<div align="center">
										<button type="submit" name="submit" class="btn btn-primary btn-block"><b>Iniciar</b></button>
										<span style="padding-top:5px;float:right;font-size:14px"><a href="./?url=recuperar_acceso">&iquest;Olvidaste la Contrase&ntilde;a?</a></span>
									</div>
								</center>
							</form>    
						</div>
					</div>
				</div>
			</div>
		</div>';

	echo $cont;
?>