-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.17 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para ict
DROP DATABASE IF EXISTS `ict`;
CREATE DATABASE IF NOT EXISTS `ict` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ict`;


-- Copiando estrutura para tabela ict.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `nome` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela ict.admin: ~0 rows (aproximadamente)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `email`, `senha`, `nome`) VALUES
	(1, 'lipe_safreire@hotmail.com', '22d37df62796713c130af7dc582d9f89', 'Felipe');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- Copiando estrutura para tabela ict.aluno
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome_orientando` varchar(100) NOT NULL,
  `cpf_orientando` varchar(30) NOT NULL,
  `email_orientando` varchar(70) NOT NULL,
  `lattes_orientando` text NOT NULL,
  `curso_id` bigint(20) NOT NULL,
  `periodo_curso` int(11) NOT NULL,
  `termo_orientando` int(11) NOT NULL,
  `nome_orientador` varchar(100) NOT NULL,
  `cpf_orientador` varchar(30) NOT NULL,
  `email_orientador` varchar(70) NOT NULL,
  `lattes_orientador` text NOT NULL,
  `titulacao_orientador` int(11) NOT NULL,
  `ies_orientador` varchar(50) NOT NULL,
  `nome_coorientador` varchar(100) DEFAULT NULL,
  `cpf_coorientador` varchar(30) DEFAULT NULL,
  `email_coorientador` varchar(70) DEFAULT NULL,
  `lattes_coorientador` text,
  `titulacao_coorientador` int(11) DEFAULT NULL,
  `ies_coorientador` varchar(50) DEFAULT NULL,
  `local` varchar(100) NOT NULL,
  `periodo_realizacao` int(11) NOT NULL,
  `dia_realizacao` int(11) NOT NULL,
  `hora_realizacao` varchar(10) NOT NULL,
  `orgao_realizacao` varchar(100) NOT NULL,
  `titulo_projeto` varchar(100) NOT NULL,
  `resumo_projeto` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;



-- Copiando estrutura para tabela ict.coordenador
CREATE TABLE IF NOT EXISTS `coordenador` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_curso` bigint(20) DEFAULT NULL,
  `nome` varchar(80) NOT NULL,
  `email` varchar(70) NOT NULL,
  `senha` varchar(40) DEFAULT NULL,
  `senha_temporaria` varchar(40) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_curso` (`id_curso`),
  CONSTRAINT `fk_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


-- Copiando estrutura para tabela ict.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela ict.curso: ~3 rows (aproximadamente)
DELETE FROM `curso`;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`id`, `titulo`, `status`) VALUES
	(1, 'Análise e Desenvolvimento de Sistemas', 1),
	(2, 'Mecatronica', 1),
	(3, 'Gestão Empresarial', 1);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;


-- Copiando estrutura para tabela ict.edital
CREATE TABLE IF NOT EXISTS `edital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_inicial_inscricao` date NOT NULL,
  `data_final_inscricao` date NOT NULL,
  `semestre` int(11) NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


-- Copiando estrutura para tabela ict.ficha_temporaria
CREATE TABLE IF NOT EXISTS `ficha_temporaria` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dados` text NOT NULL,
  `curso_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ict.ficha_temporaria: ~0 rows (aproximadamente)
DELETE FROM `ficha_temporaria`;
/*!40000 ALTER TABLE `ficha_temporaria` DISABLE KEYS */;
/*!40000 ALTER TABLE `ficha_temporaria` ENABLE KEYS */;


-- Copiando estrutura para tabela ict.requisicao
CREATE TABLE IF NOT EXISTS `requisicao` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ict.requisicao: ~0 rows (aproximadamente)
DELETE FROM `requisicao`;
/*!40000 ALTER TABLE `requisicao` DISABLE KEYS */;
/*!40000 ALTER TABLE `requisicao` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
