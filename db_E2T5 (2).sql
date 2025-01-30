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
use db_E2T5II;
-- INSERTS FOR IATA
INSERT INTO aireportua (kodAireportua, HIRIA) VALUES
('ACA', 'MÉXICO (ACAPULCO)'),
('ACE', 'Lanzarote'),
('AGP', 'MALAGA'),
('ALC', 'Alicante'),
('AMM', 'JO (Ammán) AMM'),
('AMS', 'HOLANDA Amsterdam'),
('ATH', 'GRECIA ( Atenas)'),
('BCN', 'Barcelona'),
('BER', 'ALEMANIA (Berlín)'),
('BIO', 'Bilbao'),
('BJZ', 'Badajoz'),
('BKK', 'TAILANDIA Bagkok'),
('BOG', 'COLOMBIA Bogotá'),
('BOS', 'Boston'),
('BRU', 'BELGICA (Bruselas)'),
('BSB', 'BRASIL (brasilia)'),
('BUE', 'Buenos Aires '),
('CAI', 'EG El Cairo'),
('CAS', 'MARRUECOS (Casablanca)'),
('CCS', 'VENEZUELA (CARACAS)'),
('CDG', 'FRANCIA, París(aeropuerto Charles de Gaulle)'),
('CPH', 'DINAMARCA'),
('DTT', 'DETROIT'),
('DUB', 'IRLANDA (DUBLIN)'),
('DUS', 'ALEMANIA (Dusseldorf)'),
('EAS', 'SAN SEBASTIAN'),
('FRA', 'ALEMANIA (Frankfurt)'),
('FUE', 'FUERTEVENTURA'),
('GMZ', 'LA GOMERA'),
('GRO', 'Gerona'),
('GRX', 'Granada'),
('GVA', 'SUIZA (Ginebra)'),
('HAM', 'ALEMANIA (hamburgo)'),
('HEL', 'FINLANDIA (Helsinki)'),
('HOU', 'Houston'),
('IBZ', 'Ibiza'),
('IST', 'TR (ESTAMBUL)'),
('JFK', 'Nueva York'),
('KIN', 'JAMAICA (kingston)'),
('LAX', 'LOS ANGELES'),
('LBG', 'FRANCIA ,Le Bourget,'),
('LCG', 'La Coruña LCG'),
('LGH', 'LONDRES (GATWICK)'),
('LHR', 'LONDRES Heathrow'),
('LIM', 'PERU ( Lima)'),
('LIS', 'PT (lisboa)'),
('LPA', 'GRAN CANARIA'),
('LYS', 'FRANCIA (lyon)'),
('MAD', 'Madrid'),
('MAH', 'MAHON'),
('MEL', 'AUSTRALIA Melbourne'),
('MEX', 'México D.F.'),
('MIA', 'Miami'),
('MIL', 'ITALIA (Milán )'),
('MJV', 'Murcia'),
('MOW', 'RUSIA (Moscú) MOW'),
('MRS', 'FRANCIA (Marsella)'),
('MUC', 'ALEMANIA (Munich )'),
('NBO', 'KENIA ( Nairobi)'),
('ODB', 'Córdoba'),
('ORY', 'FRANCIA (ORLY)'),
('OSL', 'NORUEGA (oslo)'),
('OVD', 'Asturias'),
('PHL', 'Philadelphia PHL'),
('PMI', 'PALMA DE MALLORCA'),
('PNA', 'Pamplona'),
('PRG', 'REPUBLICA CHECA (Praga)'),
('RAK', 'MARRUECOS (Marrakech)'),
('REU', 'REUS'),
('RIO', 'BRASIL (Rio de Janeiro )'),
('SAO', 'BRASIL (Sao Paulo)'),
('SCQ', 'Santiago de Compostela'),
('SDQ', 'REPUBLICA DOMINICANA (Santo Domingo)'),
('SDR', 'SANTANDER'),
('SEA', 'Seattle'),
('SFO', 'SAN FRANCISCO'),
('SLM', 'Salamanca'),
('SPC', 'Santa Cruz de la Palma'),
('STN', 'LONDRES (Stanted)'),
('STO', 'SUECIA (Estocolmo)'),
('STR', 'ALEMANIA (Stuttgart)'),
('SYD', 'AUSTRALIA (SIYNEY)'),
('TFN', 'Tenerife Norte'),
('TFS', 'Tenerife Sur'),
('TUN', 'Túnez'),
('VDE', 'HIERRO'),
('VGO', 'Vigo'),
('VIE', 'AUSTRIA (Viena)'),
('VIT', 'VITORIA'),
('VLC', 'Valencia'),
('WAS', 'WASHINGTON'),
('WAW', 'POLONIA (Varsovia ) WAW'),
('XRY', 'JEREZ DE LA FRONTERA'),
('YMQ', 'Montreal, Québec'),
('YOW', 'CA Ottawa, Ontario YOW'),
('YTO', 'CA Toronto, Ontario YTO'),
('YVR', 'CA VANCOUVER'),
('ZAZ', 'Zaragoza'),
('ZRH', 'SUIZA (Zurich)');

