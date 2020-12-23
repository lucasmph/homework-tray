-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Dez-2020 às 20:35
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tray_vendas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `valor` float NOT NULL,
  `comissao` float NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `id_vendedor`, `valor`, `comissao`, `data`) VALUES
(15, 2, 87.49, 7.43, '2020-12-18'),
(16, 2, 87.42, 7.43, '2020-12-18'),
(17, 1, 95.72, 8.13, '2020-12-19'),
(18, 1, 170.95, 14.53, '2020-12-19'),
(19, 1, 190.3, 16.17, '2020-12-19'),
(20, 4, 220.2, 18.71, '2020-12-19'),
(21, 4, 110.4, 9.38, '2020-12-19'),
(22, 1, 55.9, 4.75, '2020-12-23'),
(23, 1, 75.32, 6.4, '2020-12-23'),
(24, 1, 97.73, 8.3, '2020-12-23'),
(25, 1, 75, 6.37, '2020-12-23'),
(26, 1, 32.05, 2.72, '2020-12-23'),
(27, 10, 35.22, 2.99, '2020-12-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendedores`
--

INSERT INTO `vendedores` (`id`, `nome`, `email`) VALUES
(1, 'Teste Lucas', 'teste@teste.com'),
(2, 'Teste Lucas dois', 'teste2@teste.com'),
(4, 'Teste Lucas cinco', 'teste99@teste.com'),
(5, 'Teste Nove Oito', 'testevendedor98@teste98.com'),
(6, 'Teste Nove Sete', 'testevendedor97@teste97.com'),
(7, 'Teste Nove Seis', 'testevendedor96@teste96.com'),
(8, 'Teste Nove Quatro', 'testevendedor94@teste94.com'),
(9, 'Teste Nove Tr', 'testevendedor93@teste93.com'),
(10, 'Teste Nove Tr', 'testevendedor92@teste92.com'),
(11, 'Teste Nove Um', 'testevendedor91@teste91.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
