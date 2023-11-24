-- TABLE CREATION

CREATE TABLE question (
    id varchar(512) PRIMARY KEY,
    category_id varchar(512),
    point_category_id varchar(512),
    question varchar(512),
    r_answer_id varchar(512)
);

CREATE TABLE category (
    id varchar(512) PRIMARY KEY,
    name varchar(512)
);

CREATE TABLE point_category (
    id varchar(512) PRIMARY KEY,
    point_value integer
);

CREATE TABLE answer (
    id varchar(512) PRIMARY KEY,
    answer_text varchar(512)
);

CREATE TABLE account (
    id SERIAL PRIMARY KEY,
    username varchar(512) UNIQUE,
    pw_hash varchar(512),
    profile_pict varchar(512),
    points int,
    games int,
    wins int
);

-- DB SEED

INSERT INTO account(id, username, pw_hash, profile_pict, points, games, wins) VALUES
    ('1', 'Admi Nistnánor', 'DjkDjucujijoWD', 'pict', 75, 10, 4);

INSERT INTO category (id, name) VALUES
    ('1', 'Domácí'),
    ('2', 'Zahraniční'),
    ('3', 'PEF'),
    ('4', 'FAPPZ'),
    ('5', 'Pivo');

INSERT INTO point_category (id, point_value) VALUES
    ('1', 10),
    ('2', 20),
    ('3', 30),
    ('4', 40),
    ('5', 50);

INSERT INTO answer (id, answer_text) VALUES
    ('1', 'Suchdol'),
    ('2', 'Vltava'),
    ('3', '1309000'),
    ('4', 'Sněžka'),
    ('5', 'Nedostatek financí'),
    ('6', 'Francie'),
    ('7', 'Slovensko'),
    ('8', '1408000000'),
    ('9', 'Říjen'),
    ('10', 'Mnichov'),
    ('11', 'Přízemí'),
    ('12', '10000'),
    ('13', 'Katedra Informačních Technologií'),
    ('14', '12'),
    ('15', 'Agrarian Perspectives'),
    ('16', 'Josef Soukup'),
    ('17', '300'),
    ('18', 'Agronomická fakulta'),
    ('19', '2005'),
    ('20', '16'),
    ('21', 'Chmel, slad, voda'),
    ('22', '142'),
    ('23', 'Jeník'),
    ('24', 'Pivní lahve'),
    ('25', 'Žatec');

INSERT INTO question 
(id, category_id, point_category_id, question, r_answer_id)
VALUES
    ('1', '1', '1','Kde je ČZU','1'),
    ('2', '1', '2','Co za řeku protéká Prahou','2'),
    ('3', '1', '3','Kolik obyvatel má Praha','3'),
    ('4', '1', '4','Jaká je nejvyšší hora České republiky ','4'),
    ('5', '1', '5','Proč akademici protestují','5'),
    ('6', '2', '1','Kde je Paříž','6'),
    ('7', '2', '2','S jakou zemí sousedí ČR','7'),
    ('8', '2', '3','Kolik obyvatel má Indie','8'),
    ('9', '2', '4','Kdy se koná OctoberFest','9'),
    ('10', '2', '5','Kde se koná OctoberFest','10'),
    ('11', '3', '1','V jakém patře hledat učebnu C10','11'),
    ('12', '3', '2','Kolik přihlášek přibližně PEF obdrží','12'),
    ('13', '3', '3','Co znamená KIT','13'),
    ('14', '3', '4','Kolik je na PEF kateder','14'),
    ('15', '3', '5','Jaká  odborná konference je pořádána na půdě PEF','15'),
    ('16', '4', '1','Kdo je děkan FAPPZ','16'),
    ('17', '4', '2','Kolik má FAPPZ zaměstnanců','17'),
    ('18', '4', '3','Jak se jmenovala FAPPZ v roce 1952','18'),
    ('19', '4', '4','Kdy se FAPPZ přejmenovala na FAPPZ','19'),
    ('20', '4', '5','Kolik je na FAPPZ kateder','20'),
    ('21', '5', '1','Co je potřeba k varu piva','21'),
    ('22', '5', '2','Kolik litrů piva vypije průměrný Čech ročně','22'),
    ('23', '5', '3','Jak se jmenuje pivo z ČZU','23'),
    ('24', '5', '4','Jaká část piva se dá použít jako stavební materiál','24'),
    ('25', '5', '5','Kde se koná slavná Dočesná','25');