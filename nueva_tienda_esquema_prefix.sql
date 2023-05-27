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

-- Volcando estructura para tabla {prefix}brand
CREATE TABLE IF NOT EXISTS `{prefix}brand` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(80) NOT NULL DEFAULT 'noimage.jpg',
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}category
CREATE TABLE IF NOT EXISTS `{prefix}category` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(80) NOT NULL DEFAULT 'noimage.jpg',
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='almacena las categorias o clasificadores de la tienda\r\n';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}category_sub
CREATE TABLE IF NOT EXISTS `{prefix}category_sub` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `category_id` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(80) NOT NULL DEFAULT 'noimage.jpg',
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `FK_{prefix}category_sub_category` (`category_id`),
  CONSTRAINT `FK_{prefix}category_sub_category` FOREIGN KEY (`category_id`) REFERENCES `{prefix}category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='almacena las subcategorias o clasificadores de la tienda\r\n';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}cms
CREATE TABLE IF NOT EXISTS `{prefix}cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='contenedor para las paginas de contenido como ''acerca de''';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}comment
CREATE TABLE IF NOT EXISTS `{prefix}comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_{prefix}comment_post` (`post_id`),
  CONSTRAINT `FK_{prefix}comment_post` FOREIGN KEY (`post_id`) REFERENCES `{prefix}post` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}lookup
CREATE TABLE IF NOT EXISTS `{prefix}lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}newsletter
CREATE TABLE IF NOT EXISTS `{prefix}newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='almacena las suscripciones a newsletter';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}post
CREATE TABLE IF NOT EXISTS `{prefix}post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `image` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'noimage.jpg',
  PRIMARY KEY (`id`),
  KEY `FK_{prefix}post_user` (`author_id`),
  CONSTRAINT `FK_{prefix}post_user` FOREIGN KEY (`author_id`) REFERENCES `{prefix}user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}product
CREATE TABLE IF NOT EXISTS `{prefix}product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `image` varchar(50) NOT NULL DEFAULT 'noimage.jpg',
  `tags` text,
  `new` bit(1) DEFAULT b'0',
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `web` varchar(120) DEFAULT NULL,
  `map` varchar(1000) DEFAULT NULL,
  `type` varchar(120) DEFAULT NULL COMMENT 'puede ser un producto de tipo caucho o esponja, o cuchillo tipo cebollero, o balon tipo nfl, etc.',
  `brand_id` int(11) DEFAULT NULL,
  `category_id` smallint(6) DEFAULT NULL,
  `subcategory_id` smallint(6) DEFAULT NULL,
  `active` bit(1) DEFAULT b'1',
  `video` varchar(255) DEFAULT NULL,
  `color` varchar(80) DEFAULT NULL COMMENT 'de que color es el producto aqui se guarda esa informacion',
  `in_stock` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `FK_{prefix}product_category` (`category_id`),
  KEY `FK_{prefix}product_subcategory` (`subcategory_id`),
  KEY `FK_{prefix}product_brand` (`brand_id`),
  CONSTRAINT `FK_{prefix}product_brand` FOREIGN KEY (`brand_id`) REFERENCES `{prefix}brand` (`id`),
  CONSTRAINT `FK_{prefix}product_category` FOREIGN KEY (`category_id`) REFERENCES `{prefix}category` (`id`),
  CONSTRAINT `FK_{prefix}product_subcategory` FOREIGN KEY (`subcategory_id`) REFERENCES `{prefix}category_sub` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}product_color
CREATE TABLE IF NOT EXISTS `{prefix}product_color` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id_show` int(10) NOT NULL COMMENT 'producto al que hace referencia cada color es un producto diferente, es el link para que el color te envie a ese producto cuando se haga clic en el.',
  `product_id_from` int(10) NOT NULL COMMENT 'es el producto en el que se van a mostrar los colores.',
  `code` varchar(12) NOT NULL COMMENT 'codigo de color en hexadecimal o alfanumerico',
  `name` varchar(20) NOT NULL COMMENT 'nombre del color, por ejemplo azul, verde, violeta',
  PRIMARY KEY (`id`),
  KEY `FK_{prefix}product_color_product` (`product_id_show`),
  KEY `FK_{prefix}product_color_product_2` (`product_id_from`),
  CONSTRAINT `FK_{prefix}product_color_product` FOREIGN KEY (`product_id_show`) REFERENCES `{prefix}product` (`id`),
  CONSTRAINT `FK_{prefix}product_color_product_2` FOREIGN KEY (`product_id_from`) REFERENCES `{prefix}product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='colores dispnibles por producto. la idea es incluir en la vista de producto una funcionalidad para poder seleccionar aquellos otros\r\ncolores en que esta disponible el producto y relacionarlos a un producto en particular ya que cada color es un producto diferente,\r\ntambien en esa misma vista se tomar[a el color por default del producto actual.';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}product_image
CREATE TABLE IF NOT EXISTS `{prefix}product_image` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL DEFAULT '0',
  `image` varchar(80) NOT NULL DEFAULT 'noimage.jpg',
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT 'leyenda flotante cuando se pasa el mouse por encima de la imagen',
  `alt` varchar(80) NOT NULL DEFAULT '' COMMENT 'titulo alternativo para cuando la imagen no este disponible',
  `position` tinyint(4) NOT NULL DEFAULT '0',
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `FK_{prefix}product_image_product` (`product_id`),
  CONSTRAINT `FK_{prefix}product_image_product` FOREIGN KEY (`product_id`) REFERENCES `{prefix}product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='contenedor de las imagenes por producto';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}product_info
