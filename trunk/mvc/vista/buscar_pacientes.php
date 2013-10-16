<?php
    // Se recibe el t�rmino o palabra a buscar digitada desde el formulario 
    $palabra = $_REQUEST['buscar']; 
    
    echo obtenerPacientes($palabra);
    flush();

    function obtenerPacientes($palabra) {    
        
        // Conexi�n a la base de datos, cambiar los par�metros si se requiere
        $conexionBD = mysqli_connect('localhost','root','sql','cuidados_paliativos_panama');
        if (!$conexionBD) {
            die('No se pudo conectar: ' . mysqli_error($conexionBD));
        }

        $consultaSQL= 
            'SELECT NO_CEDULA, concat(NO_CEDULA," ",PRIMER_NOMBRE," ",SEGUNDO_NOMBRE," ",APELLIDO_PATERNO," ",APELLIDO_MATERNO) AS NOMBRE FROM DATOS_PACIENTES WHERE NO_CEDULA LIKE "%' 
            . strtoupper($palabra) . '%" ORDER BY NO_CEDULA'; 
    
        // Ejecuta la consulta
        $datos = mysqli_query($conexionBD, $consultaSQL);
        $coincidencias = ''; // Variable con resultados
        while($valores = mysqli_fetch_array($datos)) { // Recorre los datos
            // Arma la lista de palabras que coinciden y su ID
            $coincidencias .= $valores['NOMBRE'].'|'.$valores['NO_CEDULA']."\n";
        }
        mysqli_close($conexionBD); // Cierra la conexi�n
        return $coincidencias; // Devuelve la lista
    }
?>