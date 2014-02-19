<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	
	$personas = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');
	$residencia = new Accesatabla('residencia_habitual');
	$provincias = new Accesatabla('provincias');
	$distritos = new Accesatabla('distritos');
	$corregimientos = new Accesatabla('corregimientos');
	$instituciones = new Accesatabla('institucion');
	$clasificacion = new Accesatabla('clasificacion_atencion_solicitada');
	$servicios = new Accesatabla('servicios_medicos');
	$motivoreferencia = new Accesatabla('motivo_referencia');
	$surco = new Accesatabla('surco');
	$cie = new Accesatabla('cie10');
	$tipoexamen = new Accesatabla('tipo_examen');
	$frecuencia = new Accesatabla('frecuencia');
	$historia = new Accesatabla('historia_paciente');
	$examenfisico = new Accesatabla('examen_fisico');
	$resultado = new Accesatabla('resultados_examen_diagnostico');
	$detallediagnostico = new Accesatabla('detalle_diagnostico');
	$profesional = new Accesatabla('datos_profesionales_salud');
	$respuesta = new Accesatabla('respuesta_referencia');
	
	$cedula = $_GET['idpac'];
	$resp = $_GET['idr'];
	$tipo_surco = $_GET['tiporef'];
	
	$html='
<html>
	<head>
		<title>Cuidados Paliativos</title>
	
		<link href="./iconos/logo_medicina.ico" type="image/x-icon" rel="shortcut icon" />
	
		<style type="text/css">
			.fd-title{background:#f4f4f4;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;}
			h3{text-decoration:underline;} p{padding:0px;margin:0px;}
			.fd-head-tabla{background:#f4f4f4;width:100%;text-align:center;}
			.tabla td,.tabla th{border:1px solid #c9c9c9;}
		</style>
	</head>
	<body>
		<div style="font-size:14px;">';
	$cont_gral='
		<center>
			<h3 class="fd-title"> Sistema Único de Referencia y Contra-Referencia (SURCO)</h3>
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
	list($anio, $mes, $dia) = explode("-", $personas->obtener('FECHA_NACIMIENTO'));
	
	$cont_gral.='
				<div style="width:100%;max-width:315px;float:left;"> 
					<h3>Paciente</h3>
					<table align="center" style="width:100%;text-align:center;padding-top:-28px">											
						<tr>
							<td colspan="3"><h4>'.$personas->obtener('PRIMER_NOMBRE').' '.$personas->obtener('SEGUNDO_NOMBRE').' '.$personas->obtener('APELLIDO_PATERNO').' '.$personas->obtener('APELLIDO_MATERNO').'</h4></td>
						</tr>
						<tr>
							<td>'.$ced.'</td>
							<td>'.$tiposangre->obtener('TIPO_SANGRE').'</td>
							<td>'.$sexo.'</td>
						</tr>
						<tr>
							<td>'.$dia.'/'.$mes.'/'.$anio.'</td>
							<td>'.$asegurado.'</td>
							<td>'.$personas->obtener('EDAD_PACIENTE').' Años</td>
						</tr>
					</table>
				</div>
				<div style="width:100%;max-width:315px;float:right;">					
					<h3>Dirección</h3>
					<table align="center" style="width:100%;text-align:center;padding-top:10px">
						<tr>
							<td>'.$distritos->obtener('DISTRITO').' , '.$provincias->obtener('PROVINCIA').'</td>
						</tr>
						<tr>
							<td>'.$corregimientos->obtener('CORREGIMIENTO').' , '.$residencia->obtener('DETALLE').'</td>
						</tr>
					</table>
				</div>';
		
		$html .= $cont_gral;		
		
	if($tipo_surco == 1){
			$archivofinal='Referencia-'.$ced.'';
	
			$surco->buscardonde('ID_PACIENTE = '.$personas->obtener('ID_PACIENTE').'');
			//DATOS A MOSTRAR AL IMPRIMIR
			$instituciones->buscardonde('ID_INSTITUCION = '.$surco->obtener('INSTALACION_REFIERE').'');
			$inst_refiere = $instituciones->obtener('DENOMINACION');
			$servicios->buscardonde('ID_SERVICIO = '.$surco->obtener('ID_SERVICIO').'');
			$instituciones->buscardonde('ID_INSTITUCION = '.$surco->obtener('INSTALACION_RECEPTORA').'');
			$inst_receptora = $instituciones->obtener('DENOMINACION');
			$clasificacion->buscardonde('ID_CLASIFICACION_ATENCION_SOLICITADA = '.$surco->obtener('ID_CLASIFICACION_ATENCION_SOLICITADA').'');									
			$motivoreferencia->buscardonde('ID_MOTIVO_REFERENCIA = '.$surco->obtener('ID_MOTIVO_REFERENCIA').'');
		$html.='
			<div style="float:none;clear:both;">
				<h3>Datos Referencia</h3>
				<table width="100%" style="line-height:14px;">
					<tr>
						<td>Instalación que Refiere:</td>
						<td><p style="text-decoration:underline;">'.$inst_refiere.'</p></td>
						<td>Servicio Médico al que se refiere:</td>
						<td><p style="text-decoration:underline;">'.$servicios->obtener('DESCRIPCION').'</p></td>
					</tr>
					<tr>
						<td>Instalación Receptora:</td>
						<td><p style="text-decoration:underline;">'.$inst_receptora.'</p></td>
						<td>Clasificación de la Atención solicitada:</td>
						<td><p style="text-decoration:underline;">'.$clasificacion->obtener('CLASIFICACION_ATENCION_SOLICITADA').'</p></td>
					</tr>
					<tr>
						<td>Motivo de Referencia:</td>
						<td><p style="text-decoration:underline;">'.$motivoreferencia->obtener('MOTIVO_REFERENCIA').'</p></td>
						<td colspan="2"></td>
					</tr>
				</table>
			</div>
			<h3>Historial del Paciente</h3>
			';
			$historia->buscardonde('ID_HISTORIA_PACIENTE = '.$surco->obtener('ID_HISTORIA_PACIENTE').'');
			$examenfisico->buscardonde('ID_EXAMEN_FISICO = '.$historia->obtener('ID_EXAMEN_FISICO').'');
		$html.='	
			<table style="margin-top:10px;">
				<tr>
					<td>Anamnesis: </td>
					<td><p style="text-decoration:underline;">'.$historia->obtener('ANAMNESIS').'</p></td>
				</tr>
				<tr>							
					<td>Observaciones: </td>
					<td><p style="text-decoration:underline;">'.$historia->obtener('OBSERVACIONES').'</p></td>
				</tr>
			</table>
			
			<h4><b>Examen Físico:</b></h4>
			<table class="tabla" width="100%">
				<tr class="fd-head-tabla">
					<th>Hora</th>
					<th>Presión Arterial</th>
					<th>Frecuencia Cardiaca</th>
					<th>Frecuencia Respiratoria</th>
					<th>Frecuencia Cardiaca Fetal</th>
					<th>Temperatura</th>
					<th>Peso<small>(Kg)</small></th>
					<th>Talla<small>(mts)</small></th>
				</tr>
				<tr align="center">
					<td style="padding-top:10px">'.$examenfisico->obtener('HORA').'</td>
					<td style="padding-top:10px">'.$examenfisico->obtener('PRESION_ARTERIAL').'</td>
					<td style="padding-top:10px">'.$examenfisico->obtener('FRECUENCIA_CARDIACA').'</td>
					<td style="padding-top:10px">'.$examenfisico->obtener('FRECUENCIA_RESPIRATORIA').'</td>
					<td style="padding-top:10px">'.$examenfisico->obtener('FRECUENCIA_CARDIACA_FETAL').'</td>
					<td style="padding-top:10px">'.$examenfisico->obtener('TEMPERATURA').'</td>
					<td style="padding-top:10px">'.$examenfisico->obtener('PESO').'</td>
					<td style="padding-top:10px">'.$examenfisico->obtener('TALLA').'</td>
				</tr>
			</table>';
				
			//IMPRESION DE RESULTADOS EXAMEN DIAGNOSTICO
			$html.='
				<h3>Resultados de Exámenes/Diagnóstico</h3>			
				<table class="tabla"  width="100%" style="margin-top:7px;text-align:center;">
					<tr class="fd-head-tabla">
						<th width="80px">Tipo de Examen</th>
						<th>Diagnóstico</th>
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
		//IMPRESIÓN DE LOS DATOS DEL PROFESIONAL
			$profesional->buscardonde('ID_PROFESIONAL = '.$surco->obtener('ID_PROFESIONAL').'');			
			$html.='
				</table>
				<h3>Datos del Profesional</h3>
				<table width="100%">
					<tr>	
						<td>Nombre de quien refiere:</td>
						<td><p style="text-decoration:underline;">'.$profesional->obtener('PRIMER_NOMBRE').' '.$profesional->obtener('SEGUNDO_NOMBRE').' '.$profesional->obtener('APELLIDO_PATERNO').' '.$profesional->obtener('APELLIDO_MATERNO').'</p></td>													
					</tr>
				</table>';
	}else{
		$archivofinal = 'Respuesta-a-la-Referencia-'.$ced.'';
		$respuesta->buscardonde('ID_RESPUESTA_REFERENCIA = '.$resp.'');
		$html.='
			<table style="width:100%;margin-top:150px;">
				<tr>
					<td>Institución que Responde:</td>';
			$instituciones->buscardonde('ID_INSTITUCION = '.$respuesta->obtener('INSTITUCION_RESPONDE').'');					
			$html .= '
					<td><p style="text-decoration:underline;">'.$instituciones->obtener('DENOMINACION').'</p></td>
					<td>Instalación Receptora:</td>';
			$instituciones->buscardonde('ID_INSTITUCION = '.$respuesta->obtener('INSTITUCION_RESPONDE').'');
			$html.='
					<td><p style="text-decoration:underline;">'.$instituciones->obtener('DENOMINACION').'</p></td>
				</tr>
			</table>
			<h3>Hallazgos Clínicos</h3>';
			$detallediagnostico->buscardonde('ID_DIAGNOSTICO = '.$respuesta->obtener('ID_DIAGNOSTICO').'');
			$cie->buscardonde('ID_CIE10 = "'.$detallediagnostico->obtener('ID_CIE10').'"');
		$html.='
			<table style="width:100%;">
				<tr>
					<td>Diagnóstico:</td>
					<td><p style="text-decoration:underline;">'.$cie->obtener('DESCRIPCION').'</p></td>
					<td>Hallazgos Clinicos:</td>
					<td><p style="text-decoration:underline;">'.$respuesta->obtener('HALLAZGOS_CLINICOS').'</p></td>
				</tr>
				<tr>
					<td>CIE-10:</td>
					<td><p style="text-decoration:underline;">'.$cie->obtener('ID_CIE10').'</p></td>
					<td>Observaciones:</td>
					<td><p style="text-decoration:underline;">'.$detallediagnostico->obtener('OBSERVACION').'</p></td>
				</tr>
				<tr>
					<td>Frecuencia:</td>';
				$frecuencia->buscardonde('ID_FRECUENCIA = "'.$detallediagnostico->obtener('ID_FRECUENCIA').'"');
				$html.='	
					<td><p style="text-decoration:underline;">'.$frecuencia->obtener('FRECUENCIA').'</p></td>
					<td>Manejo y Tratamiento:</td>
					<td><p style="text-decoration:underline;">'.$respuesta->obtener('TRATAMIENTO').'</p></td>
				</tr>
			</table>
		<h3>Datos del Profesional</h3>
		';
		$profesional->buscardonde('ID_PROFESIONAL = '.$respuesta->obtener('ID_PROFESIONAL').'');
		$var1 = $profesional->obtener('SEGUNDO_NOMBRE');
		$var2 = $profesional->obtener('APELLIDO_MATERNO');
		$nombre = $profesional->obtener('PRIMER_NOMBRE').' '.$var1[0].'. '.$profesional->obtener('APELLIDO_PATERNO').' '.$var2[0].'.';
		if($respuesta->obtener('REEVALUACION_ESPECIALIZADA') == 1){
			$reev_esp= 'Sí';
		}else{
			$reev_esp= 'No';
		}
		$html.='
		<table>
			<tr>
				<td>Reevaluación Especializada: </td>
				<td><p style="text-decoration:underline;">'.$reev_esp.'</p></td>
			</tr>
			<tr>
				<td>Fecha: </td>
				<td><p style="text-decoration:underline;">'.$respuesta->obtener('FECHA').'</p></td>
			</tr>
			<tr>
				<td>Profesional: </td>
				<td><p style="text-decoration:underline;">'.$nombre.'</p></td>
			</tr>
		</table>';
	}	
	$html.='	
		</div>
	</body>
</html>';
	require_once("./mvc/modelo/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->set_paper('A4','portrait');
	$dompdf->load_html($html);
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
