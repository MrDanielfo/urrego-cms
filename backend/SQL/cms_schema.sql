DROP DATABASE IF EXISTS urrego_cms;

CREATE DATABASE urrego_cms;

USE urrego_cms;

CREATE TABLE usuarios (
    id      int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario varchar(10) NOT NULL,
    pass    varchar(10) NOT NULL,
    email   text,
    foto    text,
    rol     int,
    intentos int
)Engine=InnoDb DEFAULT CHARSET=utf8;

CREATE TABLE slides (
    id  int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ruta text NOT NULL,
    titulo text NOT NULL,
    descripcion text NOT NULL,
    orden int NOT NULL
)Engine=InnoDb DEFAULT CHARSET=utf8;

INSERT INTO usuarios (id, usuario, pass, email, foto, rol, intentos) VALUES 
(null, 'danielfo', 'danielfo123', 'admin@admin.com','sinfoto', 0, 0 );