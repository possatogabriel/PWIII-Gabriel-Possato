-- DROP DATABASE IF EXISTS pwiii_db;
CREATE DATABASE pwiii_db;
USE pwiii_db;

CREATE TABLE carros(
    id BIGINT NOT NULL AUTO_INCREMENT,
    modelo VARCHAR(30),
    ano int(4) NOT NULL,
    placa VARCHAR(10) NOT NULL UNIQUE,
    data_cadastro DATETIME NOT NULL,
    
    PRIMARY KEY (id)
);

ALTER TABLE carros
ADD COLUMN valor double (10,2) AFTER placa,
ADD COLUMN cor varchar(15) AFTER valor;

ALTER TABLE carros 
ADD COLUMN seguro boolean,
ADD COLUMN documento int(2) AFTER cor,
ADD COLUMN ocorrencia int(2) AFTER documento,
ADD COLUMN bloqueio int(1) AFTER ocorrencia;

-- SELECT * FROM carros;

CREATE TABLE usuarios(
	id BIGINT NOT NULL AUTO_INCREMENT,
    usuario varchar(60) NOT NULL UNIQUE,
    senha varchar(30) NOT NULL,
    
	PRIMARY KEY (id)
);

INSERT INTO usuarios(usuario, senha) VALUES ('email@email.com', '1234');