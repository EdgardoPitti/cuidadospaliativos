<?php
class Db {/*=====================================================================*/
	private $result, $link, $affectedrows, $rows, $dbase, $errortext;

	function __construct($db = ''){       /*=====================================================================*/
		$host = 'localhost';
		$uid = 'root';
		$pwd = 'sql';
		$schema = $db;
		if( empty($db) ){ $schema = 'admproy_cuidados_paliativos_panama'; }
		$this->connect($host,$uid,$pwd,$schema);
	}
	function connect($host,$uid,$pwd,$db){/*=====================================================================*/
		if ($this->link != NULL) { $this->close(); }
		$this->link = mysql_connect($host,$uid,$pwd,TRUE);
		if( mysql_select_db($db,$this->link) ){
			$this->dbase = $db ;
		} else {
			$this->errortext = mysql_error();
			die ('Base de Datos no pudo ser seleccionada:['.$this->errortext.']' );
		}
	}
	function query($sql){                 /*=====================================================================*/
		//echo $sql.'<br>';
		if ($this->result != NULL) { $this->free(); }
		$this->result = mysql_query($sql, $this->link);
		$this->affectedrows = $this->affected_rows();
		$this->rows = $this->rows();
		$rgr = false;
		if(($this->affectedrows>0) or ($this->rows>0)){ $rgr = true; }
		return $rgr;
	}
	function getrecordstoarray(){         /*=====================================================================*/
		$rows = $this->rows();
		$lines = array();
		for( $idx=1; $idx<=$rows; $idx++ ){ $lines[$idx] = mysql_fetch_array($this->result,MYSQL_BOTH) ; }
		return $lines ;
	}		
	function fetch(){	/*=====================================================================*/
		return mysql_fetch_array($this->result,MYSQL_BOTH);
	}
	public function obtenerArreglo($sql){
		$arreglo = array();
		$cont = 0;
		$resultado = mysql_query($sql, $this->link);
		$this->affectedrows = $this->affected_rows();
		if($this->affectedrows > 0){
			$linea = mysql_fetch_array($resultado,MYSQL_BOTH);
			while(!($linea === false)){
				$arreglo[$cont]=$linea;
				$cont ++;
				$linea = mysql_fetch_array($resultado,MYSQL_BOTH);
			}
		}
		@mysql_free_result($resultado);
		return $arreglo;
	}
	function affected_rows(){             /*=====================================================================*/
		return mysql_affected_rows($this->link);
	}
	function rows(){                      /*=====================================================================*/
		return @mysql_num_rows($this->result);
	}		
	function free(){                      /*=====================================================================*/
		@mysql_free_result($this->result);
	}	
	function database(){                  /*=====================================================================*/
		return $this->dbase;
	}	
	function close(){                     /*=====================================================================*/
		mysql_close($this->link);
	}		
	function __destructor(){              /*=====================================================================*/
		$this->free();
		$this->close();
	}
}
?>