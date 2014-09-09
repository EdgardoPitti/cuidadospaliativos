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
	
	$tratamiento = ''.$verbos->obtener('DESCRIPCION').' '.$det_recetas->obtener('DOSIS').' '.$medicamentos->obtener('DESCRIPCION').' '.$frecuencia->obtener('ABREVIATURA').' POR '.$det_recetas->obtener('TRATAMIENTO').' '.$periodo->obtener('DESCRIPCION').'';
	$cuidado = $cuidados->obtener('CUIDADOS');
	
	$cont='
		<div class="row-fluid">
			<h3 style="background:#e9e9e9;padding-top:7px;padding-bottom:7px;width:100%;text-align:center;"><a href="./?url=soap&id='.$idpaciente.'" class="btn btn-primary pull-left" title="Regresar" style="position:relative;top:-5px;left:10px;"><i class="icon-arrow-left icon-white"></i></a>Historia Cl&iacute;nica</h3>	
		</div>
		<div class="row-fluid" style="border:1px solid #e9e9e9;margin-top:-10px;width:99.9%;">
			<div class="span12" style="margin:15px 0px 0px 15px;">
				<h3 style="text-decoration:underline;">&nbsp;Datos del Paciente&nbsp;</h3>
				
				Fecha: <span style="text-decoration:underline;font-weight:bold;">&nbsp;'.$soap->obtener('FECHA').'&nbsp;</span><br>
				Nombre: <span style="text-decoration:underline;">&nbsp;'.$paciente->obtener('PRIMER_NOMBRE').' '.$paciente->obtener('SEGUNDO_NOMBRE').' '.$paciente->obtener('APELLIDO_PATERNO').' '.$paciente->obtener('APELLIDO_MATERNO').'&nbsp;</span><br>
				Edad: <span style="text-decoration:underline;">&nbsp;'.$ds->edad($dia,$mes,$anio).' A&ntilde;os &nbsp;</span> Sexo: <span style="text-decoration:underline;">&nbsp;'.$sexo.'&nbsp;</span><br>
				Cuidador: <span style="text-decoration:underline;">&nbsp;'.$paciente->obtener('CUIDADOR').'&nbsp;</span> Parentezco: <span style="text-decoration:underline;">&nbsp;'.$paciente->obtener('PARENTEZCO_CUIDADOR').'&nbsp;</span><br>
				
				<h3 style="text-decoration:underline;">&nbsp;Consultas&nbsp;</h3>
				
				Motivo de la Consulta: <span style="text-decoration:underline;">&nbsp;'.$soap->obtener('MOTIVO_CONSULTA').'&nbsp;</span><br>
				Objetivo de la Consulta: <span style="text-decoration:underline;">&nbsp;'.$soap->obtener('OBJETIVO_CONSULTA').'&nbsp;</span><br>								 
			</div>
		</div>		
		';	
	
	$ds->contenido($cont);
	$ds->mostrar();
?>