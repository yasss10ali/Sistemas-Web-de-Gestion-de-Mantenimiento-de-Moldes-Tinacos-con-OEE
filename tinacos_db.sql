-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2026 a las 18:08:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tinacos_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oee`
--

CREATE TABLE `oee` (
  `id` int(11) NOT NULL,
  `maquina` varchar(50) DEFAULT NULL,
  `turno` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tiempo_planeado` int(11) DEFAULT NULL,
  `tiempo_paro` int(11) DEFAULT NULL,
  `produccion_total` int(11) DEFAULT NULL,
  `defectuosos` int(11) DEFAULT NULL,
  `produccion_ideal` int(11) DEFAULT NULL,
  `oee` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oee`
--

INSERT INTO `oee` (`id`, `maquina`, `turno`, `fecha`, `tiempo_planeado`, `tiempo_paro`, `produccion_total`, `defectuosos`, `produccion_ideal`, `oee`) VALUES
(1, 'RFAC- 28 ', 1, '2026-04-25', 490, 120, 23, 2, 25, 63.43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operadores`
--

CREATE TABLE `operadores` (
  `id_operador` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `turno` int(20) DEFAULT NULL,
  `maquina` text NOT NULL,
  `numero_de_maquina` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `operadores`
--

INSERT INTO `operadores` (`id_operador`, `nombre`, `turno`, `maquina`, `numero_de_maquina`) VALUES
(1, 'Isaías', 1, 'Horno B/1', 'RTM-01'),
(2, 'Octaviano', 2, 'Horno B/1', 'RTM-01'),
(3, 'Luis Angel', 1, 'Horno B/2', 'RTM-01'),
(4, 'Adrián', 2, 'Horno B/2', 'RTM-01'),
(5, 'Trinidad', 1, 'Fosa', 'RFAC-01'),
(6, 'Victor', 1, 'Flama #1', 'RFAC-03, -01'),
(7, 'Enrique', 1, 'Flama #2', 'RFAC-03 ,-02'),
(8, 'Adan', 1, 'Flama Lavadero ', 'RFAC-30'),
(9, 'Antonio', 1, 'Flama #03', 'RFAC-04'),
(10, 'Brayan', 1, 'Flama #4', 'RFAC-27'),
(11, 'Oscar', 2, 'Flama #4', 'RFAC-27'),
(12, 'Bernardo', 1, 'Flama Lavadero #2', 'RFAC-34'),
(13, 'Francisco Javier', 2, 'Flama Lavadero #2', 'RFAC-34'),
(14, 'Sergio', 1, 'Flama #5', 'RFAC-28'),
(15, 'José.Guadalupe', 0, 'Flama mini', 'RFAC-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id_registro` int(11) NOT NULL,
  `id_operador` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `mantenimiento` varchar(5) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `peso` decimal(6,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `turno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id_registro`, `id_operador`, `fecha`, `mantenimiento`, `hora`, `peso`, `cantidad`, `turno`) VALUES
(1, 1, '2026-03-17', 'SI', '15:54:00', 1100.00, 5, 0),
(2, 1, '2026-03-17', 'SI', '12:45:00', 750.00, 1, 0),
(3, 1, '2026-03-17', 'SI', '15:54:00', 1100.00, 5, 0),
(4, 16, '2026-04-15', 'SI', '23:11:00', 750.00, 7, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tinacos`
--

CREATE TABLE `tinacos` (
  `id_tinaco` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `capa1` decimal(6,2) DEFAULT NULL,
  `capa2` decimal(6,2) DEFAULT NULL,
  `capa3` decimal(6,2) DEFAULT NULL,
  `peso_total` decimal(6,2) DEFAULT NULL,
  `caracteristicas` text DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tinacos`
--

INSERT INTO `tinacos` (`id_tinaco`, `tipo`, `capa1`, `capa2`, `capa3`, `peso_total`, `caracteristicas`, `codigo`) VALUES
(1, 'Tinaco Tricapa Beige 450L', 5.50, 1.50, 4.00, 11.00, 'Tricapa alta resistencia', '487065'),
(2, 'Tinaco Tricapa Beige 750L', 6.50, 3.00, 5.50, 15.00, 'Uso domestico', '487069'),
(3, 'Tinaco Tricapa Beige 500L', 6.00, 2.00, 5.00, 13.00, NULL, '487067'),
(4, 'Tinaco Tricapa Beige 1100L', 8.00, 2.00, 2.00, 16.00, NULL, '495252'),
(6, 'Tinaco Tricapa Negro 450L', 3.00, 1.00, 4.20, 9.50, NULL, '487066'),
(7, 'Tinaco Tricapa Negro 600L', 5.30, 2.00, 5.50, 13.00, NULL, '487068'),
(8, 'Tinaco Tricapa Negro 750L', 5.00, 3.00, 6.00, 14.00, NULL, '487070'),
(9, 'Tinaco Tricapa Negro 1100L', 8.00, 20.00, 7.00, 18.00, NULL, '451799'),
(10, 'Tinaco Tricapa Negro 1100L', 8.00, 20.00, 7.00, 18.00, NULL, '451799'),
(11, 'Tinaco Tricapa Negro 1100L', 8.00, 20.00, 7.00, 18.00, NULL, '451799');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `contrasena` varchar(30) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `contrasena`, `rol`) VALUES
(2, 'Marco Antonio Toribio Manjarrez Supervisor', 'Marco', 'Sistemas01', 'supervisor'),
(3, 'Arturo Guadarrama ', 'Arturo', 'Sistemas01', 'supervisor'),
(4, 'Rosa Elia Enriquez Prospero', 'Rosa', 'Sistemas01', 'supervisor'),
(7, 'Isaías', 'Isaias', 'Sistemas01', 'operador'),
(8, 'Octaviano', 'Octaviano', 'Sistemas01', 'operador'),
(9, 'Luis Angel', 'Luis Angel', 'Sistemas01', 'operador'),
(10, 'Adrian', 'Adrian', 'Sistemas01', 'operador'),
(11, 'Trinidad', 'Trinidad', 'Sistemas01', 'supervisor'),
(12, 'Victor', 'Victor', 'Sistemas01', 'operador'),
(13, 'Enrique', 'Enrique', 'Sistemas01', 'operador'),
(14, 'Adan', 'Adan', 'Sistemas01', 'operador'),
(15, 'Antonio', 'Antonio', 'Sistemas01', 'operador'),
(16, 'Brayan', 'Brayan', 'Sistemas01', 'operador'),
(17, 'Oscar', 'Oscar', 'Sistemas01', 'operador'),
(18, 'Bernardo', 'Bernardo', 'Sistemas01', 'operador'),
(19, 'Francisco Javier', 'Francisco Javier', 'Sistemas01', 'operador'),
(20, 'Sergio', 'Sergio', 'Sistemas01', 'operador'),
(21, 'José.Guadalupe', 'José.Guadalupe', 'Sistemas01', 'operador'),
(22, 'Yasmin', 'Yasmin', 'Sistemas01', 'supervisor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `oee`
--
ALTER TABLE `oee`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `operadores`
--
ALTER TABLE `operadores`
  ADD PRIMARY KEY (`id_operador`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id_registro`);

--
-- Indices de la tabla `tinacos`
--
ALTER TABLE `tinacos`
  ADD PRIMARY KEY (`id_tinaco`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `oee`
--
ALTER TABLE `oee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `operadores`
--
ALTER TABLE `operadores`
  MODIFY `id_operador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tinacos`
--
ALTER TABLE `tinacos`
  MODIFY `id_tinaco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
