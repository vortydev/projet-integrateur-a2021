<?php
/* Fichier:     classCarteMere.php 
 * Auteur:      Étienne Ménard
 * Date:        01/12/2021
 */

class CarteMere {
    private $_id;               // id de la carte mère
    private $_idFabricant;      // id du fabricant
    private $_modele;           // nom du modèle
    private $_idForme;          // id de la forme de la carte mère (ATX, EATX, etc.)
    private $_nomForme;         // nom de la forme 
    private $_idSocket;         // id du socket
    private $_nomSocket;        // nom du socket
    private $_chipset;          // nom du chipset
    private $_capaciteRam;      // capacité de mémoire vive supportée (en GB)
    private $_typeMemoire;      // id du type de mémoire compatible
    private $_nbConnecteurRam;  // nombre de "slots" pour la mémoire
    private $_wifi;             // modèle de la carte wifi (peut être null)
    private $_idSupportUSB;     // id de la configuration des générations de USB supportés

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

    // id socket
    public function get_idSocket() : int { return $this->_idSocket; }
    public function set_idSocket(int $idSocket) { $this->_idSocket = $idSocket; }

    // nom socket
    public function get_nomSocket() : string { return $this->_nomSocket; }
    public function set_nomSocket(string $nomSocket) { $this->_nomSocket = $nomSocket; }

    // id forme
    public function get_idForme() : int { return $this->_idForme; }
    public function set_idForme(int $_idForme) { $this->_idForme = $_idForme; }

    // nom forme
    public function get_nomForme() : string { return $this->_nomForme; }
    public function set_nomForme(string $nomForme) { $this->_nomForme = $nomForme; }

    // chipset
    public function get_chipset() : string { return $this->_chipset; }
    public function set_chipset(string $chipset) { $this->_chipset = $chipset; }

    // capacité de mémoire
    public function get_capaciteRam() : int { return $this->_capaciteRam; }
    public function set_capaciteRam(int $_capaciteRam) { $this->_capaciteRam = $_capaciteRam; }

    // type de mémoire
    public function get_typeMemoire() : int { return $this->_typeMemoire; }
    public function set_typeMemoire(int $_typeMemoire) { $this->_typeMemoire = $_typeMemoire; }

    // nombre de slots de mémoire
    public function get_nbConnecteurRam() : int { return $this->_nbConnecteurRam; }
    public function set_nbConnecteurRam(int $_nbConnecteurRam) { $this->_nbConnecteurRam = $_nbConnecteurRam; }
    
    // wifi
    public function get_wifi() : string { return $this->_wifi; }
    public function set_wifi(string $_wifi) { $this->_wifi = $_wifi; }

    // id support usb
    public function get_idSupportUSB() : int { return $this->_idSupportUSB; }
    public function set_idSupportUSB(int $_idSupportUSB) { $this->_idSupportUSB = $_idSupportUSB; } 

    public function print_Info() {
        echo '<div class="cartemere hidden">';
        echo '<h3> Carte mere </h3></br>';
        echo '<p>Le modele : ' . $this->get_modele() . '</p>';
        echo '<p>La forme : ' . $this->get_nomForme() . '</p>';
        echo '<p>Nom socket : ' . $this->get_nomSocket() . '</p>';
        echo '<p>Capacite RAM maximum : ' . $this->get_capaciteRam() . 'Go</p>';
        echo '<p>Type de connecteur de RAM : ' . $this->get_typeMemoire() . '</p>';
        echo '<p>Nombre de connecteur RAM : ' . $this->get_nbConnecteurRam() . '</p>';
        echo '</div>';
    }

    public function print_Button() {
        echo '<div class"text_button_CDC">';
        echo    '<p class="text_CDC"><strong> Carte Mere </strong>' . $this->get_modele() . '</p>';
        echo    '<button class="btn_cartemere btn_CDC"type="button">Voir la description</button>';
        echo '</div>';
    }
};
?>