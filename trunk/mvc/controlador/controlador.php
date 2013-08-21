<?php
	class Controlador{
		function __construct(){
			switch($_GET[url]){
				case "atencion_domiciliaria": 		  		$vista = "atencion_domiciliaria"; 	   		 break;
				case "domiciliaria_capturardatos":    		$vista = "domiciliaria_capturardatos"; 		 break;
				case "domiciliaria_surco": 			  		$vista = "domiciliaria_surco"; 				 break;
				case "domiciliaria_visita_realizada": 		$vista = "domiciliaria_visita_realizada"; 	 break;
				case "atencion_ambulatoria": 		  		$vista = "atencion_ambulatoria";	 		 break;
				case "agregardatosdomiciliaria": 		  	$vista = "agregardatosdomiciliaria";	 	 break;
				default: $vista = "inicio";
			}	
			include_once('./mvc/vista/'.$vista.'.php');
		}	
	}
?>