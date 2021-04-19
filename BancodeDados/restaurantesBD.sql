mysql -u root -p
show databases;

create database ixsistemas;
show databases;

use ixsistemas;
create table mesa(
    id int not null auto_increment,
    descricao varchar(30) not null,
    id_usuario interger not null,
    primary key(id)
    constraint fk_m_u foreign key (id_usuario)
    references usuarios(id_usuario)
    );

create table pedido(
    id int not null auto_increment,
    data varchar(30) not null,
    hora varchar(30) not null,
    status varchar(30) not null,
    obs varchar(30) not null,
    id_produto interger not null,
    primary key(id)
    constraint itens foreign key(id_produto)
    references produto(id_produto)
    );

create table produto(
    id int not null auto_increment,
    nome varchar(30) not null,
    descricao varchar(200) not null,
    valor varchar(10) not null,
    tipos varchar(20) not null,
    primary key(id)
);

create table usuario(
  id int not null auto_increment,
  login varchar(30) not null unique,
  senha varchar(30) not null,
  tipo varchar(30) not null,
primary key(id)
);

insert into mesa values
(1,'mesa1','')
(2,'mesa2','')
(3,'mesa1','')
(4,'mesa1','')
(5,'mesa1','')

insert into pedido values
(1,'','','','','')

insert into produto values
(1,'X-tudo','Humburguer, queijo, catupiry, calabresa, bacon, milho, alface, tomate no Pão de Humburguer','25,00$','Lanche')


insert into usuario values
(1,'Gerente00',md5("senha@123"),'Gerente')
(2,'Cozinha00',md5("senha@123",'Chapeiro')
(3,'Caixa00',md5("senha@123",'Caixa')
(4,'Garcom00',md5("senha@123",'Garçom')

select * from usuario;
select * from produto;
select * from pedido;
select * from mesa;
show tables;