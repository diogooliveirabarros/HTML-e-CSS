-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Jan-2017 às 13:22
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dob`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `casas`
--

CREATE TABLE `casas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `Endereco` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `complemento` varchar(50) NOT NULL,
  `comprimento` varchar(50) NOT NULL,
  `largura` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `quartos` int(50) NOT NULL,
  `suite` int(50) NOT NULL,
  `garagem` varchar(50) NOT NULL,
  `preço` varchar(50) NOT NULL,
  `fotos` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabela para cadastro de imoveis';

-- --------------------------------------------------------

--
-- Estrutura da tabela `terrenos`
--

CREATE TABLE `terrenos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `endereco` int(50) NOT NULL,
  `complemento` int(50) NOT NULL,
  `bairro` int(50) NOT NULL,
  `comprimento` int(50) NOT NULL,
  `largura` int(50) NOT NULL,
  `area` int(50) NOT NULL,
  `preco` int(50) NOT NULL,
  `mensagem` int(100) NOT NULL,
  `foto` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabela para cadastro de terrenos';

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `Nome` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `Sobrenome` varchar(20) NOT NULL,
  `Telefone` varchar(13) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabela par cadastro de usuarios';

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`Nome`, `id`, `Sobrenome`, `Telefone`, `Email`, `Senha`) VALUES
('marlon', 6, 'brito', '79-98117-3434', 'vader@email', '2db1850a4fe292bd2706');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `casas`
--
ALTER TABLE `casas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terrenos`
--
ALTER TABLE `terrenos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `casas`
--
ALTER TABLE `casas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `terrenos`
--
ALTER TABLE `terrenos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
