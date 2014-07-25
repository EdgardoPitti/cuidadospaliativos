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
	function ip(){
		$ip = '';
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	function verARREGLO($arreglo=array() ){
		if($arreglo== 'POST'   ) $arreglo = $_POST   ; 
		if($arreglo== 'GET'    ) $arreglo = $_GET    ; 
		if($arreglo== 'SESSION') $arreglo = $_SESSION; 
		if($arreglo== 'FILES'  ) $arreglo = $_FILES  ; 
		if($arreglo== 'SERVER' ) $arreglo = $_SERVER ; 
		return $this->tag('pre',print_r($arreglo,true));
	}
	function tag( $tag, $texto='', $clase='', $otro='' ){
		if( !empty($clase) ){ $clase=' class="'.$clase.'" '; }
		if(is_array($texto)){
			foreach($texto as $valor){ $tg .= '<'.$tag.' '.$otro.' '.$clase.'>'.$valor.'</'.$tag.'>'; }
		}else{
			$tg = '<'.$tag.' '.$otro.' '.$clase.' >'.$texto.'</'.$tag.'>';
		}
		return $tg;
	}
	function dime($quierosaber)	{
		$aber = '¿ Que quieres saber ?';
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
			case 'año':		$aber = $nada['year'] ;
			break;
			case 'agno':	$aber = $nada['year'] ;
			break;
			case 'hoy es':	$aber = $nada['wday'] ;
			break;
			case 'fecha': 
				
				$aber = $nada['year'];
				$aber .= '-';
				if($nada['mon'] < 10){
					$aber .= 0;
				}
				$aber .= $nada['mon'].'-';
				if($nada['mday'] < 10){
					$aber .=0;
				}				
				$aber .= $nada['mday'];
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
	//Recibe la fecha formato año-mes-dia y regresa desglozada en dia,mes,año
	function sinAcentos($cadena){
	   $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ· #";
	   $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn-__";
	   $resultado = strtr($cadena,$tofind,$replac);
	   return $resultado;
	}
	function fecha($fecha){
		if(!empty($fecha)){
			$newdate[0] = substr($fecha, -2);//dia
			$newdate[1] = substr($fecha, 5, 2);//mes
			$newdate[2] = substr($fecha, 0, -5);//año
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
			case 'caña':         $nomb = 'limon';    break;
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
			if(empty($_SESSION['idu'])){//mostrar u ocultar la barra de navegación superior
				$display = 'display:none;';
			}else{
				$display = 'display:block;';				
			}
						
			$cont=
			   '
				<!--Navegación Superior-->
				<div class="row-fluid" id="sub-header-nav" style="'.$display.'">

					<div class="span12">																
						<div class="btn-group pull-right" style="margin-top:4px;">
						  <a href="#" class="btn btn-primary"><i class="icon-user icon-white"></i> '.$_SESSION['user'].'</a>
						  <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu" style="margin:2px 0px 0px -44px;">
							<li><a href="./?url=logout">Cerrar Sesi&oacute;n</a></li>
						  </ul>
						</div>					
					</div>
					<div style="float:right;"><i>Hoy es '.$this->dime('dia es').' '.$this->dime('dia').' de '.$this->dime('mes es').' del '.$this->dime('agno').'</i></div>
				</div> ';
				
				$mantener = $_GET['sbm'];
				if(empty($mantener)){
					$display1='none';
					$display2='none';
					$display3='none';
					$display5='none';
					$display6='none';
					$display7='none';
				}else{
					if($mantener == 1){
						$display1='block';
						$activo1 ='class="active"';
						$display2='none';
						$display3='none';
						$display5='none';
						$display6='none';
						$display7='none';
					}
					if($mantener == 2){
						$display1='none';
						$display2='block';
						$activo2 = 'class="active"';
						$display3='none';
						$display5='none';
						$display6='none';
						$display7='none';
					}
					if($mantener == 3){
						$display1='none';
						$display2='none';
						$display3='block';
						$activo3 = 'class="active"';
						$display5='none';
						$display6='none';
						$display7='none';
					}
					if($mantener == 4){
						$display1='none';
						$display2='none';
						$display3='none';					
						$display5='none';
						$display6='none';
						$display7='none';
					}
					if($mantener == 5){
						$display1='none';
						$display2='none';
						$display3='none';						
						$display5='block';
						$activo5 = 'class="active"';
						$display6='none';
						$display7='none';
					}
					if($mantener == 6){
						$display1='none';
						$display2='none';
						$display3='none';						
						$display5='none';
						$display6='block';
						$activo6 = 'class="active"';
						$display7='none';
					}
					if($mantener == 7){
						$display1='none';
						$display2='none';
						$display3='none';						
						$display6='none';
						$display5='none';
						$display7='block';
						$activo7 = 'class="active"';
					}
					if($mantener == 8){
						$display1='none';
						$display2='none';
						$display3='none';						
						$display6='none';
						$display5='none';
						$display7='none';
					}
				}
			
		$cont.= '	
			<div class="row-fluid" style="min-height:430px;background:#fff;">  
				<!--Aside-->
				<div class="span2" id="menu">				
					<!--Inicio (Exclusivo para editar doctores y capturar todos los datos generales para los administradores 
						y el equipo médico)-->					
					<div class="css_acordeon" id="mostrar_ocultar5" id="accordion-5" style="display:'.$display5.';">			
						<h3>Men&uacute; Administrativo</h3>
						<hr>';
					if($_SESSION['idgu'] == 1){
						$cont.='
						<div>
							<ul class="acordeon_link">
								<li><a href="./?url=usuarios&sbm=5" class="link" title="Editar Usuarios">Usuarios</a></li>
							</ul>
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a href="./?url=addmedico&sbm=5" class="link" title="Editar Profesionales">Profesionales</a></li>
							</ul>
						</div>
						';
					}
						$cont.='
						<div>
							<ul class="acordeon_link">
								<li><a href="./?url=nuevopaciente&sbm=5" class="link" title="Agregar Nuevo Paciente">Pacientes</a></li>
							</ul>
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a href="./?url=equipos_medicos&sbm=5" class="link" title="Equipo M&eacute;dicos">Equipos M&eacute;dicos</a></li>
							</ul>
						</div>	
						<div>
							<ul class="acordeon_link">
								<li><a href="./?url=camas&sbm=5" class="link" title="Editar Camas">Camas</a></li>
							</ul>
						</div>	
						<div>
							<ul class="acordeon_link">
								<li><a href="./?url=salas&sbm=5" class="link" title="Editar Salas">Salas</a></li>
							</ul>
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a href="./?url=servicios&sbm=5" class="link" title="Editar Servicios M&eacute;dicos">Servicios M&eacute;dicos</a></li>
							</ul>
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a href="./?url=zonas&sbm=5" class="link" title="Editar Zonas">Zona</a></li>
							</ul>
						</div>							
					</div>	
					<!--DOMICILIARIA-->					
					<div class="css_acordeon" id="mostrar_ocultar1" id="accordion-1" style="display:'.$display1.';">			
						<h3>Men&uacute; Atenci&oacute;n Domiciliaria</h3><hr>
						<div style="margin-bottom:2px;">
							<input id="ac-1" name="acordeon" type="radio" />
							<label for="ac-1">Registro de Visitas Domiciliarias</label>
							<article>	
								<ul>									
									<li><a class="sublink" href="./?url=domiciliaria_visita_realizada&sbm=1" title="Visitas Realizadas"><i>Visitas Realizadas</i></a></li>				
									<li><a class="sublink" href="./?url=nueva_cita&sbm=1" title="Agenda"><i>Agenda</i></a></li>				
								</ul>
							</article>	
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=domiciliarias_diario_actividades&sbm=1&t=1" title="Registro Diario de Actividades">Registro Diario de Actividades</a></li>
							</ul>
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=domiciliaria_surco&sbm=1" Title="Sistema &Uacute;nico de Referencia y Contra-Referencia">Surco</a></li>
							</ul>
						</div>
						<div style="margin-bottom:10px;">
							<input id="ac-2" name="acordeon" type="radio" />
							<label for="ac-2">Indicadores</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=indicadores_total_visitas&sbm=1" title="Total de Visitas Realizadas por Periodo de Tiempo"><i>Total de Visitas Realizadas x Periodo de Tiempo</i></a></li>
									<li><a class="sublink" href="./?url=indicadores_tiempo_promedio&sbm=1" title="Tiempo Promedio Empleado por Visita"><i>Tiempo Promedio Empleado por Visita</i></a></li>
									<li><a class="sublink" href="./?url=indicadores_pacientes_diagnostico&sbm=1" title="N&deg de Visitas por Paciente Seg&uacute;n Diagn&oacute;stico"><i>N&deg de Visitas x Paciente Seg&uacute;n Diagn&oacute;stico</i></a></li>
									<li><a class="sublink" href="./?url=indicadores_actividades_realizadas&sbm=1" title="Actividades Realizadas por Visitas"><i>Actividades Realizadas por Visitas</i></a></li>		
								</ul>
							</article>	
						</div>
					</div>	
					
					<!--AMBULATORIA-->
					<div class="css_acordeon" id="mostrar_ocultar2" id="accordion-2" style="display:'.$display2.';">			
						<h3>Men&uacute; Atenci&oacute;n Ambulatoria</h3><hr>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=domiciliarias_diario_actividades&sbm=2&t=2" title="Registro Diario de Actividades">Registro Diario de Actividades</a></li>
							</ul>
						</div>
						<div>
							<input id="ac-4" name="acordeon" type="radio" />
							<label for="ac-4">Contacto Telef&oacute;nico</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=ambulatoria_atencionalpaciente&sbm=2" title="Atenci&oacute;n al Paciente"><i>Atenci&oacute;n al Paciente</i></a></li>
									<li><a class="sublink" href="./?url=ambulatoria_interconsulta&sbm=2" title="Interconsulta"><i>Interconsulta</i></a></li>								
								</ul>
							</article>	
						</div>
						<div style="margin-bottom:10px;">
							<input id="ac-5" name="acordeon" type="radio" />
							<label for="ac-5">Indicadores</label>
							<article>	
								<ul>
									<li><a class="sublink" href="#" title="Frecuentaci&oacuten Paciente/Familiar a la Instalaci&oacute;n por Periodo de Tiempo"><i>Frecuentaci&oacuten P/F a la Instalaci&oacute;n x Periodo de Tiempo</i></a></li>									
									<li><a class="sublink" href="./?url=indicadores_actividades_realizadas&sbm=2" title="Actividades Realizadas por Paciente"><i>Actividades Realizadas por Paciente</i></a></li>								
								</ul>
							</article>	
						</div>
					</div>	
						
					<!--HOSPITALARIA-->
					<div class="css_acordeon" id="mostrar_ocultar3" id="accordion-3" style="display:'.$display3.';">			
						<h3>Men&uacute; Atenci&oacute;n Hospitalaria</h3><hr>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=domiciliarias_diario_actividades&sbm=3&t=3" title="Registro Diario de Actividades">Registro Diario de Actividades</a></li>
							</ul>
						</div>
						<div style="margin-bott om:2px;">
							<input id="ac-6" name="acordeon" type="radio" />
							<label for="ac-6">RAE</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=hospitalaria_rae_evolucion&sbm=3" title="Evoluci&oacute;n"><i>Evoluci&oacute;n</i></a></li>				
								</ul>
							</article>	
						</div>
						<div style="margin-bottom:10px;">
							<input id="ac-7" name="acordeon" type="radio" />
							<label for="ac-7">Indicadores</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=indicadores_porcentaje_camas&sbm=3" title="Porcentaje de Ocupaci&oacute;n de Camas"><i>Porcentaje de Ocupaci&oacute;n de Camas</i></a></li>								
									<li><a class="sublink" href="#" title="Giro de Cama"><i>Giro de Cama</i></a></li>								
									<li><a class="sublink" href="./?url=indicadores_promedio_dias&sbm=3" title="Promedio de D&iacute;as de Estancia"><i>Promedio de D&iacute;as de Estancia</i></a></li>								
									<li><a class="sublink" href="#" title="Porcentaje de egresos"><i>Porcentaje de Egresos</i></a></li>								
									<li><a class="sublink" href="#" title="Razones de Readmisiones"><i>Razones de Readmisiones</i></a></li>								
									<li><a class="sublink" href="./?url=indicadores_infeccion_nosocomial&sbm=3" title="Porcentaje de Infecciones Nosocomiales"><i>Porcentaje de Infecciones Nosocomiales</i></a></li>								
									<li><a class="sublink" href="./?url=indicadores_porcentaje_hospitalizados&sbm=3" title="Porcentaje de Hospitalizados referidos de Consulta externa"><i>Porcentaje de Hospitalizados referidos de Consulta externa</i></a></li>
								</ul>
							</article>	
						</div>
					</div>						

					<!--DATOS DEL PACIENTE-->
					<div class="css_acordeon" id="mostrar_ocultar6" id="accordion-6" style="display:'.$display6.';">			
						<h3>Men&uacute; Datos del Paciente</h3><hr>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=nuevopaciente&sbm=6&t=6" title="Paciente">Paciente</a></li>
							</ul>
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=ambulatoria_atencionalpaciente&sbm=6&t=6" title="Historial del Paciente">Historial del Paciente</a></li>
							</ul>
						</div>
					</div>

					<!--DATOS CLINICOS-->
					<div class="css_acordeon" id="mostrar_ocultar7" id="accordion-7" style="display:'.$display7.';">			
						<h3>Men&uacute; Datos Cl&iacute;nicos</h3><hr>
						<div style="margin-bottom:2px;">
							<input id="ac-8" name="acordeon" type="radio" />
							<label for="ac-8">Registro de Visitas Domiciliarias</label>
							<article>	
								<ul>									
									<li><a class="sublink" href="./?url=domiciliaria_visita_realizada&sbm=7" title="Visitas Realizadas"><i>Visitas Realizadas</i></a></li>				
									<li><a class="sublink" href="./?url=nueva_cita&sbm=7" title="Agenda"><i>Agenda</i></a></li>				
								</ul>
							</article>	
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=menu_diario_actividades&sbm=7&t=7" title="Registros Diarios de Actividades">Registro Diario de Actividades</a></li>
							</ul>
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=domiciliaria_surco&sbm=7" Title="Sistema &Uacute;nico de Referencia y Contra-Referencia">Surco</a></li>
							</ul>
						</div>
						<div style="margin-bott om:2px;">
							<input id="ac-9" name="acordeon" type="radio" />
							<label for="ac-9">RAE</label>
							<article>	
								<ul>
									<li><a class="sublink" href="./?url=hospitalaria_rae_evolucion&sbm=7" title="Evoluci&oacute;n"><i>Evoluci&oacute;n</i></a></li>				
								</ul>
							</article>	
						</div>
						<div>
							<ul class="acordeon_link">
								<li><a class="link" href="./?url=escala_edmont&sbm=7" Title="Escala de Edmont">Escala de Edmont</a></li>
							</ul>
						</div>
					</div>


				</div>	
				
				<!--Contenido-->
				<!--Diseño del contenido de la página-->
				<div class="span10" id="contenido">
					'.$this->latino($this->derecha).'
				</div>
				<!--Fin del Contenido-->
			</div>
			';
			
			if(!empty($_SESSION['idu'])){
					$cont.= '						
						<div class="row-fluid">
							<div class="span12">	
								<!--Nav-->
								<div class="navbar">
									<div class="navbar-inner">
										<div class="container-fluid">
										
											<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar collapsed">
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</a> 
												<a href="./?url=inicio" class="brand">Menu</a>	
											<div class="nav-collapse navbar-responsive-collapse collapse">
												<ul class="nav">';																						
												if($_SESSION['idgu'] == 2){
													$cont.='
													<li '.$activo4.'>
														<a href="http://gisespanama.org/RedSocialCPPanama/" title="Red Social"><img src="./iconos/social.png" style="width:30px; heigth:30px;"/> Red Social</a>
													</li>';
												}else{
													if($_SESSION['idgu'] <> 4){
														$cont.='
														<li '.$activo5.'>
															<a href="#" id="show5" title="Inicio"><img src="./iconos/inicio.png"style="width:30px; heigth:30px;"/> Inicio</a>
														</li>
														<li '.$activo1.'>
															<a href="#" id="show1" title="Atenci&oacute;n Domiciliaria"><img src="./iconos/atencion_domiciliaria.png"style="width:30px; heigth:30px;"/> Domiciliaria</a>
														</li>
														<li '.$activo2.'>
															<a href="#" id="show2" title="Atenci&oacute;n Ambulatoria"><img src="./iconos/atencion_ambulatoria.png" style="width:30px; heigth:30px;"/> Ambulatoria</a>
														</li>
														<li '.$activo3.'>
															<a href="#" id="show3" title="Atenci&oacute;n Hospitalaria"><img src="./iconos/atencion_hospitalaria.png" style="width:30px; heigth:30px;"/> Hospitalaria</a>
														</li>
														<li>
															<a href="http://gisespanama.org/RedSocialCPPanama/" title="Red Social"><img src="./iconos/social.png" style="width:30px; heigth:30px;"/> Red Social</a>
														</li>';													

													}else{

														$cont.='
															<li '.$activo6.'>
															<a href="#" id="show6" title="Datos del Paciente"><img src="./iconos/paciente.png" style="width:30px; heigth:30px;"/> Datos del Paciente</a>
															</li>
															<li '.$activo7.'>
															<a href="#" id="show7" title="Datos Cl&iacute;nicos"><img src="./iconos/agenda.png" style="width:30px; heigth:30px;"/> Datos Cl&iacute;nicos</a>
															</li>
															<li '.$activo2.'>
															<a href="./?url=contacto_telefonico" title="Contacto Telef&oacute;nico"><img src="./iconos/telephone.png" style="width:30px; heigth:30px;"/> Contacto Telef&oacute;nico</a>
															</li>

														';

													}
												}
					$cont.='								
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>';				
				}				
			echo $cont;
	}
	function latino( $texto ) {
		$search  = array('á','é','í','ó','ú','ñ','Ñ','Á','É','Í','Ó','Ú','ü');
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
						<!--<b><a href="./?accion=rptpass" >&iquestOlvidó su contraseña?</a></</b>-->
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
			$edad = 'Fecha Inválida';
		}else{
			if($anio < $this->dime('agno')){
				if($mes < $this->dime('mes')){
					$edad = $this->dime('agno') - $anio;
				}else{
					$edad = $this->dime('agno') - $anio;
					$edad--;
				}				
			}
		}
		return $edad;
	}

}