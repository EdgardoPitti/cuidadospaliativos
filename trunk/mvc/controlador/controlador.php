<?php
	class controlador{
		function __construct(){
			$url   = $_GET['url'];
			$vista = './mvc/vista/'.$url.'.php';
			if(!file_exists( $vista )){ $vista = './mvc/vista/file404.php'; }
			include_once($vista);
		}
	}
?>