<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();

	$idpaciente = $_GET['id'];	
	
	$datos_escala = new Accesatabla('escala_edmonton');
	$paciente = new Accesatabla('datos_pacientes');
	$tiposangre = new Accesatabla('tipos_sanguineos');	
	$soap = new Accesatabla('soap');
	$det_soap = new Accesatabla('detalle_soap');
	$imp_diag = new Accesatabla('impresion_diagnostica');
	$det_imp_diag = new Accesatabla('detalle_impresion_diagnostica');
	$cie10 = new Accesatabla('cie10');
	$formas = new Accesatabla('formas_farmaceuticas');
	$cuidados = new Accesatabla('cuidados_tratamientos');
	$recetas = new Accesatabla('recetas_medicas');
	$det_recetas = new Accesatabla('detalle_receta');	
	$medicamentos = new Accesatabla('medicamentos');
	$vias = new Accesatabla('vias_administracion');	
	$frecuencia = new Accesatabla('frecuencias_tratamientos');
	$verbos = new Accesatabla('verbos_recetas');
	$unidad = new Accesatabla('unidades_medida');
	$periodo = new Accesatabla('periodo_tratamiento');
	$cuadro_medicamento = new Accesatabla('tipos_cuadros_medicamentos');
	$medicamentos = new Accesatabla('medicamentos');
	
	$paciente->buscardonde('ID_PACIENTE = '.$idpaciente.'');
	if ($paciente->obtener('ID_SEXO') == 1){
		$sexo = 'MASCULINO';
	}else{
		$sexo = 'FEMENINO';
	}
	list($anio, $mes, $dia) = explode("-", $paciente->obtener('FECHA_NACIMIENTO'));
	$sql = 'SELECT MAX(ID_SOAP) AS id FROM soap WHERE ID_PACIENTE = '.$idpaciente;
	$matriz = $ds->db->obtenerArreglo($sql);
	$id_soap = $matriz[0][id];
	$soap->buscardonde('ID_SOAP = '.$id_soap.'');
	
	$sql = 'SELECT MAX(ID_ESCALA) AS ID FROM escala_edmonton WHERE ID_PACIENTE = '.$idpaciente.'';
	$arreglo = $ds->db->obtenerArreglo($sql);
	$idescala = $arreglo[0][ID];
	
	$datos_escala->buscardonde('ID_ESCALA = '.$idescala.'');	
	$det_soap->buscardonde('ID_SOAP = '.$id_soap.'');
	
	$cuidados->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS'));	
	$recetas->buscardonde('ID_CUIDADOS_TRATAMIENTOS = '.$det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS').'');
	$det_recetas->buscardonde('ID_RECETA = '.$recetas->obtener('ID_RECETA').'');
	$medicamentos->buscardonde('ID_MEDICAMENTO = '.$det_recetas->obtener('ID_MEDICAMENTO').'');		
	$verbos->buscardonde('ID_VERBO = '.$det_recetas->obtener('ID_DOSIS').'');
	$frecuencia->buscardonde('ID_FRECUENCIA_TRATAMIENTO = '.$det_recetas->obtener('ID_FRECUENCIA_TRATAMIENTO').'');	
	$periodo->buscardonde('ID_PERIODO = '.$det_recetas->obtener('ID_PERIODO_TRATAMIENTO').'');
	
	if(empty($det_soap->obtener('ID_CUIDADOS_TRATAMIENTOS'))) {
		$tratamiento = 'No tiene Tratamientos M&eacute;dicos';
		$cuidado = 'No tiene Cuidados';	
	}else{
		$tratamiento = ''.$verbos->obtener('DESCRIPCION').' '.$det_recetas->obtener('DOSIS').' '.$medicamentos->obtener('DESCRIPCION').' '.$frecuencia->obtener('ABREVIATURA').' POR '.$det_recetas->obtener('TRATAMIENTO').' '.$periodo->obtener('DESCRIPCION').'';
		$cuidado = $cuidados->obtener('CUIDADOS');
	}
	
	$cont='
		<div class="row-fluid">
			<h2 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;"><a href="./?url=soap&id='.$idpaciente.'" class="btn btn-primary pull-left" title="Regresar" style="position:relative;top:-5px;left:10px;"><i class="icon-arrow-left icon-white"></i></a>Historia Cl&iacute;nica</h2>	
		</div>
		<div class="row-fluid" style="border:1px solid #e3e3e3;margin-top:-10px;width:99.9%;">
			<div class="span12" style="margin:15px 0px 0px 15px;">
				Fecha: <span style="text-decoration:underline;font-weight:bold;">'.$soap->obtener('FECHA').'</span><br>
				
				<h3 style="text-decoration:underline;">Datos del Paciente</h3>
				<div class="row-fluid">
					<div class="span4">
						Nombre: <span style="text-decoration:underline;">'.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('SEGUNDO_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').' '.$paciente->obtener('APELLIDO_MATERNO').'</span>											
					</div>
					<div class="span4">
						Edad: <span style="text-decoration:underline;">'.$ds->edad($dia,$mes,$anio).' A&ntilde;os </span> Sexo: <span style="text-decoration:underline;">'.$sexo.'</span>									
					</div>
					<div class="span4">
						Cuidador: <span style="text-decoration:underline;">'.$paciente->obtener('CUIDADOR').'</span> Parentezco: <span style="text-decoration:underline;">'.$paciente->obtener('PARENTEZCO_CUIDADOR').'</span>
					</div>				
				</div>
				<div class="row-fluid">
					<h3 style="background:#e9e9e9;padding-top:7px;margin-left:-15px;padding-bottom:7px;width:100%;text-align:center;">Datos SOAP</h3>	
				</div>				
					
				<h3 style="text-decoration:underline;">Consultas</h3>
				
				Motivo de la Consulta: <span style="text-decoration:underline;"> '.$soap->obtener('MOTIVO_CONSULTA').' </span><br>
				Objetivo de la Consulta: <span style="text-decoration:underline;"> '.$soap->obtener('OBJETIVO_CONSULTA').' </span><br>		
				
				<h3 style="text-decoration:underline;"> ESAS-R </h3>';
		$sw = 0;
		if($datos_escala->obtener('DOLOR') >= 7){
			$cont.= 'Dolor: '.$datos_escala->obtener('DOLOR').'';
			$sw = 1;
		}	
		if($datos_escala->obtener('CANSANCIO') >= 7){
			if($sw == 1){
				$cont.='<br>';
			}else{
				$sw = 1;
			}
			$cont.='Cansancio: '.$datos_escala->obtener('CANSANCIO').'';
		}
		if($datos_escala->obtener('NAUSEA') >= 7){
			if($sw == 1){
				$cont.='<br>';
			}else{
				$sw = 1;
			}
			$cont.='Nausea: '.$datos_escala->obtener('NAUSEA').'';
		}
		if($datos_escala->obtener('DEPRESION') >= 7){
			if($sw == 1){
				$cont.='<br>';
			}else{
				$sw = 1;
			}
			$cont.='Depresion: '.$datos_escala->obtener('DEPRESION').'';
		}
		if($datos_escala->obtener('ANSIEDAD') >= 7){
			if($sw == 1){
				$cont.='<br>';
			}else{
				$sw = 1;
			}
			$cont.='Ansiedad: '.$datos_escala->obtener('ANSIEDAD').'';
		}
		if($datos_escala->obtener('SOMNOLENCIA') >= 7){
			if($sw == 1){
				$cont.='<br>';
			}else{
				$sw = 1;
			}
			$cont.='Somnolencia: '.$datos_escala->obtener('SOMNOLENCIA').'';
		}
		if($datos_escala->obtener('APETITO') >= 7){
			if($sw == 1){
				$cont.='<br>';
			}else{
				$sw = 1;
			}
			$cont.='Apetito: '.$datos_escala->obtener('APETITO').'';
		}
		if($datos_escala->obtener('BIENESTAR') >= 7){
			if($sw == 1){
				$cont.='<br>';
			}else{
				$sw = 1;
			}
			$cont.='Bienestar: '.$datos_escala->obtener('BIENESTAR').'';
		}
		if($datos_escala->obtener('AIRE') >= 7){
			if($sw == 1){
				$cont.='<br>';
			}else{
				$sw = 1;
			}
			$cont.='Aire: '.$datos_escala->obtener('AIRE').'';
		}
		if($datos_escala->obtener('DORMIR') >= 7){
			if($sw == 1){
				$cont.='<br>';
			}else{
				$sw = 1;
			}
			$cont.='Dormir: '.$datos_escala->obtener('DORMIR').'';
		}
	
	$cont.='				
				<h3 style="text-decoration:underline;">Impresi&oacute;n Diagn&oacute;stica</h3>
				<center>
					<div class="overflow overthrow" style="width:90%;">
						<table class="table2 borde-tabla" >
							<thead>
								<tr class="fd-table">
									<th>Diagn&oacute;stico</th>
									<th>CIE-10</th>
									<th>Observaci&oacute;n</th>	
								</tr>
							</thead>				
							<tbody>
						';
						
						$x = $det_imp_diag->buscardonde('ID_IMPRESION_DIAGNOSTICA = '.$det_soap->obtener('ID_IMPRESION_DIAGNOSTICA').'');
						while($x) {
							$cie10->buscardonde('ID_CIE10 = "'.$det_imp_diag->obtener('ID_CIE10').'"');
							
						$cont.='
								<tr>
									<td>'.$cie10->obtener('DESCRIPCION').'</td>
									<td>'.$cie10->obtener('ID_CIE10').'</td>
									<td>'.$det_imp_diag->obtener('OBSERVACION').'</td>														
								</tr>';
							$x = $det_imp_diag->releer();								
						}	 
			$cont.='
							</tbody>		
						</table>
					</div>		
				</center>
				
				<h3 style="text-decoration:underline;">Cuidados y Tratamientos</h3>
				Cuidados: <span style="text-decoration:underline;">'.$cuidado.'</span><br>
				Tratamientos: <span style="text-decoration:underline;">'.$tratamiento.'</span>	
				
				<h3 style="text-decoration:underline;">Observaciones</h3>';
				if(empty($soap->obtener('OBSERVACIONES'))) {
						$cont.='No tiene ninguna observaci&oacute;n';				
				}else{
						$cont.= $soap->obtener('OBSERVACIONES');				
				}
				$cont.='
			</div>
		</div>		
		';	
	
	$ds->contenido($cont);
	$ds->mostrar();
?>