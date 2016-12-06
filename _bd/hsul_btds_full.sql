-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/12/2016 às 20:02
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

--
-- Fazendo dump de dados para tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `lucro_bruto`, `descricao`) VALUES
(000006, 'Aquecedor', '11.00', '11%   '),
(000007, 'Ar condicionado', '20.00', '20%'),
(000008, 'Piscina', '30.00', '30%'),
(000009, 'Conexões', '5.00', '5%'),
(000010, 'Tubos', '15.00', '15%'),
(000011, 'Bomba D''água', '50.00', '50%'),
(000012, 'Porca', '5.00', '5%');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades`
--

CREATE TABLE `cidades` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `estados_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira vinda da tabela de estados para conectar as informações. ',
  `nome` varchar(45) NOT NULL COMMENT 'Campo para nome da cidade.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para armazenamento dos nomes de cidades, que serão usadas em outros registros no software.';

--
-- Fazendo dump de dados para tabela `cidades`
--

INSERT INTO `cidades` (`id`, `estados_id`, `nome`) VALUES
(000009, 000009, 'Tarauacá'),
(000010, 000009, 'Rio Branco'),
(000011, 000005, 'Cantagalo'),
(000012, 000005, 'Curitiba'),
(000013, 000007, 'Rio de Janeiro'),
(000014, 000007, 'Guarujá'),
(000015, 000006, 'Farroupilha'),
(000016, 000006, 'Caxias do Sul'),
(000017, 000004, 'Joinville'),
(000018, 000004, 'Florianópolis'),
(000019, 000008, 'Santos'),
(000020, 000008, 'São Paulo'),
(000021, 000004, 'Blumenau'),
(000022, 000008, 'Jardim Ártico');

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

--
-- Fazendo dump de dados para tabela `clientes`
--

INSERT INTO `clientes` (`id`, `cidades_id`, `nome`, `cep`, `bairro`, `logradouro`, `complemento`, `observacoes`) VALUES
(000003, 000017, 'Antonio Silva', 89220870, 'Costa e Silva', 'Rua Corrêia Pinto', 'Casa', NULL),
(000004, 000013, 'Ana Maria', 89220594, 'Botafogo', 'Rua Fogueira', '-', NULL),
(000005, 000019, 'Alfredo Santos', 02563147, 'Jardins', 'Rua Jardineira', '-', NULL),
(000006, 000012, 'Larissa Medeiros', 89336596, 'Ganchinho', 'Rua São Expedito', 'Casa', NULL),
(000007, 000009, 'Janete da Rosa', 89652895, 'Centro', 'Rua Coronel Juvencio de Menezes', '-', NULL),
(000008, 000017, 'Wetzel', 89220870, 'Costa e Silva', 'Rua Rui Barbosa', '-', NULL),
(000009, 000012, 'Havan', 85623348, 'Centro', 'Rua Mineirinho', '-', NULL),
(000010, 000021, 'Park Europeu Shopping', 89226325, 'Centro', 'Rod. Paul Fritz Kuehnrich', '-', NULL),
(000011, 000020, 'Empresa Cruz Transportes', 14800250, 'Jardim Ártico', 'Avenida Cruzeiro Sul', '-', NULL);

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

--
-- Fazendo dump de dados para tabela `clientesfisicos`
--

INSERT INTO `clientesfisicos` (`id`, `clientes_id`, `data_nascimento`, `rg`, `cpf`, `telefone`, `email`, `numero_residencia`) VALUES
(000003, 000003, '1964-03-28', '6223596', 11025865280, 4734738455, 'antonio_silva@gmail.com', 123),
(000004, 000004, '1981-06-25', '6123589', 11025635950, 1130282258, 'ana_maria@gmail.com', 456),
(000005, 000005, '1956-02-29', '6112589', 00089220569, 1134596625, 'alfredo_santos@gmail.com', 562),
(000006, 000006, '1975-09-25', '6235998', 56235620489, 4130289655, 'larissa_medeiros@gmail.com', 489),
(000007, 000007, '1971-02-15', '6259862', 11045896350, 6834558962, 'janete_rosa@gmail.com', 158);

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

--
-- Fazendo dump de dados para tabela `clientesjuridicos`
--

INSERT INTO `clientesjuridicos` (`id`, `clientes_id`, `razao_social`, `atividade_principal`, `telefone_empresa`, `email_empresa`, `cnpj`, `numero_empresa`, `nome_representante`, `telefone_representante`) VALUES
(000001, 000008, 'Wetzel LTDA', 'Fundição', 4730289655, 'wetzel@wetzel.com', 859641258960001, 789, 'Laila Maria', 4799641159),
(000002, 000009, 'Havan Comércio', 'Comércio', 4130265599, 'havan@havan.com', 897564125960001, 526, 'Márcio do Amaral', 4799562236),
(000003, 000010, 'Park Europeu Shopping', 'Comércio', 4730286599, 'blumenau@shopping.com', 5623148596200001, 1600, 'Carlos Maia', 4799652289),
(000004, 000011, 'Empresa Cruz Transportes', 'Agência de passagens', 1122210214, 'empresa_cruz@gmail.com', 23232323232323, 1800, 'Paulo Souza', 119986689);

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

