<?php
	include_once('./mvc/modelo/Accesatabla.php');
	$datos_prof_salud = new Accesatabla('datos_profesionales_salud');
	$prof_salud = new Accesatabla('profesionales_salud');
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$idp = $_GET['idp'];
	$usuarios = new Accesatabla('usuarios');
	$preferencias = new Accesatabla('preferencias_recuperacion_acceso');
	$autenticacion = new Accesatabla('datos_autenticacion_usuario');
	
	if(empty($idp)){
		$usuarios->nuevo();
		$usuarios->colocar("ID_GRUPO_USUARIO", 3);
		$usuarios->colocar("CLAVE_ACCESO", $_POST['pass']);
		$usuarios->colocar("NO_IDENTIFICACION", $_POST['usuario']);
		$usuarios->salvar();
				
		$sql = 'SELECT MAX(ID_USUARIO) AS id FROM usuarios';
		$id = $ds->db->obtenerArreglo($sql);
		$idusuario = $id[0][id];
		
		$prof_salud->nuevo();
		$prof_salud->colocar('ID_ESPECIALIDAD_MEDICA', $_POST['especialidad']);	
		$prof_salud->colocar('ID_USUARIO', $idusuario);	
		$prof_salud->salvar();

		$sql = 'SELECT MAX(ID_PROFESIONAL) AS id FROM profesionales_salud';
		$id = $ds->db->obtenerArreglo($sql);
		$idp = $id[0][id];

		$datos_prof_salud->nuevo();
		$datos_prof_salud->colocar('ID_PROFESIONAL',$idp);
		
	}else{
		$datos_prof_salud->buscardonde('ID_PROFESIONAL = '.$idp.'');
		$prof_salud->buscardonde('ID_PROFESIONAL = '.$idp.'');
		$usuarios->buscardonde('ID_USUARIO = '.$prof_salud->obtener('ID_USUARIO').'');
		$preferencias->buscardonde('ID_USUARIO = '.$prof_salud->obtener('ID_USUARIO').'');
		$autenticacion->buscardonde('ID_USUARIO = '.$prof_salud->obtener('ID_USUARIO').'');
		$idusuario = $prof_salud->obtener('ID_USUARIO');
	}
	
	$pregunta = 0;
	$telefono = 0;
	$email = 0;
	if($_POST['preferencia'] == 1){
		$pregunta = 1;
	}elseif($_POST['preferencia'] == 2){
		$telefono = 1;
	}elseif($_POST['preferencia'] == 3){
		$email = 1;
	}
	$preferencias->colocar("ID_USUARIO", $idusuario);
	$preferencias->colocar("USAR_PREGUNTA_SEGURIDAD", $pregunta);
	$preferencias->colocar("USAR_TELEFONO_PREFERENCIAL", $telefono);
	$preferencias->colocar("USAR_EMAIL_PREFERENCIAL", $email);
	$preferencias->salvar();
	
	$autenticacion->colocar("ID_USUARIO", $idusuario);
	$autenticacion->colocar("ID_PREGUNTA", $_POST['pregunta']);
	$autenticacion->colocar("RESPUESTA", $_POST['respuesta']);
	$autenticacion->colocar("TELEFONO_PREFERENCIAL", $_POST['celular']);
	$autenticacion->colocar("E_MAIL_PREFERENCIAL", $_POST['email']);
	$autenticacion->salvar();
	
	$datos_prof_salud->colocar('NO_CEDULA',$_POST['cedula']);
	$datos_prof_salud->colocar('PRIMER_NOMBRE',$_POST['primernombre']);
	$datos_prof_salud->colocar('SEGUNDO_NOMBRE',$_POST['segnombre']);
	$datos_prof_salud->colocar('APELLIDO_PATERNO',$_POST['primerapellido']);
	$datos_prof_salud->colocar('APELLIDO_MATERNO',$_POST['segapellido']);
	$datos_prof_salud->colocar('NO_IDONEIDAD',$_POST['idoneidad']);
	$datos_prof_salud->colocar('NO_REGISTRO',$_POST['registro']);
	$datos_prof_salud->colocar('TELEFONO_CASA',$_POST['telefono']);
	$datos_prof_salud->colocar('TELEFONO_CELULAR',$_POST['celular']);
	$datos_prof_salud->colocar('E_MAIL',$_POST['email']);
	$datos_prof_salud->salvar();
	if(!empty($idp)){
		$prof_salud->colocar('ID_ESPECIALIDAD_MEDICA',$_POST['especialidad']);	
		$prof_salud->salvar();
	}
	include_once('./mvc/vista/addmedico.php');
	echo '<SCRIPT LANGUAGE="javascript">location.href = "./?url=addmedico&idp='.$idp.'"</SCRIPT>';
?>