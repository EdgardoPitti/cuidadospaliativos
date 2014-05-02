<?php
	include_once('./mvc/modelo/Accesatabla.php');	
	include_once('./mvc/modelo/diseno.php');	
	$ds = new Diseno();
	$usuario = new Accesatabla('usuarios');
	$preferencias = new Accesatabla('preferencias_recuperacion_acceso');
	$autenticacion = new Accesatabla('datos_autenticacion_usuario');
	if($_SESSION['idgu'] == 2){
		echo '<script>alert("No tiene permitido entrar a estas vistas.")</script>SCRIPT languague="JAVASCRIPT">location.href = "./?url=inicio"</SCRIPT>';
	}else{
		$id = $_GET['id'];
		if(!empty($id)){
			$usuario->buscardonde('ID_USUARIO = '.$id.'');
		}else{
			$usuario->nuevo();
		}
		$usuario->colocar("NO_IDENTIFICACION", $_POST['no_identificacion']);
		$usuario->colocar("CLAVE_ACCESO", $_POST['clave']);
		$usuario->colocar("ID_GRUPO_USUARIO", 1);
		$usuario->salvar();
		if(!empty($id)){
			$preferencias->buscardonde('ID_USUARIO = '.$id.'');
			$autenticacion->buscardonde('ID_USUARIO = '.$id.'');
			$msj = 'Datos actualizados Correctamente.';
		}else{
			$sql = 'SELECT MAX(ID_USUARIO) AS id FROM usuarios';
			$matriz = $ds->db->obtenerArreglo($sql);
			$id = $matriz[0][id];
			$preferencias->colocar("ID_USUARIO", $id);
			$autenticacion->colocar("ID_USUARIO", $id);
			$msj = 'Datos Almacenados Correctamente.';
		}
		$autenticacion->colocar("ID_PREGUNTA", $_POST['pregunta']);
		$autenticacion->colocar("RESPUESTA", $_POST['respuesta']);
		$autenticacion->colocar("TELEFONO_PREFERENCIAL", $_POST['telefono']);
		$autenticacion->colocar("E_MAIL_PREFERENCIAL", $_POST['correo']);
		$autenticacion->salvar();
		$preferencia = $_POST['preferencia'];
		if($preferencia == 1){
			$pregunta = 1;
			$correo = 0;
			$telefono = 0;
		}elseif($preferencia == 2){
			$pregunta = 0;
			$correo = 0;
			$telefono = 1;		
		}elseif($preferencia == 3){
			$pregunta = 0;
			$correo = 1;
			$telefono = 0;
		}
		$preferencias->colocar("USAR_PREGUNTA_SEGURIDAD", $pregunta);
		$preferencias->colocar("USAR_TELEFONO_PREFERENCIAL", $telefono);
		$preferencias->colocar("USAR_EMAIL_PREFERENCIAL", $correo);
		$preferencias->salvar();

		echo '<script language="javascript">alert("'.$msj.'")</script><SCRIPT LANGUAGE="javascript">location.href = "./?url=usuarios&id='.$id.'&sbm=5"</SCRIPT>';
	}
?>