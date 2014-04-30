<?php
    
	// Se recibe el t�rmino o palabra a buscar digitada desde el formulario 
   
	$palabra = $_GET['buscar']; 

	echo obtenerPacientes($palabra);
	flush();

	function obtenerPacientes($palabra) {  
        // Error 1: los pack estaban mal referenciados antes ../modelo/Diseno.php 
		// forma correcta ../modelo/diseno.php
		include_once('../modelo/diseno.php');

		$ds = new diseno();

		// Conexi�n a la base de datos, cambiar los par�metros si se requiere
		$conexionBD = mysqli_connect('localhost','root','sql','cuidados_paliativos_panama');
		//$conexionBD = mysqli_connect('mysql3000.mochahost.com','admproy_panama','cppanama2014','admproy_cuidados_paliativos_panama'); 
        
        if (!$conexionBD) {
            die('No se pudo conectar: ' . mysqli_error($conexionBD));
        }


		// Error 2: las mayúsculas y minúsculas son relevantes en Linux
		//Procuren que si las tablas de las base de datos están en minúsculas, realizar las consultas 
		// en minúsculas
		
	$consultaSQL = 'SELECT NO_CEDULA, concat(NO_CEDULA," ",PRIMER_NOMBRE," ",SEGUNDO_NOMBRE," ",APELLIDO_PATERNO," ",APELLIDO_MATERNO) AS NOMBRE FROM datos_pacientes WHERE concat(NO_CEDULA," ",PRIMER_NOMBRE," ",SEGUNDO_NOMBRE," ",APELLIDO_PATERNO," ",APELLIDO_MATERNO) LIKE "%'.$palabra.'%" ORDER BY NO_CEDULA'; 

        // Ejecuta la consulta

        $datos = mysqli_query($conexionBD, $consultaSQL);

        $coincidencias = ''; // Variable con resultados
        while($valores = mysqli_fetch_array($datos)) { // Recorre los datos
            // Arma la lista de palabras que coinciden y su ID
            $coincidencias .= $valores['NOMBRE'].'|'.$valores['NO_CEDULA']."\n";
        }
        mysqli_close($conexionBD); // Cierra la conexi�n
        return UTF8_encode($coincidencias); // Devuelve la lista
    }
?>