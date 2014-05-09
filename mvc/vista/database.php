<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	echo $ds->dime('fecha');
	//$sql = 'select d.PRIMER_NOMBRE, d.SEGUNDO_NOMBRE, d.APELLIDO_PATERNO, u.NO_IDENTIFICACION from pacientes p, datos_pacientes d, usuarios u where p.ID_USUARIO = u.ID_USUARIO AND p.ID_PACIENTE = d.ID_PACIENTE';	
	//$sql = 'ALTER TABLE `cuidados_paliativos_panama`.`profesionales_salud` ADD COLUMN `ID_USUARIO` INTEGER(11)) UNSIGNED NOT NULL AFTER `ID_ESPECIALIDAD_MEDICA`;';	
	$sql = 'CREATE TABLE `cuidados_paliativos_panama`.`respuesta_interconsulta` (
				  `ID_RESPUESTA_INTERCONSULTA` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
				  `ID_INTERCONSULTA` INTEGER UNSIGNED NOT NULL,
				  `ID_PROFESIONAL` INTEGER UNSIGNED NOT NULL,
				  `FECHA` DATE NOT NULL,
				  `OBSERVACIONES` TEXT NOT NULL,
				  PRIMARY KEY (`ID_RESPUESTA_INTERCONSULTA`),
				  CONSTRAINT `FK_respuesta_interconsulta_interconsulta` FOREIGN KEY `FK_respuesta_interconsulta_interconsulta` (`ID_INTERCONSULTA`)
					REFERENCES `interconsulta` (`ID_INTERCONSULTA`)
					ON DELETE RESTRICT
					ON UPDATE RESTRICT
				)
				ENGINE = InnoDB;
	';
	$sql = 'ALTER TABLE `cuidados_paliativos_panama`.`atencion_paciente` MODIFY COLUMN `MINUTOS_UTILIZADOS` INTEGER UNSIGNED DEFAULT NULL;';
	/*$sql = 'ALTER TABLE `cuidados_paliativos_panama`.`respuesta_interconsulta` ADD COLUMN `ID_PACIENTE` INTEGER UNSIGNED NOT NULL AFTER `OBSERVACIONES`;';
	$sql = '
		CREATE TABLE `cuidados_paliativos_panama`.`atencion_paciente` (
		  `ID_ATENCION` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
		  `ID_PROFESIONAL` INTEGER UNSIGNED NOT NULL,
		  `ID_PACIENTE` INTEGER UNSIGNED NOT NULL,
		  `FECHA` VARCHAR(45) NOT NULL DEFAULT "0000-00-00",
		  `HORA_INICIO` VARCHAR(45) DEFAULT NULL,
		  `HORA_FIN` VARCHAR(45) DEFAULT NULL,
		  `MINUTOS_UTILIZADOS` DOUBLE DEFAULT NULL,
		  `OBSERVACION` TEXT DEFAULT NULL,
		  `TIPO_CONTACTO` TINYINT(5) UNSIGNED NOT NULL DEFAULT 1,
		  `E_MAIL` VARCHAR(45) DEFAULT NULL,
		  `TELEFONO` VARCHAR(45) DEFAULT NULL,
		  PRIMARY KEY (`ID_ATENCION`)
		)
		ENGINE = InnoDB;
	';
	$sql = 'ALTER TABLE `cuidados_paliativos_panama`.`respuesta_interconsulta` ADD COLUMN `ID_PROFESIONAL` INTEGER UNSIGNED NOT NULL AFTER `OBSERVACIONES`;';*/
	//$sql = 'ALTER TABLE `cuidados_paliativos_panama`.`atencion_paciente` ADD COLUMN `MOTIVO` VARCHAR(45) NOT NULL AFTER `TELEFONO`;';
	//$ds->db->query($sql);
	//echo $ds->verArreglo($ds->db->obtenerArreglo($sql));
	
?>