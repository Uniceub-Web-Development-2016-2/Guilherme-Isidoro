-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 24/10/2016 às 00:11
-- Versão do servidor: 10.1.16-MariaDB
-- Versão do PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";




/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mydb`
--
CREATE DATABASE IF NOT EXISTS mydb;
USE mydb;
-- --------------------------------------------------------

--
-- Estrutura para tabela `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `country` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `city_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `privileges`
--

CREATE TABLE `privileges` (
  `id` int(11) NOT NULL,
  `privilege` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `routes`
--

CREATE TABLE `routes` (
  `id` varchar(5) NOT NULL,
  `starting_point` varchar(60) NOT NULL,
  `ending_point` varchar(60) NOT NULL,
  `fare` varchar(5) NOT NULL,
  `extension` varchar(6) NOT NULL,
  `denomination` varchar(110) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `city_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `schedules`
--

CREATE TABLE `schedules` (
  `route_number` varchar(5) NOT NULL,
  `schedule` varchar(3000) NOT NULL,
  `weekday` varchar(45) NOT NULL,
  `city_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fav_routes` varchar(100) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `privilege_ID` int(11) NOT NULL,
  `city_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `city_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `route_number` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_company_tb_city1_idx` (`city_ID`);

--
-- Índices de tabela `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_routes_tb_company_idx` (`company_ID`),
  ADD KEY `fk_tb_routes_tb_city1_idx` (`city_ID`);

--
-- Índices de tabela `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`route_number`),
  ADD KEY `fk_tb_schedules_tb_city1_idx` (`city_ID`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_user_tb_privileges1_idx` (`privilege_ID`),
  ADD KEY `fk_tb_user_tb_city1_idx` (`city_ID`);

--
-- Índices de tabela `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_vehicle_tb_city1_idx` (`city_ID`),
  ADD KEY `fk_tb_vehicle_tb_company1_idx` (`company_ID`),
  ADD KEY `fk_tb_vehicle_tb_routes1_idx` (`route_number`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
