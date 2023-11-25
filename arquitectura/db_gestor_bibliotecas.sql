-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2023 at 03:01 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gestor_bibliotecas`
--

-- --------------------------------------------------------

--
-- Table structure for table `anuncios`
--

DROP TABLE IF EXISTS `anuncios`;
CREATE TABLE IF NOT EXISTS `anuncios` (
  `id_anuncio` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) DEFAULT NULL,
  `tipo_anuncio` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_anuncio`),
  KEY `fk_libro_anuncio` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `anuncios`
--

INSERT INTO `anuncios` (`id_anuncio`, `id_libro`, `tipo_anuncio`, `descripcion`) VALUES
(1, 46, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(2, 47, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(3, 48, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(5, 49, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(7, 51, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(8, 52, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(9, 53, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(10, 54, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(11, 55, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(12, 56, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(13, 57, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(14, 58, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(15, 59, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(16, 60, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(17, 61, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(18, 62, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(19, 63, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(20, 64, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(21, 64, 'Libro eliminado', 'El libro Libro prueba 1 ha sido removido de nuestra biblioteca'),
(22, 63, 'Libro eliminado', 'El libro El señor de los anillos ha sido removido de nuestra biblioteca'),
(23, 62, 'Libro eliminado', 'El libro Libro prueba 1 ha sido removido de nuestra biblioteca'),
(24, 65, 'Nuevo libro', 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'),
(25, 68, 'Nuevo libro', 'f ha sido agregado en nuestra biblioteca, puede que sea de su agrado'),
(26, 68, 'Libro eliminado', 'El libro f ha sido removido de nuestra biblioteca'),
(27, 67, 'Libro eliminado', 'El libro f ha sido removido de nuestra biblioteca'),
(28, 66, 'Libro eliminado', 'El libro f ha sido removido de nuestra biblioteca'),
(29, 69, 'Nuevo libro', 'Libro prueba 1 ha sido agregado en nuestra biblioteca, puede que sea de su agrado'),
(30, 69, 'Nuevo libro', 'Libro prueba 1 ha sido eliminado en nuestra biblioteca, puede que sea de su agrado'),
(31, 65, 'Nuevo libro', 'El señor de los anillos ha sido eliminado en nuestra biblioteca, puede que sea de su agrado'),
(32, 56, 'Nuevo libro', 'El retrato de Dorian Gray ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(33, 56, 'Nuevo libro', 'El retrato de Dorian Gray ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(34, 56, 'Nuevo libro', 'El retrato de Dorian Gray ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(35, 56, 'Nuevo libro', 'El retrato de Dorian Gray ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(36, 56, 'Nuevo libro', 'El retrato de Dorian Gray ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(37, 56, 'Nuevo libro', 'El retrato de Dorian Gray ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(38, 71, 'Nuevo libro', 'El señor de los anillos ha sido agregado en nuestra biblioteca, puede que sea de su agrado'),
(39, 71, 'Nuevo libro', 'El señor de los anillos ha sido eliminado en nuestra biblioteca, puede que sea de su agrado'),
(40, 70, 'Nuevo libro', 'El señor de los anillos ha sido eliminado en nuestra biblioteca, puede que sea de su agrado'),
(41, 55, 'Nuevo libro', 'El codigo Da Vinci ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(42, 54, 'Nuevo libro', 'El señor de los anillos ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(43, 53, 'Nuevo libro', 'La sombra del viento ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(44, 53, 'Nuevo libro', 'La sombra del viento ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(45, 55, 'Nuevo libro', 'El codigo Da Vinci ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(46, 55, 'Nuevo libro', 'El codigo Da Vinci ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(47, 72, 'Nuevo libro', 'Perfil_administrador2 ha sido agregado en nuestra biblioteca, puede que sea de su agrado'),
(48, 72, 'Nuevo libro', 'Perfil_administrador2 ha sido actualizado en nuestra biblioteca, puede que sea de su agrado'),
(49, 72, 'Nuevo libro', 'Perfil_administrador2 ha sido eliminado en nuestra biblioteca, puede que sea de su agrado'),
(50, 73, 'Nuevo libro', 's ha sido agregado en nuestra biblioteca, puede que sea de su agrado'),
(51, 73, 'Nuevo libro', 's ha sido eliminado en nuestra biblioteca, puede que sea de su agrado'),
(52, 74, 'Nuevo libro', 'El señor de los anillos ha sido agregado en nuestra biblioteca, puede que sea de su agrado'),
(53, 74, 'Nuevo libro', 'El señor de los anillos ha sido eliminado en nuestra biblioteca, puede que sea de su agrado'),
(54, 75, 'Nuevo libro', 'Libro prueba 1 ha sido agregado en nuestra biblioteca, puede que sea de su agrado');

-- --------------------------------------------------------

--
-- Table structure for table `autores`
--

DROP TABLE IF EXISTS `autores`;
CREATE TABLE IF NOT EXISTS `autores` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_autor` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `autores`
--

INSERT INTO `autores` (`id_autor`, `nombre_autor`) VALUES
(1, 'Autor prueba 1'),
(2, 'Autor prueba 2'),
(3, 'Autor prueba 3'),
(4, 'Autor prueba 4'),
(5, 'autor prueba 32'),
(6, 'prueba de autor 1'),
(7, 'Prueba Autor 2'),
(8, 'Benito Juarez'),
(9, ''),
(10, 'Vangoh'),
(11, 'E'),
(12, 'Fernando Anaquel'),
(13, 'Aa'),
(14, 'Yo'),
(15, 'Cervantes '),
(16, 'Pruebajaskjas'),
(17, 'Autor 1'),
(18, 'Aaa'),
(19, 'Ddd'),
(20, 'Ss'),
(21, 'Aaas'),
(22, 'Federico Juarez'),
(23, 'Aturo'),
(24, 'Fkk'),
(25, 'Pedro'),
(26, 'Carlos Ruiz ZafÃ³n'),
(27, 'Carlos Ruiz Zafon'),
(28, 'J.r.r. Tolkien'),
(29, 'Dan Brown'),
(30, ' Oscar Wilde'),
(31, 'S'),
(32, '3'),
(33, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
CREATE TABLE IF NOT EXISTS `generos` (
  `id_genero` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_genero` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `generos`
--

INSERT INTO `generos` (`id_genero`, `nombre_genero`) VALUES
(1, 'Ciencia ficción'),
(2, 'Aventuras'),
(3, 'Romance'),
(4, 'Misterio'),
(5, 'Fantasía'),
(6, 'Terror'),
(7, 'Histórico'),
(8, 'Infantil'),
(9, 'Juvenil'),
(10, 'Poesía'),
(11, 'Ensayo'),
(12, 'Biografía'),
(13, 'Autobiografía');

-- --------------------------------------------------------

--
-- Table structure for table `libros`
--

DROP TABLE IF EXISTS `libros`;
CREATE TABLE IF NOT EXISTS `libros` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` mediumtext COLLATE utf8mb4_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `prestamos_activos` int(11) DEFAULT '0',
  `fecha_publicacion` date NOT NULL,
  `id_autor` int(11) NOT NULL,
  `img_portada` mediumtext COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado_libro` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT 'ACTIVO',
  PRIMARY KEY (`id_libro`),
  KEY `fk_autor` (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `libros`
--

INSERT INTO `libros` (`id_libro`, `nombre`, `descripcion`, `stock`, `prestamos_activos`, `fecha_publicacion`, `id_autor`, `img_portada`, `estado_libro`) VALUES
(26, 'Libro prueba 4', 'Descripcion prueba 4', 500, 0, '2023-05-14', 4, 'portadas_libros/id_18_Libroprueba4_imagenEjemplo8.jpg', 'INACTIVO'),
(32, 'Las rosas', 'libro lleno de paz', 200, 0, '2023-05-15', 8, 'portadas_libros/id_20_Lasrosas_imagenEjemplo2.jpg', 'INACTIVO'),
(33, 'Cielo estrellado', 'Pintura', 30, 0, '2023-05-15', 10, 'portadas_libros/id_20_Cieloestrellado_imagenEjemplo7.jpg', 'INACTIVO'),
(34, 'Cielo estrellado', 'Pintura', 30, 0, '2023-04-28', 10, 'portadas_libros/id_12_Cielo estrellado_imagenEjemplo1.jpg', 'INACTIVO'),
(35, 'Cielo estrellado', 'Pintura', 30, 0, '2023-04-28', 10, 'portadas_libros/id_13_Cielo estrellado_imagenEjemplo1.jpg', 'INACTIVO'),
(39, 'aa', 'aa', 2, 0, '2023-04-29', 13, 'portadas_libros/id_13_aa_ca.png', 'INACTIVO'),
(40, 'registroPrueba', 'DescripcionPrueba', 4, 0, '2023-04-29', 14, 'portadas_libros/id_14_registroPrueba_imagenEjemplo.jpg', 'INACTIVO'),
(41, 'Llantos del mundo', 'Inspirador y muerte', 10, 0, '2023-04-29', 15, 'portadas_libros/id_15_Llantos del mundo_imagenEjemplo8.jpg', 'INACTIVO'),
(42, 'prueba', 'aa', 111, 0, '2023-04-29', 13, 'portadas_libros/id_16_prueba_imagenEjemplo2.jpg', 'INACTIVO'),
(45, 'pruebaError', 'descerror', 13, 0, '2023-04-29', 17, 'portadas_libros/id_19_pruebaError_imagenEjemplo2.jpg', 'INACTIVO'),
(46, 'pruebaanuncio', 'aaa', 133, 0, '2023-05-13', 21, 'portadas_libros/id_15_pruebaanuncio_imagenEjemplo3.jpg', 'INACTIVO'),
(47, 'pruebaanuncio', 'aaa', 133, 0, '2023-05-16', 21, 'portadas_libros/id_20_pruebaanuncio_imagenEjemplo2.jpg', 'INACTIVO'),
(48, 'Llantos del mundo', 'Inspirador y muerte', 10, 0, '2023-05-16', 15, 'portadas_libros/id_20_Llantosdelmundo_imagenEjemplo6.jpg', 'INACTIVO'),
(49, 'Sol', 'Explicacion de la funcion solar', 3, 0, '2023-05-15', 24, 'portadas_libros/id_20_Sol_imagenEjemplo4.jpg', 'INACTIVO'),
(50, 'PruebaImagen', 'desc', 13, 0, '2023-05-15', 25, 'portadas_libros/id_19_PruebaImagen_imagenEjemplo5.jpg', 'INACTIVO'),
(51, 'Fantasias', 'Descripcion prueba 1', 13, 0, '2023-05-16', 2, 'portadas_libros/id_20_Fantasias_imagenEjemplo8.jpg', 'INACTIVO'),
(52, 'La sombra del viento', 'En la Barcelona de posguerra, un joven llamado Daniel Sempere descubre un libro que cambiarÃ¡ su vida para siempre. Con la ayuda de su amigo FermÃ­n Romero de Torres, emprenderÃ¡ una bÃºsqueda llena de peligros y secretos para desentraÃ±ar la historia detrÃ¡s del misterioso autor del libro', 12, 0, '2023-05-17', 26, 'portadas_libros/id_21_Lasombradelviento_imagenEjemplo2.jpg', 'INACTIVO'),
(53, 'La sombra del viento', 'En la Barcelona de posguerra, un joven llamado Daniel Sempere descubre un libro que cambiara su vida para siempre. Con la ayuda de su amigo Fermin Romero de Torres, emprendera una busqueda llena de peligros y secretos para desentranar la historia detras del misterioso autor del libro', 12342, 0, '2023-05-18', 27, 'portadas_libros/id_30_Lasombradelviento_ca.png', 'ACTIVO'),
(54, 'El señor de los anillos', 'En un mundo de fantasia llamado la Tierra Media, un hobbit llamado Frodo Bolson es elegido para llevar un anillo magico al Monte del Destino para destruirlo y evitar que caiga en manos del malvado Sauron.', 14, 0, '2023-10-28', 28, 'portadas_libros/id_19_Elsenordelosanillos_imagenEjemplo8.jpg', 'ACTIVO'),
(55, 'El codigo Da Vinci', 'Robert Langdon es un profesor de simbologia que se ve envuelto en una peligrosa trama de conspiracion y secretos religiosos. Con la ayuda de la criptologa Sophie Neveu, debera descifrar los enigmas que hay detras de una serie de asesinatos.', 2033, 0, '2023-05-17', 29, 'portadas_libros/id_22_ElcodigoDaVinci_imagenEjemplo.jpg', 'ACTIVO'),
(56, 'El retrato de Dorian Gray', 'Dorian Gray es un joven apuesto y vanidoso que hace un pacto con el diablo para mantener su belleza para siempre. A medida que pasa el tiempo, su alma se corrompe y su retrato envejece en su lugar.', 5, 0, '2023-05-17', 30, 'portadas_libros/id_21_ElretratodeDorianGray_imagenEjemplo1.jpg', 'INACTIVO'),
(57, 'niñó', 'pruebá ññ', 14, 0, '2023-05-18', 1, 'portadas_libros/id_22_niñó_imagenEjemplo7.jpg', 'INACTIVO'),
(58, 'Libro prueba 1', 'Descripcion prueba 4', 13, 0, '2023-05-18', 1, 'portadas_libros/id_23_Libroprueba1_imagenEjemplo6.jpg', 'INACTIVO'),
(59, 'Libro prueba 1', 'Descripcion prueba 4', 13, 0, '2023-05-18', 1, 'portadas_libros/id_24_Libroprueba1_imagenEjemplo1.jpg', 'INACTIVO'),
(60, 'Libro prueba 1', 'Descripcion prueba 1', 13, 0, '2023-05-18', 1, 'portadas_libros/id_25_Libroprueba1_ca.png', 'INACTIVO'),
(61, 'Prueba_nombre', 'Descripcion prueba 431', 332, 0, '2023-05-20', 27, 'portadas_libros/id_26_Prueba_nombre_imagenEjemplo2.jpg', 'INACTIVO'),
(62, 'Libro prueba 1', 'Descripcion prueba 2', 4, 0, '2023-10-21', 1, 'portadas_libros/id_27_Libroprueba1_imagenEjemplo.jpg', 'INACTIVO'),
(63, 'El señor de los anillos', 'Descripcion prueba 2', 1111, 0, '2023-10-21', 3, 'portadas_libros/id_28_Elseñordelosanillos_imagenEjemplo1.jpg', 'INACTIVO'),
(64, 'Libro prueba 1', 'Descripcion prueba 2', 22, 0, '2023-10-21', 1, 'portadas_libros/id_29_Libroprueba1_imagenEjemplo1.jpg', 'INACTIVO'),
(65, 'El señor de los anillos', 'Descripcion prueba 2', 31, 0, '2023-11-08', 27, 'portadas_libros/id_30_Elseñordelosanillos_imagenEjemplo3.jpg', 'INACTIVO'),
(66, 'f', 'f', 42, 0, '2023-11-09', 33, 'portadas_libros/id_31_f_imagenEjemplo6.jpg', 'INACTIVO'),
(67, 'f', 'f', 42, 0, '2023-11-09', 33, 'portadas_libros/id_32_f_imagenEjemplo6.jpg', 'INACTIVO'),
(68, 'f', 'f', 42, 0, '2023-11-09', 33, 'portadas_libros/id_33_f_imagenEjemplo6.jpg', 'INACTIVO'),
(69, 'Libro prueba 1', 'Descripcion prueba 1', 13, 0, '2023-11-13', 1, 'portadas_libros/id_34_Libroprueba1_imagenEjemplo1.jpg', 'INACTIVO'),
(70, 'El señor de los anillos', 'Descripcion prueba 1', 13, 0, '2023-11-18', 1, 'portadas_libros/id_35_Elseñordelosanillos_imagenEjemplo5.jpg', 'INACTIVO'),
(71, 'El señor de los anillos', 'Descripcion prueba 1', 13, 0, '2023-11-18', 1, 'portadas_libros/id_36_Elseñordelosanillos_imagenEjemplo5.jpg', 'INACTIVO'),
(72, 'Perfil_administrador2', 'Descripcion prueba 1', 113, 0, '2023-11-19', 3, 'portadas_libros/id_37_Perfil_administrador2_imagenEjemplo2.jpg', 'INACTIVO'),
(73, 's', 's', 13, 0, '2023-11-25', 31, 'portadas_libros/id_38_s_imagenEjemplo1.jpg', 'INACTIVO'),
(74, 'El señor de los anillos', 'ss', 13, 0, '2023-11-25', 31, 'portadas_libros/id_39_Elseñordelosanillos_imagenEjemplo2.jpg', 'INACTIVO'),
(75, 'Libro prueba 1', 's', 12, 0, '2023-11-25', 31, 'portadas_libros/id_40_Libroprueba1_imagenEjemplo1.jpg', 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `libros_generos`
--

DROP TABLE IF EXISTS `libros_generos`;
CREATE TABLE IF NOT EXISTS `libros_generos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_generos` (`id_genero`),
  KEY `fk_libros` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `libros_generos`
--

INSERT INTO `libros_generos` (`id`, `id_libro`, `id_genero`) VALUES
(5, 32, 1),
(6, 32, 2),
(13, 33, 1),
(14, 33, 2),
(15, 33, 8),
(16, 33, 13),
(17, 34, 1),
(18, 34, 2),
(19, 34, 8),
(20, 34, 13),
(21, 35, 1),
(22, 35, 2),
(23, 35, 8),
(24, 35, 13),
(41, 39, 2),
(42, 39, 3),
(43, 40, 2),
(44, 40, 3),
(45, 40, 8),
(46, 40, 9),
(47, 41, 1),
(48, 41, 2),
(49, 41, 8),
(50, 41, 9),
(56, 45, 2),
(57, 45, 3),
(58, 45, 6),
(59, 45, 7),
(60, 45, 8),
(61, 46, 1),
(62, 46, 2),
(63, 46, 3),
(64, 47, 1),
(65, 47, 2),
(66, 47, 3),
(67, 48, 1),
(68, 48, 2),
(69, 48, 8),
(70, 48, 9),
(71, 48, 11),
(76, 26, 1),
(77, 26, 2),
(78, 32, 1),
(79, 32, 2),
(83, 42, 1),
(84, 42, 2),
(85, 42, 1),
(86, 42, 2),
(87, 42, 6),
(88, 42, 7),
(89, 48, 1),
(90, 48, 2),
(91, 48, 8),
(92, 48, 9),
(93, 48, 11),
(94, 48, 1),
(95, 48, 2),
(96, 48, 8),
(97, 48, 9),
(98, 48, 11),
(99, 26, 1),
(100, 26, 2),
(101, 26, 1),
(102, 26, 2),
(103, 26, 1),
(104, 26, 2),
(105, 26, 1),
(106, 26, 2),
(107, 49, 1),
(108, 49, 2),
(109, 49, 8),
(110, 50, 1),
(111, 50, 8),
(112, 50, 9),
(113, 33, 1),
(114, 33, 2),
(115, 33, 8),
(116, 33, 13),
(117, 32, 1),
(118, 32, 2),
(122, 49, 1),
(123, 49, 2),
(124, 49, 8),
(125, 48, 1),
(126, 48, 2),
(127, 48, 8),
(128, 48, 9),
(129, 48, 11),
(130, 47, 1),
(131, 47, 2),
(132, 47, 3),
(133, 51, 1),
(134, 51, 2),
(135, 51, 9),
(136, 51, 1),
(137, 51, 2),
(138, 51, 8),
(139, 51, 9),
(140, 51, 10),
(141, 26, 3),
(142, 26, 4),
(145, 52, 1),
(146, 52, 2),
(147, 52, 3),
(148, 53, 1),
(149, 53, 4),
(152, 54, 1),
(153, 54, 5),
(154, 54, 9),
(155, 54, 10),
(156, 55, 4),
(157, 55, 11),
(158, 55, 12),
(159, 56, 7),
(160, 56, 8),
(161, 56, 9),
(162, 57, 1),
(163, 57, 2),
(164, 58, 1),
(165, 58, 2),
(166, 58, 9),
(167, 59, 1),
(168, 59, 2),
(169, 59, 9),
(170, 60, 1),
(171, 60, 2),
(172, 60, 7),
(173, 60, 8),
(174, 61, 1),
(175, 61, 2),
(176, 61, 13),
(177, 62, 6),
(178, 63, 1),
(179, 63, 3),
(180, 64, 6),
(181, 64, 7),
(188, 54, 2),
(189, 65, 1),
(190, 65, 8),
(191, 65, 13),
(192, 67, 1),
(193, 68, 1),
(194, 69, 1),
(195, 69, 6),
(196, 56, 3),
(197, 56, 7),
(198, 56, 8),
(199, 56, 9),
(200, 56, 2),
(201, 56, 3),
(202, 56, 7),
(203, 56, 8),
(204, 56, 9),
(205, 56, 2),
(206, 56, 3),
(207, 56, 7),
(208, 56, 8),
(209, 56, 9),
(210, 56, 2),
(211, 56, 3),
(212, 56, 7),
(213, 56, 8),
(214, 56, 9),
(215, 56, 2),
(216, 56, 3),
(217, 56, 7),
(218, 56, 8),
(219, 56, 9),
(220, 56, 2),
(221, 56, 3),
(222, 56, 7),
(223, 56, 8),
(224, 56, 9),
(225, 71, 1),
(226, 71, 2),
(227, 55, 4),
(228, 55, 11),
(229, 55, 12),
(230, 54, 1),
(231, 54, 2),
(232, 54, 5),
(233, 54, 6),
(234, 54, 9),
(235, 54, 10),
(236, 53, 1),
(237, 53, 4),
(238, 53, 1),
(239, 53, 4),
(240, 55, 4),
(241, 55, 11),
(242, 55, 12),
(243, 55, 4),
(244, 55, 11),
(245, 55, 12),
(246, 72, 1),
(247, 72, 3),
(248, 72, 9),
(249, 72, 1),
(250, 72, 3),
(251, 72, 6),
(252, 72, 7),
(253, 72, 9),
(254, 73, 1),
(255, 73, 2),
(256, 74, 3),
(257, 74, 4),
(258, 75, 3),
(259, 75, 5);

-- --------------------------------------------------------

--
-- Table structure for table `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
CREATE TABLE IF NOT EXISTS `prestamos` (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) NOT NULL,
  `cc_usuario` int(11) NOT NULL,
  `fecha_prestamo` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_max_devolucion` timestamp NULL DEFAULT NULL,
  `estado_prestamo` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT 'NO ENTREGADO',
  `fecha_entrega` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_prestamo`),
  KEY `fk_id_libro` (`id_libro`),
  KEY `fk_cc_usuarios` (`cc_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `id_libro`, `cc_usuario`, `fecha_prestamo`, `fecha_max_devolucion`, `estado_prestamo`, `fecha_entrega`) VALUES
(1, 53, 1313, '2023-05-19 02:22:17', '2023-05-22 02:22:17', 'ENTREGADO', NULL),
(2, 53, 123456, '2023-05-19 16:29:09', '2023-05-22 16:29:09', 'ENTREGADO', NULL),
(3, 55, 123456, '2023-05-19 16:29:30', '2023-05-22 16:29:30', 'ENTREGADO', NULL),
(4, 53, 123456, '2023-05-19 16:29:36', '2023-05-22 16:29:36', 'ENTREGADO', NULL),
(5, 59, 123456, '2023-05-19 16:29:43', '2023-05-22 16:29:43', 'NO ENTREGADO', NULL),
(6, 53, 123456, '2023-05-19 16:29:48', '2023-05-22 16:29:48', 'ENTREGADO', '2023-05-19 20:38:56'),
(7, 53, 12345, '2023-10-31 01:27:06', '2023-11-03 01:27:06', 'ENTREGADO', NULL),
(8, 53, 4, '2023-11-13 22:44:43', '2023-11-16 22:44:43', 'ENTREGADO', NULL),
(9, 53, 2, '2023-11-18 20:43:29', '2023-11-21 20:43:29', 'ENTREGADO', NULL),
(10, 55, 2, '2023-11-18 20:51:12', '2023-11-21 20:51:12', 'ENTREGADO', NULL),
(11, 55, 2, '2023-11-18 20:55:30', '2023-11-21 20:55:30', 'ENTREGADO', NULL),
(12, 55, 2, '2023-11-18 21:07:31', '2023-11-21 21:07:31', 'ENTREGADO', NULL),
(13, 55, 2, '2023-11-18 21:07:38', '2023-11-21 21:07:38', 'ENTREGADO', NULL),
(14, 55, 4, '2023-11-18 21:13:45', '2023-11-21 21:13:45', 'NO ENTREGADO', NULL),
(15, 55, 4, '2023-11-18 21:13:54', '2023-11-21 21:13:54', 'NO ENTREGADO', NULL);

--
-- Triggers `prestamos`
--
DROP TRIGGER IF EXISTS `tr_agregar_fecha`;
DELIMITER $$
CREATE TRIGGER `tr_agregar_fecha` BEFORE INSERT ON `prestamos` FOR EACH ROW BEGIN
    SET NEW.fecha_max_devolucion = DATE_ADD(NOW(), INTERVAL 3 DAY);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `cedula` int(20) NOT NULL,
  `nombre` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_1` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_2` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL,
  `passw` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL,
  `correo` varchar(80) COLLATE utf8mb4_spanish_ci NOT NULL,
  `prestamos_activos` int(11) DEFAULT '0',
  `puntaje` int(11) DEFAULT '3',
  `estado_cuenta` tinyint(1) DEFAULT '1',
  `tipo_usuario` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT 'DEFAULT',
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `nombre`, `apellido_1`, `apellido_2`, `passw`, `correo`, `prestamos_activos`, `puntaje`, `estado_cuenta`, `tipo_usuario`) VALUES
(2, '2', '2', '2', '5', '5@gmail.com', 4, 3, 1, 'DEFAULT'),
(4, '1', '2', '3', '7', '5@gmail.com', 3, 2, 1, 'DEFAULT'),
(6, '6', '6', '6', '6', '6@gmail.com', 0, 3, 1, 'DEFAULT'),
(123, 'Perfil_administrador22', 'Apellido_admin2', 'Apellido_admin', '123', 'correo@gmail.com', 2, -1, 1, 'ADMIN'),
(1313, 'Prueba', 'Primer_apellido_prueba', 'Segundo_apellido_2', '12345', 'correo@correo.com', 5, -44, 1, 'DEFAULT'),
(5555, 'Adriana', 'Perez', 'Tabotda', '5555', 's@colombo.com', 0, 3, 1, 'DEFAULT'),
(11111, '2', '2', '2', '11111', 's@colombo.com', 0, 3, 1, 'DEFAULT'),
(12345, 'Armansex', 'Xxx', 'Xxx', '12345', 'armansex@gmail.com', 1, -1, 1, 'DEFAULT'),
(54321, 'Fabricio Enrriqe', 'Puello', 'Martinez', '12345', 'correo@correo.com', 0, 3, 1, 'DEFAULT'),
(123456, 'Prueba_nombre22', 'Prueba_apellido', 'Prueba_apellido_2', '123456', 'prueba@gmail.com', 5, 0, 1, 'DEFAULT'),
(131333, 'Prueba2', 'Aa', 'Aa', 'aaa', 'hola@gmail.com', 0, 3, 1, 'DEFAULT'),
(1111111, '1111', '111', '111', '3131', 'correo@correo.com', 0, 3, 1, 'DEFAULT'),
(1043962900, 'Juan', 'De La Puente', 'Garcia', '12345', 'juan.puente@gmail.com', 3, 3, 1, 'DEFAULT');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `fk_libro_anuncio` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `fk_autor` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `libros_generos`
--
ALTER TABLE `libros_generos`
  ADD CONSTRAINT `fk_generos` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_libros` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `fk_cc_usuarios` FOREIGN KEY (`cc_usuario`) REFERENCES `usuarios` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_libro` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
