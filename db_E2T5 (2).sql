DROP DATABASE IF EXISTS db_E2T5II;
CREATE DATABASE IF NOT EXISTS db_E2T5II
charset utf8mb4
collate utf8mb4_spanish2_ci;

USE db_E2T5II;

CREATE TABLE lang_kop (
    kodLangileKop char(2) PRIMARY KEY NOT NULL,
    desk varchar(130)
);

CREATE TABLE agenMota (
    kodAMota char(2) PRIMARY KEY NOT NULL,
    desk varchar(20)
);

CREATE TABLE bid_mota (
    kodBidMota char(2) PRIMARY KEY NOT NULL,
    Desk varchar(150)
);

CREATE TABLE herrialdeak (
    idHerri char(25) PRIMARY KEY NOT NULL,
    izena varchar(130)
);

CREATE TABLE aireportua (
    kodAireportua char(3) PRIMARY KEY NOT NULL,
    hiria VARCHAR(50)
);

CREATE TABLE airelineak (
    kodAirelinea char(15) PRIMARY KEY NOT NULL,
    izena varchar(200),
    idHerri varchar(50)
);

CREATE TABLE agentzia (
    idAgen int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    izena VARCHAR(20) NOT NULL,
    logoa VARCHAR(50),
    markaren_kolorea VARCHAR(20),
    kodLangileKop char(2),
    erabiltzaile varchar(20),
    pasahitza varchar(20),
    kodAMota char(2),
    FOREIGN KEY (kodLangileKop) REFERENCES lang_kop (kodLangileKop),
    FOREIGN KEY (kodAMota) REFERENCES agenMota (kodAMota)
);

CREATE TABLE bidaia (
    idBid int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    izena varchar(20),
    desk text,
	hasieeraData date,
    amaieraData date,
    idAgen int,
    kodBidMota char(2),
    idHerri char(2),
    FOREIGN KEY (idAgen) REFERENCES agentzia (idAgen) ON DELETE CASCADE,
    FOREIGN KEY (kodBidMota) REFERENCES bid_mota (kodBidMota),
    FOREIGN KEY (idHerri) REFERENCES herrialdeak (idHerri)
);

CREATE TABLE zerbitzuak (
    idZerb int AUTO_INCREMENT PRIMARY KEY not null,
    idBid int,
    FOREIGN KEY (idBid) REFERENCES bidaia (idBid) ON DELETE CASCADE
);

CREATE TABLE logela_mota (
    kodLogMota CHAR(5) primary key not null,
    desk varchar(40));
    
CREATE TABLE ostatua (
    idZerb int PRIMARY KEY,
    hotelaren_izena varchar(30),
    hiria varchar (30),
    prezioa decimal,
    sarrera_eguna date,
    irteera_eguna date,
    kodLogMota CHAR(5),
    FOREIGN KEY (idZerb) REFERENCES zerbitzuak (idZerb) ON DELETE CASCADE,
    FOREIGN KEY (kodLogMota) REFERENCES logela_mota (kodLogMota)
);

CREATE TABLE beste_batzuk (
    idZerb int PRIMARY KEY,
    izena varchar (20),
    datak date,
    desk varchar (30),
    prezioa decimal,
	FOREIGN KEY (idZerb) REFERENCES zerbitzuak (idZerb) ON DELETE CASCADE
);

CREATE TABLE hegaldia (
    idZerb int PRIMARY KEY,
    hegaldi_kodea VARCHAR(10),
    prezioa DECIMAL,
    irteera_data DATE,
    irteera_ordutegia TIME,
    bidaiaren_iraupena INT,
    KodAirelinea char(5),
    kodAireportua_jatorria CHAR(5),
    kodAireportua_itzulera CHAR(5),
    KodAireportua char(3),
    FOREIGN KEY (idZerb) REFERENCES zerbitzuak (idZerb) ON DELETE CASCADE,
    FOREIGN KEY (KodAirelinea) REFERENCES airelineak (KodAirelinea),
    FOREIGN KEY (KodAireportua) REFERENCES aireportua (kodAireportua) 
);

CREATE TABLE joan_etorri (
	idZerb int PRIMARY KEY, 
    kodAireportua char(3),
	kodAirelinea char(5),
	prezioa decimal,
    itzulera_data date,
    itzulera_ordua time,
    irteera_data date,
    irteera_ordua time,
    aireportu_jatorri VARCHAR (50),
    helmuga VARCHAR (20),
    FOREIGN KEY (idZerb) REFERENCES hegaldia (idZerb) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (kodAireportua) REFERENCES aireportua (kodAireportua),
	FOREIGN KEY (kodAirelinea) REFERENCES airelineak (kodAirelinea)
);