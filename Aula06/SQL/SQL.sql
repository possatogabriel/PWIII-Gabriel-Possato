-- DROP DATABASE IF EXISTS pwiii_db;
CREATE DATABASE pwiii_db;
USE pwiii_db;

CREATE TABLE carros(
    id BIGINT NOT NULL AUTO_INCREMENT,
    modelo VARCHAR(30),
    ano int(4) NOT NULL UNIQUE,
    placa VARCHAR(10) NOT NULL UNIQUE,
    data_cadastro DATETIME NOT NULL,
    
    PRIMARY KEY (id)
);

ALTER TABLE carros
ADD COLUMN valor double (10,2) AFTER placa,
ADD COLUMN cor varchar(15) AFTER valor;

ALTER TABLE carros 
ADD COLUMN documento int(2) AFTER cor,
ADD COLUMN ocorrencia int(2) AFTER documento,
ADD COLUMN bloqueio int(1) AFTER ocorrencia;

-- SELECT * FROM carros;