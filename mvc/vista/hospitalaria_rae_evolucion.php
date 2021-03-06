<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$paciente = new Accesatabla('datos_pacientes');
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$provincias = new Accesatabla('provincias');
	$referido = new Accesatabla('referido');
	$responsable = new Accesatabla('responsable_paciente');
	$condicionsalida = new Accesatabla('condicion_salida');
	$cama = new Accesatabla('cama');
	$sala = new Accesatabla('sala');
	$motivo = new Accesatabla('motivo_salida');
	$rae = new Accesatabla('registro_admision_egreso');
	$detalle_adm = new Accesatabla('detalle_diagnostico_admision');
	$detalle_egr = new Accesatabla('detalle_diagnostico_egreso');
	$cie = new Accesatabla('cie10');
	$profesional = new Accesatabla('datos_profesionales_salud');
	
	$sbm = $_GET['sbm'];

	$buscar = $_POST['buscar'];
	$idpaciente = $_GET['id'];
	$sw = 0;
	$cont.='
	    <center>
			<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;">Registro de Admisi�n-Egreso (RAE)</h3>
		</center>
			<center>
				<form class="form-search" method="POST" action="./?url=hospitalaria_rae_evolucion&sbm='.$sbm.'">
					<div class="input-group">
					  Buscar paciente: <input type="search" class="form-control" placeholder="C�dula" name="buscar" id="busqueda">
					  <span class="input-group-btn">
						<button class="btn btn-default" type="submit"><img src="./iconos/search.png"/></button>
					  </span>
					</div>
				</form>
			</center>
	  ';
	if(!empty($buscar)){
		if(!$paciente->buscardonde('NO_CEDULA = "'.$buscar.'"')){
			$sw = 1;
		}
	}
	if((empty($buscar) or $sw == 1) and empty($idpaciente)){
		if($sw == 1){
			$cont.='<center>
						<a href="./?url=nuevopaciente&sbm=5">Paciente no Encotrado...A&ntilde;adir</a>
					</center>
			';
		}
		
	}else{
		
		if(!empty($idpaciente)){
			$personas->buscardonde('ID_PACIENTE = '.$idpaciente.'');
		}else{
			$personas->buscardonde('NO_CEDULA = "'.$buscar.'"');
			$idpaciente = $personas->obtener('ID_PACIENTE');
		}
		if(!$responsable->buscardonde('ID_PACIENTE = '.$personas->obtener('ID_PACIENTE').'')){
		$cont.='	
			<form id="form" method="POST" action="./?url=agregardatospaciente&id='.$personas->obtener('ID_PACIENTE').'&sw=1&sbm='.$sbm.'">
				<fieldset>
					<legend>
						Responsable del Paciente
					</legend>
					
					<div class="row-fluid">
						<div class="span6">
							<table class="table">
								<tbody>
									<tr>
										<td style="text-align:left;padding-left:17%;">Nombre:</td>														
									</tr>
									<tr>
										<td><input type="text" id="nombreresponsable" name="nombreresponsable" placeholder="Nombre del Responsable" required></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="span6">
							<table class="table">
								<tbody>
									<tr>
										<td style="text-align:left;padding-left:17%;">Apellido:</td>	
									</tr>
									<tr>
										<td><input type="text" id="apellidoresponsable" name="apellidoresponsable" placeholder="Apellido del Responsable" required></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="span6">
							<table class="table">
								<tbody>
									<tr>
										<td style="text-align:left;padding-left:17%;">Parentesco:</td>
									</tr>	
									<tr>	
										<td><input type="text" id="parentesco" name="parentesco" placeholder="Parentesco" required></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="span6">
							<table class="table">
								<tbody>
									<tr>
										<td style="text-align:left;padding-left:17%;">Direcci�n:</td>
									</tr>
									<tr>
										<td><textarea class="textarea" id="direccionresponsable" name="direccionresponsable" placeholder="Direcci�n"></textarea></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="row-fluid">
						<div class="span6">
							<table class="table">
								<tbody>
									<tr>
										<td style="text-align:left;padding-left:17%;">Tel�fono:</td>
									</tr>
									<tr>
										<td><input type="text" id="telefonoresponsable" name="telefonoresponsable" placeholder="Tel�fono del Responsable" required></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="span6"></div>
					</div>
				</fieldset>		
				<center style="margin-top:10px">
					<button type="submit" class="btn btn-primary">Registrar</button>
				</center>
			</form>								
			';
		}else{
			$r = $rae->buscardonde('ID_PACIENTE = '.$idpaciente.'');
			$cont.='
				<form id="form2" method="POST" action="./?url=agregar_datos_rae&id='.$personas->obtener('ID_PACIENTE').'&sbm='.$sbm.'&r='.$rae->obtener('ID_REGISTRO_ADMISION_EGRESO').'">';
									
			$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$personas->obtener('ID_RESIDENCIA_HABITUAL').'');
			$tiposangre->buscardonde('ID_TIPO_SANGUINEO = '.$personas->obtener('ID_TIPO_SANGUINEO').'');
			$provincias->buscardonde('ID_PROVINCIA = '.$residencia->obtener('ID_PROVINCIA').'');
			$distritos->buscardonde('ID_DISTRITO = '.$residencia->obtener('ID_DISTRITO').'');
			$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$residencia->obtener('ID_CORREGIMIENTO').'');
			$responsable->buscardonde('ID_PACIENTE = '.$personas->obtener('ID_PACIENTE').'');
			if ($personas->obtener('ID_SEXO') == 1){
				$sexo = 'MASCULINO';
			}else{
				$sexo = 'FEMENINO';
			}
			if($personas->obtener('ID_TIPO_PACIENTE')){
				$asegurado = 'ASEGURADO';
			}else{
				$asegurado = 'NO ASEGURADO';
			}
			list($anio, $mes, $dia) = explode("-", $personas->obtener('FECHA_NACIMIENTO'));
			
			$cont.='
					<div style="float:none;clear:both;">
						<fieldset>
							<legend>
								Paciente
							</legend>
								<table class="table2">											
									<tr>
										<td colspan="3"><h5>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</h5></td>
									</tr>
									<tr>
										<td>'.$personas->obtener('NO_CEDULA').'</td>
										<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
										<td>'.$sexo.'</td>
									</tr>
									<tr>
										<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
										<td>'.$asegurado.'</td>
										<td>'.$ds->edad($dia,$mes,$anio).' A�os</td>
									</tr>
								</table>
						</fieldset>					
					</div>
					<div class="row-fluid" style="float:none;clear:both;">
						<div class="span6">
							<fieldset>
								<legend>
									Responsable
								</legend>
									<table class="table2" style="height:86px;">
										<tr>
											<td>'.$responsable->obtener('NOMBRE_CONTACTO').' '.$responsable->obtener('APELLIDO_CONTACTO').' <i>('.$responsable->obtener('PARENTESCO_CONTACTO').')</i></td>
										</tr>
										<tr>
											<td>'.$responsable->obtener('DIRECCION_CONTACTO').'</td>
										</tr>
										<tr>
											<td>'.$responsable->obtener('TELEFONO_CONTACTO').'</td>
										</tr>
									</table>
							</fieldset>
						</div>
						<div class="span6">
							<fieldset>
								<legend>
									Direcci�n
								</legend>
									<table class="table2" style="height:86px;">
										<tr>
											<td>'.$distritos->obtener('DISTRITO').' , '.$provincias->obtener('PROVINCIA').'</td>
										</tr>
										<tr>
											<td>'.$corregimientos->obtener('CORREGIMIENTO').' , '.$residencia->obtener('DETALLE').'</td>
										</tr>
									</table>
							</fieldset>
						</div>	
					</div>
					
					';
		if($r){
			$readonly = 'readonly';
			$disabled = 'disabled';
			$detalle_adm->buscardonde('ID_DIAGNOSTICO_ADMISION = '.$rae->obtener('ID_DIAGNOSTICO_ADMISION').'');
			$detalle_egr->buscardonde('ID_DIAGNOSTICO_EGRESO = '.$rae->obtener('ID_DIAGNOSTICO_EGRESO').'');
		}else{
			$readonly = '';
			$disabled = '';
		}
					
		$cont.='			
					<h3 class="fondo_azul">Datos de Referencia</h3>
					<div class="row-fluid">

						<div class="span6">
							<table class="tabla-datos">
								<tr>
									<td>Referido de:</td>';
		$referido->buscardonde('ID_REFERIDO = '.$rae->obtener('ID_REFERIDO').'');
		$cont.='
									<td><select id="referido" name="referido" '.$disabled.' title="'.$referido->obtener('REFERIDO').'" required>
											<option value="0">SELECCIONE REFERENCIA</option>';
		$r = $referido->buscardonde('ID_REFERIDO > 0');
		while($r){
			if($referido->obtener('ID_REFERIDO') == $rae->obtener('ID_REFERIDO')){
				$selected = 'selected';
			}else{
				$selected = '';
			}
			$cont.='
											<option value="'.$referido->obtener('ID_REFERIDO').'" '.$selected.'>'.$referido->obtener('REFERIDO').'</option>
			';
			$r = $referido->releer();
		}
		$cont.='
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div class="span6">
							<table class="tabla-datos">
								<tr>
									<td>Cama:</td>';
		$cama->buscardonde('ID_CAMA = '.$rae->obtener('ID_CAMA').'');
		$sala->buscardonde('ID_SALA = '.$cama->obtener('ID_SALA').'');
		$cont.='
									<td><select id="cama" name="cama" title="'.$cama->obtener('CAMA').' - Sala '.$sala->obtener('SALA').'" >
											<option value="">SELECCIONE CAMA</option>';
		$c = $cama->buscardonde('ID_CAMA > 0 ORDER BY CAMA');
		while($c){
			if($cama->obtener('ID_CAMA') == $rae->obtener('ID_CAMA')){
				$selected = 'selected';
			}else{
				$selected = '';
			}
			$sala->buscardonde('ID_SALA = '.$cama->obtener('ID_SALA').'');
			$cont.='
											<option value="'.$cama->obtener('ID_CAMA').'" '.$selected.'>'.$cama->obtener('CAMA').' - Sala '.$sala->obtener('SALA').'</option>
			';
			$c = $cama->releer();
		}
		$cont.='						</select>
									</td>
								</tr>
							</table>
						</div>
					</div>';
		$detalle_adm->buscardonde('ID_DIAGNOSTICO_ADMISION = '.$rae->obtener('ID_DIAGNOSTICO_ADMISION').'');
		$cie->buscardonde('ID_CIE10 = "'.$detalle_adm->obtener('ID_CIE10').'"');
		$profesional->buscardonde('ID_PROFESIONAL = '.$detalle_adm->obtener('ID_PROFESIONAL').'');
		if($profesional->buscardonde('ID_PROFESIONAL = '.$detalle_adm->obtener('ID_PROFESIONAL').'')){
			$segundonombre = $profesional->obtener('SEGUNDO_NOMBRE');
			$segundoapellido = $profesional->obtener('APELLIDO_MATERNO');
			$nombre = $profesional->obtener('PRIMER_NOMBRE').' '.$segundonombre[0].'. '.$profesional->obtener('APELLIDO_PATERNO').' '.$segundoapellido[0].'.';
		}else{
			$nombre = '';
		}
		$cont.='
					<h3 class="fondo_azul">Datos de Hospitalizaci�n</h3>
					<div class="row-fluid">
						<div class="span6">
							<fieldset>
								<legend>Diagn�stico de Admisi�n</legend>
								<table class="table">
									<tbody>
										<tr>
											<td style="text-align:left;padding-left:17%;">Diagn�stico:</td>														
										</tr>
										<tr>
											<td><input type="text" id="diagnostico1" name="diagnostico1" placeholder="Diagn�stico" value="'.$cie->obtener('DESCRIPCION').'" '.$readonly.' title="'.$cie->obtener('DESCRIPCION').'" required></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">CIE10:</td>														
										</tr>
										<tr>
											<td><input type="text" id="cie1" name="cie1" placeholder="CIE10" value="'.$cie->obtener('ID_CIE10').'" readonly></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Profesional:</td>														
										</tr>
										<tr>
											<td><input type="text" id="profesional" name="profesional" placeholder="Buscar Profesional" value="'.$nombre.'" '.$readonly.' title="'.$nombre.'" required><br><input type="text" id="cedprofesional" name="cedprofesional" placeholder="C&eacute;dula Profesional" value="'.$profesional->obtener('NO_CEDULA').'" readonly title="'.$profesional->obtener('NO_CEDULA').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Observaci�n:</td>														
										</tr>
										<tr>
											<td><textarea class="textarea" id="observacion" name="observacion" placeholder="Observaci�n" '.$readonly.' title="'.$detalle_adm->obtener('OBSERVACION').'">'.$detalle_adm->obtener('OBSERVACION').'</textarea></td>
										</tr>
									</tbody>
								</table>								
							</fieldset>
						</div>';
		$detalle_egr->buscardonde('ID_DIAGNOSTICO_EGRESO = '.$rae->obtener('ID_DIAGNOSTICO_EGRESO').'');
		$cie->buscardonde('ID_CIE10 = "'.$detalle_egr->obtener('ID_CIE10').'"');
		$profesional->buscardonde('ID_PROFESIONAL = '.$detalle_egr->obtener('ID_PROFESIONAL').'');
		if($profesional->buscardonde('ID_PROFESIONAL = '.$detalle_adm->obtener('ID_PROFESIONAL').'')){
			$segundonombre = $profesional->obtener('SEGUNDO_NOMBRE');
			$segundoapellido = $profesional->obtener('APELLIDO_MATERNO');
			$nombre = $profesional->obtener('PRIMER_NOMBRE').' '.$segundonombre[0].'. '.$profesional->obtener('APELLIDO_PATERNO').' '.$segundoapellido[0].'.';
		}else{
			$nombre = '';
		}
		if($detalle_egr->obtener('ID_FRECUENCIA') == 1){
			$nuevo = 'selected';
			$sub = '';
			$title='NUEVO';
		}else{
			$nuevo = '';
			$sub = 'selected';
			$title='SUBSECUENCIA';
		}
		if($detalle_egr->obtener('INFECCION_NOSOCOMIAL')){
			$si = 'checked';
			$no = '';
		}else{
			$si = '';
			$no = 'checked';
		}
		$cont.='
						<div class="span6">
							<fieldset>
								<legend>Diagn�stico Egreso</legend>
								<table class="table">
									<tbody>
										<tr>
											<td style="text-align:left;padding-left:17%;">Diagn�stico:</td>														
										</tr>
										<tr>
											<td><input type="text" id="diagnostico2" name="diagnostico2" placeholder="Diagn�stico" value="'.$cie->obtener('DESCRIPCION').'" '.$readonly.' title="'.$cie->obtener('DESCRIPCION').'"></td>
										</tr>	
										<tr>
											<td style="text-align:left;padding-left:17%;">CIE10:</td>														
										</tr>
										<tr>
											<td><input type="text" id="cie2" name="cie2" placeholder="CIE10" value="'.$cie->obtener('ID_CIE10').'" readonly></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Profesional:</td>														
										</tr>
										<tr>
											<td><input type="text" id="profesional2" name="profesional2" placeholder="Buscar Profesional" value="'.$nombre.'" '.$readonly.' title="'.$nombre.'"><br><input type="text" id="cedprofesional2" name="cedprofesional2" placeholder="C&eacute;dula Profesional" value="'.$profesional->obtener('NO_CEDULA').'" readonly title="'.$profesional->obtener('NO_CEDULA').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Frecuencia:</td>														
										</tr>
										<tr>
											<td><select id="frecuencia" name="frecuencia" '.$disabled.' title="'.$title.'">
													<option value="">SELECCIONE FRECUENCIA</option>
													<option value="1" '.$nuevo.'>NUEVO</option>
													<option value="2" '.$sub.'>SUBSECUENCIA</option>
												</select>
											</td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Infecci�n Nosocomial:</td>														
										</tr>
										<tr>
											<td><input type="radio" id="infeccion" name="infeccion" value="1" '.$si.' '.$disabled.'> Si 
												<input type="radio" id="infeccion" name="infeccion" value="0" '.$no.' '.$disabled.'> No
											</td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Causa Externa:</td>														
										</tr>
										<tr>
											<td><input type="text" id="causa" name="causa" placeholder="Causa Externa" value="'.$detalle_egr->obtener('CAUSA_EXTERNA').'" '.$readonly.' title="'.$detalle_egr->obtener('CAUSA_EXTERNA').'"></td>
										</tr>
										<tr>
											<td style="text-align:left;padding-left:17%;">Observaci�n:</td>														
										</tr>
										<tr>
											<td><input type="text" id="observacion1" name="observacion1" placeholder="Observaci�n" value="'.$detalle_egr->obtener('OBSERVACION').'" '.$readonly.' title="'.$detalle_egr->obtener('OBSERVACION').'"></td>
										</tr>
									</tbody>
								</table>															
							</fieldset>
						</div>
					</div>
																			
					<h3 class="fondo_azul">Datos de Evoluci�n</h3>
					<div class="row-fluid">
						<div class="span6">
							<table class="table" align="center">
								<tr>
									<td style="line-height:15px">Condici�n de Salida:</td>';
		$condicionsalida->buscardonde('ID_CONDICION_SALIDA = '.$rae->obtener('ID_CONDICION_SALIDA').'');
		$cont.='
									<td>
										<select id="condicionsalida" name="condicionsalida" title="'.$condicionsalida->obtener('CONDICION_SALIDA').'">
											<option value="0">SELECCIONE CONDICI&Oacute;N</option>';
		$c = $condicionsalida->buscardonde('ID_CONDICION_SALIDA > 0');
		while($c){
				if($condicionsalida->obtener('ID_CONDICION_SALIDA') == $rae->obtener('ID_CONDICION_SALIDA')){
					$selected = 'selected';
				}else{
					$selected = '';
				}
				$cont.='
											<option value="'.$condicionsalida->obtener('ID_CONDICION_SALIDA').'" '.$selected.'>'.$condicionsalida->obtener('CONDICION_SALIDA').'</option>
					';
				$c = $condicionsalida->releer();
		}	
		if($rae->obtener('MUERTE_EN_SOP')){
			$muerte_s = 'checked';
			$muerte_n = '';
		}else{
			$muerte_s = '';
			$muerte_n = 'checked';
		}		
		if($rae->obtener('AUTOPSIA')){
			$autopsia_s = 'checked';
			$autopsia_n = '';
		}else{
			$autopsia_s = '';
			$autopsia_n = 'checked';
		}
		$cont.='						</select>
									</td>
								</tr>
								<tr>
									<td>Muerte en SOP:</td>
									<td><input type="radio" id="muerte" name="muerte" value="1" '.$muerte_s.'> Si  <input type="radio" id="muerte" name="muerte" value="0" '.$muerte_n.'> No</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>Autopsia:</td>
									<td><input type="radio" id="autopsia" name="autopsia" value="1" '.$autopsia_s.'> Si <input type="radio" id="autopsia" name="autopsia" value="0" '.$autopsia_n.'> No</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>								
								<tr>
									<td>Fecha Autopsia:</td>
									<td><input type="date" name="fechautopsia" id="fechautopsia" placeholder="AAAA-MM-DD" value="'.$rae->obtener('FECHA_AUTOPSIA').'"></td>
								</tr>
							</table>
						</div>
						<div class="span6">
							<table class="table" align="center">
								<tr>
									<td style="line-height:15px">Motivo Salida:</td>';
		$motivo->buscardonde('ID_MOTIVO_SALIDA = '.$rae->obtener('ID_MOTIVO_SALIDA').'');
		$cont.='
									<td><select id="motivo" name="motivo" title="'.$motivo->obtener('MOTIVO_SALIDA').'">
											<option value="">SELECCIONE MOTIVO</option>';
		$m = $motivo->buscardonde('ID_MOTIVO_SALIDA > 0');
		while($m){
			if($motivo->obtener('ID_MOTIVO_SALIDA') == $rae->obtener('ID_MOTIVO_SALIDA')){
				$selected = 'selected';
			}else{
				$selected = '';
			}
			$cont.='
											<option value="'.$motivo->obtener('ID_MOTIVO_SALIDA').'" '.$selected.'>'.$motivo->obtener('MOTIVO_SALIDA').'</option>
			';
			$m = $motivo->releer();
		}
		$profesional->buscardonde('ID_PROFESIONAL = '.$rae->obtener('ID_PROFESIONAL').'');
		if($profesional->buscardonde('ID_PROFESIONAL = '.$detalle_adm->obtener('ID_PROFESIONAL').'')){
			$segundonombre = $profesional->obtener('SEGUNDO_NOMBRE');
			$segundoapellido = $profesional->obtener('APELLIDO_MATERNO');
			$nombre = $profesional->obtener('PRIMER_NOMBRE').' '.$segundonombre[0].'. '.$profesional->obtener('APELLIDO_PATERNO').' '.$segundoapellido[0].'.';
		}else{
			$nombre = '';
		}
		$cont.='
										</select>
									</td>
								</tr>
								<tr>
									<td>Profesional:</td>
									<td><input type="text" id="profesional3" name="profesional3" placeholder="Buscar Profesional" value="'.$nombre.'" '.$readonly.' title="'.$nombre.'"><br><input type="text" id="cedprofesional3" name="cedprofesional3" placeholder="C�dula Profesional" value="'.$profesional->obtener('NO_CEDULA').'" readonly title="'.$profesional->obtener('NO_CEDULA').'"></td>
								</tr>		
								<tr>
									<td>D�as de Estancia:</td>
									<td><input type="text" id="dias" name="dias" placeholder="D�as" value="'.$rae->obtener('TOTAL_DIAS_ESTANCIA').'"></td>
								</tr>
							</table>
						</div>
					</div>		
				<button type="submit" class="btn btn-primary" style="float:right;">Guardar</button>';
		$cont .= '
				</form>';					
		}
	}
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script><script>location.href="./?url=inicio"</script>';
	}else{
		$ds->contenido($cont);
		$ds->mostrar();
	}
?>