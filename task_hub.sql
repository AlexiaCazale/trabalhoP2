-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10/06/2025 às 18:36
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `task_hub`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividade`
--

CREATE TABLE `atividade` (
  `id_atividade` int(11) NOT NULL,
  `id_workplace_fk` int(11) NOT NULL,
  `nome_atividade` varchar(500) NOT NULL,
  `descricao_atividade` varchar(5000) NOT NULL,
  `data_entrega` date NOT NULL,
  `data_criacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_atividade_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `texto_comentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `membro_atividade`
--

CREATE TABLE `membro_atividade` (
  `id_membro_atividade` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_atividade_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `membro_workplace`
--

CREATE TABLE `membro_workplace` (
  `id_membro_workplace` int(11) NOT NULL,
  `id_workplace_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(200) NOT NULL,
  `email_usuario` varchar(200) NOT NULL,
  `senha_usuario` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `workplace`
--

CREATE TABLE `workplace` (
  `id_workplace` int(11) NOT NULL,
  `nome_workplace` varchar(200) NOT NULL,
  `descicao_workplace` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id_atividade`),
  ADD KEY `id_workplace_fk` (`id_workplace_fk`);

--
-- Índices de tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_atividade_fk` (`id_atividade_fk`,`id_usuario_fk`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Índices de tabela `membro_atividade`
--
ALTER TABLE `membro_atividade`
  ADD PRIMARY KEY (`id_membro_atividade`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`,`id_atividade_fk`),
  ADD KEY `id_atividade_fk` (`id_atividade_fk`);

--
-- Índices de tabela `membro_workplace`
--
ALTER TABLE `membro_workplace`
  ADD PRIMARY KEY (`id_membro_workplace`),
  ADD KEY `id_workplace_fk` (`id_workplace_fk`,`id_usuario_fk`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices de tabela `workplace`
--
ALTER TABLE `workplace`
  ADD PRIMARY KEY (`id_workplace`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id_atividade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `membro_atividade`
--
ALTER TABLE `membro_atividade`
  MODIFY `id_membro_atividade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `membro_workplace`
--
ALTER TABLE `membro_workplace`
  MODIFY `id_membro_workplace` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `workplace`
--
ALTER TABLE `workplace`
  MODIFY `id_workplace` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atividade`
--
ALTER TABLE `atividade`
  ADD CONSTRAINT `atividade_ibfk_1` FOREIGN KEY (`id_workplace_fk`) REFERENCES `workplace` (`id_workplace`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_atividade_fk`) REFERENCES `atividade` (`id_atividade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `membro_atividade`
--
ALTER TABLE `membro_atividade`
  ADD CONSTRAINT `membro_atividade_ibfk_1` FOREIGN KEY (`id_atividade_fk`) REFERENCES `atividade` (`id_atividade`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membro_atividade_ibfk_2` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `membro_workplace`
--
ALTER TABLE `membro_workplace`
  ADD CONSTRAINT `membro_workplace_ibfk_1` FOREIGN KEY (`id_workplace_fk`) REFERENCES `workplace` (`id_workplace`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membro_workplace_ibfk_2` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
