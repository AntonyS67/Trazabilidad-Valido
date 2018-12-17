create database if not exists trazabilidad;
use trazabilidad;

/* Tabla : estados */
create table if not exists `t_estados`
(
  `id_estado`   integer(11) not null auto_increment,
  `tipo_estado` varchar(25) not null,
  constraint primary key (`id_estado`)
)
  engine = InnoDB
  default charset = utf8mb4;

/* Estados por defecto */
insert into `t_estados` (`tipo_estado`)
  value ('Activo');
insert into `t_estados` (`tipo_estado`)
  value ('Inactivo');

/* Crear la tabla de tipos de usuario*/
create table if not exists t_tipo_usuario
(
  `id_tipo_user` integer(2)  not null auto_increment,
  `tipo_user`    varchar(20) not null,
  constraint `pk_tipo_usuarios` primary key (id_tipo_user)
)
  engine = InnoDB
  default charset = utf8mb4;

/* Insertar los tipos de usuario por defecto */
insert into t_tipo_usuario (`tipo_user`)
  value ('Administrador');
insert into t_tipo_usuario (`tipo_user`)
  value ('Secretaria');
insert into t_tipo_usuario (`tipo_user`)
  value ('Director de Escuela');
insert into t_tipo_usuario (`tipo_user`)
  value ('Estudiante');

create table if not exists t_usuarios
(
  `id_user`      integer(11)  not null auto_increment,
  `usuario`      varchar(30)  not null,
  `email`        varchar(255) not null,
  primer_nombre  varchar(20)  not null default '',
  segundo_nombre varchar(20)  not null default '',
  ap_paterno     varchar(20)  not null default '',
  ap_materno     varchar(20)  not null default '',
  dni            integer(8),
  celular        varchar(9),
  sexo           varchar(10)  not null,
  `password`     varchar(30)  not null,
  `id_tipo_user` integer(2)   not null,
  `intentos`     integer(2)   null,
  id_estado      integer(11)  not null,
  fecha_registro date         not null,
  unique key `username` (`usuario`),
  unique key `dni` (`dni`),
  unique key `email` (`email`),
  unique key `celular` (`celular`),
  constraint primary key (id_user),
  key `fk_id_estado_user` (`id_estado`),
  constraint foreign key (`id_estado`) references t_estados (`id_estado`) on delete cascade on update cascade,
  key `fk_users_tipos_id` (`id_tipo_user`),
  constraint foreign key (`id_tipo_user`) references t_tipo_usuario (`id_tipo_user`) on delete cascade on update cascade
)
  engine = InnoDB
  default charset = utf8mb4;

/*Registro de Usuario*/


/*Administrador*/
INSERT into t_usuarios(id_user, usuario, email,
                       primer_nombre, segundo_nombre, ap_paterno,
                       ap_materno, dni,
                       celular, sexo, password, id_tipo_user, intentos, id_estado, fecha_registro)
VALUES (null, 'admin', 'admin@gmail.com',
        'p_nombre', 's_nombre', 'ap_paterno',
        'ap_materno', '12345678', '987654321', 'Masculino', '123', 1, 0, 1, '2018-12-01');


/*Estudiantes*/
INSERT into t_usuarios(usuario, email,
                       primer_nombre, segundo_nombre, ap_paterno,
                       ap_materno, dni,
                       celular, sexo, password, id_tipo_user, intentos, id_estado, fecha_registro)
VALUES ('charcape20', 'andres.charcape20@gmail.com',
        'Andres', 'Saul', 'Medina',
        'Charcape', '72396363', '943169522', 'Masculino', 'charcape', 4, 0, 1, '2018-12-12');

INSERT into t_usuarios(usuario, email,
                       primer_nombre, segundo_nombre, ap_paterno,
                       ap_materno, dni,
                       celular, sexo, password, id_tipo_user, intentos, id_estado, fecha_registro)
VALUES ('leovr7', 'leorvr7@gmail.com', 'Leonardo', 'Ray', 'Villar', 'Rodríguez', '71039953', '952930003', 'Masculino',
        '81195', 4, 0, 1, '2018-12-12');


select *
from t_usuarios;

/* Crear tabla Secretaria */
create table if not exists t_secretaria
(
  id_secretaria   integer(11) not null auto_increment,
  id_user         integer(11) not null,
  tipo_secretaria varchar(20) not null default '',
  constraint `pk_secretaria` primary key (`id_secretaria`),
  key `fk_id_user` (`id_user`),
  constraint foreign key (`id_user`) references t_usuarios (`id_user`) on delete cascade on update cascade
)
  engine = InnoDB
  default charset = utf8mb4;


