-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bmbshoes
CREATE DATABASE IF NOT EXISTS `bmbshoes` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bmbshoes`;

-- Dumping structure for table bmbshoes.contact
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `hour` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bmbshoes.contact: ~0 rows (approximately)

-- Dumping structure for table bmbshoes.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bmbshoes.products: ~7 rows (approximately)
INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`) VALUES
	(2, 'New Balance 9060', 179.99, 'Mejora tu velocidad y agilidad con las New Balance 9060. Estas zapatillas, envueltas en malla transpirable, cuentan con refuerzos de ante de cerdo para hacer que tus carreras resulten tan elegantes como cómodas. El dispositivo CR translúcido de control de movimiento en el talón es una alusión a los orígenes de la serie 99X y ofrece un aspecto moderno de proporciones exageradas. La entresuela de doble densidad, dotada de amortiguación ABZORB y SBS, favorece la sujeción y el control de la pisada. La suela con diseño de rombos garantiza la adherencia y tracción adecuadas, para que irradies confianza dondequiera que vayas.', 'https://images.footlocker.com/is/image/FLEU/314215810004_01?wid=581&hei=581&fmt=png-alpha'),
	(3, 'Nike Air Max Tuned 1 OG', 189.99, 'Recupera la tradición del running a cada paso con las Nike Air Max Plus OG. Retomando lo mejor de las emblemáticas zapatillas Nike del pasado, estas zapatillas AM hacen un guiño al modernismo retro. La parte superior combina piel sintética y malla para ofrecer, al mismo tiempo, flexibilidad y transpirabilidad. Situada en el talón y el antepié, la característica cámara de aire Max Air garantiza amortiguación y energía a tus zancadas. La suela de goma, de gran tracción y adherencia, te prepara para avanzar hacia un futuro prometedor.', 'https://images.footlocker.com/is/image/FLEU/314208017104_01?wid=581&hei=581&fmt=png-alpha'),
	(4, 'Jordan Retro 3', 209.99, 'Demuestra quién manda cada vez que salgas a la cancha con las Air Jordan 3 Retro. Estas emblemáticas zapatillas AJ, de líneas limpias y clásicas, conservan la elegancia del modelo original y la combinan con un look renovado. La mezcla de piel de primera calidad y material sintético de la parte superior ofrece durabilidad, para que puedas presumir de estilo y disfrutar de la máxima flexibilidad. La cámara de aire Air-Sole, presente tanto en el talón como en el antepié, hará que disfrutes de un confort y amortiguación sin precedentes dondequiera que vayas. Además, su sólida suela de goma, diseñada para ofrecer una tracción y agarre óptimos, harán que puedas caminar con total confianza, mientras presumes de un estilo envidiable.', 'https://images.footlocker.com/is/image/FLEU/314105825104_01?wid=581&hei=581&fmt=png-alpha'),
	(5, 'adidas Samba OG', 119.99, 'Las adidas Samba OG, diseñadas para los campos de fútbol y para revolucionar las calles, son un modelo realmente versátil. Estas zapatillas de cuero plena flor se mantienen fieles al legado de Samba de la marca y ofrecen el doble de resistencia y flexibilidad. Los refuerzos de ante rugoso y los detalles en dorado aportan un aire vanguardista a la vez que deportivo a tus pasos. El interior de la zapatilla está confeccionado en un forro de piel sintética que proporciona la máxima comodidad. Las zapatillas adidas Samba OG, acabadas con entresuela y suela de goma, mantienen tus pasos bien acolchados y proporcionan el máximo agarre para que disfrutes de tus días con total confianza.', 'https://images.footlocker.com/is/image/FLEU/314310389904_01?wid=581&hei=581&fmt=png-alpha'),
	(6, 'Jordan 1 Retro High OG', 189.99, 'Reinventar un clásico es todo un arte, y las Air Jordan 1 Retro High OG son el perfecto ejemplo de ello. Estas zapatillas rediseñadas, una versión moderna de un favorito de todos los tiempos, inyectarán un nuevo aire a tu colección diaria. La resistente parte superior de piel, con el logotipo Swoosh cosido, encarna el legado de Jordan con estilo. La unidad Air-Sole encapsulada se une a la espuma de la entresuela para ofrecer una amortiguación insuperable y una excelente capacidad de respuesta a tus pisadas. La resistente suela de goma, diseñada para ofrecer una adherencia y tracción excelentes, te permitirá disfrutar de un estilo tan retro como futurista.', 'https://images.footlocker.com/is/image/FLEU/314105778204_01?wid=581&hei=581&fmt=png-alpha'),
	(7, 'Nike Air Force 1 Low', 119.99, 'Con un estilo atrevido y muy cómodas, las Nike Air Force 1 ’07 siguen el mismo camino que el resto de la icónica familia de las Air Force. Las zapatillas, diseñadas inicialmente para el baloncesto, combinan la mejor funcionalidad deportiva con el clásico estilo urbano. Domina las calles con una de las zapatillas más populares de la historia.', 'https://images.footlocker.com/is/image/FLEU/314102253904_01?wid=581&hei=581&fmt=png-alpha'),
	(8, 'Nike Dunk Low', 119.99, 'Las Dunk, creadas para la cancha y adaptadas al estilo urbano, vuelven con detalles clásicos y un estilo de baloncesto retro. La zona del tobillo acolchada y de perfil bajo y el diseño vintage ofrecen comodidad en cualquier lugar.VentajasParte superior que envejece para una perfección suave y un diseño duradero que recuerda al baloncesto de los 80.Mediasuela de espuma que ofrece una amortiguación reactiva y ligera.Zona del tobillo acolchada de perfil bajo para ofrecer un look elegante y cómodo.Suela exterior de goma con el punto de giro clásico de baloncesto para una mayor durabilidad, tracción y un estilo retro.Nike Dunkb>Nacidas de la combinación de mezclas, mejoras y fechas límite, las Nike Dunk llegaron a las canchas de baloncesto universitarias en la temporada 85-86. A pesar de que los diseños originales con el color de la universidad mantenían la fidelidad a tu institución, las Dunk no fueron muy populares. No obstante, la falta de popularidad de estas humildes zapatillas (y sus suelas planas y adherentes) conquistaron a los skaters. Décadas más tarde, este favorito para el día a día sigue luciendo innumerables combinaciones de colores, lo que demuestra su influencia.', 'https://images.footlocker.com/is/image/FLEU/314106127104_01?wid=581&hei=581&fmt=png-alpha');

-- Dumping structure for table bmbshoes.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `passwd` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bmbshoes.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `username`, `passwd`) VALUES
	(1, 'admin', '$2y$10$hTC8K2nPiqgd5sxfomQDpOuZh7QRRBy/VCWfAQRemiIRnWIRE7cW.');

-- Dumping structure for table bmbshoes.user_details
CREATE TABLE IF NOT EXISTS `user_details` (
  `user_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_details_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bmbshoes.user_details: ~1 rows (approximately)
INSERT INTO `user_details` (`user_details_id`, `user_id`, `username`, `name`, `surname`, `address`, `tel`, `email`) VALUES
	(1, 1, 'admin', '', '', '', '', '');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;


-- ESTO ES UNA PRUEBA en MAIN