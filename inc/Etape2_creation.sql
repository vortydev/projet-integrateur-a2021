SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE ConfigurationSupreme;
USE ConfigurationSupreme;

/***********************/
/* Création des tables */
/***********************/

CREATE TABLE Client (
	id INT NOT NULL AUTO_INCREMENT,
	prenom VARCHAR(20) NOT NULL,
	nom VARCHAR(50) NOT NULL,
	courriel VARCHAR(50) NOT NULL,
	motDePasse VARCHAR(20) NOT NULL,
	dateNaissance DATE NOT NULL,
	adresse VARCHAR(50),
	CONSTRAINT PK_Client PRIMARY KEY (id) 
);

CREATE TABLE Config (
	id INT NOT NULL AUTO_INCREMENT,
	idClient INT NOT NULL,
	idCarteMere INT NOT NULL,
	idProcesseur INT NOT NULL,
	idCooler INT NOT NULL,
	idMemoireVive INT NOT NULL,
	idCarteGraphique INT NOT NULL,
	idBoitier INT NOT NULL,
	dateCreation DATE NOT NULL,
	CONSTRAINT PK_Config PRIMARY KEY (id)
);

CREATE TABLE CarteMere (
	id INT NOT NULL AUTO_INCREMENT,
	idFabricant INT NOT NULL,
	modele VARCHAR(40) NOT NULL,
	idForme INT NOT NULL,
	idSocket INT NOT NULL,
	chipset VARCHAR(40),
	capaciteRam INT NOT NULL,
	typeMemoire INT NOT NULL, 
	nbConnecteurRam INT NOT NULL,
	wifi VARCHAR(40),
	idSupportUSB INT NOT NULL,
	CONSTRAINT PK_CarteMere PRIMARY KEY (id)
);

CREATE TABLE Processeur (
	id INT NOT NULL AUTO_INCREMENT,
	idFabricant INT NOT NULL,
	modele VARCHAR(40) NOT NULL,
	nbCoeurs INT NOT NULL,
	frequence INT NOT NULL,
	idSocket INT NOT NULL,
	CONSTRAINT PK_Processeur PRIMARY KEY (id)
);

CREATE TABLE SystemeRefroidissement (
	id INT NOT NULL AUTO_INCREMENT,
	idFabricant INT NOT NULL,
	modele VARCHAR(40) NOT NULL,
	dimension VARCHAR(20) NOT NULL,
	CONSTRAINT PK_SystemeRefroidissement PRIMARY KEY (id)
);

CREATE TABLE MemoireVive (
	id INT NOT NULL AUTO_INCREMENT,
	idFabricant INT NOT NULL,
	modele VARCHAR(40) NOT NULL,
	capacite INT NOT NULL,
	nbBarrettes INT NOT NULL, 
	frequence INT NOT NULL,
	idConnecteur INT NOT NULL,
	typeMemoire INT NOT NULL,
	CONSTRAINT PK_MemoireVive PRIMARY KEY (id)
);

CREATE TABLE SupportStockage (
	id INT NOT NULL AUTO_INCREMENT,
	idFabricant INT NOT NULL,
	modele VARCHAR(40) NOT NULL,
	typeStockage VARCHAR(10) NOT NULL,
	capacite INT NOT NULL,
	rpm INT,
	idConnecteur INT NOT NULL,
	tauxTransfert INT NOT NULL,
	CONSTRAINT PK_SupportStockage PRIMARY KEY (id)
);

CREATE TABLE CarteGraphique (
	id INT NOT NULL AUTO_INCREMENT,
	idFabricant INT NOT NULL,
	modele VARCHAR(40) NOT NULL,
	chipset VARCHAR(40) NOT NULL,
	capacite INT NOT NULL,
	typeMemoire INT NOT NULL,
	frequence INT NOT NULL,
	frameSync VARCHAR(20),
	idConnecteur INT NOT NULL,
	CONSTRAINT PK_CarteGraphique PRIMARY KEY(id)
);

