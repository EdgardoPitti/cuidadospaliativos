-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema paliativos
--

CREATE DATABASE IF NOT EXISTS paliativos;
USE paliativos;

--
-- Definition of table `admision_egreso`
--

DROP TABLE IF EXISTS `admision_egreso`;
CREATE TABLE `admision_egreso` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `dia_ingreso` int(10) unsigned NOT NULL,
  `mes_ingreso` int(10) unsigned NOT NULL,
  `agno_ingreso` int(10) unsigned default NULL,
  `dia_egreso` int(10) unsigned NOT NULL,
  `mes_egreso` int(10) unsigned NOT NULL,
  `agno_egreso` int(10) unsigned NOT NULL,
  `numero_cama` varchar(45) NOT NULL,
  `id_condicion_salida` int(10) unsigned NOT NULL,
  `motivo_salida` tinyint(1) unsigned NOT NULL default '0',
  `dia_autopsia` int(10) unsigned default NULL,
  `mes_autopsia` int(10) unsigned default NULL,
  `agno_autopsia` int(10) unsigned default NULL,
  `dia_cierre_egreso` int(10) unsigned default NULL,
  `mes_cierre_egreso` int(10) unsigned default NULL,
  `agno_cierre_egreso` int(10) unsigned default NULL,
  `autopsia` tinyint(1) unsigned NOT NULL default '0',
  `hospitalizacion_en_agno` tinyint(1) unsigned NOT NULL default '0',
  `id_usuario_registro_medico` int(10) unsigned NOT NULL,
  `id_medico_general` int(10) unsigned NOT NULL,
  `id_medico_especialista` int(10) unsigned NOT NULL,
  `id_usuario_jefe_sala` int(10) unsigned NOT NULL,
  `id_referencias` int(10) unsigned NOT NULL,
  `id_atencion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_admision_egreso_condicion` (`id_condicion_salida`),
  KEY `FK_admision_egreso_medico_general` (`id_medico_general`),
  KEY `FK_admision_egreso_medico_especialista` (`id_medico_especialista`),
  KEY `FK_admision_egreso_persona_registro_medico` USING BTREE (`id_usuario_registro_medico`),
  KEY `FK_admision_egreso_usuario_jefe_sala` (`id_usuario_jefe_sala`),
  KEY `FK_admision_egreso_referencias` (`id_referencias`),
  KEY `FK_admision_egreso_atencion` (`id_atencion`),
  CONSTRAINT `FK_admision_egreso_atencion` FOREIGN KEY (`id_atencion`) REFERENCES `atenciones` (`id`),
  CONSTRAINT `FK_admision_egreso_condicion` FOREIGN KEY (`id_condicion_salida`) REFERENCES `condiciones_de_salida` (`id`),
  CONSTRAINT `FK_admision_egreso_medico_especialista` FOREIGN KEY (`id_medico_especialista`) REFERENCES `personal_medico` (`id`),
  CONSTRAINT `FK_admision_egreso_medico_general` FOREIGN KEY (`id_medico_general`) REFERENCES `personal_medico` (`id`),
  CONSTRAINT `FK_admision_egreso_referencias` FOREIGN KEY (`id_referencias`) REFERENCES `referencias` (`id`),
  CONSTRAINT `FK_admision_egreso_usuario_jefe_sala` FOREIGN KEY (`id_usuario_jefe_sala`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_admision_egreso_usuario_registro_medico` FOREIGN KEY (`id_usuario_registro_medico`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admision_egreso`
--

/*!40000 ALTER TABLE `admision_egreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `admision_egreso` ENABLE KEYS */;


--
-- Definition of table `almacen`
--

DROP TABLE IF EXISTS `almacen`;
CREATE TABLE `almacen` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_medicamento` int(10) unsigned NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  `observacion` text NOT NULL,
  `fecha_expiracion` varchar(45) NOT NULL,
  `saldo_mes_anterior` int(10) unsigned NOT NULL,
  `cantidad_recibida_mensual` int(10) unsigned NOT NULL,
  `cantidad_mensual` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `FK_almacen_medicamentos` (`id_medicamento`),
  CONSTRAINT `FK_almacen_medicamentos` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `almacen`
--

/*!40000 ALTER TABLE `almacen` DISABLE KEYS */;
/*!40000 ALTER TABLE `almacen` ENABLE KEYS */;


--
-- Definition of table `aseguradoras`
--

DROP TABLE IF EXISTS `aseguradoras`;
CREATE TABLE `aseguradoras` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aseguradoras`
--

/*!40000 ALTER TABLE `aseguradoras` DISABLE KEYS */;
/*!40000 ALTER TABLE `aseguradoras` ENABLE KEYS */;


--
-- Definition of table `atenciones`
--

DROP TABLE IF EXISTS `atenciones`;
CREATE TABLE `atenciones` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_tipo_de_atencion` int(10) unsigned NOT NULL,
  `numero_de_tarjeta` varchar(10) default NULL,
  `id_paciente` int(10) unsigned NOT NULL,
  `horas_utilizadas` int(10) unsigned default NULL,
  `dia` int(10) unsigned NOT NULL,
  `mes` int(10) unsigned NOT NULL,
  `agno` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_atenciones_tiposdeatencion` USING BTREE (`id_tipo_de_atencion`),
  KEY `FK_atenciones_paciente` (`id_paciente`),
  CONSTRAINT `FK_atenciones_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`),
  CONSTRAINT `FK_atenciones_tipo_de_atencion` FOREIGN KEY (`id_tipo_de_atencion`) REFERENCES `tipos_de_atencion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `atenciones`
--

/*!40000 ALTER TABLE `atenciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `atenciones` ENABLE KEYS */;


--
-- Definition of table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE `cargos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cargos`
--

/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;


--
-- Definition of table `cie_10`
--

