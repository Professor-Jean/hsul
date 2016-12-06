-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/12/2016 às 17:29
-- Versão do servidor: 5.7.11-log
-- Versão do PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hsul_btds`
--
CREATE DATABASE IF NOT EXISTS `hsul_btds` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hsul_btds`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `nome` varchar(45) NOT NULL COMMENT 'Campo para o nome da categoria.',
  `lucro_bruto` decimal(5,2) UNSIGNED NOT NULL COMMENT 'Campo para designar a porcentagem de cada categoria.',
  `descricao` text COMMENT 'Campo para descrição da categoria no software, não será obrigatória.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para armazenamentos das categorias de produto.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades`
--

CREATE TABLE `cidades` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `estados_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de estados para conectar as informações. ',
  `nome` varchar(45) NOT NULL COMMENT 'Campo para nome da cidade.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para armazenamento dos nomes de cidades, que serão usadas em outros registros no software.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `cidades_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de cidades para conectar as informações. ',
  `nome` varchar(45) NOT NULL COMMENT 'Campo para o nome do cliente, seja ele físico ou jurídico.',
  `cep` int(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo para o CEP do cliente, seja ele físico ou jurídico, provendo informações para a localização do mesmo.',
  `bairro` varchar(30) NOT NULL COMMENT 'Campo para o bairro do cliente, seja ele físico ou jurídico, provendo informações para a localização do mesmo.',
  `logradouro` varchar(45) NOT NULL COMMENT 'Campo para a rua do cliente, seja ele físico ou jurídico, provendo informações para a localização do mesmo.',
  `complemento` varchar(20) NOT NULL COMMENT 'Campo para o complemento da residência do cliente, seja ele físico ou jurídico.',
  `observacoes` text COMMENT 'Campo para as observações sobre o cliente, seja ele físico ou jurídico.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para informações que ambos tipos de cliente possuem em comum.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientesfisicos`
--

CREATE TABLE `clientesfisicos` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT ' Identificador único para cada atributo, não havendo possibilidade de repetição.\n',
  `clientes_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de clientes para conectar as informações. ',
  `data_nascimento` date NOT NULL COMMENT 'Campo para data de nascimento do cliente físico.',
  `rg` varchar(20) NOT NULL COMMENT 'Campo para Registro Geral (RG) do cliente físico.',
  `cpf` bigint(11) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo para Cadastro de Pessoa Física do cliente.',
  `telefone` bigint(15) UNSIGNED NOT NULL COMMENT 'Campo para telefone do cliente físico, para entrar em contato com o mesmo.',
  `email` varchar(70) NOT NULL COMMENT 'Campo para e-mail do cliente físico para, também, entrar em contato com o mesmo.',
  `numero_residencia` int(5) UNSIGNED NOT NULL COMMENT 'Campo para o número da residência do cliente físico, provendo a localização do mesmo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para informações exclusivas dos clientes físicos.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientesjuridicos`
--

CREATE TABLE `clientesjuridicos` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `clientes_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de clientes para conectar as informações. ',
  `razao_social` varchar(45) NOT NULL COMMENT 'Campo para a razão social da empresa.',
  `atividade_principal` varchar(20) NOT NULL COMMENT 'Campo para especificar a atividade principal do cliente jurídico.',
  `telefone_empresa` bigint(15) UNSIGNED NOT NULL COMMENT 'Campo para o telefone do cliente jurídico, para entrar em contato com o mesmo.',
  `email_empresa` varchar(70) NOT NULL COMMENT 'Campo para o e-mail do cliente jurídico para entrar em contato com o mesmo.',
  `cnpj` bigint(14) NOT NULL COMMENT 'Campo para CNPJ do cliente jurídico, provendo informações para a localização do mesmo.',
  `numero_empresa` int(5) UNSIGNED NOT NULL COMMENT 'Campo para número do estabelecimento do cliente jurídico, provendo informações para a localização do mesmo.',
  `nome_representante` varchar(45) NOT NULL COMMENT 'Campo para nome do representante da empresa, para entrar em contato com a empresa ou para algum aviso',
  `telefone_representante` bigint(15) UNSIGNED NOT NULL COMMENT 'Campo para telefone do representante da empresa, para entrar em contato com a empresa ou para algum aviso.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para informações exclusivas dos clientes jurídicos.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `entradasestoque`
--

CREATE TABLE `entradasestoque` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `produtos_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de produtos para conectar as informações. ',
  `quantidade` int(4) NOT NULL COMMENT 'Campo para quantidade de entrada dos produtos.',
  `valor_compra` decimal(7,2) UNSIGNED NOT NULL COMMENT 'Campo para o valor da compra dos produtos, sendo invisível para outros funcionários que não sejam administradores e funcionários.',
  `data_entrada` date NOT NULL COMMENT 'Campo para a data de entrada dos produtos, para ter um melhor controle.',
  `observacoes` text COMMENT 'Campo para as observações sobre a entrada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para informações relacionadas às entradas de produtos no estoque.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `estados`
--

CREATE TABLE `estados` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `nome` varchar(45) NOT NULL COMMENT 'Campo para nome do estado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para armazenamento dos nomes de estados, que serão usados em outros registros no software.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoques`
--

CREATE TABLE `estoques` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `produtos_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `quantidade` int(4) UNSIGNED NOT NULL COMMENT 'Campo para quantidade de produtos em estoque, sendo resultado da subtração entre entradas e saídas.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para informações relacionadas aos produtos que estão disponíveis no esqtoque.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `usuarios_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de usuários para conectar as informações. ',
  `cidades_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de cidades para conectar as informações. ',
  `nome_completo` varchar(45) NOT NULL COMMENT 'Campo para o nome completo do funcionário.',
  `data_nascimento` date NOT NULL COMMENT 'Campo para data de nascimento do funcionário.',
  `rg` varchar(20) NOT NULL COMMENT 'Campo para Registro Geral (RG) do funcionário.',
  `cpf` bigint(11) UNSIGNED ZEROFILL NOT NULL COMMENT 'Campo para Cadastro de Pessoa Física do funcionário.',
  `telefone` bigint(15) UNSIGNED NOT NULL COMMENT 'Campo para telefone do funcionário, para entrar em contato com o mesmo.',
  `email` varchar(70) NOT NULL COMMENT 'Campo para e-mail do funcionário para entrar em contato com o mesmo.',
  `cep` int(8) UNSIGNED NOT NULL COMMENT 'Campo para o CEP do funcionário, provendo informações para a localização do mesmo.',
  `bairro` varchar(30) NOT NULL COMMENT 'Campo para o bairro do funcionário, provendo informações para a localização do mesmo.',
  `logradouro` varchar(45) NOT NULL COMMENT ' Campo para a rua do funcionário, provendo informações para a localização do mesmo.',
  `numero_residencia` int(5) UNSIGNED NOT NULL COMMENT 'Campo para o número da residência do funcionário, provendo a localização do mesmo.',
  `complemento` varchar(20) NOT NULL COMMENT 'Campo para o complemento da residência do funcionário.',
  `observacoes` text COMMENT 'Campo para as observações sobre o funcionário.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para as informações pessoais dos funcionários cadastrados no software.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `marcas`
--

CREATE TABLE `marcas` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT ' Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `nome` varchar(45) NOT NULL COMMENT 'Campo para o nome da marca.',
  `imagem` char(37) NOT NULL COMMENT 'Campo para a imagem pertencente a cada marca.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para armazenamento dos nomes das marcas de produto.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `orcamentos`
--

CREATE TABLE `orcamentos` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT ' Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `clientes_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de clientes para conectar as informações. ',
  `funcionarios_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de funcionários para conectar as informações. ',
  `cidades_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de cidades para conectar as informações. ',
  `cep` int(8) UNSIGNED NOT NULL,
  `bairro` varchar(30) NOT NULL COMMENT 'Campo para o bairro do cliente, provendo informações para a localização do serviço.',
  `logradouro` varchar(45) NOT NULL COMMENT 'Campo para a rua do cliente, provendo informações para a localização do serviço.',
  `numero_residencia` int(5) UNSIGNED NOT NULL,
  `complemento` varchar(20) NOT NULL,
  `data_validade` date NOT NULL COMMENT 'Campo para a data de validade do orçamento, após expirada esta data, o orçamento será invalidado.',
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT 'Campo para o status, para definir se o orçamento está pendente, confirmado, realizado, declinado.',
  `valor_mao_de_obra` decimal(7,2) UNSIGNED DEFAULT NULL COMMENT 'Campo para o desconto do orçamento do serviço.',
  `desconto` decimal(5,2) UNSIGNED DEFAULT NULL COMMENT 'Campo para o desconto do orçamento do serviço.',
  `descricao` text COMMENT 'Campo para descrição do orçamento no software, não será obrigatório.',
  `data_inicio` date DEFAULT NULL COMMENT 'Campo para data de início do serviço orçado, pode ser nula, podendo ser preenchida após marcar o orçamento como confirmado.',
  `motivo` char(2) DEFAULT NULL COMMENT 'Campo para o motivo da declinação.',
  `comentario` text COMMENT 'Campo para comentários sobre o motivo da declinação.',
  `data_conclusao` date DEFAULT NULL COMMENT 'Campo para a data de conclusão, podendo ser nula, e apenas preenchida após marcar o orçamento como realizado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para armazenamento das informações relacionadas ao orçamento.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `orcamentos_has_produtos`
--

CREATE TABLE `orcamentos_has_produtos` (
  `orcamentos_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de orçamentos para conectar as informações. ',
  `produtos_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de produtos para conectar as informações. ',
  `quantidade_por_produto` int(4) UNSIGNED NOT NULL COMMENT 'Campo para quantidade por produto, especificando a quantidade presente de cada produto no orçamento. ',
  `valor_por_produto` decimal(7,2) UNSIGNED NOT NULL COMMENT 'Campo para valor por produto, especificando o valor unitário de cada produto no orçamento.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `marcas_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de marcas para conectar as informações. ',
  `categorias_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `nome` varchar(45) NOT NULL COMMENT 'Campo para o nome do produto.',
  `imagem` char(37) NOT NULL COMMENT 'Campo para a imagem pertencente a cada produto.',
  `quantidade_minima` int(4) UNSIGNED NOT NULL COMMENT 'Campo para designar a quantidade miníma de cada produto no estoque.',
  `descricao` text COMMENT 'Campo para descrição do produto, não será obrigatória.',
  `produtos_diversos` char(1) DEFAULT NULL COMMENT 'Campo selecionável, podendo ser null, para designar peças pequenas, para um tratamento diferenciado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para as informações de cada produto.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `saidasestoque`
--

CREATE TABLE `saidasestoque` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `estoques_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de estoques para conectar as informações. ',
  `quantidade` int(4) UNSIGNED NOT NULL COMMENT 'Campo para quantidade de saída dos produtos, sendo subtraído da entidade Estoque.',
  `data_saida` date NOT NULL COMMENT 'Campo para data de saída dos produtos, para ter um melhor controle.',
  `observacoes` text COMMENT 'Campo para as observações sobre o funcionário.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para informações relacionadas à saida de produtos do estoque.';

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `usuario` varchar(20) NOT NULL COMMENT 'Campo para o usuário pertencente ao funcionário, cada funcionário deverá ter apenas um usuário.',
  `senha` char(32) NOT NULL COMMENT 'Campo para a senha pertencente ao funcionário, cada funcionário deverá ter apenas uma senha.',
  `permissao` tinyint(1) UNSIGNED NOT NULL COMMENT 'Campo para a permissão do usuário, cada funcionário deverá ter apenas uma permissão relacionada ao seu nível de usuário dentro do software.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para as informações de login dos funcionários cadastrados no software.';

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cidades_estados1_idx` (`estados_id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clientes_cidades1_idx` (`cidades_id`);

--
-- Índices de tabela `clientesfisicos`
--
ALTER TABLE `clientesfisicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clientesfisicos_clientes_idx` (`clientes_id`);

--
-- Índices de tabela `clientesjuridicos`
--
ALTER TABLE `clientesjuridicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clientesjuridicos_clientes1_idx` (`clientes_id`);

--
-- Índices de tabela `entradasestoque`
--
ALTER TABLE `entradasestoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entradasestoque_produtos1_idx` (`produtos_id`);

--
-- Índices de tabela `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `estoques`
--
ALTER TABLE `estoques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estoques_produtos1_idx` (`produtos_id`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_funcionarios_cidades1_idx` (`cidades_id`),
  ADD KEY `fk_funcionarios_usuarios1_idx` (`usuarios_id`);

--
-- Índices de tabela `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orcamentos_clientes1_idx` (`clientes_id`),
  ADD KEY `fk_orcamentos_funcionarios1_idx` (`funcionarios_id`),
  ADD KEY `fk_orcamentos_cidades1_idx` (`cidades_id`);

--
-- Índices de tabela `orcamentos_has_produtos`
--
ALTER TABLE `orcamentos_has_produtos`
  ADD PRIMARY KEY (`orcamentos_id`,`produtos_id`),
  ADD KEY `fk_orcamentos_has_produtos1_produtos1_idx` (`produtos_id`),
  ADD KEY `fk_orcamentos_has_produtos1_orcamentos1_idx` (`orcamentos_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produtos_marcas1_idx` (`marcas_id`),
  ADD KEY `fk_produtos_categorias1_idx` (`categorias_id`);

--
-- Índices de tabela `saidasestoque`
--
ALTER TABLE `saidasestoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_saidasestoque_estoques1_idx` (`estoques_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `clientesfisicos`
--
ALTER TABLE `clientesfisicos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT ' Identificador único para cada atributo, não havendo possibilidade de repetição.\n', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `clientesjuridicos`
--
ALTER TABLE `clientesjuridicos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.';
--
-- AUTO_INCREMENT de tabela `entradasestoque`
--
ALTER TABLE `entradasestoque`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `estoques`
--
ALTER TABLE `estoques`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT ' Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT ' Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `saidasestoque`
--
ALTER TABLE `saidasestoque`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.';
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=2;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `cidades`
--
ALTER TABLE `cidades`
  ADD CONSTRAINT `fk_cidades_estados1` FOREIGN KEY (`estados_id`) REFERENCES `estados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_cidades1` FOREIGN KEY (`cidades_id`) REFERENCES `cidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `clientesfisicos`
--
ALTER TABLE `clientesfisicos`
  ADD CONSTRAINT `fk_clientesfisicos_clientes` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `clientesjuridicos`
--
ALTER TABLE `clientesjuridicos`
  ADD CONSTRAINT `fk_clientesjuridicos_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `entradasestoque`
--
ALTER TABLE `entradasestoque`
  ADD CONSTRAINT `fk_entradasestoque_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `estoques`
--
ALTER TABLE `estoques`
  ADD CONSTRAINT `fk_estoques_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `fk_funcionarios_cidades1` FOREIGN KEY (`cidades_id`) REFERENCES `cidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_funcionarios_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD CONSTRAINT `fk_orcamentos_cidades1` FOREIGN KEY (`cidades_id`) REFERENCES `cidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orcamentos_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orcamentos_funcionarios1` FOREIGN KEY (`funcionarios_id`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `orcamentos_has_produtos`
--
ALTER TABLE `orcamentos_has_produtos`
  ADD CONSTRAINT `fk_orcamentos_has_produtos1_orcamentos1` FOREIGN KEY (`orcamentos_id`) REFERENCES `orcamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orcamentos_has_produtos1_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias1` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produtos_marcas1` FOREIGN KEY (`marcas_id`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `saidasestoque`
--
ALTER TABLE `saidasestoque`
  ADD CONSTRAINT `fk_saidasestoque_estoques1` FOREIGN KEY (`estoques_id`) REFERENCES `estoques` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