CREATE TABLE Boitier (
	id INT NOT NULL AUTO_INCREMENT,
	idFabricant INT NOT NULL,
	modele VARCHAR(40) NOT NULL,
	typeBoitier INT NOT NULL,
	typeFenetre VARCHAR(40),
	psuShroud BIT,
	psuInclus BIT,
	idSupportUSB INT NOT NULL,
	idFormeCarteMere INT NOT NULL,
	CONSTRAINT PK_Boitier PRIMARY KEY (id)
);

CREATE TABLE Connecteur (
	id INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_Connecteur PRIMARY KEY (id)
);

CREATE TABLE Socket (
	id INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_Socket PRIMARY KEY (id)
);

CREATE TABLE Fabricant (
	id INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_Fabricant PRIMARY KEY (id)
);

CREATE TABLE FormeCarteMere (
	id INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_FormeCarteMere PRIMARY KEY (id)
);

CREATE TABLE TypeBoitier (
	id INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_TypeBoitier PRIMARY KEY (id)
);

CREATE TABLE TypeMemoire (
	id INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_TypeMemoire PRIMARY KEY (id)
);

CREATE TABLE SupportUSB (
	id INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(80) NOT NULL,
	CONSTRAINT PK_SupportUSB PRIMARY KEY (id)
);

CREATE TABLE JointureConfigStockage (
	id INT NOT NULL AUTO_INCREMENT,
	idConfig INT NOT NULL,
	idStockage INT NOT NULL,
	CONSTRAINT PK_JointureConfigStockage PRIMARY KEY (id)
);

CREATE TABLE JointureCarteMereConnecteur (
	id INT NOT NULL AUTO_INCREMENT,
	idCarteMere INT NOT NULL,
	idConnecteur INT NOT NULL,
	CONSTRAINT PK_JointureCarteMereConnecteur PRIMARY KEY (id)
);

CREATE TABLE JointureSocketCooler (
	id INT NOT NULL AUTO_INCREMENT,
	idSocket INT NOT NULL,
	idCooler INT NOT NULL,
	CONSTRAINT PK_JointureSocketCooler PRIMARY KEY (id)
);

/********************/
/* Clées Étrangères */
/********************/

/* Configuration */
ALTER TABLE Config
ADD CONSTRAINT FK_ConfigClient FOREIGN KEY (idClient) REFERENCES Client (id);

ALTER TABLE Config
ADD CONSTRAINT FK_ConfigCarteMere FOREIGN KEY (idCarteMere) REFERENCES CarteMere (id);

ALTER TABLE Config
ADD CONSTRAINT FK_ConfigProcesseur FOREIGN KEY (idProcesseur) REFERENCES Processeur (id);

ALTER TABLE Config
ADD CONSTRAINT FK_ConfigCooler FOREIGN KEY (idCooler) REFERENCES SystemeRefroidissement (id);

ALTER TABLE Config
ADD CONSTRAINT FK_ConfigMemoireVive FOREIGN KEY (idMemoireVive) REFERENCES MemoireVive (id);

ALTER TABLE Config
ADD CONSTRAINT FK_ConfigCarteGraphique FOREIGN KEY (idCarteGraphique) REFERENCES CarteGraphique (id);

ALTER TABLE Config	
ADD CONSTRAINT FK_ConfigBoitier FOREIGN KEY (idBoitier) REFERENCES Boitier (id);

/* Carte m�re */
ALTER TABLE CarteMere
ADD CONSTRAINT FK_CarteMereFabricant FOREIGN KEY (idFabricant) REFERENCES Fabricant (id);

ALTER TABLE CarteMere 
ADD CONSTRAINT FK_CarteMereForme FOREIGN KEY (idForme) REFERENCES FormeCarteMere (id);

ALTER TABLE CarteMere
ADD CONSTRAINT FK_CarteMereSocket FOREIGN KEY (idSocket) REFERENCES Socket (id);

ALTER TABLE CarteMere
ADD CONSTRAINT FK_CarteMereTypeMemoire FOREIGN KEY (typeMemoire) REFERENCES TypeMemoire (id);

ALTER TABLE CarteMere
ADD CONSTRAINT FK_CarteMereSupportUSB FOREIGN KEY (idSupportUSB) REFERENCES SupportUSB (id);

