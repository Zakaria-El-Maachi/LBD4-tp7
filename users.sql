drop database if exists users;
create database if not exists users;

use users;

create table pseudo(
    name varchar(70) not null unique
);

insert into pseudo values ('Zakaria');
insert into pseudo values ('Aya');
insert into pseudo values ('Zineb');
insert into pseudo values ('Aziza');
insert into pseudo values ('Abdellatif');