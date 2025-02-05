CREATE DATABASE HernanZapataIntegrador;

USE HernanZapataIntegrador;

CREATE TABLE productos(
codigo int auto_increment primary key,
descripcion varchar(30),
precio float);

CREATE TABLE empleados(
nroEmpleado int auto_increment primary key,
nombre varchar(30),
apellido varchar(30),
usuario varchar(30),
contra varchar(30),
UNIQUE(usuario));