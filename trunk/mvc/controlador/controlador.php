<?php
	class controlador{
		function __construct(){
			$url   = $_GET['url'];
			if(empty($_SESSION['idu']) AND ($url != 'verificar' AND $url != 'recuperar_acceso' AND $url != 'validar')){$url = 'login';}
			$vista = './mvc/vista/'.$url.'.php';	
			if(!file_exists( $vista )){ $vista = './mvc/vista/inicio.php'; }
			include($vista);
		}
	}
?>