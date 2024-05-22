-- Supprimer la base de données si elle existe déjà
DROP DATABASE IF EXISTS gate_data;

-- Créer une nouvelle base de données
CREATE DATABASE gate_data;

-- Utiliser la base de données nouvellement créée
USE gate_data;

-- Supprimer les tables si elles existent déjà

CREATE TABLE Utilisateur(
        IDUser Int  Auto_increment  NOT NULL ,
        Email  Varchar (50) NOT NULL ,
        MDP    Varchar (50) NOT NULL ,
        Nom    Varchar (50) NOT NULL ,
        Prenom Varchar (50) NOT NULL ,
        roles  Varchar (50) NOT NULL
    ,CONSTRAINT Utilisateur_PK PRIMARY KEY (IDUser)
)ENGINE=InnoDB;

-- Insertion des utilisateurs
INSERT INTO Utilisateur (Email, MDP, Nom, Prenom, roles) VALUES
('alice@example.com', 'password123', 'Alice', 'Smith', 'Admin'),
('bob@example.com', 'password456', 'Bob', 'Brown', 'User'),
('charlie@example.com', 'password789', 'Charlie', 'Davis', 'User');

CREATE TABLE Projet(
        IDProjet          Int  Auto_increment  NOT NULL ,
        nomProjet         Varchar (50) NOT NULL ,
        Duree_projet      Varchar (50) NOT NULL ,
        descriptionProjet Varchar (50) NOT NULL ,
        tachesprojets     Varchar (50) NOT NULL ,
        Statu             Varchar (50) NOT NULL ,
        budjet            Int NOT NULL
    ,CONSTRAINT Projet_PK PRIMARY KEY (IDProjet)
)ENGINE=InnoDB;

-- Insertion des projets
INSERT INTO Projet (nomProjet, Duree_projet, descriptionProjet, tachesprojets, Statu, budjet) VALUES
('Projet Alpha', '6 mois', 'Développement de la plateforme Alpha', 'Tâche 1, Tâche 2', 'En cours', 10000),
('Projet Beta', '3 mois', 'Mise à jour de la plateforme Beta', 'Tâche 3, Tâche 4', 'Terminé', 5000);

CREATE TABLE membreequipe(
        IDUser   Int NOT NULL ,
        roles    Varchar (50) NOT NULL ,
        IDequipe Int NOT NULL
    ,CONSTRAINT membreequipe_AK UNIQUE (IDequipe)
    ,CONSTRAINT membreequipe_PK PRIMARY KEY (IDUser)
)ENGINE=InnoDB;

-- Insertion des membres de l'équipe
INSERT INTO membreequipe (IDUser, roles, IDequipe) VALUES
(1, 'Développeur', 1),
(2, 'Designer', 2),
(3, 'Chef de projet', 3);

CREATE TABLE equipe(
        Idequipe Int  Auto_increment  NOT NULL ,
        roles    Varchar (50) NOT NULL ,
        IDUser   Int NOT NULL
    ,CONSTRAINT equipe_PK PRIMARY KEY (Idequipe)

    ,CONSTRAINT equipe_membreequipe_FK FOREIGN KEY (IDUser) REFERENCES membreequipe(IDUser)
)ENGINE=InnoDB;

-- Insertion des équipes
INSERT INTO equipe (roles, IDUser) VALUES
('Développeur', 1),
('Designer', 2),
('Chef de projet', 3);

CREATE TABLE Notification(
        IDnotif   Int  Auto_increment  NOT NULL ,
        Message   Varchar (50) NOT NULL ,
        datenotif Date NOT NULL ,
        typenotif Varchar (50) NOT NULL ,
        IDUser    Int NOT NULL
    ,CONSTRAINT Notification_AK UNIQUE (IDUser)
    ,CONSTRAINT Notification_PK PRIMARY KEY (IDnotif)
)ENGINE=InnoDB;

-- Insertion des notifications
INSERT INTO Notification (Message, datenotif, typenotif, IDUser) VALUES
('Nouvelle tâche assignée', '2024-05-01', 'Tâche', 1),
('Commentaire ajouté', '2024-05-02', 'Commentaire', 2);

CREATE TABLE Tache(
        IDTache        Int  Auto_increment  NOT NULL ,
        Titre          Varchar (50) NOT NULL ,
        description    Varchar (50) NOT NULL ,
        datedebut      Varchar (50) NOT NULL ,
        datefin        Varchar (50) NOT NULL ,
        IDUser         Int NOT NULL ,
        IDProjet       Int NOT NULL ,
        IDProjet_avoir Int NOT NULL
    ,CONSTRAINT Tache_AK UNIQUE (IDUser,IDProjet)
    ,CONSTRAINT Tache_PK PRIMARY KEY (IDTache)

    ,CONSTRAINT Tache_Projet_FK FOREIGN KEY (IDProjet_avoir) REFERENCES Projet(IDProjet)
)ENGINE=InnoDB;