DROP TABLE IF EXISTS `cie_10`;
CREATE TABLE `cie_10` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cie_10`
--

/*!40000 ALTER TABLE `cie_10` DISABLE KEYS */;
/*!40000 ALTER TABLE `cie_10` ENABLE KEYS */;


--
-- Definition of table `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE `citas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_hora` int(10) unsigned NOT NULL,
  `id_medico` int(10) unsigned NOT NULL,
  `id_paciente` int(10) unsigned NOT NULL,
  `dia` varchar(3) NOT NULL,
  `mes` varchar(3) NOT NULL,
  `agno` varchar(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_citas_horas` USING BTREE (`id_hora`),
  KEY `FK_citas_medicos` USING BTREE (`id_medico`),
  KEY `FK_citas_paciente` USING BTREE (`id_paciente`),
  CONSTRAINT `FK_citas_horas` FOREIGN KEY (`id_hora`) REFERENCES `horas` (`id`),
  CONSTRAINT `FK_citas_medicos` FOREIGN KEY (`id_medico`) REFERENCES `personal_medico` (`id`),
  CONSTRAINT `FK_citas_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `citas`
--

/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;


--
-- Definition of table `codigo_cie_10`
--

DROP TABLE IF EXISTS `codigo_cie_10`;
CREATE TABLE `codigo_cie_10` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_hospitalizacion` int(10) unsigned NOT NULL,
  `diagnostico` text NOT NULL,
  `causa_externa` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_codigo_cie_10_hospitalizacion` (`id_hospitalizacion`),
  CONSTRAINT `FK_codigo_cie_10_hospitalizacion` FOREIGN KEY (`id_hospitalizacion`) REFERENCES `hospitalizacion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `codigo_cie_10`
--

/*!40000 ALTER TABLE `codigo_cie_10` DISABLE KEYS */;
/*!40000 ALTER TABLE `codigo_cie_10` ENABLE KEYS */;


--
-- Definition of table `condiciones_de_salida`
--

DROP TABLE IF EXISTS `condiciones_de_salida`;
CREATE TABLE `condiciones_de_salida` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `condiciones_de_salida`
--

/*!40000 ALTER TABLE `condiciones_de_salida` DISABLE KEYS */;
/*!40000 ALTER TABLE `condiciones_de_salida` ENABLE KEYS */;


--
-- Definition of table `corregimientos`
--

DROP TABLE IF EXISTS `corregimientos`;
CREATE TABLE `corregimientos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_distrito` int(10) unsigned NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_corregimientos_distritos` USING BTREE (`id_distrito`),
  CONSTRAINT `FK_corregimientos_distritos` FOREIGN KEY (`id_distrito`) REFERENCES `distritos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=575 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `corregimientos`
--

/*!40000 ALTER TABLE `corregimientos` DISABLE KEYS */;
INSERT INTO `corregimientos` (`id`,`id_distrito`,`descripcion`) VALUES 
 (1,1,'Bocas del Toro'),
 (2,1,'Bastimentos'),
 (3,1,'Cauchero'),
 (4,1,'Punta Laurel'),
 (5,1,'Tierra Oscura'),
 (6,2,'Chanquinola'),
 (7,2,'Almirante'),
 (8,2,'Guabito'),
 (9,2,'El Teribe'),
 (10,2,'Valle del Risco'),
 (11,2,'El Empalme'),
 (12,2,'Las Tablas'),
 (13,2,'Valle de Agua'),
 (14,2,'Nance de Risco'),
 (15,2,'Las Delicias'),
 (16,2,'Cochigro'),
 (17,2,'La Gloria'),
 (18,3,'Chiriqui Grande'),
 (19,3,'Bajo Cedro'),
 (20,3,'Miramar'),
 (21,3,'Punta Peña'),
 (22,3,'Punta Robalo'),
 (23,3,'Rambala'),
 (24,4,'Alanje'),
 (25,4,'Divala'),
 (26,4,'El Tejar'),
 (27,4,'Guarumal'),
 (28,4,'Palo Grande'),
 (29,4,'Querevalo'),
 (30,4,'Santo Tomas'),
 (31,4,'Canta Gallo'),
 (32,4,'Nuevo Mexico'),
 (33,5,'Puerto Armuelles'),
 (34,5,'Limones'),
 (35,5,'Progreso'),
 (36,5,'Baco'),
 (37,5,'Rodolfo Aguilar Delgado'),
 (38,6,'Boqueron'),
 (39,6,'Bagala'),
 (40,6,'Cordillera'),
 (41,6,'Guabal'),
 (42,6,'Guayabal'),
 (43,6,'Paraiso'),
 (44,6,'Pedregal'),
 (45,6,'Tijeras'),
 (46,7,'Bajo Boquete'),
 (47,7,'Caldera'),
 (48,7,'Palmira'),
 (49,7,'Alto Boquete'),
 (50,7,'Jaramillo'),
 (51,7,'Los Naranjos'),
 (52,8,'La Concepcion'),
 (53,8,'Aserrio de Gariche'),
 (54,8,'Bugaba'),
 (55,8,'Cerro Punta'),
 (56,8,'Gomez'),
 (57,8,'La Estrella'),
 (58,8,'San Andres'),
 (59,8,'Santa Marta'),
 (60,8,'Santa Rosa'),
 (61,8,'Santo Domingo'),
 (62,8,'Sortova'),
 (63,8,'Volcan'),
 (64,8,'El Bongo'),
 (65,8,'Solano'),
 (66,9,'David'),
 (67,9,'Bijagual'),
 (68,9,'Cochea'),
 (69,9,'Chiriqui'),
 (70,9,'Guaca'),
 (71,9,'Las Lomas'),
 (72,9,'Pedregal'),
 (73,9,'San Carlos'),
 (74,9,'San Pablo Nuevo'),
 (75,9,'San Pablo Viejo'),
 (76,10,'Dolega'),
 (77,10,'Dos Rios'),
 (78,10,'Los Anastacios'),
 (79,10,'Potrerillos'),
 (80,10,'Potrerillos Abajo'),
 (81,10,'Rovira'),
 (82,10,'Tinajas'),
 (83,10,'Los Algarrobos'),
 (84,11,'Gualaca'),
 (85,11,'Hornito'),
 (86,11,'Los Angeles'),
 (87,11,'Paja de Sombrero'),
 (88,11,'Rincon'),
 (89,12,'Remedios'),
 (90,12,'El Nancito'),
 (91,12,'El Porvenir'),
 (92,12,'El Puerto'),
 (93,12,'Santa Lucia'),
 (94,13,'Rio Sereno'),
 (95,13,'Breñon'),
 (96,13,'Cañas Gordas'),
 (97,13,'Monte Lirio'),
 (98,13,'Plaza de Caisan'),
 (99,13,'Santa Cruz'),
 (100,13,'Dominical'),
 (101,13,'Santa Clara'),
 (102,14,'Las Lajas'),
 (103,14,'Juay'),
 (104,14,'San Felix'),
 (105,14,'Lajas Adentro'),
 (106,14,'Santa Cruz'),
 (107,15,'Horconcitos'),
 (108,15,'Boca Chica'),
 (109,15,'Boca del Monte'),
 (110,15,'San Juan'),
 (111,15,'San Lorenzo'),
 (112,16,'Tole'),
 (113,16,'Cerro Viejo'),
 (114,16,'Lajas de Tole'),
 (115,16,'Potrero de Caña'),
 (116,16,'Quebrada de Piedra'),
 (117,16,'Bella Vista'),
 (118,16,'El Cristo'),
 (119,16,'Justo Fidel Palacios'),
 (120,16,'Veladero'),
 (121,17,'Aguadulce'),
 (122,17,'El Cristo'),
 (123,17,'El Roble'),
 (124,17,'Pocri'),
 (125,17,'Barrios Unidos'),
 (126,18,'Anton'),
 (127,18,'Cabuya'),
 (128,18,'El Chiru'),
 (129,18,'El Retiro'),
 (130,18,'El Valle'),
 (131,18,'Juan Diaz'),
 (132,18,'Rio Hato'),
 (133,18,'San Juan de Dios'),
 (134,18,'Santa Rita'),
 (135,18,'Caballero'),
 (136,19,'La Pintada'),
 (137,19,'El Harino'),
 (138,19,'El Potrero'),
 (139,19,'Llano Grande'),
 (140,19,'Piedras Gordas'),
 (141,19,'Las Lomas'),
 (142,20,'Nata'),
 (143,20,'Capellania'),
 (144,20,'El Caño'),
 (145,20,'Guzman'),
 (146,20,'Las Huacas'),
 (147,20,'Toza'),
 (148,21,'Ola'),
 (149,21,'El Cope'),
 (150,21,'El Palmar'),
 (151,21,'El Picacho'),
 (152,21,'La Pava'),
 (153,22,'Penonome'),
 (154,22,'Cañaveral'),
 (155,22,'Cocle'),
 (156,22,'Chiriqui Arriba'),
 (157,22,'El Coco'),
 (158,22,'Pajonal'),
 (159,22,'Rio Grande'),
 (160,22,'Rio Indio'),
 (161,22,'Toabre'),
 (162,22,'Tulu'),
 (163,22,'El Valle de San Miguel'),
 (164,23,'Barrio Norte'),
 (165,23,'Barrio Sur'),
 (166,23,'Buena Vista'),
 (167,23,'Cativa'),
 (168,23,'Circito'),
 (169,23,'Sabanitas'),
 (170,23,'Salamanca'),
 (171,23,'Limon'),
 (172,23,'Nueva Providencia'),
 (173,23,'Puerto Pilon'),
 (174,23,'Cristobal'),
 (175,23,'Escobal'),
 (176,23,'San Juan'),
 (177,23,'Santa Rosa'),
 (178,24,'Nuevo Chagres'),
 (179,24,'Achiote'),
 (180,24,'El Guabo'),
 (181,24,'La Encantada'),
 (182,24,'Palmas Bellas'),
 (183,24,'Piña'),
 (184,24,'Salud'),
 (185,25,'Miguel de la Borda'),
 (186,25,'Cocle del Norte'),
 (187,25,'El Guasimo'),
 (188,25,'Gobea'),
 (189,25,'Rio Indio'),
 (190,25,'San Jose del General'),
 (191,26,'Portobelo'),
 (192,26,'Cacique'),
 (193,26,'Garrote'),
 (194,26,'Isla Grande'),
 (195,26,'Maria Chiquita'),
 (196,27,'Palenque'),
 (197,27,'Cuango'),
 (198,27,'Miramar'),
 (199,27,'Nombre de Dios'),
 (200,27,'Palmira'),
 (201,27,'Playa Chiquita'),
 (202,27,'Santa Isabel'),
 (203,27,'Viento Frio'),
 (204,28,'La Palma'),
 (205,28,'Camoganti'),
 (206,28,'Chepigana'),
 (207,28,'Garachine'),
 (208,28,'Jaque'),
 (209,28,'Puerto Piña'),
 (210,28,'Rio Congo'),
 (211,28,'Rio Iglesias'),
 (212,28,'Sambu'),
 (213,28,'Seteganti'),
 (214,28,'Taimati'),
 (215,28,'Tucuti'),
 (216,28,'Agua Fria'),
 (217,28,'Cucunati'),
 (218,28,'Rio Congo Arriba'),
 (219,28,'Santa Fe'),
 (220,29,'El Real de Santa Maria'),
 (221,29,'Boca de Cupe'),
 (222,29,'Paya'),
 (223,29,'Pucuro'),
 (224,29,'Yape'),
 (225,29,'Yaviza'),
 (226,29,'Meteti'),
 (227,29,'Wargandi'),
 (228,30,'Chitré'),
 (229,30,'La Arena'),
 (230,30,'Llano Bonito'),
 (231,30,'San Juan Bautista'),
 (232,31,'Las Minas'),
 (233,31,'Chepo'),
 (234,31,'Chumical'),
 (235,31,'El Toro'),
 (236,31,'Leones'),
 (237,31,'Quebrada del Rosario'),
 (238,31,'Quebrada El Ciprián'),
 (239,32,'Los Pozos'),
 (240,32,'El Capuri'),
 (241,32,'El Calabacito'),
 (242,32,'El Cedro'),
 (243,32,'La Arena'),
 (244,32,'La Pitaloza'),
 (245,32,'Los Cerritos'),
 (246,32,'Los Cerros de Paja'),
 (247,32,'Las Llanas'),
 (248,33,'Ocu'),
 (249,33,'Cerro Largo'),
 (250,33,'Los Llanos'),
 (251,33,'Llano Grande'),
 (252,33,'Peñas Chatas'),
 (253,33,'El Tijera'),
 (254,33,'Menchaca'),
 (255,33,'Entradero del Castillo'),
 (256,34,'Parita'),
 (257,34,'Cabuya'),
 (258,34,'Los Castillos'),
 (259,34,'Llano de la Cruz'),
 (260,34,'Paris'),
 (261,34,'Portobelillo'),
 (262,34,'Potuga'),
 (263,35,'Pese'),
 (264,35,'Las Cabras'),
 (265,35,'Los Pajaros'),
 (266,35,'El Barrero'),
 (267,35,'El Pedregoso'),
 (268,35,'El Ciruelo'),
 (269,35,'Sabanagrande'),
 (270,35,'Rincón Hondo'),
 (271,36,'Santa Maria'),
 (272,36,'Chupampa'),
 (273,36,'El Rincon'),
 (274,36,'El Limon'),
 (275,36,'Los Canelos'),
 (276,37,'Guarare'),
 (277,37,'El Espinal'),
 (278,37,'El Macano'),
 (279,37,'Guarare Arriba'),
 (280,37,'La Enea'),
 (281,37,'La Pasera'),
 (282,37,'Las Trancas'),
 (283,37,'LLano Abajo'),
 (284,37,'El Hato'),
 (285,37,'Perales'),
 (286,38,'Las Tablas'),
 (287,38,'Bajo Corral'),
 (288,38,'Bayano'),
 (289,38,'El Carate'),
 (290,38,'El Cocal'),
 (291,38,'El Manantial'),
 (292,38,'El Muñoz'),
 (293,38,'El Pedregoso'),
 (294,38,'La Laja'),
 (295,38,'La Miel'),
 (296,38,'La Palma'),
 (297,38,'La Tiza'),
 (298,38,'Las Palmitas'),
 (299,38,'Las Tablas Abajo'),
 (300,38,'Nuario'),
 (301,38,'Palmira'),
 (302,38,'Peña Blanca'),
 (303,38,'Rio Hondo'),
 (304,38,'San Jose'),
 (305,38,'San Miguel'),
 (306,38,'Santo Domingo'),
 (307,38,'El Sesteadero'),
 (308,38,'Valle Rico'),
 (309,38,'Vallerriquito'),
 (310,39,'La Villa de Los Santos'),
 (311,39,'El Ejido'),
 (312,39,'El Guasimo'),
 (313,39,'La Colorada'),
 (314,39,'La Espigadilla'),
 (315,39,'Las Cruces'),
 (316,39,'Las Guabas'),
 (317,39,'Los Angeles'),
 (318,39,'Los Olivos'),
 (319,39,'Llano Largo'),
 (320,39,'Sabanagrande'),
 (321,39,'San Agustin'),
 (322,39,'Santa Ana'),
 (323,39,'Tres Quebradas'),
 (324,39,'Villa Lourdes'),
 (325,39,'Agua Buena'),
 (326,40,'Macaracas'),
 (327,40,'Bahia Honda'),
 (328,40,'Bajos de Güera'),
 (329,40,'Corozal'),
 (330,40,'Chupa'),
 (331,40,'El Cedro'),
 (332,40,'Espino Amarillo'),
 (333,40,'La Mesa'),
 (334,40,'Llano de Piedras'),
 (335,40,'Las Palmas'),
 (336,40,'Mogollon'),
 (337,41,'Pedasi'),
 (338,41,'Los Asientos'),
 (339,41,'Mariabe'),
 (340,41,'Purio'),
 (341,41,'Oria Arriba'),
 (342,42,'Pocri'),
 (343,42,'El Cañafistulo'),
 (344,42,'Lajamina'),
 (345,42,'Paraiso'),
 (346,42,'Paritilla'),
 (347,43,'Tonosi'),
 (348,43,'Altos de Güera'),
 (349,43,'Cañas'),
 (350,43,'El Bebedero'),
 (351,43,'El Cacao'),
 (352,43,'El Cortezo'),
 (353,43,'Flores'),
 (354,43,'Guanico'),
 (355,43,'La Tronosa'),
 (356,43,'Cambutal'),
 (357,43,'Isla de Cañas'),
 (358,44,'Arraijan'),
 (359,44,'Burunga'),
 (360,44,'Cerro Silvestre'),
 (361,44,'Juan Demostenes Arosemena'),
 (362,44,'Nuevo Emperador'),
 (363,44,'Santa Clara'),
 (364,44,'Veracruz'),
 (365,44,'Vista Alegre'),
 (366,45,'San Miguel'),
 (367,45,'La Ensenada'),
 (368,45,'La Esmeralda'),
 (369,45,'La Guinea'),
 (370,45,'Pedro González'),
 (371,45,'Saboga'),
 (372,46,'Capira'),
 (373,46,'Caimito'),
 (374,46,'Campana'),
 (375,46,'Cermeño'),
 (376,46,'Ciri de Los Sotos'),
 (377,46,'Ciri Grande'),
 (378,46,'El Cacao'),
 (379,46,'La Trinidad'),
 (380,46,'Las Ollas Arriba'),
 (381,46,'Lidice'),
 (382,46,'Villa Carmen'),
 (383,46,'Villa Rosario'),
 (384,46,'Santa Rosa'),
 (385,47,'Chame'),
 (386,47,'Bejuco'),
 (387,47,'Buenos Aires'),
 (388,47,'Cabuya'),
 (389,47,'Chica'),
 (390,47,'El Libano'),
 (391,47,'Las Lajas'),
 (392,47,'Nueva Gorgona'),
 (393,47,'Punta Chame'),
 (394,47,'Sajalices'),
 (395,47,'Sora'),
 (396,48,'Chepo'),
 (397,48,'Cañita'),
 (398,48,'Chepillo'),
 (399,48,'El Llano'),
 (400,48,'Las Margaritas de Chepo'),
 (401,48,'Santa Cruz de Chinina'),
 (402,48,'Madugandi'),
 (403,48,'Torti'),
 (404,49,'Chiman'),
 (405,49,'Brujas'),
 (406,49,'Gonzalo Vasquez'),
 (407,49,'Pasiga'),
 (408,49,'Unión Santeña'),
 (409,50,'Barrio Balboa'),
 (410,50,'Barrio Colon'),
 (411,50,'Amador'),
 (412,50,'Arosemena'),
 (413,50,'El Arado'),
 (414,50,'El Coco'),
 (415,50,'Feuillet'),
 (416,50,'Guadalupe'),
 (417,50,'Herrera'),
 (418,50,'Hurtado'),
 (419,50,'Iturralde'),
 (420,50,'La Represa'),
 (421,50,'Los Diaz'),
 (422,50,'Mendoza'),
 (423,50,'Obaldia'),
 (424,50,'Playa Leona'),
 (425,50,'Puerto Caimito'),
 (426,50,'Santa Rita'),
 (427,51,'24 de Diciembre'),
 (428,51,'Alcalde Díaz'),
 (429,51,'Ancon'),
 (430,51,'Betania'),
 (431,51,'Bella Vista'),
 (432,51,'Caimitillo'),
 (433,51,'Chilibre'),
 (434,51,'El Chorrillo'),
 (435,51,'La Exposicion o Calidonia'),
 (436,51,'Curundu'),
 (437,51,'Ernesto Cordoba Campos'),
 (438,51,'Juan Díaz'),
 (439,51,'Las Cumbres'),
 (440,51,'Las Mañanitas'),
 (441,51,'Pacora'),
 (442,51,'Parque Lefevre'),
 (443,51,'Pedregal'),
 (444,51,'Pueblo Nuevo'),
 (445,51,'Rio Abajo'),
 (446,51,'San Felipe'),
 (447,51,'San Francisco'),
 (448,51,'San Martin'),
 (449,51,'Santa Ana'),
 (450,51,'Tocumen'),
 (451,52,'San Carlos'),
 (452,52,'El Espino'),
 (453,52,'El Higo'),
 (454,52,'Guayabito'),
 (455,52,'La Ermita'),
 (456,52,'La Laguna'),
 (457,52,'Las Uvas'),
 (458,52,'Los Llanitos'),
 (459,52,'San Jose'),
 (460,53,'Amelia Denis de Icaza'),
 (461,53,'Belisario Porras'),
 (462,53,'Jose Domingo Espinar'),
 (463,53,'Mateo Iturralde'),
 (464,53,'Victoriano Lorenzo'),
 (465,53,'Arnulfo Arias'),
 (466,53,'Belisario Frias'),
 (467,53,'Omar Torrijos'),
 (468,53,'Rufina Alfaro'),
 (469,54,'Taboga'),
 (470,54,'Otoque Occidente'),
 (471,54,'Otoque Oriente'),
 (472,55,'Atalaya'),
 (473,55,'El Barrito'),
 (474,55,'La Montañuela'),
 (475,55,'San Antonio'),
 (476,55,'La Carrillo'),
 (477,56,'Calobre'),
 (478,56,'Barnizal'),
 (479,56,'Chitra'),
 (480,56,'El Cocla'),
 (481,56,'El Potrero'),
 (482,56,'La Laguna'),
 (483,56,'La Raya de Calobre'),
 (484,56,'La Tetilla'),
 (485,56,'La Yeguada'),
 (486,56,'Las Guias'),
 (487,56,'Monjaras'),
 (488,56,'San Jose'),
 (489,57,'Cañazas'),
 (490,57,'Cerro de Plata'),
 (491,57,'Los Valles'),
 (492,57,'San Marcelo'),
 (493,57,'El Picador'),
 (494,57,'San Jose'),
 (495,57,'El Aromillo'),
 (496,57,'Las Cruces'),
 (497,58,'La Mesa'),
 (498,58,'Bisvalles'),
 (499,58,'Boro'),
 (500,58,'Llano Grande'),
 (501,58,'San Bartolo'),
 (502,58,'Los Milagros'),
 (503,58,'El Higo'),
 (504,59,'Las Palmas'),
 (505,59,'Cerro de Casa'),
 (506,59,'Corozal'),
 (507,59,'El Maria'),
 (508,59,'El Prado'),
 (509,59,'El Rincon'),
 (510,59,'Lola'),
 (511,59,'Pixvae'),
 (512,59,'Puerto Vidal'),
 (513,59,'Zapotillo'),
 (514,59,'San Martin de Porres'),
 (515,59,'Vigui'),
 (516,59,'Manuel Amador Guerrero'),
 (517,60,'Mariato'),
 (518,60,'Arenas'),
 (519,60,'El Cacao'),
 (520,60,'Quebro'),
 (521,60,'Tebario'),
 (522,61,'Montijo'),
 (523,61,'Gobernadora'),
 (524,61,'La Garceana'),
 (525,61,'Leones'),
 (526,61,'Pilon'),
 (527,61,'Cebaco'),
 (528,61,'Costa Hermosa'),
 (529,61,'Unión del Norte'),
 (530,62,'Rio de Jesus'),
 (531,62,'Las Huacas'),
 (532,62,'Los Castillos'),
 (533,62,'Utira'),
 (534,62,'Catorce de Noviembre'),
 (535,63,'San Francisco'),
 (536,63,'Corral Falso'),
 (537,63,'Los Hatillos'),
 (538,63,'Remance'),
 (539,63,'San Juan'),
 (540,63,'San Jose'),
 (541,64,'Santa Fe'),
 (542,64,'Calovebora'),
 (543,64,'El Alto'),
 (544,64,'El Cuay'),
 (545,64,'El Pantano'),
 (546,64,'Gatuncito'),
 (547,64,'Rio Luis'),
 (548,64,'Ruben Cantu'),
 (549,65,'Santiago'),
 (550,65,'La Colorada'),
 (551,65,'La Peña'),
 (552,65,'La Raya de Santa Maria'),
 (553,65,'Ponuga'),
 (554,65,'San Pedro del Espino'),
 (555,65,'Canto del Llano'),
 (556,65,'Los Algarrobos'),
 (557,65,'Carlos Santana Avila'),
 (558,65,'Edwin Fabrega'),
 (559,65,'San Martin de Porres'),
 (560,65,'Urraca'),
 (561,65,'La Soledad'),
 (562,65,'Rincon Largo'),
 (563,65,'El Llanito'),
 (564,66,'Sona'),
 (565,66,'Bahia Honda'),
 (566,66,'Calidonia'),
 (567,66,'Cative'),
 (568,66,'El Marañon'),
 (569,66,'Guarumal'),
 (570,66,'La Soledad'),
 (571,66,'Quebrada de Oro'),
 (572,66,'Rio Grande'),
 (573,66,'Rodeo Viejo'),
 (574,66,'Hicaco');
/*!40000 ALTER TABLE `corregimientos` ENABLE KEYS */;


--
-- Definition of table `datos_del_profesional`
--

DROP TABLE IF EXISTS `datos_del_profesional`;
CREATE TABLE `datos_del_profesional` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_profesional_refiere` int(10) unsigned NOT NULL,
  `id_persona_receptor` int(10) unsigned default NULL,
  `tipo_profesional` tinyint(3) default '0',
  PRIMARY KEY  (`id`),
  KEY `FK_datos_del_profesional_refiere` USING BTREE (`id_profesional_refiere`),
  CONSTRAINT `FK_datos_del_profesional_refiere` FOREIGN KEY (`id_profesional_refiere`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `datos_del_profesional`
--

/*!40000 ALTER TABLE `datos_del_profesional` DISABLE KEYS */;
/*!40000 ALTER TABLE `datos_del_profesional` ENABLE KEYS */;


--
-- Definition of table `departamentos_por_institucion`
--

DROP TABLE IF EXISTS `departamentos_por_institucion`;
CREATE TABLE `departamentos_por_institucion` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_institucion` int(10) unsigned NOT NULL,
  `departamento` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departamentos_por_institucion`
--

/*!40000 ALTER TABLE `departamentos_por_institucion` DISABLE KEYS */;
/*!40000 ALTER TABLE `departamentos_por_institucion` ENABLE KEYS */;


--
-- Definition of table `detalle_visita_domiciliaria`
--

DROP TABLE IF EXISTS `detalle_visita_domiciliaria`;
CREATE TABLE `detalle_visita_domiciliaria` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_diario_de_visitas` int(10) unsigned NOT NULL,
  `zona` int(10) unsigned NOT NULL,
  `id_paciente` int(10) unsigned NOT NULL,
  `numero_expediente` varchar(45) NOT NULL,
  `id_programa` int(10) unsigned NOT NULL,
  `observaciones` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_detalle_visita_domiciliaria_diario` (`id_diario_de_visitas`),
  KEY `FK_detalle_visita_domiciliaria_paciente` (`id_paciente`),
  KEY `FK_detalle_visita_domiciliaria_programa` (`id_programa`),
  CONSTRAINT `FK_detalle_visita_domiciliaria_diario` FOREIGN KEY (`id_diario_de_visitas`) REFERENCES `diario_de_visitas_domiciliarias` (`id`),
  CONSTRAINT `FK_detalle_visita_domiciliaria_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`),
  CONSTRAINT `FK_detalle_visita_domiciliaria_programa` FOREIGN KEY (`id_programa`) REFERENCES `tipos_de_programas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detalle_visita_domiciliaria`
--

/*!40000 ALTER TABLE `detalle_visita_domiciliaria` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_visita_domiciliaria` ENABLE KEYS */;


--
-- Definition of table `diagnostico_egreso`
--

DROP TABLE IF EXISTS `diagnostico_egreso`;
CREATE TABLE `diagnostico_egreso` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `detalle` text NOT NULL,
  `nosocomial` tinyint(1) unsigned NOT NULL default '0',
  `tipo` tinyint(1) unsigned NOT NULL default '0',
  `id_hospitalizacion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_diagnostico_egreso_hospitalizacion` (`id_hospitalizacion`),
  CONSTRAINT `FK_diagnostico_egreso_hospitalizacion` FOREIGN KEY (`id_hospitalizacion`) REFERENCES `hospitalizacion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnostico_egreso`
--

/*!40000 ALTER TABLE `diagnostico_egreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `diagnostico_egreso` ENABLE KEYS */;


--
-- Definition of table `diario_de_visitas_domiciliarias`
--

DROP TABLE IF EXISTS `diario_de_visitas_domiciliarias`;
CREATE TABLE `diario_de_visitas_domiciliarias` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_institucion` int(10) unsigned NOT NULL,
  `id_atenciones` int(10) unsigned NOT NULL,
  `id_funcionario` int(10) unsigned NOT NULL,
  `horas_utilizadas` int(10) unsigned NOT NULL,
  `id_distrito` int(10) unsigned NOT NULL,
  `id_corregimiento` int(10) unsigned NOT NULL,
  `casas_programadas` int(10) unsigned NOT NULL,
  `casas_visitadas` int(10) unsigned NOT NULL,
  `poblacion_beneficiada_programada` int(10) unsigned NOT NULL,
  `poblacion_beneficiada_visitada` int(10) unsigned NOT NULL,
  `casas_no_programadas_visitadas` int(10) unsigned NOT NULL,
  `poblacion_beneficiada_no_programada_visitada` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diario_de_visitas_domiciliarias`
--

/*!40000 ALTER TABLE `diario_de_visitas_domiciliarias` DISABLE KEYS */;
/*!40000 ALTER TABLE `diario_de_visitas_domiciliarias` ENABLE KEYS */;


--
-- Definition of table `distritos`
--

DROP TABLE IF EXISTS `distritos`;
CREATE TABLE `distritos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_provincia` int(10) unsigned NOT NULL,
  `descripcion` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_distritos_provincia` USING BTREE (`id_provincia`),
  CONSTRAINT `FK_distritos_provincia` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `distritos`
--

/*!40000 ALTER TABLE `distritos` DISABLE KEYS */;
INSERT INTO `distritos` (`id`,`id_provincia`,`descripcion`) VALUES 
 (1,1,'Bocas del Toro'),
 (2,1,'Changuinola'),
 (3,1,'Chiriqui Grande'),
 (4,2,'Alanje'),
 (5,2,'Baru'),
 (6,2,'Boqueron'),
 (7,2,'Boquete'),
 (8,2,'Bugaba'),
 (9,2,'San Jose de David'),
 (10,2,'Dolega'),
 (11,2,'Gualaca'),
 (12,2,'Remedios'),
 (13,2,'Renacimiento'),
 (14,2,'San Felix'),
 (15,2,'San Lorenzo'),
 (16,2,'Tole'),
 (17,3,'Aguadulce'),
 (18,3,'Anton'),
 (19,3,'La Pintada'),
 (20,3,'Nata'),
 (21,3,'Ola'),
 (22,3,'Penonome'),
 (23,4,'Colon'),
 (24,4,'Chagres'),
 (25,4,'Donoso'),
 (26,4,'Portobelo'),
 (27,4,'Santa Isabel'),
 (28,5,'Chepigana'),
 (29,5,'Pinogana'),
 (30,6,'Chitre'),
 (31,6,'Las Minas'),
 (32,6,'Los Pozos'),
 (33,6,'Ocu'),
 (34,6,'Parita'),
 (35,6,'Pese'),
 (36,6,'Santa Maria'),
 (37,7,'Guarare'),
 (38,7,'Las Tablas'),
 (39,7,'Los Santos'),
 (40,7,'Macaracas'),
 (41,7,'Pedasi'),
 (42,7,'Pocri'),
 (43,7,'Tonosi'),
 (44,8,'Arraijan'),
 (45,8,'Balboa'),
 (46,8,'Capira'),
 (47,8,'Chame'),
 (48,8,'Chepo'),
 (49,8,'Chiman'),
 (50,8,'La Chorrera'),
 (51,8,'Panama'),
 (52,8,'San Carlos'),
 (53,8,'San Miguelito'),
 (54,8,'Taboga'),
 (55,9,'Atalaya'),
 (56,9,'Calobre'),
 (57,9,'Cañazas'),
 (58,9,'La Mesa'),
 (59,9,'Las Palmas'),
 (60,9,'Mariato'),
 (61,9,'Montijo'),
 (62,9,'Rio de Jesus'),
 (63,9,'San Francisco'),
 (64,9,'Santa Fe'),
 (65,9,'Santiago'),
 (66,9,'Sona');
/*!40000 ALTER TABLE `distritos` ENABLE KEYS */;


--
-- Definition of table `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE `especialidades` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `especialidades`
--

/*!40000 ALTER TABLE `especialidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `especialidades` ENABLE KEYS */;


--
-- Definition of table `especialidades_por_personal_medico`
--

DROP TABLE IF EXISTS `especialidades_por_personal_medico`;
CREATE TABLE `especialidades_por_personal_medico` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_personal_medico` int(10) unsigned NOT NULL,
  `id_especialidad` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `medico_especialidad` USING BTREE (`id_personal_medico`,`id_especialidad`),
  KEY `FK_especialidades_por_medicos_especialidades` USING BTREE (`id_especialidad`),
  CONSTRAINT `FK_especialidades_por_personal_medico` FOREIGN KEY (`id_personal_medico`) REFERENCES `personal_medico` (`id`),
  CONSTRAINT `FK_especialidades_por_personal_medico_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `especialidades_por_personal_medico`
--

/*!40000 ALTER TABLE `especialidades_por_personal_medico` DISABLE KEYS */;
/*!40000 ALTER TABLE `especialidades_por_personal_medico` ENABLE KEYS */;


--
-- Definition of table `estadocivil`
--

DROP TABLE IF EXISTS `estadocivil`;
CREATE TABLE `estadocivil` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estadocivil`
--

/*!40000 ALTER TABLE `estadocivil` DISABLE KEYS */;
/*!40000 ALTER TABLE `estadocivil` ENABLE KEYS */;


--
-- Definition of table `etnia`
--

DROP TABLE IF EXISTS `etnia`;
CREATE TABLE `etnia` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etnia`
--

/*!40000 ALTER TABLE `etnia` DISABLE KEYS */;
INSERT INTO `etnia` (`id`,`descripcion`) VALUES 
 (1,'No Indigena'),
 (2,'Kuna'),
 (3,'Embera'),
 (4,'Wounaan'),
 (5,'Ngöbe'),
 (6,'Bugle'),
 (7,'Naso'),
 (8,'Teribes'),
 (9,'Bri Bri');
/*!40000 ALTER TABLE `etnia` ENABLE KEYS */;


--
-- Definition of table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE `funcionarios` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_persona` int(10) unsigned NOT NULL,
  `id_departamento` int(10) unsigned NOT NULL,
  `id_cargo` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_funcionarios_persona` (`id_persona`),
  KEY `FK_funcionarios_departamento` (`id_departamento`),
  KEY `FK_funcionarios_cargo` (`id_cargo`),
  CONSTRAINT `FK_funcionarios_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`),
  CONSTRAINT `FK_funcionarios_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos_por_institucion` (`id`),
  CONSTRAINT `FK_funcionarios_persona` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funcionarios`
--

/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;


--
-- Definition of table `historial`
--

DROP TABLE IF EXISTS `historial`;
CREATE TABLE `historial` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_paciente` int(10) unsigned NOT NULL,
  `dia` int(10) unsigned NOT NULL,
  `mes` int(10) unsigned NOT NULL,
  `agno` int(10) unsigned NOT NULL,
  `hora` varchar(10) NOT NULL,
  `presion_arterial` varchar(10) NOT NULL,
  `fc` int(10) unsigned NOT NULL,
  `fr` int(10) unsigned NOT NULL,
  `fcf` int(10) unsigned NOT NULL,
  `temperatura` int(10) unsigned NOT NULL,
  `peso` double NOT NULL,
  `talla` double NOT NULL,
  `anamnesis` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_historial_pacientes` (`id_paciente`),
  CONSTRAINT `FK_historial_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `historial`
