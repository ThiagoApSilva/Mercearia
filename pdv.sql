create database pdv;
  use pdv;

CREATE TABLE `caixa` (
  `id` int auto_increment primary key,
  `data_ab` date NOT NULL,
  `hora_ab` time NOT NULL,
  `valor_ab` decimal(8,2) NOT NULL,
  `gerente_ab` int(11) NOT NULL,
  `data_fec` date DEFAULT NULL,
  `hora_fec` time DEFAULT NULL,
  `valor_fec` decimal(8,2) DEFAULT NULL,
  `valor_vendido` decimal(8,2) DEFAULT NULL,
  `valor_quebra` decimal(8,2) DEFAULT NULL,
  `gerente_fec` int(11) DEFAULT NULL,
  `caixa` int(11) NOT NULL,
  `operador` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `caixas` (
  `id` int auto_increment primary key,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `categorias` (
  `id` int auto_increment primary key,
  `nome` varchar(50) NOT NULL,
  `foto` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `compras` (
  `id` int auto_increment primary key,
  `total` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `usuario` int(11) NOT NULL,
  `fornecedor` int(11) NOT NULL,
  `pago` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `contas_pagar` (
  `id` int auto_increment primary key,
  `descricao` varchar(100) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `pago` varchar(5) NOT NULL,
  `data` date NOT NULL,
  `vencimento` date NOT NULL,
  `arquivo` varchar(150) DEFAULT NULL,
  `id_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `contas_receber` (
  `id` int auto_increment primary key,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `pago` varchar(5) NOT NULL,
  `data` date NOT NULL,
  `vencimento` date NOT NULL,
  `arquivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `forma_pgtos` (
  `id` int auto_increment primary key,
  `codigo` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `fornecedores` (
  `id` int auto_increment primary key,
  `nome` varchar(50) NOT NULL,
  `tipo_pessoa` varchar(10) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `itens_venda` (
  `id` int auto_increment primary key,
  `produto` int(11) NOT NULL,
  `valor_unitario` decimal(8,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `venda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `movimentacoes` (
  `id` int auto_increment primary key,
  `tipo` varchar(15) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_mov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `produtos` (
  `id` int auto_increment primary key,
  `codigo` varchar(30) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(200),
  `estoque` decimal(8,2),
  `quantidade_min` decimal(8,2) NOT NULL,
  `valor_venda` decimal(8,2) NOT NULL,
  `categoria` int(11) NOT NULL,
  `dt_validade` date,
  `dt_indefinida` varchar(20),
  `foto` varchar(120)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `usuarios` (
  `id` int auto_increment primary key,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nivel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `vendas` (
  `id` int auto_increment primary key,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `operador` int(11) NOT NULL,
  `valor_recebido` decimal(8,2) NOT NULL,
  `desconto` varchar(20) NOT NULL,
  `troco` decimal(8,2) NOT NULL,
  `forma_pgto` int(11) NOT NULL,
  `abertura` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `nome` varchar (100),
  `CPF` varchar(15)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pagamento` (
  `id_pagamento` int auto_increment primary key,
  `dt_pagamento` date NOT NULL,
  `pagamento` decimal(8,2) NOT NULL,
  `nome` varchar(100)NOT NULL,
  `CPF` varchar(15)NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `contas_em_aberto` (
  `id_contas` int auto_increment primary key,
  `total_conta` decimal(8,2) NOT NULL,
  `nome` varchar (100),
  `CPF` varchar(15)NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;