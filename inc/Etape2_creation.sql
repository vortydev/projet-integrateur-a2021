USE msdb
DROP DATABASE IF EXISTS ConfigurationSupreme

CREATE DATABASE ConfigurationSupreme
GO

USE ConfigurationSupreme;

/***********************/
/* Création des tables */
/***********************/

CREATE TABLE Client(
	id INT IDENTITY(1,1) NOT NULL,
	prenom VARCHAR(20) NOT NULL,
	nom VARCHAR(50) NOT NULL,
	motDePasse VARCHAR(20) NOT NULL,
	dateNaissance DATE NOT NULL,
	adresse VARCHAR(50),
	CONSTRAINT PK_Client PRIMARY KEY (id) 
);

CREATE TABLE Config (
	id INT IDENTITY(1,1) NOT NULL,
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
	id INT IDENTITY(1,1) NOT NULL,
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
	id INT IDENTITY(1,1) NOT NULL,
	idFabricant INT NOT NULL,
	modele VARCHAR(40) NOT NULL,
	nbCoeurs INT NOT NULL,
	frequence INT NOT NULL,
	idSocket INT NOT NULL,
	CONSTRAINT PK_Processeur PRIMARY KEY (id)
);

CREATE TABLE SystemeRefroidissement (
	id INT IDENTITY(1,1) NOT NULL,
	idFabricant INT NOT NULL,
	modele VARCHAR(40) NOT NULL,
	dimension VARCHAR(20) NOT NULL,
	CONSTRAINT PK_SystemeRefroidissement PRIMARY KEY (id)
);

CREATE TABLE MemoireVive (
	id INT IDENTITY(1,1) NOT NULL,
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
	id INT IDENTITY(1,1) NOT NULL,
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
	id INT IDENTITY(1,1) NOT NULL,
	idFabricant INT NOT NULL,
	modele VARCHAR(40) NOT NULL,
	chipset VARCHAR(20) NOT NULL,
	capacite INT NOT NULL,
	typeMemoire INT NOT NULL,
	frequence INT NOT NULL,
	frameSync VARCHAR(20),
	idConnecteur INT NOT NULL,
	CONSTRAINT PK_CarteGraphique PRIMARY KEY(id)
);

CREATE TABLE Boitier (
	id INT IDENTITY(1,1) NOT NULL,
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
	id INT IDENTITY(1,1) NOT NULL,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_Connecteur PRIMARY KEY (id)
);

CREATE TABLE Socket (
	id INT IDENTITY(1,1) NOT NULL,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_Socket PRIMARY KEY (id)
);

CREATE TABLE Fabricant (
	id INT IDENTITY(1,1) NOT NULL,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_Fabricant PRIMARY KEY (id)
);

CREATE TABLE FormeCarteMere (
	id INT IDENTITY(1,1) NOT NULL,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_FormeCarteMere PRIMARY KEY (id)
);

CREATE TABLE TypeBoitier (
	id INT IDENTITY(1,1) NOT NULL,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_TypeBoitier PRIMARY KEY (id)
);

CREATE TABLE TypeMemoire (
	id INT IDENTITY(1,1) NOT NULL,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_TypeMemoire PRIMARY KEY (id)
);

CREATE TABLE SupportUSB (
	id INT IDENTITY(1,1) NOT NULL,
	nom VARCHAR(40) NOT NULL,
	CONSTRAINT PK_SupportUSB PRIMARY KEY (id)
);

CREATE TABLE JointureConfigStockage (
	idConfig INT NOT NULL,
	idStockage INT NOT NULL,
	CONSTRAINT PK_JointureConfigStockage PRIMARY KEY (idConfig, idStockage)
);

CREATE TABLE JointureCarteMereConnecteur (
	idCarteMere INT NOT NULL,
	idConnecteur INT NOT NULL,
	CONSTRAINT PK_JointureCarteMereConnecteur PRIMARY KEY (idCarteMere, idConnecteur)
);

CREATE TABLE JointureSocketCooler (
	idSocket INT NOT NULL,
	idCooler INT NOT NULL,
	CONSTRAINT PK_JointureSocketCooler PRIMARY KEY (idSocket, idCooler)
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
ADD CONSTRAINT FK_JointureConfigStockage1 FOREIGN KEY (idConfig) REFERENCES Config (id);

ALTER TABLE JointureConfigStockage
ADD CONSTRAINT FK_JointureConfigStockage2 FOREIGN KEY (idStockage) REFERENCES SupportStockage (id);

/* Jointure CarteMere/Connecteur */
ALTER TABLE JointureCarteMereConnecteur
ADD CONSTRAINT FK_JointureCarteMereConnecteur1 FOREIGN KEY (idCarteMere) REFERENCES CarteMere (id);

ALTER TABLE JointureCarteMereConnecteur
ADD CONSTRAINT FK_JointureCarteMereConnecteur2 FOREIGN KEY (idConnecteur) REFERENCES Connecteur (id);

/* Jointure Socket/Cooler */
ALTER TABLE  JointureSocketCooler
ADD CONSTRAINT FK_JointureSocketCooler1 FOREIGN KEY (idSocket) REFERENCES Socket (id);

ALTER TABLE  JointureSocketCooler
ADD CONSTRAINT FK_JointureSocketCooler2 FOREIGN KEY (idCooler) REFERENCES SystemeRefroidissement (id);