-- Insertion des tâches
INSERT INTO Tache (Titre, description, datedebut, datefin, IDUser, IDProjet, IDProjet_avoir) VALUES
('Tâche 1', 'Développer la fonctionnalité de login', '2024-04-01', '2024-04-10', 1, 1, 1),
('Tâche 2', 'Créer la page d accueil', '2024-04-11', '2024-04-20', 2, 1, 1),
('Tâche 3', 'Mettre à jour le backend', '2024-03-01', '2024-03-15', 3, 2, 2),
('Tâche 4', 'Redesign du frontend', '2024-03-16', '2024-03-30', 1, 2, 2);

CREATE TABLE Dossier(
        IDDocumment         Int  Auto_increment  NOT NULL ,
        Nom                 Varchar (50) NOT NULL ,
        url                 Varchar (50) NOT NULL ,
        dateup              Varchar (50) NOT NULL ,
        IDUser              Int NOT NULL ,
        idProjet            Int NOT NULL ,
        IDProjet__contenir1 Int NOT NULL
    ,CONSTRAINT Dossier_AK UNIQUE (IDUser,idProjet)
    ,CONSTRAINT Dossier_PK PRIMARY KEY (IDDocumment)

    ,CONSTRAINT Dossier_Projet_FK FOREIGN KEY (IDProjet__contenir1) REFERENCES Projet(IDProjet)
)ENGINE=InnoDB;

-- Insertion des documents
INSERT INTO Dossier (Nom, url, dateup, IDUser, idProjet, IDProjet__contenir1) VALUES
('Spécifications techniques', 'http://example.com/specs.pdf', '2024-04-01', 1, 1, 1),
('Maquettes UI', 'http://example.com/ui-mockups.pdf', '2024-04-05', 2, 1, 1);

CREATE TABLE commentaire(
        IDcommentaire     Int  Auto_increment  NOT NULL ,
        contenu           Varchar (50) NOT NULL ,
        datecrea          Date NOT NULL ,
        IDTache           Int NOT NULL ,
        IDUser            Int NOT NULL ,
        IDTache_contenir2 Int NOT NULL
    ,CONSTRAINT commentaire_AK UNIQUE (IDTache,IDUser)
    ,CONSTRAINT commentaire_PK PRIMARY KEY (IDcommentaire)

    ,CONSTRAINT commentaire_Tache_FK FOREIGN KEY (IDTache_contenir2) REFERENCES Tache(IDTache)
)ENGINE=InnoDB;

-- Insertion des commentaires
INSERT INTO commentaire (contenu, datecrea, IDTache, IDUser, IDTache_contenir2) VALUES
('Bon début de travail, continuez comme ça !', '2024-04-02', 1, 3, 1),
('Vérifiez les détails de la maquette.', '2024-04-06', 2, 2, 2);

CREATE TABLE modifier(
        Idequipe Int NOT NULL ,
        IDProjet Int NOT NULL
    ,CONSTRAINT modifier_PK PRIMARY KEY (Idequipe,IDProjet)

    ,CONSTRAINT modifier_equipe_FK FOREIGN KEY (Idequipe) REFERENCES equipe(Idequipe)
    ,CONSTRAINT modifier_Projet0_FK FOREIGN KEY (IDProjet) REFERENCES Projet(IDProjet)
)ENGINE=InnoDB;

-- Insertion des relations modifier (équipes et projets)
INSERT INTO modifier (Idequipe, IDProjet) VALUES
(1, 1),
(2, 2);

CREATE TABLE Notifier(
        IDnotif  Int NOT NULL ,
        IDProjet Int NOT NULL
    ,CONSTRAINT Notifier_PK PRIMARY KEY (IDnotif,IDProjet)

    ,CONSTRAINT Notifier_Notification_FK FOREIGN KEY (IDnotif) REFERENCES Notification(IDnotif)
    ,CONSTRAINT Notifier_Projet0_FK FOREIGN KEY (IDProjet) REFERENCES Projet(IDProjet)
)ENGINE=InnoDB;

-- Insertion des relations notifier (notifications et projets)
INSERT INTO Notifier (IDnotif, IDProjet) VALUES
(1, 1),
(2, 2);

CREATE TABLE creer(
        IDProjet Int NOT NULL ,
        IDUser   Int NOT NULL
    ,CONSTRAINT creer_PK PRIMARY KEY (IDProjet,IDUser)

    ,CONSTRAINT creer_Projet_FK FOREIGN KEY (IDProjet) REFERENCES Projet(IDProjet)
    ,CONSTRAINT creer_Utilisateur0_FK FOREIGN KEY (IDUser) REFERENCES Utilisateur(IDUser)
)ENGINE=InnoDB;

-- Insertion des relations créer (utilisateurs et projets)
INSERT INTO creer (IDProjet, IDUser) VALUES
(1, 3),
(2, 1);

CREATE TABLE faire(
        IDTache Int NOT NULL ,
        IDUser  Int NOT NULL
    ,CONSTRAINT faire_PK PRIMARY KEY (IDTache,IDUser)

    ,CONSTRAINT faire_Tache_FK FOREIGN KEY (IDTache) REFERENCES Tache(IDTache)
    ,CONSTRAINT faire_membreequipe0_FK FOREIGN KEY (IDUser) REFERENCES membreequipe(IDUser)
)ENGINE=InnoDB;

-- Insertion des relations faire (tâches et membres de l'équipe)
INSERT INTO faire (IDTache, IDUser) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 1);
