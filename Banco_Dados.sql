-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Abr-2021 às 03:43
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `quebragalho`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncio`
--

CREATE TABLE `anuncio` (
  `idAnuncio` int(11) NOT NULL,
  `emprego` varchar(45) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  `detalhes` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `dataInicio` date NOT NULL,
  `contratante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `interesse`
--

CREATE TABLE `interesse` (
  `idInteresse` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idAnuncio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUser` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `escolha` varchar(45) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `membro` varchar(45) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `escolaridade` varchar(45) DEFAULT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `avatar` varchar(45) DEFAULT NULL,
  `emailcontato` varchar(45) NOT NULL,
  `dataMembro` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUser`, `email`, `senha`, `escolha`, `cpf`, `membro`, `nome`, `sobrenome`, `sexo`, `escolaridade`, `endereco`, `complemento`, `cidade`, `estado`, `cep`, `descricao`, `numero`, `avatar`, `emailcontato`, `dataMembro`) VALUES
(11, 'thuask.almeida@gmail.com', '123', '1', NULL, 'Membro', 'Thiago', 'almeida', 'Masculino', 'Ensino Médio', 'Seila', 'Seila', 'Brasilia', 'Distrito Federal', '73080-900', 'Seila', '(61) 99564-4704', '606f947477c41.jpg', 'thuask.almeida@gmail.com', '2021-05-13'),
(13, 'teste@gmail.com', '123', '2', NULL, 'Gratis', 'Teste', 'teste', 'Outro', 'Ensino Superior Completo', 'testinho', 'testinho', 'Brasilia', 'Distrito Federal', '00000-000', NULL, '(00) 00000-0000', 'user.png', 'teste@gmail.com', '0000-00-00'),
(15, 'SQAWEAWE@serfsefresf', '123', '0', NULL, '0', 'awdawd', NULL, 'Selecione', 'Selecione', NULL, NULL, NULL, 'Selecione', NULL, NULL, NULL, 'user.png', '', '2021-04-13'),
(16, 'juju@gmail.com', '123', '0', NULL, '0', '', NULL, 'Selecione', 'Selecione', NULL, NULL, NULL, 'Selecione', NULL, NULL, NULL, 'user.png', '', '2021-04-13'),
(17, 'hihi@gmail.com', '123', '0', NULL, '0', '', NULL, 'Selecione', 'Selecione', NULL, NULL, NULL, 'Selecione', NULL, NULL, NULL, 'user.png', '', '2021-04-13'),
(18, 'hihihihi@gmail.com', '123', '0', NULL, '0', '', NULL, 'Selecione', 'Selecione', NULL, NULL, NULL, 'Selecione', NULL, NULL, NULL, 'user.png', '', '2021-04-13'),
(20, 'hihihihiha@gmail.com', '123', '0', NULL, '0', '', NULL, 'Selecione', 'Selecione', NULL, NULL, NULL, 'Selecione', NULL, NULL, NULL, 'user.png', '', '2021-04-13'),
(21, '1111@gmail.com', '123', '0', NULL, '0', '', NULL, 'Selecione', 'Selecione', NULL, NULL, NULL, 'Selecione', NULL, NULL, NULL, 'user.png', '', '2021-04-13'),
(23, '2@gmail.com', '12', '0', NULL, '0', '', NULL, 'Selecione', 'Selecione', NULL, NULL, NULL, 'Selecione', NULL, NULL, NULL, 'user.png', '', '2021-04-13'),
(26, '11111111111@gmail.com', '123', '0', NULL, '0', '', NULL, 'Selecione', 'Selecione', NULL, NULL, NULL, 'Selecione', NULL, NULL, NULL, 'user.png', '', '2021-04-13'),
(28, '111112222211111@gmail.com', '123', '0', NULL, '0', '', NULL, 'Selecione', 'Selecione', NULL, NULL, NULL, 'Selecione', NULL, NULL, NULL, 'user.png', '', '2021-04-13'),
(29, 'thiago@gmail.com', '123', '1', NULL, 'Gratis', 'Thiago almeida', NULL, 'Selecione', 'Selecione', NULL, NULL, NULL, 'Selecione', NULL, NULL, NULL, 'user.png', '', '0000-00-00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`idAnuncio`),
  ADD KEY `fk_anuncio_usuario1_idx` (`idUser`);

--
-- Índices para tabela `interesse`
--
ALTER TABLE `interesse`
  ADD PRIMARY KEY (`idInteresse`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `idAnuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `interesse`
--
ALTER TABLE `interesse`
  MODIFY `idInteresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `fk_anuncio_usuario1` FOREIGN KEY (`idUser`) REFERENCES `usuario` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
