-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.5.24-log - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando datos para la tabla publicidad.brand: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_brand` DISABLE KEYS */;
INSERT INTO `vol_brand` (`id`, `name`, `description`, `image`, `active`) VALUES
  (8, 'generica', 'generica', 'noimage.jpg', b'10000000');
/*!40000 ALTER TABLE `vol_brand` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.category: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_category` DISABLE KEYS */;
INSERT INTO `vol_category` (`id`, `name`, `description`, `image`, `active`) VALUES
  (8, 'ferreterias', 'ferreterias', 'noimage.jpg', b'10000000'),
  (9, 'cocinas', 'cocinas', 'noimage.jpg', b'10000000'),
  (10, 'boutique', 'boutique', 'noimage.jpg', b'10000000'),
  (11, 'fabrica', 'fabrica', 'noimage.jpg', b'10000000'),
  (12, 'limpieza', 'limpieza', 'noimage.jpg', b'10000000'),
  (13, 'reparto y entrega', 'reparto y entrega', 'noimage.jpg', b'10000000');
/*!40000 ALTER TABLE `vol_category` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.cms: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_cms` DISABLE KEYS */;
INSERT INTO `vol_cms` (`id`, `name`, `content`) VALUES
  (1, 'about', '<p>Acerca de nosotros. sdsd</p>\r\n');
/*!40000 ALTER TABLE `vol_cms` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.comment: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_comment` DISABLE KEYS */;
INSERT INTO `vol_comment` (`id`, `content`, `status`, `create_time`, `author`, `email`, `url`, `post_id`) VALUES
  (1, 'This is a test comment.', 2, 1230952187, 'Tester', 'tester@example.com', NULL, 2);
/*!40000 ALTER TABLE `vol_comment` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.lookup: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_lookup` DISABLE KEYS */;
INSERT INTO `vol_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
  (1, 'Draft', 1, 'PostStatus', 1),
  (2, 'Published', 2, 'PostStatus', 2),
  (3, 'Archived', 3, 'PostStatus', 3),
  (4, 'Pending Approval', 1, 'CommentStatus', 1),
  (5, 'Approved', 2, 'CommentStatus', 2);
/*!40000 ALTER TABLE `vol_lookup` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.newsletter: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_newsletter` DISABLE KEYS */;
INSERT INTO `vol_newsletter` (`id`, `name`, `email`, `created`) VALUES
  (1, 'asdf', 'mail@mail.com', '2014-09-11 02:01:47'),
  (2, 'asdf', 'calogeroboy@gmail.com', '2014-09-11 18:56:38');
/*!40000 ALTER TABLE `vol_newsletter` ENABLE KEYS */;


