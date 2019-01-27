DROP DATABASE IF EXISTS my_curie;
CREATE DATABASE IF NOT EXISTS my_curie DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
USE my_curie;

CREATE TABLE t_operatori (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Nome	 			     VARCHAR(50),
  Cognome			     VARCHAR(50),
  Codice  		     VARCHAR(20)	UNIQUE NOT NULL,
  Password         CHAR(64),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_tipologie (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Descrizione	 		 VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_cestini (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Foto	 			     VARCHAR(50),
  Valutazioni      BIGINT,
  FK_Tipologia     BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_Tipologia)    REFERENCES t_tipologie(ID)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE t_indirizzi (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Descrizione	 		 VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_classi (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Classe    	 		 VARCHAR(50),
  FK_Indirizzo 		 BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_Indirizzo)    REFERENCES t_indirizzi(ID)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE t_controlli (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Data      	 		 DATE,
  FK_Operatore 		 BIGINT,
  FK_Cestino 	  	 BIGINT,
  FK_Classe    		 BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_Operatore)    REFERENCES t_operatori(ID)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  FOREIGN KEY(FK_Cestino)    REFERENCES t_cestini(ID)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  FOREIGN KEY(FK_Classe)    REFERENCES t_classi(ID)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
) ENGINE = InnoDB;


CREATE TABLE t_controlloCestino (
  ID 		              BIGINT				NOT NULL 	AUTO_INCREMENT,
  FK_Controllo        BIGINT,
  FK_Cestino          BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_Controllo)    REFERENCES t_controlli(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY(FK_Cestino)    REFERENCES t_cestini(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;


INSERT INTO t_tipologie (Descrizione) VALUES ('Imballaggi');
INSERT INTO t_tipologie (Descrizione) VALUES ('Carta');
INSERT INTO t_tipologie (Descrizione) VALUES ('Secco residuo');

INSERT INTO t_indirizzi (Descrizione) VALUES ('Informatica');
INSERT INTO t_indirizzi (Descrizione) VALUES ('Tecnologico');
INSERT INTO t_indirizzi (Descrizione) VALUES ('CAT');
INSERT INTO t_indirizzi (Descrizione) VALUES ('Linguistico');
INSERT INTO t_indirizzi (Descrizione) VALUES ('Telecomunicazioni');
INSERT INTO t_indirizzi (Descrizione) VALUES ('Scientifico');
INSERT INTO t_indirizzi (Descrizione) VALUES ('Web Marketing');
INSERT INTO t_indirizzi (Descrizione) VALUES ('Scienze Umane Economico Sociale');
INSERT INTO t_indirizzi (Descrizione) VALUES ('Sistemi Informativi Aziendali');
INSERT INTO t_indirizzi (Descrizione) VALUES ('Amministazione Finanaza e Marketing');
INSERT INTO t_indirizzi (Descrizione) VALUES ('Ufficio Didattica');

/* THE FOLLOWING insert SHOULD BE EXECUTED ONLY IF t_indirizzi WERE EXECUTED IN THAT ORDER */

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3A', 1); /* ID 1 è informatica*/
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4A', 1);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5A', 1);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3B', 1);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4B', 1);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5B', 1);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('1A', 2); /* ID 2 è Tecnologico*/
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('2A', 2);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('1B', 2);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('2B', 2);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('1C', 2);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('2C', 2);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('1D', 2);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('2D', 2);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3A', 3); /* ID 3 è CAT*/
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4A', 3);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5A', 3);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3B', 3);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4B', 3);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5B', 3);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('1A', 4); /* ID 4 è Linguistico*/
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('2A', 4);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3A', 4);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4A', 4);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5A', 4);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('1B', 4);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('2B', 4);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3B', 4);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4B', 4);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5B', 4);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3A', 5); /* ID 5 è Telecomunicazioni*/
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4A', 5);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5A', 5);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3B', 5);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4B', 5);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5B', 5);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('1A', 6); /* ID 6 è Scientifico*/
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('2A', 6);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3A', 6);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4A', 6);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5A', 6);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('1B', 6);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('2B', 6);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3B', 6);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4B', 6);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5B', 6);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3A', 7); /* ID 7 è Web Marketing*/
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4A', 7);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5A', 7);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3B', 7);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4B', 7);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5B', 7);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('1A', 8); /* ID 8 è Scienze Umane Economico Sociale*/
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('2A', 8);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3A', 8);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4A', 8);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5A', 8);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('1B', 8);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('2B', 8);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3B', 8);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4B', 8);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5B', 8);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3A', 9); /* ID 9 è Sistemi Informativi Aziendali*/
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4A', 9);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5A', 9);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3B', 9);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4B', 9);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5B', 9);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3A', 10); /* ID 10 è Amministazione Finanza e Marketing*/
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4A', 10);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5A', 10);

INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('3B', 10);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('4B', 10);
INSERT INTO t_classi (Classe, FK_Indirizzo) VALUES ('5B', 10);
