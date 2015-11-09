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
	contraseña varchar(100),
	estado SET ('Registrado', 'Pendiente') not null,
	fecha_baja date
);

CREATE TABLE MURO (
	id_muro int not null auto_increment primary key,
	id_usuario int not null,
	privacidad set('publico','semipublico','privado','semiprivado', 'normal') not null,
	flag_anonimo_lectura boolean not null DEFAULT 1,
	flag_anonimo_escritura boolean not null DEFAULT 1,
	limite_muro int not null DEFAULT 10,
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
	limite int,
	primary key(id_bandeja),
	foreign key(id_usuario) references USUARIO(id_usuario) ON DELETE CASCADE
);

CREATE TABLE MENSAJE_PRIVADO (
	id_mensaje int not null auto_increment primary key,
	id_usuario int not null,
	id_bandeja int not null,
	fecha_alta datetime not null,
	contenido varchar (200) not null,
	id_conversacion int not null,
	foreign key(id_usuario) references USUARIO(id_usuario) ON DELETE CASCADE,
	foreign key(id_bandeja) references BANDEJA_DE_ENTRADA(id_bandeja) ON DELETE CASCADE
);

INSERT INTO USUARIO 

(rol,nombre,apellido,mail,nombre_usuario,contraseña,estado, fecha_baja) VALUES
/*Registrar los usuarios manualmente para que las contraseñas se encripten con Bcrypt, validación de contraseña cambiada*/

('Comun','Usuario','Anonimo',null,null,null,'Registrado', null),
('Comun','Juan','Diaz','juan@gmail.com','Juan',SHA1('juan1990'),'Registrado', null),
('Comun','Nicolás','Romero','nicolas.r@gmail.com','NicoRome',SHA1('nrthewall'),'Registrado', null),
('Comun','Florencia','Villanova','florencia.v@gmail.com','FlorVillanova',SHA1('fvthewall'),'Registrado', null),
('Comun','Laura','Gutierrez','laura.g@gmail.com','LauraGutierrez',SHA1('lgthewall'),'Registrado', null),
('Comun','Lucas','Rodriguez','lucas.r@gmail.com','LucRodriguez',SHA1('lrthewall'),'Registrado', null),
('Comun','Jorge','Pérez','jorge.p@gmail.com','JorgeP',SHA1('jpthewall'),'Registrado', null),
('Comun','Anabel','Gimt','anabel.g@gmail.com','AnaGimt',SHA1('agthewall'),'Pendiente', null),
('Administrador','Franco','Malen','franco.m@gmail.com','FranMalen',SHA1('fmthewall'),'Registrado', null);

INSERT INTO BANDEJA_DE_ENTRADA
(id_usuario,limite) VALUES
(8,3),
(2,2),
(3,6),
(4,3),
(5,2),
(6,4),
(7,3),

(9,5);

INSERT INTO MENSAJE_PRIVADO
(id_usuario,id_bandeja,contenido,fecha_alta, id_conversacion) VALUES
(3,4,'Krod#$', NOW(), 2 ),
(7,3,'??Tx?#kdfhvB', NOW(), 2 ),
(5,4,'Khoor#$', NOW(), 3 ),
(4,5,'Fldr#$', NOW(), 3 ),
(8,2,'Krod#Qlfr1', NOW(), 5 ),
(8,3,'Krod#Ioru1', NOW(), 6 ),
(9,4,'Krod#Odxud1', NOW(), 7 ),
(9,5,'Krod#Oxfdv1#Vr|#ho#dgplq#gh#od#dss1', NOW(), 8 ),
(5,8,'Qr#vr|#Oxfdv/#vr|#Odxud1', NOW(), 8 );


