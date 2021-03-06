CREATE DATABASE tania_crud_app;

use tania_crud_app;

CREATE TABLE users (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	username VARCHAR(30) NOT NULL,
	password VARCHAR(255) NOT NULL,
	email VARCHAR(50) NOT NULL,
	age INT(3),
	location VARCHAR(50),
	date TIMESTAMP
);

CREATE TABLE runs (
	username VARCHAR(30) NOT NULL,
	distance FLOAT NOT NULL,
	run_time TIME NOT NULL,
	run_date DATE
);
