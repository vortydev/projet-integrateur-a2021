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

    const SELECT_INFO_MEMOIREVIVE = 'SELECT CONCAT(f.nom, " ", m.modele) as modele , m.capacite, m.nbBarrettes, m.frequence, c.nom as nomConnecteur, t.nom as typeMemoire FROM memoirevive m
    INNER JOIN connecteur c ON c.id = m.idConnecteur
    INNER JOIN fabricant f ON f.id = m.idFabricant
    INNER JOIN typememoire t ON t.id = m.typeMemoire
    WHERE m.id = :id';
    
    const SELECT_INFO_BOITIER = 'SELECT CONCAT(f.nom, " ", b.modele) as modele, b.typeFenetre, t.nom AS typeBoitier, fcm.nom as formeCarteMere FROM boitier b
    INNER JOIN typeBoitier t ON t.id = b.typeBoitier
    INNER JOIN Fabricant f ON f.id = b.idFabricant
    INNER JOIN formeCarteMere fcm ON b.idFormeCarteMere = fcm.id
    WHERE b.id = :id;';

    const SELECT_INFO_GPU = 'SELECT CONCAT(f.nom, " ", c.modele) AS modele , t.nom as typeMemoire, c.chipset, c.frequence, c.capacite, c.frameSync FROM cartegraphique c
    INNER JOIN typeMemoire t ON t.id = c.typeMemoire
    INNER JOIN fabricant f ON f.id = c. idFabricant 
    WHERE c.id = :id';

    const SELECT_INFO_CARTEMERE = 'SELECT c.id ,CONCAT(f.nom, " ", c.modele) AS modele, c.idForme, fo.nom as nomForme , c.idSocket, s.nom as nomSocket, c.capaciteRam, c.typeMemoire, c.nbConnecteurRam FROM cartemere c 
    INNER JOIN fabricant f ON f.id = c.idFabricant 
    INNER JOIN formecartemere fo ON fo.id = c.idForme 
    INNER JOIN socket s ON s.id = c.idSocket 
    INNER JOIN typeMemoire t ON t.id = c.typeMemoire 
    WHERE c.id = :id';

    const SELECT_INFO_PROCESSEUR = 'SELECT CONCAT(f.nom, " ", p.modele) AS modele, p.nbCoeurs as nbCore, p.frequence, s.nom as nomSocket FROM processeur p 
    INNER JOIN fabricant f ON p.idFabricant = f.id 
    INNER JOIN socket s ON p.idSocket = s.id 
    WHERE p.id = :id';

    const SELECT_INFO_COOLER = 'SELECT CONCAT(f.nom, " ", s.modele) AS modele, s.dimension FROM systemerefroidissement s
    INNER JOIN Fabricant f ON f.id = s.idFabricant
    WHERE s.id = :id';

    const SELECT_INFO_SUPPORTSTOCKAGE = 'SELECT CONCAT(f.nom, " ", s.modele) AS modele, s.typeStockage, s.capacite,  s.rpm, c.nom as nomConnecteur, s.tauxTransfert  
    FROM supportstockage s
    INNER JOIN fabricant f ON f.id = s.idFabricant
    INNER JOIN connecteur c ON c.id = s.idConnecteur
    WHERE s.id = :id;';

    const SELECT_IDGPU = 'SELECT id FROM cartegraphique';
    const SELECT_IDCARTEMERE = 'SELECT id FROM carteMere';
    const SELECT_IDSTOCKAGE = 'SELECT id FROM supportstockage';
    const SELECT_IDCOOLER = 'SELECT id FROM systemerefroidissement';
    const SELECT_IDPROCESSEUR_WITH_SOCKET = 'SELECT id FROM processeur WHERE idSocket = :idSocket';

    const SELECT_IDMEMOIRE_VIVE_WITH_CONSTRAINT = 'SELECT id FROM memoirevive WHERE typeMemoire = :typeMemoire AND nbBarrettes <= :nbBarrettes AND capacite <= :capaciteMax;';

    const SELECT_IDBOITIER_WITH_CONSTRAINT = 'SELECT id FROM Boitier WHERE idFormeCarteMere = :id';

    const SELECT_CONFIG_WITH_DATE = 'SELECT * FROM config WHERE dateCreation = :dateAjd AND idClient = :id';

    const SELECT_ALL_CARTEMERE = 'SELECT c.id,f.nom as fabricant, c.modele,c.chipset,  fo.nom as forme, c.nbConnecteurRam, s.nom as socket, c.capaciteRam, c.wifi, tm.nom as typememoire, su.nom as supportusb
    FROM cartemere c
    INNER JOIN fabricant f ON f.id = c.idFabricant
    INNER JOIN formecartemere fo ON fo.id = c.idForme
    INNER JOIN socket s ON s.id = c.idSocket
    INNER JOIN typememoire tm ON tm.id = c.typeMemoire
    INNER JOIN supportusb su ON su.id = c.idSupportUSB';

    const SELECT_ALL_PROCESSEUR = 'SELECT p.id, f.nom as fabricant, modele, nbCoeurs,frequence, s.nom as socket
    FROM processeur p
    INNER JOIN fabricant f ON f.id = p.idFabricant
    INNER JOIN socket s ON s.id = p.idSocket';
    const SELECT_ALL_COOLER = 'SELECT s.id, f.nom as fabricant, s.modele, s.dimension
    FROM systemerefroidissement s
    INNER JOIN fabricant f ON f.id = idFabricant';
    const SELECT_ALL_MEMOIREVIVE = 'SELECT mv.id, f.nom as fabricant, mv.modele,mv.capacite, mv.nbBarrettes, mv.frequence, c.nom as connecteur, tm.nom as typememoire
    FROM memoirevive as mv
    INNER JOIN fabricant f ON f.id = mv.idFabricant
    INNER JOIN connecteur c ON c.id = mv.idConnecteur
    INNER JOIN typememoire tm ON tm.id = mv.typeMemoire';
    const SELECT_ALL_STOCKAGE = 'SELECT ss.id, f.nom as fabricant, ss.modele,ss.typeStockage,ss.capacite,ss.rpm,c.nom as connecteur,ss.tauxTransfert
    FROM supportstockage ss
    INNER JOIN fabricant f on f.id = ss.idFabricant
    INNER JOIN connecteur c ON c.id = ss.idConnecteur';
    const SELECT_ALL_CARTEGRAPHIQUE = 'SELECT cg.id, f.nom as fabricant, cg.modele, cg.chipset,cg.capacite, tm.nom as typeMemoire, cg.frequence, cg.frameSync, c.nom as connecteur
    FROM cartegraphique cg
    INNER JOIN fabricant f ON f.id = cg.idFabricant
    INNER JOIN typeMemoire tm ON tm.id = cg.typeMemoire
    INNER JOIN connecteur c ON c.id = cg.idConnecteur';
    const SELECT_ALL_BOITIER = 'SELECT b.id, f.nom as fabricant,b.modele, tb.nom as typeboitier, b.typeFenetre, b.psuShroud, b.psuInclus,su.nom as supportusb, fo.nom as forme
    FROM boitier b
    INNER JOIN fabricant f ON f.id = b.idFabricant
    INNER JOIN typeboitier tb ON tb.id = b.typeBoitier
    INNER JOIN supportusb su ON su.id = b.idSupportUSB
    INNER JOIN formecartemere fo ON fo.id = b.idFormeCarteMere';

    private $_bdd;
    public function __construct(PDO $bdd) { $this->_bdd = $bdd; }
    public function __destruct() { $this->_bdd = null; }

    public function getConfig(int $id) : Configuration {
        $query = $this->_bdd->prepare(self::SELECT_CONFIG_PAR_ID);
        $query->bindParam(':id', $id);
        $query->execute();
        $dbResult = $query->fetchAll();
        $configObj = new Configuration($dbResult[0]);

        $query = $this->_bdd->prepare(self::SELECT_CONFIG_STOCKAGE);
        $query->bindParam(':idConfig', $id);
        $query->execute();
        $idStockageArr = $query->fetchAll();
        for ($i = 0; $i < sizeof($idStockageArr); $i++) {
            $configObj->add_idStockage($idStockageArr[$i][0]);
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
        $query = $this->_bdd->prepare(self::DELETE_CONFIG_STOCKAGE);
        $query->bindParam(':idConfig', $id);
        $query->execute();
        
        $query = $this->_bdd->prepare(self::DELETE_CONFIG);
        $query->bindParam(':id', $id);
        $query->execute();
    }

    public function getClientConfigs(int $idClient) : array {
        $query = $this->_bdd->prepare(self::SELECT_CLIENT_CONFIGS);
        $query->bindParam(':idClient', $idClient);
        $query->execute();
        $dbResult = $query->fetchAll();

        $clientConfigArr = array();
        for ($i = 0; $i < sizeof($dbResult); $i++) {
            array_push($clientConfigArr, $this->getConfig($dbResult[$i][0]));
        }

        return $clientConfigArr;
    }

    public function printConfig(Configuration $configObj) {
        $stockageArrSize = sizeof($configObj->get_stockageArr());
        setlocale(LC_TIME, "fr_FR"); 

        echo '<article class="config">
                <table>
                <tr><td colspan=2 class="config_top"><h2>Configuration #' . sprintf("%04d", $configObj->get_id()) . '</h2></td></tr>
                <tr><td colspan=2 class="config_top"><h2><h3 class="config_date">Créée le '. strftime("%d/%m/%Y", strtotime( $configObj->get_dateCreation() )) . '</h3></td></tr>
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

            echo '<form class="delete_config" action="./traitement.php" method="post">
                    <input type="hidden" name="action" value="delete_config">
                    <input type="hidden" name="idConfig" value=' . $configObj->get_id() . '>
                    <button class="btn_delete_config" type="submit">Supprimer cette configuration</button>
                </form>';
            echo '</article>';
    }

    private function selectComposant(int $id, string $sql) {
        $query = $this->_bdd->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchColumn();
    }


    public function getAllCarteMere(PDO $bdd){
        $query = $this->_bdd->prepare(self::SELECT_ALL_CARTEMERE);
        $query->execute();
        return $query->fetchall();
    }
    public function getAllProcesseur(PDO $bdd){
        $query = $this->_bdd->prepare(self::SELECT_ALL_PROCESSEUR);
        $query->execute();
        return $query->fetchall();
    }
    public function getAllMemoireVive(PDO $bdd){
        $query = $this->_bdd->prepare(self::SELECT_ALL_MEMOIREVIVE);
        $query->execute();
        return $query->fetchall();
    }
    public function getAllCarteGraphique(PDO $bdd){
        $query = $this->_bdd->prepare(self::SELECT_ALL_CARTEGRAPHIQUE);
        $query->execute();
        return $query->fetchall();
    }
    public function getAllCooler(PDO $bdd){
        $query = $this->_bdd->prepare(self::SELECT_ALL_COOLER);
        $query->execute();
        return $query->fetchall();
    }
    public function getAllStockage(PDO $bdd){
        $query = $this->_bdd->prepare(self::SELECT_ALL_STOCKAGE);
        $query->execute();
        return $query->fetchall();
    }
    public function getAllBoitier(PDO $bdd){
        $query = $this->_bdd->prepare(self::SELECT_ALL_BOITIER);
        $query->execute();
        return $query->fetchall();
    }

    public function getCarteMereFiltree($filtre)
    {
        $bindParamArray = array();
        $whereClause ='';
        if(isset($filtre['choixFabricantCarte']) && $filtre['choixFabricantCarte'] != 'all')
        {
           
            $this->ajoutFabricantQuery($whereClause,$bindParamArray,$filtre['choixFabricantCarte']);
        }

        if(isset($filtre['choixSocketCarte']) && $filtre['choixSocketCarte'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutSocketQuery($whereClause,$bindParamArray,$filtre['choixSocketCarte']);
        }
        if(isset($filtre['nbConnecteruRAM']) && $filtre['nbConnecteruRAM'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutNbConnecteurs($whereClause,$bindParamArray,$filtre['nbConnecteruRAM']);
        }
        if(isset($filtre['wifiInclus']))
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            if($filtre['wifiInclus'] == "Oui"){
                $temp = "Non";
                $this->ajoutWifiOui($whereClause,$bindParamArray,$temp);
            }
            if($filtre['wifiInclus'] =="Non"){
                $this->ajoutWifiNon($whereClause,$bindParamArray,$filtre['wifiInclus']);
            }  
        }
        if(isset($filtre['nbCapaciteRAM']) && $filtre['nbCapaciteRAM'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutminRAM($whereClause,$bindParamArray,$filtre['nbCapaciteRAM']);
        }

        if (empty($whereClause)){
            $dbResult = $this->_bdd->query(self::SELECT_ALL_CARTEMERE)->fetchAll();
        }else {
            $query = $this->_bdd->prepare(self::SELECT_ALL_CARTEMERE." WHERE ". $whereClause);
            $query->execute($bindParamArray);
            $dbResult = $query->fetchAll();         
        }
        return $dbResult;
    }

    public function getProcesseurFiltree($filtre){
        $bindParamArray = array();
        $whereClause ='';
        if(isset($filtre['choixFabricantProcesseur']) && $filtre['choixFabricantProcesseur'] != 'all')
        {
            $this->ajoutFabricantQuery($whereClause,$bindParamArray,$filtre['choixFabricantProcesseur']);
        }
        if(isset($filtre['nbCoeurs']) && $filtre['nbCoeurs'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutCoeurs($whereClause,$bindParamArray,$filtre['nbCoeurs']);
        }
        if(isset($filtre['typeSocketProcessue']) && $filtre['typeSocketProcessue'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutSocketQuery($whereClause,$bindParamArray,$filtre['typeSocketProcessue']);
        }
        if(isset($filtre['frequenceProcesseur']) && $filtre['frequenceProcesseur'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutFrequenceP($whereClause,$bindParamArray,$filtre['frequenceProcesseur']);
        }
        if (empty($whereClause)){
            $dbResult = $this->_bdd->query(self::SELECT_ALL_PROCESSEUR)->fetchAll();
        }else {
            $query = $this->_bdd->prepare(self::SELECT_ALL_PROCESSEUR." WHERE ". $whereClause);
            $query->execute($bindParamArray);
            $dbResult = $query->fetchAll();         
        }
        
        return $dbResult;
    }

    public function getRamFiltree($filtre){
        $bindParamArray = array();
        $whereClause ='';
        if(isset($filtre['choixFabricantRAM']) && $filtre['choixFabricantRAM'] != 'all')
        {
            $this->ajoutFabricantQuery($whereClause,$bindParamArray,$filtre['choixFabricantRAM']);
        }
        if(isset($filtre['nbBarretesRAM']) && $filtre['nbBarretesRAM'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutminNbBarretesRAM($whereClause,$bindParamArray,$filtre['nbBarretesRAM']);
        }
        if(isset($filtre['frequenceRAM']) && $filtre['frequenceRAM'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutFrequenceRAM($whereClause,$bindParamArray,$filtre['frequenceRAM']);
        }
        if(isset($filtre['typeMemoireRAM']) && $filtre['typeMemoireRAM'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutTypeMemoire($whereClause,$bindParamArray,$filtre['typeMemoireRAM']);
        }
        if(isset($filtre['capaciteRAM']) && $filtre['capaciteRAM'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutCapacite($whereClause,$bindParamArray,$filtre['capaciteRAM']);
        }

        if (empty($whereClause)){
            $dbResult = $this->_bdd->query(self::SELECT_ALL_MEMOIREVIVE)->fetchAll();
        }else {
            $query = $this->_bdd->prepare(self::SELECT_ALL_MEMOIREVIVE." WHERE ". $whereClause);
            $query->execute($bindParamArray);
            $dbResult = $query->fetchAll();         
        }
        
        return $dbResult;
    }

    public function getGpufiltree($filtre){
        $bindParamArray = array();
        $whereClause ='';
        if(isset($filtre['choixFabricantGPU']) && $filtre['choixFabricantGPU'] != 'all')
        {
            $this->ajoutFabricantQuery($whereClause,$bindParamArray,$filtre['choixFabricantGPU']);
        }
        if(isset($filtre['baseClock']) && $filtre['baseClock'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutBaseClock($whereClause,$bindParamArray,$filtre['baseClock']);
        }
        if(isset($filtre['typeMemoireGpu']) && $filtre['typeMemoireGpu'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutTypeMemoire($whereClause,$bindParamArray,$filtre['typeMemoireGpu']);
        }
        if(isset($filtre['chipsetGPU']) && $filtre['chipsetGPU'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutChipset($whereClause,$bindParamArray,$filtre['chipsetGPU']);
        }
        if(isset($filtre['capaciteVRAM']) && $filtre['capaciteVRAM'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutCapaciteVram($whereClause,$bindParamArray,$filtre['capaciteVRAM']);
        }


        if (empty($whereClause)){
            $dbResult = $this->_bdd->query(self::SELECT_ALL_CARTEGRAPHIQUE)->fetchAll();
        }else {
            $query = $this->_bdd->prepare(self::SELECT_ALL_CARTEGRAPHIQUE." WHERE ". $whereClause);
            $query->execute($bindParamArray);
            $dbResult = $query->fetchAll();         
        }
        return $dbResult;
    }

    public function getCoolFiltree($filtre){
        $bindParamArray = array();
        $whereClause ='';
        if(isset($filtre['choixFabricantCooler']) && $filtre['choixFabricantCooler'] != 'all')
        {
            $this->ajoutFabricantQuery($whereClause,$bindParamArray,$filtre['choixFabricantCooler']);
        }
        if(isset($filtre['dimensionCooler']) && $filtre['dimensionCooler'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutDimension($whereClause,$bindParamArray,$filtre['dimensionCooler']);
        }

        if (empty($whereClause)){
            $dbResult = $this->_bdd->query(self::SELECT_ALL_COOLER)->fetchAll();
        }else {
            $query = $this->_bdd->prepare(self::SELECT_ALL_COOLER." WHERE ". $whereClause);
            $query->execute($bindParamArray);
            $dbResult = $query->fetchAll();         
        }
        return $dbResult;
    }
    public function getStockageFiltree($filtre){
        $bindParamArray = array();
        $whereClause ='';
        if(isset($filtre['choixFabricantStockage']) && $filtre['choixFabricantStockage'] != 'all')
        {
            $this->ajoutFabricantQuery($whereClause,$bindParamArray,$filtre['choixFabricantStockage']);
        }
        if(isset($filtre['choixTypeStockage']) && $filtre['choixTypeStockage'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutTypeStockage($whereClause,$bindParamArray,$filtre['choixTypeStockage']);
        }
        if(isset($filtre['connecterStockage']) && $filtre['connecterStockage'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutConnecteur($whereClause,$bindParamArray,$filtre['connecterStockage']);
        }
        if(isset($filtre['choixRMPStockage']) && $filtre['choixRMPStockage'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutRpm($whereClause,$bindParamArray,$filtre['choixRMPStockage']);
        }
        if(isset($filtre['choixCapaciteStockage']) && $filtre['choixCapaciteStockage'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutCapaciteStockage($whereClause,$bindParamArray,$filtre['choixCapaciteStockage']);
        }
        if(isset($filtre['choixTransferStockage']) && $filtre['choixTransferStockage'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutTauxTransfer($whereClause,$bindParamArray,$filtre['choixTransferStockage']);
        }
        

        if (empty($whereClause)){
            $dbResult = $this->_bdd->query(self::SELECT_ALL_STOCKAGE)->fetchAll();
        }else {
            $query = $this->_bdd->prepare(self::SELECT_ALL_STOCKAGE." WHERE ". $whereClause);
            $query->execute($bindParamArray);
            $dbResult = $query->fetchAll();         
        }
        return $dbResult;
    }
    public function getBoitierFiltree($filtre){
        $bindParamArray = array();
        $whereClause ='';
        if(isset($filtre['choixFabricantBoitier']) && $filtre['choixFabricantBoitier'] != 'all')
        {
            $this->ajoutFabricantQuery($whereClause,$bindParamArray,$filtre['choixFabricantBoitier']);
        }
        if(isset($filtre['choixTypeBoitier']) && $filtre['choixTypeBoitier'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutForme($whereClause,$bindParamArray,$filtre['choixTypeBoitier']);
        }
        if(isset($filtre['choixFenetreBoitier']) && $filtre['choixFenetreBoitier'] != 'all')
        {
            $whereClause .= (empty($whereClause)) ? '' : ' AND ';
            $this->ajoutFenetre($whereClause,$bindParamArray,$filtre['choixFenetreBoitier']);
        }
        if (empty($whereClause)){
            $dbResult = $this->_bdd->query(self::SELECT_ALL_BOITIER)->fetchAll();
        }else {
            $query = $this->_bdd->prepare(self::SELECT_ALL_BOITIER." WHERE ". $whereClause);
            $query->execute($bindParamArray);
            $dbResult = $query->fetchAll();         
        }
        return $dbResult;

    }

    public function verificationCompatibilite($comp1,$comp2){
        if($comp1 == $comp2)
            return true;
        else
        return false;
    }
    public function verificationNbCompatibilite($comp1,$comp2){
        if($comp1 >= $comp2)
            return true;
        else
        return false;
    }

    public function ajoutFenetre(string& $whereClause, array& $bindArray, string $Fenetre){
        $whereClause .= 'b.typeFenetre=:Fenetre';
        $bindArray[':Fenetre'] = $Fenetre;
    }

    public function ajoutForme(string& $whereClause, array& $bindArray, string $forme){
        $whereClause .= 'fo.nom=:forme';
        $bindArray[':forme'] = $forme;
    }
    public function ajoutTauxTransfer(string& $whereClause, array& $bindArray, string $capacite){
        $whereClause .= 'ss.tauxTransfert>=:capacite';
        $bindArray[':capacite'] = $capacite;
    }
    public function ajoutCapaciteStockage(string& $whereClause, array& $bindArray, string $capacite){
        $whereClause .= 'ss.capacite>=:capacite';
        $bindArray[':capacite'] = $capacite;
    }
    public function ajoutRpm(string& $whereClause, array& $bindArray, string $rpm){

        $whereClause .= 'ss.rpm=:rpm';
        $bindArray[':rpm'] = $rpm;
    }
    public function ajoutConnecteur(string& $whereClause, array& $bindArray, string $cnom){

        $whereClause .= 'c.nom=:cnom';
        $bindArray[':cnom'] = $cnom;
    }
    public function ajoutTypeStockage(string& $whereClause, array& $bindArray, string $type){

        $whereClause .= 'ss.typeStockage=:type';
        $bindArray[':type'] = $type;
    }

    public function ajoutDimension(string& $whereClause, array& $bindArray, string $dimension){

        $whereClause .= 's.dimension=:dimension';
        $bindArray[':dimension'] = $dimension;
    }
    public function ajoutChipset(string& $whereClause, array& $bindArray, string $Chipset){

        $whereClause .= 'cg.chipset=:chipset';
        $bindArray[':chipset'] = $Chipset;
    }
    public function ajoutBaseClock(string& $whereClause, array& $bindArray, string $frequence){
        $whereClause .= 'cg.frequence=:frequence';
        $bindArray[':frequence'] = $frequence;
    }
    public function ajoutCapacite(string& $whereClause, array& $bindArray, string $capacite){
        $whereClause .= 'mv.capacite>=:nbCapaciteRAM';
        $bindArray[':nbCapaciteRAM'] = $capacite;
    }
    public function ajoutTypeMemoire(string& $whereClause, array& $bindArray, string $nomtypeMemoire){
        $whereClause .= 'tm.nom=:nomtypeMemoire' ;
        $bindArray[':nomtypeMemoire'] = $nomtypeMemoire;
    }
    public function ajoutFabricantQuery(string& $whereClause, array& $bindArray, string $fabricant){
  
        $whereClause .= 'f.nom=:fabricant' ;
        $bindArray[':fabricant'] = $fabricant;
    }

    public function ajoutSocketQuery(string& $whereClause, array& $bindArray, string $socket){   
        $whereClause .= 's.nom=:socket' ;
        $bindArray[':socket'] = $socket;
    }

    public function ajoutNbConnecteurs(string& $whereClause, array& $bindArray, string $C){
        $whereClause .= 'c.nbConnecteurRam=:nbConnecteruRAM' ;
        $bindArray[':nbConnecteruRAM'] = $C;
    }
    public function ajoutWifiOui(string& $whereClause, array& $bindArray, string $wifi){
        $whereClause .= 'c.wifi!=:Non' ;
        $bindArray[':Non'] = $wifi;
    }
    public function ajoutWifiNon(string& $whereClause, array& $bindArray, string $wifi){
        $whereClause .= 'c.wifi=:Non';
        $bindArray[':Non'] = $wifi;
    }
    public function ajoutminRAM(string& $whereClause, array& $bindArray, string $wifi){
        $whereClause .= 'c.capaciteRam>=:nbCapaciteRAM';
        $bindArray[':nbCapaciteRAM'] = $wifi;
    }
    public function ajoutminNbBarretesRAM(string& $whereClause, array& $bindArray, string $nbBarretes){
        $whereClause .= 'mv.nbBarrettes=:nbBarretesRAM' ;
        $bindArray[':nbBarretesRAM'] = $nbBarretes;
    }
    public function ajoutFrequenceRAM(string& $whereClause, array& $bindArray, string $frequenceRAM){
        $whereClause .= 'mv.frequence=:frequenceRAM' ;
        $bindArray[':frequenceRAM'] = $frequenceRAM;
    }
    public function ajoutCoeurs(string& $whereClause, array& $bindArray, string $nbCoeurs){
        $whereClause .= 'nbCoeurs=:nbCoeurs' ;
        $bindArray[':nbCoeurs'] = $nbCoeurs;
    }
    public function ajoutFrequenceP(string& $whereClause, array& $bindArray, string $frequence){
        $whereClause .= 'frequence>=:frequence' ;
        $bindArray[':frequence'] = $frequence;
    }
    public function ajoutCapaciteVram(string& $whereClause, array& $bindArray, string $capacite){
        $whereClause .= 'cg.capacite>=:capacite' ;
        $bindArray[':capacite'] = $capacite;
    }
    public function choixDuChef() {
        //verifie si existe deja choix du chef
        date_default_timezone_set('America/New_York');
        $dateCreation = date("Y-m-d");
        $bindParams = array(':dateAjd' => $dateCreation,
                            ':id' => 3);
        $queryResults = $this->_bdd->prepare(self::SELECT_CONFIG_WITH_DATE);
        $queryResults->execute($bindParams);
        $results = $queryResults->fetch();
        
        if(is_array($results))
        {
            $bindParams2 = array (':idConfig' => $results['id']);
            $queryResults = $this->_bdd->prepare(self::SELECT_CONFIG_STOCKAGE);
            $queryResults->execute($bindParams2);
            $stockage = $queryResults->fetchAll();

            if(count($stockage) == 1)
                $results['idSupportStockage'] = $stockage[0]['idStockage'];
            else {
                $results['idSupportStockage1'] = $stockage[0]['idStockage'];
                $results['idSupportStockage2'] = $stockage[1]['idStockage'];
            }
            return $results;
            
        } 
        else {
           $returnValue = array();
            // carte mere
            $queryResults = $this->_bdd->query(self::SELECT_IDCARTEMERE)->fetchAll();
            $rand = rand(0,count($queryResults) - 1);
            $randCarteMere = $queryResults[$rand]['id'];


            $bindParamsCarteMere = array (':id' => $randCarteMere);
            $queryResults = $this->_bdd->prepare(self::SELECT_INFO_CARTEMERE);
            $queryResults->execute($bindParamsCarteMere);

            $carteMere = $queryResults->fetch();
            $returnValue['idCarteMere'] = $carteMere['id'];
            // print_r($carteMere);
            
            //processeur
            $bindParamsProcesseur = array(":idSocket" => $carteMere['idSocket']);
            $queryResults = $this->_bdd->prepare(self::SELECT_IDPROCESSEUR_WITH_SOCKET);
            $queryResults->execute($bindParamsProcesseur);

        	$processeur = $queryResults->fetchAll();
            $rand = rand(0,count($processeur) - 1);
            $returnValue['idProcesseur'] = $processeur[$rand]['id'];

            //boitier 
            $bindParamsBoitier = array(':id' => $carteMere['idForme']);
            $queryResults = $this->_bdd->prepare(self::SELECT_IDBOITIER_WITH_CONSTRAINT);
            $queryResults->execute($bindParamsBoitier);

            $boitier = $queryResults->fetchAll();
            $rand = rand(0,count($boitier) - 1);
            $returnValue['idBoitier'] = $boitier[$rand]['id'];
            
            //memoire vive
            $bindParamsMemoireVive  = array(':typeMemoire' => $carteMere['typeMemoire'],
                                            ':nbBarrettes' => $carteMere['nbConnecteurRam'],
                                            ':capaciteMax' => $carteMere['capaciteRam']);
            $queryResults = $this->_bdd->prepare(self::SELECT_IDMEMOIRE_VIVE_WITH_CONSTRAINT);
            $queryResults->execute($bindParamsMemoireVive);

            $memoireVive = $queryResults->fetchAll();
            $rand = rand(0,count($memoireVive) - 1);
            $returnValue['idMemoireVive'] = $memoireVive[$rand]['id'];

            //support stockage 
            $nbSupport = rand(1,2);
            $queryResults = $this->_bdd->query(self::SELECT_IDSTOCKAGE)->fetchAll();

            if ($nbSupport == 1){
                $returnValue['idSupportStockage'] = $queryResults[rand(0,count($queryResults) - 1)]['id'];
            } 
            else if($nbSupport == 2) {
                $returnValue['idSupportStockage1'] = $queryResults[rand(0,count($queryResults) - 1)]['id'];
                $returnValue['idSupportStockage2'] = $queryResults[rand(0,count($queryResults) - 1)]['id'];
            }

            //gpu 
            $queryResults = $this->_bdd->query(self::SELECT_IDGPU)->fetchAll();
            $returnValue['idCarteGraphique'] = $queryResults[rand(0,count($queryResults) - 1)]['id'];

            //cooler 
            $queryResults = $this->_bdd->query(self::SELECT_IDCOOLER)->fetchAll();
            $returnValue['idCooler'] = $queryResults[rand(0,count($queryResults) - 1)]['id'];
            $returnValue['idClient'] = 3;
            
            $config = new Configuration($returnValue);
            if ($nbSupport == 1){
                $config->add_idStockage($returnValue['idSupportStockage']);
            } 
            else if($nbSupport == 2) {
                $config->add_idStockage($returnValue['idSupportStockage1']);
                $config->add_idStockage($returnValue['idSupportStockage2']);
            }
            
            $this->addConfig($config);
            return $returnValue;
        }  
 
        
    }

    public function getCarteMereChoisi($id){
        $dbResult = $this->_bdd->query(self::SELECT_ALL_CARTEMERE. ' WHERE c.id ='. $id)->fetchAll();
        return $dbResult;
   
    }
    public function getProcesseurChoisi($id){
        $dbResult = $this->_bdd->query(self::SELECT_ALL_PROCESSEUR. ' WHERE p.id ='. $id)->fetchAll();
        return $dbResult;
    }
    public function getCoolerChoisi($id){
        $dbResult = $this->_bdd->query(self::SELECT_ALL_COOLER. ' WHERE s.id ='. $id)->fetchAll();
        return $dbResult;
    }
    public function getRamChoisi($id){
        $dbResult = $this->_bdd->query(self::SELECT_ALL_MEMOIREVIVE. ' WHERE mv.id ='. $id)->fetchAll();
        return $dbResult;
    }
    public function getStockageChoisi($id){
        $dbResult = $this->_bdd->query(self::SELECT_ALL_STOCKAGE. ' WHERE ss.id ='. $id)->fetchAll();
        return $dbResult;
    }
    public function getCarteGraphiqueChoisi($id){
        $dbResult = $this->_bdd->query(self::SELECT_ALL_CARTEGRAPHIQUE. ' WHERE cg.id ='. $id)->fetchAll();
        return $dbResult;
    }
    public function getBoitierChoisi($id){
        $dbResult = $this->_bdd->query(self::SELECT_ALL_BOITIER. ' WHERE b.id ='. $id)->fetchAll();
        return $dbResult;
    }


    public function get_CarteMereById(int $id) {

        $queryResults = $this->_bdd->prepare(self::SELECT_INFO_CARTEMERE);
        $bindParams = array(':id' => $id);
        $queryResults->execute($bindParams);
        $carteMere = $queryResults->fetch();
        return new CarteMere($carteMere);
    }

    public function get_GPUById(int $id) {

        $queryResults = $this->_bdd->prepare(self::SELECT_INFO_GPU);
        $bindParams = array(':id' => $id);
        $queryResults->execute($bindParams);
        $GPU = $queryResults->fetch();
        return new CarteGraphique($GPU);
    }

    public function get_MemoireViveById(int $id) {

        $queryResults = $this->_bdd->prepare(self::SELECT_INFO_MEMOIREVIVE);
        $bindParams = array(":id" => $id);
        $queryResults->execute($bindParams);
        $MemoireVive = $queryResults->fetch();
        return new MemoireVive($MemoireVive);
    }

    public function get_BoitierById(int $id) {
        
        $bindParams = array(':id' => $id);
        $queryResults = $this->_bdd->prepare(self::SELECT_INFO_BOITIER);
        $queryResults->execute($bindParams);
        $boitier = $queryResults->fetch();
        return new Boitier($boitier);
    }

    public function get_ProcesseurById(int $id) {
        
        $bindParams = array(':id' => $id);
        $queryResults = $this->_bdd->prepare(self::SELECT_INFO_PROCESSEUR);
        $queryResults->execute($bindParams);
        $processeur = $queryResults->fetch();
        return new Processeur($processeur);
    }

    public function get_CoolerById(int $id) {
        
        $bindParams = array(':id' => $id);
        $queryResults = $this->_bdd->prepare(self::SELECT_INFO_COOLER);
        $queryResults->execute($bindParams);
        $cooler = $queryResults->fetch();
        return new Cooler($cooler);
    }

    public function get_SupportStockageById(int $id) {
        
        $bindParams = array(":id" => $id);
        $queryResults = $this->_bdd->prepare(self::SELECT_INFO_SUPPORTSTOCKAGE);
        $queryResults->execute($bindParams);
        $supportStockage = $queryResults->fetch();
        return new SupportStockage($supportStockage);
    }

   
};
?>