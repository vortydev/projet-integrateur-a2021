<?php
/* Fichier:     classCarteGraphique.php 
 * Auteur:      Étienne Ménard
 * Date:        01/12/2021
 */

class CarteGraphique {
    private $_id;           // id du kit de mémoire
    private $_idFabricant;  // id du fabricant
    private $_modele;       // modèle du kit
    private $_chipset;      // nom du chipset
    private $_capacite;     // capacité de mémoire (en GB)
    private $_typeMemoire;  // type de mémoire du kit
    private $_frequence;    // fréquence d'opération
    private $_frameSync;    // id du connecteur du composant
    private $_idConnecteur; // id du connecteur du composant

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

    // chipset
    public function get_chipset() : string { return $this->_chipset; }
    public function set_chipset(string $chipset) { $this->_chipset = $chipset; }

    // capacité
    public function get_capacite() : int { return $this->_capacite; }
    public function set_capacite(int $capacite) { $this->_capacite = $capacite; }

    // type de mémoire
    public function get_typeMemoire() : string { return $this->_typeMemoire; }
    public function set_typeMemoire(string $_typeMemoire) { $this->_typeMemoire = $_typeMemoire; }

    // fréquence
    public function get_frequence() : int { return $this->_frequence; }
    public function set_frequence(int $frequence) { $this->_frequence = $frequence; }

    //frame sync
    public function get_frameSync() : string { return $this->_frameSync; }
    public function set_frameSync(string $frameSync) { $this->_frameSync = $frameSync; }

    // id connecteur
    public function get_idConnecteur() : int { return $this->_idConnecteur; }
    public function set_idConnecteur(int $idConnecteur) { $this->_idConnecteur = $idConnecteur; }

    public function print_Info() {
        echo '<div class="cartegraphique hidden">';
        echo '<h3> Carte graphique </h3></br>';
        echo '<p>Le modele : ' . $this->get_modele() . '</p>';
        echo '<p>Capacite : ' . $this->get_capacite() . 'Go</p>';
        echo '<p>Frequence : ' . $this->get_frequence() . 'MHz</p>';
        echo '<p>Type memoire : ' . $this->get_typeMemoire() . '</p>';    
        echo '</div>';
    }

    public function print_Button() {
        echo '<div class"text_button_CDC">';
        echo    '<p class="text_CDC"><strong> Carte Graphique </strong>' . $this->get_modele() . '</p>';
        echo    '<button class="btn_cartegraphique btn_CDC"type="button">Voir la description</button>';
        echo '</div>';
    }
};
?>