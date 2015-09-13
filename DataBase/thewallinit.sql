DROP DATABASE IF EXISTS thewall;

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
	fecha_alta datetime not null,
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

CREATE TABLE BANDEJA_DE_ENTRADA (
	id_bandeja int not null auto_increment primary key,
	id_usuario int not null,
/*
	privacidad set('publico','privado') not null,
*/
	foreign key(id_usuario) references USUARIO(id_usuario) ON DELETE CASCADE
);

CREATE TABLE MENSAJE_PRIVADO (
	id_mensaje int not null auto_increment primary key,
	id_usuario int not null,
	id_bandeja int not null,
	fecha_alta datetime not null,
	contenido varchar (280) not null,
	foreign key(id_usuario) references USUARIO(id_usuario) ON DELETE CASCADE,
	foreign key(id_bandeja) references BANDEJA_DE_ENTRADA(id_bandeja) ON DELETE CASCADE
);

INSERT INTO USUARIO 
(rol,nombre,apellido,mail,nombre_usuario,contraseña,estado) VALUES
 ('Comun','Usuario','Anonimo',null,null,null,'Registrado'),
 ('Comun','Cosme','Fulanito','cosme@fulanito.com','cosmeFulanito','123','Registrado'),
 ('Comun','Nicolás','Romero','nicolas.r@gmail.com','NicoRome','nrthewall','Registrado'),
 ('Comun','Florencia','Villanova','florencia.v@gmail.com','FlorVillanova','fvthewall','Registrado'),
 ('Comun','Laura','Gutierrez','laura.g@gmail.com','LauraGutierrez','lgthewall','Registrado'),
 ('Comun','Lucas','Rodriguez','lucas.r@gmail.com','LucRodriguez','lrthewall','Registrado'),
 ('Comun','Jorge','Pérez','jorge.p@gmail.com','JorgeP','jpthewall','Registrado'),
('Comun','Anabel','Gimt','anabel.g@gmail.com','AnaGimt','agthewall','Pendiente'),
('Administrador','Franco','Malen','franco.m@gmail.com','FranMalen','fmthewall','Registrado');

INSERT INTO BANDEJA_DE_ENTRADA
(id_usuario) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8);

INSERT INTO MENSAJE_PRIVADO
(id_usuario,id_bandeja,contenido,fecha_alta) VALUES
(1,2,'Hola NicoRome, mi nombre es Cosme Fulanito.', NOW() ),
(2,1,'Lárgate de aquí Homero !', NOW() ),
(3,4,'Hola !', NOW() ),
(4,3,'¿Qué haces? ', NOW() ),
(5,4,'Hello !', NOW() ),
(4,5,'Ciao !', NOW() ),
(8,1,'Hola Cosme.', NOW() ),
(8,2,'Hola Nico.', NOW() ),
(8,3,'Hola Flor.', NOW() ),
(8,4,'Hola Laura.', NOW() ),
(8,5,'Hola Lucas. Soy el admin de la app y mi contraseña NO ES fmthewal.', NOW() );

INSERT INTO MURO
(id_usuario,privacidad) VALUES
(1,'publico'),
(2,'publico'),
(3,'publico'),
(4,'publico'),
(5,'privado'),
(6,'privado'),
(7,'privado'),
(8,'privado');

INSERT INTO MENSAJE 
(id_usuario,id_muro,contenido,fecha_alta) VALUES
(1,1,'Buenas noches señores. Molesto con una copilla por favorrrr?', NOW() ),
(2,2,'Primer mensaje en theWall !', NOW() ),
(3,3,'Hola !', NOW() ),
(3,3,'¿Qué hacen? ', NOW() ),
(4,4,'Hello !', NOW() ),
(5,5,'Ciao !', NOW() ),
(6,6,'¿Cómo están?', NOW() ),
(7,7,'Hola a todos !', NOW() ),
(8,8,'Buen día !', NOW() ),
(8,2,'Hola Nico', NOW() ),
(8,3,'Hola Florencia', NOW() ),
(8,4,'Hola Laura. Laura no está? Laura se fue?', NOW() ),
(8,8,'Por favor no hackeen la aplicación.', NOW() ),
(1,1,'Segundo mensaje', NOW() );

INSERT INTO COMPARTE_CON
(id_muro,id_usuario)VALUES

/*El muro con id 5 de rol 'privado' puede ser visualizado sólo por los usuarios 1, 2 y 3*/
(5,1),
(5,2),
(5,3),

/*El muro con id 6 de rol 'privado' puede ser visualizado sólo por los usuarios 4, 5 y 7*/
(6,4),
(6,5),
(6,7),


/*El muro con id 7 de rol 'privado' puede ser visualizado sólo por los usuarios 1, 3 y 8*/
(7,1),
(7,3),
(7,8),


/*El muro con id 8 de rol 'privado' puede ser visualizado sólo por el usuario 1*/
(8,1);

