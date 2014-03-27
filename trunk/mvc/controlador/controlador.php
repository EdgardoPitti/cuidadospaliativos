<?php
	class controlador{
		function __construct(){
			$url   = $_GET['url'];
			if(empty($_SESSION['idu']) AND $url != verificar){$url = login;}
			$vista = './mvc/vista/'.$url.'.php';	
			if(!file_exists( $vista )){ $vista = './mvc/vista/inicio.php'; }
			include_once($vista);
		}
	}
?>