<?php
/* Fichier:     classConfiguration.php 
 * Auteur:      Étienne Ménard
 * Date:        01/12/2021
 */
require_once './inc/autoLoader.php';

class Configuration {
    private $_id;                       // identifiant de la configuration
    private $_idClient;                 // identifiant du client
    private $_idCarteMere;              // id de la carte mère
    private $_carteMere;                // obj carte mere
    private $_idSupportStockage;        // id support stockage
    private $_supportStockage;          // obj support stockage 
    private $_idProcesseur;             // id du processeur
    private $_processeur;               // obj processeur
    private $_idCooler;                 // id du système de refroidissements
    private $_cooler;                   // obj cooler
    private $_idMemoireVive;            // id du kit de mémoire vive
    private $_memoireVive;              // obj memoire vive
    private $_idCarteGraphique;         // id de la carte graphique
    private $_carteGraphique;           // obj carte graphique
    private $_idBoitier;                // id du boitier
    private $_boitier;                  // obj boitier
    private $_dateCreation;             // date de création de la configuration

    // TODO AVEC LE MANAGER
    private $_stockageArr = array();    // tableau des id des enregistrements de la table 
                                        // de jointure de la configuration et du stockage

    // constructeur
    public function __construct($params = array()) {
        foreach ($params as $m => $v) {
            $methodName = "set_" . $m; 
            if (method_exists($this, $methodName)) $this->$methodName($v);
        }
        if (isset($params['idSupportStockage1'])) {
            $arrayStockage = array();
            array_push($arrayStockage,$params['idSupportStockage1']);
            array_push($arrayStockage,$params['idSupportStockage2']);

            $this->set_multipleIdSupportStockage($arrayStockage);
        }
    }

    // destructeur
    public function __destruct() {}

    // id
    public function get_id() : int {
        return $this->_id;
    }

    public function set_id(int $id) : void {
        assert($id > 0);
        $this->_id = $id;
    }

    // id client
    public function get_idClient() : int {
        return $this->_idClient;
    }

    public function set_idClient(int $idClient)  {
        $this->_idClient = $idClient;
        return $this;
    }

    // id carte mere
    public function get_idCarteMere() : int {
        return $this->_idCarteMere;
    }

    public function set_idCarteMere(int $idCarteMere)  {
        $this->_idCarteMere = $idCarteMere;
        return $this;
    }

    //obj carte mere
    public function get_carteMere() : CarteMere {
        return $this->_carteMere;
    }

    public function set_carteMere(CarteMere $c) {
        $this->_carteMere = $c;
    }

    //id support stockage

    public function get_idSupportStockage() {
        return $this->_idSupportStockage;
    }

    public function set_multipleIdSupportStockage(array $deviceId) {
        $this->_idSupportStockage = $deviceId;
    }

    public function set_idSupportStockage(int $deviceId) {
        $this->_idSupportStockage = $deviceId;
    }

    // obj support stockage 
    public function get_supportStockage() {
        return $this->_supportStockage;
    }

    public function set_multipleSupportStockage(array $device) {
        $this->_supportStockage = $device;
    }

    public function set_supportStockage(SupportStockage $s){
        $this->_supportStockage = $s;
    }

    // id processeur
    public function get_idProcesseur() : int {
        return $this->_idProcesseur;
    }

    public function set_idProcesseur(int $idProcesseur) {
        $this->_idProcesseur = $idProcesseur;
        return $this;
    }

    //obj processeur
    public function get_processeur() : Processeur {
        return $this->_processeur;
    }

    public function set_processeur(Processeur $p) {
        $this->_processeur = $p;
    }

    // id cooler
    public function get_idCooler() : int {
        return $this->_idCooler;
    }

    public function set_idCooler(int $idCooler) {
        $this->_idCooler = $idCooler;
        return $this;
    }

    //obj cooler
    public function get_cooler() : Cooler {
        return $this->_cooler;
    }

    public function set_cooler(Cooler $c) {
        $this->_cooler = $c;
    }

    // id memoire vive
    public function get_idMemoireVive() : int {
        return $this->_idMemoireVive;
    }

    public function set_idMemoireVive(int $idMemoireVive)
    {
        $this->_idMemoireVive = $idMemoireVive;
        return $this;
    }

    //obj memoire vive
    public function get_memoireVive() : MemoireVive {
        return $this->_memoireVive;
    }

    public function set_memoireVive(MemoireVive $m) {
        $this->_memoireVive = $m;
    }

    // id carte graphique
    public function get_idCarteGraphique() : int {
        return $this->_idCarteGraphique;
    }

    public function set_idCarteGraphique(int $idCarteGraphique) {
        $this->_idCarteGraphique = $idCarteGraphique;
        return $this;
    }

    //obj carte graphique
    public function get_carteGraphique() : CarteGraphique {
        return $this->_carteGraphique;
    }
    public function set_carteGraphique(CarteGraphique $c) {
        $this->_carteGraphique = $c;
    }

    // id boitier
    public function get_idBoitier() : int {
        return $this->_idBoitier;
    }

    public function set_idBoitier(int $idBoitier) {
        $this->_idBoitier = $idBoitier;
        return $this;
    }

    //obj boitier
    public function get_boitier() : Boitier {
        return $this->_boitier;
    }

    public function set_boitier(Boitier $b) {
        $this->_boitier = $b;
    }

    // date de création 
    public function get_dateCreation() {
        return $this->_dateCreation;
    }

    public function set_dateCreation($dateCreation) {
        $this->_dateCreation = $dateCreation;
        return $this;
    }

    // array des supports de stockage
    public function get_stockageArr() {
        return $this->_stockageArr;
    }

    public function add_idStockage(int $idStockage) {
        array_push($this->_stockageArr, $idStockage);
    }

    public function print_All() {
        echo '<article class="cdc_compos">
            <div class="split">';
            
                $this->get_carteMere()->print_Button();
                $this->get_carteGraphique()->print_Button();    
                
        echo'</div>
            <div class="split">';

                $this->get_processeur()->print_Button();
                $this->get_memoireVive()->print_Button();

        echo'</div>
            <div class="split">';
                
                $this->get_boitier()->print_Button();
                $this->get_cooler()->print_Button();

        echo'</div>';

        if (is_array($this->get_supportStockage())){
            echo '<div class= "split">';
            $key = 1;
            $arraySupport = $this->get_supportStockage();
            foreach($arraySupport as $value) {
                $value->print_Button($key);
                $key++;
            }
            echo '</div>';
        } 
        else 
        {
            echo '<div class="split">';
            $this->get_supportStockage()->print_Button(1);

            echo '</div>';
        }
        
        echo '</article>';

        echo '<aside class="cdc_preview">';
            $this->get_boitier()->print_Info();
            $this->get_processeur()->print_Info();
            $this->get_memoireVive()->print_Info();
            $this->get_carteGraphique()->print_Info();
            $this->get_carteMere()->print_Info();
            $this->get_cooler()->print_Info();
            if (is_array($this->get_supportStockage())) {
                $key = 1;
                foreach ($arraySupport as $value) {
                    $value->print_Info($key);
                    $key++;
                }
            }
            else 
            $this->get_supportStockage()->print_Info(1);
        echo'</aside>
        ';
    }
};
?>