<?php include_once "./inc/autoLoader.php"; ?>
<!DOCTYPE html>
<html lang=fr-ca>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Configuration Suprême</title>

    <link rel="stylesheet" href="./css/style.css" />

    <script src="js/script.js" defer></script>
</head>

<body>
    <header>
        <ul class="flexheader">
            <li><a href="./inscription.php">Inscription</a></li>
            <?php 
            if (isset($_SESSION['idClient']))
                echo '<li><a href="./deconnexion.php">Se deconnecter</a></li>';
            else 
                echo '<li><a href="./connexion.php">Connexion</a></li>';
            ?>
        </ul>
        <img id="csLogo" src="./img/logoR.png" alt="Configuration Suprême">
    </header>
    
    <nav>
        <ul class="flexnav">
            <li class=""><a href="./index.php">Accueil</a></li>
            <li class=""><a href="./configuration.php">Configurer</a></li>
            <li class=""><a href="./mesConfigurations.php">Mes configurations</a></li>
            <li class="nav_contact"><a target="_blank" href="mailto:contact@configurationsupreme.ca">Contact</a></li>
        </ul>
    </nav>

    <main>