
create database if not exists benchmarks;
use benchmarks;
create table foo (
    id integer primary key auto_increment,
    name varchar(128)
);
