<?php
class Diseno {
	private $izquierda,$derecha,$js ;
	var $db;
	/* -- -- -- -- -- -- -- -- -- */
	function __construct() {
		include_once('db.php'); $this->db = new Db();
		$this->izquierda='';
		$this->derecha='';
		$this->js='';
		$this->navegador='';
	}
	function moneda( $dinero, $pdec ){
		if(($pdec!==0) and ($pdec!=="0")){
			if(empty($pdec)) $pdec=2 ;
		}
		$forma = number_format($dinero , $pdec);
		return $forma ;
	}
	function dime($quierosaber)	{
		$aber = 'ø Que quieres saber ?';
		date_default_timezone_set('America/Panama');
		$nada = getdate();
		switch( $quierosaber )
		{
			case 'hoy':		$aber = $nada['year'].'.'.$this->dime('mes es').'.'.$nada['mday'] ;
			break;
			case 'ahora':	$aber = $nada['hours'].':'.$nada['minutes'].':'.$nada['seconds'] ;
			break;
			case 'hora':	$aber = $nada['hours'] ;
			break;
			case 'minuto':	$aber = $nada['minutes'] ;
			break;
			case 'segundo':$aber = $nada['seconds'] ;
			break;
			case 'dia':		$aber = $nada['mday'] ;
			break;
			case 'mes es':	$aber = $this->dime('mes-'.$nada['mon']);
			break;
			case 'mes-1':	$aber = 'Enero';
			break;
			case 'mes-2':	$aber = 'Febrero';
			break;
			case 'mes-3':	$aber = 'Marzo';
			break;
			case 'mes-4':	$aber = 'Abril';
			break;
			case 'mes-5':	$aber = 'Mayo';
			break;
			case 'mes-6':	$aber = 'Junio';
			break;
			case 'mes-7':	$aber = 'Julio';
			break;
			case 'mes-8':	$aber = 'Agosto';
			break;
			case 'mes-9':	$aber = 'Septiembre';
			break;			
			case 'mes-01':	$aber = 'Enero';
			break;
			case 'mes-02':	$aber = 'Febrero';
			break;
			case 'mes-03':	$aber = 'Marzo';
			break;
			case 'mes-04':	$aber = 'Abril';
			break;
			case 'mes-05':	$aber = 'Mayo';
			break;
			case 'mes-06':	$aber = 'Junio';
			break;
			case 'mes-07':	$aber = 'Julio';
			break;
			case 'mes-08':	$aber = 'Agosto';
			break;
			case 'mes-09':	$aber = 'Septiembre';
			break;
			case 'mes-10':	$aber = 'Octubre';
			break;
			case 'mes-11':	$aber = 'Noviembre';
			break;
			case 'mes-12':	$aber = 'Diciembre';
			break;
			case 'mes':		$aber = $nada['mon'] ;
			break;
			case 'aÒo':		$aber = $nada['year'] ;
			break;
			case 'agno':	$aber = $nada['year'] ;
			break;
			case 'hoy es':	$aber = $nada['wday'] ;
			break;
			case 'dia es':
				$aber = 'no se que dia es !';
				switch ( $nada['wday'] )
				{
					case 1: $aber = 'Lunes';		break;
					case 2: $aber = 'Martes';		break;
					case 3: $aber = 'Mi&eacute;rcoles';	break;
					case 4: $aber = 'Jueves';		break;
					case 5: $aber = 'Viernes';		break;
					case 6: $aber = 'S&aacute;bado';		break;
					case 7: $aber = 'Domingo';		break;
				}
			break;
		}
		return $aber;
	}
	//Recibe la fecha formato aÒo-mes-dia y regresa desglozada en dia,mes,aÒo
	function sinAcentos($cadena){
	   $tofind = "¿¡¬√ƒ≈‡·‚„‰Â“”‘’÷ÿÚÛÙıˆ¯»… ÀËÈÍÎ«ÁÃÕŒœÏÌÓÔŸ⁄€‹˘˙˚¸ˇ—Ò∑ #";
	   $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn-__";
	   $resultado = strtr($cadena,$tofind,$replac);
	   return $resultado;
	}
	function fecha($fecha){
		if(!empty($fecha)){
			$newdate[0] = substr($fecha, -2);//dia
			$newdate[1] = substr($fecha, 5, 2);//mes
			$newdate[2] = substr($fecha, 0, -5);//aÒo
		}
		return $newdate;
	}
	function TAGselectDIAS ( $var, $defa ) {
		$txt= '<select name="'. $var .'">'.
				'<option value="0"> </option>';
		for ($ms=1;$ms<=31;$ms++)
		{
			$txt = $txt . '<option value="'. $ms.'" ';
			if ( $ms==$defa ) $txt = $txt . ' selected="selected" ';
			$txt = $txt.'>'. $ms .'</option>
			';
		}
		$txt = $txt . '</select>';
		return $txt ;
	}
	function TAGselectMESES ( $var, $defa ) {
		$txt= '<select name="'. $var .'">'.
				'<option value="0"> </option>';
		for ($ms=1;$ms<=12;$ms++)
		{
			$txt = $txt . '<option value="'. $ms.'" ';
			if ( $ms==$defa ) $txt = $txt . ' selected="selected" ';
			$txt = $txt.'>'. $this->dime("mes-".$ms) .'</option>
			';
		}
		$txt = $txt . '</select>';
		return $txt ;
	}
	function TAGselectANOS ( $var, $defa, $ano1, $ano2 )	{
		$txt= '<select name="'. $var .'"><option value="0"> </option>';
		for ($ms=$ano1;$ms<=$ano2;$ms++){
			$df='';if($ms==$defa){$df=' selected="selected" ';}
			$txt .='<option value="'.$ms.'"'.$df.'>'.$ms.'</option>';
		}
		$txt .='</select>';
		return $txt ;
	}
	function editar( $tipo , $nombrecampo , $ancho , $largo , $data , $seleccionada , $required='' , $placeholder='' ) {
		$i='Desconozco el tipo de envio... HTMLTAG Validos(campo clave oculto boton caja radio texto lista forma) '.
			'en sintaxis ( tipo , nombrecampo , ancho , largo , data , seleccionada ) ';
		if( ! empty($tipo) ) {
			switch ( $tipo ) {
				case 'campo':		//-------------------------------------------------------------------------------------------
					$i ='<input name="'.$nombrecampo.'" type="text" id="'.$nombrecampo.
							'" value="'.$data.'" size="'.$ancho.'" maxlength="'.$largo.'" '.$required.'/>';
				break;
				
				case '2botones':
				
				$i= "<input type=\"submit\" name=" . $ancho. " value=" . $ancho . ">".
	                "<input type=\"button\" name=" . $largo . " value=" . $largo . " onClick=\" location.href=' " . $data. " '\">";

				break;
				
				case 'clave':		//-------------------------------------------------------------------------------------------
					$i ='<input name="'.$nombrecampo.'" type="password" id="'.$nombrecampo.
							'" value="'.$data.'" size="'.$ancho.'" maxlength="'.$largo.'" '.$required.'/>';
				break;
				case 'oculto':		//-------------------------------------------------------------------------------------------
					$i='<input name="'.$nombrecampo.'" type="hidden" id="'.$nombrecampo.'" value="'.$data.'" />';
				break;
				case 'boton':		//-------------------------------------------------------------------------------------------
					$i ='<input name="'.$nombrecampo.'" type="submit" value="'.$data.'"/>';
				break;
				case 'botonimagen'://-------------------------------------------------------------------------------------------
					$i ='<input type=image src="'.$data.'" name="'.$nombrecampo.'">';
				break;
				case 'caja' :		//-------------------------------------------------------------------------------------------
					//    <input name="casilla2"         id="casilla2"         type="checkbox" value="YES" checked />
					$i = '<input name="'.$nombrecampo.'" id="'.$nombrecampo.'" type="checkbox" value="'.$data.'" ';
					if( $data == $seleccionada )  $i = $i.' checked ';
					$i = $i . ' />';
				break;
				//cambie las casillas por que estan alreves las proporsiones. a criterio las vemos
				case 'texto':		//-------------------------------------------------------------------------------------------
					$i='<textarea name="'.$nombrecampo.'" cols="'.$largo.'" rows="'.$ancho.
												'" id="'.$nombrecampo.'">'.$data.'</textarea>';
				break;
				case 'radio':		//-------------------------------------------------------------------------------------------
					$opciones = $data ; $i="";
					while ( $opciones !== '' ) {
						$ps       = strpos(         $opciones       ,'<+>') ; //echo 'ps{'.$ps.'} ';
						$valor    = substr(         $opciones,     0, $ps ) ; //echo 'valor(ps-1){'.$valor.'} ';
						$opciones = substr_replace( $opciones, '', 0, $ps +3) ; //echo 'opciones{'.$opciones.'}<br>';
						$ps       = strpos(         $opciones       ,'<+>') ; //echo 'ps{'.$ps.'} ';
						$mostrar  = substr(         $opciones,     0, $ps ) ; //echo 'mostrar(ps-1){'.$valor.'} ';
						$opciones = substr_replace( $opciones, '', 0, $ps +3) ; //echo 'opciones{'.$opciones.'}<br><br>';
						$sele = ' ';
						if( $valor == $seleccionada ) $sele = ' checked="checked"" ';
						$i = $i . '<input name="'.$nombrecampo.'" type="radio" value="'.$valor.'" '.$sele.'>'.$mostrar;
						//------------------------------------
						if( strpos($opciones,'<+>') === false ) $opciones='';  // clausula de escape
						//------------------------------------
					}
					//<input name="pregunta1" type="radio" value="valor4" checked="checked" />Opcion cuatro
				break;
				case 'lista':		//-------------------------------------------------------------------------------------------
					$i = '<select name="'.$nombrecampo.'" size="'.$ancho.'" id="'.$nombrecampo.'">';
					$opciones = $data ;
					//echo 'opcionesoriginales{'.$opciones.'}<br><br>';
					while ( $opciones !== '' ) {
						$ps       = strpos(         $opciones       ,'<+>') ; //echo 'ps{'.$ps.'} ';
						$valor    = substr(         $opciones,     0, $ps ) ; //echo 'valor(ps-1){'.$valor.'} ';
						$opciones = substr_replace( $opciones, '', 0, $ps +3) ; //echo 'opciones{'.$opciones.'}<br>';
						$ps       = strpos(         $opciones       ,'<+>') ; //echo 'ps{'.$ps.'} ';
						$mostrar  = substr(         $opciones,     0, $ps ) ; //echo 'mostrar(ps-1){'.$valor.'} ';
						$opciones = substr_replace( $opciones, '', 0, $ps +3) ; //echo 'opciones{'.$opciones.'}<br><br>';
						$sele = ' ';
						if( $valor == $seleccionada ) $sele = ' selected="selected" ';
						$i = $i . '<option value="'.$valor.'" '.$sele.'>'.$mostrar.'</option>';
						//------------------------------------
						if( strpos($opciones,'<+>') === false ) $opciones='';  // clausula de escape
						//------------------------------------
					}
					$i = $i . '</select>';
				break;
				case 'forma':		//-------------------------------------------------------------------------------------------
					$i = '</form>';
					if( $nombrecampo != '' and $nombrecampo != '/' ){
						$i='<form id="'.$nombrecampo.'" name="'.$nombrecampo.'" method="post" action="'.$data.'">';
					}
				break;
			}
		}
		return $i;
	}
	function TAGselectSQL ( $var, $tamano, $defa, $syntx ) {
		$txt= '0<+> <+>';
		$this->db->query($syntx);
		$rw = $this->db->rows();
		while($rw >0){
			$arry = $this->db->fetch();
			$dato = $arry[0];
			$labl = $arry[1];
			$txt= $txt. $dato.'<+>'.$labl.'<+>';
			$rw -- ;
		}
		$i = $this->editar('lista',$var,1,$tamano,$txt,$defa) ;
		return $i;
	}
	function recursivo($tabla,$fkey,$padre=0,$pkey="id"){//'unidades','idunidadpadre',$unidad
		$this->db->query( 'select '.$pkey.' from '.$tabla.' where '.$fkey.'='.$padre );
		$rw = $this->db->rows();
		$recs = $this->db->getrecordstoarray() ;
		
		$opt = '';
		foreach($recs as $rec){
			$opt .= $rec[id].',';
			$opt .= $this->recursivo($tabla,$fkey,$rec[id]);
		}
		//echo $opt;
		return $opt ;
	}
	function spancolor($color,$texto){
		return '<span style="color:'.$this->colorweb2($color).'">'.$texto.'</span>';
	}
	function colorweb2 ( $nomb ) {
		$tono = array (
			'plata'      => '#EEEEEE',
			'blanco'     => '#FFFFFF',
			'perla'      => '#F9F7ED',
			'amarillo'   => '#FFFF88',
			'limon'      => '#CDEB8B',
			'celeste'    => '#C3D9FF',
			'carbon'     => '#36393D',
			'rojo'       => '#FF1A00',
			'ladrillo'   => '#CC0000',
			'naranja'    => '#FF7400',
			'verde'      => '#008C00',
			'selva'      => '#006E2E',
			'turquesa'   => '#4096EE',
			'rosado'     => '#FF0084',
			'rubi'       => '#B02B2C',
			'vermellon'  => '#D15600',
			'dorado'     => '#C79810',
			'olivo'      => '#73880A',
			'grama'      => '#6BBA70',
			'marino'     => '#3F4C6B',
			'azul'       => '#356AA0',
			'sangre'     => '#D01F3C'  ) ;
		switch ( $nomb )
		{
			case 'hueso':        $nomb = 'perla';    break;
			case 'anaranjado':   $nomb = 'naranja';  break;
			case 'huevo':        $nomb = 'amarillo'; break;
			case 'fucsia':       $nomb = 'rosado';   break;
			case 'fucshia':      $nomb = 'rosado';   break;
			case 'azul marino':  $nomb = 'marino';   break;
			case 'azulmarino':   $nomb = 'marino';   break;
			case 'navy':         $nomb = 'marino';   break;
			case 'caÒa':         $nomb = 'limon';    break;
			case 'menta':        $nomb = 'limon';    break;
			case 'verde oscuro': $nomb = 'selva';    break;
			case 'oro':          $nomb = 'dorado';   break;
		}
		return $tono[ $nomb ];
	}
	function imagen( $fuente ) {
		
		$i = '<img src="' . $fuente;
		if ( strpos($fuente, '"')===False ) { $i = $i. '"'; } else { $i = $i. ' '; };
		$i = $i. '/>';
		return $i;
	}
	function enlace( $href, $titulo , $texto ) {
		$i= '<a href="'. $href .'" title="'. $titulo .'">'.$texto.'</a>';
		return $i;
	}
	function centrar( $eltext ) {
		$txt = '<div align="center">'.$eltext.'</div>';
		return $txt ;
	}
	function caja( $tamanotitulo, $titulo, $contenido ) {
		$txt='<div class="caja"><h'.$tamanotitulo.'>'.$titulo.'</h'.$tamanotitulo.'>'.$contenido.'</div>';
		return $txt ;
	}
	function cajeta( $tamanotitulo, $titulo, $contenido ) {
		$txt='<div class="cajeta"><h'.$tamanotitulo.'>'.$titulo.'</h'.$tamanotitulo.'>'.$contenido.'</div>';
		return $txt ;
	}
	function mensajedeerror( $msg ){
		$txt = "";
		if( !empty( $msg ) ){
			$_SESSION['mensajedeerror']= $msg ;
		} else {
			if( !empty($_SESSION['mensajedeerror']) ){
				$txt = $this->caja(3,"Ha ocurrido un error y se requiere su intervension",
						$this->centrar($_SESSION['mensajedeerror'].'<br><br>'.
							$this->enlace($_SESSION['enlacedeerror'],"Pulse aqui para continuar").
							'<div style="width:150px; text-align:center; background-color:#999999; font-weight:bold 
										border-bottom:2px solid #3*-+33333; border-right:2px solid #333333; 
										border-top:2px solid #FFFFFF; border-left:2px solid #FFFFFF;">CONTINUAR</div>'.
							$this->enlace("","")));
				$_SESSION['mensajedeerror']="";
			}
		}
		return $txt ;
	}
	function nav($ind ){
		$this->navegador .= $ind;
		return;
	}
	function izq( $ind ) {
		$this->izquierda .= $ind;
		return;
	}
	function aside( $ind ) {
		$this->izq( $ind );
		return;
	}
	function der( $ind ) {
		$this->derecha .= $ind;
		return;
	}
	function contenido( $ind ) {
		$this->der( $ind );
		return;
	}
	
