<?php
/* Fichier:     classSupportStockage.php 
 * Auteur:      Étienne Ménard
 * Date:        01/12/2021
 */

class SupportStockage {
    private $_id;               // id du kit de mémoire
    private $_idFabricant;      // id du fabricant
    private $_modele;           // modèle du kit
    private $_typeStockage;     // type de stockage (SSD, HDD)
    private $_capacite;         // capacité de mémoire (en GB)
    private $_rpm;              // vitesse de rotation du disque magnétique
    private $_idConnecteur;     // id du connecteur du composant
    private $_nomConnecteur;    // nom connecteur 
    private $_tauxTransfert;    // taux de transfert de données

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

    // type de stockage
    public function get_typeStockage() : string { return $this->_typeStockage; }
    public function set_typeStockage(string $typeStockage) { $this->_typeStockage = $typeStockage; }

    // capacité
    public function get_capacite() : int { return $this->_capacite; }
    public function set_capacite(int $capacite) { $this->_capacite = $capacite; }

    // rpm
    public function get_rpm() : int { return $this->_rpm; }
    public function set_rpm(int $rpm = 0) { $this->_rpm = $rpm; }

    // id connecteur
    public function get_idConnecteur() : int { return $this->_idConnecteur; }
    public function set_idConnecteur(int $idConnecteur) { $this->_idConnecteur = $idConnecteur; }

    // nom connecteur
    public function get_nomConnecteur() : string { return $this->_nomConnecteur; }
    public function set_nomConnecteur(string $nomConnecteur) { $this->_nomConnecteur = $nomConnecteur; }

    // taux de transfert
    public function get_tauxTransfert() : int { return $this->_tauxTransfert; }
    public function set_tauxTransfert(int $tauxTransfert) { $this->_tauxTransfert = $tauxTransfert; }

    public function print_Info($key) {
        
        echo '<div class="support' . $key . ' hidden">';
        echo '<h3> Support stockage </h3></br>';
        echo '<p>Le modele : ' . $this->get_modele() . '</p>';
        echo '<p>Type de stockage : ' . $this->get_typeStockage() . '</p>';
        echo '<p>Capacite : ' . $this->get_capacite() . 'Go</p>';
        echo '<p>Connecteur ' . $this->get_nomConnecteur() . '</p>';
        if ($this->get_rpm() != 0) 
            echo '<p>Rotation par minute : ' . $this->get_rpm() . '</p>';
        echo '<p>Taux de transfert : ' . $this->get_tauxTransfert() . 'Mo/s</p>';
        echo '</div>';

    }

    public function print_Button($key) {
        echo '<div class"text_button_CDC">';
        echo    '<p class="text_CDC"><strong> Support stockage : </strong>' . $this->get_modele() . '</p>';
        echo    '<button class="btn_supportstockage' . $key . ' btn_CDC"type="button">Voir la description</button>';
        echo '</div>';
    }
};
?>