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
ADD COLUMN valor double (10,2),
ADD COLUMN cor varchar(15);

-- SELECT * FROM carros;