	function js($latitud,$longitud){
		$script = '<script>
						function initialize()
						{
						  var mapProp = {
							center: new google.maps.LatLng('.$latitud.', '.$longitud.'),
							zoom:8,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						  };
						  var map = new google.maps.Map(document.getElementById("map"),mapProp);
						}

						function loadScript()
						{
						  var script = document.createElement("script");
						  script.type = "text/javascript";
						  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false&callback=initialize";
						  document.body.appendChild(script);
						}

						window.onload = loadScript;
					</script>
					';
		return $script;
	}
	
	function alerta(){
		$const = 1;
		echo '
			<audio src="./alertas/alerta.wav" type="audio/wav" preload="preload" controls="controls" autoplay="autoplay" loop></audio>
		';
		return;
	}

	function mostrar($noaside = false){
		if($noaside)
			echo '
				<td>
					'.$this->latino($this->derecha).'
				</td>';
		else
			/*if(empty($_SESSION['idu'])){
				$span2 = '';
				$span1 = 'span12';
			}else{
				$span2 = 'span2';
				$span1 = 'span10';
			}*/
			echo
			   '
				<!--DiseÒo del contenido de la p·gina-->
				<div class="span10" style="min-height:675px;background:#fff;">
					'.$this->latino($this->derecha).'
				</div>
				<!--Fin del Contenido-->
			';
	}
	function latino( $texto ) {
		$search  = array('·',       'È',       'Ì',       'Û',       '˙',       'Ò',       '—',       '¡',       '…',       'Õ',       '”',       '⁄',       '¸');
		$replace = array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&ntilde;','&Ntilde;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&uuml;');
		$i = str_replace( $search, $replace, $texto );
		return $i;
	}
	
