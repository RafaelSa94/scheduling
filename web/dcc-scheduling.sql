-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 06/08/2016 às 16:40
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
(1, 'DCCxxx - Disciplina Algo', 1, 1);

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
  `constraints` set('01','02','03','04','05','06','07','08','09','10') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `professor`
--

INSERT INTO `professor` (`id`, `name`, `constraints`) VALUES
(1, 'Fulano', '01,02,05,06,09');

-- --------------------------------------------------------

--
-- Estrutura para view `class_professor`
--
DROP TABLE IF EXISTS `class_professor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `class_professor`  AS  select `class`.`id` AS `id`,`class`.`name` AS `name`,`class`.`professor_id` AS `professor_id`,`professor`.`name` AS `professor_name`,`class`.`semester` AS `semester`,`professor`.`constraints` AS `constraints` from (`professor` join `class` on((`class`.`professor_id` = `professor`.`id`))) ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
