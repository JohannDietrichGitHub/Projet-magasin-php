SET NAMES utf8;

DROP TABLE IF EXISTS panier;
DROP TABLE IF EXISTS clients;
DROP TABLE IF EXISTS villes;
DROP TABLE IF EXISTS articles;

-- Création de la table villes
CREATE TABLE villes(
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    code_postal varchar(128),
    nom varchar(128),
    Primary Key(id)
) CHARACTER SET utf8;

-- Création de la table clients
CREATE TABLE clients(
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    prenom varchar(128),
    nom varchar(128),
    email varchar(128),
    date_naissance date,
    adresse varchar(128),
    ville_id int UNSIGNED,
    parrain_id int UNSIGNED NULL DEFAULT NULL,
    Primary Key(id),
    Foreign Key(ville_id) REFERENCES villes(id)
) CHARACTER SET utf8;

-- Création de la table articles
CREATE TABLE articles(
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    nom varchar(128),
    reference varchar(128),
    prix_ht decimal(10,2),
    taxe int,
    promotion int NULL,
    nouveaute boolean,
    Primary Key(id)
) CHARACTER SET utf8;

-- Création de la table panier
CREATE TABLE panier(
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    client_id int UNSIGNED NOT NULL,
    FOREIGN KEY (client_id) REFERENCES clients(id),
    article_id int UNSIGNED NOT NULL,
    FOREIGN KEY (article_id) REFERENCES articles(id),
    quantite int UNSIGNED NOT NULL,
    Primary Key(id)
) CHARACTER SET utf8;

-- Insertion des données articles
INSERT INTO articles values(1, 'marteau de menuisier bois verni',81968453,8.90,20,NULL, 0);
INSERT INTO articles values(2, 'marteau massette fibre de verre',80166978,21.90,20,NULL, 0);
INSERT INTO articles values(3, 'maillet de menuisier bois',82039106,14.90,20,NULL, 0);
INSERT INTO articles values(4, 'marteau arrache-clou',81968500,12.90,20,NULL, 0);
INSERT INTO articles values(5, 'tournevis électricien plat',74936295,1.95,20,NULL, 1);
INSERT INTO articles values(6, 'tournevis électricien isolé plat',67337361,5.10,20,NULL, 0);
INSERT INTO articles values(7, 'tournevis testeur de tension plat',76292503,2.90,20,NULL, 0);
INSERT INTO articles values(8, 'tournevis sans fil',81900760,40.00,20,NULL, 0);
INSERT INTO articles values(9, 'jeu de tournevis',73923500,34.90,20,NULL, 1);
INSERT INTO articles values(10, 'tournevis cruciforme',74936246,3.20,20,NULL, 0);
INSERT INTO articles values(11, 'jeu de tournevis torx',74936372,17.90,20,NULL, 0);
INSERT INTO articles values(12, 'tournevis boule cruciforme',73708264,3.95,20,NULL, 0);
INSERT INTO articles values(13, 'scie de carreleur',18850476,9.95,20,NULL, 0);
INSERT INTO articles values(14, 'lot de 2 lames pour scie à métaux',70709401,2.50,20,NULL, 0);
INSERT INTO articles values(15, 'scie à métaux',70907452,8.90,20,NULL, 0);
INSERT INTO articles values(16, 'scie égoïne de charpentier',70907354,10.90,20,NULL, 0);
INSERT INTO articles values(17, 'boîte à onglet manuelle',70709653,9.90,20,NULL, 1);
INSERT INTO articles values(18, 'scie japonaise',67998931,18.90,20,NULL, 0);
INSERT INTO articles values(19, 'scie à bûche',63732655,15.60,20,NULL, 0);
INSERT INTO articles values(20, 'scie universelle',70720265,2.05,20,NULL, 0);
INSERT INTO articles values(21, 'fourreau pour scie',70709345,3.90,20,NULL, 0);
INSERT INTO articles values(22, 'scie à chantourner de plaquiste',73550442,5.99,20,NULL, 0);
INSERT INTO articles values(23, 'pince coupante',69241060,39.00,20,NULL, 0);
INSERT INTO articles values(24, 'pince à sertir les rails',80150490,24.90,20,NULL, 0);
INSERT INTO articles values(25, 'pince à agraphage des profiles',80124107,55.00,20,NULL, 0);
INSERT INTO articles values(26, 'pince à dénuder',80125159,8.90,20,NULL, 0);
INSERT INTO articles values(27, 'pince-clé multiprise',69587994,49.90,20,NULL, 1);
INSERT INTO articles values(28, 'pince coupe-mosaïque',18699366,19.90,20,NULL, 0);
INSERT INTO articles values(29, 'pince perroquet',18699345,14.90,20,NULL, 0);
INSERT INTO articles values(30, 'pince à cosse isolée',70059913,25.90,20,NULL, 0);
INSERT INTO articles values(31, 'pince coupe-carrelage',18699310,9.90,20,NULL, 0);
INSERT INTO articles values(32, 'pince à cintrer',74669791,20.40,20,NULL, 0);
INSERT INTO articles values(33, 'pince coupe-boulons coupante',80125144,20.90,20,NULL, 0);
INSERT INTO articles values(34, 'cisaille à tôle à ardoise coupe devant',80125135,10.90,20,NULL, 0);
INSERT INTO articles values(35, 'pince pour collier de fixation',66502576,17.35,20,NULL, 0);
INSERT INTO articles values(36, 'pince à bec',80125154,10.90,20,NULL, 1);

