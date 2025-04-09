CREATE DATABASE IF NOT EXISTS pwiii_db;
USE pwiii_db;

CREATE TABLE usuarios(
	id bigint not null auto_increment,
    nome varchar(40),
    email varchar(40) not null unique,
    email_recup varchar(40) not null unique,
    senha varchar(255) not null,
    data_cad date not null,
    ativo enum('true', 'false') not null,
    nivel int not null,
    
    primary key (id)
);

-- SELECT * FROM usuarios;
-- DROP TABLE usuarios;