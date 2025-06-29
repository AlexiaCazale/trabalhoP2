-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/06/2025 às 00:15
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
  `data_entrega_atividade` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data_criacao_atividade` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo_atividade` tinyint(1) NOT NULL DEFAULT 1,
  `concluido_atividade` tinyint(1) NOT NULL DEFAULT 0,
  `data_concluido_atividade` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atividade`
--

INSERT INTO `atividade` (`id_atividade`, `id_workspace_fk`, `nome_atividade`, `descricao_atividade`, `data_entrega_atividade`, `data_criacao_atividade`, `ativo_atividade`, `concluido_atividade`, `data_concluido_atividade`) VALUES
(2, 4, 'Tsete', 'agsgasg', '2025-07-10 03:00:00', '2025-06-29 18:35:12', 1, 0, NULL),
(3, 4, 'scshds', 'asgkaksgn', '2025-08-10 03:00:00', '2025-06-29 18:41:22', 1, 0, NULL),
(4, 4, 'asfgasg', '15125', '2025-12-12 03:00:00', '2025-06-29 19:18:46', 1, 0, NULL),
(6, 4, 'asgas', '1251', '0000-00-00 00:00:00', '2025-06-29 19:19:08', 1, 0, NULL),
(7, 4, 'asghdasg', '2222', '0000-00-00 00:00:00', '2025-06-29 19:19:18', 1, 0, NULL),
(8, 4, '222', '22', '0000-00-00 00:00:00', '2025-06-29 19:19:23', 1, 0, NULL),
(9, 4, 'asgfa', '121', '0000-00-00 00:00:00', '2025-06-29 19:25:50', 1, 0, NULL),
(10, 4, 'AGSA', '123515', '0000-00-00 00:00:00', '2025-06-29 19:58:28', 1, 0, NULL),
(11, 4, 'agsasg', 'asgasg', '0000-00-00 00:00:00', '2025-06-29 20:01:03', 1, 0, NULL),
(12, 4, 'asga', 'asfasf', '0000-00-00 00:00:00', '2025-06-29 20:01:39', 1, 0, NULL),
(13, 4, 'asgasg', 'asgasg', '0000-00-00 00:00:00', '2025-06-29 20:02:38', 1, 0, NULL),
(14, 5, 'asgasg', 'agsasg', '0000-00-00 00:00:00', '2025-06-29 21:27:01', 1, 0, NULL),
(15, 4, 'Eu n sei oq tem q testar com bastante coisa', 'Eu n sei oq tem q testar com bastante coisaEu n sei oq tem q testar com bastante coisaEu n sei oq tem q testar com bastante coisaEu n sei oq tem q testar com bastante coisa', '0000-00-00 00:00:00', '2025-06-29 21:53:41', 1, 0, NULL);

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

--
-- Despejando dados para a tabela `membro_atividade`
--

INSERT INTO `membro_atividade` (`id_membro_atividade`, `id_usuario_fk`, `id_atividade_fk`) VALUES
(1, 1, 2),
(2, 1, 2),
(4, 1, 3),
(7, 1, 14),
(11, 1, 15),
(3, 2, 2),
(5, 2, 4),
(6, 2, 10),
(8, 2, 14),
(12, 2, 15),
(9, 3, 14),
(10, 4, 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `membro_workspace`
--

CREATE TABLE `membro_workspace` (
  `id_membro_workspace` int(11) NOT NULL,
  `id_workspace_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `membro_workspace`
--

INSERT INTO `membro_workspace` (`id_membro_workspace`, `id_workspace_fk`, `id_usuario_fk`) VALUES
(5, 3, 2),
(7, 4, 1),
(8, 4, 1),
(9, 4, 2),
(6, 4, 4),
(10, 5, 1),
(11, 5, 2),
(12, 5, 3),
(13, 5, 4);

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

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `avatar_usuario`, `ativo_usuario`) VALUES
(1, 'Bruno Pavan', 'bruno@gmail.com', '$2y$10$bDjmTaEy8gXw0Oqj6K2P4O33/C7p2dvVZ0.jgSTVFA.0VLYcxVunG', NULL, 1),
(2, 'asdas', '123@123.com', '$2y$10$CqAdcXpaM4NBY68GabJKOeFOMCVGXw0ztPND0sRlEWr4GkAnR2j1q', NULL, 1),
(3, 'Novo usuario', 'teste@gmail.com', '$2y$10$qpGrfbLM.ZpvmSH2Pdz2xuQZ3Clf/8ZMje6fdBwxXneM63VmUFoIm', NULL, 1),
(4, 'Tasdtas', 'novo@gmail.com', '$2y$10$HEa38E4xuU34EE/pY9d2Iu4EGde.eWy1wByUMpme0/.L6KZp/XLy6', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `workspace`
--

CREATE TABLE `workspace` (
  `id_workspace` int(11) NOT NULL,
  `nome_workspace` varchar(200) NOT NULL,
  `descricao_workspace` varchar(1000) NOT NULL,
  `ativo_workspace` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `workspace`
--

INSERT INTO `workspace` (`id_workspace`, `nome_workspace`, `descricao_workspace`, `ativo_workspace`) VALUES
(3, 'Teste de workspace', 'ansgiasg', 1),
(4, 'N sie oq la', 'ansfiauf', 1),
(5, 'N sei oq la ', 'asgfinaisnf', 1);

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
-- Índices de tabela `membro_workspace`
--
ALTER TABLE `membro_workspace`
  ADD PRIMARY KEY (`id_membro_workspace`),
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
  ADD PRIMARY KEY (`id_workspace`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id_atividade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `membro_atividade`
--
ALTER TABLE `membro_atividade`
  MODIFY `id_membro_atividade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `membro_workspace`
--
ALTER TABLE `membro_workspace`
  MODIFY `id_membro_workspace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `workspace`
--
ALTER TABLE `workspace`
  MODIFY `id_workspace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atividade`
--
ALTER TABLE `atividade`
  ADD CONSTRAINT `atividade_ibfk_1` FOREIGN KEY (`id_workspace_fk`) REFERENCES `workspace` (`id_workspace`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Restrições para tabelas `membro_workspace`
--
ALTER TABLE `membro_workspace`
  ADD CONSTRAINT `membro_workspace_ibfk_1` FOREIGN KEY (`id_workspace_fk`) REFERENCES `workspace` (`id_workspace`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membro_workspace_ibfk_2` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