-- Insertion des données ville
INSERT INTO villes values(1,'78140','VÉLIZY-VILLACOUBLAY');
INSERT INTO villes values(2,'42400','SAINT-CHAMOND');
INSERT INTO villes values(3,'97180','SAINTE-ANNE');
INSERT INTO villes values(4,'57070','METZ');
INSERT INTO villes values(5,'27000','ÉVREUX');
INSERT INTO villes values(6,'24100','BERGERAC');
INSERT INTO villes values(7,'75003','PARIS');
INSERT INTO villes values(8,'97122','BAIE-MAHAULT');
INSERT INTO villes values(9,'37000','TOURS');
INSERT INTO villes values(10,'91130','RIS-ORANGIS');
INSERT INTO villes values(11,'44200','NANTES');
INSERT INTO villes values(12,'36000','CHÂTEAUROUX');
INSERT INTO villes values(13,'12100','MILLAU');
INSERT INTO villes values(14,'93260','LES LILAS');
INSERT INTO villes values(15,'67100','STRASBOURG');
INSERT INTO villes values(16,'34300','AGDE');
INSERT INTO villes values(17,'59430','SAINT-POL-SUR-MER');
INSERT INTO villes values(18,'92200','NEUILLY-SUR-SEINE');
INSERT INTO villes values(19,'91150','ÉTAMPES');
INSERT INTO villes values(20,'93110','ROSNY-SOUS-BOIS');
INSERT INTO villes values(21,'74100','ANNEMASSE');
INSERT INTO villes values(22,'91210','DRAVEIL');
INSERT INTO villes values(23,'59650',"VILLENEUVE-D'ASCQ");
INSERT INTO villes values(24,'97610','DZAOUDZI');
INSERT INTO villes values(25,'94130','NOGENT-SUR-MARNE');
INSERT INTO villes values(26,'78000','VERSAILLES');
INSERT INTO villes values(27,'63100','CLERMONT-FERRAND');
INSERT INTO villes values(28,'94350','VILLIERS-SUR-MARNE');
INSERT INTO villes values(29,'49400','SAUMUR');
INSERT INTO villes values(30,'68100','MULHOUSE');
INSERT INTO villes values(31,'33160','SAINT-MÉDARD-EN-JALLES');
INSERT INTO villes values(32,'91600','SAVIGNY-SUR-ORGE');
INSERT INTO villes values(33,'78180','MONTIGNY-LE-BRETONNEUX');
INSERT INTO villes values(34,'97150','SAINT-MARTIN');
INSERT INTO villes values(35,'93270','SEVRAN');
INSERT INTO villes values(36,'80000','AMIENS');
INSERT INTO villes values(37,'95170','DEUIL-LA-BARRE');
INSERT INTO villes values(38,'69004','LYON');
INSERT INTO villes values(39,'05000','GAP');
INSERT INTO villes values(40,'32000','AUCH');
INSERT INTO villes values(41,'59160','LOMME');
INSERT INTO villes values(42,'33310','LORMONT');
INSERT INTO villes values(43,'69120','VAULX-EN-VELIN');
INSERT INTO villes values(44,'29900','CONCARNEAU');
INSERT INTO villes values(45,'69140','RILLIEUX-LA-PAPE');