/* Crear Tabla Director */
create table if not exists t_director
(
  id_director integer(11) not null auto_increment,
  id_user     integer(11) not null,
  constraint `pk_director` primary key (`id_director`),
  key `fk_id_user2` (`id_user`),
  constraint foreign key (`id_user`) references t_usuarios (`id_user`) on delete cascade on update cascade
)
  engine = InnoDB
  default charset = utf8mb4;

/* Crear Tabla Estudiante */
create table if not exists t_estudiante
(
  cod_estudiante varchar(10) not null,
  id_user        integer(11) not null,
  unique key `cod_estudiante` (`cod_estudiante`),
  constraint `pk_estudiante` primary key (`cod_estudiante`),
  key `fk_id_user3` (`id_user`),
  constraint foreign key (`id_user`) references t_usuarios (`id_user`) on delete cascade on update cascade
) engine = InnoDB
  default charset = utf8mb4;
;


/* Crear Tabla Tipo Tramite */
create table if not exists t_tipo_tramite
(
  `id_tipo_tramite`     integer(11)  not null auto_increment,
  `nombre_tipo_tramite` varchar(25)  not null,
  `descripcion`         varchar(100) not null,
  constraint `pk_tipo_tramite` primary key (id_tipo_tramite)
)
  engine = InnoDB
  default charset = utf8mb4;

/* Crear Tabla Tipo Documento */
create table if not exists t_tipo_documento
(
  `id_tipo_documento`     integer(11)  not null auto_increment,
  `nombre_tipo_documento` varchar(25)  not null,
  `descripcion`           varchar(100) not null,
  constraint `pk_tipo_documento` primary key (id_tipo_documento)
)
  engine = InnoDB
  default charset = utf8mb4;

/* Crear Tabla Tramite */
create table if not exists t_tramite
(
  `id_tramite`      integer(11) not null auto_increment,
  `cod_estudiante`  varchar(10) not null,
  `id_tipo_tramite` integer(11) not null,
  `fecha_inicio`    varchar(20) null,
  `fecha_fin`       varchar(20) null,
  `estado`          varchar(20) not null,
  constraint `pk_tramite` primary key (id_tramite),
  key `fk_cod_estudiante` (`cod_estudiante`),
  constraint `fk_cod_estudiante` foreign key (`cod_estudiante`) references t_estudiante (`cod_estudiante`) on delete cascade on update cascade,
  key `fk_id_tipo_tramite` (`id_tipo_tramite`),
  constraint `fk_id_tipo_tramite` foreign key (`id_tipo_tramite`) references t_tipo_tramite (`id_tipo_tramite`) on delete cascade on update cascade
)
  engine = InnoDB
  default charset = utf8mb4;

/* Crear Tabla Documento */
create table if not exists t_documento
(
  `id_documento`            integer(11)  not null auto_increment,
  `id_tramite`              integer(11)  not null,
  `id_tipo_documento`       integer(11)  not null,
  `RutaDocumentoReferencia` varchar(255) null default '',
  constraint `pk_documento` primary key (id_documento),
  key `fk_id_tramite` (`id_tramite`),
  constraint `fk_id_tramite` foreign key (`id_tramite`) references t_tramite (`id_tramite`),
  key `fk_id_tipo_documento` (`id_tipo_documento`),
  constraint `fk_id_tipo_documento` foreign key (`id_tipo_documento`) references t_tipo_documento (`id_tipo_documento`)
)
  engine = InnoDB
  default charset = utf8mb4;


/* Crear tabla solicitudes */
create table if not exists t_solicitudes
(
  id_solicitud  integer(11) not null auto_increment,
  id_secretaria integer(11) not null,
  id_documento  integer(11) not null,
  estado        varchar(20) not null default '',
  constraint `pk_solicitud` primary key (`id_solicitud`),
  key `fk_id_secretaria` (`id_secretaria`),
  constraint foreign key (`id_secretaria`) references t_secretaria (`id_secretaria`) on delete cascade on update cascade,
  key `fk_id_documento` (`id_documento`),
  constraint foreign key (`id_documento`) references t_documento (`id_documento`) on delete cascade on update cascade
)
  engine = InnoDB
  default charset = utf8mb4;


INSERT into t_estudiante(cod_estudiante, id_user)
VALUES ('0201614028', 2);
INSERT into t_estudiante(cod_estudiante, id_user)
VALUES ('0201614025', 3);
select *
from t_usuarios;
select *
from t_tipo_tramite;

insert into t_tipo_tramite(nombre_tipo_tramite, descripcion)
VALUES ('Bachiller', 'Solicitud para obtener el grado de Bachiller'),
       ('Titulo Profesional', 'Soliitud para obtener el titulo profesional');

select *
from t_tramite;

insert into t_tramite(cod_estudiante, id_tipo_tramite, fecha_inicio, fecha_fin, estado)
VALUES ('0201614025', 1, '12-12-2018', '', 'Iniciado'),
       ('0201614028', 1, '12-12-2018', '', 'iniciado');