CREATE TABLE IF NOT EXISTS `{prefix}product_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL COMMENT 'es el id del producto relacionado a este tab',
  `label` varchar(80) NOT NULL,
  `content` text NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='aqui se guardara la informacion relativa al producto y se mostrara en forma de tabs o pills en la vista product / detail';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}product_specification
CREATE TABLE IF NOT EXISTS `{prefix}product_specification` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT NULL,
  `name` varchar(80) NOT NULL DEFAULT '',
  `value` varchar(80) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `FK_{prefix}product_specification_product` (`product_id`),
  CONSTRAINT `FK_{prefix}product_specification_product` FOREIGN KEY (`product_id`) REFERENCES `{prefix}product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='son las especificaciones del producto por ejemplo\r\npuede ser peso, volumen, ancho, alto, largo, material, uso., manejo, etc.';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}slide
CREATE TABLE IF NOT EXISTS `{prefix}slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(50) NOT NULL DEFAULT 'noimage.jpg',
  `alt` varchar(120) NOT NULL COMMENT 'alternative text to show',
  `comment` varchar(500) NOT NULL COMMENT 'comentario o descripcion de la imagen',
  `position` smallint(6) NOT NULL DEFAULT '0',
  `width` varchar(10) NOT NULL DEFAULT '1116px',
  `height` varchar(10) NOT NULL DEFAULT '338px',
  `active` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='slider to show images.';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}specification
CREATE TABLE IF NOT EXISTS `{prefix}specification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='contenedor para especificaciones del producto, como weight, height, size, volume';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}store
CREATE TABLE IF NOT EXISTS `{prefix}store` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(80) NOT NULL DEFAULT 'noimage.jpg',
  `image_hq` varchar(80) NOT NULL DEFAULT 'noimage.jpg',
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='almacena las ubicaciones de las tiendas';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}tag
CREATE TABLE IF NOT EXISTS `{prefix}tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}tag_blog
CREATE TABLE IF NOT EXISTS `{prefix}tag_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}type
CREATE TABLE IF NOT EXISTS `{prefix}type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='clasificador por tipos\r\n\r\npor ejemplo productos de tipo: ELECTRONICOS, PAPEL, PLASTICO, ESPONJA, etc.';

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla {prefix}user
CREATE TABLE IF NOT EXISTS `{prefix}user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
