<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$personas = new Accesatabla('datos_pacientes');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$institucion = new Accesatabla('institucion');
	$especialidades = new Accesatabla('especialidades_medicas');
	$surco = new Accesatabla('surco');
	$cie = new Accesatabla('cie10');
	$tipoexamen = new Accesatabla('tipo_examen');
	$frecuencia = new Accesatabla('frecuencia');
	$historia = new Accesatabla('historia_paciente');
	$examenfisico = new Accesatabla('examen_fisico');
	$zona = new Accesatabla('zona');
	$etnia = new Accesatabla('etnia');
	$sexo = new Accesatabla('sexo');
	$programa = new Accesatabla('programa');
	$categoria = new Accesatabla('categoria');
	$datos_profesional = new Accesatabla('datos_profesionales_salud');
	$profesional = new Accesatabla('profesionales_salud');
	$servicios = new Accesatabla('servicios_medicos');		

	$ds = new Diseno();
	
	$cedula = $_GET['idpac'];
	$resp = $_GET['idr'];
	$tipo_surco = $_GET['tiporef'];
	$tipo_imp = $_GET['visita'];
	$agenda = $_GET['agenda'];
	$idreceta = $_GET['idr'];
	$html='
<html>
	<head>
		<title>Cuidados Paliativos</title>
	
		<link href="./iconos/logo_medicina.ico" type="image/x-icon" rel="shortcut icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<style type="text/css">
			.fd-title{background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;}
			.sub-title{width:100%;border:1px solid #3d3d3d;text-align:center;font-weight:bold;padding:4px 0px;} p{padding:0px;margin:0px;}
			.fd-head-tabla{background:#f4f4f4;width:100%;text-align:center;}
			.tabla td,.tabla th{border:1px solid #c9c9c9;}
		</style>
	</head>
	<body>';
	
	if(!empty($idreceta)){
		$recetas = new Accesatabla('recetas_medicas');
		$det_recetas = new Accesatabla('detalle_receta');	
		$formas = new Accesatabla('formas_farmaceuticas');
		$medicamentos = new Accesatabla('medicamentos');
		$vias = new Accesatabla('vias_administracion');	
		$frecuencia = new Accesatabla('frecuencias_tratamientos');
		$verbos = new Accesatabla('verbos_recetas');
		$unidad = new Accesatabla('unidades_medida');
		$periodo = new Accesatabla('periodo_tratamiento');
		$medicamentos = new Accesatabla('medicamentos');
		
		$recetas->buscardonde('ID_RECETA = '.$idreceta.'');
		$personas->buscardonde('ID_PACIENTE = '.$recetas->obtener('ID_PACIENTE').'');
		list($anio, $mes, $dia) = explode("-", $personas->obtener('FECHA_NACIMIENTO'));
		if($personas->obtener('ID_SEXO') == 1){
			$sexo = 'MASCULINO';		
		}else{
			$sexo = 'FEMENINO';		
		}
		$archivofinal = 'Receta-'.$personas->obtener('NO_CEDULA').'';
		
		$datos_profesional->buscardonde('ID_PROFESIONAL = '.$recetas->obtener('ID_PROFESIONAL').'');
		/*DATOS DE LA RECETA*/
		$det_recetas->buscardonde('ID_RECETA = '.$idreceta.'');
		$medicamentos->buscardonde('ID_MEDICAMENTO = '.$det_recetas->obtener('ID_MEDICAMENTO').'');		
		$formas->buscardonde('ID_TIPO_FORMA = '.$det_recetas->obtener('ID_FORMA').'');
		$verbos->buscardonde('ID_VERBO = '.$det_recetas->obtener('ID_DOSIS').'');
		$frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO = '.$det_recetas->obtener('ID_FRECUENCIA_TRATAMIENTO').'');	
		$periodo->buscardonde('ID_PERIODO = '.$det_recetas->obtener('ID_PERIODO_TRATAMIENTO').'');
		$unidad->buscardonde('ID_TIPO_UNIDAD = '.$det_recetas->obtener('ID_UNIDAD').'');
		$vias->buscardonde('ID_VIA = '.$det_recetas->obtener('ID_VIA').'');		
		$html.='
			<table style="width:100%;">
				<tr align="center">
					<td width="25%"><img src="iconos/minsa.png" style="width:90px;height:90px;"></td>					
					<td width="50%"><h1 style="text-align:center;">Cuidados Paliativos Panam&aacute;</h1></td>					
					<td width="25%"><img src="iconos/ION_logo.png" style="width:190px;height:110px"></td>					
				</tr>
			</table>					
				
			<center><h2 style="font-style:italic;">RECETA</h2></center>
			
			<b>Nombre:</b> <span style="text-decoration:underline;">'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</span><br>
			<b>N&deg; C&eacute;dula:</b> <span style="text-decoration:underline;">'.$personas->obtener('NO_CEDULA').'</span> <b>Edad:</b> <span style="text-decoration:underline;">'.$ds->edad($dia,$mes,$anio).'</span> <b>Sexo:</b> <span style="text-decoration:underline;">'.$sexo.'</span> <b>Fecha:</b> <span style="text-decoration:underline;">'.$recetas->obtener('FECHA_RECETA').'</span><br><br>
			
			<hr style="border: 2px solid #000;width:100%;"/>				
			
			<h1>Rx</h1>
				
			<center><br><br>
				'.$medicamentos->obtener('DESCRIPCION').' '.$formas->obtener('DESCRIPCION').' '.$det_recetas->obtener('CONCENTRACION').' '.$unidad->obtener('ABREVIATURA').'<br>
				'.$verbos->obtener('DESCRIPCION').' '.$det_recetas->obtener('DOSIS').' '.$frecuencia->obtener('ABREVIATURA').' '.$vias->obtener('ABREVIATURA').' '.$det_recetas->obtener('TRATAMIENTO').' '.$periodo->obtener('DESCRIPCION').'					
			</center> 
			<br><br>
			<b>M&eacute;dico:</b> '.$datos_profesional->obtener('PRIMER_NOMBRE').' '.$datos_profesional->obtener('APELLIDO_PATERNO').'<br><br>
			
			<b>Firma:</b> _______________________________________		
		';
	}elseif(!empty($agenda)){
		$archivofinal = 'Agenda-del-'.$_GET['fecha'].'';
		$cita = new Accesatabla('citas_medicas');
		
		$var = explode("-", $_GET['fecha']);
		 
		$html.='	
				<center style="margin-top:-30px">
					<h3 class="fd-title" style="font-size:16px">AGENDA DE CITAS M&Eacute;DICAS</h3>				
				</center>
				<div style="width:100%;font-size:14px">
					<b>Citas del d&iacute;a '.$var[2].' de '.$ds->dime('mes-'.$var[1].'').' de '.$var[0].'</b><br><br>
					<table class="tabla" width="100%" cellspacing="0" style="font-size:14px">
						<tr class="fd-head-tabla">
							<th style="width:100px">No Equipo M&eacute;dico</th>
							<th>Hora</th>
							<th>C&eacute;dula</th>
							<th>Paciente</th>
							<th>Profesional</th>
							<th>Servicio</th>
						</tr>';
			
				$h = $cita->buscardonde('FECHA = "'.$_GET['fecha'].'" AND RESERVADA = 1 ORDER BY ID_EQUIPO_MEDICO, HORA');
				if($h == 0){
					 echo '<script>alert("No existen pacientes agendados en esta fecha.");location.href="./?url=domiciliaria_agenda&sbm=1"</script>';
				}else{
					while($h){					
						$personas->buscardonde('ID_PACIENTE = '.$cita->obtener('ID_PACIENTE').'');
						$datos_profesional->buscardonde('ID_PROFESIONAL = '.$cita->obtener('ID_PROFESIONAL').'');
						$servicios->buscardonde('ID_SERVICIO = '.$cita->obtener('ID_SERVICIO').'');

								$html.='
								<tr align="center">
									<td>'.$cita->obtener('ID_EQUIPO_MEDICO').'</td>
									<td width="70px">'.$cita->obtener('HORA').'</td>
									<td>'.$personas->obtener('NO_CEDULA').'</td>
									<td>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</td>
									<td>'.$datos_profesional->obtener('PRIMER_NOMBRE').' '.$datos_profesional->obtener('SEGUNDO_NOMBRE').' '.$datos_profesional->obtener('APELLIDO_PATERNO').' '.$datos_profesional->obtener('APELLIDO_MATERNO').'</td>
									<td>'.$servicios->obtener('DESCRIPCION').'</td>						
								</tr>';
		
						$h = $cita->releer();
					}
				}			
			$html.='
					</table>
				</div>
			';
		
		
	}elseif(empty($tipo_imp)){
		$tiposangre = new Accesatabla('tipos_sanguineos');
		$resultado = new Accesatabla('resultados_examen_diagnostico');
		$detallediagnostico = new Accesatabla('detalle_diagnostico');		
		$respuesta = new Accesatabla('respuesta_referencia');

		$cont_gral='
			<center style="margin-top:-30px">
				<h3 class="fd-title" style="font-size:16px">SISTEMA &Uacute;NICO DE REFERENCIA Y CONTRA-REFERENCIA (SURCO)</h3>				
			</center>';
		$personas->buscardonde('NO_CEDULA = "'.$cedula.'" OR ID_PACIENTE = "'.$cedula.'"');
		$ced = $personas->obtener('NO_CEDULA');
		$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$personas->obtener('ID_RESIDENCIA_HABITUAL').'');
		$tiposangre->buscardonde('ID_TIPO_SANGUINEO = '.$personas->obtener('ID_TIPO_SANGUINEO').'');
		$provincias->buscardonde('ID_PROVINCIA = '.$residencia->obtener('ID_PROVINCIA').'');
		$distritos->buscardonde('ID_DISTRITO = '.$residencia->obtener('ID_DISTRITO').'');
		$corregimientos->buscardonde('ID_CORREGIMIENTO = '.$residencia->obtener('ID_CORREGIMIENTO').'');
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
		
		
		$html .= $cont_gral;		
			
		if($tipo_surco == 1){
				$archivofinal='Referencia-'.$ced.'';
		
				$surco->buscardonde('ID_PACIENTE = '.$personas->obtener('ID_PACIENTE').'');
				//DATOS A MOSTRAR AL IMPRIMIR
				$institucion->buscardonde('ID_INSTITUCION = '.$surco->obtener('INSTALACION_REFIERE').'');
				$inst_refiere = $institucion->obtener('DENOMINACION');
				$servicios->buscardonde('ID_SERVICIO = '.$surco->obtener('ID_SERVICIO').'');
				$institucion->buscardonde('ID_INSTITUCION = '.$surco->obtener('INSTALACION_RECEPTORA').'');
				$inst_receptora = $institucion->obtener('DENOMINACION');
				
			$html.='
				<center><span style="font-size:18px;font-weight:bold;">Referencia</span></center><br>
				<div style="width:100%;">
					<table style="width:100%;">
						<tr align="center">
							<td style="border-bottom:1px solid #333;"><span style="font-size:14px">'.$inst_refiere.'</span></td>
							<td style="border-bottom:1px solid #333;"><span style="font-size:14px">'.$inst_receptora.'</span></td>
							<td style="border-bottom:1px solid #333;"><span style="font-size:14px">'.$servicios->obtener('DESCRIPCION').'</span></td>
						</tr>
						<tr align="center">
							<td><span style="font-weight:bold;font-size:12px">Instalaci&oacute;n que Refiere</span></td>
							<td><span style="font-weight:bold;font-size:12px">Instalaci&oacute;n Receptora</span></td>
							<td><span style="font-weight:bold;font-size:12px">Servicio M&eacute;dico al que se Refiere</span></td>
						</tr>
					</table>	
					<table style="width:25%;">
						<tr>
							<th>Fecha/Hora</th>						
						</tr>
						<tr>';							
							$hora = $ds->dime('hora');
							$minutos = $ds->dime('minuto');
							if($hora < 10){
								$hora = '0';
								$hora .= $ds->dime('hora');
							}
							if($minutos < 10){
								$minutos = '0'; 
								$minutos .=  $ds->dime('minuto');
							}
							list($anio, $mes, $dia) = explode("-", $personas->obtener('FECHA_NACIMIENTO'));
					$html.='
							<td>
								<table width="100%" style="font-size:14px" cellspacing="0">									
									<tr align="center">
										<td style="border:1px solid #333;">'.$ds->dime('dia').'</td>
										<td style="border:1px solid #333;">'.$ds->dime('mes').'</td>
										<td style="border:1px solid #333;">'.$ds->dime('agno').'</td>
										<td style="border:1px solid #333;">'.$hora.'</td>
										<td style="border:1px solid #333;">'.$minutos.'</td>
										<td>'.date(A).'</td>
									</tr>
									<tr align="center" style="font-size:12px;font-weight:bold;">
										<td>D</td>
										<td>M</td>
										<td>A</td> 
										<td>Hora</td>
										<td>Min.</td>
									</tr>
								</table>
							</td>
						</tr>						
					</table>
					<h3 style="font-weight:bold;text-align:center;text-decoration:underline">Identificaci&oacute;n del Paciente</h3>
					<table width="100%">						
						<tr align="center">
							<td style="border-bottom:1px solid #333;">'.$personas->obtener('PRIMER_NOMBRE').'</td>
							<td style="border-bottom:1px solid #333;">'.$personas->obtener('SEGUNDO_NOMBRE').'</td>
							<td style="border-bottom:1px solid #333;">'.$personas->obtener('APELLIDO_PATERNO').'</td>
							<td style="border-bottom:1px solid #333;">'.$personas->obtener('APELLIDO_MATERNO').'</td>
						</tr>
						<tr style="font-size:12px">
							<th>Primer Nombre</th>
							<th>Segundo Nombre</th>
							<th>Primer Apellido</th>
							<th>Segundo Apellido</th>
						</tr>
					</table>
					<table width="100%">	
						<tr align="center">	
							<td width="15px">C&eacute;dula: </td>
							<td style="border-bottom:1px solid #333;">'.$ced.'</td>
							<td></td>
							<td width="15px">Tel&eacute;fono: </td>
							<td style="border-bottom:1px solid #333;">'.$personas->obtener('TELEFONO_CASA').'</td>
							<td></td>
							<td width="15px">Celular: </td>
							<td style="border-bottom:1px solid #333;">'.$personas->obtener('TELEFONO_CELULAR').'</td>
						</tr>
					</table>
					<table width="100%">
						<tr>
							<td>Edad: <span style="text-decoration:underline;">'.$personas->obtener('EDAD_PACIENTE').'</span></td>
							<td></td>
							<td>A&ntilde;os: <span style="text-decoration:underline;">'.$anio.'</span></td>
							<td></td>
							<td>Meses: <span style="text-decoration:underline;">'.$mes.'</span></td>
							<td></td>
							<td>D&iacute;as: <span style="text-decoration:underline;">'.$dia.'</span></td>
							<td></td>';
							if($personas->obtener('ID_SEXO') == 1){
								$masc = '<img src="iconos/gancho.png">';
							}else{
								$fem = '<img src="iconos/gancho.png">';
							}
						$html.='	
							<td>
								Sexo: &nbsp;&nbsp;&nbsp;&nbsp;<span style="border:1px solid #333;padding:3px;">F</span> '.$fem.' 
									  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="border:1px solid #333;padding:3px;">M</span> '.$masc.'	
							</td>
						</tr>
					</table>';
				$zona->buscardonde('ID_ZONA = '.$residencia->obtener('ID_ZONA').'');
			$html.='		
					<span style="width:100%;font-weight:bold;text-decoration:underline;">Direcci&oacute;n</span>
					<table width="100%">						
						<tr align="center">
							<td  width="13%" style="border-bottom:1px solid #333;">'.$provincias->obtener('PROVINCIA').'</td>
							<td  width="20%" style="border-bottom:1px solid #333;">'.$distritos->obtener('DISTRITO').'</td>
							<td  width="20%" style="border-bottom:1px solid #333;">'.$corregimientos->obtener('CORREGIMIENTO').'</td>
							<td  width="27%" style="border-bottom:1px solid #333;"></td>
							<td  width="20%" style="border-bottom:1px solid #333;">'.$zona->obtener('ZONA').'</td>
						</tr>
						<tr style="font-size:12px">
							<th width="13%">Provincia</th>
							<th width="20%">Distrito</th>
							<th width="20%">Corregimiento</th>
							<th width="27%">Comunidad</th>
							<th width="20%">Zona</th>
						</tr>
					</table>';

					if($surco->obtener('ID_MOTIVO_REFERENCIA') == 1){
						$select1='<img src="iconos/gancho.png">';
					}elseif($surco->obtener('ID_MOTIVO_REFERENCIA') == 2){
						$select2='<img src="iconos/gancho.png">';
					}elseif($surco->obtener('ID_MOTIVO_REFERENCIA') == 3){
						$select3='<img src="iconos/gancho.png">';
					}elseif($surco->obtener('ID_MOTIVO_REFERENCIA') == 4){
						$select4='<img src="iconos/gancho.png">';
					}elseif($surco->obtener('ID_MOTIVO_REFERENCIA') == 5){
						$select5='<img src="iconos/gancho.png">';
					}else{
						$select6='<img src="iconos/gancho.png">';
					}
			$html.='
					<div class="sub-title" style="margin:8px 0px;">Motivo de Referencia</div>		
					<table width="100%" style="margin-bottom:5px;">
						<tr>
							<td width="25%">1. Servicio No Ofertado </td> <td align="center"  width="4.16%"><div style="border:1px solid #333;width:22px;height:20px;">'.$select1.'</div></td>
							<td width="25%">2. Ausencia del Profesional </td>  <td align="center"  width="4.16%"><div style="border:1px solid #333;width:22px;height:20px;">'.$select2.'</div></td>
							<td width="25%">3. Falta de Equipos </td>  <td align="center"  width="4.16%"><div style="border:1px solid #333;width:22px;height:20px;">'.$select3.'</div></td>
						</tr>
						<tr>
							<td width="25%">4. Falta de Insumos </td>  <td align="center" width="4.16%" ><div style="border:1px solid #333;width:22px;height:20px;">'.$select4.'</div></td>
							<td width="25%">5. Cese de Actividades </td>  <td align="center"  width="4.16%"><div style="border:1px solid #333;width:22px;height:20px;">'.$select5.'</div></td>
							<td width="25%">6. Otro </td>  <td align="center"  width="4.16%"><div style="border:1px solid #333;width:22px;height:20px;">'.$select6.'</div></td>
						</tr>
					</table>
				</div>';
				if($surco->obtener('ID_CLASIFICACION_ATENCION_SOLICITADA') == 1){
					$selec1='<img src="iconos/gancho.png">';
				}elseif($surco->obtener('ID_CLASIFICACION_ATENCION_SOLICITADA') == 2){
					$selec2='<img src="iconos/gancho.png">';
				}elseif($surco->obtener('ID_CLASIFICACION_ATENCION_SOLICITADA') == 3){
					$selec3='<img src="iconos/gancho.png">';
				}else{
					$selec4='<img src="iconos/gancho.png">';
				}
			$html.='	
				<div class="sub-title" style="margin:8px 0px;">Clasificaci&oacute;n de la Atenci&oacute;n Solicitada</div>		
				<table width="100%" style="margin-bottom:5px;">
					<tr>
						<td width="25%">1. Electiva </td> <td align="center"  width="4.16%"><div style="border:1px solid #333;width:22px;height:20px;">'.$selec1.'</div></td>
						<td width="25%">2. Electiva Prioritaria </td> <td align="center"  width="4.16%"><div style="border:1px solid #333;width:22px;height:20px;">'.$selec2.'</div></td>
						<td width="25%">3. Hospitalizaci&oacute;n </td> <td align="center"  width="4.16%"><div style="border:1px solid #333;width:22px;height:20px;">'.$selec3.'</div></td>							
						<td width="25%">4. Urgente </td> <td align="center"  width="4.16%"><div style="border:1px solid #333;width:22px;height:20px;">'.$selec4.'</div></td>
					</tr>
				</table>';
				$historia->buscardonde('ID_HISTORIA_PACIENTE = '.$surco->obtener('ID_HISTORIA_PACIENTE').'');
				$examenfisico->buscardonde('ID_EXAMEN_FISICO = '.$historia->obtener('ID_EXAMEN_FISICO').'');

			$html.='
				<div class="sub-title">Historia del Paciente / Examen F&iacute;sico</div>
				<table width="100%" style="font-size:14px;border:1px solid #fff;margin-bottom:5px">	
					<tr>
						<th width="10%">Anamnesis: </th>
						<td width="90%"><p style="text-decoration:underline;">'.$historia->obtener('ANAMNESIS').'</p></td>
					</tr>
					<tr>
						<th width="10%">Examen F&iacute;sico: </th>
						<td width="90%">
							<table class="tabla" width="100%" cellspacing="0px">
								<tr class="fd-head-tabla">
									<th>Hora</th>
									<th>Presi&oacute;n Arterial</th>
									<th>Frecuencia Cardiaca</th>
									<th>Frecuencia Respiratoria</th>
									<th>Frecuencia Cardiaca Fetal</th>
									<th>Temperatura</th>
									<th>Peso<small>(Kg)</small></th>
									<th>Talla<small>(mts)</small></th>
								</tr>
								<tr align="center">
									<td style="padding -top:10px">'.$examenfisico->obtener('HORA').'</td>
									<td style="padding -top:10px">'.$examenfisico->obtener('PRESION_ARTERIAL').'</td>
									<td style="padding- top:10px">'.$examenfisico->obtener('FRECUENCIA_CARDIACA').'</td>
									<td style="padding- top:10px">'.$examenfisico->obtener('FRECUENCIA_RESPIRATORIA').'</td>
									<td style="padding- top:10px">'.$examenfisico->obtener('FRECUENCIA_CARDIACA_FETAL').'</td>
									<td style="padding- top:10px">'.$examenfisico->obtener('TEMPERATURA').'</td>
									<td style="padding- top:10px">'.$examenfisico->obtener('PESO').'</td>
									<td style="padding- top:10px">'.$examenfisico->obtener('TALLA').'</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>							
						<th width="10%" style="vertical-top:20px">Observaciones: </th>
						<td width="90%"><p style="text-decoration:underline;">'.$historia->obtener('OBSERVACIONES').'</p></td>
					</tr>
				</table>
				<div class="sub-title">Resultados de Examen / Diagn&oacute;stico</div>
				<table class="tabla"  width="100%" cellspacing="0px" style="margin:7px 0px;text-align:center;font-size:14px">
					<tr class="fd-head-tabla">
						<th width="80px">Tipo de Examen</th>
						<th>Diagn&oacute;stico</th>
						<th style="width:60px">CIE-10</th>
						<th>Frecuencia</th>
						<th>Observaciones</th>
						<th>Tratamiento</th>
						<th style="width:75px">Fecha del Examen</th>
					</tr>';
		$x = $tipoexamen->buscardonde('ID_TIPO_EXAMEN > 0');
		while($x){
			$nomb_examen = $tipoexamen->obtener('ID_TIPO_EXAMEN');
			$resultado->buscardonde('ID_SURCO = '.$surco->obtener('ID_SURCO').' AND ID_TIPO_EXAMEN = '.$tipoexamen->obtener('ID_TIPO_EXAMEN').'');
			$detallediagnostico->buscardonde('ID_DIAGNOSTICO = '.$resultado->obtener('ID_DIAGNOSTICO').'');
			$cie->buscardonde('ID_CIE10 = "'.$detallediagnostico->obtener('ID_CIE10').'"');
			$html.='
					<tr>
						<td>'.$tipoexamen->obtener('TIPO_EXAMEN').'</td>
						<td>'.$cie->obtener('DESCRIPCION').'</td>
						<td>'.$detallediagnostico->obtener('ID_CIE10').'</td>';
			$frecuencia->buscardonde('ID_FRECUENCIA = "'.$detallediagnostico->obtener('ID_FRECUENCIA').'"');
					$html.='
						<td>'.$frecuencia->obtener('FRECUENCIA').'</td>
						<td>'.$detallediagnostico->obtener('OBSERVACION').'</td>
						<td>'.$resultado->obtener('TRATAMIENTO').'</td>
						<td>'.$resultado->obtener('FECHA').'</td>
					</tr>';
			$x = $tipoexamen->releer();
		}		

		$profesional->buscardonde('ID_PROFESIONAL = '.$surco->obtener('ID_PROFESIONAL').'');	
		$datos_profesional->buscardonde('ID_PROFESIONAL = '.$profesional->obtener('ID_PROFESIONAL').'');		
		$especialidades->buscardonde('ID_ESPECIALIDAD_MEDICA = '.$profesional->obtener('ID_ESPECIALIDAD_MEDICA').'');
		$html.='
				</table>
				<div class="sub-title" style="margin:8px 0px;">Datos del Profesional</div><br>
				<table width="100%">						
					<tr align="center">
						<td style="border-bottom:1px solid #333;">'.$datos_profesional->obtener('PRIMER_NOMBRE').' '.$datos_profesional->obtener('SEGUNDO_NOMBRE').' '.$datos_profesional->obtener('APELLIDO_PATERNO').' '.$datos_profesional->obtener('APELLIDO_MATERNO').'</td>
						<td width="20%"></td>
						<td style="border-bottom:1px solid #333;">'.$especialidades->obtener('DESCRIPCION').'</td>						
					</tr>
					<tr style="font-size:12px">
						<th>Nombre de quien refiere</th>
						<th width="20%"></th>
						<th>Especialidad</th>						
					</tr>
				</table><br>
				<table width="100%" style="font-size:12px;">
					<tr>
						<th>Firma: </th>
						<td>______________________________________</td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
					<tr>
						<th>Sello: </th>
						<td>	
							<div style="width:130px;height:80px;border:1px solid #3d3d3d;"></div>
						</td>
					</tr>
				</table>';

		}else{
			$archivofinal = 'Respuesta-a-la-Referencia-'.$ced.'';
			$respuesta->buscardonde('ID_RESPUESTA_REFERENCIA = '.$resp.'');
			$institucion->buscardonde('ID_INSTITUCION = '.$respuesta->obtener('INSTITUCION_RESPONDE').'');					
			$instalacion_responde = $institucion->obtener('DENOMINACION');
			$institucion->buscardonde('ID_INSTITUCION = '.$respuesta->obtener('INSTALACION_RECEPTORA').'');
			$instalacion_receptora = $institucion->obtener('DENOMINACION');
			$html.='
				<center><span style="font-size:18px;font-weight:bold;">Respuesta a la Referencia</span></center><br>
				<div style="width:100%;">
					<table style="width:100%;">
						<tr align="center">
							<td width="25%" style="border-bottom:1px solid #333;"><span style="font-size:14px;word-wrap:break-word;">'.$instalacion_responde.'</span></td>
							<td width="50%"></td>
							<td width="25%" style="border-bottom:1px solid #333;"><span style="font-size:14px;word-wrap:break-word;">'.$instalacion_receptora.'</span></td>
						</tr>
						<tr align="center">
							<td><span style="font-weight:bold;font-size:12px">Instalaci&oacute;n que Responde</span></td>
							<td></td>
							<td><span style="font-weight:bold;font-size:12px">Instalaci&oacute;n Receptora</span></td>
						</tr>
					</table>
					<table style="width:25%;">
						<tr>
							<th><span style="font-size:12px;">Fecha/Hora</span></th>						
						</tr>
						<tr>';							
							$hora = $ds->dime('hora');
							$minutos = $ds->dime('minuto');
							if($hora < 10){
								$hora = '0';
								$hora .= $ds->dime('hora');
							}
							if($minutos < 10){
								$minutos = '0'; 
								$minutos .=  $ds->dime('minuto');
							}
							list($anio, $mes, $dia) = explode("-", $personas->obtener('FECHA_NACIMIENTO'));
					$html.='
							<td>
								<table width="100%" style="font-size:14px" cellspacing="0">									
									<tr align="center">
										<td style="border:1px solid #333;">'.$ds->dime('dia').'</td>
										<td style="border:1px solid #333;">'.$ds->dime('mes').'</td>
										<td style="border:1px solid #333;">'.$ds->dime('agno').'</td>
										<td style="border:1px solid #333;">'.$hora.'</td>
										<td style="border:1px solid #333;">'.$minutos.'</td>
										<td>'.date(A).'</td>
									</tr>
									<tr align="center" style="font-size:12px;font-weight:bold;">
										<td>D</td>
										<td>M</td>
										<td>A</td> 
										<td>Hora</td>
										<td>Min.</td>
									</tr>
								</table>
							</td>
						</tr>						
					</table>
					<div class="sub-title" style="margin:8px 0px;">Respuesta a la Referencia</div>';
					$detallediagnostico->buscardonde('ID_DIAGNOSTICO = '.$respuesta->obtener('ID_DIAGNOSTICO').'');
					$cie->buscardonde('ID_CIE10 = "'.$detallediagnostico->obtener('ID_CIE10').'"');
				$html.='
					<table width="100%" style="font-size:14px;border:1px solid #fff;margin-bottom:5px">	
						<tr>
							<th width="20%" align="left">Hallazgos Cl&iacute;nicos: </th>
							<td width="80%"><p style="text-decoration:underline;">'.$respuesta->obtener('HALLAZGOS_CLINICOS').'</p></td>
						</tr>
						<tr>
							<th width="20%" align="left">Diagn&oacute;stico: </th>
							<td width="80%"><p style="text-decoration:underline;">'.$cie->obtener('DESCRIPCION').' C&oacute;digo ('.$cie->obtener('ID_CIE10').')</p></td>
						</tr>
						<tr>
							<th width="20%" align="left">Observaciones: </th>
							<td width="80%"><p style="text-decoration:underline;">'.$detallediagnostico->obtener('OBSERVACION').'</p></td>
						</tr>
						<tr>
							<th width="20%" align="left">Frecuencia: </th>';
							$frecuencia->buscardonde('ID_FRECUENCIA = "'.$detallediagnostico->obtener('ID_FRECUENCIA').'"');
				$html.='
							<td width="80%"><p style="text-decoration:underline;">'.$frecuencia->obtener('FRECUENCIA').'</p></td>
						</tr>
						<tr>
							<th width="20%" align="left">Manejo y Tratamiento: </th>
							<td width="80%"><p style="text-decoration:underline;">'.$respuesta->obtener('TRATAMIENTO').'</p></td>
						</tr>
					</table>
					<span style="font-weight:bold;text-decoration:underline">Recomendaciones</span>
					<table width="100%" style="margin-bottom:5px;">';
					if($respuesta->obtener('REEVALUACION_ESPECIALIZADA') == 1){
						$selec1= '<img src="iconos/gancho.png">';
					}else{
						$selec2= '<img src="iconos/gancho.png">';
					}
				$html.='
						<tr>
							<td>Reevaluaci&oacute;n Especializada: </td> 
							<td align="right">No</td> <td> <div style="border:1px solid #333;width:22px;height:20px;">'.$selec1.'</div></td>
							<td align="right">Si</td> <td> <div style="border:1px solid #333;width:22px;height:20px;">'.$selec2.'</div></td>
							<td align="right">Fecha: </td>
							<td><p style="text-decoration:underline">'.$respuesta->obtener('FECHA').'</p></td>
						</tr> 
					</table>
					<div class="sub-title" style="margin:8px 0px;">Datos del Profesional</div>';

			$datos_profesional->buscardonde('ID_PROFESIONAL = '.$respuesta->obtener('ID_PROFESIONAL').'');
			$var1 = $datos_profesional->obtener('SEGUNDO_NOMBRE');
			$var2 = $datos_profesional->obtener('APELLIDO_MATERNO');
			$nombre = $datos_profesional->obtener('PRIMER_NOMBRE').' '.$var1[0].'. '.$datos_profesional->obtener('APELLIDO_PATERNO').' '.$var2[0].'.';
			
			$html.='
					<table width="100%" style="font-size:14px;margin-bottom:5px">	
						<tr>
							<th width="30%" align="left">Nombre del Profesional que responde: </th>
							<td width="70%"><p style="text-decoration:underline;">'.$nombre.'</p></td>
						</tr>
					</table><br>
					<table width="100%" style="font-size:12px;">
						<tr>
							<th>Firma: </th>
							<td>______________________________________</td>
							<th>No. de Registro: </th>
							<td>______________________________________</td>
						</tr>
						<tr>
							<td colspan="4"></td>
						</tr>
						<tr>
							<th>Sello: </th>
							<td>	
								<div style="width:130px;height:80px;border:1px solid #3d3d3d;"></div>
							</td>
							<td colspan="2"></td>
						</tr>
					</table>
				</div>';
		}	
	}else{
		$rvd = new Accesatabla('registro_visitas_domiciliarias');		
		$detalle = new Accesatabla('detalle_registro_visitas_domiciliarias');
		
		$inicio = $_GET['inicio'];
		$final = $_GET['final'];
		$fecha = $ds->dime('dia').' de '.$ds->dime('mes-'.$ds->dime('mes').'').' de '.$ds->dime('agno');
		$archivofinal = 'Registro-Visitas-Domiciliarias-'.$ds->dime('dia').'/'.$ds->dime('mes-'.$ds->dime('mes').'').'/'.$ds->dime('agno').'';
		$horasatencion =0;	
		$r = $rvd->buscardonde('FECHA BETWEEN "'.$inicio.'" AND "'.$final.'"  ORDER BY FECHA');			
		while($r){
			$horasatencion += $rvd->obtener('HORAS_DE_ATENCION');
			$r = $rvd->releer();
		}
		$html.='
			<center>
				<h3 class="fd-title">REGISTRO DIARIO DE VISITAS DOMICILIARIAS</h3>				
			</center>
			<div style="width:100%;font-size:14px;">
				<table style="width:100%;">
					<tr>
						<td><b>Fecha:</b> '.$fecha.'</td>
						<td><b>Horas Utilizadas:</b> '.$horasatencion.' </td>
					</tr>
				</table>
				<div width="100%">
					<h3 style="text-align:center;text-decoration:underline;">Visitas Realizadas de '.$inicio.' hasta '.$final.'</h3>
				</div>
				<table class="tabla" width="100%" cellspacing="0" style="font-size:12px">					
					<tr class="fd-head-tabla">
						<th style="min-width:20px;">No<br> Orden</th>
						<th>Fecha</th>
						<th>Institucion</th>
						<th>ZONA</th>
						<th>1. Aseg.<br> 2. No Aseg.</th>
						<th>Etnia</th>
						<th>1. Masc.<br> 2. Fem.</th>
						<th>C&eacute;dula</th>
						<th>Nombre del Visitado</th>
						<th>Categor&iacute;a (Programa)</th>
						<th>Observaciones</th>
					</tr>';
			$n = 1;			
			$r = $detalle->buscardonde('SECUENCIA > 0');	
			while($r){				
				$d = $rvd->buscardonde('ID_RVD = '.$detalle->obtener('ID_RVD').' AND FECHA BETWEEN "'.$inicio.'" AND "'.$final.'"  ORDER BY FECHA');						
				while($d){
					
					$institucion->buscardonde('ID_INSTITUCION = '.$rvd->obtener('ID_INSTITUCION').'');
				$html.='							
						<tr align="center">
							<td><b>'.$n++.'</b></td>
							<td>'.$rvd->obtener('FECHA').'</td>
							<td>'.$institucion->obtener('DENOMINACION').'</td>';
					$personas->buscardonde('ID_PACIENTE = '.$detalle->obtener('ID_PACIENTE').'');
					$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$personas->obtener('ID_RESIDENCIA_HABITUAL').'');
					$zona->buscardonde('ID_ZONA = '.$residencia->obtener('ID_ZONA').'');
						$html.='	<td>'.$zona->obtener('ZONA').'</td>
									<td>'.$personas->obtener('ID_TIPO_PACIENTE').'</td>';

					$etnia->buscardonde('ID_ETNIA = '.$personas->obtener('ID_ETNIA').'');
						$html.='	<td>'.$etnia->obtener('ETNIA').'</td>
									<td>'.$personas->obtener('ID_SEXO').'</td>
									<td>'.$personas->obtener('NO_CEDULA').'</td>
						  			<td>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').'</td>';

					$categoria->buscardonde('ID_CATEGORIA = '.$detalle->obtener('ID_CATEGORIA').'');
					$programa->buscardonde('ID_PROGRAMA = '.$detalle->obtener('ID_PROGRAMA').'');			
						$html.= '	<td>'.$categoria->obtener('CATEGORIA').' ('.$programa->obtener('PROGRAMA').')</td>
									<td>'.$detalle->obtener('OBSERVACIONES').'</td>
								</tr>
						';

					$d = $rvd->releer();
				}
				$r = $detalle->releer();
				
			}
			$html.='
				</table>
			</div>
			';
	}	
	

	$html.='	
	</body>
</html>';
	require_once("./mvc/modelo/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->set_paper('A4','landscape');//portrait
	$dompdf->load_html(utf8_encode($html));
	$dompdf->render();
	$canvas = $dompdf->get_canvas();
	$font = Font_Metrics::get_font("helvetica", "bold");
	$canvas->page_text(16, 800, "Pag: {PAGE_NUM}/{PAGE_COUNT}", $font, 8, array(0,0,0));
	$filename= "".$archivofinal.".pdf";
	if($_GET['imprimir']){
		$dompdf->stream($filename, array("Attachment"=>0));	
	}else{
		$dompdf->stream($filename);	
	}
?>
