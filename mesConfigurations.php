<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    require_once './class/PDOFactory.php';
    
    $bdd = PDOFactory::getMySQLConnection();
    $configManager = new ConfigurationManager($bdd);
    
    echo '<h1>Mes configurations</h1>';

    if (!isset($_SESSION['idClient'])) {
        echo '<h2>Veuillez vous <a href="./connexion.php">connecter</a> afin de consulter vos configurations</h2>';
    } 
    else {
        $idClient = $_SESSION['idClient'];
        $clientConfigsArr = $configManager->getClientConfigs($idClient);
        
        if (sizeof($clientConfigsArr) == 0) {
            echo '<h2>Vous n\'avez aucune configuration enregistrée';
        }
        else {
            for ($i = 0; $i < sizeof($clientConfigsArr); $i++) {
                $configManager->printConfig($clientConfigsArr[$i]);
            }
        }
    }

    require_once './inc/footer.php';
?>