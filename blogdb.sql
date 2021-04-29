create database blogdb;
use blogdb;

create table users(
   userID int AUTO_INCREMENT,
   username varchar(30) not null, index(username),
   lastname varchar(50),
   firstname varchar(30),
   password varchar(30),
   email varchar(255),
   role varchar(30),
   lastModified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   primary key(userID)
)engine=innodb;

create table topics(
   topID int AUTO_INCREMENT,
   name varchar(50),
   description varchar(255),
   lastModified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   primary key(topID)
)engine=innodb;

create table articles(
   artID int AUTO_INCREMENT,
   authorID int NOT NULL, index(authorID),
   catID int NOT NULL, index(catID),
   title varchar(255),
   image varchar(255),
   content text,
   lastModified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   primary key(artID)
)engine=innodb;

create table comments(
   comID int AUTO_INCREMENT,
   authorID int NOT NULL, index(authorID),
   artID int NOT NULL, index(artID),
   content varchar(255),
   lastModified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   primary key(comID)
)engine=innodb;

create user 'bloguser'@'localhost' identified by 'blogAssign3';
grant all privileges on blogdb.* to 'bloguser'@'localhost';
