-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2025 a las 18:49:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurant`
--
CREATE DATABASE IF NOT EXISTS `restaurant` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `restaurant`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dishes`
--

CREATE TABLE `dishes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `description`, `price`, `discount`, `image`) VALUES
(127, 'ramen', 'super picante', 40.00, 10, 'imagen-6908bc913e36c.'),
(128, 'sushi', 'que contenga salsa bbq', 50.00, 0, 'imagen-6908bfa9c50bc.png'),
(129, 'Yakitori', 'una brocheta mas extra y salsa de soya', 30.00, 0, 'imagen-690954dd523a3.avif'),
(130, 'Curry', 'Carne apanado y con picante', 36.00, 10, 'imagen-6909576e86ecd.jpg'),
(131, 'Tonkatsu', 'Arroz extra y una porcion de sopa miso con tofu', 48.00, 0, 'imagen-690957cdb3808.jpg'),
(132, 'Yakisoba', 'que tenga mas col y ketchupz alrededor y una cola de bebida', 55.00, 0, 'imagen-6909585b29602.jpg'),
(133, 'Sake', '2 bebidad sake con 3 vasos y de acompañamiento una porcion de mochi', 135.00, 0, 'imagen-690958eb0b3c0.jpg'),
(134, 'ramen', 'picante, con tofu y con extra carne y un poco mas de cadlo', 60.00, 10, 'imagen-692366c85d9aa.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `perfil` int(11) NOT NULL,
  `imagen` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `email`, `password`, `perfil`, `imagen`) VALUES
(2, 'Maria', 'Camargo', 'Maria@gmail.com', '$2y$10$RF/HDaa2MfO1e7u2SNnsFeBOVJmV6B/hvYOfLcr0u0FP5g1Ugmqgm', 2, 'avatar-69235b5985a8e.avif'),
(3, 'Jose', 'Sanchez', 'jose@gmail.com', '$2y$10$xtFXxsXa1sJdKxyGxHCXk.d3YG6nXpg0Z2mtAMXQJGVNdOnfe4d1m', 2, 'avatar-69236a5dcfb11.'),
(4, 'Marcos', 'Lozno', 'marcos@gmail.com', '$2y$10$yYX2JMm78OeHNMlWJB17fe/SmNza0ffEZECR0OYyhUlMYXVmQNV02', 2, 'avatar-69236d03c2a0c.'),
(5, 'katherine', 'andrade', 'kathy@gmail.com', '$2y$10$zMffCmzbvNC.r4sydryHS.geukxNOsNdsUS0/shedPMqQVISprR7K', 2, 'avatar-69236d7a3f767.png'),
(6, 'Susana', 'gonzales', 'susana@gmail.com', '$2y$10$3KxLfCkKfi8/q2fDdoNAceX8d4G0lSzF4bRTDN4SZOTpAl76klB2a', 2, 'avatar-69236e4993949.webp'),
(7, 'Lucas', 'Vasquez', 'lucas@gmail.com', '$2y$10$GpA4gHZ18EaUTYV0AM8zmu7ZEpYQBvylTunXxjWvQJIYP09ztDmoq', 9, 'avatar-693f60d69f35c.webp'),
(8, 'juan', 'Ruiz ', 'jcruiz23lazo@gmail.com', '12345678', 2, NULL),
(10, 'Angel Daniel', 'Fuentes', 'angel.daniel.fuentes.segura@gmail.com', '$2y$10$/u6kWqXA67nOlFLJhRXkLuIGCbYAnVA9QKTRyK5OwEeLRHza308yG', 2, 'avatar-6940490994187.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
