CREATE DATABASE IF NOT EXISTS loja_db;
USE loja_db;

-- PRODUTOS --
CREATE TABLE produtos (
   id_produto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   cod_prod VARCHAR(10) UNIQUE,
   descricao VARCHAR(40),
   descricao_resumida VARCHAR(20),
   unidade INT(2),
   categoria int(3),
   valor DOUBLE(5,2),
   IPI DOUBLE(5,2),
   qtde_min  INT,
   datcad DATE,
   datalt DATE,
   usuario_cad VARCHAR(20),
   usuario_alt VARCHAR(20)
);

-- CLIENTEs --
CREATE TABLE clientes (
    id_cliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome varchar(30),
    endereco varchar(30),
    bairro varchar(30),
    cidade varchar(30),
    uf varchar(2),
    cep varchar(8),
    celular varchar(20),
    email varchar(30),
    datcad date,
    datalt date,
    usuario_cad VARCHAR(20),
    usuario_alt VARCHAR(20)
);

-- PEDIDOS --
CREATE TABLE pedidos (
	id_pedido INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	datped date,
	numped int,
	codcli int,
	codven int,
	finalizado varchar(1),
	numnf int (10),
	datnf date,
	status varchar(1)
);

-- VENDEDORES --
CREATE TABLE vendedores (
    id_vendedor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome varchar(30),
    email varchar(30),
    celular varchar(30),
    atuacao varchar(2),
    comissao double(7,2),
    status varchar(1));

-- OBSERVAÇÕES -- 
CREATE TABLE observacoes (
    id_observacao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tipo_reclamente varchar(1),
    reclamado int,
    reclamente int,
    ocorrencia int (3),
    observacao varchar(600),
    data date,
    retorno varchar(1),
    data_retorno date
);

-- DETALHES DO PEDIDO --
CREATE TABLE pedido_detalhe (
	id_pedido_det INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	codprod int,
	valor double(7,2),
	qtde int (5),
	ipi double(5,2),
	datped date,
	numped int,
    
	FOREIGN KEY (numped) REFERENCES pedidos(id_pedido),
	FOREIGN KEY (codprod) REFERENCES produtos(id_produto)
);

-- INSERIR PRODUTO --
INSERT INTO produtos (cod_prod, descricao, descricao_resumida, unidade, valor, ipi, qtde_min, datcad, datalt, usuario_cad, usuario_alt) VALUES ("2", "Camisa Regata", "Camisa Regata", 2, 45.3, 2.4, 10, CURDATE(),CURDATE(), USER(),USER());

-- INSERIR CLIENTE --
INSERT INTO clientes (nome, endereco, bairro, cidade, uf, cep, celular, email, datcad, datalt, usuario_cad, usuario_alt) VALUES ("Pedro da Silva", "rua do Pedro, 23", "Bar Pedro", "Sao Paulo", "SP", "09203030","11-32429032","pedro@email.com", CURDATE(), CURDATE(), USER(), USER());

-- INSERIR PEDIDO --
INSERT INTO pedidos (datped, numped, codcli, codven,status) VALUES ( '2023-11-15', 2,3,1,'P'),( '2024-15-24', 1,3,1,'P'),( '2024-11-20', 1,3,1,'P');

-- TESTANDO --
SELECT * FROM pedidos;
SELECT * FROM pedidos WHERE numped = 2;
SELECT p.numped, adume, p.codcli, p.codven, pd.codprod FROM pedidos p INNER JOIN pedido_detalhe pd ON p.numped = pd.numped;
SELECT p.numped, pd.numped, p.codcli, p.codven, pd.codprod FROM pedidos p INNER JOIN pedido_detalhe pd ON p.numped = pd.numped WHERE p.numped=3;
SELECT p.numped, pd.numped, p.codcli, p.codven, pd.codprod FROM pedidos p INNER JOIN pedido_detalhe pd ON p.numped = pd.numped WHERE p.numped=2;

-- PADRÃO PARA COLUNA STATUS --
/*
P = PROCESSAMENTO
C = CANCELADO
A = ANALISE
L = LIBERADO
F = FINALIZADO
*/

-- INSERINDO DADOS EM TABELA PEDIDO_DETALHE --
INSERT INTO pedido_detalhe (codprod, valor, qtde, ipi, datped, numped) VALUES (1, 7.50,5, 3.5,"2023-11-28",2);
INSERT INTO pedido_detalhe (codprod, valor, qtde, ipi, datped, numped) VALUES (3, 7.50,5, 3.5,"2023-11-28",2);
INSERT INTO pedido_detalhe (codprod, valor, qtde, ipi, datped, numped) VALUES (5, 7.50,5, 3.5,"2023-11-28",2);
INSERT INTO pedido_detalhe (codprod, valor, qtde, ipi, datped, numped) VALUES (6, 7.50,5, 3.5,"2023-11-28",2);
INSERT INTO pedido_detalhe (codprod, valor, qtde, ipi, datped, numped) VALUES (3, 7.50,5, 3.5,"2023-11-26",1);
INSERT INTO pedido_detalhe (codprod, valor, qtde, ipi, datped, numped) VALUES (5, 7.50,5, 3.5,"2023-11-26",1);

SELECT * FROM pedido_detalhe;

-- DICAS --

-- ALTER TABLE cliente MODIFY COLUMN cep VARCHAR(8);
-- DELETE FROM PEDIDO; 

-- ALTER TABLE --
-- ALTER TABLE pedido_detalhe DROP nome_coluna1, DROP nome_coluna2;