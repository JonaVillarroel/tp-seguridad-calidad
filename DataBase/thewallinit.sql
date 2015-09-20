DROP DATABASE IF EXISTS thewall;

CREATE DATABASE thewall;
USE thewall;

CREATE TABLE USUARIO (
	id_usuario int not null auto_increment primary key,
	rol set('Administrador','Comun'),
	nombre varchar(50),
	apellido varchar(50),
	mail varchar(50),
	nombre_usuario varchar(50),
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
	id_bandeja int not null auto_increment,
	id_usuario int not null,
	primary key(id_bandeja),
	foreign key(id_usuario) references USUARIO(id_usuario) ON DELETE CASCADE
);

CREATE TABLE MENSAJE_PRIVADO (
	id_mensaje int not null auto_increment primary key,
	id_usuario int not null,
	id_bandeja int not null,
	fecha_alta datetime not null,
	contenido varchar (280) not null,
	id_conversacion int not null,
	foreign key(id_usuario) references USUARIO(id_usuario) ON DELETE CASCADE,
	foreign key(id_bandeja) references BANDEJA_DE_ENTRADA(id_bandeja) ON DELETE CASCADE
);

INSERT INTO USUARIO 
(rol,nombre,apellido,mail,nombre_usuario,contraseña,estado) VALUES
('Comun','Usuario','Anonimo',null,null,null,'Registrado'),
('Comun','Juan','Diaz','juan@gmail.com','Juan',SHA1('juan1990'),'Registrado'),
('Comun','Nicolás','Romero','nicolas.r@gmail.com','NicoRome',SHA1('nrthewall'),'Registrado'),
('Comun','Florencia','Villanova','florencia.v@gmail.com','FlorVillanova',SHA1('fvthewall'),'Registrado'),
('Comun','Laura','Gutierrez','laura.g@gmail.com','LauraGutierrez',SHA1('lgthewall'),'Registrado'),
('Comun','Lucas','Rodriguez','lucas.r@gmail.com','LucRodriguez',SHA1('lrthewall'),'Registrado'),
('Comun','Jorge','Pérez','jorge.p@gmail.com','JorgeP',SHA1('jpthewall'),'Registrado'),
('Comun','Anabel','Gimt','anabel.g@gmail.com','AnaGimt',SHA1('agthewall'),'Pendiente'),
('Administrador','Franco','Malen','franco.m@gmail.com','FranMalen',SHA1('fmthewall'),'Registrado');

INSERT INTO BANDEJA_DE_ENTRADA
(id_usuario) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9);

INSERT INTO MENSAJE_PRIVADO
(id_usuario,id_bandeja,contenido,fecha_alta, id_conversacion) VALUES
(1,2,'Hola NicoRome, mi nombre es Cosme Fulanito.', NOW(), 1 ),
(2,1,'Lárgate de aquí Homero !', NOW(), 1 ),
(3,4,'Hola !', NOW(), 2 ),
(4,3,'¿Qué haces? ', NOW(), 2 ),
(5,4,'Hello !', NOW(), 3 ),
(4,5,'Ciao !', NOW(), 3 ),
(8,1,'Hola Cosme.', NOW(), 4 ),
(8,2,'Hola Nico.', NOW(), 5 ),
(8,3,'Hola Flor.', NOW(), 6 ),
(9,4,'Hola Laura.', NOW(), 7 ),
(9,5,'Hola Lucas. Soy el admin de la app y mi contraseña NO ES fmthewal.', NOW(), 8 ),
(5,9,'No soy Lucas, soy Laura.', NOW(), 8 );


INSERT INTO MURO
(id_usuario,privacidad) VALUES
(1,'publico'),
(2,'publico'),
(3,'publico'),
(4,'publico'),
(5,'privado'),
(6,'privado'),
(7,'privado'),
(8,'privado'),
(9,'publico');

INSERT INTO MENSAJE 
(id_usuario,id_muro,contenido,fecha_alta) VALUES
(3,4,'Hola, que lindo fue cruzarte hoy! Saludos a la familia.', NOW() ),
(6,2,'Hoy nos juntamos a la noche en mi casa. Estas invitado!! Te espero. :)', NOW() ),
(5,3,'Feliz cumpleañoooos!! Que tengas un lindo dia', NOW() ),
(4,3,'Feliz cumpleee! Te extraño mucho! Mas tarde te veo! Besitos ', NOW() ),
(4,4,'Como extraño salir a pasear! Que vuelva el verano..', NOW() ),
(4,4,'Hoy a la noche salimos a festejar el cumple de Flopy!', NOW() ),
(8,5,'Bienvenido a The Wall. Cualquier consulta mandame un msj privado! Que lo disfrutes!', NOW() ),
(6,6,'Que hermoso dia para ir a la plaza', NOW() ),
(7,6,'Hace frio para ir a la plaza! Andate a la cama', NOW() ),
(8,8,'Buen día!', NOW() ),
(4,8,'Nos despertamos de buen humor? jajaja Yo estoy despierto desde temprano :(', NOW() );

INSERT INTO COMPARTE_CON
(id_muro,id_usuario) VALUES
(5,1),
(5,2),
(5,3),
(6,4),
(6,5),
(6,7),
(7,1),
(7,3),
(7,8),
(8,1);
