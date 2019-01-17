-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2019 a las 23:15:29
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemaoa`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `aportesColab` (IN `idCol` INT)  BEGIN
IF (SELECT 1 = 1 FROM colaborador WHERE idColaborador=idCol) THEN
BEGIN
DECLARE tipo VARCHAR(50);
DECLARE userID INT;
SELECT userType INTO tipo FROM colaborador where idColaborador = idCol;
SELECT idPersona INTO userID FROM colaborador where idColaborador = idCol;
    SELECT * FROM objetoaprendizaje WHERE idAutor=userID and userType = tipo;
END;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrarAdjF` (IN `idF` INT)  BEGIN
UPDATE foro SET nombreadjunto = NULL WHERE idForo = idF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrarAdjFR` (IN `idR` INT)  BEGIN
UPDATE resforo SET nombreadjunto = NULL WHERE idRespuesta = idR;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrarColaborador` (IN `idC` INT)  BEGIN
DELETE FROM colaborador WHERE idColaborador=idC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrarForo` (IN `idForoR` INT)  BEGIN
DELETE FROM foro WHERE idForo=idForoR;
DELETE FROM resforo WHERE idForo=idForoR;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrarLoginChat` (IN `idProfesor` INT(11))  BEGIN
DECLARE usern VARCHAR(15);
SET usern:=' ';
SELECT P.usuarioProf INTO usern FROM profesor p
                   WHERE p.idProfesor = idProfesor;
DELETE FROM login WHERE username = usern;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrarLoginChat2` (IN `idEstudiante` INT(11))  BEGIN
DECLARE usern VARCHAR(15);
SET usern:=' ';
SELECT P.usuarioEst INTO usern FROM estudiante p
                   WHERE p.idEstudiante = idEstudiante;
DELETE FROM login WHERE username = usern;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrarPerfilF` (IN `idColab` INT)  BEGIN
UPDATE colaborador SET adjFoto = NULL WHERE idColaborador = idColab;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrarResp` (IN `idR` INT)  BEGIN
DELETE FROM resforo WHERE idRespuesta=idR;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarColaborador` (IN `idCol` INT)  BEGIN
DECLARE tipo VARCHAR(50);
DECLARE userID INT;
SELECT userType INTO tipo FROM colaborador where idColaborador = idCol;
SELECT idPersona INTO userID FROM colaborador where idColaborador = idCol;
IF tipo = 'est' then
SELECT cedulaEst as cedula,nombresEst as nombres, apellidosEst as apellidos, correoEst as correo,c.* FROM estudiante e join colaborador c on c.idPersona=e.idEstudiante where idEstudiante = userID;
ELSE
SELECT cedulaProf as cedula,nombresProf as nombres, apellidosProf as apellidos, correoProf as correo,c.* FROM profesor p join colaborador c on p.idProfesor=c.idPersona where idProfesor = userID;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cargarComentarios` (IN `tmpIdOA` INT(11))  BEGIN
SELECT idComentario,detalleComent, userNameAutor, fechaComentario, pathImagen, pathVideo
                    FROM comentario c
                   WHERE idOA = tmpIdOA;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cargarObj` ()  begin
	select * from objetoaprendizaje;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cargarObjetosDescarga` ()  BEGIN
	select * from objetoaprendizaje;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cargarPuntuacion` ()  begin
select o.nombre, AVG(p.calificacionObjeto) as promedio,COUNT(*)as numCalificaciones from puntuacion p, objetoaprendizaje o where o.idOA=p.idObjetosAprendizaje GROUP BY p.idObjetosAprendizaje; 
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cMat` ()  BEGIN
select * from materias;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarCarrera` ()  BEGIN
select * from carrera;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarMat` (IN `nameMateria` VARCHAR(200))  BEGIN
select m.idMateria from materias m where m.nombreMateria = nameMateria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarMaterias` (IN `nameCarrera` VARCHAR(100))  BEGIN
select * from materias m where m.idCarrera in (select c.idCarrera from carrera c where c.nombreCarrera=nameCarrera);  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarMatProf` (IN `idMat` INT)  BEGIN
select p.correoProf from profesor p where p.idMateria=idMat;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `datosAutor` (IN `idForo` INT)  BEGIN
declare tipo varchar(100);
declare nom varchar(100);
SELECT userType INTO tipo FROM foro f where f.idForo=idForo;
IF tipo = 'est' then
SELECT correoEst as correo, concat_ws(' ', nombresEst, apellidosEst) AS persona, asunto FROM estudiante, foro f where f.idForo=idForo having persona = (select autor from foro f where f.idForo=idForo);
ELSE
SELECT correoProf as correo, concat_ws(' ', nombresProf, apellidosProf) AS persona, asunto FROM profesor, foro f where f.idForo=idForo having persona = (select autor from foro f where f.idForo=idForo);
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `datosColaborador` (IN `userID` INT, IN `tipo` VARCHAR(50))  NO SQL
BEGIN
IF tipo = 'est' then
SELECT cedulaEst as cedula,nombresEst as nombres, apellidosEst as apellidos, correoEst as correo, c.* FROM estudiante e join colaborador c on e.idEstudiante=c.idPersona where idEstudiante = userID;
ELSE
SELECT cedulaProf as cedula,nombresProf as nombres, apellidosProf as apellidos, correoProf as correo, c.* FROM profesor p join colaborador c on p.idProfesor=c.idPersona where idProfesor = userID;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insColaborador` (IN `userID` INT, IN `tipo` VARCHAR(100))  BEGIN
IF (SELECT 1 = 1 FROM colaborador WHERE idPersona=userID AND userType=tipo) THEN
BEGIN
END;
ELSE
BEGIN
INSERT INTO colaborador (idPersona,userType) VALUES (userID, tipo);  
END;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarCalificacion` (IN `idObjetoAprendizaje` INT, IN `valorObjeto` INT, IN `idUsuario` INT)  begin
if NOT EXISTS (select p.idObjetosAprendizaje from puntuacion p where p.idObjetosAprendizaje = idObjetoAprendizaje && p.username = idUsuario)
then 
		insert into puntuacion(calificacionObjeto,idObjetosAprendizaje,username) values(valorObjeto, idObjetoAprendizaje, idUsuario);
    select 'Calificación con éxito' as mensaje;
else
	select 'Este usuario ya ha calificado' as mensaje;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarComentario` (IN `detalleComent` TEXT, IN `idOA` INT(11), IN `idAutor` INT(11), IN `userNameAutor` VARCHAR(50), IN `pathImagen` VARCHAR(200), IN `fechaComentario` VARCHAR(25), IN `pathVideo` VARCHAR(500))  BEGIN
