-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 24-Maio-2021 às 13:50
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fauna`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

DROP TABLE IF EXISTS `animal`;
CREATE TABLE IF NOT EXISTS `animal` (
  `id_animal` int(11) NOT NULL AUTO_INCREMENT,
  `nome_animal` varchar(50) NOT NULL,
  `foto_animal` varchar(100) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `tipo` int(11) NOT NULL DEFAULT '0',
  `raca` varchar(50) DEFAULT NULL,
  `sexo_animal` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_animal`),
  KEY `id_usuario` (`id_usuario`),
  KEY `tipo` (`tipo`),
  KEY `sexo` (`sexo_animal`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `animal`
--

INSERT INTO `animal` (`id_animal`, `nome_animal`, `foto_animal`, `id_usuario`, `tipo`, `raca`, `sexo_animal`) VALUES
(1, 'Gabriel Sá', NULL, 3, 1, '0', 1),
(4, 'Teste', NULL, 4, 1, '0', 1),
(5, 'Monkey', NULL, 4, 14, '0', 1),
(6, 'Teste 123', NULL, 4, 2, '0', 2),
(7, 'Teste 1234', NULL, 4, 3, '0', 2),
(8, 'Teste 12345', NULL, 4, 2, 'Fenix', 1),
(10, 'Ab', NULL, 6, 1, 'A', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descricao`) VALUES
(1, 'feed'),
(2, 'adoção'),
(3, 'desaparecimento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE IF NOT EXISTS `comentario` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_postagem` int(11) NOT NULL,
  `texto` varchar(280) DEFAULT NULL,
  `dh_comentario` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comentario`),
  KEY `restricao_id_usuario_comentario` (`id_usuario`),
  KEY `restricao_id_postagem_postagem` (`id_postagem`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `id_usuario`, `id_postagem`, `texto`, `dh_comentario`) VALUES
(1, 1, 1, 'Legal', '2021-05-22 00:00:00'),
(2, 3, 1, 'Bacana', '2021-05-22 00:00:00'),
(3, 5, 1, 'Não gostei', '2021-05-22 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_usuario`
--

DROP TABLE IF EXISTS `nivel_usuario`;
CREATE TABLE IF NOT EXISTS `nivel_usuario` (
  `id_nivel_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(10) NOT NULL,
  PRIMARY KEY (`id_nivel_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `nivel_usuario`
--

INSERT INTO `nivel_usuario` (`id_nivel_usuario`, `descricao`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `phinxlog`
--

DROP TABLE IF EXISTS `phinxlog`;
CREATE TABLE IF NOT EXISTS `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20210419233027, 'AlteracaoFotoUsuarioAnimal', '2021-04-21 01:08:56', '2021-04-21 01:08:57', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem`
--

DROP TABLE IF EXISTS `postagem`;
CREATE TABLE IF NOT EXISTS `postagem` (
  `id_postagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `midia` varchar(100) DEFAULT NULL,
  `dh_post` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_postagem`),
  KEY `restricao_id_usuario` (`id_usuario`),
  KEY `restricao_id_categoria` (`id_categoria`),
  KEY `restricao_id_animal` (`id_animal`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `postagem`
--

INSERT INTO `postagem` (`id_postagem`, `id_usuario`, `id_categoria`, `id_animal`, `descricao`, `midia`, `dh_post`) VALUES
(1, 4, 1, 5, 'TESTE Post', 'TESTE Midia', '2021-05-22 00:00:00'),
(2, 3, 2, 1, 'TESTE Post 2', 'TESTE Midia xxx', '2021-05-22 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sexo`
--

DROP TABLE IF EXISTS `sexo`;
CREATE TABLE IF NOT EXISTS `sexo` (
  `id_sexo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(15) NOT NULL,
  PRIMARY KEY (`id_sexo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sexo`
--

INSERT INTO `sexo` (`id_sexo`, `descricao`) VALUES
(1, 'masculino'),
(2, 'feminino'),
(3, 'outro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `descricao`) VALUES
(1, 'cachorros'),
(2, 'gatos'),
(3, 'peixes'),
(4, 'aves'),
(5, 'roedores'),
(6, 'coelhos'),
(7, 'tartarugas'),
(8, 'bovinos'),
(9, 'capríneos'),
(10, 'equídeos'),
(11, 'suínos'),
(12, 'cobras'),
(13, 'lagartos'),
(14, 'macaco'),
(15, 'insetos/aracnídeos'),
(16, 'outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `sexo_usuario` int(11) NOT NULL,
  `data_nascimento` date NOT NULL,
  `foto_usuario` varchar(100) DEFAULT NULL,
  `nivel_usuario` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `restricao_sexo` (`sexo_usuario`) USING BTREE,
  KEY `nivel_usuario_restricao` (`nivel_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email`, `senha`, `telefone`, `sexo_usuario`, `data_nascimento`, `foto_usuario`, `nivel_usuario`) VALUES
(1, 'teste', 'teste@teste', 'teste', 'ewfggrrgrgr', 2, '2020-04-17', NULL, 1),
(3, 'Rayana Linda', 'joao.bruzetti@gmail.com', 'e8d95a51f3af4a3b134bf6bb680a213a', '(11) 95866-4500', 2, '2001-03-22', NULL, 1),
(4, 'Jonatha 2', 'teste@j.com', '698dc19d489c4e4db73e28a713eab07b', '(11) 95866-4510', 1, '2001-07-24', NULL, 1),
(5, 'Seiki', '', '', '', 1, '0000-00-00', NULL, 1),
(6, 'Developer', 'dev@fauna.com', '698dc19d489c4e4db73e28a713eab07b', '(11) 91111-1111', 2, '2021-05-23', NULL, 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `restricao_tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id_tipo`),
  ADD CONSTRAINT `sexo_animal` FOREIGN KEY (`sexo_animal`) REFERENCES `sexo` (`id_sexo`),
  ADD CONSTRAINT `tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id_tipo`);

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `restricao_id_postagem_postagem` FOREIGN KEY (`id_postagem`) REFERENCES `postagem` (`id_postagem`),
  ADD CONSTRAINT `restricao_id_usuario_comentario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `postagem`
--
ALTER TABLE `postagem`
  ADD CONSTRAINT `restricao_id_animal` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`),
  ADD CONSTRAINT `restricao_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `restricao_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `nivel_usuario_restricao` FOREIGN KEY (`nivel_usuario`) REFERENCES `nivel_usuario` (`id_nivel_usuario`),
  ADD CONSTRAINT `sexo_restricao` FOREIGN KEY (`sexo_usuario`) REFERENCES `sexo` (`id_sexo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
