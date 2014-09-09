<?php
	include_once('./mvc/modelo/diseno.php');
	include_once('./mvc/modelo/Accesatabla.php');
	$ds = new Diseno();
	$paciente = new Accesatabla('datos_pacientes');
	
	$cedula = $_POST['buscar'];
	$sw = $_GET['sw'];
	if(empty($paciente->buscardonde('NO_CEDULA = "'.$cedula.'"')) AND $sw == 1){
			$msj = 'Paciente no Encontrado';
	}else{
			if(!empty($paciente->buscardonde('NO_CEDULA = "'.$cedula.'"'))){
				$paciente->buscardonde('NO_CEDULA = "'.$cedula.'"');
				echo '<script>location.href="./?url=menu_categorias&id='.$paciente->obtener('ID_PACIENTE').'";</script>';	
			}
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
