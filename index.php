<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    require_once './class/PDOFactory.php';
?>

<h1>Pour une configuration sans trop de réflexion.</h1>
<h2>Configuration Suprême est un outil <em>simple</em> et <em>gratuit</em> vous permettant de configurer l'ordinateur de vos rêves, 
    tout en validant la compatibilité des pièces choisies!</h2>
<h2>Qu'attendez-vous? Commencez à configurer <em>maintenant</em>!</h2>

<?php

    $cm  = new ConfigurationManager(PDOFactory::getMySQLConnection());
    $arrayOfId = $cm->choixDuChef(); 
    $config = new Configuration($arrayOfId);

    $processeur = $cm->get_ProcesseurById($arrayOfId['idProcesseur']);
    $config->set_processeur($processeur);

    $boitier = $cm->get_BoitierById($arrayOfId['idBoitier']);
    $config->set_boitier($boitier);

    $memoireVive = $cm->get_MemoireViveById($arrayOfId['idMemoireVive']);
    $config->set_memoireVive($memoireVive);

    $cooler = $cm->get_CoolerById($arrayOfId['idCooler']);
    $config->set_cooler($cooler);

    $GPU = $cm->get_GPUById($arrayOfId['idGPU']);
    $config->set_carteGraphique($GPU);

    $carteMere = $cm->get_CarteMereById($arrayOfId['idCarteMere']);
    $config->set_carteMere($carteMere);

    if (isset($arrayOfId['idSupportStockage'])) {
       $supportStockage = $cm->get_SupportStockageById($arrayOfId['idSupportStockage']);
        $config->set_supportStockage($supportStockage);
    }
    else {
        $supportStockage1 = $cm->get_SupportStockageById($arrayOfId['idSupportStockage1']);
        $supportStockage2 = $cm->get_SupportStockageById($arrayOfId['idSupportStockage2']);
        
        $arrayObjectSupport = array();
        array_push($arrayObjectSupport, $supportStockage1);
        array_push($arrayObjectSupport, $supportStockage2);
        $config->set_multipleSupportStockage($arrayObjectSupport);
    }

    $config->print_All();


    require_once './inc/footer.php';
?>