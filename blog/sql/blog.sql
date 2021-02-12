CREATE DATABASE blog
    DEFAULT CHARACTER SET utf8;

USE BLOG;

select * from usuarios;
CREATE TABLE usuarios (
	id_usuario INT NOT NULL UNIQUE AUTO_INCREMENT,
	nombre VARCHAR(25) NOT NULL UNIQUE,
	email VARCHAR(255) NOT NULL UNIQUE,
	c_password VARCHAR(255) NOT NULL,
	fecha_registro DATETIME NOT NULL,
	activo TINYINT NOT NULL,
	PRIMARY KEY(id_usuario)
);

CREATE TABLE entradas (
        id INT NOT NULL UNIQUE AUTO_INCREMENT,
        autor_id INT NOT NULL,
        url VARCHAR(255) NOT NULL UNIQUE,
        titulo VARCHAR(255) NOT NULL,
        texto TEXT CHARACTER SET utf8 NOT NULL,
        fecha DATETIME NOT NULL,
        activa TINYINT NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(autor_id)
            REFERENCES usuarios(id_usuario)
            ON UPDATE CASCADE
            ON DELETE RESTRICT
);

CREATE TABLE comentarios (
        id INT NOT NULL UNIQUE AUTO_INCREMENT,
        autor_id INT NOT NULL,
        entrada_id INT NOT NULL,
        titulo VARCHAR(255) NOT NULL,
        texto TEXT CHARACTER SET utf8 NOT NULL,
        fecha DATETIME NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(autor_id)
            REFERENCES usuarios(id_usuario)
            ON UPDATE CASCADE
            ON DELETE RESTRICT,
        FOREIGN KEY(entrada_id)
            REFERENCES entradas(id)
            ON UPDATE CASCADE
            ON DELETE RESTRICT
);

CREATE TABLE recuperacion_clave (
		id INT NOT NULL UNIQUE AUTO_INCREMENT,
		usuario_id INT NOT NULL,
		url_secreta VARCHAR(255) NOT NULL,
		fecha DATETIME NOT NULL,
		PRIMARY KEY(id),
		FOREIGN KEY(usuario_id)
			REFERENCES usuarios(id_usuario)
			ON UPDATE CASCADE
			ON DELETE RESTRICT
);