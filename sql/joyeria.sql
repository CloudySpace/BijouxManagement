-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2018 at 12:00 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joyeria`
--

-- --------------------------------------------------------

--
-- Table structure for table `almacen`
--

DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `almacen`
--

INSERT INTO `almacen` (`id`, `name`, `ubicacion`) VALUES
(1, 'Joyería 1', 'Boulevard Marcelino 2558'),
(2, 'Bejeweled', 'Paseo del Unicornio 666'),
(3, 'Joyas y Gemas', 'Avenida del Tesoro 333');

-- --------------------------------------------------------

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_Almacen` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `un_user` (`username`),
  KEY `FK_idPerfil` (`id_perfil`),
  KEY `FK_idAlmacen` (`id_Almacen`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `empleado`
--

INSERT INTO `empleado` (`id`, `id_perfil`, `name`, `username`, `password`, `id_Almacen`) VALUES
(1, 1, 'Yannick', 'yannadmin', '123456789', 1),
(2, 2, 'Gustavo', 'gus', '987654321', 1),
(3, 1, 'Carlos', 'carlitossss', '13579', 1),
(4, 2, 'John Doe', 'john', '111', 2),
(5, 1, 'Mary Jane', 'mary', '222', 3),
(6, 1, 'Kat', 'kat', 'k', 2),
(7, 2, 'Juan', 'juan', 'j', 3);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `quilataje` float(5,3) NOT NULL,
  `peso` float(6,3) NOT NULL,
  `id_Almacen` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_idAlmacenMaterial` (`id_Almacen`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `name`, `quilataje`, `peso`, `id_Almacen`) VALUES
(1, 'oro', 18.000, 200.000, 1),
(2, 'plata', 12.000, 100.000, 1),
(3, 'platino', 0.710, 300.000, 2),
(4, 'oro', 1.300, 500.000, 3),
(5, 'oro', 18.000, 200.000, 2),
(6, 'plata', 12.000, 100.000, 3),
(7, 'platino', 0.710, 300.000, 1),
(8, 'plata', 12.000, 100.000, 2),
(9, 'platino', 0.710, 300.000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
CREATE TABLE IF NOT EXISTS `registro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_Almacen` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_idAlmacenRegistro` (`id_Almacen`),
  KEY `fk_empleado_registro` (`id_empleado`),
  KEY `fk_material_registro` (`id_material`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `registro`
--

INSERT INTO `registro` (`id`, `id_empleado`, `id_material`, `peso`, `fecha_actualizacion`, `id_Almacen`) VALUES
(1, 2, 1, 50, '2018-11-06 19:54:55', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `FK_idAlmacen` FOREIGN KEY (`id_Almacen`) REFERENCES `almacen` (`id`),
  ADD CONSTRAINT `FK_idPerfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `FK_idAlmacenMaterial` FOREIGN KEY (`id_Almacen`) REFERENCES `almacen` (`id`);

--
-- Constraints for table `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `FK_idAlmacenRegistro` FOREIGN KEY (`id_Almacen`) REFERENCES `almacen` (`id`),
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `material` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