	function espaciosblancos($cantidad){
		$text=''; for($k=1;$k<=$cantidad;$k++){ $text .='&nbsp'; }
		return $text;                        
	}
	function mensaje( $ptt, $ptx, $pim='', $prt='', $pfd='', $pfr='' ){
		if ( is_null($pim) ) $pim = '';
		if ( trim($pim) != '' ) $pim = $this->imagen( $pim );
		$clr = '';
		if ( $pfr <> '' ){
			if ( strpos($pfr, '#')===False ) $pfr = '#'.$pfr ;
			$clr = 'color:'.$pfr.';';
		}
		if ( $pfd <> '' ){
			if ( strpos($pfd, '#')===False ) $pfd = '#'.$pfd ;
			$pfd = ' style="background-color:'.$pfd.';'.$clr.'"';
		}
		if($prt!==''){
			$boton = '<input type="button" value="Continuar" />';
			$boton = $this->enlace($prt,'Continuar" class="redondear',$boton);
			$boton = '<div style="width:125px;margin:auto;">
						'.$boton.'
					</div>';
		}else{
			$boton='';
		}
		$txt = '
			<div class="articulo">
				'.$pim.'
				<h1'.$pfd.'>
					'.$ptt.'
				</h1>
				<h3 align="center">
					'.$ptx.'
					<br /><br />
					'.$boton.'
				</h3>
			</div>';
		return $txt;
	}
	function abreviar($titulo,$texto){
		$txt='<abbr title="'.$titulo.'">'.$texto.'</abbr>';
		return $txt;
	}
	function login($accion,$clase='login'){
		$txt = '
					<form class="'.$clase.'" method="post" action="'.$accion.'">
						<label>C&eacute;dula</label> <input type="text" name="login" id="login" autocomplete="off"/>
						<label>Contrase&ntilde;a</label> <input type="password" name="password" id="password" />
						<input type="submit" name="botonlogin" id="botonlogin" value="Aceptar" />
						<!--<b><a href="./?accion=rptpass" >&iquestOlvidÛ su contraseÒa?</a></</b>-->
					</form>';
		return $txt;
	}
	function diasig($dia,$mes,$ano){
        if( !checkdate($mes,$dia,$ano) ){
            $sig = "fecha-invalida";
        } else {
            $sdia = $dia +1;
            $smes = $mes;
            $sano = $ano;
            while( !checkdate($smes,$sdia,$sano) ){
                $sdia ++ ;
                if( $sdia > 31 ){
                    $sdia = 1;
                    $smes ++ ;
                }
                if( $smes > 12 ){
                    $smes = 1;
                    $sano ++ ;
                }
            }
            $sig = (string) $sano .'-';
            if( $smes < 10 ){ $sig .='0'; }
            $sig .= $smes.'-';
            if( $sdia < 10 ){ $sig .='0'; }
            $sig .= $sdia;
        }
        return $sig;
    }
	function diasdespues($cant){
		$dias[1] = 'Lunes';
		$dias[2] = 'Martes';
		$dias[3] = 'Miercoles';
		$dias[4] = 'Jueves';
		$dias[5] = 'Viernes';
		$dias[6] = 'Sabado';
		$dias[7] = 'Domingo';
		$x = $this->dime('hoy es');
		$mas = $x + $cant;
		if($mas > 7){
			$dia = $mas/7;
			$mas = explode(".", $dia);
			$multp = $dia - $mas[0];
			$dia = $multp*7;
		}else{
			$dia = $mas;
		}
		if(($cant % 7) == 0){
			$dia = $x;
		}
		return $dias[''.$dia.''];
	}
	function edad($dia=0, $mes=0, $anio){
		$edad = 0;
		if (!checkdate($mes,$dia,$anio)){
			$edad = 'Fecha Inv·lida';
		}else{
			if($anio < $this->dime('aÒo')){
				if($mes < $this->dime('mes')){
					$edad = $this->dime('aÒo') - $anio;
				}else{
					$edad = $this->dime('aÒo') - $anio;
					$edad--;
				}				
			}
		}
		return $edad;
	}

	
	
	
	
	
	
	
	
	/*
	<!--Navegador--
	<nav class="fdgris">
		<ul class="menu">
			'.$this->navegador.'
		</ul>
	</nav>
	<div class="cuerpo">
		<!--DiseÒo de Lateral--
		<aside>
			<section class="acordeon">
				'.$this->izquierda.'
			</section>	
		</aside>
		<!--DiseÒo del contenido de la p·gina--
		<div class="contenido">	
			'.$this->latino($this->derecha).'
		</div>
		<!--Fin del Contenido>
	</div>-->
	*/
}