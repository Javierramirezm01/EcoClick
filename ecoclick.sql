-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2022 a las 18:45:35
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecoclick`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recoleccionresiduos`
--

CREATE TABLE `recoleccionresiduos` (
  `id` int(11) NOT NULL,
  `area` varchar(30) NOT NULL,
  `tipo_residuo` varchar(100) NOT NULL,
  `peso` double NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recoleccionresiduos`
--

INSERT INTO `recoleccionresiduos` (`id`, `area`, `tipo_residuo`, `peso`, `usuario`, `observaciones`, `fecha`) VALUES
(19, 'Contabilidad', 'Ordinario', 1, 'Admin Users', 'Sin novedad.', '0000-00-00'),
(20, 'Contabilidad', 'Ordinario', 1, 'Admin Users', 'Sin novedad.', '2022-08-08'),
(21, 'Contabilidad', 'Ordinario', 2, 'Admin Users', 'Sin novedad.', '2022-08-08'),
(22, 'Contabilidad', 'Ordinario', 1, 'Admin Users', 'Sin novedad.', '2022-08-08'),
(23, 'Contabilidad', 'Ordinario', 1, 'Admin Users', 'Sin novedad.', '2022-08-08'),
(24, 'Contabilidad', 'Ordinario', 1, 'Admin Users', 'Sin novedad.', '2022-08-08'),
(25, 'Sistemas', 'Reciclable', 70, 'Admin Users', 'Sin novedad.', '2022-08-09'),
(26, 'Gestion Humana', 'Reciclable', 70, 'Admin Users', 'Sin novedad.', '2022-09-12'),
(27, 'Gestion Humana', 'Reciclables', 20, 'Admin Users', 'Sin novedad.', '2022-09-12'),
(28, 'Gestion Humana', 'Ordinarios', 10, 'Admin Users', 'Sin novedad.', '2022-09-12'),
(29, 'Contabilidad', 'No aprovechables', 50, 'Admin Users', 'Solo se recolecto el 50%.', '2022-09-13'),
(30, 'Gestion Humana', 'Reciclables', 25, 'Admin Users', 'Sin novedad.', '2022-09-19'),
(31, 'GESTION DOCUMENTAL', 'RECICLABLES', 30, 'ADMIN USERS', 'SIN NOVEDAD.', '2022-09-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residuos`
--

CREATE TABLE `residuos` (
  `id` int(11) NOT NULL,
  `residuo` varchar(100) NOT NULL,
  `material` varchar(50) NOT NULL,
  `color_bolsa` varchar(50) NOT NULL,
  `pretratamiento` varchar(100) NOT NULL,
  `tratamiento` varchar(100) NOT NULL,
  `disposicion_final` varchar(200) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `tipo_solicitud` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contacto` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `tipo_solicitud`, `area`, `usuario`, `contacto`, `descripcion`, `prioridad`, `cantidad`, `estado`, `fecha`) VALUES
(5, 'Capacitacion', 'Gestion Documental', 'Admin Users', '3195770216', 'Se solcita capacitacion.', 2, 1, 1, '2022-09-13'),
(7, 'Dotación de canecas', 'Sistemas', 'Admin Users', '3195770216', 'Se solicita canecas color verde.', 2, 2, 0, '2022-09-13'),
(8, 'Recolección de residuos', 'Contabilidad', 'Admin Users', '3847300', 'Se solicita la recoleccion de residuos no aprovechables.', 1, 1, 0, '2022-09-13'),
(9, 'Inspección', 'Gestion Humana', 'Admin Users', 'Ext 1010', 'Se solcita inspeccion.', 0, 1, 0, '2022-09-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposolicitud`
--

CREATE TABLE `tiposolicitud` (
  `id` int(11) NOT NULL,
  `tiposolicitud` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tiposolicitud`
--

INSERT INTO `tiposolicitud` (`id`, `tiposolicitud`) VALUES
(0, 'Capacitación'),
(0, 'Inspección'),
(0, 'Dotación de canecas'),
(0, 'Recolección de residuos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id` int(11) NOT NULL,
  `ubicacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id`, `ubicacion`) VALUES
(2, 'Gestion Humana'),
(3, 'Gestion Documental'),
(4, 'Sistemas'),
(5, 'Contabilidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Admin Users', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'iz87appc1.png', 1, '2022-09-19 18:43:21'),
(2, 'Special User', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'no_image.jpg', 1, '2017-06-16 07:11:26'),
(3, 'Default User', 'user', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.jpg', 1, '2017-06-16 07:11:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'Special', 2, 0),
(3, 'User', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recoleccionresiduos`
--
ALTER TABLE `recoleccionresiduos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `residuos`
--
ALTER TABLE `residuos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_level` (`user_level`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recoleccionresiduos`
--
ALTER TABLE `recoleccionresiduos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `residuos`
--
ALTER TABLE `residuos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
