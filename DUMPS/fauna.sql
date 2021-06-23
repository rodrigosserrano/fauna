-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 23-Jun-2021 às 19:58
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `animal`
--

INSERT INTO `animal` (`id_animal`, `nome_animal`, `foto_animal`, `id_usuario`, `tipo`, `raca`, `sexo_animal`) VALUES
(1, 'Bob', '5ab94e0403b12c649514cf806ba1007e.jpg', 1, 1, 'Husky Siberiano', 1),
(2, 'Billy', '944d85e90c0182f8b5b9a182d38bdfb6.jpg', 2, 1, 'Border collie branco', 1),
(3, 'Bolt', '53524698792335e81e996b5c86ff5279.jpg', 3, 1, 'Shiba inu', 1),
(4, 'Clara', 'cc3aca2bdb5496f8316e4f65b6626fcc.jpg', 3, 2, 'Maine Coon', 2),
(6, 'Totó', 'e192c309a331c0549fb56f81a4f0de41.jpg', 3, 1, 'Spitz Alemão', 1),
(7, 'Pandora', '3656d74ce25bf69918ee4d4a018e3486.jpeg', 4, 1, 'Vira-lata', 2),
(8, 'Yumi', '19d4d7d01c2fe54449f79d7e5fed26aa.jpeg', 4, 1, 'Vira-lata', 2),
(9, 'Akira', '75def6777a3f40b5746b5d0bc44ddb48.jpeg', 4, 1, 'Vira-lata', 2),
(10, 'Musaranho', '1aa00bb54eb9bdd2046fee7f787e00ff.jpg', 4, 5, 'Musaranho', 1),
(11, 'Nenhum', NULL, 5, 16, '', 1),
(12, 'Martin', '5ed9de74af46f79e21cc1d73cfe5202f.jpg', 6, 6, 'Holland Lop', 1),
(13, 'Epona', 'a27a54ab069dc3b9a8ed89e2985fc98e.jpg', 7, 10, 'Quarto de Milha', 2),
(14, 'Nina', '09658da976c847a86b8ecaef8600df49.jpg', 8, 10, 'Cavalo Branco', 2);

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
(2, 'adocao'),
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `id_usuario`, `id_postagem`, `texto`, `dh_comentario`) VALUES
(1, 1, 1, 'quem curtiu da like', '2021-06-20 10:08:50'),
(2, 2, 2, 'legal', '2021-06-23 13:19:04'),
(3, 3, 3, 'Nossa, que fofo', '2021-06-23 13:25:35'),
(4, 1, 2, 'psé', '2021-06-23 14:04:08'),
(5, 1, 3, 'esse é estiloso', '2021-06-23 14:04:26'),
(6, 1, 4, 'foto realmente muito bacana, gostaria de ter umas paisagens legais assim por aqui pra tirar mais fotos do Bob', '2021-06-23 14:06:39'),
(7, 2, 4, 'reparei nisso tb, essa foto tá linda e o doguinho é mt fofinho', '2021-06-23 14:12:30'),
(8, 2, 3, 'd+ esse meu garotão', '2021-06-23 14:13:48'),
(9, 1, 6, 'Nariz parece um cadarço', '2021-06-23 14:39:36'),
(10, 1, 10, 'realmente triste que ainda há tantos casos como esse, vou ajudar como puder', '2021-06-23 15:11:25'),
(11, 1, 9, 'que fofo, parece que ta consolando alguém', '2021-06-23 15:12:30'),
(12, 2, 11, 'ai que fofa!', '2021-06-23 15:19:13'),
(13, 2, 10, 'mt obrigada', '2021-06-23 15:19:26'),
(14, 2, 8, 'boa ideia trazer umas fotos antigas dos nossos pets pra cá', '2021-06-23 15:19:45'),
(15, 2, 7, 'vou divulgar tb', '2021-06-23 15:19:56'),
(16, 3, 7, 'farei o que puder para ajudar', '2021-06-23 15:21:16'),
(17, 3, 8, 'vdd, vou procurar umas fotos assim tb', '2021-06-23 15:21:36'),
(18, 1, 12, 'muito bom ver essas campanhas sendo compartilhadas por aqui', '2021-06-23 15:26:26'),
(19, 1, 13, 'Quem tiver interesse ou conhecer alguem que tem, favor entrar  em contato, tem meu telefone no perfil', '2021-06-23 15:27:18'),
(20, 1, 14, 'essa é braba msm', '2021-06-23 15:37:29'),
(21, 7, 15, 'uma amiga pegou um parecido aqui na região de Vila do Além, vou ver com ela se é o mesmo e entraremos em contato', '2021-06-23 16:38:56'),
(22, 1, 17, 'partiu vencer #rumoAVitória', '2021-06-23 16:50:51'),
(23, 3, 17, '#rumoAVitória', '2021-06-23 16:52:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtida`
--

DROP TABLE IF EXISTS `curtida`;
CREATE TABLE IF NOT EXISTS `curtida` (
  `id_curtida` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_postagem` int(11) DEFAULT NULL,
  `id_comentario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_curtida`),
  KEY `restricao_usuario_curtida` (`id_usuario`),
  KEY `restricao_postagem_curtida` (`id_postagem`),
  KEY `restricao_id_comentario` (`id_comentario`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curtida`
--

INSERT INTO `curtida` (`id_curtida`, `id_usuario`, `id_postagem`, `id_comentario`) VALUES
(1, 1, 1, NULL),
(2, 2, 1, NULL),
(3, 2, 2, NULL),
(4, 2, 3, NULL),
(5, 3, 3, NULL),
(6, 3, 4, NULL),
(7, 3, 5, NULL),
(8, 1, 5, NULL),
(9, 1, 4, NULL),
(10, 1, 3, NULL),
(11, 2, 5, NULL),
(12, 2, 4, NULL),
(13, 4, 5, NULL),
(14, 4, 4, NULL),
(15, 4, 3, NULL),
(16, 4, 1, NULL),
(17, 1, 6, NULL),
(18, 1, 7, NULL),
(19, 4, 7, NULL),
(20, 4, 8, NULL),
(21, 4, 9, NULL),
(22, 2, 9, NULL),
(23, 2, 8, NULL),
(24, 2, 7, NULL),
(25, 2, 10, NULL),
(26, 1, 10, NULL),
(27, 1, 9, NULL),
(28, 1, 8, NULL),
(29, 4, 11, NULL),
(30, 4, 10, NULL),
(31, 2, 11, NULL),
(32, 3, 11, NULL),
(33, 3, 10, NULL),
(34, 3, 9, NULL),
(35, 3, 8, NULL),
(36, 3, 7, NULL),
(38, 3, 12, NULL),
(39, 1, 12, NULL),
(40, 1, 11, NULL),
(41, 1, 13, NULL),
(42, 4, 13, NULL),
(43, 4, 12, NULL),
(44, 4, 14, NULL),
(45, 1, 14, NULL),
(46, 3, 15, NULL),
(47, 3, 14, NULL),
(48, 3, 13, NULL),
(49, 2, 15, NULL),
(50, 2, 14, NULL),
(51, 2, 13, NULL),
(52, 2, 12, NULL),
(53, 4, 15, NULL),
(54, 6, 15, NULL),
(55, 6, 13, NULL),
(56, 6, 12, NULL),
(57, 6, 10, NULL),
(58, 6, 8, NULL),
(59, 6, 7, NULL),
(60, 6, 16, NULL),
(61, 7, 16, NULL),
(62, 7, 15, NULL),
(63, 7, 13, NULL),
(64, 7, 12, NULL),
(65, 7, 10, NULL),
(66, 7, 6, NULL),
(67, 8, 17, NULL),
(68, 8, 16, NULL),
(69, 8, 15, NULL),
(70, 8, 13, NULL),
(71, 8, 12, NULL),
(72, 8, 10, NULL),
(73, 8, 7, NULL),
(74, 1, 17, NULL),
(75, 1, 16, NULL),
(76, 1, 15, NULL),
(77, 2, 17, NULL),
(78, 2, 16, NULL),
(79, 3, 16, NULL),
(80, 3, 17, NULL),
(81, 4, 17, NULL),
(82, 4, 16, NULL),
(83, 1, 18, NULL),
(84, 4, 18, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `postagem`
--

INSERT INTO `postagem` (`id_postagem`, `id_usuario`, `id_categoria`, `id_animal`, `descricao`, `midia`, `dh_post`) VALUES
(1, 1, 1, 1, 'Olha esse lindão', '12823fbc874dc13a1f8cf40418e9f3c2.jpg', '2021-06-20 10:08:18'),
(2, 1, 1, 11, 'Post sem imagem', NULL, '2021-06-20 10:10:58'),
(3, 2, 1, 2, 'Se preparando para curtir o verão \\0/', 'df73ed9a1f94591ede293ef863233462.jpg', '2021-06-23 13:12:56'),
(4, 3, 1, 3, 'Primavera acabando, aproveitei para tirar lindas fotos para usar de wallpaper', '6bb2cb1b0ced5b4ae8b27e8f73b04877.jpg', '2021-06-23 13:27:25'),
(5, 3, 1, 6, 'Totó explorando o mundo', 'f278ba7373ef34f02b05e063dd41d66d.jpg', '2021-06-23 14:03:09'),
(6, 4, 1, 10, 'Se eu fosse um animal, seria esse ae', 'ce2730bf1a718226f06c4a1cde69f07c.jpg', '2021-06-23 14:37:29'),
(7, 1, 3, 11, 'Ajudando na divulgação, quem conhecer favor entrar em contato', '57192b9ced73174b01bca1f9550be35e.jpg', '2021-06-23 14:50:57'),
(8, 4, 1, 7, '#wbw da pandora', 'b68813f3044ff7544b83bf3e214605e9.jpeg', '2021-06-23 15:04:04'),
(9, 4, 1, 7, 'tomando um solzinho', 'b9dad8731226c27dbfcce28611e1d5a4.jpeg', '2021-06-23 15:06:25'),
(10, 2, 3, 11, 'Mais um caso triste de animal abandonado, quem tiver visto ou algo parecido e puder colaborar', '0d302d685df38530eb29d4613d5c583a.jpg', '2021-06-23 15:08:19'),
(11, 4, 1, 9, 'Seja encantado pela piscada mágica da Akira brincando', 'c12d73890abb72304729723a70267875.jpeg', '2021-06-23 15:17:03'),
(12, 3, 2, 11, 'Participe de campanhas de adoção para ajudar a combater o abandono de animais', 'a10d10fc0a0bba89784278836b54b0ed.jpeg', '2021-06-23 15:22:27'),
(13, 1, 2, 11, 'Ajude a encontrar um lar para esse doguinho', 'b6509c6e70683641dfdde564bfc3ff04.jpg', '2021-06-23 15:26:56'),
(14, 4, 1, 8, 'Yumi testando sua nova habilidade: visão noturna', '91678de6ccbc5567908f3ce7e9b2ff69.jpeg', '2021-06-23 15:31:25'),
(15, 3, 3, 11, 'Mais um caso de animal perdido, ajude-nos a encontrar o dono', '57fba6f29cf9f87ece6977d7ad83a598.jpg', '2021-06-23 15:39:54'),
(16, 6, 1, 12, 'Mais um ano de vida na quarentena :D', 'ade37e0bb6c52c496bff5375f4fac87e.jpg', '2021-06-23 15:52:24'),
(17, 8, 1, 14, 'Cinco anos com essa guerreira participando de campeonatos #rumoAVitória', '1e3ab6077d5a8f87320ba500a0e0a5f9.jpg', '2021-06-23 16:49:45'),
(18, 1, 3, 11, 'Esse animal foi encontrado aqui em Prudente, entre em contato para mais informações', '5a68ca2b6b54760a6358b0ef07ac4af0.jpg', '2021-06-23 16:56:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguir`
--

DROP TABLE IF EXISTS `seguir`;
CREATE TABLE IF NOT EXISTS `seguir` (
  `id_seguido` int(11) NOT NULL,
  `id_seguidor` int(11) NOT NULL,
  KEY `restricao_id_usuario_seguido` (`id_seguido`),
  KEY `restricao_id_usuario_seguidor` (`id_seguidor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `seguir`
--

INSERT INTO `seguir` (`id_seguido`, `id_seguidor`) VALUES
(1, 2),
(3, 2),
(2, 1),
(4, 1),
(4, 2),
(3, 1),
(2, 3),
(1, 3),
(4, 3),
(1, 4),
(3, 7),
(6, 2),
(8, 2),
(8, 1),
(6, 1),
(8, 4),
(4, 8),
(3, 8);

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
  `nivel_usuario` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `restricao_sexo` (`sexo_usuario`) USING BTREE,
  KEY `nivel_usuario_restricao` (`nivel_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email`, `senha`, `telefone`, `sexo_usuario`, `data_nascimento`, `foto_usuario`, `nivel_usuario`) VALUES
(1, 'Jonny Preocupado', 'jonnypreocupado@gmail.com', '7815696ecbf1c96e6894b779456d330e', '(11) 94164-6846', 1, '1999-06-20', '0164f8353baeee9eb88f9e0089d8649a.png', 2),
(2, 'Ilargian Faus', 'ilargian@gmail.com', '7815696ecbf1c96e6894b779456d330e', '(11) 91111-1111', 2, '2021-06-23', '49fa385f9e24ec96a2eeaf3eda82b3a7.jpeg', 2),
(3, 'Valéria Boltneva', 'boltneva@gmail.com', '7815696ecbf1c96e6894b779456d330e', '(11) 91111-1111', 2, '2021-06-23', 'f9d8191bc80e55410f9323b1adebee45.jpeg', 2),
(4, 'João Victor Araujo Bruzetti', 'joao.bruzetti@gmail.com', '7815696ecbf1c96e6894b779456d330e', '(11) 91111-1111', 1, '2001-03-22', 'df7a84b7b9900db55fde9acd3420df25.jpg', 2),
(5, 'Admin', 'admin@admin.com', '7815696ecbf1c96e6894b779456d330e', '(11) 91111-1111', 3, '2021-06-23', NULL, 2),
(6, 'Maggie', 'maggie@gmail.com', '7815696ecbf1c96e6894b779456d330e', '(11) 91111-1111', 2, '2021-06-23', '684ef99d99331a025773924095466513.jpg', 2),
(7, 'Anastasia Shuraeva', 'shuraeva@gmail.com', '7815696ecbf1c96e6894b779456d330e', '(11) 91111-1111', 2, '2021-06-23', 'b7aff176fa25a5d8c14f6a5f932bb5dc.jpeg', 2),
(8, 'Helena Lopes', 'helena@gmail.com', '7815696ecbf1c96e6894b779456d330e', '(11) 91111-1111', 2, '2021-06-23', '45c4316e09cd5dcfa792576649e5cf1d.jpeg', 2);

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
-- Limitadores para a tabela `curtida`
--
ALTER TABLE `curtida`
  ADD CONSTRAINT `restricao_id_comentario` FOREIGN KEY (`id_comentario`) REFERENCES `comentario` (`id_comentario`),
  ADD CONSTRAINT `restricao_postagem_curtida` FOREIGN KEY (`id_postagem`) REFERENCES `postagem` (`id_postagem`),
  ADD CONSTRAINT `restricao_usuario_curtida` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `postagem`
--
ALTER TABLE `postagem`
  ADD CONSTRAINT `restricao_id_animal` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`),
  ADD CONSTRAINT `restricao_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `restricao_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `seguir`
--
ALTER TABLE `seguir`
  ADD CONSTRAINT `restricao_id_usuario_seguido` FOREIGN KEY (`id_seguido`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `restricao_id_usuario_seguidor` FOREIGN KEY (`id_seguidor`) REFERENCES `usuario` (`id_usuario`);

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
