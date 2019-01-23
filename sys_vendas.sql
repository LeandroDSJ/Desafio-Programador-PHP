

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


CREATE DATABASE IF NOT EXISTS `sis_vendas` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sis_vendas`;

CREATE TABLE IF NOT EXISTS `documento` (
  `NUMERO` int(11) NOT NULL AUTO_INCREMENT,
  `TOTAL` float NOT NULL,
  `CONFIRMADO` tinyint(4) NOT NULL,
  PRIMARY KEY (`NUMERO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `documento_produto` (
  `DOCUMENTO_NUMERO` int(11) NOT NULL,
  `PRODUTO_CODIGO` varchar(50) NOT NULL,
  KEY `PRODUTO_CODIGO_FK_2` (`PRODUTO_CODIGO`),
  KEY `DOCUMENTO_NUMERO_FK1` (`DOCUMENTO_NUMERO`),
  CONSTRAINT `DOCUMENTO_NUMERO_FK1` FOREIGN KEY (`DOCUMENTO_NUMERO`) REFERENCES `documento` (`NUMERO`) ON DELETE CASCADE,
  CONSTRAINT `PRODUTO_CODIGO_FK_2` FOREIGN KEY (`PRODUTO_CODIGO`) REFERENCES `produto` (`CODIGO`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `produto` (
  `CODIGO` varchar(50) NOT NULL,
  `DESCRICAO` varchar(255) NOT NULL,
  `PRECO` float DEFAULT NULL,
  PRIMARY KEY (`CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
