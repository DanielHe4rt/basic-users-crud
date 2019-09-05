CREATE DATABASE mydatabase CHARACTER SET utf8 COLLATE utf8_general_ci;

create table users (
	id int not null auto_increment,
	name varchar(50) not null,
	email varchar(30) not null unique,
	pass_hash varchar(255) not null,
	profile_pic blob,
	primary key (id)
);

insert into  users (id, name, email, pass_hash) VALUES
(default, 'Teste', 'teste@teste.com', '7823645923467589');