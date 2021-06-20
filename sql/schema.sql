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
 autore_opera      varchar(128) NOT NULL,
 titolo           varchar(128) NOT NULL,
 titolo_inglese    boolean NOT NULL,
 testo            varchar(4096) NOT NULL,
 tipo             varchar(16) NOT NULL,
 tags             varchar(256) NULL,
 alt_immagine     varchar(64) NULL,
 immagine         varchar(32) NOT NULL,
 voto             int NOT NULL,

PRIMARY KEY (nome_recensione),
CONSTRAINT FOREIGN KEY (autore) 
	REFERENCES recensori(username)
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

INSERT INTO `contatto` (`nome`, `email`, `data`, `oggetto`, `testo`) VALUES
('Francescone Torgalli', 'f.tog@gmail.com', '2021-06-20 19:00:19', 'Richiesta recensione', 'Salve, \r\nseguo spesso le vostre recensioni, e mi piacerebbe sentire la vostra opinione sul manhwa \'Tower of God\', che secondo me merita assai.\r\nGrazie,\r\nFrancescone'),
('Pierangelo', 'pierangelo.angelis@gmail.com', '2021-06-20 18:57:15', 'Voti recensioni troppo alti', 'Buongiorno,\r\nVi scrivo perchè mi sono imbattuto nel vosto sito ed ho notato che tutte le vostre recensioni hanno voti molto alti. \r\nPersonalmente gradirei leggere anche recensioni di cose che non vi sono piaciute.\r\n-Pierangelo');

INSERT INTO `recensori` (`username`, `password`) VALUES
('admin', '$2y$10$Dull8DHmnoX3jyDiG6qwQefXMNMNQSPC0PRfD8lFixLaEenjch8mW'),
('lorenzo', '$2y$10$j8Sjtn26al8/cEOts33Ng.0z11mTlQKu.0UxHh5izUyumCl7wvGie'),
('marco', '$2y$10$ky2KA1Hx5zMjdyhz1tISbuSlmE4o1pVbdhWhYY/chY3hOu5Se5.B.'),
('samuele', '$2y$10$LaH.3u8F4WK0sqZlVE/mCeASNwCkV.VTmaejEDAw8TMFwR50nb78m'),
('stefano', '$2y$10$FI9TBVsEusJk3BspQqZHXu7KOD2CThkiJ8LGaJFsNBLkskI7bKr2C');

