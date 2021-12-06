<?php
class PDOFactory {
    // Constantes pour établir la connexion à la base de données
    const MYSQL_SERVER = 'mysql:host=localhost;dbname=configurationsupreme;charset=utf8';
    const MYSQL_LOGIN = 'root';
    const MYSQL_PASSWORD = '';

    public static function getMySQLConnection() {
        // On se connecte à la base de données
        $bdd = new PDO(self::MYSQL_SERVER, self::MYSQL_LOGIN, self::MYSQL_PASSWORD);
        
        /* On ajuste le "PDO Error Mode" à "exception" pour que les
        avertissements et erreurs apparaissent. */
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $bdd;
    }
};
?>