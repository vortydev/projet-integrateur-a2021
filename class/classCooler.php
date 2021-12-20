<?php
/* Fichier:     classCooler.php 
 * Auteur:      Étienne Ménard
 * Date:        01/12/2021
 */

class Cooler {
    private $_id;           // id du cooler
    private $_idFabricant;  // id du fabricant
    private $_modele;       // modèle du cooler
    private $_dimension;    // dimension(s) du cooler

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

    // dimension
    public function get_dimension() : string { return $this->_dimension; }
    public function set_dimension(string $dimension) { $this->_dimension = $dimension; }

    public function print_Info() {
        echo '<div class="cooler hidden">';
        echo '<h3> Systeme Refroidissement </h3></br>';
        echo '<p>Le modele : ' . $this->get_modele() . '</p>';
        echo '<p>La dimension : ' . $this->get_dimension() . '</p>';
        echo '</div>';
    }

    public function print_Button() {
        echo '<div class"text_button_CDC">';
        echo    '<p class="text_CDC"><strong> Systeme de refroidissement : </strong>' . $this->get_modele() . '</p>';
        echo    '<button class="btn_cooler btn_CDC"type="button">Voir la description</button>';
        echo '</div>';
    }
};
?>