-- INSERTS FOR HERRIALDEAK
INSERT INTO herrialdeak VALUES
('AR', 'ARGENTINA'),
('AT', 'AUSTRIA'),
('BE', 'BÉLGICA'),
('BR', 'BRASIL'),
('CA', 'CANADA'),
('CH', 'SUIZA'),
('CN', 'CHINA'),
('CU', 'CUBA'),
('CY', 'CHIPRE'),
('CZ', 'REPUBLICA CHECA'),
('DE', 'ALEMANIA'),
('DK', 'DINAMARCA'),
('EE', 'ESTONIA'),
('EG', 'EGIPTO'),
('ES', 'ESPAÑA'),
('FI', 'FINLANDIA'),
('FR', 'FRANCIA'),
('GB', 'REINO UNIDO'),
('GR', 'GRECIA'),
('GT', 'GUATEMALA'),
('HK', 'HONG-KONG'),
('HR', 'CROACIA'),
('HU', 'HUNGRIA'),
('ID', 'INDONESIA'),
('IE', 'IRLANDA'),
('IL', 'ISRAEL'),
('IN', 'INDIA'),
('IS', 'ISLANDIA'),
('IT', 'ITALIA'),
('JM', 'JAMAICA'),
('JP', 'JAPÓN'),
('KE', 'KENIA'),
('LU', 'LUXEMBURGO'),
('MA', 'MARRUECOS'),
('MC', 'MÓNACO'),
('MT', 'MALTA'),
('MV', 'MALDIVAS'),
('MX', 'MEXICO'),
('NL', 'PAISES BAJOS'),
('NO', 'NORUEGA'),
('PA', 'PANAMÁ'),
('PE', 'PERÚ'),
('PL', 'POLONIA'),
('PR', 'PUERTO RICO'),
('PT', 'PORTUGAL'),
('QA', 'QATAR'),
('RO', 'RUMANIA'),
('RU', 'RUSIA'),
('SC', 'SEYCHELLES'),
('SE', 'SUECIA'),
('SG', 'SINGAPUR'),
('TH', 'TAILANDIA'),
('TN', 'TÚNEZ'),
('TR', 'TURQUIA'),
('TZ', 'TANZANIA (INCLUYE ZANZIBAR)'),
('US', 'ESTADOS UNIDOS'),
('VE', 'VENEZUELA'),
('VN', 'VIETNAM'),
('ZA', 'SUDÁFRICA');

-- INSERTS FOR LANG_KOPURUA
INSERT INTO lang_kop  VALUES
('L1', '5 gehienez (1 - 5 bitartean)'),
('L2', '10 gehienez (1 - 10 bitartean)'),
('L3', '20 gehienez (1 - 20 bitartean)');

