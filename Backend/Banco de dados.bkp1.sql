-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 15/10/2024 às 21:11
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

DROP TABLE IF EXISTS `cadastro`;
CREATE TABLE IF NOT EXISTS `cadastro` (
  `ID` int NOT NULL,
  `produto` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantidade` double(10,0) NOT NULL,
  `valor_compra` double NOT NULL,
  `valor_venda` double NOT NULL,
  `validade` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`ID`, `produto`, `quantidade`, `valor_compra`, `valor_venda`, `validade`) VALUES
(1, 'Limão', 0, 0, 0, '0000-00-00'),
(2, 'Alface', 30, 30, 30, '2055-03-30'),
(6, 'Pimenta', 1, 2, 3, '2003-03-03'),
(14, 'Abacate', 1, 2, 3, '2003-03-03'),
(55, 'Coco', 200, 200, 200, '2020-02-20'),
(9, 'Melão', 22, 22, 22, '2222-02-22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `fornecedor` varchar(120) NOT NULL,
  `produto` varchar(120) NOT NULL,
  `quantidade` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `compras`
--

INSERT INTO `compras` (`fornecedor`, `produto`, `quantidade`) VALUES
('Facabri18', 'Maça', 678),
('Facabri1', 'Abacate', 200),
('Facabri1', 'Abacate', 100),
('Facabri1', 'Abacate', 200),
('Facabri11', 'Banana', 133);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `razao` varchar(120) NOT NULL,
  `fantasia` varchar(120) NOT NULL,
  `apelido` varchar(120) NOT NULL,
  `grupo` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `fornecedor`
--

INSERT INTO `fornecedor` (`razao`, `fantasia`, `apelido`, `grupo`) VALUES
('d', 'a', 'a', 'a'),
('a', 'e', 'e', 'e');

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `ID` int NOT NULL,
  `nome` varchar(120) NOT NULL,
  `tipo` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `grupo`
--

INSERT INTO `grupo` (`ID`, `nome`, `tipo`) VALUES
(3, 'Limão', 'Lixo'),
(1, 'Ca', 'Ca'),
(5, 'Banana', 'su');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `ID` int NOT NULL,
  `nome` varchar(120) NOT NULL,
  `custo` double NOT NULL,
  `venda` double NOT NULL,
  `grupo` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`ID`, `nome`, `custo`, `venda`, `grupo`) VALUES
(1, 'Limão', 123, 123, 'Frutas'),
(2, 'B', 1, 1, 'A'),
(3, 'Banana', 300, 250, 'Frutas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `saida`
--

DROP TABLE IF EXISTS `saida`;
CREATE TABLE IF NOT EXISTS `saida` (
  `media` int NOT NULL,
  `produto` varchar(120) NOT NULL,
  `locald` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantidade` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `saida`
--

INSERT INTO `saida` (`media`, `produto`, `locald`, `quantidade`) VALUES
(4, 'Pimenta', 'Sol', 5000),
(3, 'Banana', 'Lua', 2000),
(45, 'Abacate', 'Bairro', 345),
(1, 'Limão ', 'Bairro', 3000),
(3, 'Coco', 'Bairro', 400);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `nivel` float NOT NULL,
  `nome` varchar(120) NOT NULL,
  `sobrenome` varchar(120) NOT NULL,
  `funcao` varchar(120) NOT NULL,
  `logi` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`nivel`, `nome`, `sobrenome`, `funcao`, `logi`, `senha`) VALUES
(5, 'Vitor', 'Stival', 'Estoquista ', '@Stival', '456');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
