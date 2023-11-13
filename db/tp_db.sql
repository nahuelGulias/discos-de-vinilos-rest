-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2023 a las 20:25:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

CREATE TABLE `artistas` (
  `id_artista` int(11) NOT NULL,
  `artista` varchar(45) NOT NULL,
  `anio_nac` date NOT NULL,
  `descripcion` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`id_artista`, `artista`, `anio_nac`, `descripcion`) VALUES
(1, 'Luis Spinetta', '1950-01-23', 'Luis Alberto Spinetta (Buenos Aires, 23 de enero de 1950 - 8 de febrero de 2012) fue un músico, cantante, guitarrista, poeta, escritor y compositor argentino, considerado uno de los más importantes y respetados músicos de Argentina, Latinoamérica y del habla hispana por la complejidad instrumental, lírica y poética de sus obras musicales, tanto en sus múltiples agrupaciones y como solista. \r\n'),
(2, 'Carlos Alberto Solari', '1949-01-17', 'Carlos Alberto \"El Indio\" Solari nació el 17 de enero de 1949 en la provincia argentina de Entre Ríos, en la ciudad de Paraná.\r\nEstudió Bellas Artes. Fue, junto a Skay Bellinson, con quién fue miembro fundador de Patricio Rey y sus Redonditos de Ricota, banda emblemática del rock argentino entre comienzos de los 80s y el transcurso de los 90s.'),
(3, 'Gustavo Cerati', '1959-11-08', 'Gustavo Adrián Cerati, conocido como Gustavo Cerati, fue un músico, cantautor y productor discográfico argentino que obtuvo reconocimiento internacional por haber sido el líder, vocalista, compositor y guitarrista de la banda de rock Soda Stereo.'),
(5, 'Ricardo Iorio', '1962-05-25', 'Ricardo Horacio Iorio ​​ fue un músico y productor argentino, conocido por ser el fundador de las bandas V8, Hermética y Almafuerte. Es considerado uno de los principales referentes e impulsores del heavy metal argentino.​​​​Comenzó su carrera musical como bajista de V8, grupo que fundó con Ricardo \"Chofa\" Moreno.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `pass`) VALUES
(1, 'webadmin', '$2y$10$cQh9QVmx8GZNxX4LV4aARuNiHK3ktrp2yMQSQOyih2urAH7dybqZq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinilos`
--

CREATE TABLE `vinilos` (
  `id_vinilo` int(11) NOT NULL,
  `vinilo` varchar(45) NOT NULL,
  `id_artista` int(11) NOT NULL,
  `precio` decimal(38,0) NOT NULL,
  `anio_lanzamiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vinilos`
--

INSERT INTO `vinilos` (`id_vinilo`, `vinilo`, `id_artista`, `precio`, `anio_lanzamiento`) VALUES
(2, 'Oktubre', 2, 18599, '1986-10-04'),
(3, 'Bocanada', 3, 34900, '1999-05-28'),
(19, 'Artaud', 1, 25149, '1989-10-07'),
(20, '¡Bang !Bang! Estás liquidado', 2, 19900, '1989-10-07'),
(28, 'Patria Al Hombro', 5, 15798, '1998-08-15'),
(29, 'Almafuerte', 5, 20599, '1998-08-15'),
(30, 'Fuerza Natural', 3, 35000, '2009-06-20'),
(31, 'Gulp!', 2, 24989, '1985-07-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD PRIMARY KEY (`id_artista`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `vinilos`
--
ALTER TABLE `vinilos`
  ADD PRIMARY KEY (`id_vinilo`),
  ADD KEY `fk_vinilos_artistas` (`id_artista`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artistas`
--
ALTER TABLE `artistas`
  MODIFY `id_artista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vinilos`
--
ALTER TABLE `vinilos`
  MODIFY `id_vinilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vinilos`
--
ALTER TABLE `vinilos`
  ADD CONSTRAINT `fk_vinilos_artistas` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
