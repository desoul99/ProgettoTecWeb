create database if not exists Orient_DB;

use Orient_DB;

DROP table if exists Recensori;
CREATE TABLE Recensori
(
 username         varchar(32) NOT NULL,
 email            varchar(32) NOT NULL,
 password         varchar(256) NOT NULL,

PRIMARY KEY (username)
);

DROP table if exists Recensioni;
CREATE TABLE Recensioni
(
 nome_recensione  varchar(32) NOT NULL,
 autore           varchar(32) NOT NULL,
 titolo           varchar(128) NOT NULL,
 testo            varchar(4096) NOT NULL,
 tipo             varchar(16) NOT NULL,
 tags             varchar(256) NULL,
 immagine         varchar(32) NOT NULL,

PRIMARY KEY (nome_recensione),
CONSTRAINT FOREIGN KEY (autore) 
	REFERENCES Recensori(username)
);

DROP table if exists Uscite;
CREATE TABLE Uscite
(
 titolo           varchar(128) NOT NULL,
 prezzo           varchar(128) NOT NULL,
 distributore     varchar(32) NOT NULL,
 data_uscita      date       NOT NULL,

PRIMARY KEY (titolo, data_uscita)
);

DROP table if exists Contatto;
CREATE TABLE Contatto
(
 nome             varchar(128) NOT NULL,
 email         	  varchar(32) NOT NULL,
 data             datetime NOT NULL,
 oggetto          varchar(64) NOT NULL,
 testo            varchar(1024) NOT NULL,

PRIMARY KEY (email, data)
);