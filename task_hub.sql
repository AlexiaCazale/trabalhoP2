-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30/06/2025 às 17:20
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
  `id_workspace_fk` int(11) NOT NULL,
  `nome_atividade` varchar(500) NOT NULL,
  `descricao_atividade` varchar(5000) NOT NULL,
  `data_entrega_atividade` datetime NOT NULL,
  `data_criacao_atividade` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo_atividade` tinyint(1) NOT NULL DEFAULT 1,
  `concluido_atividade` tinyint(1) NOT NULL DEFAULT 0,
  `data_concluido_atividade` timestamp NULL DEFAULT NULL
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
-- Estrutura para tabela `membro_workspace`
--

CREATE TABLE `membro_workspace` (
  `id_membro_workspace` int(11) NOT NULL,
  `id_workspace_fk` int(11) NOT NULL,
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
  `senha_usuario` varchar(2000) NOT NULL,
  `avatar_usuario` varchar(1000) DEFAULT NULL,
  `ativo_usuario` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `workspace`
--

CREATE TABLE `workspace` (
  `id_workspace` int(11) NOT NULL,
  `nome_workspace` varchar(200) NOT NULL,
  `descricao_workspace` varchar(1000) NOT NULL,
  `id_usuario_admin_fk` int(11) NOT NULL,
  `ativo_workspace` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id_atividade`),
  ADD KEY `id_workplace_fk` (`id_workspace_fk`),
  ADD KEY `concluido_atividade` (`concluido_atividade`);

--
-- Índices de tabela `membro_atividade`
--
ALTER TABLE `membro_atividade`
  ADD PRIMARY KEY (`id_membro_atividade`),
  ADD UNIQUE KEY `unique_atividade_usuario` (`id_atividade_fk`,`id_usuario_fk`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`,`id_atividade_fk`),
  ADD KEY `id_atividade_fk` (`id_atividade_fk`);

--
-- Índices de tabela `membro_workspace`
--
ALTER TABLE `membro_workspace`
  ADD PRIMARY KEY (`id_membro_workspace`),
  ADD UNIQUE KEY `unique_workspace_usuario` (`id_workspace_fk`,`id_usuario_fk`),
  ADD KEY `id_workplace_fk` (`id_workspace_fk`,`id_usuario_fk`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email_usuario` (`email_usuario`);

--
-- Índices de tabela `workspace`
--
ALTER TABLE `workspace`
  ADD PRIMARY KEY (`id_workspace`),
  ADD KEY `fk_workspace_admin` (`id_usuario_admin_fk`);

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
-- AUTO_INCREMENT de tabela `membro_workspace`
--
ALTER TABLE `membro_workspace`
  MODIFY `id_membro_workspace` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `workspace`
--
ALTER TABLE `workspace`
  MODIFY `id_workspace` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atividade`
--
ALTER TABLE `atividade`
  ADD CONSTRAINT `atividade_ibfk_1` FOREIGN KEY (`id_workspace_fk`) REFERENCES `workspace` (`id_workspace`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `membro_atividade`
--
ALTER TABLE `membro_atividade`
  ADD CONSTRAINT `membro_atividade_ibfk_1` FOREIGN KEY (`id_atividade_fk`) REFERENCES `atividade` (`id_atividade`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membro_atividade_ibfk_2` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `membro_workspace`
--
ALTER TABLE `membro_workspace`
  ADD CONSTRAINT `membro_workspace_ibfk_1` FOREIGN KEY (`id_workspace_fk`) REFERENCES `workspace` (`id_workspace`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membro_workspace_ibfk_2` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `workspace`
--
ALTER TABLE `workspace`
  ADD CONSTRAINT `fk_workspace_admin` FOREIGN KEY (`id_usuario_admin_fk`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
