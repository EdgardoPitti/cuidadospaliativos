<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$ds = new Diseno();
	$paciente = new Accesatabla('datos_pacientes');
	
	$cedula = $_POST['buscar'];
	$sw = $_GET['sw'];
	$dato_paciente = $paciente->buscardonde('NO_CEDULA = "'.$cedula.'"');
	if(empty($dato_paciente) AND $sw == 1){
			$msj = 'Paciente no Encontrado';
	}else{
			if(!empty($dato_paciente)){
				$paciente->buscardonde('NO_CEDULA = "'.$cedula.'"');
				echo '<script>location.href="./?url=menu_categorias&id='.$paciente->obtener('ID_PACIENTE').'";</script>';	
			}
	}
	if($_SESSION['terminos'] ==  0){
		echo '
					<!-- Modal -->
					<div class="modal modal-width fade" id="info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header modal-header-info">
									<h3><i class="glyphicon glyphicon-thumbs-up"></i> T&eacute;rminos y Condiciones</h3>
								</div>
								<div class="modal-body">
										<center>
											<strong><h4>NORMAS DE CONFIDENCIALIDAD DEL PROGRAMA DE GESTI&Oacute;N DE PACIENTES EN CUIDADOS PALIATIVOS</h4></strong><br>
										</center>
										
										<div class="row-fluid" align="justify">
											<div class="span12" style="padding:0px 20px;">
										
												La gesti&oacute;n de los pacientes que est&aacute;n en el programa de cuidados paliativos mediante un software en nube implica la recogida, almacenamiento y posterior utilizaci&oacute;n de la informaci&oacute;n para su an&aacute;lisis o para la realizaci&oacute;n de estudios espec&iacute;ficos. La existencia de algunas variables, fundamentalmente las relativas a la salud, obliga que estos datos, deben estar especialmente protegidos. El Programa de Gesti&oacute;n de Pacientes en Cuidados Paliativos debe mantener y garantizar la confidencialidad absoluta de su contenido, tanto durante su funcionamiento habitual como en la presentaci&oacute;n de resultados.<br><br>
												
												Por otro lado, la informaci&oacute;n es generada dentro de la pr&aacute;ctica asistencial y, por tanto, sometida a las mismas normas de confidencialidad que las fuentes de donde procede, seg&uacute;n lo estipulado en la Ley 68 del 20 de noviembre de 2003, que REGULA LOS DERECHOS Y OBLIGACIONES DE LOS PACIENTES, EN MATERIA DE INFORMACI&Oacute;N LIBRE E INFORMADA en su Art&iacute;culo 13 Y 14 (Ver anexos).<br><br>
												
												<ol style="padding-left: 20px;">
													<strong><li style="list-style-type:decimal;">Responsabilidades.</li></strong><br>

														El Coordinador T&eacute;cnico del Programa de Gesti&oacute;n de Pacientes en Cuidados Paliativos es el responsable de garantizar la confidencialidad de la informaci&oacute;n del mismo, as&iacute; como de la autorizaci&oacute;n del uso de la misma por personal m&eacute;dico, medios de comunicaci&oacute;n y otros usuarios.
														
														<ul style="padding-left: 30px;">
															<li style="list-style-type:upper-latin;">El Coordinador T&eacute;cnico del Programa de Gesti&oacute;n de Pacientes en Cuidados Paliativos debe tener una lista de las personas o funcionarios que pueden tener acceso al uso del Software y con que grado de permisos de acceso y modificaci&oacute;n de la Informaci&oacute;n.</li>

															<li style="list-style-type:upper-latin;">El Administrador del Programa autorizar&aacute; a las personas los permisos para el acceso a los m&oacute;dulos, con claves que estos personalizar&aacute;n, garantizando el cumplimiento de las normas de confidencialidad establecidas. Ser&aacute; tambi&eacute;n responsable de implementar todas las capas de seguridad requeridas para mantener el el tiempo la data recogida y garantizar su mantenimiento en el tiempo, en servidores seguros y con las medidas requeridas contra hackers y virus inform&aacute;ticos.</li>

															<li style="list-style-type:upper-latin;">El Coordinador T&eacute;cnico del Programa de Gesti&oacute;n de Pacientes en Cuidados Paliativos se responsabilizar&aacute; del llenado y firma del Informe de Consentimiento de confidencialidad de los funcionarios que utilicen el software.</li>
														</ul><br>

													<strong><li style="list-style-type:decimal;">Protecci&oacute;n al acceso del Sistema Automatizado.</li></strong><br>

														Se establecen los controles de acceso al equipo y a la informaci&oacute;n, tomando en cuenta los siguientes aspectos:

														<ul style="padding-left: 30px;">
															<li style="list-style-type:upper-latin;">Cada funcionario autorizado, debe tener identificaci&oacute;n de usuario y contrase&ntilde;a personal para tener acceso al programa y a la informaci&oacute;n.</li>

															<li style="list-style-type:upper-latin;">A trav&eacute;s del sistema inform&aacute;tico se deben garantizar las llaves de seguridad para la confidencialidad para que la informaci&oacute;n, una vez capturada, no pueda ser modificada, eliminada, por personas ajenas a la red de cuidados paliativos.</li>

															<li style="list-style-type:upper-latin;">Se debe mantener un respaldo de la base de datos almacenada en otra estructura f&iacute;sica como una medida de seguridad contra eventos adversos.</li>

															<li style="list-style-type:upper-latin;">Para demostraciones del Programa y en las capacitaciones para el uso del mismo, se deben utilizar datos ficticios, para guardar la identidad y confidencialidad de la informaci&oacute;n de los pacientes.</li>

															<li style="list-style-type:upper-latin;">Se tendr&aacute; establecido un control estricto de las personas que puedan tener acceso a los datos de identificaci&oacute;n personal de los pacientes.</li>
														</ul><br>

													<strong><li style="list-style-type:decimal;">Protecci&oacute;n de los datos utilizados por el GISES.</li></strong><br>
													
														<ul style="padding-left: 30px;">
															<li style="list-style-type:upper-latin;">El GISES debe tener una lista de las personas o funcionarios que van a tener acceso al intercambio de la informaci&oacute;n generada por el Programa de Gesti&oacute;n de pacientes en cuidados paliativos.</li>

															<li style="list-style-type:upper-latin;">El GISES debe contar con las claves de acceso (nombre de usuario y contrase&ntilde;a) para trabajar la informaci&oacute;n generada.</li>
														</ul><br>

													<strong><li style="list-style-type:decimal;">Acuerdos de confidencialidad del personal de salud que utilice el Programa</li></strong><br>

														El Programa de Gesti&oacute;n de pacientes en cuidados paliativos contar&aacute; con su propio Informe de Consentimiento on line que deber&aacute; ser llenado al momento que utilizarlo por primera vez para garantizar la confidencialidad del manejo y uso de la informaci&oacute;n.
														
														<ul style="padding-left: 30px;">
															<li style="list-style-type:upper-latin;">Los funcionarios deben firmar adem&aacute;s en f&iacute;sico (documento impreso) un acuerdo de confiabilidad que garantice la reserva o confidencialidad de los datos y debe ser renovado en un tiempo estipulado por las autoridades (cada 3 a&ntilde;os). Este acuerdo se mantiene aun cuando cese sus labores o deje de utilizar el Programa.</li>
														</ul><br>

													<strong><li style="list-style-type:decimal;">Acuerdos de confidencialidad del personal que labora en inform&aacute;tica.</li></strong></br>

														<ul style="padding-left: 30px;">
															<li style="list-style-type:upper-latin;">Los funcionarios de la Unidad de Inform&aacute;tica deben firmar igualmente el acuerdo de confiabilidad que garantice la reserva o confidencialidad de los datos. Este documento va a ser firmado y podr&aacute; ser renovado en un tiempo estipulado por las autoridades (cada 3 a&ntilde;os). Este acuerdo se mantiene aun cuando cese sus labores.</li>
														</ul>
												</ol>
											</div><br>
											<label class="checkbox pull-right" style="padding-right:20px;">
												<h4><input type="checkbox" id="acepto" name="acepto" onClick="Habilita()"> He le&iacute;do y acepto los T&eacute;rminos y Condiciones.</h4>
											</label>
										</div>
								</div>
								<div class="modal-footer">
									<form method="POST" action="./?url=termino&id='.$_SESSION['idu'].'">
										<button id="boton" type="submit" class="btn btn-default pull-right" disabled="disabled">Continuar</button>
										<a class="btn btn-link pull-left" href="./?url=logout">Cerrar Sesi&oacute;n</a>
									</form>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<!-- Modal -->
					<script>
						$(function(){							
							$("#info").modal({
								show: true,
								backdrop: "static",
								keyboard: false
							});
						});
						function Habilita(){
							var boton = document.getElementById("boton");
							if(boton.disabled == true){
								boton.disabled = false;
							}else{
								boton.disabled = true;
							}
						}
					</script>
					';
					
	}
	$cont = '<center>
				<div class="row-fluid margin-inicio" sty le="margin-top:130px;">
					<div class="span12">
						<h2 style="color:#0066CC;line-height:50px">Bienvenido al Sistema de Gesti&oacute;n de Cuidados Paliativos de Panam&aacute;</h2>	
					';
	if($_SESSION['idgu'] == 5){
		$cont.='	<br>
						<form class="form-search" method="POST" action="./?url=inicio&sw=1">
							<div style="color:red;">'.$msj.'</div>
							<div class="input-group">
								<table>
					  				<tr align="center">
					  					<td>Introduzca nombre o c&eacute;dula del Paciente</td>
					  				</tr>
					  				<tr align="center">
					  					<td><input type="search" class="form-control" placeholder="Nombre o C&eacute;dula" name="buscar" id="busqueda"><button class="btn-orange" type="submit"><img src="./iconos/search.png"/></button></td>
						  			</tr>
						  		</table>			  			
						  	</div>			    
						</form>
						<a href="./?url=nuevopaciente&sw=1" class="btn btn-primary">A&ntilde;adir Paciente</a>
		';
	}else{
		$cont.=' <small style="color:#a3a3a3;font-size:18px;text-shadow:1px 0px 0px #d3d3d3;">Seleccione de la barra inferior la categor&iacute;a a la que desea acceder.</small>	';
	}
	$cont.='		
					</div>
				</div>		
			</center>';
	$horas = '8';
	$minutos = '00';
	$s = 'AM';
	$sw = 0;
	for($x=0;$x<20;$x++){
		if($horas < 10){
			$cero = '0';
		}else{
			$cero = '';
		}
		if($horas == 12 AND $minutos == 00){
			$s = 'MD';
		}else{
			if($horas == 12 AND $minutos == 30){
				$s = 'PM';
			}
		}
		$hora = ''.$cero.''.$horas.':'.$minutos.' '.$s.'';
		$_SESSION['hora_'.$x.''] = $hora;
		if($sw == 1){
			if($minutos == 30){
				$horas++;
			}
			$minutos = '00';
			$sw = 0;
		}else{
			$minutos = 30;
			$sw = 1;
		}
		if($horas > 12){
			$horas = 1;
			$s = 'PM';
		}
	}
	$ds->contenido($cont);
	$ds->mostrar();
?>
