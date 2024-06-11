-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Jun-2024 às 17:54
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `thedripdistrict`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Morada` varchar(255) DEFAULT NULL,
  `CodEntrega` int(11) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `Email`, `Morada`, `CodEntrega`, `Nome`, `Telefone`, `password`) VALUES
(3, 'alexandrelapa344@gmail.com', '', 0, 'Alexandre Lapa', '', '2fe04e524ba40505a82e03a2819429cc');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `Codigo` int(11) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Morada` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `Codproduto` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Preco` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`Codproduto`, `Nome`, `Preco`, `imagem`) VALUES
(1, 'Nike x NOCTA NRG Big Body CS', 60.00, 'NikeXNocta.png'),
(2, 'Champion X Beastie Boys X Eric Haze', 70.00, 'champion_tshirt.png'),
(3, 'TheDripDistrict.    Original\'s', 50.00, 'TDD-tshirt.png'),
(4, 'Stussy 8 Ball Pigment Dyed', 80.00, 'stussy.png'),
(5, 'Y-3 X Real Madrid 23/24 Special Edition', 230.00, 'realmadrid.png'),
(6, 'Supreme Maradona ', 100.00, 'supremeXmaradona.png'),
(7, 'Anti Social Social Club Partly Cloudy', 80.00, 'assc.png'),
(8, 'Supreme x The North Face Printed Pocket', 100.00, 'tnf-tshirt.png'),
(9, 'Jordan x Travis Scott', 80.00, 'jordanXtravis.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `DataVenda` date DEFAULT NULL,
  `CodProduto` int(11) NOT NULL,
  `Quantidade` int(11) DEFAULT NULL,
  `PrecoUnitario` decimal(10,2) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`Codproduto`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`CodProduto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `Codproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
