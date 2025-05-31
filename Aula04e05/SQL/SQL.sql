-- DROP DATABASE pwiii_db;
CREATE DATABASE IF NOT EXISTS pwiii_db;
USE pwiii_db;

CREATE TABLE usuarios(
    id BIGINT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(40),
    email VARCHAR(40) NOT NULL UNIQUE,
    email_recup VARCHAR(40) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_cad DATETIME NOT NULL,
    data_alt DATETIME NOT NULL, 
    ativo ENUM('true', 'false') NOT NULL,
    nivel INT NOT NULL,
    
    PRIMARY KEY (id)
);

-- VENDEDORES --
CREATE TABLE vendedores (
    id_vendedor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario BIGINT NOT NULL UNIQUE, 
    celular VARCHAR(30),
    atuacao VARCHAR(2),
    comissao DOUBLE(7,2),

    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- CLIENTES --
CREATE TABLE clientes (
    id_cliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario BIGINT NOT NULL UNIQUE, 
    endereco VARCHAR(30),
    bairro VARCHAR(30),
    cidade VARCHAR(30),
    uf VARCHAR(2),
    cep VARCHAR(8),
    celular VARCHAR(20),
    usuario_cad VARCHAR(20),
    usuario_alt VARCHAR(20),

    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

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

-- INSERIR PRODUTO --
INSERT INTO produtos (cod_prod, descricao, descricao_resumida, unidade, valor, ipi, qtde_min, datcad, datalt, usuario_cad, usuario_alt) VALUES 
("2", "Camisa Regata", "Camisa Regata", 2, 45.3, 2.4, 10, CURDATE(),CURDATE(), USER(), USER()),
("3", "Tênis Esportivo", "Tênis", 1, 199.99, 5.0, 5, CURDATE(), CURDATE(), USER(), USER()),
("4", "Jaqueta de Couro", "Jaqueta", 1, 350.00, 8.5, 2, CURDATE(), CURDATE(), USER(), USER()),
("5", "Mochila Escolar", "Mochila", 1, 120.50, 3.2, 10, CURDATE(), CURDATE(), USER(), USER()),
("6", "Relógio Digital", "Relógio", 1, 85.75, 2.0, 7, CURDATE(), CURDATE(), USER(), USER()),
("7", "Fone de Ouvido Bluetooth", "Fone", 1, 149.90, 4.0, 15, CURDATE(), CURDATE(), USER(), USER()),
("8", "Óculos de Sol", "Óculos", 1, 99.99, 3.5, 5, CURDATE(), CURDATE(), USER(), USER()),
("9", "Camiseta Algodão", "Camiseta", 2, 39.99, 2.0, 20, CURDATE(), CURDATE(), USER(), USER());

/*
-- INSERIR CLIENTE --
INSERT INTO clientes (nome, endereco, bairro, cidade, uf, cep, celular, email, datcad, datalt, usuario_cad, usuario_alt, ativo) VALUES  
("Pedro da Silva", "rua do Pedro, 23", "Bar Pedro", "Sao Paulo", "SP", "09203030", "11-32429032", "pedro@email.com", CURDATE(), CURDATE(), "admin", "admin", "true"),  
("Ana Souza", "Av. Brasil, 120", "Centro", "Rio de Janeiro", "RJ", "20040001", "21-998765432", "ana@email.com", CURDATE(), CURDATE(), "admin", "admin", "true"),  
("Carlos Mendes", "Rua das Flores, 45", "Jardins", "São Paulo", "SP", "01310000", "11-987654321", "carlos@email.com", CURDATE(), CURDATE(), "admin", "admin", "true"),  
("Mariana Lima", "Rua Oliveira, 89", "Copacabana", "Rio de Janeiro", "RJ", "22070010", "21-999888777", "mariana@email.com", CURDATE(), CURDATE(), "admin", "admin", "true"),  
("Rodrigo Costa", "Praça XV, 12", "Boa Viagem", "Recife", "PE", "51020040", "81-998877665", "rodrigo@email.com", CURDATE(), CURDATE(), "admin", "admin", "true"),  
("Fernanda Almeida", "Av. Paulista, 1000", "Bela Vista", "São Paulo", "SP", "01311000", "11-976543210", "fernanda@email.com", CURDATE(), CURDATE(), "admin", "admin", "true"),  
("Lucas Ferreira", "Rua das Acácias, 32", "Botafogo", "Rio de Janeiro", "RJ", "22290050", "21-998866554", "lucas@email.com", CURDATE(), CURDATE(), "admin", "admin", "true"),  
("Beatriz Santos", "Av. Sete de Setembro, 76", "Barra", "Salvador", "BA", "40130000", "71-977665544", "beatriz@email.com", CURDATE(), CURDATE(), "admin", "admin", "true");  
*/

-- INSERIR PEDIDO --
INSERT INTO pedidos (datped, numped, codcli, codven, status) VALUES 
('2023-11-15', 2, 3, 1, 'P'),
('2023-10-12', 3, 5, 2, 'P'),
('2024-02-28', 4, 2, 3, 'C'),
('2024-03-05', 5, 4, 1, 'F'),
('2024-04-18', 6, 6, 2, 'A'),
('2024-06-22', 7, 1, 3, 'A'),
('2024-07-10', 8, 7, 4, 'P'),
('2024-08-15', 9, 3, 2, 'L');

-- PADRÃO PARA COLUNA STATUS --
/*
P = PROCESSAMENTO
C = CANCELADO
A = ANALISE
L = LIBERADO
F = FINALIZADO
*/

-- INSERIR DETALHES DO PEDIDO --
INSERT INTO pedido_detalhe (codprod, valor, qtde, ipi, datped, numped) VALUES  
(1, 45.30, 2, 2.4, "2023-11-15", 1),  
(2, 199.99, 1, 5.0, "2024-02-28", 2),  
(3, 350.00, 3, 8.5, "2024-03-05", 3),  
(4, 120.50, 1, 3.2, "2024-04-18", 4),  
(5, 85.75, 2, 2.0, "2024-06-22", 5),  
(6, 149.90, 4, 4.0, "2024-07-10", 6),  
(7, 99.99, 5, 3.5, "2024-08-15", 7),  
(8, 39.99, 6, 2.0, "2024-11-20", 8);

-- TESTANDO --
SELECT * FROM pedidos;
SELECT * FROM pedidos WHERE numped = 2;
SELECT p.numped, pd.numped, p.codcli, p.codven, pd.codprod FROM pedidos p INNER JOIN pedido_detalhe pd ON p.numped = pd.numped;
SELECT p.numped, pd.numped, p.codcli, p.codven, pd.codprod FROM pedidos p INNER JOIN pedido_detalhe pd ON p.numped = pd.numped WHERE p.numped=3;
SELECT p.numped, pd.numped, p.codcli, p.codven, pd.codprod FROM pedidos p INNER JOIN pedido_detalhe pd ON p.numped = pd.numped WHERE p.numped=2;

-- DICAS --

SELECT * FROM usuarios;
-- DROP TABLE usuarios;

-- SELECT * from vendedores;

-- SELECT * from clientes;
-- ALTER TABLE clientes MODIFY COLUMN cep VARCHAR(8);
-- DELETE from pedidos; 

-- SELECT * FROM pedido_detalhe;
-- ALTER TABLE pedido_detalhe DROP nome_coluna1, DROP nome_coluna2;