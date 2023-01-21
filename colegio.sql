-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-01-2023 a las 23:47:02
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `colegio`
--
DROP DATABASE IF EXISTS `colegio`;
CREATE DATABASE IF NOT EXISTS `colegio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `colegio`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL COMMENT 'dentificador del Alumno',
  `cedula` varchar(8) DEFAULT NULL COMMENT 'Cedula del Alumno',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre del Alumno',
  `fe_nac` varchar(10) NOT NULL COMMENT 'Fecha de Nacimiento del Alumno',
  `sexo` char(1) NOT NULL COMMENT 'Sexo del Alumno',
  `id_representante` int(11) NOT NULL COMMENT 'Identificador del Representante del Alumno',
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT 'Estado del Alumno'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `cedula`, `nombre`, `fe_nac`, `sexo`, `id_representante`, `estado`) VALUES
(1, '', 'Saith Javier Mulfor Herrera', '2018-09-29', 'm', 1, 1),
(2, '', 'Romina Alejandra Sanchez Mulfor', '2022-08-25', 'f', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

DROP TABLE IF EXISTS `asignaturas`;
CREATE TABLE `asignaturas` (
  `id` int(11) NOT NULL COMMENT 'Identificador de la Asignatura',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre de la Asignatura',
  `id_grado` int(10) NOT NULL COMMENT 'Grado de la Asignatura'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id`, `nombre`, `id_grado`) VALUES
