<?php
	// Se recibe el término o palabra a buscar digitada desde el formulario 
    $palabra = $_REQUEST['q']; 
    
     // Llama a la función obtenerTerminosCIE10() pasando el valor de la palabra
     // a buscar y realizando las consultas contra la base de datos. Se imprime 
     // la lista devuelta, que es capturada por la llamada AJAX que está viva en
     // el navegador y la devuelve a este, pasandola al control de texto.
	  echo obtenerTerminosCIE10($palabra);
    flush();
    
    // =========================================================================
    // Esta función busca las coincidencias de la palabra o término asociado con 
    // una enfermedad, contra una base de datos que contiene el catalogo CIE10
    // devuelve una lista de palabras coincidentes con su respectivo ID en forma 
    // de una cadena.
    function obtenerTerminosCIE10($palabra) {  
		include_once('../modelo/diseno.php');	
		$ds = new diseno();
        // Conexión a la base de datos, cambiar los parámetros si se requiere
        $conexionBD = mysqli_connect('localhost','root','sql','cuidados_paliativos_panama');
		//$conexionBD = mysqli_connect('mysql3000.mochahost.com','admproy_panama','cppanama2014','admproy_cuidados_paliativos_panama'); 
        if (!$conexionBD) {
            die('No se pudo conectar: ' . mysqli_error($conexionBD));
        }
        // Arma la consulta contra la tabla que tiene los datos sobre CIE10
        // observar como se realiza la busqueda del término
        $consultaSQL= 
            'SELECT ID_CIE10, concat(ID_CIE10," ",DESCRIPCION) as DESCRIPCION FROM cie10 WHERE concat(ID_CIE10," ",DESCRIPCION) LIKE "%'.strtoupper($palabra).'%" ORDER BY DESCRIPCION LIMIT 10;'; 
			
        // Ejecuta la consulta
        $datos = mysqli_query($conexionBD, $ds->latino($consultaSQL));
        $coincidencias = ''; // Variable con resultados
        while($valores = mysqli_fetch_array($datos)) { // Recorre los datos
            // Arma la lista de palabras que coinciden y su ID
            $coincidencias .= $valores['DESCRIPCION'].'|'.$valores['ID_CIE10']."\n";
        }
        mysqli_close($conexionBD); // Cierra la conexión
        return UTF8_encode($coincidencias); // Devuelve la lista
    }
?>

   
