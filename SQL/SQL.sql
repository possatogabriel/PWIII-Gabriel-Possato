CREATE DATABASE IF NOT EXISTS pwiii_db;
USE pwiii_db;

CREATE TABLE usuarios(
	id bigint not null auto_increment,
    nome varchar(40),
    email varchar(40) not null unique, 
    senha varchar(8) not null,
    
    primary key (id)
);

-- SELECT * FROM usuarios;