/* Processeur */
ALTER TABLE Processeur
ADD CONSTRAINT FK_ProcesseurFabricant FOREIGN KEY (idFabricant) REFERENCES Fabricant (id);

ALTER TABLE Processeur
ADD CONSTRAINT FK_ProcesseurSocket FOREIGN KEY (idSocket) REFERENCES Socket (id);

/* Système de refroidissement (Cooler) */
ALTER TABLE SystemeRefroidissement
ADD CONSTRAINT FK_CoolerFabricant FOREIGN KEY (idFabricant) REFERENCES Fabricant (id);

/* Mémoire vive */
ALTER TABLE MemoireVive
ADD CONSTRAINT FK_MemoireViveFabricant FOREIGN KEY (idFabricant) REFERENCES Fabricant (id);

ALTER TABLE MemoireVive 
ADD CONSTRAINT FK_MemoireViveConnecteur FOREIGN KEY (idConnecteur) REFERENCES Connecteur (id);

ALTER TABLE MemoireVive 
ADD CONSTRAINT FK_MemoireViveTypeMemoire FOREIGN KEY (typeMemoire) REFERENCES TypeMemoire (id);

/* Support de stockage */
ALTER TABLE SupportStockage
ADD CONSTRAINT FK_SupportStockageFabricant FOREIGN KEY (idFabricant) REFERENCES Fabricant (id);

ALTER TABLE SupportStockage
ADD CONSTRAINT FK_SupportStockageConnecteur FOREIGN KEY (idConnecteur) REFERENCES Connecteur (id);

/* Carte graphique */
ALTER TABLE CarteGraphique
ADD CONSTRAINT FK_CarteGraphiqueFabricant FOREIGN KEY (idFabricant) REFERENCES Fabricant (id);

ALTER TABLE CarteGraphique
ADD CONSTRAINT FK_CarteGraphiqueConnecteur FOREIGN KEY (idConnecteur) REFERENCES Connecteur (id);

ALTER TABLE CarteGraphique
ADD CONSTRAINT FK_CarteGraphiqueTypeMemoire FOREIGN KEY (typeMemoire) REFERENCES TypeMemoire (id);

/* Boitier */
ALTER TABLE Boitier
ADD CONSTRAINT FK_BoitierFabricant FOREIGN KEY (idFabricant) REFERENCES Fabricant (id);

ALTER TABLE Boitier
ADD CONSTRAINT FK_BoitierTypeBoitier FOREIGN KEY (typeBoitier) REFERENCES TypeBoitier (id);

ALTER TABLE Boitier
ADD CONSTRAINT FK_BoitierSupportUSB FOREIGN KEY (idSupportUSB) REFERENCES SupportUSB (id);

ALTER TABLE Boitier
ADD CONSTRAINT FK_BoitierFormeCarteMere FOREIGN KEY (idFormeCarteMere) REFERENCES FormeCarteMere (id);

/* Jointure Config/Stockage */
ALTER TABLE JointureConfigStockage
ADD CONSTRAINT FK_JointureConfigStockage FOREIGN KEY (idConfig) REFERENCES Config (id);

ALTER TABLE JointureConfigStockage
ADD CONSTRAINT FK_JointureStockageConfig FOREIGN KEY (idStockage) REFERENCES SupportStockage (id);

/* Jointure CarteMere/Connecteur */
ALTER TABLE JointureCarteMereConnecteur
ADD CONSTRAINT FK_JointureCarteMereConnecteur FOREIGN KEY (idCarteMere) REFERENCES CarteMere (id);

ALTER TABLE JointureCarteMereConnecteur
ADD CONSTRAINT FK_JointureConnecteurCarteMere FOREIGN KEY (idConnecteur) REFERENCES Connecteur (id);

/* Jointure Socket/Cooler */
ALTER TABLE  JointureSocketCooler
ADD CONSTRAINT FK_JointureSocketCooler FOREIGN KEY (idSocket) REFERENCES Socket (id);

ALTER TABLE  JointureSocketCooler
ADD CONSTRAINT FK_JointureCoolerSocket FOREIGN KEY (idCooler) REFERENCES SystemeRefroidissement (id);
