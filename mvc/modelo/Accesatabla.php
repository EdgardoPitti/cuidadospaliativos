<?php	class Accesatabla {
	
	private $db=null, $estatabla, $esnuevo, $registro, $totaldelineas, $estalinea, $totaldecampos=0, $ultimosql='' ;
	private $cambiados = array () , $contenido = array ();
	private $tipocampo = array () , $loscampos = array ();
	
	//Comentarios suponiendo que los parametros ingresados sean correctos.
	public function __construct( $esatabla ){//Obtiene la informacion de la tabla que se envia al crear el objeto.
		include_once('db.php');
		$this->db = new db();
		$this->db->query('desc '.$esatabla.' ;');
		//Obtiene la cantidad total de campos en la tabla
		$this->totaldecampos = $this->db->rows();
		if($this->totaldecampos===false){
			echo '<h1 style="background-color:#FF0000; color:#FFFF00;">Unknown Table '.$esatabla."</h1>";
		} else {
			$this->totaldecampos -- ;
			for ($i = 0; $i <= $this->totaldecampos ; $i++) {
				//Guarda la informacion de los campos y sus tipos,
				$camp = $this->db->fetch();
				$this->loscampos[$i] = $camp[0];
				$this->tipocampo[$i] = $camp[1];
			}
			$this->estatabla=$esatabla; //Guarda el nombre la tabla,
			$this->definetipos();//Guarda el tipo de datos de los campos.
			$this->limpiar();//Inicializa el contenido en 0 y indica que los campos no han recibido cambios.
		}
	}
	public function campos(){//Regresa un arreglo con la data en los campos
		return $this->loscampos;
	}
	public function definetipos() {//Define los tipos de datos que tiene cada campo
		for ( $i = 0; $i <= $this->totaldecampos; $i++ ) {
			$eltipo = $this->tipocampo[ $i ];
			if(stristr($eltipo,"tinyint(")===false){
				if(stristr($eltipo,"varchar(")===false){
					if(stristr($eltipo,"int(")===false){
						if(stristr($eltipo,"text")===false){
							if(stristr($eltipo,"double")===false){
								if(stristr($eltipo,"char(")===false){
									if(stristr($eltipo, "date")===false){
										echo '<h1 style="background-color:#FF0000; color:#FFFF00;">Unknown DataType('.$i.') '.
										$eltipo." para el campo ".$this->loscampos[$i]." en la tabla ".$this->estatabla."</h1>";
									}else{
										$this->tipocampo[ $i ] = "date";
									}
								}else{
									$this->tipocampo[ $i ] = "cadena";
								}
							}else{
								$this->tipocampo[ $i ] = "doble";
							}
						}else{
							$this->tipocampo[ $i ] = "cadena";
						}
					}else{
						$this->tipocampo[ $i ] = "entero";
					}
				}else{
					$this->tipocampo[ $i ] = "cadena";
				}
			}else{
				$this->tipocampo[ $i ] = "entero";
			}
		}
	}
	public function tabla() {//Regresa el nombre la tabla
		return $this->estatabla;
	}
	public function totaldecampos() {//Regresa el total de campos
		return $this->totaldecampos;
	}
	public function renombrar( $ppk , $campo ) {//Recibe la llave primaria y el nombre del campo a buscar y devuelve el valor del campo en esa posicion.
		$j = $this->posiciondelcampo( $campo );
		if ( $j == -1 ) {
			$i = "No existe campo (".$campo.") para PK(".$ppk.")" ;
		} else {
			$i = "Llave Primaria (".$ppk.") no existe!" ;
			if ( $this->buscarprimaria($ppk) ) $i = $this->contenido[ $j ];
		}
		return $i;
	}
	public function nuevo() {//Crea un nuevo registro
		$this->limpiar(); // SI INICIA EL REGISTRO SE VUELVE NUEVO...
		$this->esnuevo = true;
		return True;
	}
	public function salvar() {//Guarda los valores en un registros, regresa true si se afectaron los registros
		$syntax = "";		$valores= "";
		if ( $this->esnuevo ) {//Si el registro es nuevo...
			$valores= "  VALUES (";
			$syntax = "INSERT INTO ".$this->estatabla." (";
			for ( $i = 0; $i <= $this->totaldecampos; $i++ )
			{
				if ( $this->cambiados[ $i ] )//Si los campos fueron cambiados inserta en...
				{
					$ab=""; if ( $this->tipocampo[ $i ] == 'cadena' ) { $ab="'"; }//Separacion entre parametros
					$syntax = $syntax .      $this->loscampos[ $i ] .", ";//Campos en los que se insertara
					$valores= $valores .$ab. $this->contenido[ $i ] .$ab.", ";//Valores que se insertaran
				}
			}//Revision de la sintaxis
			$syntax  = $syntax  . ") ";
			$valores = $valores . ");";
			$syntax = str_replace( ", )", " )", $syntax );
			$valores= str_replace( ", )", " )", $valores);
			$syntax = $syntax . $valores ;//Se unen ambos argumentos para crear la sentencia sql.
		} else {//Si el registro ya existe
			$syntax = "UPDATE ".$this->estatabla." SET ";
			for ( $i = 0; $i <= $this->totaldecampos; $i++ ) {
				if ( $this->cambiados[ $i ] ) {//Si los campos fueron cambiados actualiza en...
					$ab=""; 
					if ( $this->tipocampo[ $i ] == 'cadena') { $ab="'"; }//Separacion entre parametros
					if($this->tipocampo[$i]=='date') { $ab='"'; } // delimitador en doble comillas para los campos date...
					$syntax = $syntax.$this->loscampos[ $i ]."=".$ab. $this->contenido[ $i ] .$ab.", ";//el campo y su valor
				}
			}
			$syntax = rtrim($syntax)." WHERE ".$this->loscampos[ 0 ]." = ". $this->contenido[ 0 ] ." ;" ;//Donde el id sea = al campo que se va a actulizar
			$syntax = str_replace( ", WHERE", " WHERE", $syntax );
		//****************************************************************************************************
		$this->ultimosql =  $syntax ;//guarda el sql
		//****************************************************************************************************
		}
		$n=0;
		if(!$this->buscardonde('id > 0')){
			$sql = 'ALTER TABLE '.$this->estatabla.' AUTO_INCREMENT = 1';
			$this->db->query($sql);
		}
		else{
			$x = $this->buscardonde('id > 0');
			while($x){
				$n++;
				$x = $this->releer();
			}
			$sql = 'ALTER TABLE '.$this->estatabla.' AUTO_INCREMENT = '.$n.'';
			$this->db->query($sql);
		}	
		//echo $syntax.'<br>';
		$this->db->query($syntax);//Realiza el query
		if ( $this->db->affected_rows() > 0 ) {//Si se afecto un registro...
			for ( $i = 0; $i <= $this->totaldecampos; $i++ ) { 
				$this->cambiados[ $i ] = False; //reiniciar la cuenta de campos cambiados
			}
			$this->esnuevo = false;
		}
		return ( $this->db->affected_rows() > 0 );//regresa true si se hizo algo
	}
	public function buscarprimaria ( $pid ) {//Recibe el valor de la llave primaria a evaluar y regresa un valor booleano indicando si el registro existe o no.
	//Si recibe id se contaran todos los registros ya que se crea la redundancia id=id.
		$this->limpiar() ;
		$this->estalinea = -1;
		$this->totaldelineas = 0;
		$syntax = "select * from ".$this->estatabla." where id=".$pid.";";
		//echo $syntax;
		$this->db->query($syntax);
		$this->totaldelineas = $this->db->rows();//Indica el numero de registros que existen con ese id.
		if ($this->totaldelineas != 0) {//Si el registro existe...
			$this->esnuevo = False;//Indica que el registro existe
			$this->registro = $this->db->fetch();//Obtiene la informacion del o de los registros
			$this->llenarcampos();//Guarda la informacion del o de los registros
			$this->estalinea = 1;
		}
		return ( $this->estalinea == 1 );
	}
	public function buscardonde ($psyntax , $leer=1, $query='') {//Recibe una condicion para la seleccion de registros y regresa un valor booleano indicando si existe o no.
		$this->limpiar() ;//Reinicia los registros
		$this->estalinea = -1;
		$this->totaldelineas = 0;
		if(empty($query)){
			$syntax = "select * from ".$this->estatabla." where ".$psyntax." ;";
		}else{
			$syntax = "".$query."";
		}

		
		//echo "<td><h1>".$syntax."</h1></td>";
					
		$this->db->query($syntax);//Realiza la busqueda de los registros que coincidan con la condicion
		$this->totaldelineas = $this->db->rows();//Guarda la cantidad de registros que coindicen con la condicion
		if ($this->totaldelineas != 0) {
			$this->esnuevo = False;//Indica que el registro existe
			$this->estalinea = 0;
			if(!empty($leer))
				$this->releer();//Guarda la informacion de los campos actualmente seleccionados
		}
		return ( $this->totaldelineas > 0 );
	}
	public function estructura() {//Regresa el nombre de los campos y tipo de campos dentro de la tabla
		$estr = $this->estatabla.":<br>";
		for($i=0; $i <= $this->totaldecampos; $i++){
			$estr = $estr ."(". $this->tipocampo[$i] .") ". $this->loscampos[$i] ."<br>" ;
		}
		
		return $estr;
	}
	public function releer() {//Guarda la informacion de los campos actualmente seleccionados
		$again = False;
		$this->registro = $this->db->fetch();//Guarda la informacion de los campos
		if ( $this->estalinea < $this->totaldelineas ) {
			$this->llenarcampos();
			$this->estalinea = $this->estalinea + 1 ;
			$again = True;
		}
		return $again ;
	}
	public function posiciondelcampo( $elcampo, $e1='') {//Recibe el nombre de un campo y regresa la posicion del campo dentro de la tabla, si el campo no existe regresa -1
		$posic = -1;
		//Se realiza la busqueda del campo
		for ( $i = 0; $i <= $this->totaldecampos; $i++ ) {
			if ( $this->loscampos[ $i ] == $elcampo ) { $posic = $i; }//Si lo encuentra guarda la posicion
		}
		if( $posic == -1 ) {//Sino envia un mensaje de error
			$error = '<h1 style="background-color:#FF0000; color:#FFFF00;">Desconocido campo: ('.
				$elcampo.') dentro de los '.$this->totaldecampos.' campos de la tabla "'.
				$this->estatabla.'"</h1>';
			if($e1 == ''){
				echo $error;
			}
		}
		return ( $posic );
	}
	public function llenarcampos() {//Guarda la informacion de los campos y registros actualmente seleccionados
		$tmp = $this->esnuevo;
		$this->limpiar();
		$this->esnuevo = $tmp;
		for ( $i = 0; $i <= $this->totaldecampos; $i++ )
		{
			$tmp = $this->loscampos[ $i ];
			$this->contenido[ $i ] = $this->registro[ $tmp ];//guarda del campo o de los campos.
		}
	}
	public function limpiar() {//Reinicia el contenido de los campos.
		$this->esnuevo = True;
		for ( $i = 0; $i <= $this->totaldecampos; $i++ ) {
			$this->cambiados[ $i ] = False;
			switch ( $this->tipocampo[ $i ] ) {
				case 'cadena':
					$this->contenido[ $i ] = '';
					break;
				case 'doble':
					$this->contenido[ $i ] = 0.00;
					break;
				case 'entero':
					$this->contenido[ $i ] = 0;
					break;
				case 'date':
					$this->contenido[ $i ] = '0000-00-00';
					break;
				default:
					echo '<h1>Desconocido: '.$j.' pos['.$i.'] en "'.$this->estatabla.'"</h1>';
					$this->contenido[ $i ] = null;
					break;
			}
		}
	}
	public function ultimosql(){//Regresa el ultimo sql utilizado
		return $this->ultimosql ;
	}
	public function obtener($elcampo){//Recibe el nombre del campo a evaluar y devuelve el valor en ese campo
		$j = $this->posiciondelcampo( $elcampo );
		$i = null;
		if ( $j == -1 ) {
			echo "<h1>No existe campo (".$elcampo.") en (".$this->estatabla.")</h1>" ;
		} else {
			$i = $this->contenido[ $j ];
		}
		return $i;
	}
	public function colocar(  $elcampo , $v ) {//Recibe el nombre de un campo y el valor a ser insertado
		$j = $this->posiciondelcampo( $elcampo );//Se obtiene la posicion del campo
		if ( $j == -1 ) {
			echo "</h1>No existe campo (".$elcampo.") en la tabla (".$this->estatabla.")</h1>" ;
		} else {//Si el campo existe...
			//echo "<br>El campo ".$elcampo." existe en la posicion (".$j.") como tipo (".$this->tipocampo[ $j ].")<br>";
			if ( $v !== null ) {
				$i = $this->tipocampo[ $j ] ;//Se guarda el tipo de datos para ese campo
				switch ( $i ) {//Dependiendo del tipo de datos se realiza la insercion del valor
					case 'cadena':
						if (!is_string($v)) $v = (string) $v;
						$this->contenido[ $j ] = $v ;
						$this->cambiados[ $j ] = true ;
						break;
					case 'doble':
						$this->contenido[ $j ] = (double) $v ;
						$this->cambiados[ $j ] = true ;
						break;
					case 'entero':
						$this->contenido[ $j ] = (int) $v ;
						$this->cambiados[ $j ] = true ;
						break;
					case 'date':
						$this->contenido[ $j ] = (string) $v;
						$this->contenido[ $j ] = $v ;
						$this->cambiados[ $j ] = true ;
						break;
					default:
						echo '<h1>Tipo Desconocido: '.$elcampo.' pos['.$j.'] en "'.$this->estatabla.'"</h1>';
						//$this->contenido[ $j ] = null;
						break;
				}
			} else {
				
			}
		}
	}
	public function dropdown( $var, $condic, $pkcampo, $campo1, $campo2, $inicio, $texto=''){ /* Recibe el nombre de la variable, la condicion de seleccion de registros, el id ,el nombre del o de los campos que se mostraran en el drowndown y el valor a mostrar por defecto. */
		$txt = '<select name="'. $var .'"><option value=" ">'.$texto.'</option>';//Se coloca la variable con los valores
		if( empty( $condic ) ){ $condic =' id<>0 '; }//Cero y solo cero
		if( empty( $pkcampo) ){ $pkcampo='id'; }//Campo a buscar
		$i = $this->buscardonde( $condic );//Busca los registros donde coincide la condicion
		while ( $i ) {//Mientras hayan registros...
			$prim = $this->obtener($pkcampo) ;//Guarda el contenido del campo
			$selc = '';
			if( !empty($inicio) and $prim == $inicio ){ //Se selecciona el campo por defecto
				$selc = ' selected="selected" ';
			}
			$txt = $txt.'<option value="'. $prim .'"'.$selc.'>'.$this->obtener($campo1) ;//Se coloca la informacion del primer campo
			if(! empty( $campo2 )){ //Se concatena ala informacion del segundo campo
				$txt = $txt .' '. $this->obtener($campo2) ; 
			}
			$txt = $txt . '</option>';
			$i = $this->releer();
		}
		$txt = $txt . '</select>';
		return $txt ;
	} 
	public function totalfilas(){//Regresa la cantidad de registros
	return $this->totaldelineas;
	}
	public function buscarprimaria2 ( $syntx ) {
		$this->limpiar() ;
		$this->estalinea = -1;
		$this->totaldelineas = 0;
		$syntax = "select * from ".$this->estatabla." where ".$syntx.";";
		$this->db->query($syntax);
		$this->totaldelineas = $this->db->rows();
		if ($this->totaldelineas != 0) {
			$this->esnuevo = False;
			$this->registro = $this->db->fetch();
			$this->llenarcampos();
			$this->estalinea = 1;
		}
		return ( $this->estalinea == 1 );
	}
	public function eliminar( $id ){//Borra un registro, recibe el id del registro a ser eliminado
		$this->db->query("DELETE FROM ".$this->estatabla." WHERE id=".$id);
	}
	public function automantenimiento( $pkaeditar,$editar='',$listar='' ){	//descripcion:Realiza el mantenimiento autom\E1tico de cualquier tabla...
		include_once('diseno.php'); $pg = new Diseno();
		$vista = '<center><table class="mantenimiento" border="2">';
		$formulario='';
		$automatico = true; 
		if( empty($pkaeditar) ){ //Verifica si el id est\E1 vac\EDo o no
			$this->nuevo(); //De estar vac\EDo el id levanta un registro nuevo
		}else{
			$automatico = $this->buscarprimaria($pkaeditar); //B\FAsqueda de la llave primaria capturada
		}
		if($automatico){ //De Haberse encontrado la llave primaria
			for($x=0; $x<=$this->totaldecampos; $x++){ //Recorrido de los campos de la tabla
				$elcampo = $this->loscampos[$x];
				if($elcampo === 'id'){ //Si el campo es id se coloca en una eiqueta oculta-hidden en html
					$formulario .= $pg->editar('oculto','id','','',$this->obtener('id'),'');
				}else{    
					$syntax='SELECT COLUMN_COMMENT 
							FROM    INFORMATION_SCHEMA.COLUMNS 
							WHERE   TABLE_SCHEMA="'.$this->db->database().'" 
									AND TABLE_NAME="'.$this->estatabla.'" 
									AND COLUMN_NAME="'.$elcampo.'"';			// Consulta sql para obtener los comentarios de los campos de esta tabla
					$this->db->query( $syntax );								// Registros del sql
					$lineas = $this->db->rows();								// cantidad de lineas de la consulta sql
					if( !empty($lineas) ){
						$comment     = array();
						$comentarios = array();
						$valor = $this->obtener($elcampo);						// se obtiene el valor (contenido en la tabla) del campo para la edicion...
						$datas = $this->db->getrecordstoarray();					// trae una matriz con cada uno de los registros de comentarios...
						$comment = explode(';',$datas[1]['COLUMN_COMMENT']);	// campo 'COLUMN_COMMENT' se contiene los comentarios de cada campo de la tabla
						foreach($comment as $valores){							// aqui se separan las claves de los valores. (ej. clave:valor )
							$partes = explode(':',$valores);
							$idx = $partes[0];
							$comentarios[$idx] = $partes[1]; 
						}

						$formulario .= '<tr>'. $this->autoeditar($elcampo,$valor,$comentarios) .'</tr>';//Se crea la etiqueta HTML correspondiente
					}
				}
				
			}
			$vista .='<form action="./?accion='.$editar.'&opc=-1" method="post">'.$formulario.'<tr><td><input type="submit" value="Guardar"></td><td>'.$pg->enlace('./?accion='.$listar.'&opc=-2','','<input type="button" value="Regresar">').'</td></tr>
			</form>'; 
		}else{ //si no se encuentra la llave?...manda un mensaje de error y enlace de retorno
			$vista .= '<tr><td>No se encuentra el registro que se desea...!</td></tr>'
					. '<tr><td><a href="./">Pulse aqui para seguir</a></td></tr>';
		}
		$vista = $vista.'</table></center>';
		//$vista = $pg->mensaje('Editando '.$tabla,$vista,'','',$pg->colorweb2('azul'),$pg->colorweb2('amarillo'));
		return $pg->latino($vista);
	}
	public function autoeditar($nombrecampo,$valorcampo,$comentarios) {
		include_once('diseno.php'); $pg = new Diseno();
		//****************************************************************
			switch($comentarios['edicion']){
			case 'dropdown':
				$tablareferenciada   = $comentarios['referencia']; 	// Se obtiene la tabla referenciada mediante FK
				//===============================================================================================================
				//Sintaxis para obtener los comentarios de la tabla referenciada
				$intaxis='SELECT COLUMN_NAME, DATA_TYPE, COLUMN_KEY, COLUMN_COMMENT 
				FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA="controlactividades" AND TABLE_NAME="'.$tablareferenciada.'"';
				$cont = 0;
				$cols = '';
				$this->db->query($intaxis);
				while( $datos = $this->db->fetch() ){
					$desc = array();
					$descripcion = array();
					$columna = $datos[0]; //Columna a para construir el dropdown
					$desc = $datos[3]; //Captura de columna comentarios
					$desc = explode(';' , $desc);
					foreach( $desc as $valores ){
						$parts = explode(':' , $valores);
						$ind = $parts[0];
						$descripcion[$ind] = $parts[1];
					}
					if($descripcion['desplegar']==='SI'){ // Si el campo est\E1 identificado como desplegar quiere decir que ser\E1 el que se utilize como option dentro de un DropDown
						$cols = $cols.'CONCAT('.$columna.')'; 
						$cont++;
						if( $cont > 1 ){
							$cols = str_replace(')CONCAT(', ' ," ", ' ,$cols);
						}
						//echo $cols.'<br><br>';
						$syn = 'SELECT id,'.$cols.' FROM '.$tablareferenciada.' WHERE id>0'; //echo $syn.'<br>';
						$i = '<td>'.$comentarios['nombre'].'</td><td>'.$pg->TAGselectSQL($nombrecampo,0,$valorcampo,$syn).'</td>'; 
					}
					//================================================================================================================================================
			}
			break;
			//Caso de que sea checkbox
			case 'checkbox':
					$i = '<td>'.$comentarios['nombre'].'</td><td><input type="checkbox" value="1"></td>';
			break;
			//Caso de que sea radio armar\E1 la etiqueta RadioButton
			case 'radio':
				if(empty($comentarios['valores']))  $comentarios['valores'] ="SI\AC1~NO\AC0";
				
				$values = explode('~',$comentarios['valores']);
				foreach($values as $valores){
					$parts = explode('\AC',$valores);
					$idx = $parts[0];
					$value[$idx] = $parts[1];
					
				} 
				$i ='<td>'.$comentarios['nombre'].'</td><td>';
				foreach($value as $ind => $valor){
					$checked =''; if( $ind==='NO' ){ $checked ='checked'; }
					$i .= $ind.'<input type="radio" name="'.$nombrecampo.'" value="'.$valor.'" checked="'.$checked.'">';
				}
				$i.='</td>';
			break;
			//Caso de que sea password armar\E1 la etiqueta para contrase\F1a
			case 'password':
				$i = '<td>'.$comentarios['nombre'].'</td><td>'.$pg->editar('clave',$nombrecampo,'45','45',$valorcampo,'').'</td>';
			break;
			//En caso de que sea dia armar\E1 el dropdown de los d\EDas
			case 'dia':
				$ds = $pg->TAGselectDIAS($nombrecampo,'');
				$i = '<td>'.$comentarios['nombre'].'</td><td>'.$ds.'</td>';
			break;
			case 'mes':
				$ms = $pg->TAGselectMESES($nombrecampo,'');
				$i = '<td>'.$comentarios['nombre'].'</td><td>'.$ms.'</td>';
			break;
			case 'ano':
				$as = $pg->TAGselectANOS($nombrecampo,'',2012,2050);
				$i = '<td>'.$comentarios['nombre'].'</td><td>'.$as.'</td>';
			break;
			//En caso de que sea texto construir\E1 un textbox
			case 'texto':
				$i = '<td>'.$comentarios['nombre'].'</td><td>'.$pg->editar('campo',$nombrecampo,'45','90',$this->obtener($nombrecampo),'', 'required', '').'</td>';
			break;
			//En caso de que sea textarea construir\E1 un textarea
			case 'textarea':
				$i = '<td>'.$comentarios['nombre'].'</td><td>'.$pg->editar('texto',$nombrecampo,'3','30',$this->obtener($nombrecampo),'').'</td>';
			break;
		}
		return $i;
	}
	public function autolistar($condicion='id<>0',$editar='',$eliminar='',$recuperar='',$tabla=''){
		include_once('diseno.php'); $pg = new Diseno();
		$vista = '<center><table class="tablalista">';
		$syntax='SELECT COLUMN_NAME, COLUMN_COMMENT 
				FROM    INFORMATION_SCHEMA.COLUMNS 
				WHERE   TABLE_SCHEMA="'.$this->db->database().'" 
						AND TABLE_NAME="'.$this->estatabla.'"
						AND COLUMN_COMMENT LIKE "%listar:SI%"';			// Consulta sql para obtener los comentarios de los campos de esta tabla
					//echo '['.$syntax.']<br><br><br>';
		$this->db->query( $syntax );									// Registros del sql
		$lineas = $this->db->rows();									// cantidad de lineas de la consulta sql
		if( empty($lineas) ){
			$vista .='<tr><td>No se ha definido ningun registro para mostrarse...!</td></tr>';
				
		} else {
			$campos = array();
			$comentaux = array();
			$datas = $this->db->getrecordstoarray();						// trae una matriz con cada uno de los registros de comentarios...
			$lostitulos = $this->db->rows();							// cantidad de lineas de la consulta sql que representan los campos a listar
			foreach($datas as $dex => $columna){
				$campos[$dex] = $columna['COLUMN_NAME'];
				$comentario = $columna['COLUMN_COMMENT'];
				$comentaux[$dex] = $comentario; 
				$cols++;
									
				//---------------------------------------------------------------------------------------------------------------------------------
				// PARA DEFINIR EL TIPO DE EDICION O DISPLAY DE CADA COLUMNA //
				$mostrar[$dex]= '';				// recuerda aqui definir el tipo de display que va a tener este campo (si es radio o check o FK o dropdown)
				
				//---------------------------------------------------------------------------------------------------------------------------------
				// PARA DEFINIR EL TITULO DE CADA COLUMNA //
				
				if($campos[$dex] !=='id'){ // De ser el campo distinto de id
					
					$ps1 = strpos($comentario,'nombre:');
					if($ps1===false){
						$titulos[$dex]= $campos[$dex];						// cuando no encuentra nombre entonces el titulo es el campo...
					} else {
						$ps2 = strpos( $comentario,";",$ps1 +7 );
						if($ps2===false){
							$titulos[$dex]= substr($comentario,$ps1 +7);					// cuando no encuentre el ; del nombre: ...
						} else {
							$titulos[$dex]= substr( $comentario,$ps1 +7, $ps2 - ($ps1 +7) );	// cuando encuentre nombre: y el ;
						}
					}
				}					
				//---------------------------------------------------------------------------------------------------------------------------------
			}
			$vista .=	'<tr>
							<th style="width:50px;">'.
								$pg->enlace('./?accion='.$editar.'&opc=0','Agregar',$pg->imagen('./imagenes/add.png" style="margin-top:1px;"')).'&nbsp;</th>';
			foreach($titulos as $dex => $titulo){
				$vista .= '<th>'.$titulo.'</th>';				//linea de titulos
			}
			$vista .= '</tr>';
			$pnt = $this->buscardonde( $condicion , 0 );
			if( !$pnt ) {
				$vista .='<tr><td>No se ha encontrado ningun registro para mostrarse...!</td></tr>'; //En caso de que la tabla se ecuentre vacia
			} else {
				$areg = $this->db->getrecordstoarray(); //En caso de que existan registros en la tabla
				foreach($areg as $idx => $reg){
					$vista .=	'<tr>
									<td style="width:70px">'.
										$pg->enlace('./?accion='.$eliminar.'&id='.$reg['id'],'eliminar',$pg->imagen('./imagenes/delete.png" " style="margin-top:1px;"')).
										$pg->enlace('./?accion='.$editar.'&opc='.$reg['id'],'editar',$pg->imagen('./imagenes/edit.png" " style="margin-top:1px;"')).
									'</td>';
									//Iconos de Eliminaci\F3n y de Edici\F3n respectivamente
					$c = 1;				
					foreach($reg as $campo => $valor ){ // Obtensi\F3n de los valores de los campos de la tabla
						$dex = 0;
						foreach($campos as $campot){ 
							$dex++; 
							$comentario = $comentaux[$dex]; 
							if($campo !== 'id'){
								if($campot === $campo) {
									$ps1 = !(strpos($comentario,'edicion:dropdown')===false);
									$ps2 = !(strpos($comentario,'referencia:')===false);
									if( $ps1 and $ps2 ){
										$ps1 = strpos($comentario,'referencia:'); // Se obtiene la referencia
										$ps2 = strpos( $comentario,";",$ps1 + 11 );
										$tablareferencia = substr( $comentario,$ps1 +11, $ps2 - ($ps1 +11) );	
										
										$syntax='SELECT COLUMN_NAME, COLUMN_COMMENT 
										FROM    INFORMATION_SCHEMA.COLUMNS 
										WHERE   TABLE_SCHEMA="'.$this->db->database().'" 
												AND TABLE_NAME="'.$tablareferencia.'"
												AND COLUMN_COMMENT LIKE "%desplegar:SI%"';	//Sql para tomar tabla referenciada 
										
										$this->db->query($syntax);
										$camporef =  '';
										while($rows = $this->db->fetch()){
										
											$camporef .=$rows[0].','; 
																																														
										}
																					
										$syntax ='SELECT '.$camporef.' FROM '.$tablareferencia.' WHERE id='.$valor;//Sentencia SQL para recuperar valor de los campos para listarlos 
										$syntax = str_replace(', FROM',' FROM',$syntax);
										$valor='';
										$this->db->query($syntax);
										while($rows1 = $this->db->fetch()){ 
											$valor = $rows1[0].' '.$rows1[1]; 
											//============trampa de bruja
											
											
											
											//===========================
										}
										
										
									}
									$ps1 = !(strpos($comentario , 'edicion:radio')===false);
									$ps2 = (strpos($comentario , 'valores:')===false);
									if($ps1 and $ps2){
										
										if($valor==0) $valor=null; else $valor=$pg->imagen('./imagenes/close.png" style="margin-top:1px;"');
									}
									$vista .= '<td class="mant">'.$valor.'</td>'; // Se muestran los registros en pantalla 
								}
							}
						}
						
					}
					$vista .= '</tr>';
				}
			} 
		
			
		}
		$vista .= '<tr><td colspan="3">'.$pg->enlace('./?accion='.$editar.'&opc=0','Agregar',$pg->imagen('./imagenes/add.png " style="margin-top:1px;"')).'&nbsp;</td></tr>
		</table></center>';
			
		
					
		$vista = $pg->mensaje('Listado de '.$tabla,$vista,'','.',$pg->colorweb2('azul'),$pg->colorweb2('amarillo'));
		
		return $vista; 
	}
	public function autovalidar( $valores , $listar='' ){
			//Funcion : Autovalidar
			//Descripcion: Realizar validacion de datos de forma automatica
			//Fecha de Creaci\F3n:25/03/2012
			//Autor:Brayan Delgado
			include_once('mvc/modelo/diseno.php');
			$pg = new Diseno();
			$id = $valores['id'];//se captura el valor id
			if(empty( $id ))
				$this->nuevo();//Si esta vacia la llave primaria quiere decir que es un registro nuevo.
			else
				if(!$this->buscarprimaria( $id )){ 
					$this->nuevo(); //Si no se encuentra la llave primaria quiere decir que es un registro nuevo
				}
			foreach($valores as $idx => $cont){
				if($idx != 'id'){ $this->colocar($idx , $cont); } //Grabamos en la base de datos los registros capturados en el post
			}
			$this->salvar(); // Se salva el registro
			$msn = 'Guardado'; if(!empty($id)){ $msn="Modificado"; }
			$pg->der($pg->centrar('<strong>Su Registro ha sido '.$msn.' Satisfactoriamente</strong><br>'.
			$pg->enlace('./?accion='.$listar.'&opc=-2','Regresar',$pg->imagen('./imagenes/undo_yellow.png" height=64" width="64"') )));
			$pg->mostrar();
	}
	public function contenido(){
		return $this->contenido;
	}
}
?>