-- Insertion des données client
INSERT INTO clients values(1,'Melville','DESFORGES','Melville.DESFORGES@laposte.fr','1965-02-09',"96 boulevard d'Alsace",1,NULL);
INSERT INTO clients values(2,'Lirienne','METIVIER','lilimetiv@hotmail.com','1950-09-29','74 rue des Nations Unies',2,NULL);
INSERT INTO clients values(3,'Delmare','BISSON','Delmare.BISSON@gmail.com','1936-02-17','32 rue Pierre Motte',3,NULL);
INSERT INTO clients values(4,'Morgana','LAZURE','Morgana.LAZURE@wanadoo.fr','1958-09-09','12 Rue St Ferréol',4,NULL);
INSERT INTO clients values(5,'Elise','FERLAND','Elise.FERLAND@gmail.com','1963-09-19','1 rue Charles Corbeau',5,3);
INSERT INTO clients values(6,'Belda','GUAY','Belda.GUAY@gmail.com','1982-11-14','98 rue Jean Vilar',6,NULL);
INSERT INTO clients values(7,'Mandel','LANGLAIS','Mandel.LANGLAIS@laposte.fr','1983-03-04','1 rue Nationale',7,NULL);
INSERT INTO clients values(8,'Avice','CLOUTIER','Avice.CLOUTIER@gmail.com','1977-10-03','82 Rue Joseph Vernet',8,NULL);
INSERT INTO clients values(9,'Pascaline','GREGOIRE','Pascaline.grgoire@gmail.com','1960-12-05','49 rue Pierre Motte',3,NULL);
INSERT INTO clients values(10,'Xavierre','LEMIEUX','Xavierre67@gmail.com','1988-10-27','87 quai Saint-Nicolas',9,NULL);
INSERT INTO clients values(11,'Ambra','VARIEUR','A.varieur@gmail.com','1994-08-19','68 rue Gustave Eiffel',10,NULL);
INSERT INTO clients values(12,'Héloise','BELAIR','Heloise.BELAIR@gmail.com','1969-11-08','64 rue de Raymond Poincaré',11,NULL);
INSERT INTO clients values(13,'Pascal','ROUSSEAU','Pascal.ROUSSEAU@gmail.com','1982-06-06','85 rue du Gue Jacquet',12,NULL);
INSERT INTO clients values(14,'Roland','TRUCHON','Roland.TRUCHON@hotmail.com','1960-12-11','46 rue Bonneterie',13,NULL);
INSERT INTO clients values(15,'Tilly','GRENIER','Tillygregre@orange.fr','1998-03-29','14 rue du Général Ailleret',14,23);
INSERT INTO clients values(16,'Barry','DUPONT','Barrybgdu67@gmail.com','1978-11-04','63 rue Descartes',15,NULL);
INSERT INTO clients values(17,'Ruby','DUBEAU','Ruby.DUBEAU@gmail.com','1978-05-24','64 rue Gontier-Patin',16,NULL);
INSERT INTO clients values(18,'Roland','BEAUCHAMP','Roland.BEAUCHAMP@laposte.fr','1985-04-04','20 rue de la Hulotais',17,NULL);
INSERT INTO clients values(19,'Bruce','CAILOT','Bruce.CAILOT@gmail.com','1996-10-05','59 rue de Raymond Poincaré',12,NULL);
INSERT INTO clients values(20,'Dixie','VALLEE','Dixie.VALLEE@gmail.com','1962-05-19','3 rue de Raymond Poincaré',18,8);
INSERT INTO clients values(21,'Violette','CHALOUX','Violette.CHALOUX@laposte.fr','1970-04-28','78 Rue du Palais',19,NULL);
INSERT INTO clients values(22,'Hardouin','CHALIFOUR','Hardouin.CHALIFOUR@gmail.com','1969-02-08','15 rue de Groussay',20,38);
INSERT INTO clients values(23,'Arienne','BROUSSE','Arienne.BROUSSE@hotmail.com','1973-07-29','60 Avenue De Marlioz',21,NULL);
INSERT INTO clients values(24,'Sacripant','LEBEL','Sacripant.LEBEL@gmail.com','1996-01-12','25 rue Cazade',22,NULL);
INSERT INTO clients values(25,'Claudette','PROULX','Claudettelafofolle@hotmail.com','1966-09-09','67 rue Descartes',16,NULL);
INSERT INTO clients values(26,'Gallia','BUSSON','Gallia.BUSSON@gmail.com','1974-02-15','94 Place Charles de Gaulle',23,38);
INSERT INTO clients values(27,'Seymour','LAJEUNESSE','Seymour.LAJEUNESSE@orange.fr','1988-08-08','8 Avenue Millies Lacroix',24,NULL);
INSERT INTO clients values(28,'Anaïs','DUPLANTY','Anaïs.DUPLANTY@laposte.fr','1979-05-12','38 boulevard de Prague',25,NULL);
INSERT INTO clients values(29,'Daisi','CAMUS','Daisi.CAMUS@gmail.com','1963-11-22','66 Rue Frédéric Chopin',26,NULL);
INSERT INTO clients values(30,'Corinne','LACHANCE','Corinne.LACHANCE@laposte.fr','1982-12-10','26 Rue de Strasbourg',27,NULL);
INSERT INTO clients values(31,'Céline','BANG','Céline.BANG@orange.fr','1965-11-14','76 rue Marguerite',28,NULL);
INSERT INTO clients values(32,'Vedette','LAROCQUE','Vedette.LAROCQUE@gmail.com','1984-01-20','18 rue du Président Roosevelt',29,47);
INSERT INTO clients values(33,'Scoville','CARIGNAN','Scovilledu92@gmail.com','2001-02-07','27 rue des Coudriers',30,NULL);
INSERT INTO clients values(34,'Raoul','CHENARD','RAOUL.CHENARD@gmail.com','1957-11-08','29 rue des Dunes',31,NULL);
INSERT INTO clients values(35,'Warrane','LABELLE','Warrane.LABELLE@gmail.com','1996-07-21','53 rue du Président Roosevelt',32,NULL);
INSERT INTO clients values(36,'Alphonsine','DESILETS','Alphonsine.DESILETS@hotmail.com','1992-05-29','81 Avenue des Prés',33,NULL);
INSERT INTO clients values(37,'Anouk','LACROIX','Anouk.LACROIX@gmail.com','1969-11-10','42 rue des Dunes',34,NULL);
INSERT INTO clients values(38,'Bernadette','BAZINET','Bernadette.BAZINET@hotmail.com','1976-07-10','95 avenue de Bouvines',35,NULL);
INSERT INTO clients values(39,'Grégoire','LEVESQUE','Gregoire.LEVESQUE@orange.fr','1959-10-08','50 rue Gustave Eiffel',11,51);
INSERT INTO clients values(40,'Alphonse','SOUPLET','al.souplet@gmail.com','1979-04-05','54 rue de Geneve',36,NULL);
INSERT INTO clients values(41,'Edouard','SOUPLET','ed.souplet@gmail.com','1997-06-09','46 Square de la Couronne',7,11);
INSERT INTO clients values(42,'Archaimbau','GARCIA','Archaimbau.GARCIA@gmail.com','1963-11-22','7 Cours Marechal-Joffre',37,NULL);
INSERT INTO clients values(43,'Xavier','LATOURELLE','Xavier.LATOURELLE@caramail.com','1962-12-01','86 rue de la République',38,14);
INSERT INTO clients values(44,'Félicienne','PINNEAU','feli.pinneau@hotmail.com','1992-12-23','24 rue Saint Germain',39,NULL);
INSERT INTO clients values(45,'Mercer','HARQUIN','Mercer.HARQUIN@gmail.com','1971-11-25','44 rue Sadi Carnot',40,NULL);
INSERT INTO clients values(46,'Cloridan','LAVALLEE','Cloridan.LAVALLEE@gmail.com','1955-01-20','76 rue Léon Dierx',41,3);
INSERT INTO clients values(47,'Artus','BOUCHARD','Artus.BOUCHARD@gmail.com','1968-03-15','78 Rue Hubert de Lisle',42,NULL);
INSERT INTO clients values(48,'Mathilda','MIREAULT','Mathilda687@gmail.com','1957-11-22',"62 boulevard d'Alsace",43,NULL);
INSERT INTO clients values(49,'Amitee','BERNIER','Amitee.bernier@gmail.com','1960-06-27','59 rue Victor Hugo',44,NULL);
INSERT INTO clients values(50,'Antoinette','ROCHEFORT','rochefort.antoinette@hotmail.com','1969-02-14','18 rue Gustave Eiffel',45,NULL);
INSERT INTO clients values(51,'Roger','LEREAU','Rogerlebeaugosse@laposte.fr','1961-08-04','89 boulevard de Prague',28,38);
INSERT INTO clients values(52,'Yves','FOURNIER','Yvyv@laposte.fr','1963-02-04','20 rue de la Boétie',28,45);
INSERT INTO clients values(53,'Georges','PIROUET','Gallia.BUSSON@gmail.com','1974-02-15',"55 rue de l'Aigle",26,NULL);
INSERT INTO clients values(54,'Lotye','RUEST','lotye.ruru@gmail.com','1998-03-07','27 rue Cazade',24,NULL);
INSERT INTO clients values(55,'Logistilla','BELLEMARE','logi.bellemare@gmail.com','1993-11-18','98 rue des Dunes',34,NULL);
INSERT INTO clients values(56,'Mercer','TREMBLAY','tremblay.mercer@gmail.com','1989-07-16','35 rue du Gue Jacquet',13,NULL);
INSERT INTO clients values(57,'Sibyla','PARÉ','sisi.pare@gmail.com','1969-09-14','13 rue Pierre Motte',3,NULL);
INSERT INTO clients values(58,'Cheney','CARTIER','cheney.cartier@caramail.com','1982-11-5','23 rue de la République',43,14);
INSERT INTO clients values(59,'Elita','COTE','elitounette@hotmail.com','1996-10-11','2 rue Descartes',16,NULL);
INSERT INTO clients values(60,'Aurore','BOURDETTE','aurore.labourde@wanadoo.fr','1978-09-09','17 Rue St Ferréol',4,NULL);