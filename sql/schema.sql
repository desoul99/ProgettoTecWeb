create database if not exists orient_db;

use orient_db;

DROP table if exists recensori;
CREATE TABLE recensori
(
 username         varchar(32) NOT NULL,
 password         varchar(256) NOT NULL,

PRIMARY KEY (username)
);

DROP table if exists recensioni;
CREATE TABLE recensioni
(
 nome_recensione  varchar(32) NOT NULL,
 autore           varchar(32) NOT NULL,
 autore_opera      varchar(32) NOT NULL,
 titolo           varchar(128) NOT NULL,
 titolo_inglese    boolean NOT NULL,
 testo            varchar(4096) NOT NULL,
 tipo             varchar(16) NOT NULL,
 tags             varchar(256) NULL,
 alt_immagine     varchar(64) NOT NULL,
 immagine         varchar(32) NOT NULL,
 voto             int NOT NULL,

PRIMARY KEY (nome_recensione),
CONSTRAINT FOREIGN KEY (autore) 
	REFERENCES recensori(username)
);

DROP table if exists uscite;
CREATE TABLE uscite
(
 titolo           varchar(128) NOT NULL,
 prezzo           varchar(128) NOT NULL,
 distributore     varchar(32) NOT NULL,
 data_uscita      date       NOT NULL,

PRIMARY KEY (titolo, data_uscita)
);

DROP table if exists contatto;
CREATE TABLE contatto
(
 nome             varchar(128) NOT NULL,
 email         	  varchar(32) NOT NULL,
 data             datetime NOT NULL,
 oggetto          varchar(64) NOT NULL,
 testo            varchar(1024) NOT NULL,

PRIMARY KEY (email, data)
);


INSERT INTO `recensori` (`username`, `password`) VALUES
('admin', '$2y$10$Dull8DHmnoX3jyDiG6qwQefXMNMNQSPC0PRfD8lFixLaEenjch8mW');

INSERT INTO `recensioni` (`nome_recensione`, `autore`, `autore_opera`, `titolo`, `titolo_inglese`, `testo`, `tipo`, `tags`, `alt_immagine`, `immagine`, `voto`) VALUES
('onepiece', 'admin', 'Eiichiro Oda', 'One Piece', 1, 'Monkey D. Rufy è un giovane pirata sognatore che da piccolo ha involontariamente mangiato il frutto del diavolo Gom Gom, diventando così un uomo di gomma con la capacità di allungarsi e deformarsi a piacimento. Con l\'obiettivo di diventare il Re dei pirati e di ritrovare il leggendario tesoro One Piece, Rufy si mette in mare e riunisce intorno a sé una ciurma.\r\nHo sempre visionato <span xml:lang=\"en\">One Piece</span> saltuariamente sin dalla sua prima messa in onda in tv per mancanza di tempo e perché credevo fosse troppo demenziale, ma mi sono dovuta ricredere: ho avuto modo di conoscere questa serie per intero solo tra l\'ottobre e il gennaio scorsi (tanto mi ci è voluto per vedere i primi 487 episodi della serie), e i personaggi, secondo me tutti ben caratterizzati e numerosi, così come la freschezza della storia, mi avevano già colpito parecchi anni fa, ma solo ora posso dire con sicurezza che <span xml:lang=\"en\">One Piece</span> è per me uno dei migliori shounen in circolazione, secondo me persino superiore a Naruto, che apprezzo moltissimo.\r\nUna colonna sonora di tutto rispetto, da poema sinfonico, fa da sfondo perfetto alle avventure appassionanti di un manipolo di giovani pirati ai quali è impossibile non affezionarsi, umani, carismatici e credibili come sono.', 'Anime', 'pirati combattimenti Mare oceano Corruzione protagonista-coraggioso protagonista-ricercato Protagonista-determinato protagonista-orfano Superpoteri Protagonista-stupido ', 'Placeholder', 'onepiece', 4);
