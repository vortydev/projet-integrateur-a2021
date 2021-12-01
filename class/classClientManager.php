<?php
require_once 'classClient.php';

class ClientManager {
    private $bdd;
       
    CONST EXIST_COURRIEL = 'SELECT id FROM Client 
                            WHERE courriel = :courriel;';
    CONST INSERT_CLIENT = 'INSERT INTO client (prenom,nom,courriel,motDePasse,dateNaissance,adresse)
                            VALUES (:prenom,:nom,:courriel,:motDePasse,:dateNaissance,:adresse);'; 

    public function __construct(PDO $bdd) { $this->_bdd = $bdd; }
    public function __destruct() { $this->_bdd = null; }

    public function emailVerification(string $courriel) {
        
        $bindParams = array (
            ":courriel" => $courriel 
        );
        $verificationCourriel = $this->_bdd->prepare(self::EXIST_COURRIEL);
        $verificationCourriel->execute($bindParams);

        $results = $verificationCourriel->fetch();

        if (is_array($results)) {
            return false;
        }
        return true;

    }

    public function addClient(Client $c) : int {

        $bindParams = array (
            ":prenom" => $c->get_prenom(),
            ":nom" => $c->get_nom(),
            ":courriel" => $c->get_courriel(),
            ":motDePasse" => $c->get_password(),
            ":dateNaissance" => $c->get_dateNaissance(),
            ":adresse" => $c->get_adresse()
        );

        $insertClient = $this->_bdd->prepare(self::INSERT_CLIENT);
        $insertClient->execute($bindParams);

        $last_id = $this->_bdd->lastInsertId();
        return $last_id;

    }

};
?>