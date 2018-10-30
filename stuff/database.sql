create table alumno
(
	carnet int not null primary key auto_increment,
	nom_alumno varchar(250)
);
create table curso 
(
	curso_id int not null primary key auto_increment,
	nom_curso varchar(250)
);
create table asignacion
(
	asignacion_id int not null primary key auto_increment,
	carnet int not null,
	curso_id int not null
);
create table examen
(
	examen_id  int not null primary key auto_increment,
	descripcion text
);
create table nota
(
	nota_id  int not null primary key auto_increment,
	asignacion_id int not null,
	examen_id int not null,
	puntaje int not null default 0
);

insert into alumno (nom_alumno) values ('Julio');
insert into alumno (nom_alumno) values ('Pedro');
insert into alumno (nom_alumno) values ('Maria');

insert into curso (nom_curso) values ('Matematica');

insert into asignacion (carnet, curso_id) values (1, 1);
insert into asignacion (carnet, curso_id) values (2, 1);
insert into asignacion (carnet, curso_id) values (3, 1);

insert into examen (descripcion) values ('Primer examen parcial');

insert into nota (asignacion_id, examen_id, puntaje) values (1,1,0);
insert into nota (asignacion_id, examen_id, puntaje) values (2,1,0);
insert into nota (asignacion_id, examen_id, puntaje) values (3,1,0);
