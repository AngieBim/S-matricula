-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2023 a las 06:01:00
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estudiantes`
--
CREATE DATABASE IF NOT EXISTS `estudiantes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `estudiantes`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_info`
--
-- Creación: 26-11-2023 a las 00:22:31
-- Última actualización: 26-11-2023 a las 01:25:30
--

CREATE TABLE `estudiantes_info` (
  `id` int(5) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `codigo` int(6) NOT NULL,
  `grado` varchar(7) NOT NULL,
  `direccion` varchar(15) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `fotografia` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estudiantes_info`
--

INSERT INTO `estudiantes_info` (`id`, `nombre`, `codigo`, `grado`, `direccion`, `telefono`, `fotografia`, `fecha`) VALUES
(0, 'Ivan Terrones', 895623, 'Tercero', 'Manzanes 13', '913171555', '895623-Sunday-11-11-26-000-42.png', '2023-11-26 01:00:42'),
(1, 'Emiliano Zapata', 234109, 'Primero', 'san Isidro 14', '962453578', '2341092020-08-14-08-34.png', '2023-08-14 15:23:34'),
(2, 'Rafael Castro', 234110, 'Quinto', 'San Martin', '945648712', '2341102020-08-14-08-13.png', '2023-08-14 15:38:13'),
(3, 'Julia Barón', 234111, 'Tercero', 'Tarapaca 12', '921546819', '2341112020-08-14-08-27.jpg', '2023-08-14 17:19:16'),
(4, 'Natalia Cardona', 234112, 'Cuarto', 'Arturo Guevara', '915824671', '2341122020-08-14-08-22.png', '2023-08-14 19:54:22'),
(5, 'Sofia Tamayo', 234113, 'Quinto', 'Av. Tupac Amaru', '947894512', '2341132020-08-14-08-22.png', '2023-08-14 21:51:22'),
(6, 'Luisa Cortez', 121212, 'Sexto', 'Jr tacna', '913171555', '121212-2023-11-07-18-56-28.jpg', '2023-11-07 17:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--
-- Creación: 21-11-2023 a las 04:11:18
-- Última actualización: 26-11-2023 a las 04:01:43
--

CREATE TABLE `usuario` (
  `id` int(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nom_user` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `estado` varchar(12) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `nom_user`, `contraseña`, `foto`, `estado`, `fecha`) VALUES
(2, 'miguel', 'miguel@1juy.com', 'miguelito', '00000000', 'miguelitoSunday-11-11-26-000', 'activo', '2023-11-26 00:24:39'),
(3, 'princs', 'angie@mipag.com', 'angie', '123456', 'angie54-11-23-11-2023descarga.png', 'activo', '2023-11-06 20:27:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estudiantes_info`
--
ALTER TABLE `estudiantes_info`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
