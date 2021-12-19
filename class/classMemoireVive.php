<?php
/* Fichier:     classMemoireVive.php 
 * Auteur:      Étienne Ménard
 * Date:        01/12/2021
 */

class MemoireVive {
    private $_id;           // id du kit de mémoire
    private $_idFabricant;  // id du fabricant
    private $_modele;       // modèle du kit
    private $_capacite;     // capacité de mémoire (en GB)
    private $_nbBarrettes;  // nombre de barrettes dans le kit
    private $_frequence;    // fréquence du processeur
    private $_idConnecteur; // id du connecteur du composant
    private $_nomConnecteur;// nom connecteur
    private $_typeMemoire;  // type de mémoire du kit

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

    // capacité
    public function get_capacite() : int { return $this->_capacite; }
    public function set_capacite(int $capacite) { $this->_capacite = $capacite; }

    // nombre de barrettes
    public function get_nbBarrettes() : int { return $this->_nbBarrettes; }
    public function set_nbBarrettes(int $nbBarrettes) { $this->_nbBarrettes = $nbBarrettes; }

    // fréquence
    public function get_frequence() : int { return $this->_frequence; }
    public function set_frequence(int $frequence) { $this->_frequence = $frequence; }

    // id connecteur
    public function get_idConnecteur() : int { return $this->_idConnecteur; }
    public function set_idConnecteur(int $idConnecteur) { $this->_idConnecteur = $idConnecteur; }

    // nom connecteur
    public function get_nomConnecteur() : string { return $this->_nomConnecteur; }
    public function set_nomConnecteur(string $nomConnecteur) { $this->_nomConnecteur = $nomConnecteur; }

    // type de mémoire
    public function get_typeMemoire() : int { return $this->_typeMemoire; }
    public function set_typeMemoire(int $_typeMemoire) { $this->_typeMemoire = $_typeMemoire; }

    public function print_Info() {
        echo '<h3> Memoire vive </h3></br>';
        echo '<p>Le modele : ' . $this->get_modele() . '</p>';
        echo '<p>Capacite : ' . $this->get_capacite() . 'Go</p>';
        echo '<p>Nombre de barrettes : ' . $this->get_nbBarrettes() . '</p>';
        echo '<p>Frequence : ' . $this->get_frequence() . 'MHz</p>';
        echo '<p>Type memoire : ' . $this->get_typeMemoire() . '</p>';
        echo '<p>Connecteur : ' . $this->get_nomConnecteur() . '</p>';
    }

    public function print_Button() {
        echo '<div class"text_button_CDC">';
        echo    '<p class="text_CDC"><strong> Memoire vive : </strong>' . $this->get_modele() . '</p>';
        echo    '<button class="memoirevive btn_CDC"type="button">Voir la description</button>';
        echo '</div>';
    }
};
?>