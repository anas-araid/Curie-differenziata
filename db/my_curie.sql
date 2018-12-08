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
  Classe    	 		 BIGINT,
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
