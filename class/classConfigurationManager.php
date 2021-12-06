<?php
/* Fichier:     classConfigurationManager.php 
 * Auteur:      Étienne Ménard
 * Date:        06/12/2021
 */

require_once './inc/autoLoader.php';

class ConfigurationManager {
    // select une configuration par son id
    const SELECT_CONFIG_PAR_ID = 'SELECT * FROM Config WHERE id = :id';
    const SELECT_CONFIG_STOCKAGE = 'SELECT idStockage FROM JointureConfigStockage
                                    WHERE idConfig = :idConfig';

    // insert une nouvelle configuration
    const INSERT_CONFIG = 'INSERT INTO Config (idClient, idCarteMere, idProcesseur, idCooler, idMemoireVive, idCarteGraphique, idBoitier, dateCreation)
                            VALUES (:idClient, :idCarteMere, :idProcesseur, :idCooler, :idMemoireVive, :idCarteGraphique, :idBoitier, :dateCreation)';
    const INSERT_CONFIG_STOCKAGE = 'INSERT INTO JointureConfigStockage (idConfig, idStockage)
                                    VALUES (:idConfig, :idStockage)';
    
    // delete une configuration
    const DELETE_CONFIG = 'DELETE FROM Config WHERE id = :id';
    const DELETE_CONFIG_STOCKAGE = 'DELETE FROM JointureConfigStockage
                                    WHERE idConfig = :idConfig';
    
    // select les configurations d'un client (idClient)
    const SELECT_CLIENT_CONFIGS = 'SELECT id FROM Config WHERE idClient = :idClient';



    private $_bdd;
    public function __construct(PDO $bdd) { $this->_bdd = $bdd; }
    public function __destruct() { $this->_bdd = null; }

    public function getConfig(int $id) : Configuration {
        $query = $this->_bdd->prepare(self::SELECT_CONFIG_PAR_ID);
        $query->bindParam(':id', $id);
        $query->execute();
        $dbResult = $query->fetchAll();
        $configObj = new Configuration($dbResult);

        $query = $this->_bdd->prepare(self::SELECT_CONFIG_STOCKAGE);
        $query->bindParam(':idConfig', $id);
        $query->execute();
        $idStockageArr = $query->fetchAll();

        for ($i = 0; $i < sizeof($idStockageArr); $i++) {
            $configObj->add_idStockage($idStockageArr[$i]);
        }

        return $configObj;
    }

    public function addConfig(Configuration $configObj) {
        $query = $this->_bdd->prepare(self::INSERT_CONFIG);
        $dateCreation = date("Y-m-d");

        $bindParamArray = array(
            ':idClient' => $configObj->get_idClient(),
            ':idCarteMere' => $configObj->get_idCarteMere(),
            ':idProcesseur' => $configObj->get_idProcesseur(),
            ':idCooler' => $configObj->get_idCooler(),
            ':idMemoireVive' => $configObj->get_idMemoireVive(),
            ':idCarteGraphique' => $configObj->get_idCarteGraphique(),
            ':idBoitier' => $configObj->get_idBoitier(),
            ':dateCreation' => $dateCreation
        );

        assert($query->execute($bindParamArray), "L'insertion de la configuration a échouée.");
        
        $configId = $this->_bdd->lastInsertId();
        $stockageArr = $configObj->get_stockageArr();

        for ($i = 0; $i < sizeof($stockageArr); $i++) {
            $query = $this->_bdd->prepare(self::INSERT_CONFIG_STOCKAGE);

            $bindParamArray = array(
                ':idConfig' => $configId,
                ':idStockage' => $stockageArr[$i]
            );

            assert($query->execute($bindParamArray), "L'insertion du support de stockage a échouée.");
        }
    }

    public function deleteConfig(int $id) {
        $query = $this->_bdd->prepare(self::DELETE_CONFIG);
        $query->bindParam(':id', $id);
        $query->execute();

        $query = $this->_bdd->prepare(self::DELETE_CONFIG_STOCKAGE);
        $query->bindParam(':idConfig', $id);
        $query->execute();
    }

    // public function getClientConfigs(int $idClient) : array {
    //     $query = $this->_bdd->prepare(self::SELECT_CLIENT_CONFIGS);
    //     $query->bindParam(':idClient', $idClient);
    //     $query->execute();
    //     $dbResult = $query->fetchColumn();
    // }
};
?>