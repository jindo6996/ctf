CREATE DATABASE IF NOT EXISTS web3;
use web3;

CREATE TABLE comments(
	id int(10) auto_increment primary key,
	content text not null
);

CREATE TABLE flag(
	id int(10) auto_increment primary key,
	content varchar(100) not null
);
