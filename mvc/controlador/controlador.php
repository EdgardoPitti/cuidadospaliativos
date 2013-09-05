<?php
	class Controlador{
		function __construct(){
			switch($_GET[url]){
				case "domiciliaria_capturardatos":    		$vista = "domiciliaria_capturardatos"; 		 break;
				case "domiciliaria_surco": 			  		$vista = "domiciliaria_surco"; 				 break;
				case "domiciliaria_visita_realizada": 		$vista = "domiciliaria_visita_realizada"; 	 break;
				case "atencion_ambulatoria": 		  		$vista = "atencion_ambulatoria";	 		 break;
				case "agregardatosdomiciliaria": 		  	$vista = "agregardatosdomiciliaria";	 	 break;
				case "registrovisitasdomiciliaria": 		$vista = "domiciliarias_registro_visitas";	 break;
				case "hospitalaria_rae_capturardatos": 		$vista = "hospitalaria_rae_capturardatos";	 break;
				case "hospitalaria_rae_evolucion": 			$vista = "hospitalaria_rae_evolucion";	 	 break;
				case "ambulatoria_capturardatos": 			$vista = "ambulatoria_capturardatos";	 	 break;
				case "ambulatoria_atencionalpaciente": 		$vista = "ambulatoria_atencionalpaciente";	 break;
				default: $vista = "inicio";
			}	
			include_once('./mvc/vista/'.$vista.'.php');
		}	
	}
?>