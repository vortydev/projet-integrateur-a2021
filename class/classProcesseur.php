<?php
/* Fichier:     classProcesseur.php 
 * Auteur:      Étienne Ménard
 * Date:        01/12/2021
 */

class Processeur {
    private $_id;           // id du processeur
    private $_idFabricant;  // id du fabricant
    private $_modele;       // modèle du processeur
    private $_nbCore;       // nombre de coeurs
    private $_frequence;    // fréquence du processeur
    private $_idSocket;     // id du socket

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
    public function get_id() : int { return $this->_id; }
    private function set_id(int $id) : void {
        assert($id > 0);
        $this->_id = $id;
    }

    // id fabricant
    public function get_idFabricant() : int { return $this->_idFabricant; }
    public function set_idFabricant($idFabricant) { $this->_idFabricant = $idFabricant; }

    // modèle
    public function get_modele() : string { return $this->_modele; }
    public function set_modele(string $modele) { $this->_modele = $modele; }

    // nb Cores
    public function get_nbCore() : int { return $this->_nbCore; }
    public function set_nbCore(int $nbCore) { $this->_nbCore = $nbCore; }

    // fréquence
    public function get_frequence() : int { return $this->_frequence; }
    public function set_frequence(int $frequence) { $this->_frequence = $frequence; }

    // id socket
    public function get_idSocket() : int { return $this->_idSocket; }
    public function set_idSocket(int $idSocket) { $this->_idSocket = $idSocket; }
};
?>