-- Volcando datos para la tabla publicidad.post: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_post` DISABLE KEYS */;
INSERT INTO `vol_post` (`id`, `title`, `content`, `tags`, `status`, `create_time`, `update_time`, `author_id`, `image`) VALUES
  (1, 'Welcome!', 'This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.\r\n\r\nFeel free to try this system by writing new posts and posting comments.', 'yii, blog', 2, 1230952187, 1398612809, 1, 'danish_design_iq11q925_-_1_203x258.jpg'),
  (2, 'A Test Post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'testing', 2, 1230952187, 1406396056, 1, 'carrito_plastico.jpg'),
  (17, 'nuevo', 'asdf', '', 2, 1398610398, 1398612768, 1, '5-4194.12.001_154x258.gif');
/*!40000 ALTER TABLE `vol_post` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.product: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_product` DISABLE KEYS */;
INSERT INTO `vol_product` (`id`, `code`, `name`, `description`, `price`, `image`, `tags`, `new`, `address`, `phone`, `email`, `web`, `map`, `type`, `brand_id`, `category_id`, `subcategory_id`, `active`, `video`, `color`, `in_stock`) VALUES
  (1, 'hrbasculas', 'hrbasculas', 'hrbasculas', 0.0000, 'hrbasculas.jpg', 'hr bascular', b'1', 'asdfa', '7128978', 'mail@mail.com', 'http://www.web.com', '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3621.6449480036067!2d-107.36799810000001!3d24.8076085!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86bcd75b44c16303%3A0x768d7bedb2613abe!2sCalle+Miguel+Hidalgo+y+Costilla%2C+Culiac%C3%A1n+Rosales%2C+SIN!5e0!3m2!1ses!2smx!4v1411369374132" width="600" height="450" frameborder="0" style="border:0"></iframe>', '', 8, 8, NULL, b'10000000', '', '', b'10000000'),
  (2, 'semillas_el_ranchito', 'semillas el ranchito', 'semillas el ranchito', 0.0000, 'semillas-ranchito.jpg', 'siembra semillas, campo', b'1', 'Miguel hgo', '7166009', 'semillasranchito@gmail.com', NULL, NULL, NULL, NULL, 8, NULL, b'10000000', NULL, NULL, b'10000000'),
  (3, 'todo_cocinas', 'todo cocinas', 'todo cocinas', 0.0000, 'todo_cocinas.jpg', 'todo cocinas', b'00000000', 'Benito Juarez 384 Pte. Centro', NULL, NULL, NULL, NULL, NULL, NULL, 9, NULL, b'10000000', NULL, NULL, b'10000000'),
  (4, 'cortinas_acero_sotel', 'cortinas acero sotelo', 'cortinas acero sotelo', 0.0000, 'cortinas_de_acero_carranza.jpg', 'cortinas acero sotelo', b'00000000', 'Benito Juarez 384 Pte. Centro ', NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, b'10000000', NULL, NULL, b'00000000'),
  (5, 'bizu', 'bizu', 'bizu', 0.0000, 'bizu-plata-accesorios.jpg', 'plata accesorios, fantasi fina', b'00000000', 'Miguel Hidalgo, centro, Culiacán, Sin. ', '', '', '', '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3621.6449480036067!2d-107.36799810000001!3d24.8076085!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86bcd75b44c16303%3A0x768d7bedb2613abe!2sCalle+Miguel+Hidalgo+y+Costilla%2C+Culiac%C3%A1n+Rosales%2C+SIN!5e0!3m2!1ses!2smx!4v1411369374132" width="600" height="450" frameborder="0" style="border:0"></iframe>', '', 8, 10, NULL, b'10000000', '', '', b'00000000'),
  (6, 'enigma', 'enigma boutique', 'enigma boutique', 0.0000, 'enigma-boutique.jpg', 'ropa blusas, moda, boutique', b'00000000', 'José María Morelos y Pavón 321, centro, Culiacán, Sin. ', NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, b'10000000', NULL, NULL, b'00000000'),
  (7, 'nino', 'nino sastreria', 'nino sastreria', 0.0000, 'nino.jpg', 'sastreria, trajes, medida', b'00000000', 'Miguel Hidalgo, centro, Culiacán, Sin. ', NULL, NULL, NULL, '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3621.6449480036067!2d-107.36799810000001!3d24.8076085!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86bcd75b44c16303%3A0x768d7bedb2613abe!2sCalle+Miguel+Hidalgo+y+Costilla%2C+Culiac%C3%A1n+Rosales%2C+SIN!5e0!3m2!1ses!2smx!4v1411438079334" width="600" height="450" frameborder="0" style="border:0"></iframe>', NULL, NULL, 10, NULL, b'10000000', NULL, NULL, b'00000000'),
  (9, 'escobera', 'escobera los frailes', 'escobera los frailes', 0.0000, 'escobera-los-frailes.jpg', 'fabrica escobas, limpieza de, articulos de limpieza, quimicos', b'00000000', 'José Ángel Águilar Barraza 130', '7161787', 'escoberalosfrailes@hotmail.com', 'http://www.escoberalosfrailes.com', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.851882871867!2d-107.387761006643!3d24.800524898402166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86bcd0b309dfbb7d%3A0xa1da154a887494f7!2sEscobera+Los+Frailes!5e0!3m2!1ses!2smx!4v1411371146575" width="600" height="450" frameborder="0" style="border:0"></iframe>', '', 8, 12, NULL, b'10000000', '', '', b'10000000'),
  (10, 'volante_en_linea', 'volante en linea', 'Agencia de reparto y entrega de volantes, perifoneo.', 0.0000, 'volante_en_linea.jpg', 'reparto, perifoneo, agencia de reparto culiacan, volantes reparto', b'00000000', 'Blvd. Universitarios 18 Pte Col. Tierra Blanca Culiacan, Sinaloa', '1726253', 'escoberalosfrailes@hotmail.com', 'http://volanteenlinea.com', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d905.2292521175856!2d-107.39532404535218!3d24.832511607650865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb43c11f8d618d86c!2sAgencia+de+Reparto+de+volantes!5e0!3m2!1ses!2smx!4v1411618806220" width="600" height="450" frameborder="0" style="border:0"></iframe>', '', 8, 13, NULL, b'10000000', '', '', b'10000000');
/*!40000 ALTER TABLE `vol_product` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.product_image: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_product_image` DISABLE KEYS */;
INSERT INTO `vol_product_image` (`id`, `product_id`, `image`, `title`, `alt`, `position`, `active`) VALUES
  (1, 10, 'volante_en_linea.jpg', '-', '-', 0, b'10000000');
/*!40000 ALTER TABLE `vol_product_image` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.product_specification: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_product_specification` DISABLE KEYS */;
INSERT INTO `vol_product_specification` (`id`, `product_id`, `name`, `value`, `description`, `active`) VALUES
  (46, 10, '44', '-', '-', b'10000000'),
  (47, 10, 'height', '-', '-', b'10000000'),
  (48, 10, 'large', '-', '-', b'10000000'),
  (49, 10, 'volume', '-', '-', b'10000000'),
  (50, 10, 'weight', '-', '-', b'10000000');
/*!40000 ALTER TABLE `vol_product_specification` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.slide: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_slide` DISABLE KEYS */;
INSERT INTO `vol_slide` (`id`, `image`, `alt`, `comment`, `position`, `width`, `height`, `active`) VALUES
  (190, 'highlights_holbi.png', '', '', 0, '', '', 1);
/*!40000 ALTER TABLE `vol_slide` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.specification: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_specification` DISABLE KEYS */;
INSERT INTO `vol_specification` (`id`, `name`) VALUES
  (1, 'weight'),
  (2, 'height'),
  (3, 'volume'),
  (4, 'large'),
  (5, '44');
/*!40000 ALTER TABLE `vol_specification` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.store: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_store` DISABLE KEYS */;
INSERT INTO `vol_store` (`id`, `name`, `address`, `image`, `image_hq`, `active`) VALUES
  (1, 'Tres rios', 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', 'jugueteria.jpg', 'noimage.jpg', b'00000000'),
  (2, 'senz', 'Plaza centenario los mochis.', 'senz-mochis.jpg', 'senz-mochis_hq.jpg', b'10000000'),
  (3, 'senz', 'Ley tres rios', 'senz-ley-tres-rios.jpg', 'senz-ley-tres-rios_hq.jpg', b'10000000');
/*!40000 ALTER TABLE `vol_store` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.tag: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_tag` DISABLE KEYS */;
INSERT INTO `vol_tag` (`id`, `name`, `frequency`) VALUES
  (3, 'nave', 1),
  (4, 'navidena', 1),
  (5, 'plota', 1),
  (6, 'plastico', 1);
/*!40000 ALTER TABLE `vol_tag` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.tag_blog: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_tag_blog` DISABLE KEYS */;
INSERT INTO `vol_tag_blog` (`id`, `name`, `frequency`) VALUES
  (1, 'yii', 1),
  (2, 'blog', 1),
  (4, 'asdf', 1),
  (5, 'testing', 1);
/*!40000 ALTER TABLE `vol_tag_blog` ENABLE KEYS */;

-- Volcando datos para la tabla publicidad.user: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `vol_user` DISABLE KEYS */;
INSERT INTO `vol_user` (`id`, `username`, `password`, `email`, `profile`) VALUES
  (1, 'demo', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 'webmaster@example.com', 'normal'),
  (2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'webmaster@example.com', 'admin');
/*!40000 ALTER TABLE `vol_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