INSERT INTO MURO
(id_usuario,privacidad) VALUES
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
(3,4,'GxMjhESpH4iwd9+AOhOPJprxhgYzDKFbvV+1xnirLQVho3CRgE1DSZA8VcvQtRyX5v70oVZuUjQQPsnMUlb7ZQ==|I1UAlUhy9Mmu7lWSa+BmN5AjEjE11a+WZ6Pae3Nljr8=', NOW() ),
(6,2,'N1LeULryXCWgVO6SwlzSF3MkaEt6PGhnyRSjtEF4NtUv6WoGCzdOdJsyGu12BjsTF9p+44ypHYmlsSc9B2bCeoSqzNSGMzgFY9Ij3uJa1C5uT/P7e5yOEyGp0kXVFHOw|FOS6uEQnZToE/dj4PwlGP/YBxxw8ZFIANxENpma9hW0=', NOW() ),
(5,3,'JY1HzGcOnVujFxNiu9YPDoLoWt3rU7xmrW78NR8krCSF0RI7TkbYWo35DFBzNBiykdyfZF+fSpgMOxrmGAEwvw==|2fzgvj3Sc+5Ejq0KZa+8P1X5gYCqh0DGmW1M0UbLBiU=', NOW() ),
(4,3,'zbIpzgbHZ2sZ/qE1olTvLXYbjNSa+fNTDscNbVsdhjNfo9JTReMk2mO+XbQJasKXVT8h7r5VBvOYCJeAMsX+niI8eLif01tXNGjA3OEpRghVrPWgdNypcmmWakZV0/I+|goDt13NUoq+7qxZ2/Axpre30sBeSq072k8MusrCimsQ=', NOW() ),
(4,4,'ONXkouy37nm+xq+VRr0nI1N9dFduGAGVqvTyLF7RPJjmXdMBgMjiO+eqjikYv0qSu3VUiPV+y35hf4KsC/UgRA==|q/oSRrc4/qXkdVyXVkqy7uyJGFA73sYhtjsA57cDFq8=', NOW() ),
(4,4,'d8oSP43E1NsvVdFFOSNtIOJGlZWUyldv4ZvkVsAv2IPfPVZMxRW+nwYpIm/StfmYKIhPk6GtAh3I/AzToZQCYw==|6GY/pGmC3R17xWkS6p1OwmyZO4uNM9gSpDISTTuPRaw=', NOW() ),
(8,5,'vx2c8INUZIOSIdPL4Stbc1QGW4IuTA3H5NHAE3cTj4vGKc9EdVjMZoIQpgSuos9P03h0SjUindqhQFwGP9n+h/kOtloo7XX7tlR54dOteBQtEPbD0bQfuifxA4ZmHEeO|fKj4Id2o42WDQmJPJOtEXut2uepWPeUyq06/VmMEGxY=', NOW() ),
(6,6,'+Q6G+uQlTqRUuc2zAeAjnGrv4lmb12HmV1kOvI8YirfdMbTOKIhLXLIo2SC2fsGxiWXVu3bqaGChfH1871BwaA==|6zmQ1Mn4a+Q/BQ6t6vYDFEeFf70Fi8TuVXg/laTPa6I=', NOW() ),
(7,6,'Y6KJfLwMioAa0o+NqgkzbKMx0lOc6BVtmHeaK5MMbcnh7/x5ZYDl0J2UlcvHp1kBdhyNC1mJLwQA0yhvBRB4Cg==|CRyvRS9GRVN7ezg6zr4aqI9onxGFUBbbyrOBZ83nMRc=', NOW() ),
(8,8,'W2GiJkrjvJPCjaWcsl4ga6C0F7xkQEQ2CDnMVjTAwJg=|zhBNQfzWiU5EwhzXDKVJ+dp3O2PM2/l72NkAVzF2FBc=', NOW() ),
(4,8,'f/D9ksF05Scs0i4MTmbaIGK0UsfnBuZnKcaI5Ww+NzJqZ0uMANDs8kOFBgwGDPdDHBVlqZZin9zI68cHbL0ZxelB2QEPcP59ZBLhnRefqK5ve8Hh+qdfcJrN4KcygBvC|Dn+TMnohmWlXXmbyLX/KLHKJR2Yv5tKObmJEWZzeyZc=', NOW() );

INSERT INTO COMPARTE_CON
(id_muro,id_usuario) VALUES
(5,2),
(5,3),
(6,4),
(6,5),
(6,7),
(7,3),
(7,8);