(1, 'Lenguaje', 1),
(2, 'Lenguaje', 2),
(3, 'Lenguaje', 3),
(4, 'Lenguaje', 4),
(5, 'Lenguaje', 5),
(6, 'Lenguaje', 6),
(7, 'Matematicas', 1),
(8, 'Matematicas', 2),
(9, 'Matematicas', 3),
(10, 'Matematicas', 4),
(11, 'Matematicas', 5),
(12, 'Matematicas', 6),
(13, 'Computacion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas_docentes`
--

DROP TABLE IF EXISTS `asignaturas_docentes`;
CREATE TABLE `asignaturas_docentes` (
  `id` int(11) NOT NULL COMMENT 'Identificador de la Asignacion',
  `id_docente` int(11) NOT NULL COMMENT 'Identificador del Docente',
  `id_asignatura` int(11) NOT NULL COMMENT 'Identificador de la Asignatura'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignaturas_docentes`
--

INSERT INTO `asignaturas_docentes` (`id`, `id_docente`, `id_asignatura`) VALUES
(1, 5, 1),
(2, 5, 7),
(3, 4, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL COMMENT 'Identificador Unico',
  `rif` varchar(20) NOT NULL COMMENT 'Numero de Registro de Informacion Fiscal',
  `nombre` varchar(200) NOT NULL COMMENT 'Nombre del Colegio',
  `telefono` varchar(15) NOT NULL COMMENT 'Telefono del Colegio',
  `direccion` varchar(200) NOT NULL COMMENT 'Direccion del Colegio',
  `mensaje` varchar(200) NOT NULL COMMENT 'Mensaje de Impresion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `rif`, `nombre`, `telefono`, `direccion`, `mensaje`) VALUES
(1, 'V-15058652-2', 'U.E: Nuestra Infancia', '04246957000', 'Av. 10 con Calle 90 # 90-27, Maracaibo Estado Zulia', 'Moral y Luces son nuestras Primeras Necesidades!!!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permisos`
--

DROP TABLE IF EXISTS `detalle_permisos`;
CREATE TABLE `detalle_permisos` (
  `id` int(11) NOT NULL COMMENT 'Identificador Unico',
  `id_usuario` int(11) NOT NULL COMMENT 'Id de Usuario',
  `id_permiso` int(11) NOT NULL COMMENT 'Id de Permiso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_permisos`
--

INSERT INTO `detalle_permisos` (`id`, `id_usuario`, `id_permiso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2),
(5, 2, 3),
(6, 1, 4),
(7, 1, 5),
(8, 1, 6),
(9, 1, 7),
(10, 1, 8),
(11, 1, 9),
(13, 1, 10),
(14, 1, 11),
(15, 1, 12),
(16, 1, 13),
(17, 1, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

DROP TABLE IF EXISTS `docentes`;
CREATE TABLE `docentes` (
  `id` int(11) NOT NULL COMMENT 'Identificador del Docente',
  `fe_nac` varchar(10) DEFAULT NULL COMMENT 'Fecha de Nacimiento',
  `institucion` varchar(100) DEFAULT NULL COMMENT 'Institucion de Egreso',
  `titulo` varchar(100) DEFAULT NULL COMMENT 'Titulo o especialidad',
  `anio_grad` int(4) DEFAULT NULL COMMENT 'Año de Graduacion',
  `id_user` int(11) NOT NULL COMMENT 'Identificador de Usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `fe_nac`, `institucion`, `titulo`, `anio_grad`, `id_user`) VALUES
(4, '1968-09-15', 'IUP. Santiago Mariño', 'Ingeniero en Sistemas', 1989, 28),
(5, '1971-08-07', 'La Universidad del Zulia', 'Licenciado en Educacion Basica Integral', 1990, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

DROP TABLE IF EXISTS `grados`;
CREATE TABLE `grados` (
  `id` int(11) NOT NULL COMMENT 'id del Grado',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del Grado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id`, `nombre`) VALUES
(1, 'Primer Grado'),
(2, 'Segundo Grado'),
(3, 'Tercer Grado'),
(4, 'Cuarto Grado'),
(5, 'Quinto Grado'),
(6, 'Sexto Grado'),
(7, 'Septimo Grado'),
(8, 'Octavo Grado'),
(9, 'Noveno Grado'),
(10, 'Primero de Ciencias'),
(11, 'Segundo de Ciencias'),
(12, 'Primero de Quimca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id` int(11) NOT NULL COMMENT 'Identificador del Permiso',
  `permiso` varchar(40) NOT NULL COMMENT 'Nombre del Permiso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permiso`) VALUES
(1, 'administracion'),
(2, 'usuarios'),
(3, 'registrar_usuario'),
(4, 'asignaturas'),
(5, 'grados'),
(6, 'registrar_grado'),
(7, 'registrar_asignatura'),
(8, 'docentes'),
(9, 'actualizar_docente'),
(10, 'establecer_asignaturas'),
(11, 'representantes'),
(12, 'actualizar_representante'),
(13, 'registrar_alumno'),
(14, 'eliminar_alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

DROP TABLE IF EXISTS `representantes`;
CREATE TABLE `representantes` (
  `id` int(11) NOT NULL COMMENT 'Identificador del Representante',
  `fe_nac` varchar(10) DEFAULT NULL COMMENT 'Fecha de Nacimiento del Representante',
  `cedula` int(8) DEFAULT NULL COMMENT 'Cedula del Representante',
  `direccion` varchar(100) DEFAULT NULL COMMENT 'Direccion del Representante',
  `telefono` varchar(12) DEFAULT NULL COMMENT 'Telefono del Representante',
  `id_user` int(11) NOT NULL COMMENT 'Idnetificador del Usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`id`, `fe_nac`, `cedula`, `direccion`, `telefono`, `id_user`) VALUES
(1, '1997-07-25', 25907189, 'Avenida 10 con Calle 90 #90-57', '04246957000', 34),
(2, '2003-02-15', 33333333, 'Avenida 10 con Calle 90 #90-57', '04146589874', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL COMMENT 'Identificador del Rol',
  `name` varchar(40) NOT NULL COMMENT 'Nombre del Rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrador'),
(2, 'Director'),
(3, 'Docente'),
(4, 'Representante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL COMMENT 'Identificador del Usuario',
  `usuario` varchar(20) NOT NULL COMMENT 'Username',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre y Apellido',
  `clave` varchar(100) NOT NULL COMMENT 'password',
  `rol_id` int(11) NOT NULL COMMENT 'Rol del Usuario',
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `clave`, `rol_id`, `estado`) VALUES
(1, 'admin', 'Rayne Flores', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, 1),
(28, 'beto', 'Alberto Viloria', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 3, 1),
(29, 'luzmarita', 'Luzmary Arrieta', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 2, 1),
(31, 'liber', 'Liber Castro', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 3, 1),
(34, 'rene', 'Rene Mulfor', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 4, 1),
(35, 'rosa', 'Rosangely Mulfor', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignaturas_docentes`
--
ALTER TABLE `asignaturas_docentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'dentificador del Alumno', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la Asignatura', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `asignaturas_docentes`
--
ALTER TABLE `asignaturas_docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la Asignacion', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Unico', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Unico', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Docente', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del Grado', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Permiso', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Representante', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Rol', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Usuario', AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
