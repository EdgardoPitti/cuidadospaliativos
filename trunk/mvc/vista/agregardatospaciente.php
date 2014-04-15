<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$datospaciente = new Accesatabla('datos_pacientes');
	$paciente = new Accesatabla('pacientes');
	$residencia = new Accesatabla('residencia_habitual');
	$usuarios = new Accesatabla('usuarios');
	$ds = new Diseno();
	//Variable utilizada como Switch para controlar de que vista viene
	$sw = $_GET['sw'];
	$idpaciente = $_GET['id'];
	
	//Si esta vacio el idpaciente quiere decir que es un paciente nuevo o que estan editando alguno
	$datos = $datospaciente->buscardonde('NO_CEDULA = "'.$_POST['cedula'].'" OR ID_PACIENTE = '.$idpaciente.'');
	if(empty($idpaciente)){
		//En caso de que exista se busca su residencia habitual para modificarla
		if($datos){
			$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$datospaciente->obtener('ID_RESIDENCIA_HABITUAL').'');
			$idresidencia = $residencia->obtener('ID_RESIDENCIA_HABITUAL');
			//Se obtiene el id del paciente para usarlo despues y se actualizan los datos correspondientes
			$idpaciente = $datospaciente->obtener('ID_PACIENTE');	
			$paciente->buscardonde('ID_PACIENTE = '.$datospaciente->obtener('ID_PACIENTE').'');
			$usuarios->buscardonde('ID_USUARIO = '.$paciente->obtener('ID_USUARIO').'');
			$idusuario = $usuarios->obtener('ID_USUARIO');
		}else{
			//Sino existe se crea un nuevo registro
			$residencia->nuevo();
			$usuarios->nuevo();
			//se crea un nuevo
			$datospaciente->nuevo();
			//Si el registro es nuevo es necesario colocar la cedula, en caso contrario no
			$datospaciente->colocar("NO_CEDULA", $_POST['cedula']);
			//Se obtiene la fecha de nacimiento
			$fechanacimiento = $_POST['fechanacimiento'];
			$fecha = '"'.$fechanacimiento.'"';
		}
	}else{
		$datospaciente->buscardonde('ID_PACIENTE = '.$idpaciente.'');
		$paciente->buscardonde('ID_PACIENTE = '.$idpaciente.'');
		$residencia->buscardonde('ID_RESIDENCIA_HABITUAL = '.$datospaciente->obtener('ID_RESIDENCIA_HABITUAL').'');
		$idresidencia = $residencia->obtener('ID_RESIDENCIA_HABITUAL');
		$usuarios->buscardonde('ID_USUARIO = '.$paciente->obtener('ID_USUARIO').'');
		$idusuario = $usuarios->obtener('ID_USUARIO');
	}
	//Se descompone la fecha en a�o, mes y dia
	list($anio, $mes, $dia) = explode("-", $_POST['fechanacimiento']);
	//Se llama la funcion de dise�o llamada edad mandandole la fecha desglozada para obtener la edad
	$edad = $ds->edad($dia,$mes,$anio);
	//Se Almacenan los valores correspondientes y se salva
	$residencia->colocar("ID_PROVINCIA", $_POST['provincias']);
	$residencia->colocar("ID_DISTRITO", $_POST['distritos']);
	$residencia->colocar("ID_CORREGIMIENTO", $_POST['corregimientos']);
	$residencia->colocar("ID_ZONA", $_POST['zona']);
	$residencia->colocar("DETALLE", $_POST['direcciondetallada']);
	$residencia->salvar();
	//
	if(!$datos){
			$sql = 'SELECT max(ID_RESIDENCIA_HABITUAL) as id FROM residencia_habitual';
			$id = $ds->db->obtenerArreglo($sql);
			//Se almacena el id max en la variable $idresidencia
			$idresidencia = $id[0][id];
	}
	$datospaciente->colocar("SEGURO_SOCIAL", $_POST['numeroseguro']);
	$datospaciente->colocar("PRIMER_NOMBRE", $_POST['primernombre']);
	$datospaciente->colocar("SEGUNDO_NOMBRE", $_POST['segundonombre']);
	$datospaciente->colocar("APELLIDO_PATERNO", $_POST['primerapellido']);
	$datospaciente->colocar("APELLIDO_MATERNO", $_POST['segundoapellido']);
	$datospaciente->colocar("ID_ESTADO_CIVIL", $_POST['estadocivil']);
	$datospaciente->colocar("ID_SEXO", $_POST['sexo']);
	$datospaciente->colocar("FECHA_NACIMIENTO",$fecha );
	$datospaciente->colocar("LUGAR_NACIMIENTO", $_POST['lugarnacimiento']);
	$datospaciente->colocar("EDAD_PACIENTE", $edad);
	$datospaciente->colocar("ID_ETNIA", $_POST['etnia']);
	$datospaciente->colocar("ID_TIPO_SANGUINEO", $_POST['tiposangre']);
	$datospaciente->colocar("ID_NACIONALIDAD", $_POST['nacionalidad']);
	$datospaciente->colocar("ID_TIPO_PACIENTE", $_POST['tipopaciente']);
	$datospaciente->colocar("TELEFONO_CASA", $_POST['telefono']);
	$datospaciente->colocar("TELEFONO_CELULAR", $_POST['celular']);
	$datospaciente->colocar("E_MAIL", $_POST['correo']);
	$datospaciente->colocar("OCUPACION", $_POST['ocupacion']);
	$datospaciente->colocar("ID_RESIDENCIA_HABITUAL", $idresidencia);
	$datospaciente->colocar("RESIDENCIA_TRANSITORIA", $_POST['residenciatransitoria']);
	$datospaciente->colocar("NOMBRE_PADRE", $_POST['nombrepadre']);
	$datospaciente->colocar("NOMBRE_MADRE", $_POST['nombremadre']);
	$datospaciente->salvar();
	//
	$usuarios->colocar("NO_IDENTIFICACION", $_POST['usuario']);
	$usuarios->colocar("CLAVE_ACCESO", $_POST['pass']);
	$usuarios->colocar("ID_GRUPO_USUARIO", 2);
	$usuarios->salvar();
	
	if(!$datos){
		$sql = 'SELECT max(ID_PACIENTE) as id FROM datos_pacientes';
		$id = $ds->db->obtenerArreglo($sql);
		$idpaciente = $id[0][id];
		
		$sql = 'SELECT MAX(ID_USUARIO) as id FROM USUARIOS';
		$matriz = $ds->db->obtenerarreglo($sql);
		$idusuario = $matriz[0][id];
		
		$paciente->nuevo();
		$paciente->colocar("ID_PACIENTE", $idpaciente);
		$paciente->colocar("ID_USUARIO", $idusuario);
		$paciente->salvar();
	}

	//Si no esta vacia la variable $sw o si no esta vacio al obtener el id por GET quiere decir que el registro es 
	//de un paciente de atencion hospitalaria por lo tanto debe almacenar una persona responsable
	if(!empty($sw)){
		//Se instancia la tabla que almacena los datos del responsable del paciente
		$responsable = new Accesatabla('responsable_paciente');
		//Comprobamos que el paciente no exista
		if(!$datos){
			//Sino existe se almacenara en un nuevo registro
			$responsable->nuevo();
			//Se coloca el id del paciente en la tabla del responsable
			$responsable->colocar("ID_PACIENTE", $idpaciente);
		}else{
			//Si existe el paciente se busca el responsable para con el id del paciente para actualizar los datos del responsable
			$resp = $responsable->buscardonde('ID_PACIENTE = '.$idpaciente.'');
			if(!$resp){
				//Sino existe se almacenara en un nuevo registro
				$responsable->nuevo();
				//Se coloca el id del paciente en la tabla del responsable
				$responsable->colocar("ID_PACIENTE", $idpaciente);
			}
			
		}
		//Se almacenan los datos correpondientes
		$responsable->colocar("NOMBRE_CONTACTO", $_POST['nombreresponsable']);
		$responsable->colocar("APELLIDO_CONTACTO", $_POST['apellidoresponsable']);
		$responsable->colocar("PARENTESCO_CONTACTO", $_POST['parentesco']);
		$responsable->colocar("DIRECCION_CONTACTO", $_POST['direccionresponsable']);
		$responsable->colocar("TELEFONO_CONTACTO", $_POST['telefonoresponsable']);
		$responsable->salvar();
	}
	if($_GET['ch']){
		echo "<script language='javascript'>alert('Datos Actualizados Correctamente')</script>";		
	}else{
		echo "<script language='javascript'>alert('Datos Almacenados Correctamente')</script>";		
	}
	if(!empty($sw)){
		$url='hospitalaria_rae_evolucion&id='.$idpaciente.'&sbm=3';
	}else{
		$url='nuevopaciente&id='.$idpaciente.'&sbm=5';
	}
	echo '<script language="javascript">location.href="./?url='.$url.'"</script>';

?>