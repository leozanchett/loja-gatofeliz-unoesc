CREATE DATABASE gatofeliz;

USE gatofeliz;

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `cliente_nome` varchar(64) NOT NULL,
  `cliente_telefone` varchar(32) NOT NULL,
  `produto_quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `valor` int(11) NOT NULL,
  `imagem` longblob DEFAULT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;



