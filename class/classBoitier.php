<?php
/* Fichier:     classBoitier.php 
 * Auteur:      Étienne Ménard
 * Date:        01/12/2021
 */

class Boitier {
    private $_id;               // id du kit de mémoire
    private $_idFabricant;      // id du fabricant
    private $_modele;           // modèle du kit
    private $_typeBoitier;      // type de boitier (ATX Mid Tower, Micro ATX Mid Tower, etc.)
    private $_typeFenetre;      // type de fenêtre latérale d'installée
    private $_psuShroud;        // a un couvre PSU
    private $_psuInclus;        // PSU inclus
    private $_idSupportUSB;     // id de la configuration de USB supporté
    private $_idFormeCarteMere; // id de la forme de la carte mère supportée
    private $_formeCarteMere;   // forme carte mere 

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

    // type de boitier
    public function get_typeBoitier() : string { return $this->_typeBoitier; }
    public function set_typeBoitier(string $typeBoitier) { $this->_typeBoitier = $typeBoitier; }

    // type de fenêtre latérale
    public function get_typeFenetre() : string { return $this->_typeFenetre; }
    public function set_typeFenetre(string $typeFenetre) { $this->_typeFenetre = $typeFenetre; }

    // psu shroud
    public function get_psuShroud() : bool { return $this->_psuShroud; }
    public function set_psuShroud(bool $psuShroud) { $this->_psuShroud = $psuShroud; }

    // psu inclus
    public function get_psuInclus() : bool { return $this->_psuInclus; }
    public function set_psuInclus(bool $_psuInclus) { $this->_psuInclus = $_psuInclus; }

    // id support usb
    public function get_idSupportUSB() : int { return $this->_idSupportUSB; }
    public function set_idSupportUSB(int $_idSupportUSB) { $this->_idSupportUSB = $_idSupportUSB; }

    // id forme carte mère
    public function get_idFormeCarteMere() : int { return $this->_idFormeCarteMere; }
    public function set_idFormeCarteMere(int $_idFormeCarteMere) { $this->_idFormeCarteMere = $_idFormeCarteMere; }

    // forme carte mere 
    public function get_formeCarteMere() : string { return $this->_formeCarteMere; }
    public function set_formeCarteMere(int $_formeCarteMere) { $this->_formeCarteMere = $_formeCarteMere; }

    public function print_Info() {
        echo '<h3> Boitier </h3></br>';
        echo '<p>Le modele : ' . $this->get_modele() . '</p>';
        echo '<p>Type de boitier ' . $this->get_typeBoitier() . '</p>';
        echo '<p>La forme de la carte mere : ' . $this->get_formeCarteMere() . '</p>';
    }

    public function print_Button() {
        echo '<div class"text_button_CDC">';
        echo    '<p class="text_CDC"><strong> Boitier : </strong>' . $this->get_modele() . '</p>';
        echo    '<button class="boitier btn_CDC"type="button">Voir la description</button>';
        echo '</div>';
    }
};
?>