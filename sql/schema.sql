create database if not exists Orient_DB;

use Orient_DB;

DROP table if exists Franchise;
CREATE TABLE Franchise
(
 Franchise          varchar(128) NOT NULL,
 Titolo_alternativo varchar(128) NULL,

PRIMARY KEY (Franchise)
);


DROP table if exists Immagini;
CREATE TABLE Immagini
(
 id          int NOT NULL,
 nome        varchar(32) NOT NULL,
 link        varchar(64) NOT NULL,
 descrizione varchar(512) NOT NULL,

PRIMARY KEY (id)
);


DROP table if exists Utenti;
CREATE TABLE Utenti
(
 username         varchar(32) NOT NULL,
 bio              varchar(512) NOT NULL,
 email            varchar(32) NOT NULL,
 immagine_profilo int NOT NULL,

PRIMARY KEY (username),
CONSTRAINT FOREIGN KEY (immagine_profilo) 
	REFERENCES immagini(id)
);


DROP table if exists Credenziali;
CREATE TABLE Credenziali
(
 username varchar(32) NOT NULL,
 password varchar(256) NOT NULL,

PRIMARY KEY (username),
CONSTRAINT FOREIGN KEY (username) 
	REFERENCES Utenti(username)
);


DROP table if exists Ruoli;
CREATE TABLE Ruoli
(
 username varchar(32) NOT NULL,
 ruolo    char NOT NULL,

PRIMARY KEY (username),
CONSTRAINT FOREIGN KEY (username) 
	REFERENCES Utenti(username)
);


DROP table if exists Recensioni;
CREATE TABLE Recensioni
(
 id_recensione int NOT NULL,
 autore        varchar(32) NOT NULL,
 titolo        varchar(128) NOT NULL,
 testo         varchar(4096) NOT NULL,
 tags          varchar(256) NULL,

PRIMARY KEY (id_recensione),
CONSTRAINT FOREIGN KEY (autore) 
	REFERENCES Utenti(username)
);


DROP table if exists Gallery;
CREATE TABLE Gallery
(
 id_immagine   int NOT NULL,
 id_recensione int NOT NULL,
 ordine        int NOT NULL,

PRIMARY KEY (id_immagine, id_recensione),
CONSTRAINT FOREIGN KEY (id_recensione) 
	REFERENCES immagini(id),
CONSTRAINT FOREIGN KEY (id_immagine) 
	REFERENCES Recensioni(id_recensione)
);


DROP table if exists AudioVisivi;
CREATE TABLE AudioVisivi
(
 Titolo             varchar(128) NOT NULL,
 Franchise          varchar(128) NOT NULL,
 id_recensione      int NOT NULL,
 titolo_alternativo varchar(128) NULL,
 anno               year NOT NULL,
 tipo_media         varchar(16) NOT NULL,
 studio             varchar(128) NULL,
 stagione           varchar(64) NULL,

PRIMARY KEY (Titolo, Franchise),
FOREIGN KEY (id_recensione) 
	REFERENCES Recensioni(id_recensione),
FOREIGN KEY (Franchise) 
	REFERENCES Franchise(Franchise)
);


DROP table if exists Cartacei;
CREATE TABLE Cartacei
(
 titolo             varchar(128) NOT NULL,
 Franchise          varchar(128) NOT NULL,
 id_recensione      int NOT NULL,
 titolo_alternativo varchar(128) NULL,
 anno               year NOT NULL,
 tipo_media         varchar(16) NOT NULL,
 autore             varchar(128) NULL,
 editore            varchar(128) NULL,

PRIMARY KEY (titolo, Franchise),
CONSTRAINT FOREIGN KEY (id_recensione) 
	REFERENCES Recensioni(id_recensione),
CONSTRAINT FOREIGN KEY (Franchise) 
	REFERENCES Franchise(Franchise)
);


DROP table if exists Videogiochi;
CREATE TABLE Videogiochi
(
 Titolo             varchar(128) NOT NULL,
 Franchise          varchar(128) NOT NULL,
 id_recensione      int NOT NULL,
 titolo_alternativo varchar(128) NULL,
 anno               year NOT NULL,
 sviluppatore       varchar(128) NULL,
 distributore       varchar(128) NULL,
 genere             varchar(128) NULL,
 piattaforma        varchar(128) NULL,

PRIMARY KEY (Titolo, Franchise),
CONSTRAINT FOREIGN KEY (id_recensione) 
	REFERENCES Recensioni(id_recensione),
CONSTRAINT FOREIGN KEY (Franchise) 
	REFERENCES Franchise(Franchise)
);


DROP table if exists Uscite_audiovisivi;
CREATE TABLE Uscite_audiovisivi
(
 Titolo    varchar(128) NOT NULL,
 Franchise varchar(128) NOT NULL,
 Episodio   varchar(32) NOT NULL,
 data_uscita date       NOT NULL,

PRIMARY KEY (Titolo, Franchise, Episodio),
CONSTRAINT FOREIGN KEY (Titolo, Franchise) 
	REFERENCES AudioVisivi(Titolo, Franchise)
);


DROP table if exists Uscite_cartacei;
CREATE TABLE Uscite_cartacei
(
 titolo    varchar(128) NOT NULL,
 data_uscita date       NOT NULL,
 Franchise varchar(128) NOT NULL,
 volume     varchar(64) NOT NULL,

PRIMARY KEY (titolo, Franchise, volume),
CONSTRAINT FOREIGN KEY (titolo, Franchise) 
	REFERENCES Cartacei(titolo, Franchise)
);


DROP table if exists Uscite_videogiochi;
CREATE TABLE Uscite_videogiochi
(
 titolo    varchar(128) NOT NULL,
 franchise varchar(128) NOT NULL,
 data      date NOT NULL,

PRIMARY KEY (titolo, franchise),
CONSTRAINT FOREIGN KEY (titolo, franchise) 
	REFERENCES Videogiochi(Titolo, Franchise)
);


DROP table if exists Contatto;
CREATE TABLE Contatto
(
 email      	varchar(32) NOT NULL,
 data       	datetime NOT NULL,
 oggetto    	varchar(64) NOT NULL,
 testo      	varchar(1024) NOT NULL,
 incaricato 	varchar(32) NULL,

PRIMARY KEY (email, data),
CONSTRAINT FOREIGN KEY (incaricato) 
	REFERENCES Utenti(username)
);