--

/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;


--
-- Definition of table `historial_medicamento`
--

DROP TABLE IF EXISTS `historial_medicamento`;
CREATE TABLE `historial_medicamento` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_medicamento` int(10) unsigned NOT NULL,
  `dia` int(10) unsigned NOT NULL,
  `mes` int(10) unsigned NOT NULL,
  `agno` int(10) unsigned NOT NULL,
  `cantidad_sobrante` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `Index_3` (`id_medicamento`,`dia`,`mes`,`agno`),
  CONSTRAINT `FK_historial_medicamento` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `historial_medicamento`
--

/*!40000 ALTER TABLE `historial_medicamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_medicamento` ENABLE KEYS */;


--
-- Definition of table `horas`
--

DROP TABLE IF EXISTS `horas`;
CREATE TABLE `horas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `hora` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `horas`
--

/*!40000 ALTER TABLE `horas` DISABLE KEYS */;
/*!40000 ALTER TABLE `horas` ENABLE KEYS */;


--
-- Definition of table `hospitalizacion`
--

DROP TABLE IF EXISTS `hospitalizacion`;
CREATE TABLE `hospitalizacion` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `diagnostico_de_admision` text NOT NULL,
  `id_admision_egreso` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_hospitalizacion_admision_egreso` (`id_admision_egreso`),
  CONSTRAINT `FK_hospitalizacion_admision_egreso` FOREIGN KEY (`id_admision_egreso`) REFERENCES `admision_egreso` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospitalizacion`
