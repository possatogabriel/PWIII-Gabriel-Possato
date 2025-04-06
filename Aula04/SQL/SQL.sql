CREATE DATABASE pwiii_db;
USE pwiii_db;

CREATE TABLE usuarios(
	id bigint not null auto_increment,
    email varchar(100) not null unique,
    senha varchar(255) not null,
    
    primary key (id)
);

-- SELECT * FROM usuarios;
