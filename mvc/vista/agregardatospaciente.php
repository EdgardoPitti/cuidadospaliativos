<?php
	include_once('./mvc/modelo/Accesatabla.php');
	include_once('./mvc/modelo/diseno.php');
	$datospaciente = new Accesatabla('datos_pacientes');
	$residencia = new Accesatabla('residencia_habitual');
	$ds = new Diseno();
	$sw = $_GET['sw'];
	$idpaciente = $_GET['id'];
	if(empty($idpaciente)){
		$residencia->nuevo();
		$residencia->colocar("ID_PROVINCIA", $_POST['provincias']);
		$residencia->colocar("ID_DISTRITO", $_POST['distritos']);
		$residencia->colocar("ID_CORREGIMIENTO", $_POST['corregimientos']);
		$residencia->colocar("ID_ZONA", $_POST['zona']);
		$residencia->colocar("DETALLE", $_POST['direcciondetallada']);
		$residencia->salvar();

		$fechanacimiento = $_POST['fechanacimiento'];
		$fecha = '"'.$fechanacimiento.'"';
		$sql = 'SELECT max(ID_RESIDENCIA_HABITUAL) as id FROM residencia_habitual';
		$id = $ds->db->obtenerArreglo($sql);

		list($anio, $mes, $dia) = explode("-", $_POST['fechanacimiento']);
		$edad = $ds->edad($dia,$mes,$anio);

		$datospaciente->nuevo();
		$datospaciente->colocar("NO_CEDULA", $_POST['cedula']);
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
		$datospaciente->colocar("ID_RESIDENCIA_HABITUAL", $id[0][id]);
		$datospaciente->colocar("RESIDENCIA_TRANSITORIA", $_POST['residenciatransitoria']);
		$datospaciente->colocar("NOMBRE_PADRE", $_POST['nombrepadre']);
		$datospaciente->colocar("NOMBRE_MADRE", $_POST['nombremadre']);
		$datospaciente->salvar();
		$sql = 'SELECT max(ID_PACIENTE) as id FROM datos_pacientes';
		$id = $ds->db->obtenerArreglo($sql);
		$idpaciente = $id[0][id];
	}

	if(!empty($sw) or !empty($_GET['id'])){
		$responsable = new Accesatabla('responsable_paciente');
		$responsable->nuevo();
		$responsable->colocar("ID_PACIENTE", $idpaciente);
		$responsable->colocar("NOMBRE_CONTACTO", $_POST['nombreresponsable']);
		$responsable->colocar("APELLIDO_CONTACTO", $_POST['apellidoresponsable']);
		$responsable->colocar("PARENTESCO_CONTACTO", $_POST['parentesco']);
		$responsable->colocar("DIRECCION_CONTACTO", $_POST['direccionresponsable']);
		$responsable->colocar("TELEFONO_CONTACTO", $_POST['telefonoresponsable']);
		$responsable->salvar();
	}
	if(empty($_GET['id'])){
		include_once('./mvc/vista/inicio.php');
	}else{
		echo '<br><br><br><br><br><br><br><br><center><h1><a href="./?url=hospitalaria_rae_evolucion&id='.$idpaciente.'">Click para continuar....</a></h1></center><br><br><br><br><br><br><br><br>';
	}
	
?>