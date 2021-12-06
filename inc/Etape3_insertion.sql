/************************/
/* INSERTION DE DONNÉES */
/************************/

-- tes insertions ici alberto

/****************************/
/* REQUÊTES DE PIER-OLIVIER */
/****************************/



/**********************/
/* REQUÊTES D'ALBERTO */
/**********************/



/**********************/
/* REQUÊTES D'ÉTIENNE */
/**********************/
SELECT * FROM Config WHERE id = 1

SELECT idStockage FROM JointureConfigStockage WHERE idConfig = 1

INSERT INTO Config (idClient, idCarteMere, idProcesseur, idCooler, idMemoireVive, idCarteGraphique, idBoitier, dateCreation)
VALUES (1, 1, 1, 1, 1, 1, 1, '2021-12-07')

INSERT INTO JointureConfigStockage (idConfig, idStockage)
VALUES (1, 1)
    
DELETE FROM Config WHERE id = 1

DELETE FROM JointureConfigStockage
WHERE idConfig = 1
    
SELECT con.id, CONCAT(cli.prenom, ' ', cli.nom) AS utilisateur
FROM Config con
INNER JOIN Client cli ON cli.id = con.idClient
INNER JOIN CarteGraphique cg ON cg.id = con.idCarteGraphique
WHERE cg.idFabricant = (SELECT DISTINCT fab.id FROM Fabricant fab WHERE fab.nom = 'AMD')
ORDER BY dateCreation DESC
GO

CREATE VIEW V_ConfigurationsDate AS
	SELECT c.id, c.idClient, c.dateCreation
	FROM Config c
GO

UPDATE Fabricant 
SET nom = 'Advanced Micro Devices'
WHERE nom = 'AMD'

UPDATE Client
SET motDePasse = 'abc123'
WHERE courriel = 'alboviedo@hotmail.com'

GO
CREATE FUNCTION F_ConfigurationClient(@idClient INT)
RETURNS TABLE
AS
	RETURN (SELECT c.id, c.dateCreation
			FROM Config c
			WHERE c.idClient = @idClient)
GO