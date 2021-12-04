<?php

    class Client {
        private $_id,
                $_prenom,
                $_nom,
                $_courriel,
                $_password,
                $_dateNaissance,
                $_adresse;

        private function set_id (int $id){
            $this->_id = $id;
        }

        private function set_password (string $password){
            $this->_password = $password;
        }

        public function __construct(int $id,string $prenom,string $nom,string $courriel,string $password,string $dateNaissance,string $adresse) { 

            $this->_id = $id;
            $this->_prenom = $prenom;
            $this->_nom = $nom;
            $this->_password = $password;
            $this->_adresse = $adresse;
            $this->_courriel = $courriel;
            $this->_dateNaissance = $dateNaissance;
        }

        public function __destruct(){
            $this->_id = 0;
            $this->_prenom = "";
            $this->_nom = "";
            $this->_courriel = "";
            $this->_password = "";
            $this->_dateNaissance = "";
            $this->_adresse = "";
        }

        public function set_prenom (string $prenom) {
            $this->_prenom = $prenom;
        }

        public function set_nom (string $nom) {
            $this->_nom = $nom;
        }

        public function set_courriel (string $courriel) {
            $this->_courriel = $courriel;
        }

        public function set_dateNaissance ($dateNaissance) {
            $this->_dateNaissance = $dateNaissance;
        }

        public function set_Adresse (string $adresse){
            $this->_adresse = $adresse;
        }

        public function get_id() : int {
            return $this->_id;
        }

        public function get_password() : string {
            return $this->_password; 
        }

        public function get_prenom() : string {
            return $this->_prenom;
        }

        public function get_nom() : string {
            return $this->_nom;
        }

        public function get_courriel() : string {
            return $this->_courriel;
        }

        public function get_dateNaissance() {
            return $this->_dateNaissance;
        }

        public function get_adresse() {
            return $this->_adresse;
        }



    }3



?>