INSERT INTO `recensioni` (`nome_recensione`, `autore`, `autore_opera`, `titolo`, `titolo_inglese`, `testo`, `tipo`, `tags`, `alt_immagine`, `immagine`, `voto`) VALUES
('berserk', 'lorenzo', '<span xml:lang=\"ja\">Kentaro Miura</span>', 'Berserk', 1, '<span xml:lang=\"en\">Berserk</span> è una di quelle storie che non riesci a smettere di vivere.\r\n\r\nManga ambientato in un medioevo alternativo, <span xml:lang=\"en\">Berserk</span> ha come fulcro della storia la \"vendetta\" di Gatsu e il suo viaggio (secondo me) per redimersi. Gatsu, capitolo per capitolo cresce, si evolve, non rimane mai statico. Come lui, tutti i personaggi hanno una fortissima caratterizzazione che e mutano a seconda di incontri, traumi e relazioni con gli altri personaggi.\r\n\r\nI disegni sono qualcosa di veramente ben fatto, trasudano in continuazione quello che i personaggi sono e cosa provano, siano esse emozioni, pensieri o paure.\r\nLa storia ha una velocità non troppo rapida, non troppo lenta. Anzi, la storia prende il tempo che deve prendersi per raccontare come si deve tutte le vicende dei personaggi.', 'Manga', 'Antieroe, Tradimento, Nudità, Drammatico, Splatter', '', 'berserk.jpg', 5),
('buonanotte_punpun', 'marco', '<span xml:lang=\"ja\">Inio Asano</span>', 'Buonanotte, Punpun', 0, '\"Buonanotte PunPun\" è uno dei manga più emozionanti che abbia mai letto. Nonostante PunPun sia disegnato come un uccellino stilizzato per me è stato molto facile immedesimarmi in lui.\r\nLa trama prende corpo dalla vita di tutti i giorni di PunPun, della sua famiglia e del mondo che li circonda. Tra alti e bassi, tra risate e tragedie vediamo di volume in volume il piccolo PunPun crescere, cambiare e maturare. Ma nonostante sia lui il protagonista a volte l\'autore lo mette da parte e ti racconta la vita degli altri personaggi che a volte nei manga cadono un po\' nel dimenticatoio o servono solo per fare scenografia.\r\nLe tavole solo stupende, anzi mi verrebbe da dire le migliori che il maestro Asano abbia disegnato fino ad ora.\r\nL\'edizione è molto pregiata anche se a volte, molto rare, le tavole presentano dei piccoli orrori di stampa.\r\nConsigliassimo!', 'Manga', 'Solitudine, Salto-temporale, sogni, Famiglia, depressione, Divinità, Umorismo-nero, Promessa-di-infanzia', '', 'oyasumipunpun.jpg', 4),
('detective_conan', 'marco', '<span xml:lang=\"ja\">Gosho Aoyama</span>', 'Detective Conan', 1, '<span xml:lang=\"en\">Detective Conan</span> è un manga davvero unico. Potrei terminare qui la mia recensione, perché è davvero così, questo manga va letto che siate fan del genere giallo o no, lo diventerete. La storia è davvero bellissima, molto articolata e soprattutto davvero lunga. <span xml:lang=\"ja\">Gosho Aoyama</span> riesce a mostrare due protagonisti in uno, facendo diventare il liceale <span xml:lang=\"ja\">Schinichi Kudo</span> nel piccolo <span xml:lang=\"ja\">Conan Edogawa</span>. Il punto forte dell\'opera sta secondo me nel presentare al lettore sempre casi di omicidio, furto o rapimento sempre nuovi e mai scontati, che riescono a tenere col fiato sospeso e far appassionare chi legge. Anche i personaggi secondari, così come quelli terziari, sono curati nei minimi dettagli, dal disegno al comportamento. Non è un caso che <span xml:lang=\"en\">Detective Conan</span> sia uno dei manga più venduti in Giappone e all\'estero e sia stato scelto come strumento di divulgazione per la cultura giapponese. In molti casi infatti ritroviamo i protagonisti a delle feste tradizionali per il paese del sol levante. Da notare ed apprezzare anche la partecipazione in alcuni capitoli di Kaito Kid, altro personaggio molto ben riuscito di Gosho Aoyama.\r\nConsigliato ovviamente l\'acquisto, anche per l\'ottima edizione italiana ed il rapporto qualità/prezzo.', 'Manga', 'Detective-Investigatori, morti-misteriose, Poliziesco, Thriller', '', 'detectiveconan.jpg', 5),
('fullmetal_alchemist', 'samuele', '<span xml:lang=\"ja\">Hiromu Arakawa</span>', 'Fullmetal Alchemist: Brotherhood', 1, '<span xml:lang=\"en\">Fullmetal Alchemist Brotherhood</span> racconta la storia dei fratelli <span xml:lang=\"en\">Elric, Edward e Alphonse</span> che cercano di riportare in vita la loro defunta madre grazie all\'alchimia. Nessuno tuttavia è mai riuscito nell\'impresa e nel tentativo il primo rimane privato di un braccio e di una gamba, mentre il secondo dell\'intero corpo; la sua anima viene tuttavia legata a un\'armatura trovata li vicino e in questo modo salvata.\r\nLa storia ruota attorno al tentativo dei due di recuperare i loro corpi, cercando nuovamente di eseguire una trasmutazione umana, che però è proibita.\r\nA differenza di <span xml:lang=\"en\">\"Fullmetal Alchemist\"</span> questa serie ripercorre fedelmente la trama dello stesso manga, senza deviazioni nè rivoluzioni, risultando quindi di livello nettamente superiore per quanto riguarda la trama.\r\n<span xml:lang=\"en\">Fullmetal Alchemist Brotherhood</span> è una serie pienissima d\'azione e di colpi di scena dalla prima all\'ultima puntata, molti sono i personaggi legati alla vicenda e tutti ben congegnati. Anche per quanto riguarda il doppiaggio italiano è stato volto un lavoro perfetto. Accattivanti e coinvolgenti le colonne sonore che sono state mantenute originali.\r\nGraficamente un buon lavoro, soprattutto per la difficile impresa di ottenere le adeguate espressioni da un\'armatura, che è stata realizzata benissimo.\r\nConsiglio vivamente la visione a tutti coloro che sono in cerca di un titolo importante e ricolma di azione, colpi di scena e superpoteri ma anche piena di importanti tematiche su cui poter riflettere a lungo.', 'Anime', 'guerra, Orfani-orfanotrofio, fratelli, Morte-di-una-persona-cara, Alchimia, crescita-dei-protagonisti, corpo-militare-soldati-esercito, Protagonista-basso, Complotto-cospirazione, MTV-Anime-Night', '', 'fullmetalalchemist.jpg', 5),
('gintama', 'stefano', '<span xml:lang=\"ja\">Hideaki Sorachi</span>', 'Gintama', 0, 'Anime davvero assurdo, ma questo non è un commento negativo.\r\nSimpatico, capace di creare verso <span xml:lang=\"ja\">Gintoki</span>, il personaggio principale, una grande ammirazione.\r\nLa realizzazione tecnica è ottima, opening veramente belle, colonna sonora adatta al tipo di anime.\r\nLa storia segue le vicende dell\'agenzia tutto fare di <span xml:lang=\"ja\">Gintoki</span>; la trama è molto semplice ma adatta al tipo di anime in questione, demenziale, simpatico, ricco di parodie divertenti, in questo momento mi vengono in mente quella di <span xml:lang=\"en\">Detective Conan</span> e di <span xml:lang=\"en\">Death Note</span>, fantastiche.\r\nI primi episodi sono abbastanza lenti e pallosi, ma poi la storia diventa meno pesante e verrete trasportati in un mondo fantastico in cui non manca nulla: samurai, alieni, combattimenti, parodie, stupidaggini... c\'è n\'è per tutti.', 'Anime', 'samurai, Amore-non-corrisposto, Alieni, Periodo-Edo-Tokugawa, leggende, Shinsengumi, Spade-Spadaccini, Agenzia-tuttofare, MTV-Anime-Night, kemonomimi', '', 'gintama.jpg', 3),
('hunterxhunter', 'lorenzo', '<span xml:lang=\"ja\">Yoshihiro Togashi</span>', 'Hunter x Hunter', 1, 'Questo anime è qualcosa di ineguagliato al momento. (Per me...ovvio)\r\nRappresenta tutto ciò che per me è adesso il <span xml:lang=\"en\">\"gold standard\"</span> degli anime.\r\nSe <span xml:lang=\"en\">\"Fairy Tail\"</span> è il peggiore inarrivabile... questo è il migliore in assoluto.\r\n\r\nPersonaggi? Ben caratterizzati, mai banali e mai buoni o cattivi, ma solo veri e fedeli a se stessi.\r\nStoria? La più grande genialata è nel titolo... la storia è la ricerca, la caccia di qualcosa o qualcuno, ogni arco narrativo narra una storia diversa ma sempre coerente. Si va sempre migliorando fino alla saga delle formichimere che per me è la cosa più bella che abbia mai anche solo immaginato.\r\nDiverte? Sì decisamente sì, ho visto tutti gli episodi praticamente di seguito... se proprio vogliamo dire qualcosa di negativo, boh, potrebbe non piacere a bambini che vogliono solo vedere scintille e booom sullo schermo. Per il resto è il top.\r\nDifetti? L’autore si prende delle pause e al momento è fermo...\r\n\r\nVi avviso però io da quando l’ho visto vivo in un perenne stato di tristezza poiché ha alzato tanto l’asticella delle mie aspettative per uno shonen che non riesco più a trovare niente di stimolante...\r\nA vostro rischio e pericolo', 'Anime', 'Violenza, rivalità, Allenamento, Superpoteri', '', 'hunterxhunter.jpg', 5),
('onepiece', 'admin', '<span xml:lang=\"ja\">Eiichiro Oda</span>', 'One Piece', 1, 'Ho sempre visionato <span xml:lang=\"en\">One Piece</span> saltuariamente sin dalla sua prima messa in onda in tv per mancanza di tempo e perché credevo fosse troppo demenziale, ma mi sono dovuta ricredere: ho avuto modo di conoscere questa serie per intero solo tra l\'ottobre e il gennaio scorsi (tanto mi ci è voluto per vedere i primi 487 episodi della serie), e i personaggi, secondo me tutti ben caratterizzati e numerosi, così come la freschezza della storia, mi avevano già colpito parecchi anni fa, ma solo ora posso dire con sicurezza che <span xml:lang=\"en\">One Piece</span> è per me uno dei migliori shounen in circolazione, secondo me persino superiore a Naruto, che apprezzo moltissimo.\r\nUna colonna sonora di tutto rispetto, da poema sinfonico, fa da sfondo perfetto alle avventure appassionanti di un manipolo di giovani pirati ai quali è impossibile non affezionarsi, umani, carismatici e credibili come sono.', 'Anime', 'pirati combattimenti Mare oceano Corruzione protagonista-coraggioso protagonista-ricercato Protagonista-determinato protagonista-orfano Superpoteri Protagonista-stupido', '', 'onepiece.jpg', 4),
('steinsgate', 'samuele', '<span xml:lang=\"en\">White Fox</span>', 'Steins;Gate', 1, 'Potrò sembrare troppo generoso, ma a parer mio questo, in cinque/sei anni che vedo anime, è quello che mi è piaciuto di più in assoluto, il mio anime preferito.\r\n\r\nLa trama è particolare, insolita: <span xml:lang=\"ja\">Kyouma Hooin</span>, il cui nome originale è <span xml:lang=\"ja\">Rintaro Okabe</span>, studente universitario autoproclamatosi scienziato pazzo, conduce piccoli esperimenti e crea invenzioni in un appartamento di Tokyo con i suoi due amici, <span xml:lang=\"ja\">Itaru Hashida</span>, detto Daru, e <span xml:lang=\"ja\">Mayuri</span>, detta <span xml:lang=\"ja\">Mayushii</span>. Un giorno, durante una calda giornata di luglio nel 2010, <span xml:lang=\"ja\">Okabe</span>, dopo aver assistito a un omicidio di un personaggio fondamentale che non cito, rimane coinvolto in un fenomeno impossibile: una delle sue invenzioni è in grado di inviare messaggi del telefono nel passato. Da lì in poi, tramite tutto ciò che lui farà e si susseguirà, <span xml:lang=\"ja\">Okabe</span> capirà che l\'uomo non deve avere il potere di influenzare il passato, né ora né mai.\r\n\r\nIo ho apprezzato su tutta la linea questo anime, anche la presenza di vari riferimenti a teorie di fisica moderne e a esperimenti reali. A parer mio, è un capolavoro, che riesce a combinare in un\'unica storia tratti di commedia, fantascienza (e scienza vera e propria), sentimenti d\'amore e thriller, senza rovinare il prodotto finale in sé. Quindi il mio voto è 5/5, consigliato assolutamente.', 'Anime', 'Science-Adventures, viaggio-nel-tempo, Spie, Morte-di-una-persona-cara, Complotto-cospirazione, salvare-qualcuno', '', 'steinsgate.jpg', 5),
('vagabond', 'lorenzo', '<span xml:lang=\"ja\">Takehito Inoue</span>', 'Vagabond', 1, '<span xml:lang=\"en\">Vagabond</span> è un capolavoro. Già, partiamo da questo presupposto. In questo manga funziona tutto alla grande: a partire dagli eccezionali disegni, le pagine a colori con acquerelli, la storia bellissima, la caratterizzazione dei personaggi ecc.\r\nCi sono tanti manga sui samurai, ma senza dubbio per me è questo che ha colto in pieno quel periodo storico e la via della spada. Nel leggere <span xml:lang=\"en\">Vagabond</span> ci si rende subito conto di avere a che fare con una manga di serie A e con un mangaka, il caro <span xml:lang=\"ja\">Inoue</span>, che sa davvero come prendere il lettore.\r\n\r\nNon c\'è stato numero di <span xml:lang=\"en\">Vagabond</span> che non mi abbia fatto venire voglia di leggerne subito un altro. Molti mangaka dovrebbero imparare da <span xml:lang=\"ja\">Inoue</span>: <span xml:lang=\"en\">Vagabond</span> infatti poteva essere allungato in molte parti della storia ma non è stato così, ogni volume è essenziale e utile alla trama principale. Rimane anzi il rammarico che questa stupenda opera sia alla conclusione già solo al 34esimo numero.\r\nSperiamo davvero che la pausa forzata di <span xml:lang=\"ja\">Inoue</span> per problemi di salute lo abbia fatto ricredere e che ci regali almeno altri 2 o 3 volumetti di questo fantastico manga.', 'Manga', 'samurai, Epoca-Sengoku, kodansha-manga-awards, rivalità, serial-killer, arti-marziali, Osamu-Tezuka-Cultural-Prize, Combattimenti-armati, crescita-dei-protagonisti, japan-media-arts-festival, Spade-Spadaccini, Opera-vincitrice-di-premi', '', 'vagabond.jpg', 5);