insert into comentario(detalleComent,idOA,idAutor,userNameAutor, pathImagen, fechaComentario,pathVideo)
values(detalleComent,idOA,idAutor,userNameAutor, pathImagen, fechaComentario,pathVideo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarDescarga` (IN `idDescargar` INT)  begin
	update objetoaprendizaje set descargas=descargas+1 where idOA= idDescargar; 
    select 'Gracias por descargar el Objeto de Aprendizaje' as mensaje;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarDetallesChat` (IN `username` VARCHAR(255))  BEGIN

DECLARE userid INT;
SET userid:=0;
SELECT l.user_id INTO userid FROM login l where l.username = username;

INSERT INTO login_details(user_id)
VALUES(userid);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarRespDis` (IN `idForo` INT, IN `asunto` VARCHAR(200), IN `descripcion` TEXT, IN `autor` VARCHAR(100), IN `userType` VARCHAR(100), IN `nombreadjunto` VARCHAR(100))  BEGIN
DECLARE fecha DATETIME;
SELECT NOW() INTO fecha;
insert into resforo(idForo,asunto,descripcion,autor,userType,fechaapertura,nombreadjunto) values (idForo,asunto,descripcion,autor,userType,fecha,nombreadjunto);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarTemaDis` (IN `asunto` VARCHAR(200), IN `descripcion` TEXT, IN `autor` VARCHAR(100), IN `userType` VARCHAR(100), IN `nombreadjunto` VARCHAR(100))  BEGIN
DECLARE fecha DATETIME;
SELECT NOW() INTO fecha;
INSERT INTO foro (asunto,descripcion,autor,userType,fechaapertura,nombreadjunto) values (asunto,descripcion,autor,userType,fecha,nombreadjunto);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modColab` (IN `userID` INT, IN `tipo` VARCHAR(50), IN `fecha` DATE, IN `gen` INT, IN `cprin` VARCHAR(100), IN `numcas` VARCHAR(50), IN `csec` VARCHAR(100), IN `sec` VARCHAR(100), IN `ciu` VARCHAR(100), IN `conv` VARCHAR(9), IN `cel` VARCHAR(10), IN `adj` VARCHAR(100))  BEGIN
UPDATE colaborador SET
fechaNac=fecha,
genero=gen,
callePrinc=cprin,
numCasa=numcas,
calleSec=csec,
sector=sec,
ciudad=ciu,
tfconvencional=conv,
tfcelular=cel,
adjFoto=adj
WHERE idPersona = userID AND userType = tipo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modColabF` (IN `userID` INT, IN `tipo` VARCHAR(50), IN `fecha` DATE, IN `gen` INT, IN `cprin` VARCHAR(100), IN `numcas` VARCHAR(50), IN `csec` VARCHAR(100), IN `sec` VARCHAR(100), IN `ciu` VARCHAR(100), IN `conv` VARCHAR(9), IN `cel` VARCHAR(10))  BEGIN
UPDATE colaborador SET
fechaNac=fecha,
genero=gen,
callePrinc=cprin,
numCasa=numcas,
calleSec=csec,
sector=sec,
ciudad=ciu,
tfconvencional=conv,
tfcelular=cel
WHERE idPersona = userID AND userType = tipo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modForo` (IN `idF` INT, IN `asun` VARCHAR(200), IN `descrip` TEXT, IN `nomad` VARCHAR(100))  BEGIN
DECLARE fecha DATETIME;
SELECT NOW() INTO fecha;
UPDATE foro SET 
asunto = asun,
descripcion = descrip,
fechaapertura = fecha,
nombreadjunto = nomad
WHERE idForo = idF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modForoF` (IN `idF` INT, IN `asun` VARCHAR(200), IN `descrip` TEXT)  BEGIN
DECLARE fecha DATETIME;
SELECT NOW() INTO fecha;
UPDATE foro SET 
asunto = asun,
descripcion = descrip,
fechaapertura = fecha
WHERE idForo = idF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modResp` (IN `idR` INT, IN `asun` VARCHAR(200), IN `descrip` TEXT, IN `nomad` VARCHAR(100), IN `edau` INT)  BEGIN
DECLARE fecha DATETIME;
SELECT NOW() INTO fecha;
UPDATE resforo SET 
asunto = asun,
descripcion = descrip,
fechaapertura = fecha,
nombreadjunto = nomad,
edAutor = edau
WHERE idRespuesta = idR;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modRespF` (IN `idR` INT, IN `asun` VARCHAR(200), IN `descrip` TEXT, IN `edau` INT)  BEGIN
DECLARE fecha DATETIME;
SELECT NOW() INTO fecha;
UPDATE resforo SET 
asunto = asun,
descripcion = descrip,
fechaapertura = fecha,
edAutor = edau
WHERE idRespuesta = idR;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarEstudiante` (IN `cedulaEst` VARCHAR(150), IN `nombresEst` VARCHAR(150), IN `apellidosEst` VARCHAR(150), IN `correoEst` VARCHAR(100), IN `idCarrera` INT(11), IN `usuarioEst` VARCHAR(150), IN `pwEst` VARCHAR(150))  BEGIN
insert into estudiante(cedulaEst, nombresEst, apellidosEst, correoEst, idCarrera, usuarioEst, pwEst)
values(cedulaEst, nombresEst, apellidosEst, correoEst, idCarrera, usuarioEst, pwEst);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarProfesor` (IN `cedulaProf` VARCHAR(150), IN `nombresProf` VARCHAR(150), IN `apellidosProf` VARCHAR(150), IN `correoProf` VARCHAR(100), IN `idDepartamento` INT(11), IN `bloqueo` INT)  BEGIN
insert into profesor(cedulaProf, nombresProf, apellidosProf, correoProf, idDepartamento, usuarioProf, pwProf, bloqueo)
values(cedulaProf, nombresProf, apellidosProf, correoProf, idDepartamento, NULL, NULL, bloqueo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reqCodResp` (IN `idForo` INT, IN `asunto` VARCHAR(200), IN `descripcion` TEXT, IN `autor` VARCHAR(100), IN `userType` VARCHAR(100))  BEGIN
SELECT idRespuesta from resforo r where r.idForo = idForo AND r.asunto=asunto AND r.descripcion=descripcion AND r.autor = autor AND r.userType=userType;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reqFecha` (IN `idResp` INT)  BEGIN
SELECT fechaapertura FROM resforo r where r.idRespuesta = idResp;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `nombreAdmin` varchar(50) NOT NULL,
  `usuarioAdmin` varchar(15) NOT NULL,
  `pwAdmin` varchar(255) NOT NULL,
  `bloqueo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `nombreAdmin`, `usuarioAdmin`, `pwAdmin`, `bloqueo`) VALUES
(1, 'Administrador', 'admin', '$2y$10$nXfCxVyPD5M8nTsPR3Dk3.tBDBY2WZKrQqFuKXk7pGy/DjPkjNIKC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `idCarrera` int(11) NOT NULL,
  `nombreCarrera` varchar(100) NOT NULL,
  `idFacultad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`idCarrera`, `nombreCarrera`, `idFacultad`) VALUES
(1, 'Fisica', 1),
(2, 'Matematicas', 1),
(3, 'Ingenieria Matematica', 1),
(4, 'Ingenieria en Ciencias Economicas y Financieras', 1),
(5, 'Maestria en Fisica', 1),
(6, 'Ingenieria Empresarial', 2),
(7, 'Ingenieria de la Produccion', 2),
(8, 'Maestria en Gestion de Software', 2),
(9, 'Maestria en Gestion de Recusos Humanos', 2),
(10, 'Ingenieria Civil', 3),
(11, 'Ingenieria Ambiental', 3),
(12, 'Ingenieria Electrica', 4),
(13, 'Ingenieria Electrica y Control', 4),
(14, 'Ingenieria Electrica y en Redes de Comunicacion', 4),
(15, 'Ingenieria Electrica y Telecomunicaciones', 4),
(16, 'Maestria en Gestion de Produccion', 4),
(17, 'Maestria en Conectividad y Redes de Telecomunicaciones', 4),
(18, 'Maestria en Automatizacion y Control Electronico Industrial', 4),
(19, 'Maestria en Administracion de Negocios Electricos', 4),
(20, 'Maestria en Ingenieria­a Electrica en Distribucion', 4),
(21, 'Maestria en Redes Elecctricas Inteligentes', 4),
(22, 'Ingenieria en Geologia', 5),
(23, 'Ingenieria en Petroleos', 5),
(24, 'Ingenieria Mecanica', 6),
(25, 'Maestria en Mecatronica y Robotica', 6),
(26, 'Maestria en Sistemas Automotrices', 6),
(27, 'Maestria en Disenoo y Simulacion', 6),
(28, 'Programa Doctoral en Ciencias de la Mecanica', 6),
(29, 'Ingenieria Agroindustrial', 7),
(30, 'Ingenieria Quimica', 7),
(31, 'Ingenieria en Software', 8),
(32, 'Ingenieria en Computacion', 8),
(33, 'Ingenieria en Sistemas Informaticos y de Computacion', 8),
(34, 'Maestria y Especialista en Gestion de las Comunicaciones y Tecnologia de la Informacion', 8),
(35, 'Maestria en Ciencias de la Computacion', 8),
(36, 'Maestria en Sistemas de Informacion', 8),
(37, 'Doctorado en Informatica', 8),
(38, 'Tecnologia en Electronica y Telecomunicaciones', 9),
(39, 'Tecnologia en Ana¡lisis de Sistemas Informaticos', 9),
(40, 'Tecnologia en Electromecanica', 9),
(41, 'Tecnologia en Agua y Saneamiento Ambiental', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(1, 0, 1, '\n\n			hsdfij', '2018-12-17 22:46:11', 1),
(2, 0, 2, '\n\n			Soy un usuario anonimo, me comunicaré personalmente con ud sr administrador<br>', '2019-01-04 05:31:39', 1),
(3, 1, 2, 'Hola admin', '2019-01-04 05:31:57', 1),
(4, 1, 2, 'Respondame rapido\n', '2019-01-04 05:32:07', 1),
(5, 0, 3, '\n\n			Hola anonimo<br>', '2019-01-07 09:49:43', 1),
(6, 2, 3, 'Hola anonimo', '2019-01-07 09:49:57', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador`
--

CREATE TABLE `colaborador` (
  `idColaborador` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `userType` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechaNac` date DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `callePrinc` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `numCasa` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `calleSec` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `sector` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `ciudad` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tfconvencional` varchar(9) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tfcelular` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `adjFoto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `colaborador`
--

INSERT INTO `colaborador` (`idColaborador`, `idPersona`, `userType`, `fechaNac`, `genero`, `callePrinc`, `numCasa`, `calleSec`, `sector`, `ciudad`, `tfconvencional`, `tfcelular`, `adjFoto`) VALUES
(1, 17, 'est', '1997-11-06', 1, 'Calle 1', '1', 'Calle 2', 'La Ferroviaria', 'Quito', '999999999', '0996140513', 'Hydrangeas.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idComentario` int(11) NOT NULL,
  `detalleComent` text NOT NULL,
  `idOA` int(11) DEFAULT NULL,
  `idAutor` int(11) DEFAULT NULL,
  `userNameAutor` varchar(15) DEFAULT NULL,
  `pathImagen` varchar(200) DEFAULT NULL,
  `fechaComentario` varchar(25) NOT NULL,
  `pathVideo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idComentario`, `detalleComent`, `idOA`, `idAutor`, `userNameAutor`, `pathImagen`, `fechaComentario`, `pathVideo`) VALUES
(1, 'Adjuntar mejor objeto de aprendizaje', NULL, NULL, NULL, NULL, '0000-00-00', NULL),
(2, 'El debate se debe implementar mejor', NULL, NULL, NULL, NULL, '0000-00-00', NULL),
(3, 'Se debe realizar una mejor suma para un total de objeto de aprendizaje', NULL, NULL, NULL, NULL, '0000-00-00', NULL),
(4, 'Los problemas de los objetos de aprendizaje se deben crear mejor', NULL, NULL, NULL, NULL, '0000-00-00', NULL),
(5, 'Me parece que se debe realizar una adaptacion al problema', NULL, NULL, NULL, NULL, '0000-00-00', NULL),
(9, 'Me parece que esta mal su documentacion', 3, 2, NULL, NULL, '0000-00-00', NULL),
(11, 'mejore sus preguntas', 2, 1, NULL, NULL, '23/06/2018', NULL),
(12, '', 3, 2, NULL, NULL, '26/06/2018', NULL),
(13, '', 3, 2, NULL, NULL, '26/06/2018', NULL),
(14, '', 3, 2, NULL, NULL, '27/06/2018', NULL),
(15, '', 3, 2, NULL, NULL, '27/06/2018', NULL),
(16, '', 2, 2, NULL, NULL, '27/06/2018', NULL),
(17, 'me parece que esta incorrecto', 3, 2, NULL, NULL, '27/06/2018', NULL),
(18, 'soy otro estudiante', 3, 1, NULL, NULL, '27/06/2018', NULL),
(22, 'nuevo objeto', 3, 2, NULL, 'img/wallpapers-hd.jpg', '01/07/2018', NULL),
(23, 'nueva imagen', 3, 2, NULL, 'img/paraisos-en-el-mar-wallpaper-4k-full-hd-fotosdelanaturaleza.es-2-1140x641.jpg', '01/07/2018', NULL),
(24, 'Tenga una base con este video', 3, 2, NULL, 'img/', '02/07/2018', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/EY2SWmKwo4k\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>'),
(27, '>P', 6, 4, NULL, 'img/fis.jpeg', '24/07/2018', 'https://www.youtube.com/watch?v=hueM23rMcC4'),
(28, 'comentalo xfis jajja\r\n', 6, 7, NULL, 'img/richard stallman.png', '24/07/2018', ''),
(33, '', 7, 22, NULL, 'img/', '19/11/2018', ''),
(36, 'skjfjdskf', 6, 2, 'mario giler', 'img/', '19/11/2018', ''),
(37, 'sknfds', 3, 2, 'mario giler', 'img/', '19/11/2018', ''),
(38, 'mejore sus preguntas', 2, 2, 'mario giler', 'img/', '19/11/2018', ''),
(41, 'nuevo comentario prueba', 3, 2, 'mario giler', 'img/', '27/11/2018', ''),
(42, 'Que es esto', NULL, NULL, NULL, NULL, '', NULL),
(43, 'Hola que tal', 11, 17, 'Leslie Diaz', 'img/', '17/01/2019', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombreDepartamento` varchar(100) NOT NULL,
  `idFacultad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombreDepartamento`, `idFacultad`) VALUES
(1, 'Departamento de Fisica (DF)', 1),
(2, 'Departamento de Matematica (DM)', 1),
(3, 'Departamento de Ciencias Administrativas (DEPCA)', 2),
(4, 'Departamento de Estudios Organizacionales Desarrollo Humano (DESODEH)', 2),
(5, 'Departamento de Ingenieria Civil y Ambiental (DICA)', 3),
(6, 'Departamento de Automatizacion y Control Industrial (DACI)', 4),
(7, 'Departamento de Energia Electrica (DEE)', 4),
(8, 'Departamento de Electronica, Telecomunicaciones y Redes de Informacion (DETRI)', 4),
(9, 'Departamento de Geologia (DG)', 5),
(10, 'Departamento de Petroleos (DP)', 5),
(11, 'Departamento de Ingenieria Mecanica (DIM)', 6),
(12, 'Departamento de Materiales (DMT)', 6),
(13, 'Departamento de Ingenieria Quimica (DIQ)', 7),
(14, 'Departamento de Ciencias de Alimentos y Biotecnologia (DECAB)', 7),
(15, 'Departamento de Ciencias Nucleares (DCN)', 7),
(16, 'Departamento de Metalurgia Extractiva (DEMEX)', 7),
(17, 'Departamento de Informatica y Ciencias de la Computacion (DICC)', 8),
(18, 'Departamento de Formacion Basica (DFB)', 10),
(19, 'Instituto Geofisico', 10),
(20, 'Departamento de Ciencias Sociales', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `idEstudiante` int(11) NOT NULL,
  `cedulaEst` varchar(10) NOT NULL,
  `nombresEst` varchar(50) NOT NULL,
  `apellidosEst` varchar(50) NOT NULL,
  `correoEst` varchar(50) NOT NULL,
  `idCarrera` int(11) NOT NULL,
  `usuarioEst` varchar(15) NOT NULL,
  `pwEst` varchar(255) NOT NULL,
  `idComentarioForo` int(11) DEFAULT NULL,
  `bloqueo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idEstudiante`, `cedulaEst`, `nombresEst`, `apellidosEst`, `correoEst`, `idCarrera`, `usuarioEst`, `pwEst`, `idComentarioForo`, `bloqueo`) VALUES
(1, '1723128318', 'mario javier', 'giler salavarria', 'mariojavier0795@gmail.com', 10, 'mgiler', '$2y$10$eaoIIJKksVJPp6j6HFhK7uy5Xjy8K6f.bLnp6RJl7flJxQPsGFBCm', 0, 1),
(2, '1304189200', 'kelly', 'salavarria', 'mariojavier0795@gmail.com', 7, 'kelysalavarria', '$2y$10$PB1w4WFJZHYAL6uPOX/fB.fGC/qEcm4QGw0A/h1uJR//GvWxpmRJe', 0, 1),
(3, '1302207228', 'jersson', 'andrango', 'jerssonandrangon@gmail.com', 1, 'jandrango', '$2y$10$FafD6HkCIqLBVAPKea9adOLteCXadO6U250E5vILQoDRSMfBOSB3C', NULL, 0),
(4, '1302207228', 'carlos', 'mendoza', 'carlosmendoza@gmail.com', 10, 'carlos', '$2y$10$CrBf6xmJSlwTAcF5VK1Do.XCf3Arq5CDarb.5bfMdm4KV5dRCd0l2', NULL, 1),
(5, '1725937302', 'Steven', 'zambrano', 'stevenzambrano1@hotmail.com', 2, 'steven', '$2y$10$xtLBOeb3.1qD9HosKA3YWeDkB.ygo/fW3yAqphJHcnh88QKkObB9y', NULL, 1),
(7, '0502873326', 'Fernando', 'Pasquel', 'kfcp1234@gmail.com', 3, 'fernando', '$2y$10$iot5juohdtU.RFQp9GRtfe.0OWWSzAT79x6i/NTt2JuP0m53GPtuq', NULL, 1),
(17, '1725116311', 'Leslie', 'Diaz', 'lmdiaz36@gmail.com', 33, 'lesliediaz', '$2y$10$1ZuWe.wSfKS4G7mscv3Fg..62DT5/H5CbMdlYz/SXcr/.3ILywcom', NULL, 1),
(18, '1725116386', 'Traecy', 'Diaz', 'lmdiaz36@gmail.com', 11, 'traecydiaz', '$2y$10$enjSHIC4pFaw.Ya3ELMHCOxlwlAIf2Sl68czmIEuC1V9sfTX4SG0K', NULL, 1),
(19, '1723902472', 'Mishelle', 'Quinchiguango', 'tefi_0095@outlook.com', 32, 'mishelle', '$2y$10$uZCpGe2jc1xsWaKLTuqukeoE4c.jqDVIQXxsKaG/AaDQWv8ZEZ4Eq', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `idFacultad` int(11) NOT NULL,
  `nombreFacultad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`idFacultad`, `nombreFacultad`) VALUES
(1, 'Facultad de Ciencias'),
(2, 'Facultad de Ciencias Administrativas'),
(3, 'Facultad de Ing. Civil y Ambiental'),
(4, 'Facultad de Ing. Electrica y Electronica'),
(5, 'Facultad de Geologia y Petroleos'),
(6, 'Facultad de Ing. Mecanica'),
(7, 'Facultad de Ing. Quimica y Agroindustria'),
(8, 'Facultad de Ing. de Sistemas'),
(9, 'Escuela de Formacion de Tecnologos'),
(10, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `idForo` int(11) NOT NULL,
  `asunto` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `autor` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `userType` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechaapertura` datetime DEFAULT CURRENT_TIMESTAMP,
  `nombreadjunto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`idForo`, `asunto`, `descripcion`, `autor`, `userType`, `fechaapertura`, `nombreadjunto`) VALUES
(32, 'Hola', 'Solo Texto jbjj', 'Administrador', 'admin', '2018-12-24 18:33:22', 'Tulips.jpg'),
(33, 'Software Libre', 'Escriba un comentario sobre el software libre.', 'Leslie Diaz', 'est', '2018-12-31 17:29:36', ''),
(34, 'Hola', 'Mundo', 'mario giler', 'prof', '2019-01-07 04:37:36', ''),
(35, 'Computacion Distribuida', 'Computacion ', 'Mishelle Quinchiguango', 'est', '2019-01-14 17:42:34', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `idimagen` int(11) NOT NULL,
  `rutaImagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`idimagen`, `rutaImagen`) VALUES
(1, 'img/wallpapers-hd.jpg'),
(2, 'img/comprobante.jpg'),
(3, 'img/paraisos-en-el-mar-wallpaper-4k-full-hd-fotosdelanaturaleza.es-2-1140x641.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `usuario` varchar(200) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`user_id`, `usuario`, `username`, `password`) VALUES
(1, 'Administrador', 'admin', '$2y$10$nXfCxVyPD5M8nTsPR3Dk3.tBDBY2WZKrQqFuKXk7pGy/DjPkjNIKC'),
(2, 'Anonimo', 'anonimo', '$2y$10$rCgRmI9hw9qgLBv3BPBKue84TOGD7nne7i/Io5kV7LrEDilcGwmh6'),
(3, 'Traecy Diaz', 'traecydiaz', '$2y$10$enjSHIC4pFaw.Ya3ELMHCOxlwlAIf2Sl68czmIEuC1V9sfTX4SG0K'),
(4, 'Mishelle Quinchiguango', 'mishelle', '$2y$10$uZCpGe2jc1xsWaKLTuqukeoE4c.jqDVIQXxsKaG/AaDQWv8ZEZ4Eq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(22, 1, '2018-12-01 02:29:52', 'no'),
(23, 5, '2018-12-01 02:31:33', 'no'),
(24, 1, '2018-12-01 02:33:31', 'no'),
(25, 5, '2018-12-01 02:58:58', 'no'),
(26, 1, '2018-12-01 02:59:59', 'no'),
(27, 1, '2018-12-01 03:13:19', 'no'),
(28, 5, '2018-12-01 03:14:45', 'no'),
(29, 5, '2018-12-01 03:16:51', 'no'),
(30, 1, '2018-12-01 03:30:21', 'no'),
(31, 5, '2018-12-01 03:51:27', 'no'),
(32, 1, '2018-12-01 03:53:37', 'no'),
(33, 5, '2018-12-01 04:05:29', 'no'),
(34, 6, '2018-12-01 04:36:00', 'no'),
(35, 5, '2018-12-01 04:52:41', 'no'),
(36, 1, '2018-12-01 04:44:14', 'no'),
(37, 1, '2018-12-01 04:58:50', 'no'),
(38, 5, '2018-12-01 05:37:41', 'no'),
(39, 1, '2018-12-01 05:40:24', 'no'),
(40, 1, '2018-12-01 05:47:53', 'no'),
(41, 5, '2018-12-01 06:03:15', 'no'),
(42, 5, '2018-12-03 03:13:28', 'no'),
(43, 5, '2018-12-03 03:24:46', 'no'),
(44, 5, '2018-12-03 04:02:51', 'no'),
(45, 5, '2018-12-03 04:05:17', 'no'),
(46, 5, '2018-12-03 04:37:28', 'no'),
(47, 5, '2018-12-03 04:53:25', 'no'),
(48, 1, '2018-12-03 04:58:07', 'no'),
(49, 1, '2018-12-03 05:10:55', 'no'),
(50, 5, '2018-12-03 05:13:35', 'no'),
(51, 1, '2018-12-03 05:14:31', 'no'),
(52, 5, '2018-12-03 22:04:33', 'no'),
(53, 1, '2018-12-14 07:34:57', 'no'),
(54, 1, '2018-12-14 07:54:10', 'no'),
(55, 1, '2018-12-14 08:28:17', 'no'),
(56, 1, '2018-12-14 08:49:48', 'no'),
(57, 1, '2018-12-14 09:05:39', 'no'),
(58, 5, '2018-12-14 09:21:04', 'no'),
(59, 1, '2018-12-14 09:39:33', 'no'),
(60, 1, '2018-12-14 09:41:15', 'no'),
(61, 1, '2018-12-14 09:44:19', 'no'),
(62, 1, '2018-12-14 09:50:00', 'no'),
(63, 1, '2018-12-14 09:52:20', 'no'),
(64, 1, '2018-12-14 09:55:50', 'no'),
(65, 1, '2018-12-14 09:58:55', 'no'),
(66, 1, '2018-12-14 10:01:01', 'no'),
(67, 1, '2018-12-14 10:07:57', 'no'),
(68, 5, '2018-12-14 10:25:32', 'no'),
(69, 1, '2018-12-14 21:29:49', 'no'),
(70, 9, '2018-12-15 00:40:15', 'no'),
(71, 1, '2018-12-15 08:14:59', 'no'),
(72, 1, '2018-12-17 22:46:28', 'no'),
(73, 1, '2018-12-31 22:47:20', 'no'),
(74, 1, '2019-01-04 05:24:24', 'no'),
(75, 2, '2019-01-04 05:32:09', 'no'),
(76, 3, '2019-01-07 09:50:00', 'no'),
(77, 2, '2019-01-07 09:50:20', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `idMateria` int(11) NOT NULL,
  `nombreMateria` varchar(200) DEFAULT NULL,
  `idCarrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idMateria`, `nombreMateria`, `idCarrera`) VALUES
(1, 'Metrología', 24),
(2, 'Tecnología de fundición', 24),
(3, 'Tecnología de cconformado', 24),
(4, 'Fisica Molecular', 1),
(5, 'Fisica Experimental', 1),
(6, 'Mecanica Newtoniana', 1),
(7, 'Probabilidad y Estadistica', 1),
(8, 'Calculo en una Variable', 2),
(9, 'Probabilidad y Estadistica', 2),
(10, 'Analisis Numerico I', 2),
(11, 'Geometria', 2),
(12, 'Biomatematica y Ecologia', 2),
(13, 'Algebra Lineal', 3),
(14, 'Analisis Vectorial', 3),
(15, 'Optimizacion', 3),
(16, 'Geometria', 3),
(17, 'Fisica', 3),
(18, 'Legislacion Empresarial', 4),
(19, 'Geografia Economica', 4),
(20, 'Teoria Monetaria', 4),
(21, 'Desarrollo Sustentable', 4),
(22, 'Finanzas', 4),
(23, '-', 5),
(24, '-', 5),
(25, '-', 5),
(26, '-', 5),
(27, '-', 5),
(28, 'Contabilidad General', 6),
(29, 'Administracion', 6),
(30, 'Gestion de Ventas', 6),
(31, 'Auditoria Financiera', 6),
(32, 'Formulacion de Proyectos', 6),
(33, 'Quimica General', 7),
(34, 'Mecanica Newtoniana', 7),
(35, 'Estadistica Aplicable', 7),
(36, 'Ingenieria Financiera', 7),
(37, 'Programacion Avanzada', 7),
(38, 'Inteligencia de Negocios', 8),
(39, 'Plataformas Tecnologicas', 8),
(40, 'Aseguramiento de la calidad y seguridad del software', 8),
(41, 'Herramientas de Seguridad de Software', 8),
(42, 'Calidad del Producto de Software', 8),
(43, '-', 9),
(44, '-', 9),
(45, '-', 9),
(46, '-', 9),
(47, '-', 9),
(48, 'Topografia', 10),
(49, 'Calculo Vectorial', 10),
(50, 'Estructuras', 10),
(51, 'Probabilidad y Estadistica', 10),
(52, 'Mecanica de Suelos', 10),
(53, 'Fundamentos de Biologia', 11),
(54, 'Algebra Lineal', 11),
(55, 'Ingenieria de la Reaccion', 11),
(56, 'Bioquimica', 11),
(57, 'Limnologia', 11),
(58, 'Mecanica Newtoniana', 12),
(59, 'Software de Simulacion', 12),
(60, 'Alto Voltaje', 12),
(61, 'Teoria Electromagnetica', 12),
(62, 'Control Industrial', 12),
(63, 'Fisica General', 13),
(64, 'Calculo en una Variable', 13),
(65, 'Analisis de Seniales y Sistemas', 13),
(66, 'Probabilidad y Estadistica', 13),
(67, 'Maquinas Electricas', 13),
(68, 'Calculo en una Variable', 14),
(69, 'Teoria Electromagnetica', 14),
(70, 'Programacion Orienda a Objetos', 14),
(71, 'Seguridad en Redes', 14),
(72, 'Aplicaciones Distribuidas', 14),
(73, 'Algebra Lineal', 15),
(74, 'Ecuaciones Diferenciales Ordinarias', 15),
(75, 'Circuitos Electronicos', 15),
(76, 'Ingenieria de Trafica', 15),
(77, 'Sistemas de Transmision', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetoaprendizaje`
--

CREATE TABLE `objetoaprendizaje` (
  `idOA` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `p_clave` varchar(100) NOT NULL,
  `institucion` varchar(200) NOT NULL,
  `tamano` varchar(50) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `fecha_ing` datetime DEFAULT NULL,
  `ruta_zip` varchar(200) NOT NULL,
  `idAutor` int(11) DEFAULT NULL,
  `idMateria` int(11) DEFAULT NULL,
  `descargas` int(11) DEFAULT '0',
  `userType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `objetoaprendizaje`
--

INSERT INTO `objetoaprendizaje` (`idOA`, `nombre`, `autor`, `descripcion`, `fecha`, `p_clave`, `institucion`, `tamano`, `tipo`, `fecha_ing`, `ruta_zip`, `idAutor`, `idMateria`, `descargas`, `userType`) VALUES
(2, 'Fundamentos de Software Libre', 'Charles giler', 'Objeto de aprendizaje de metodos agiles', '2018-06-15', 'OAcharles', 'Escuela Politecnica Nacional', '1195349 bytes', 'WinRAR ZIP', '2018-06-15 00:00:00', 'zip/SCROM.zip', 3, 1, 4, 'prof'),
(3, 'Interfaz de Usuario', 'Fernando Carrasco', 'Documento para saber sobre la interfaz de usuario', '2018-06-15', 'OAusuario', 'Escuela Politecnica Nacional', '111760 bytes', 'WinRAR ZIP', '2018-06-15 00:00:00', 'zip/DisenioDeInterfazDeUsuario.zip', 4, 2, 3, 'prof'),
(4, 'DISEÑO A NIVEL DE COMPONENTES', 'Tamayo Edison', 'Son líneas de diseño bien definidas que adecuan la estructura de diseño, el interfaz y diseño.', '2018-01-02', 'Diseño a nivel de Componentes', 'Escuela Politecnica Nacional', '561523 bytes', 'WinRAR ZIP', '2018-01-02 00:00:00', 'zip/DisenioDeComponentes.zip', 2, 2, 2, 'prof'),
(5, 'Refactorizar', 'Mario Giler', 'Concepto de refactorizar', '2018-07-11', 'refactorizar', 'Escuela Politecnica Nacional', '372035 bytes', 'WinRAR ZIP', '2018-07-11 00:00:00', 'zip/Refactorizar.zip', 2, 2, 1, 'prof'),
(6, 'DISEÑO A NIVEL DE COMPONENTES', 'Tamayo Edison', 'Son líneas de diseño bien definidas que adecuan la estructura de diseño, el interfaz y diseño.', '2018-01-02', 'Diseño a nivel de Componentes', 'EPN', '561523 bytes', 'WinRAR ZIP', '2018-01-02 00:00:00', 'zip/DisenioDeComponentes.zip', 4, 41, 1, 'prof'),
(7, 'Diseño arquitectónico del repositorio de Objetos de Aprendizaje', 'Luis Orquera', 'Es el diseño previo a la creación previa del  repositorio  el cual permitirá crear objetos de aprendizajes.', '2018-02-01', 'Diseño Arquitectonico', 'EPN', '425394 bytes', 'WinRAR ZIP', '2018-02-01 00:00:00', 'zip/DisenioArquitectonicoDeOA.zip', 5, 29, 1, 'prof'),
(8, 'Algebra Lineal', 'Luis Orquera', 'ejercicios', '2018-07-13', 'Algebra', 'EPN', '179039 bytes', 'WinRAR ZIP', '2018-07-13 00:00:00', 'zip/SoftwareLibre.zip', 5, 30, 2, 'prof'),
(9, 'Web', 'Charles', 'consultas Web', '2018-07-11', 'WEB', 'EPN', '1174849 bytes', 'WinRAR ZIP', '2018-07-11 00:00:00', 'zip/WEB.zip', 3, 39, NULL, 'prof'),
(10, 'Scrum', 'Charles Giler', 'Metodologia de desarrollo de sotware', '2018-07-11', 'Metodologias, Scrum', 'EPN', '1195349 bytes', 'WinRAR ZIP', '2018-07-11 00:00:00', 'zip/SCROM.zip', 3, 72, NULL, 'prof'),
(11, 'Problema de los filósofos comensales', 'Leslie Diaz Y.', 'Este objeto de aprendizaje pretende ser una guía para la solución del problema de los filósofos comensales. Aquí se puede encontrar una breve descripción del problema, un esquema de solución, la imple', '2019-01-16', 'Filósofos', 'EPN', '1542261 bytes', 'WinRAR ZIP', '2018-10-01 00:00:00', 'zip/DiazLeslie_OAFilosofosComensales.zip', 17, NULL, 2, 'est');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `idProfesor` int(11) NOT NULL,
  `cedulaProf` varchar(10) NOT NULL,
  `nombresProf` varchar(50) NOT NULL,
  `apellidosProf` varchar(50) NOT NULL,
  `correoProf` varchar(50) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `usuarioProf` varchar(15) DEFAULT NULL,
  `pwProf` varchar(255) DEFAULT NULL,
  `idComentario` int(11) DEFAULT NULL,
  `idMateria` int(11) DEFAULT NULL,
  `bloqueo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`idProfesor`, `cedulaProf`, `nombresProf`, `apellidosProf`, `correoProf`, `idDepartamento`, `usuarioProf`, `pwProf`, `idComentario`, `idMateria`, `bloqueo`) VALUES
(1, '1304189200', 'kely esperanza', 'salavarria bravo', 'kelysalavarria@gmail.com', 8, NULL, NULL, NULL, NULL, 1),
(2, '1723128318', 'mario', 'giler', 'mariojavier0795@gmail.com', 2, 'mario', '$2y$10$vtlblpP.BIKGMMRfxfEsI.eOuQUfAOeN34U2higqAHWlUKfYefyJa', NULL, NULL, 1),
(3, '1302207228', 'charles', 'giler', 'charlesgilermendoza@gmail.com', 10, 'charles', '$2y$10$4NVFBAbbgH4iE1Yx0qZ4Ce2uAqDaYxoq0OAeSVqFTHZfljB0CBsDa', NULL, NULL, 1),
(4, '1722295134', 'fernando', 'carrasco', 'fernandocarrasco@gmail.com', 17, 'fernando', '$2y$10$hxBTuJOq272qfJ4idc9HJu0dEI0mEsFLa/YrpeVHg4ABivgOq9emS', NULL, NULL, 1),
(5, '1000982882', 'luis', 'orquera', 'luis.orquera@gmail.com', 12, 'luis', '$2y$10$KDQrY3DsMjSeVaSvwdZewu3MTCetFmp2VMdRbF0IHicyKYFpu5iG6', NULL, NULL, 1),
(23, '1103337398', 'Carmen', 'Yanangomez', 'lmdiaz36@gmail.com', 7, NULL, NULL, NULL, NULL, 0),
(24, '1725116386', 'Traecy', 'Diaz', 'lmdiaz36@gmail.com', 10, 'traecydiaz', '$2y$10$yovcOPAc0B2lDeRUP.DZteesh1A5oJBYW.xH.G4IsW4xc6okdmlhS', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntuacion`
--

CREATE TABLE `puntuacion` (
  `idPuntuacion` int(11) NOT NULL,
  `calificacionObjeto` float DEFAULT NULL,
  `idObjetosAprendizaje` int(11) DEFAULT NULL,
  `username` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puntuacion`
--

INSERT INTO `puntuacion` (`idPuntuacion`, `calificacionObjeto`, `idObjetosAprendizaje`, `username`) VALUES
(6, 3, 2, '2'),
(7, 3, 2, '0'),
(8, 5, 6, '0'),
(9, 5, 8, '0'),
(10, 1, 7, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resforo`
--

CREATE TABLE `resforo` (
  `idRespuesta` int(11) NOT NULL,
  `idForo` int(11) NOT NULL,
  `asunto` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `autor` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `userType` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechaapertura` datetime NOT NULL,
  `nombreadjunto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `edAutor` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `resforo`
--

INSERT INTO `resforo` (`idRespuesta`, `idForo`, `asunto`, `descripcion`, `autor`, `userType`, `fechaapertura`, `nombreadjunto`, `edAutor`) VALUES
(11, 33, 'Re: Software Libre', 'El software libre es todo programa informático cuyo código fuente puede ser estudiado, modificado, y utilizado libremente con cualquier fin y redistribuido', 'mario giler', 'prof', '2019-01-08 19:30:17', '', 0),
(13, 35, 'Re: Computacion Distribuida', 'La computación distribuida o informática en malla (grid) es un modelo para resolver problemas de computación masiva utilizando un gran número de ordenadores organizados en clústeres incrustados en una infraestructura de telecomunicaciones distribuida.', 'Leslie Diaz', 'est', '2019-01-14 19:11:12', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutaoa`
--

CREATE TABLE `rutaoa` (
  `idRuta` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idOA` int(11) DEFAULT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rutaoa` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `idTema` int(11) NOT NULL,
  `descripcionTema` varchar(50) NOT NULL,
  `idComentario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`idTema`, `descripcionTema`, `idComentario`) VALUES
(1, 'Objetos de Aprendizaje', 1),
(2, 'Objetos de Aprendizaje', 2),
(3, 'Exposiciones', 3),
(4, 'Exposiciones', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`idCarrera`),
  ADD KEY `idFacultad` (`idFacultad`);

--
-- Indices de la tabla `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indices de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`idColaborador`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idOA` (`idOA`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`),
  ADD KEY `idFacultad` (`idFacultad`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`idEstudiante`),
  ADD KEY `idCarrera` (`idCarrera`),
  ADD KEY `idComentarioForo_idx` (`idComentarioForo`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`idFacultad`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`idForo`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`idimagen`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idMateria`),
  ADD KEY `FK_idCarrera` (`idCarrera`);

--
-- Indices de la tabla `objetoaprendizaje`
--
ALTER TABLE `objetoaprendizaje`
  ADD PRIMARY KEY (`idOA`),
  ADD KEY `FK_idMateria` (`idMateria`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`idProfesor`),
  ADD KEY `idDepartamento` (`idDepartamento`),
  ADD KEY `idComentario_idx` (`idComentario`),
  ADD KEY `FK_idMateriaProf` (`idMateria`);

--
-- Indices de la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD PRIMARY KEY (`idPuntuacion`),
  ADD KEY `FK_idObjetoAprendizaje` (`idObjetosAprendizaje`);

--
-- Indices de la tabla `resforo`
--
ALTER TABLE `resforo`
  ADD PRIMARY KEY (`idRespuesta`);

--
-- Indices de la tabla `rutaoa`
--
ALTER TABLE `rutaoa`
  ADD PRIMARY KEY (`idRuta`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`idTema`),
  ADD KEY `FK_Comentario_idx` (`idComentario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `idCarrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `idColaborador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `idEstudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `idFacultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `idForo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `idimagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `idMateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `objetoaprendizaje`
--
ALTER TABLE `objetoaprendizaje`
  MODIFY `idOA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `idProfesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  MODIFY `idPuntuacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `resforo`
--
ALTER TABLE `resforo`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `rutaoa`
--
ALTER TABLE `rutaoa`
  MODIFY `idRuta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `idTema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `FK_idCarrera` FOREIGN KEY (`idCarrera`) REFERENCES `carrera` (`idCarrera`);

--
-- Filtros para la tabla `objetoaprendizaje`
--
ALTER TABLE `objetoaprendizaje`
  ADD CONSTRAINT `FK_idMateria` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`idMateria`);

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `FK_idMateriaProf` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`idMateria`),
  ADD CONSTRAINT `idComentario` FOREIGN KEY (`idComentario`) REFERENCES `comentario` (`idComentario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
  ADD CONSTRAINT `FK_idObjetoAprendizaje` FOREIGN KEY (`idObjetosAprendizaje`) REFERENCES `objetoaprendizaje` (`idOA`);

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `FK_Comentario` FOREIGN KEY (`idComentario`) REFERENCES `comentario` (`idComentario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
