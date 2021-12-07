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
    const SELECT_CLIENT_CONFIGS = 'SELECT id FROM Config WHERE idClient = :idClient ORDER BY dateCreation DESC';

    const SELECT_CARTEMERE = 'SELECT CONCAT(f.nom, " ", c.modele) FROM cartemere c INNER JOIN fabricant f ON f.id = c.idFabricant WHERE c.id = :id';
    const SELECT_PROCESSEUR = 'SELECT CONCAT(f.nom, " ", p.modele) FROM processeur p INNER JOIN fabricant f ON f.id = p.idFabricant WHERE p.id = :id';
    const SELECT_COOLER = 'SELECT CONCAT(f.nom, " ", s.modele) FROM systemerefroidissement s INNER JOIN fabricant f ON f.id = s.idFabricant WHERE s.id = :id';
    const SELECT_MEMOIREVIVE = 'SELECT CONCAT(f.nom, " ", m.modele) FROM memoirevive m INNER JOIN fabricant f ON f.id = m.idFabricant WHERE m.id = :id';
    const SELECT_STOCKAGE = 'SELECT CONCAT(f.nom, " ", s.modele) FROM supportstockage s INNER JOIN fabricant f ON f.id = s.idFabricant WHERE s.id = :id';
    const SELECT_CARTEGRAPHIQUE = 'SELECT CONCAT(f.nom, " ", c.modele) FROM cartegraphique c INNER JOIN fabricant f ON f.id = c.idFabricant WHERE c.id = :id';
    const SELECT_BOITIER = 'SELECT CONCAT(f.nom, " ", b.modele) FROM boitier b INNER JOIN fabricant f ON f.id = b.idFabricant WHERE b.id = :id';

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

    public function getClientConfigs(int $idClient) : array {
        $query = $this->_bdd->prepare(self::SELECT_CLIENT_CONFIGS);
        $query->bindParam(':idClient', $idClient);
        $query->execute();
        $dbResult = $query->fetchColumn();

        $clientConfigArr = array();
        for ($i = 0; $i < sizeof($dbResult); $i++) {
            array_push($clientConfigArr, $this->getConfig($dbResult[$i]));
        }

        return $clientConfigArr;
    }

    public function printConfig(Configuration $configObj) {
        $stockageArrSize = sizeof($configObj->get_stockageArr());

        echo '<table class="config">
                <tr><td colspan=2 class="config_top"><h2>Configuration #' . $configObj->get_id() . '</h2></td></tr>
                <tr><td colspan=2 class="config_top"><h2><h3 class="config_date">'. $configObj->get_dateCreation() . '</h3></td></tr>
                <tr class="pale">
                    <td>Carte mère</td>
                    <td>'. $this->selectComposant($configObj->get_idCarteMere(), self::SELECT_CARTEMERE) .'</td>
                </tr>
                <tr>
                    <td>Processeur</td>
                    <td>'. $this->selectComposant($configObj->get_idProcesseur(), self::SELECT_PROCESSEUR) .'</td>
                </tr>
                <tr class="pale">
                    <td>Système de refroidissement</td>
                    <td>'. $this->selectComposant($configObj->get_idCooler(), self::SELECT_COOLER) .'</td>
                </tr>
                <tr>
                    <td>Mémoire vive</td>
                    <td>'. $this->selectComposant($configObj->get_idMemoireVive(), self::SELECT_MEMOIREVIVE) .'</td>
                </tr>
                <tr class="pale">
                    <td rowspan='.$stockageArrSize.'>Support de stockage</td>';
                    for ($i = 0; $i < $stockageArrSize; $i++) { 
                        if ($i > 0) echo '<tr class="pale">';
                        echo '<td>'. $this->selectComposant($configObj->get_stockageArr()[$i], self::SELECT_STOCKAGE). '</td>';
                        if ($i > 0) echo '</tr>';
                    }
                echo '</tr>
                <tr>
                    <td>Carte graphique</td>
                    <td>'. $this->selectComposant($configObj->get_idCarteGraphique(), self::SELECT_CARTEGRAPHIQUE) .'</td>
                </tr>
                <tr class="pale">
                    <td>Boitier</td>
                    <td>'. $this->selectComposant($configObj->get_idBoitier(), self::SELECT_BOITIER) .'</td>
                </tr>
            </table>';
    }

    private function selectComposant(int $id, string $sql) {
        $query = $this->_bdd->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchColumn();
    }
};
?>