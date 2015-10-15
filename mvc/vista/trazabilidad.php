<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$sesiones = new Accesatabla('sesiones_usuarios');
	$usuarios = new Accesatabla('usuarios');
	$cont.='
			<center>
				<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Trazabilidad de Usuarios</h3>
				<div class="overflow overthrow" style="max-height:300px;overflow-y:auto;">
					<table class="table2 borde-tabla table-hover" id="camas">
						<thead>
							<tr class="fd-table">
								<th>#</th>
								<th>Usuario</th>
								<th>Fecha/Hora de Sesi&oacute;n</th>
								<th>Ip de Ingreso</th>
							</tr>
						</thead>
						<tbody>
						';
	$c = $sesiones->buscardonde('ID_SESION > 0 ORDER BY ID_SESION DESC');
	$n = 1;
	while($c){
		$usuarios->buscardonde('ID_USUARIO = '.$sesiones->obtener('ID_USUARIO').'');
		$cont.='
							<tr>
								<td><strong>'.$n.'</strong></td>
								<td>'.$usuarios->obtener('NO_IDENTIFICACION').'</td>
								<td>'.$sesiones->obtener('FECHA_SESION').'</td>
								<td>'.$sesiones->obtener('IP_USUARIO').'</td>
							</tr>
		';
		$n++;
		$c = $sesiones->releer();
	}
	
	$cont.='
						</tbody>
					</table>
				</div>';
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>