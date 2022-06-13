create table usuarios(
    id_usuario int(11) primary key auto_increment,
    nombre varchar(100) not null,
    apellidos varchar(100) not null,
    telefono char(13) not null,
    correo varchar(150) not null,
    password varchar(100) not null,
    tipo enum('adm', 'est') not null,
    activo tinyint(1) not null
);

create table tipo_archivos(
    id_tipo_archivo int(11) primary key auto_increment,
    nombre varchar(100) not null,
    activo tinyint(1) not null
);

create table cursos(
    id_curso int(11) primary key auto_increment,
    nombre varchar(100) not null,
    descripcion text not null,
    fecha_creada date not null,
    fecha_editada date not null,
    activo tinyint(1) not null
);

create table archivos(
    id_archivo int(11) primary key auto_increment,
    id_tipo_archivo int(11) not null,
    id_curso int(11) not null,
    nombre varchar(100) not null,
    descripcion text not null,
    ruta varchar(150) not null,
    fecha_subida date not null,
    fecha_editada date not null,
    activo tinyint(1) not null,
    foreign key (id_tipo_archivo) references tipo_archivos(id_tipo_archivo),
    foreign key (id_curso) references cursos(id_curso)
);

create table mensajes(
    id_mensaje int(11) primary key auto_increment,
    id_usuario int(11) not null,
    mensaje text not null,
    fecha_mensaje date not null,
    foreign key (id_usuario) references usuarios(id_usuario)
);