--

/*!40000 ALTER TABLE `hospitalizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `hospitalizacion` ENABLE KEYS */;


--
-- Definition of table `instituciones`
--

DROP TABLE IF EXISTS `instituciones`;
CREATE TABLE `instituciones` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(25) NOT NULL,
  `id_corregimiento` int(10) unsigned NOT NULL,
  `codigo` varchar(45) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `Index_codigo` (`codigo`),
  KEY `FK_instituciones_corregimiento` USING BTREE (`id_corregimiento`),
  CONSTRAINT `FK_instituciones_corregimiento` FOREIGN KEY (`id_corregimiento`) REFERENCES `corregimientos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instituciones`
--

/*!40000 ALTER TABLE `instituciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `instituciones` ENABLE KEYS */;


--
-- Definition of table `integrantes_del_equipo_basico`
--

DROP TABLE IF EXISTS `integrantes_del_equipo_basico`;
CREATE TABLE `integrantes_del_equipo_basico` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_diario_de_visitas` int(10) unsigned NOT NULL,
  `id_personal_medico` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_integrantes_del_equipo_basico_diario_de_visitas` (`id_diario_de_visitas`),
  KEY `FK_integrantes_del_equipo_basico_personal_medico` (`id_personal_medico`),
  CONSTRAINT `FK_integrantes_del_equipo_basico_diario_de_visitas` FOREIGN KEY (`id_diario_de_visitas`) REFERENCES `diario_de_visitas_domiciliarias` (`id`),
  CONSTRAINT `FK_integrantes_del_equipo_basico_personal_medico` FOREIGN KEY (`id_personal_medico`) REFERENCES `personal_medico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `integrantes_del_equipo_basico`
--

/*!40000 ALTER TABLE `integrantes_del_equipo_basico` DISABLE KEYS */;
/*!40000 ALTER TABLE `integrantes_del_equipo_basico` ENABLE KEYS */;


--
-- Definition of table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE `medicamentos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` text NOT NULL,
  `id_tipo_medicamento` int(10) unsigned NOT NULL,
  `codigo` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_medicamentos_tipo` (`id_tipo_medicamento`),
  CONSTRAINT `FK_medicamentos_tipo` FOREIGN KEY (`id_tipo_medicamento`) REFERENCES `tipos_de_medicamentos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicamentos`
