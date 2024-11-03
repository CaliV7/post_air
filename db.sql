CREATE DATABASE db_postair;

use db_postair;

CREATE TABLE users(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  email varchar(100) not null,
  nom VARCHAR(100) NOT NULL,
  mdpasse VARCHAR(100) NOT NULL,
  age int(2),
  ville varchar(50),
  date_inscription datetime default current_timestamp
  );

CREATE TABLE posts(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  user_id int,
  titre varchar(255),
  contenu varchar(255),
  date_post datetime default current_timestamp,
  FOREIGN KEY(user_id)REFERENCES users(id)
  );

 CREATE TABLE likes(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  user_id int,
  post_id int,
  FOREIGN KEY(user_id)REFERENCES users(id),
  FOREIGN KEY(post_id)REFERENCES posts(id)
 )