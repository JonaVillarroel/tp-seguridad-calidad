CREATE DATABASE thewall;

USE thewall;

CREATE TABLE USUARIO (
	id_usuario int not null auto_increment primary key,
	rol set('Administrador','Comun'),
	nombre varchar(30),
	apellido varchar(30),
	mail varchar(50),
	nombre_usuario varchar(30),
	contraseña varchar(50),
	estado SET ('Registrado', 'Pendiente') not null,
	fecha_baja date
);


CREATE TABLE MURO (
	id_muro int not null auto_increment primary key,
	id_usuario int not null,
	privacidad set('publico','privado') not null,
	fecha_baja date,
	foreign key(id_usuario) references USUARIO(id_usuario) ON DELETE CASCADE
);

CREATE TABLE MENSAJE (
	id_mensaje int not null auto_increment primary key,
	id_usuario int not null,
	id_muro int not null,
	contenido varchar (280) not null,
	fecha_alta date not null,
	fecha_baja date,
	foreign key(id_usuario) references USUARIO(id_usuario) ON DELETE CASCADE,
	foreign key(id_muro) references MURO(id_muro) ON DELETE CASCADE
);

CREATE TABLE COMPARTE_CON (
	id_muro int not NULL,
	id_usuario int not NULL,
	primary key(id_muro, id_usuario),
	foreign key(id_usuario) references USUARIO(id_usuario) ON DELETE CASCADE,
	foreign key(id_muro) references MURO(id_muro) ON DELETE CASCADE
);

INSERT INTO USUARIO (id_usuario,rol,nombre,apellido,mail,nombre_usuario,contraseña,estado) VALUES ('','Comun','asd','asd','asd','nom','123','Pendiente');

SELECT * FROM USUARIO;