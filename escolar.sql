-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Nov-2020 às 18:05
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escolar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `responsavel` varchar(20) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `data_cadastro` date NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `sexo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `cpf`, `telefone`, `email`, `endereco`, `responsavel`, `data_nascimento`, `data_cadastro`, `foto`, `sexo`) VALUES
(1, 'Felipe Santos', '788.888.888-88', '(99) 99999-9999', 'felipe@hotmail.com', 'Rua Almeida Campos 150', '', '2000-11-16', '2020-11-16', 'team-1.jpg', 'M'),
(2, 'Mariano Campos', '789.555.555-55', '(55) 55555-5555', 'mariano@hotmail.com', 'Rua Almeida Campos 145', '', '2001-11-16', '2020-11-16', 'usuario-icone.jpg', 'M'),
(3, 'Marina Silva', '875.555.555-55', '(55) 55555-5555', 'marina@hotmail.com', 'Rua C', '', '2000-11-16', '2020-11-16', 'team-2.jpg', 'F'),
(5, 'Rui Costaa', '488.888.888-88', '(33) 33333-3333', 'rui@hotmail.com', 'Rua Almeida Campos 150', '222.222.222-22', '2002-11-17', '2020-11-17', 'sem-foto.jpg', 'M');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `disciplinas`
--

INSERT INTO `disciplinas` (`id`, `nome`) VALUES
(1, 'Programação WEB'),
(2, 'WEB Designer'),
(4, 'Design Gráfico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `cargo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`, `cpf`, `email`, `telefone`, `endereco`, `cargo`) VALUES
(1, 'Matheus Santos', '788.888.888-88', 'mateus@hotmail.com', '(99) 99999-9999', 'Rua X', 'Porteiro'),
(2, 'Talita Silva', '899.999.999-99', 'talita@hotmail.com', '(99) 99999-9999', 'Rua Almeida Campos 150', 'Cantineira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL,
  `turma` int(11) NOT NULL,
  `aluno` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `matriculas`
--

INSERT INTO `matriculas` (`id`, `turma`, `aluno`, `data`) VALUES
(1, 1, 5, '2020-11-17'),
(3, 1, 1, '2020-11-17'),
(6, 2, 1, '2020-11-17'),
(7, 1, 2, '2020-11-17'),
(8, 2, 3, '2020-11-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`, `cpf`, `telefone`, `email`, `endereco`, `foto`) VALUES
(3, 'Professor Teste', '777.777.777-77', '(77) 77777-7777', 'professor@hotmail.com', 'Rua Almeida Campos 150', 'usuario-icone.jpg'),
(4, 'Hugo Vasconcelos', '788.888.888-88', '(88) 88888-8888', 'hugovasconcelosf@hotmail.com', 'Rua Almeida Campos 150', 'hugo-profile.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsaveis`
--

CREATE TABLE `responsaveis` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `responsaveis`
--

INSERT INTO `responsaveis` (`id`, `nome`, `cpf`, `email`, `telefone`, `endereco`) VALUES
(1, 'Katia Silva', '111.111.111-11', 'katia@hotmail.com', '(55) 55555-5555', 'Rua 5'),
(2, 'Kamilah Souza', '222.222.222-22', 'kamila@hotmail.com', '(22) 22222-2222', 'Rua C'),
(3, 'Tamara Freitas', '333.333.333-33', 'tamara@hotmail.com', '(33) 33333-3333', 'Rua G');

-- --------------------------------------------------------

--
-- Estrutura da tabela `salas`
--

CREATE TABLE `salas` (
  `id` int(11) NOT NULL,
  `sala` varchar(30) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `salas`
--

INSERT INTO `salas` (`id`, `sala`, `descricao`) VALUES
(1, '101', 'Segunda 09:00'),
(2, '102', 'Segunda 13:00'),
(3, '103', 'Segunda 18:00'),
(5, '104', 'Segunda 22:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `secretarios`
--

CREATE TABLE `secretarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `secretarios`
--

INSERT INTO `secretarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `endereco`) VALUES
(5, 'Marcos Paulo', 'marcos@hotmail.com', '555.555.555-55', '(55) 55555-5555', 'Rua Almeida Campos 145'),
(6, 'Secretário Teste', 'secretario@hotmail.com', '222.222.222-22', '(22) 22222-2222', 'Rua C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tesoureiros`
--

CREATE TABLE `tesoureiros` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tesoureiros`
--

INSERT INTO `tesoureiros` (`id`, `nome`, `cpf`, `telefone`, `email`, `endereco`) VALUES
(1, 'Marcelo Silva', '788.888.888-88', '(88) 88888-8888', 'marcelo@hotmail.com', 'Rua Almeida Campos 150'),
(2, 'Tesoureiro Teste', '789.555.555-55', '(63) 22222-2222', 'tesoureiro@hotmail.com', 'Rua A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `id` int(11) NOT NULL,
  `disciplina` int(11) NOT NULL,
  `sala` int(11) NOT NULL,
  `professor` int(11) NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_final` date DEFAULT NULL,
  `horario` varchar(30) DEFAULT NULL,
  `dia` varchar(30) DEFAULT NULL,
  `valor_mensalidade` decimal(7,2) DEFAULT NULL,
  `ano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id`, `disciplina`, `sala`, `professor`, `data_inicio`, `data_final`, `horario`, `dia`, `valor_mensalidade`, `ano`) VALUES
(1, 1, 2, 3, '2020-12-01', '2021-12-01', '8:00 as 12:00', 'Sexta-Feira', '80.00', 2020),
(2, 4, 1, 4, '2020-11-02', '2021-11-02', '13:00 as 17:00', 'Segunda a Sexta', '90.00', 2020);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `nivel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `email`, `senha`, `nivel`) VALUES
(5, 'Marcos Pedro', '555.555.555-55', 'marcos@hotmail.com', '123', 'secretaria'),
(6, 'Secretário Teste', '222.222.222-22', 'secretario@hotmail.com', '123', 'secretaria'),
(9, 'Professor Teste', '777.777.777-77', 'professor@hotmail.com', '123', 'professor'),
(10, 'Felipe Santos', '788.888.888-88', 'felipe@hotmail.com', '123', 'professor'),
(12, 'Administrador', '000.000.000-00', 'hvfadvocacia@gmail.com', '123', 'Admin'),
(13, 'Felipe Santos', '788.888.888-88', 'felipe@hotmail.com', '123', 'secretaria'),
(14, 'Tesoureiro Teste', '789.555.555-55', 'tesoureiro@hotmail.com', '123', 'secretaria'),
(15, 'Felipe Santos', '788.888.888-88', 'felipe@hotmail.com', '123', 'aluno'),
(16, 'Mariano Campos', '789.555.555-55', 'mariano@hotmail.com', '123', 'aluno'),
(17, 'Marina Silva', '875.555.555-55', 'marina@hotmail.com', '123', 'aluno'),
(19, 'Rui Costaa', '488.888.888-88', 'rui@hotmail.com', '123', 'aluno');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `responsaveis`
--
ALTER TABLE `responsaveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `secretarios`
--
ALTER TABLE `secretarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tesoureiros`
--
ALTER TABLE `tesoureiros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `responsaveis`
--
ALTER TABLE `responsaveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `secretarios`
--
ALTER TABLE `secretarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tesoureiros`
--
ALTER TABLE `tesoureiros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
