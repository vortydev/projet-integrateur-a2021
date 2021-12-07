<?php
/* Fichier:     classConfiguration.php 
 * Auteur:      Étienne Ménard
 * Date:        01/12/2021
 */

class Configuration {
    private $_id;               // identifiant de la configuration
    private $_idClient;         // identifiant du client
    private $_idCarteMere;      // id de la carte mère
    private $_idProcesseur;     // id du processeur
    private $_idCooler;         // id du système de refroidissements
    private $_idMemoireVive;    // id du kit de mémoire vive
    private $_idCarteGraphique; // id de la carte graphique
    private $_idBoitier;        // id du boitier
    private $_dateCreation;     // date de création de la configuration

    // TODO AVEC LE MANAGER
    private $_stockageArr = array();    // tableau des id des enregistrements de la table 
                                        // de jointure de la configuration et du stockage

    // constructeur
    public function __construct($params = array()) {
        foreach ($params as $m => $v) {
            $methodName = "set_" . $m; 
            if (method_exists($this, $methodName)) $this->$methodName($v);
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

    // id processeur
    public function get_idProcesseur() : int {
        return $this->_idProcesseur;
    }

    public function set_idProcesseur(int $idProcesseur) {
        $this->_idProcesseur = $idProcesseur;
        return $this;
    }

    // id cooler
    public function get_idCooler() : int {
        return $this->_idCooler;
    }

    public function set_idCooler(int $idCooler) {
        $this->_idCooler = $idCooler;
        return $this;
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

    // id carte graphique
    public function get_idCarteGraphique() : int {
        return $this->_idCarteGraphique;
    }

    public function set_idCarteGraphique(int $idCarteGraphique) {
        $this->_idCarteGraphique = $idCarteGraphique;
        return $this;
    }

    // id boitier
    public function get_idBoitier() : int {
        return $this->_idBoitier;
    }

    public function set_idBoitier(int $idBoitier) {
        $this->_idBoitier = $idBoitier;
        return $this;
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
};
?>