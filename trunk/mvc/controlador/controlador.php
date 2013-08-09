<?php
	class Controlador{
		function __construct(){
			switch($_GET[url]){
				case "domiciliaria_capturardatos": $vista = "domiciliaria_capturardatos"; break;
				case "domiciliaria_surco": $vista = "domiciliaria_surco"; break;
				default: $vista = "inicio";
			}	
			include_once('./mvc/vista/'.$vista.'.php');
		}	
	}
?>