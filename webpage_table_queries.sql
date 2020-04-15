-- create table users (id int not null auto_increment, email varchar(45) null, password varchar(45) null, primary key (id));
insert into users (email, password) values ('test@test.com', md5('test'));