--

/*!40000 ALTER TABLE `medicamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicamentos` ENABLE KEYS */;


--
-- Definition of table `medicamentos_por_paciente`
--

DROP TABLE IF EXISTS `medicamentos_por_paciente`;
CREATE TABLE `medicamentos_por_paciente` (
  `id` int(10) unsigned NOT NULL,
  `id_paciente` int(10) unsigned NOT NULL,
  `dia` int(10) unsigned NOT NULL,
  `mes` int(10) unsigned NOT NULL,
  `agno` int(10) unsigned NOT NULL,
  `id_medicamento` int(10) unsigned NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_medicamentos_por_paciente` (`id_paciente`),
  KEY `FK_medicamentos_por_paciente_medicamentos` (`id_medicamento`),
  CONSTRAINT `FK_medicamentos_por_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`),
  CONSTRAINT `FK_medicamentos_por_paciente_medicamentos` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `medicamentos_por_paciente`
--

/*!40000 ALTER TABLE `medicamentos_por_paciente` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicamentos_por_paciente` ENABLE KEYS */;


--
-- Definition of table `movimientos_del_paciente`
--

DROP TABLE IF EXISTS `movimientos_del_paciente`;
CREATE TABLE `movimientos_del_paciente` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_servicio` int(10) unsigned NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `hora_admision` varchar(45) NOT NULL,
  `dia_admision` int(10) unsigned NOT NULL,
  `mes_admision` int(10) unsigned NOT NULL,
  `agno_admision` int(10) unsigned NOT NULL,
  `hora_egreso` varchar(45) NOT NULL,
  `dia_egreso` int(10) unsigned NOT NULL,
  `mes_egreso` int(10) unsigned NOT NULL,
  `agno_egreso` int(10) unsigned NOT NULL,
  `id_hospitalizacion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_movimientos_del_paciente_servicio` (`id_servicio`),
  KEY `FK_movimientos_del_paciente_hospitalizacion` USING BTREE (`id_hospitalizacion`),
  CONSTRAINT `FK_movimientos_del_paciente_hospitalizacion` FOREIGN KEY (`id_hospitalizacion`) REFERENCES `hospitalizacion` (`id`),
  CONSTRAINT `FK_movimientos_del_paciente_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicios_medicos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; (`id_servicio`) REFER `paliativos/serv';

--
-- Dumping data for table `movimientos_del_paciente`
--

/*!40000 ALTER TABLE `movimientos_del_paciente` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimientos_del_paciente` ENABLE KEYS */;


--
-- Definition of table `nacionalidades`
--

DROP TABLE IF EXISTS `nacionalidades`;
CREATE TABLE `nacionalidades` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nacionalidad` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nacionalidades`
--

/*!40000 ALTER TABLE `nacionalidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `nacionalidades` ENABLE KEYS */;


--
-- Definition of table `opciones_del_menu`
--

DROP TABLE IF EXISTS `opciones_del_menu`;
CREATE TABLE `opciones_del_menu` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `opciones_del_menu`
--

/*!40000 ALTER TABLE `opciones_del_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `opciones_del_menu` ENABLE KEYS */;


--
-- Definition of table `opciones_por_rol`
--

DROP TABLE IF EXISTS `opciones_por_rol`;
CREATE TABLE `opciones_por_rol` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_rol` int(10) unsigned NOT NULL,
  `id_opciones` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `Index_opciones_roles` USING BTREE (`id_opciones`,`id_rol`),
  KEY `FK_opciones_por_rol` USING BTREE (`id_rol`),
  CONSTRAINT `FK_opciones_por_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`),
  CONSTRAINT `FK_opciones_por_rol_opciones` FOREIGN KEY (`id_opciones`) REFERENCES `opciones_del_menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `opciones_por_rol`
--

/*!40000 ALTER TABLE `opciones_por_rol` DISABLE KEYS */;
/*!40000 ALTER TABLE `opciones_por_rol` ENABLE KEYS */;


--
-- Definition of table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE `pacientes` (
  `id` int(10) unsigned NOT NULL,
  `id_persona` int(10) unsigned NOT NULL,
  `nombre_informante` varchar(75) NOT NULL,
  `id_parentesco_informante` int(10) unsigned default NULL,
  `nombre_emergencia` varchar(45) NOT NULL,
  `apellido_emergencia` varchar(45) NOT NULL,
  `telefono_emergencia` varchar(15) NOT NULL,
  `id_parentesco_urgencia` int(10) unsigned default NULL,
  `direccion_emergencia` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_pacientes_personas` USING BTREE (`id_persona`),
  CONSTRAINT `FK_pacientes_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pacientes`
--

/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;


--
-- Definition of table `parentesco`
--

DROP TABLE IF EXISTS `parentesco`;
CREATE TABLE `parentesco` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parentesco`
--

/*!40000 ALTER TABLE `parentesco` DISABLE KEYS */;
/*!40000 ALTER TABLE `parentesco` ENABLE KEYS */;


--
-- Definition of table `personal_medico`
--

DROP TABLE IF EXISTS `personal_medico`;
CREATE TABLE `personal_medico` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_persona` int(10) unsigned NOT NULL,
  `idoneidad` varchar(15) NOT NULL,
  `celular` varchar(9) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `id_hora_entrada` int(10) unsigned NOT NULL,
  `id_hora_salida` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_medicos_personas` USING BTREE (`id_persona`),
  KEY `FK_medicos_hora_entrada` (`id_hora_entrada`),
  KEY `FK_medicos_hora_salida` (`id_hora_salida`),
  CONSTRAINT `FK_medicos_hora_entrada` FOREIGN KEY (`id_hora_entrada`) REFERENCES `horas` (`id`),
  CONSTRAINT `FK_medicos_hora_salida` FOREIGN KEY (`id_hora_salida`) REFERENCES `horas` (`id`),
  CONSTRAINT `FK_medicos_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personal_medico`
--

/*!40000 ALTER TABLE `personal_medico` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_medico` ENABLE KEYS */;


--
-- Definition of table `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `primer_nombre` varchar(20) NOT NULL,
  `segundo_nombre` varchar(20) default NULL,
  `primera_pellido` varchar(20) NOT NULL,
  `segundo_apellido` varchar(20) character set utf8 collate utf8_bin default NULL,
  `cedula` varchar(20) NOT NULL,
  `id_tipo_de_sangre` int(10) unsigned NOT NULL,
  `fecha_de_nacimiento` varchar(25) NOT NULL,
  `direccion_detallada` text NOT NULL,
  `id_estado_civil` int(10) unsigned NOT NULL,
  `femenino` tinyint(1) unsigned NOT NULL default '1',
  `telefono` varchar(10) NOT NULL,
  `id_provincia_nacimiento` int(10) unsigned NOT NULL,
  `id_distrito_nacimiento` int(10) unsigned NOT NULL,
  `id_corregimiento_nacimiento` int(10) unsigned NOT NULL,
  `asegurado` varchar(15) NOT NULL default '0',
  `numero_de_seguro` varchar(25) default NULL,
  `id_nacionalidad` int(10) unsigned NOT NULL,
  `nombre_madre` varchar(75) default NULL,
  `nombre_padre` varchar(75) default NULL,
  `ocupacion` varchar(45) NOT NULL,
  `id_provincia_residencia` int(10) unsigned NOT NULL,
  `id_distrito_residencia` int(10) unsigned NOT NULL,
  `id_corregimiento_residencia` int(10) unsigned NOT NULL,
  `id_etnia` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `FK_personas_provincia_residencia` (`id_provincia_residencia`),
  KEY `FK_personas_distrito_residencia` (`id_distrito_residencia`),
  KEY `FK_personas_corregimiento_residencia` (`id_corregimiento_residencia`),
  KEY `FK_personas_tiposangre` USING BTREE (`id_tipo_de_sangre`),
  KEY `FK_personas_estadocivil` USING BTREE (`id_estado_civil`),
  KEY `FK_personas_nacionalidades` USING BTREE (`id_nacionalidad`),
  KEY `FK_personas_etnia` (`id_etnia`),
  KEY `FK_personas_provincias` USING BTREE (`id_provincia_nacimiento`),
  KEY `FK_personas_distrito` USING BTREE (`id_distrito_nacimiento`),
  KEY `FK_personas_corregimiento` USING BTREE (`id_corregimiento_nacimiento`),
  CONSTRAINT `FK_personas_corregimiento_nacimiento` FOREIGN KEY (`id_corregimiento_nacimiento`) REFERENCES `corregimientos` (`id`),
  CONSTRAINT `FK_personas_corregimiento_residencia` FOREIGN KEY (`id_corregimiento_residencia`) REFERENCES `corregimientos` (`id`),
  CONSTRAINT `FK_personas_distrito_nacimiento` FOREIGN KEY (`id_distrito_nacimiento`) REFERENCES `distritos` (`id`),
  CONSTRAINT `FK_personas_distrito_residencia` FOREIGN KEY (`id_distrito_residencia`) REFERENCES `distritos` (`id`),
  CONSTRAINT `FK_personas_estadocivil` FOREIGN KEY (`id_estado_civil`) REFERENCES `estadocivil` (`id`),
  CONSTRAINT `FK_personas_etnia` FOREIGN KEY (`id_etnia`) REFERENCES `etnia` (`id`),
  CONSTRAINT `FK_personas_nacionalidades` FOREIGN KEY (`id_nacionalidad`) REFERENCES `nacionalidades` (`id`),
  CONSTRAINT `FK_personas_provincias_nacimiento` FOREIGN KEY (`id_provincia_nacimiento`) REFERENCES `provincias` (`id`),
  CONSTRAINT `FK_personas_provincia_residencia` FOREIGN KEY (`id_provincia_residencia`) REFERENCES `provincias` (`id`),
  CONSTRAINT `FK_personas_tiposangre` FOREIGN KEY (`id_tipo_de_sangre`) REFERENCES `tipos_de_sangre` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personas`
--

/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;


--
-- Definition of table `procedimientos_rae`
--

DROP TABLE IF EXISTS `procedimientos_rae`;
CREATE TABLE `procedimientos_rae` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_hospitalizacion` int(10) unsigned NOT NULL,
  `tipo_procedimiento` tinyint(3) unsigned NOT NULL default '0',
  `nombre_del_procedimiento` varchar(45) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_prcedimientos_rae_hospitalizacion` USING BTREE (`id_hospitalizacion`),
  CONSTRAINT `FK_prcedimientos_rae_hospitalizacion` FOREIGN KEY (`id_hospitalizacion`) REFERENCES `hospitalizacion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `procedimientos_rae`
--

/*!40000 ALTER TABLE `procedimientos_rae` DISABLE KEYS */;
/*!40000 ALTER TABLE `procedimientos_rae` ENABLE KEYS */;


--
-- Definition of table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
CREATE TABLE `provincias` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provincias`
--

/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` (`id`,`descripcion`) VALUES 
 (1,'Bocas del Toro'),
 (2,'Chiriqui'),
 (3,'Cocle'),
 (4,'Colon'),
 (5,'Darien'),
 (6,'Herrera'),
 (7,'Los Santos'),
 (8,'Panama'),
 (9,'Veraguas');
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;


--
-- Definition of table `referencias`
--

DROP TABLE IF EXISTS `referencias`;
CREATE TABLE `referencias` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_instalacion_referida` int(10) unsigned NOT NULL,
  `id_instalacion_receptora` int(10) unsigned NOT NULL,
  `motivo_referencia` text,
  `id_servicio_medico` int(10) unsigned NOT NULL,
  `id_atencion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_referencias_instalacion_referida` USING BTREE (`id_instalacion_referida`),
  KEY `FK_referencias_instalacion_receptora` USING BTREE (`id_instalacion_receptora`),
  KEY `FK_referencias_servicio_medico` (`id_servicio_medico`),
  KEY `FK_referencias_atencion` (`id_atencion`),
  CONSTRAINT `FK_referencias_atencion` FOREIGN KEY (`id_atencion`) REFERENCES `atenciones` (`id`),
  CONSTRAINT `FK_referencias_instalacion_receptora` FOREIGN KEY (`id_instalacion_receptora`) REFERENCES `instituciones` (`id`),
  CONSTRAINT `FK_referencias_instalacion_referida` FOREIGN KEY (`id_instalacion_referida`) REFERENCES `instituciones` (`id`),
  CONSTRAINT `FK_referencias_servicio_medico` FOREIGN KEY (`id_servicio_medico`) REFERENCES `servicios_medicos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `referencias`
--

/*!40000 ALTER TABLE `referencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `referencias` ENABLE KEYS */;


--
-- Definition of table `registro_diario_de_actividades`
--

DROP TABLE IF EXISTS `registro_diario_de_actividades`;
CREATE TABLE `registro_diario_de_actividades` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_atencion` int(10) unsigned NOT NULL,
  `frecuentacion` tinyint(1) unsigned NOT NULL default '0',
  `estado_del_paciente` tinyint(1) unsigned NOT NULL default '0',
  `referido_a` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  CONSTRAINT `FK_registro_diario_de_actividades_atencion` FOREIGN KEY (`id`) REFERENCES `atenciones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registro_diario_de_actividades`
--

/*!40000 ALTER TABLE `registro_diario_de_actividades` DISABLE KEYS */;
/*!40000 ALTER TABLE `registro_diario_de_actividades` ENABLE KEYS */;


--
-- Definition of table `respuesta_referencia`
--

DROP TABLE IF EXISTS `respuesta_referencia`;
CREATE TABLE `respuesta_referencia` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_referencia` int(10) unsigned NOT NULL,
  `id_instalacion_receptora` int(10) unsigned NOT NULL,
  `id_instalacion_responde` int(10) unsigned NOT NULL,
  `tipo_respuesta` varchar(1) NOT NULL default 'h',
  `observaciones_hallazgos` text,
  `diganostico` varchar(45) default NULL,
  `id_cie_10` int(10) unsigned default NULL,
  `manejo_tratamiento` text,
  `reevaluacion` tinyint(1) unsigned default '0',
  `dia` int(10) unsigned default NULL,
  `mes` int(10) unsigned default NULL,
  `agno` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_respuesta_referencia_referencia` (`id_referencia`),
  CONSTRAINT `FK_respuesta_referencia_referencia` FOREIGN KEY (`id`) REFERENCES `referencias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `respuesta_referencia`
--

/*!40000 ALTER TABLE `respuesta_referencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `respuesta_referencia` ENABLE KEYS */;


--
-- Definition of table `resultados_examenes_diagnostico`
--

DROP TABLE IF EXISTS `resultados_examenes_diagnostico`;
CREATE TABLE `resultados_examenes_diagnostico` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_historial` int(10) unsigned NOT NULL,
  `dia` int(10) unsigned NOT NULL,
  `mes` int(10) unsigned NOT NULL,
  `agno` int(10) unsigned NOT NULL,
  `id_tipo_examen` int(10) unsigned NOT NULL,
  `diagnostico` text NOT NULL,
  `id_cie_10` int(10) unsigned NOT NULL,
  `tratamiento_complicaciones` text NOT NULL,
  `observaciones` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_resultados_examenes_diagnostico_historial` (`id_historial`),
  KEY `FK_resultados_examenes_diagnostico_cie_10` (`id_cie_10`),
  KEY `FK_resultados_examenes_diagnostico_tipo_examen` (`id_tipo_examen`),
  CONSTRAINT `FK_resultados_examenes_diagnostico_cie_10` FOREIGN KEY (`id_cie_10`) REFERENCES `cie_10` (`id`),
  CONSTRAINT `FK_resultados_examenes_diagnostico_historial` FOREIGN KEY (`id_historial`) REFERENCES `historial` (`id`),
  CONSTRAINT `FK_resultados_examenes_diagnostico_tipo_examen` FOREIGN KEY (`id_tipo_examen`) REFERENCES `tipos_de_examen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resultados_examenes_diagnostico`
--

/*!40000 ALTER TABLE `resultados_examenes_diagnostico` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultados_examenes_diagnostico` ENABLE KEYS */;


--
-- Definition of table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(45) NOT NULL,
  `id_tipo_personal` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_roles_tipo_personal` (`id_tipo_personal`),
  CONSTRAINT `FK_roles_tipo_personal` FOREIGN KEY (`id_tipo_personal`) REFERENCES `tipos_de_personal` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


--
-- Definition of table `seguros_privados`
--

DROP TABLE IF EXISTS `seguros_privados`;
CREATE TABLE `seguros_privados` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_persona` int(10) unsigned NOT NULL,
  `id_aseguradora` int(10) unsigned NOT NULL,
  `numeroseguro` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_seguro_privado_personas` USING BTREE (`id_persona`),
  KEY `FK_seguro_privado_aseguradoras` USING BTREE (`id_aseguradora`),
  CONSTRAINT `FK_seguro_privado_aseguradoras` FOREIGN KEY (`id_aseguradora`) REFERENCES `aseguradoras` (`id`),
  CONSTRAINT `FK_seguro_privado_personas` FOREIGN KEY (`id_aseguradora`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seguros_privados`
--

/*!40000 ALTER TABLE `seguros_privados` DISABLE KEYS */;
/*!40000 ALTER TABLE `seguros_privados` ENABLE KEYS */;


--
-- Definition of table `servicios_medicos`
--

DROP TABLE IF EXISTS `servicios_medicos`;
CREATE TABLE `servicios_medicos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `servicios_medicos`
--

/*!40000 ALTER TABLE `servicios_medicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicios_medicos` ENABLE KEYS */;


--
-- Definition of table `tipos_de_atencion`
--

DROP TABLE IF EXISTS `tipos_de_atencion`;
CREATE TABLE `tipos_de_atencion` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipos_de_atencion`
--

/*!40000 ALTER TABLE `tipos_de_atencion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_de_atencion` ENABLE KEYS */;


--
-- Definition of table `tipos_de_examen`
--

DROP TABLE IF EXISTS `tipos_de_examen`;
CREATE TABLE `tipos_de_examen` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipos_de_examen`
--

/*!40000 ALTER TABLE `tipos_de_examen` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_de_examen` ENABLE KEYS */;


--
-- Definition of table `tipos_de_medicamentos`
--

DROP TABLE IF EXISTS `tipos_de_medicamentos`;
CREATE TABLE `tipos_de_medicamentos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipos_de_medicamentos`
--

/*!40000 ALTER TABLE `tipos_de_medicamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_de_medicamentos` ENABLE KEYS */;


--
-- Definition of table `tipos_de_personal`
--

DROP TABLE IF EXISTS `tipos_de_personal`;
CREATE TABLE `tipos_de_personal` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `descirpcion` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipos_de_personal`
--

/*!40000 ALTER TABLE `tipos_de_personal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_de_personal` ENABLE KEYS */;


--
-- Definition of table `tipos_de_programas`
--

DROP TABLE IF EXISTS `tipos_de_programas`;
CREATE TABLE `tipos_de_programas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tipo` tinyint(3) unsigned NOT NULL default '0',
  `detalle` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipos_de_programas`
--

/*!40000 ALTER TABLE `tipos_de_programas` DISABLE KEYS */;
INSERT INTO `tipos_de_programas` (`id`,`tipo`,`detalle`) VALUES 
 (1,1,'0 - 29 Dias'),
 (2,1,'1 - 11 Meses'),
 (3,1,'1 - 4 Años'),
 (4,1,'5 - 14 Años'),
 (5,1,'15 - 19 Años'),
 (6,1,'Caso Epidem.'),
 (7,1,'Paciente C.A'),
 (8,2,'Prenatal'),
 (9,2,'Puerperio'),
 (10,2,'Plan. Fam.'),
 (11,2,'Ginecologia'),
 (12,2,'Paciente C.A'),
 (13,2,'Caso Epidem.'),
 (14,3,'20 - 59 Años'),
 (15,3,'60 y +'),
 (16,3,'Paciente C.A'),
 (17,3,'Caso Epidem.');
/*!40000 ALTER TABLE `tipos_de_programas` ENABLE KEYS */;


--
-- Definition of table `tipos_de_sangre`
--

DROP TABLE IF EXISTS `tipos_de_sangre`;
CREATE TABLE `tipos_de_sangre` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tipo_sangre` varchar(3) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipos_de_sangre`
--

/*!40000 ALTER TABLE `tipos_de_sangre` DISABLE KEYS */;
INSERT INTO `tipos_de_sangre` (`id`,`tipo_sangre`) VALUES 
 (1,'A+'),
 (2,'A-'),
 (3,'AB+'),
 (4,'AB-'),
 (5,'B+'),
 (6,'B-'),
 (7,'O+'),
 (8,'O-');
/*!40000 ALTER TABLE `tipos_de_sangre` ENABLE KEYS */;


--
-- Definition of table `transaccion_por_medicamento`
--

DROP TABLE IF EXISTS `transaccion_por_medicamento`;
CREATE TABLE `transaccion_por_medicamento` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_medicamento` int(10) unsigned NOT NULL,
  `numero_recetas` int(10) unsigned NOT NULL,
  `cantidad_despachada` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_transaccion_por_medicamento` (`id_medicamento`),
  CONSTRAINT `FK_transaccion_por_medicamento` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaccion_por_medicamento`
--

/*!40000 ALTER TABLE `transaccion_por_medicamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaccion_por_medicamento` ENABLE KEYS */;


--
-- Definition of table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_persona` int(10) unsigned NOT NULL,
  `id_rol` int(10) unsigned NOT NULL,
  `codigo` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_usuarios_personas` USING BTREE (`id_persona`),
  KEY `FK_usuarios_rol` USING BTREE (`id_rol`),
  CONSTRAINT `FK_usuarios_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`),
  CONSTRAINT `FK_usuarios_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
