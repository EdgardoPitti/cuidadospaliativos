<?php
	$q = strtolower($_GET["term"]);
	if (!$q) return; //si no nos trae nada retornamos
	$items[] = array();//creamos un array llamado items
	$cadena = trim($q); //le asignamos a cadena $Q sin espacios
		//conectamos con mysql y con la base de datos
	$con_mysql=mysql_connect('localhost','root','sql'); //nos conectamos con la BD
	// verificamos si la conexion con mysql ha sido exitosa
	if (!$con_mysql) {echo 'No se ha podido encontrar el servidor de datos';exit;}
		// si fue exitosa nos conectmos a la basse de datos empresa
	mysql_select_db('cuidados_paliativos_panama',$con_mysql);
	//consultamos los registros coincidentes, en este caso por apellido
	//echo "select * from cie10 where DESCRIPCION like '%$cadena%'";
	$select = mysql_query("select * from cie10 where DESCRIPCION like '%$cadena%'");
	//si no hay registros retornamos
	if(mysql_num_rows($select) == 0){return false;}
	else// para el caso q si haya registro conincidentes
	{
		//montamos bucle para presentar los items de la lista
		$i=0; //creo una variable del tipo entero
		while($fila=mysql_fetch_array($select))
		{
			$i++; //incremento
			//insertamos en el array los datos
			array_push($items,array("id"=>$i,"label"=>$fila["DESCRIPCION"],"value"=>$fila["DESCRIPCION"] ));
			
		}
	}
	//pasamos el array a formato JSON y lo imprimimos
	echo json_encode($items);
?>