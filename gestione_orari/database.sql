create table prof(
    id integer PRIMARY KEY,
    email varchar(255) NOT NULL,
    pass varchar(255) NOT NULL,
    ruolo boolean,
    nome varchar(255),
    cognome varchar(255),
    oreSup integer
);

create table materia(
    nome varchar(255) PRIMARY KEY
);

create table classe(
    nome varchar(255) PRIMARY KEY
);

create table ora(
    id integer PRIMARY KEY,
    luogo varchar(255),
    durata integer,
    giorno integer,
    ora integer,
    idMateria varchar(255),
    idClasse varchar(255),
    FOREIGN KEY (idMateria) REFERENCES materia (nome),
    FOREIGN KEY (idClasse) REFERENCES classe (nome)
);

create table assenza(
    id integer PRIMARY KEY,
    motivo varchar(255),
    idProf integer,
    idOra integer,
    anno integer,
    settimana integer,
    FOREIGN KEY (idProf) REFERENCES prof(id),
    FOREIGN KEY (idOra) REFERENCES ora(id)
);
create table assenzaClasse(
    id integer PRIMARY KEY,
    motivo varchar(255),
    idClasse varchar(255),
    idOra integer,
    anno integer,
    settimana integer,
    FOREIGN KEY (idClasse) REFERENCES classe(nome),
    FOREIGN KEY (idOra) REFERENCES ora(id)
);

create table supplenza(
    id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
    idProf integer,
    idAssenza integer UNIQUE,
    FOREIGN KEY (idProf) REFERENCES prof (id),
    FOREIGN KEY (idAssenza) REFERENCES assenza (id)
);

create table profInsegnaClasse(
    idProf integer,
    idClasse varchar(255),
    FOREIGN KEY (idProf) REFERENCES prof(id),
    FOREIGN KEY (idClasse) REFERENCES classe(nome),
    PRIMARY KEY(idProf, idClasse)
);

create table profHaOra(
    idProf integer,
    idOra integer,
    FOREIGN KEY (idProf) REFERENCES prof(id),
    FOREIGN KEY (idOra) REFERENCES ora(id),
    PRIMARY KEY(idProf, idOra)
);

create table profHaMateria(
    idProf integer,
    idMateria varchar(255),
    FOREIGN KEY (idProf) REFERENCES prof(id),
    FOREIGN KEY (idMateria) REFERENCES materia(nome),
    PRIMARY KEY (idProf, idMateria)
);

create table possibiliProf(
    idProf integer,
    idAssenza integer,
    FOREIGN KEY (idProf) REFERENCES prof (id),
    FOREIGN KEY (idAssenza) REFERENCES assenza (id)
)