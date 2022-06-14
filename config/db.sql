create table usuarios(
    id_usuario int(11) primary key auto_increment,
    nombre varchar(100) not null,
    apellidos varchar(100) not null,
    telefono char(13) not null unique,
    correo varchar(150) not null unique,
    password varchar(100) not null,
    tipo enum('adm', 'est') not null,
    activo tinyint(1) not null
);

insert into usuarios(nombre, apellidos, telefono, correo, password, tipo, activo) values('Administrador', 'ADM', '99999', 'admin@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'adm', 1);

create table tipo_archivos(
    id_tipo_archivo int(11) primary key auto_increment,
    nombre varchar(100) not null,
    activo tinyint(1) not null
);

create table cursos(
    id_curso int(11) primary key auto_increment,
    nombre varchar(100) not null,
    descripcion text,
    materia varchar(100) not null,
    fecha_creada datetime default current_timestamp(),
    fecha_editada datetime default current_timestamp(),
    activo tinyint(1) not null
);

create table archivos(
    id_archivo int(11) primary key auto_increment,
    id_tipo_archivo int(11) not null,
    id_curso int(11) not null,
    nombre varchar(100) not null,
    descripcion text,
    ruta varchar(150) not null,
    fecha_subida datetime default current_timestamp(),
    fecha_editada datetime default current_timestamp(),
    activo tinyint(1) not null,
    foreign key (id_tipo_archivo) references tipo_archivos(id_tipo_archivo),
    foreign key (id_curso) references cursos(id_curso)
);

create table mensajes(
    id_mensaje int(11) primary key auto_increment,
    id_usuario int(11) not null,
    mensaje text not null,
    fecha_mensaje datetime default current_timestamp(),
    foreign key (id_usuario) references usuarios(id_usuario)
);