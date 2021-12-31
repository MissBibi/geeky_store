-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 10-Mai-2020 às 15:22
-- Versão do servidor: 5.1.53
-- versão do PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `geeky_store`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `morada` varchar(100) DEFAULT NULL,
  `codpostal` int(4) DEFAULT NULL,
  `cospostal2` int(3) DEFAULT NULL,
  `telefone` int(9) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `datanasc` date DEFAULT NULL,
  `localidade` varchar(50) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `nif` int(11) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`nome`, `email`, `morada`, `codpostal`, `cospostal2`, `telefone`, `sexo`, `datanasc`, `localidade`, `password`, `nif`) VALUES
('aa', 'aaa@gmail.com', 'aaaa', 1111, 111, 2147483647, 'f', '0000-00-00', 'aaaaa', 'aa', 111),
('Bia', 'adm@gmail.com', 'Ns', 9876, 123, 999999999, 'f', '2001-06-06', 'Ns', 'adm', 455565455),
('Qualquer', 'qualquer@gmail.com', 'Nao quero', 5555, 888, 898989898, NULL, '1900-02-02', 'SHHH', 'qualquer', 989898888),
('rr', 'rr@gmail.com', 'rr', 3333, 333, 333433434, 'm', '2002-04-20', 'rr', 'rr', 343434322),
('ab', 'ys@gmail.com', 'yy', 1111, 111, 111111111, 'm', '2000-06-06', 'ss', 'ii', 999999999);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `codcompra` int(11) NOT NULL AUTO_INCREMENT,
  `datacompra` date DEFAULT NULL,
  `ncartao` int(16) DEFAULT NULL,
  `cv` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `cliente_email` varchar(100) NOT NULL,
  PRIMARY KEY (`codcompra`,`cliente_email`),
  KEY `fk_compra_cliente_idx` (`cliente_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `compra`
--

INSERT INTO `compra` (`codcompra`, `datacompra`, `ncartao`, `cv`, `total`, `cliente_email`) VALUES
(1, '2020-02-07', 15515, 111, 0, 'adm@gmail.com'),
(2, '2020-02-07', 144541, 111, 0, 'adm@gmail.com'),
(3, '2020-02-07', 789988, 555, 0, 'adm@gmail.com'),
(4, '2020-03-02', 878788, 888, 0, 'adm@gmail.com'),
(5, '2020-03-02', 878788, 888, 0, 'adm@gmail.com'),
(6, '2020-03-04', NULL, NULL, 0, 'adm@gmail.com'),
(7, '2020-03-04', NULL, NULL, 0, 'adm@gmail.com'),
(8, '2020-03-12', 78989798, 789, 0, 'qualquer@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itenscompra`
--

CREATE TABLE IF NOT EXISTS `itenscompra` (
  `codcompra` int(11) NOT NULL,
  `codproduto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `compra_cliente_email` varchar(100) NOT NULL,
  `produto_codproduto` int(11) NOT NULL,
  PRIMARY KEY (`codcompra`,`codproduto`,`compra_cliente_email`,`produto_codproduto`),
  KEY `fk_itenscompra_compra1_idx` (`compra_cliente_email`),
  KEY `fk_itenscompra_produto1_idx` (`produto_codproduto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `itenscompra`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `codmarca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`codmarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`codmarca`, `marca`) VALUES
(1, 'assassins_creed'),
(2, 'dc'),
(3, 'dragon_ball'),
(4, 'harry_potter'),
(5, 'marvel'),
(6, 'one_piece'),
(7, 'star_wars');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `codproduto` int(11) NOT NULL AUTO_INCREMENT,
  `nomep` varchar(50) DEFAULT NULL,
  `precou` decimal(10,0) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `imagem` varchar(300) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `tipo_codtipo` int(11) DEFAULT NULL,
  `marca_codmarca` int(11) DEFAULT NULL,
  PRIMARY KEY (`codproduto`),
  KEY `fk_produto_tipo1_idx` (`tipo_codtipo`),
  KEY `fk_produto_marca1_idx` (`marca_codmarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codproduto`, `nomep`, `precou`, `stock`, `descricao`, `imagem`, `status`, `tipo_codtipo`, `marca_codmarca`) VALUES
(1, 'almofada_assassins_creed', '16', 25, 'Almofada feita de poliester, 15X15 cm e 100g de peso.', 'almofada_assassins.jpg', 'Disponivel', 4, 1),
(2, 'quadro_assassins', '17', 15, 'Quadro de plastico com imagem de papel fotografico,pesa 250g e tem de dimensao 45x35 cm.', 'assassins_framed.jpg', 'Disponivel', 7, 1),
(3, 'candeeiro_assassins', '30', 25, 'Candeeiro de mesa com 20cm de altura.', 'candeeiro_ezio.jpg', 'Disponivel', 3, 1),
(4, 'candeeiro_assassins2', '26', 20, 'Candeeiro de mesa com 27x26,5cm de dimens?o.', 'candeeiro_logo.jpg', 'Disponivel', 3, 1),
(5, 'colar_origins', '7', 15, 'Colar feito de liga metalica com 2.5x3.5 de tamanho.', 'colar_origins.jpg', 'Disponivel', 2, 1),
(6, 'lamina_ezio', '37', 15, 'Lamina de um so tamanho feita de policloreto de vinila.', 'ezio_lamina.jpg', 'Disponivel', 8, 1),
(7, 'anel_assassins', '6', 15, 'Anel feito de liga metalica de um so tamanho.', 'logo_anel.jpg', 'Disponivel', 8, 1),
(8, 'pop_figure_ezio', '15', 19, 'Pop figure de Ezio.', 'ezio.jpg', 'Disponivel', 1, 1),
(9, 'pop_figure_jacob', '15', 20, 'Pop figure de Jacob.', 'jacob.jpg', 'Disponivel', 1, 1),
(10, 'pop_figure_aguillar', '15', 20, 'Pop figure de Aguillar.', 'aguillar.jpg', 'Disponivel', 1, 1),
(11, 'pop_figure_maria', '15', 20, 'Pop figure de Maria.', 'maria.jpg', 'Disponivel', 1, 1),
(12, 'pop_figure_ojeda', '15', 20, 'Pop figure de Ojeda.', 'ojeda.jpg', 'Disponivel', 1, 1),
(13, 'relogio_assassins', '19', 10, 'Relogio de policarbonato com 30cm de diametro.', 'relogio.jpg', 'Disponivel', 8, 1),
(14, 'tomahank_assassins', '37', 15, 'Tomahank de Conner.', 'tomahank.jpg', 'Disponivel', 8, 1),
(15, 'canecas_assassins', '15', 25, 'Conjunto de canecas com suporte', 'presente_assassins.jpg', 'Disponivel', 6, 1),
(16, 'lanterna_verde_anel', '30', 25, 'Anel oficial do lanterna verde.', 'anel_lanterna.jpg', 'Disponivel', 8, 2),
(17, 'pop_figure_batman', '15', 20, 'Pop figure de Batman.', 'batman_pop.jpg', 'Disponivel', 1, 2),
(18, 'lanterna_verde_caneca', '9', 24, 'Caneca do lanterna verde, tem de dimensao 12x11.5x9 cm e tem uma capacidade de 325ml.', 'caneca_lanterna.jpg', 'Disponivel', 6, 2),
(19, 'superman_caneca', '9', 25, 'Caneca do superman, tem de dimensao 12x11.5x9 cm e tem uma capacidade de 325ml.', 'caneca_superman.jpg', 'Disponivel', 6, 2),
(20, 'colar_robin', '7', 20, 'Colar do logo do Robin.', 'colar_robin.jpg', 'Disponivel', 2, 2),
(21, 'colar_arrow', '7', 20, 'Colar em forma de flecha do Arrow', 'colar_arrow.jpg', 'Disponivel', 2, 2),
(22, 'pop_figure_flash', '15', 20, 'Pop figure de Flash', 'flash_pop.jpg', 'Disponivel', 1, 2),
(23, 'pop_figure_deathstroke', '15', 20, 'Pop figure de Deathstroke.', 'deathstroke_pop.jpg', 'Disponivel', 1, 2),
(24, 'porta_chaves_flash', '8', 20, 'Porta chaves do logo de Flash, 100% de borracha.', 'pch_flash.jpg', 'Disponivel', 8, 2),
(25, 'pop_figure_nigthwing', '15', 20, 'Pop figure de Nigthwing.', 'nigthwing_pop.jpg', 'Disponivel', 1, 2),
(26, 'poster_dc1', '10', 20, 'Poster da liga da justica com tamanho de 50x40cm', 'poster_dc1.jpg', 'Disponivel', 7, 2),
(27, 'poster_dc2', '10', 20, 'Poster dos Titans com tamanho de 45x35cm.', 'poster_dc2.jpg', 'Disponivel', 7, 2),
(28, 'tapete_dc1', '8', 15, 'Tapete de bem vindo do Batman feito de policloreto de vinila e mede 40x60cm.', 'tapete_dc.jpg', 'Disponivel', 5, 2),
(29, 'tapete_dc2', '8', 15, 'Tapete de bem vindo do Batman feito de policloreto de vinila e mede 40x60cm.', 'tapete_dc2.jpg', 'Disponivel', 5, 2),
(30, 'pop_figure_wonderwoman', '15', 20, 'Pop figure de wonder woman', 'wonder_woman_pop.jpg', 'Disponivel', 1, 2),
(31, 'almofada_db1', '16', 30, 'Almofada feita de poliester, 15X15 cm e 100g de peso.', 'almofada_db1.jpg', 'Disponivel', 4, 3),
(32, 'almofada_db2', '16', 15, 'Almofada feita de poliester, 15X15 cm e 100g de peso.', 'almofada_db2.jpg', 'Disponivel', 4, 3),
(33, 'pop_figure_goku', '15', 20, 'Pop figure de Goku Rose', 'goku_rose_pop.jpg', 'Disponivel', 1, 3),
(34, 'pop_figure_buu', '15', 20, 'Pop figure de Majin Buu.', 'buu_pop.jpg', 'Disponivel', 1, 3),
(35, 'pop_figure_chichi', '15', 20, 'Pop figure de Chi Chi.', 'chi_chi_pop.jpg', 'Disponivel', 1, 3),
(36, 'pop_figure_trunks', '15', 20, 'Pop figure de Super Saiyan Future Trunks.', 'trunks_pop.jpg', 'Disponivel', 1, 3),
(37, 'pop_figure_vegeta', '15', 20, 'Pop figure de Vegeta God.', 'vegeta_pop.jpg', 'Disponivel', 1, 3),
(38, 'mala_db', '20', 20, 'Mala do dragon ball.', 'mala_db.jpg', 'Disponivel', 8, 3),
(39, 'peluche_goku', '23', 20, 'Peluche do Goku Black de 36cm, feito de poliester.', 'peluche_goku.jpg', 'Disponivel', 8, 3),
(40, 'caneca_db1', '10', 15, 'Caneca de Dragon Ball com capacidade de 325ml.', 'caneca_db1.jpg', 'Disponivel', 6, 3),
(41, 'caneca_db2', '10', 15, 'Caneca de Dragon Ball com capacidade de 325ml.', 'caneca_db2.jpg', 'Disponivel', 6, 3),
(42, 'caneca_db3', '10', 15, 'Caneca de Dragon Ball com capacidade de 325ml.', 'caneca_db3.jpg', 'Disponivel', 6, 3),
(43, 'porta_chaves_db', '7', 15, 'Porta chaves da bola de cristal do Dragon Ball, feito de 100% borracha.', 'pch_db.jpg', 'Disponivel', 8, 3),
(44, 'poster_db1', '9', 15, 'Poster do anime Dragon Ball de 45x35cm de tamanho.', 'poster_db1.jpg', 'Disponivel', 7, 3),
(45, 'poster_db2', '9', 15, 'Poster do anime Dragon Ball de 45x35cm de tamanho.', 'poster_db2.jpg', 'Disponivel', 7, 3),
(46, 'pop_figure_dementor', '15', 20, 'Pop figure de Dementor de Harry Potter.', 'dementor_pop.jpg', 'Disponivel', 1, 4),
(47, 'pop_figure_remos', '15', 20, 'Pop figure de Remos Lupin de Harry Potter.', 'remos_pop.jpg', 'Disponivel', 1, 4),
(48, 'pop_figure_harry', '15', 20, 'Pop figure de Harry Potter com snitch de Harry Potter.', 'harry_pop.jpg', 'Disponivel', 1, 4),
(49, 'pop_figure_luna', '15', 20, 'Pop figure de Luna Lovegood de Harry Potter.', 'luna_pop.jpg', 'Disponivel', 1, 4),
(50, 'pop_figure_sirius', '15', 20, 'Pop figure de Sirus Black de Harry Potter.', 'sirius_pop.jpg', 'Disponivel', 1, 4),
(51, 'cachecol_grynffindor', '13', 15, 'Cachecol de Grynffindor feito de 100% Acrilico.', 'cachecol_grynffindor.jpg', 'Disponivel', 8, 4),
(52, 'cachecol_hufflepuf', '13', 15, 'Cachecol de Hufflepuf feito de 100% Acrilico.', 'cachecol_hufflepuf.jpg', 'Disponivel', 8, 4),
(53, 'cachecol_ravenclaw', '13', 15, 'Cachecol de Ravenclaw feito de 100% Acrilico.', 'cachecol_ravenclaw.jpg', 'Disponivel', 8, 4),
(54, 'cachecol_slytherin', '13', 15, 'Cachecol de Slytherin feito de 100% Acrilico.', 'cachecol_slytherin.jpg', 'Disponivel', 8, 4),
(55, 'candeeiro_snitch', '26', 25, 'Candeeiro da snitch de Harry Potter com 20cm de altura, feito de plastico', 'candeeiro_snitch.jpg', 'Disponivel', 3, 4),
(56, 'colar_hp', '9', 15, 'Colar das reliquias da morte de Harry Potter.', 'colar_reliquias.jpg', 'Disponivel', 2, 4),
(57, 'mala_hp1', '25', 15, 'Mala branca de Harry Potter de 34x26cm.', 'mala_brancahp.jpg', 'Disponivel', 8, 4),
(58, 'mala_hp2', '25', 15, 'Mala preta de Harry Potter de 34x26cm.', 'mala_pretahp.jpg', 'Disponivel', 8, 4),
(59, 'varinha_voldemort', '35', 35, 'Varinha do vilao Lord Voldemort Do Harry Potter, inclui varinha e estojo, feito de plastico.', 'varinha_voldemort.jpg', 'Disponivel', 8, 4),
(60, 'varinha_sabugueiro', '35', 35, 'Varinha de sabugueiro do Harry Potter, inclui varinha e estojo, feito de plastico.', 'varinha_sabugueiro.jpg', 'Disponivel', 8, 4),
(61, 'pop_figure_wanda', '15', 20, 'Pop figure de Wanda da Marvel.', 'wanda_pop.jpg', 'Disponivel', 1, 5),
(62, 'pop_figure_tony', '15', 20, 'Pop figure de Tony Stark da Marvel.', 'tony_pop.jpg', 'Disponivel', 1, 5),
(63, 'pop_figure_thanos', '15', 20, 'Pop figure de Thanos da Marvel.', 'thanos_pop.jpg', 'Disponivel', 1, 5),
(64, 'pop_figure_marvel', '15', 20, 'Pop figure de Captain Marvel da Marvel.', 'captainmarvel_pop.jpg', 'Disponivel', 1, 5),
(65, 'pop_figure_groot', '15', 20, 'Pop figure de dancing Groot da Marvel.', 'groot_pop.jpg', 'Disponivel', 1, 5),
(66, 'candeeiro_deadpool', '26', 20, 'Candeeiro do Deadpool de 10cm de altura.', 'candeeiro_deadpool.jpg', 'Disponivel', 3, 5),
(67, 'candeeiro_hulk', '26', 20, 'Candeeiro do hulk com 24 cm de altura.', 'candeeiro_hulk.jpg', 'Disponivel', 3, 5),
(68, 'capacete_panther', '30', 15, 'Capacete do pantera negra com luzes de vibranio e com visor que sobe e desce.', 'capacete_panther.jpg', 'Disponivel', 8, 5),
(69, 'colar_agamotto', '13', 20, 'Colar do olho de agamotto.', 'colar_agamotto.jpg', 'Disponivel', 2, 5),
(70, 'base_groot', '16', 20, 'Base do Groot para guardar objetos.', 'base_groot.jpg', 'Disponivel', 8, 5),
(71, 'mala_marvel', '10', 20, 'Mala da marvel com dimensao de 47x38cm', 'mala_marvel.jpg', 'Disponivel', 8, 5),
(72, 'pch_cap', '6', 20, 'Porta chaves do capitao america.', 'pch_cap.jpg', 'Disponivel', 8, 5),
(73, 'spiderman_caneca', '13', 20, 'Caneca do spiderman com capacidade de 350ml.', 'spiderman_caneca.jpg', 'Disponivel', 6, 5),
(74, 'tapete_guardian', '11', 20, 'Tapete da cassete do filme os guardioes da galaxia.', 'tapete_guardian.jpg', 'Disponivel', 5, 5),
(75, 'venom_tapete', '11', 20, 'Tapete do venom', 'venom_tapete.jpg', 'Disponivel', 5, 5),
(76, 'pop_figure_ace', '15', 20, 'Pop figure de Ace do One Piece.', 'ace_pop.jpg', 'Disponivel', 1, 6),
(77, 'pop_figure_zoro', '15', 20, 'Pop figure de Zoro do One Piece.', 'zoro_pop.jpg', 'Disponivel', 1, 6),
(78, 'pop_figure_sanji', '15', 20, 'Pop figure de Sanji do One Piece.', 'sanji_pop.jpg', 'Disponivel', 1, 6),
(79, 'pop_figure_luffy', '15', 20, 'Pop figure de Luffy do One Piece.', 'luffy_pop.jpg', 'Disponivel', 1, 6),
(80, 'pop_figure_law', '15', 20, 'Pop figure de Law do One Piece.', 'law_pop.jpg', 'Disponivel', 1, 6),
(81, 'almofada_op', '9', 20, 'Almofada com o logo da bandeira dos chapeus de palha.', 'almofada_op.jpg', 'Disponivel', 4, 6),
(82, 'colar_op1', '8', 20, 'Colar com o logo da bandeira dos chapeus de palha.', 'colar_op1.jpg', 'Disponivel', 2, 6),
(83, 'colar_op2', '8', 20, 'Colar com o logo da bandeira do grupo heart pirates.', 'colar_op2.jpg', 'Disponivel', 2, 6),
(84, 'candeeiro_op', '26', 20, 'Candeeiro do logo dos piratas chapeus de palha.', 'candeeiro_op.jpg', 'Disponivel', 3, 6),
(85, 'caneca_op', '7', 20, 'Caneca do luffy com capacidade de 325ml.', 'caneca_op.jpg', 'Disponivel', 6, 6),
(86, 'poster_op1', '9', 15, 'Poster do anime One Piece.', 'poster_op1.jpg', 'Disponivel', 7, 6),
(87, 'poster_op2', '9', 15, 'Poster do anime One Piece.', 'poster_op2.jpg', 'Disponivel', 7, 6),
(88, 'poster_op3', '9', 15, 'Poster do anime One Piece.', 'poster_op3.jpg', 'Disponivel', 7, 6),
(89, 'tapete_op1', '11', 15, 'Tapete do anime One Piece.', 'tapete_op1.jpg', 'Disponivel', 5, 6),
(90, 'tapete_op2', '11', 15, 'Tapete do anime One Piece.', 'tapete_op2.jpg', 'Disponivel', 5, 6),
(91, 'pop_figure_rey', '15', 20, 'Pop figure de Rey do Star Wars.', 'pop_rey.jpg', 'Disponivel', 1, 7),
(92, 'pop_figure_r2d2', '15', 20, 'Pop figure de R2D2 do Star Wars.', 'pop_r2d2.jpg', 'Disponivel', 1, 7),
(93, 'pop_figure_vader', '15', 20, 'Pop figure de Darth Vader do Star Wars.', 'pop_vader.jpg', 'Disponivel', 1, 7),
(94, 'pop_figure_leia', '15', 20, 'Pop figure de Princesa Leia do Star Wars.', 'pop_leia.jpg', 'Disponivel', 1, 7),
(95, 'pop_figure_chewie', '15', 20, 'Pop figure de Chewbacca do Star Wars.', 'pop_chewie.jpg', 'Disponivel', 1, 7),
(96, 'candeeiro_sw', '26', 20, 'Candeeiro do espaco de Star Wars com 26cm x 17cm de tamanho.', 'candeeiro_sw.jpg', 'Disponivel', 3, 7),
(97, 'candeeiro_sw2', '26', 20, 'Candeeiro de Darth Vader com 24 x 19 x 7 cm de dimensao.', 'candeeiro_sw2.jpg', 'Disponivel', 3, 7),
(98, 'caneca_sw', '10', 20, 'Caneca de Star Wars, quando aquece mostra um novo desenho', 'caneca_sw.jpg', 'Disponivel', 6, 7),
(99, 'colar_sw1', '8', 15, 'Colar da ordem de jedi de Star Wars.', 'colar_jedi.jpg', 'Disponivel', 2, 7),
(100, 'colar_sw2', '8', 15, 'Colar da alianca rebelde de Star Wars.', 'colar_rebelde.jpg', 'Disponivel', 2, 7),
(101, 'colar_sw3', '9', 15, 'Colar e pulseira de Star Wars.', 'colar_sw.jpg', 'Disponivel', 2, 7),
(102, 'canecas_sw', '17', 20, 'Conjunto de 4 canecas de Star Wars.', 'conjunto_canecas.jpg', 'Disponivel', 6, 7),
(103, 'portachaves_sw', '6', 20, 'Porta chaves de Star Wars', 'pch_sw.jpg', 'Disponivel', 8, 7),
(104, 'postersw1', '12', 20, 'Poster de Star Wars de 61cm* 91.5 cm de tamanho.', 'poster_sw1.jpg', 'Disponivel', 7, 7),
(105, 'postersw2', '12', 30, 'Poster de Star Wars de 61cm* 91.5 cm de tamanho.', 'poster_sw2.jpg', 'Disponivel', 7, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `codtipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`codtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`codtipo`, `tipo`) VALUES
(1, 'pop_figure'),
(2, 'colar'),
(3, 'candeeiro'),
(4, 'almofada'),
(5, 'tapete'),
(6, 'caneca'),
(7, 'poster'),
(8, 'objeto_colecionavel');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_cliente` FOREIGN KEY (`cliente_email`) REFERENCES `cliente` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itenscompra`
--
ALTER TABLE `itenscompra`
  ADD CONSTRAINT `fk_itenscompra_compra1` FOREIGN KEY (`compra_cliente_email`) REFERENCES `compra` (`cliente_email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_itenscompra_produto1` FOREIGN KEY (`produto_codproduto`) REFERENCES `produto` (`codproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_marca1` FOREIGN KEY (`marca_codmarca`) REFERENCES `marca` (`codmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto_tipo1` FOREIGN KEY (`tipo_codtipo`) REFERENCES `tipo` (`codtipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
