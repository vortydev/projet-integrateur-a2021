<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    require_once './class/PDOFactory.php';
    
    $bdd = PDOFactory::getMySQLConnection();
    $configManager = new ConfigurationManager($bdd);
    
    // $c = new Configuration();
    // $c->set_idClient(1);
    // $c->set_idCarteMere(1);
    // $c->set_idProcesseur(1);
    // $c->set_idCooler(1);
    // $c->set_idMemoireVive(1);
    // $c->set_idCarteGraphique(1);
    // $c->set_idBoitier(1);
    // $c->add_idStockage(1);

    // $configManager->addConfig($c);

    require_once './inc/footer.php';
?>