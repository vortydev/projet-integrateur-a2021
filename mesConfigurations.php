<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    require_once './class/PDOFactory.php';
    
    $bdd = PDOFactory::getMySQLConnection();
    $configManager = new ConfigurationManager($bdd);
    
    echo '<h1>Mes configurations</h1>';

    $c = new Configuration();
    $c->set_id(1);
    $c->set_idClient(1);
    $c->set_idCarteMere(1);
    $c->set_idProcesseur(1);
    $c->set_idCooler(1);
    $c->set_idMemoireVive(1);
    $c->set_idCarteGraphique(1);
    $c->set_idBoitier(1);
    $c->add_idStockage(1);
    $c->set_dateCreation("06/12/2021");
    $configManager->printConfig($c);

    $c2 = new Configuration();
    $c2->set_id(2);
    $c2->set_idClient(1);
    $c2->set_idProcesseur(2);
    $c2->set_idCarteMere(2);
    $c2->set_idCooler(2);
    $c2->set_idMemoireVive(2);
    $c2->set_idCarteGraphique(2);
    $c2->set_idBoitier(2);
    $c2->add_idStockage(2);
    $c2->add_idStockage(3);
    $c2->set_dateCreation("07/12/2021");
    $configManager->printConfig($c2);

    require_once './inc/footer.php';
?>