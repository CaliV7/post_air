CREATE DATABASE db_postair;

use db_postair;

CREATE TABLE users(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  age int(2) 
);

CREATE TABLE post(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  titre varchar(255),
  id_user int(100),
  contenu varchar(255)
);

CREATE TABLE like_post(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_user int(100),
  id_contenu
);