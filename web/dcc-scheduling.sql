-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 17/08/2016 às 09:35
-- Versão do servidor: 5.7.13-0ubuntu0.16.04.2
-- Versão do PHP: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dcc-scheduling`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `professor_id` int(11) DEFAULT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `class`
--

INSERT INTO `class` (`id`, `name`, `professor_id`, `semester`) VALUES
(16, 'DCC105', 20, 1),
(17, 'DCC606', 22, 6),
(18, 'DCC603', 24, 6),
(19, 'DCC204', 27, 2),
(20, 'DCC605', 28, 6),
(21, 'DCC402', 27, 4),
(22, 'DCC405', 26, 4),
(23, 'DCC607', 28, 6),
(24, 'DCC206', 22, 2),
(25, 'DCC205.A', 29, 2),
(26, 'DCC205.B', 24, 2),
(27, 'DCC802', 24, 8),
(28, 'DCC407', 31, 4),
(29, 'DCC602', 30, 6),
(30, 'DCC403', 31, 4);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `class_professor`
--
CREATE TABLE `class_professor` (
`id` int(11)
,`name` varchar(100)
,`professor_id` int(11)
,`professor_name` varchar(50)
,`semester` int(11)
,`constraints` set('01','02','03','04','05','06','07','08','09','10')
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `constraints` set('01','02','03','04','05','06','07','08','09','10') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `professor`
--

INSERT INTO `professor` (`id`, `name`, `constraints`) VALUES
(20, 'George', '09,10'),
(22, 'Herbert', '01,02,07,08,09,10'),
(24, 'Dion', ''),
(26, 'Thais', '01,02,03,04,05,06,07,08'),
(27, 'Delfa', '01,02,05,06,09'),
(28, 'Miguel', '01,02,05,06,09'),
(29, 'Dwan', '09,10'),
(30, 'Balico', '01,02,07,08,09,10'),
(31, 'Lobo', '09,10');

-- --------------------------------------------------------

--
-- Estrutura para view `class_professor`
--
DROP TABLE IF EXISTS `class_professor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `class_professor`  AS  select `class`.`id` AS `id`,`class`.`name` AS `name`,`class`.`professor_id` AS `professor_id`,`professor`.`name` AS `professor_name`,`class`.`semester` AS `semester`,`professor`.`constraints` AS `constraints` from (`class` left join `professor` on((`class`.`professor_id` = `professor`.`id`))) ;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor` (`professor_id`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