-- INSERTS FOR BIDAIA MOTAK
INSERT INTO bid_mota VALUES
('B1', 'Ezkongaiak'),
('B2', 'Senior'),
('B3', 'Taldeak'),
('B4', 'Bidaia handiak (helmuga exotikoak + hegaldia + ostatua)'),
('B5', 'Eskapada'),
('B6', 'Familiak (haur txikiekin)');

-- INSERTS FOR AIRELINEAK
INSERT INTO airelineak VALUES
('2K', 'AVIANCA-Ecuador dba AVIANCA', 'EC'),
('3P', 'World 2 Fly PT, S.A.', 'PT'),
('6B', 'TUIfly Nordic AB', 'CN'),
('A.C', 'Air France ', 'FR'),
('A0', 'BA Euroflyer Limited dba British Airways', 'GB'),
('AA', 'American Airlines', 'USA'),
('AM', 'Aerovias de Mexico SA de CV dba AeroMexico', 'MX'),
('AR', 'Aerolineas Argentinas S.A.', 'AR'),
('AV', 'Aerovias del Continente Americano S.A. AVIANCA', 'CO'),
('AY', 'Finnair ', 'FI'),
('AZ', 'Alitalia', 'IT'),
('BA', 'British Airways PLC', 'GB'),
('CL', 'Lufthansa CityLine GmbH', 'DE'),
('DE', 'Condor Flugdienst GmbH', 'DE'),
('DL', 'Delta Air Lines Inc', 'USA'),
('DS', 'Easyjet CH S.A', 'CH'),
('GL', 'Air GRL', 'GRL'),
('JJ', 'Tam Linhas Aereas SA dba Latam Airlines Brasil', 'BR'),
('KL', 'KLM', 'NL'),
('KN', 'CN United Airlines', 'CN'),
('LH', 'Lufthansa', 'DE'),
('LX', 'SWISS Internation Air Lines Ltd', 'CH'),
('M3', 'BSA - Aerolinhas Brasileiras S.A dba LATAM Cargo Br', 'BR'),
('MS', 'Egyptair', 'EG'),
('MT', 'MT Air Travel Ltd dba MT MedAir', 'MT'),
('N0', 'Norse Atlantic Airways AS', 'NO'),
('OU', 'HR Airlines d.d.', 'HR'),
('PC', 'Pegasus Airlines', 'TR'),
('QR', 'QA Airways Group Q.C.S.C dba QA Airways', 'QA'),
('RJ', 'Alia - The Royal JOn Airlines dba Royal JOn', 'JO'),
('RK', 'RYNAIR', 'GB'),
('S4', 'SATA Internacional - Azores Airlines, S.A.', 'PT'),
('SN', 'Brussels Airlines', 'BE'),
('SP', 'SATA (Air Acores)', 'PT'),
('TK', 'Turkish Airlines Inc', 'TR'),
('TP', 'TAP PT', 'PT'),
('TS', 'Air Transat', 'CA'),
('U2', 'EASYJET UK LIMITED', 'GB'),
('UA', 'United Airlines Inc', 'USA'),
('UX', 'Air Europa Lineas Aereas, S.A.', 'ES'),
('VOY', 'Aerolínea Vueling SA', 'ES'),
('VS', 'Virgin Atlantic Airways Ltd', 'GB'),
('WA', 'KLM Cityhopper', 'NL'),
('WFL', 'World2Fly', 'ES'),
('WK', 'Edelweiss Air AG', 'CH'),
('X3*', 'TUIfly Gmbh', 'DE'),
('X7', 'Challenge Airlines (BE) S.A.', 'BE'),
('YW', 'Air Nostrum, Lineas aereas del Mediterra neo SA', 'ES');

-- INSERTS FOR AGENTZIA MOTAK
INSERT INTO agenmota VALUES
('A1', 'Mayorista'),
('A2', 'Minorista'),
('A3', 'Mayorista-minorista');

-- INSERTS FOR LOGELA MOTAK
INSERT INTO logela_mota VALUES
('DB', 'Bikoitza'),
('DUI', 'Bikoitza, erabilpen indibiduala'),
('SIN', 'Indibiduala'),
('TPL', 'Hirukoitza');