--
-- Fazendo dump de dados para tabela `entradasestoque`
--

INSERT INTO `entradasestoque` (`id`, `produtos_id`, `quantidade`, `valor_compra`, `data_entrada`, `observacoes`) VALUES
(000005, 000005, 10, '200.00', '2016-12-01', NULL),
(000006, 000008, 10, '500.00', '2016-12-01', NULL),
(000007, 000009, 15, '650.00', '2016-12-01', NULL),
(000008, 000010, 150, '2.00', '2016-12-01', NULL),
(000009, 000011, 10, '900.00', '2016-12-01', NULL),
(000010, 000014, 50, '23.00', '2016-12-01', NULL),
(000011, 000013, 20, '32.00', '2016-12-01', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estados`
--

CREATE TABLE `estados` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `nome` varchar(45) NOT NULL COMMENT 'Campo para nome do estado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para armazenamento dos nomes de estados, que serão usados em outros registros no software.';

--
-- Fazendo dump de dados para tabela `estados`
--

INSERT INTO `estados` (`id`, `nome`) VALUES
(000004, 'Santa Catarina'),
(000005, 'Paraná'),
(000006, 'Rio Grande do Sul'),
(000007, 'Rio de Janeiro '),
(000008, 'São Paulo'),
(000009, 'Acre');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoques`
--

CREATE TABLE `estoques` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `produtos_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `quantidade` int(4) UNSIGNED NOT NULL COMMENT 'Campo para quantidade de produtos em estoque, sendo resultado da subtração entre entradas e saídas.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para informações relacionadas aos produtos que estão disponíveis no esqtoque.';

--
-- Fazendo dump de dados para tabela `estoques`
--

INSERT INTO `estoques` (`id`, `produtos_id`, `quantidade`) VALUES
(000005, 000005, 7),
(000006, 000008, 10),
(000007, 000009, 15),
(000008, 000010, 147),
(000009, 000011, 9),
(000010, 000014, 50),
(000011, 000013, 20);

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

--
-- Fazendo dump de dados para tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `usuarios_id`, `cidades_id`, `nome_completo`, `data_nascimento`, `rg`, `cpf`, `telefone`, `email`, `cep`, `bairro`, `logradouro`, `numero_residencia`, `complemento`, `observacoes`) VALUES
(000001, 000001, 000017, 'Luiz Carlos', '1963-04-27', '6223564', 11042856520, 4730282110, 'hsul@hsul.com', 89220870, 'Costa e Silva', 'Rua Marquês de Olinda', 520, '-', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `marcas`
--

CREATE TABLE `marcas` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT ' Identificador único para cada atributo, não havendo possibilidade de repetição.',
  `nome` varchar(45) NOT NULL COMMENT 'Campo para o nome da marca.',
  `imagem` char(37) NOT NULL COMMENT 'Campo para a imagem pertencente a cada marca.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para armazenamento dos nomes das marcas de produto.';

--
-- Fazendo dump de dados para tabela `marcas`
--

INSERT INTO `marcas` (`id`, `nome`, `imagem`) VALUES
(000006, 'Tigre', '470caa243e0eca5918162c24a79346d8.png'),
(000007, 'Bosch', '80b3e8ff31cb5c3a26f0e4616f99ea44.png'),
(000008, 'Amanco', 'e5a5a91907893a76208cfdcf1c6841c3.png'),
(000009, 'Komeco', '9b095ed3f990f6228082b82cb4c764ca.png');

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

--
-- Fazendo dump de dados para tabela `orcamentos`
--

INSERT INTO `orcamentos` (`id`, `clientes_id`, `funcionarios_id`, `cidades_id`, `cep`, `bairro`, `logradouro`, `numero_residencia`, `complemento`, `data_validade`, `status`, `valor_mao_de_obra`, `desconto`, `descricao`, `data_inicio`, `motivo`, `comentario`, `data_conclusao`) VALUES
(000007, 000011, 000001, 000017, 12983742, 'Costa e Silva', 'Rua Corrêia Pinto', 165, '-', '2016-12-14', 1, '100.00', '10.00', NULL, '2016-12-02', NULL, NULL, NULL),
(000008, 000009, 000001, 000017, 19861542, 'Costa e Silva', 'Rua Corrêia Pinto', 124, '-', '2016-12-13', 0, '100.00', '10.00', NULL, NULL, NULL, NULL, NULL),
(000009, 000004, 000001, 000017, 9123864, 'Centro', 'Rua Dona Francisca', 1342, 'casa', '2016-12-14', 3, '300.00', '0.00', NULL, NULL, 'PF', NULL, NULL),
(000010, 000003, 000001, 000012, 12983673, 'Marco Antonio', 'Rua Fogueira', 652, 'casa', '2016-12-14', 0, '100.00', '0.00', NULL, NULL, NULL, NULL, NULL),
(000011, 000007, 000001, 000016, 17365421, 'Bugres ', 'Rua Marcio Gomes', 154, 'casa', '2016-12-14', 3, '800.00', '7.00', NULL, NULL, 'OM', NULL, NULL),
(000012, 000010, 000001, 000012, 39212736, 'João Costa', 'Rua Marinho Arnaldo', 1762, '-', '2016-12-12', 2, '0.00', '0.00', NULL, '2016-12-01', NULL, NULL, '2016-12-05');

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

--
-- Fazendo dump de dados para tabela `orcamentos_has_produtos`
--

INSERT INTO `orcamentos_has_produtos` (`orcamentos_id`, `produtos_id`, `quantidade_por_produto`, `valor_por_produto`) VALUES
(000007, 000005, 2, '220.00'),
(000007, 000008, 1, '600.00'),
(000007, 000010, 1, '2.10'),
(000008, 000009, 3, '975.00'),
(000008, 000010, 2, '2.10'),
(000009, 000011, 2, '1170.00'),
(000010, 000005, 4, '222.00'),
(000010, 000014, 2, '26.45'),
(000011, 000008, 3, '600.00'),
(000012, 000005, 4, '222.00'),
(000012, 000008, 6, '600.00'),
(000012, 000010, 10, '2.10'),
(000012, 000014, 10, '26.45');

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

--
-- Fazendo dump de dados para tabela `produtos`
--

INSERT INTO `produtos` (`id`, `marcas_id`, `categorias_id`, `nome`, `imagem`, `quantidade_minima`, `descricao`, `produtos_diversos`) VALUES
(000005, 000009, 000006, 'Aquecedor linha branca', 'f181f8313767de407bbc635b12030cbb.png', 2, NULL, '2'),
(000006, 000009, 000006, 'Aquecedor linha azul', '989199256f88bb04ab1b5940c7c77f1c.png', 3, NULL, '2'),
(000007, 000009, 000007, 'Ar condicionado linha verde', 'dfeac1468d1b032ec27786d684e1bbae.png', 3, NULL, '2'),
(000008, 000009, 000007, 'Ar condicionado linha rosa', '562be72ae8c5ef5d64cfa6dc23d94e83.png', 2, NULL, '2'),
(000009, 000007, 000011, 'bomba linha amarelo', '9ec2d83918230528956475162cc395e6.png', 2, NULL, '2'),
(000010, 000008, 000009, 'Conexão TS', '5d1d0a9227ab7e69991eb89f876df3a1.png', 5, 'Pacotes com 100 unidades', '1'),
(000011, 000006, 000008, 'Piscina 20x20 larga', '36c6c576b78f951d60df0aa00590d737.png', 2, NULL, '2'),
(000013, 000008, 000012, 'Porca GC', '22a946fee721ccaa6f664337f75c77b1.png', 6, 'pacotes com 100 unidades', '1'),
(000014, 000006, 000010, 'Tubos 100 cm', 'a996ab869838b1e20e63fe39f8159e98.png', 5, NULL, '1');

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

--
-- Fazendo dump de dados para tabela `saidasestoque`
--

INSERT INTO `saidasestoque` (`id`, `estoques_id`, `quantidade`, `data_saida`, `observacoes`) VALUES
(000001, 000005, 3, '2016-12-02', NULL),
(000002, 000008, 3, '2016-12-02', NULL),
(000003, 000009, 1, '2016-12-05', NULL);

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
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `permissao`) VALUES
(000001, 'adm', 'c0efa0d17465bbff15a278c7cc7a37ea', 0);

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
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `clientesfisicos`
--
ALTER TABLE `clientesfisicos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT ' Identificador único para cada atributo, não havendo possibilidade de repetição.\n', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `clientesjuridicos`
--
ALTER TABLE `clientesjuridicos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `entradasestoque`
--
ALTER TABLE `entradasestoque`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `estoques`
--
ALTER TABLE `estoques`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT ' Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT ' Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de tabela `saidasestoque`
--
ALTER TABLE `saidasestoque`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada atributo, não havendo possibilidade de repetição.', AUTO_INCREMENT=3;
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
