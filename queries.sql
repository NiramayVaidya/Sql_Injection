-- show databases;
-- show tables;
-- create database sql_injection_testing;
-- use sql_injection_testing;
-- create table basic_testing (id int not null auto_increment, name varchar(64) not null, primary key (id));
-- describe basic_testing;
-- show create table basic_testing;
-- alter table basic_testing change column id id int not null auto_increment;
-- TODO find out why first column dummy value has to be added to the insert
-- query if it is already aut_increment
-- shows error column count doesn't match value count at row 1
insert into basic_testing values (0, 'Niramay');
insert into basic_testing values (0, 'Test_User');
insert into basic_testing values (0, 'Test_User_New');
-- delete from basic_testing;
-- drop table basic_testing;
-- source queries.sql;
-- alter table basic_testing auto_increment = 1;
