<?php
	$_SESSION['idu'] = '';
	$cont='
		<div class="row-fluid" style="margin-top:10px;">
			<div class="span12 margen-login">
				<div style="position:relative"> 
					<div class="row-fluid">
						<img src="./iconos/cuidadospaliativos.jpg" class="img_login">
						<div class="span5 offset7 well pos_img-login" style="max-height:300px;padding-top:30px;">
							<h3 style="text-align:center">Iniciar Sesi&oacute;n</h3><hr>
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
													<td style="padding-top:12px">Contrase&ntilde;a:</td>
													<td><input type="password" id="password" name="password" required></td>
												</tr>
											</table>
										</div>
									</div>		
								</center>
								<button type="submit" name="submit" class="btn btn-primary btn-block"><b>Iniciar</b></button>
							</form>    
						</div>
					</div>
				</div>
			</div>
		</div>';
	$_SESSION['errorlogin'] = '';
	echo $cont;
?>