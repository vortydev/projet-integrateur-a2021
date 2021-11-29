<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';

    echo "
    <section>
        <h2>Carte mère :</h2>
        <button name='btnSelectionCarte'> Selectioner carte graphique</button>
        <form action='./traitement.php'><h3>Filtrer </h3>
            <label for='choixFabricantCarte'>Fabricant : </label>
            <select name='choixFabricantCarte' id=''>
                <!-- code php pour avoir les differents fabricants de cartes dans la base de donnes -->
            </select>
            <label for='choixSocketCarte'>Choix de Socket :</label>
            <select name='choixSocketCarte' id=''>
                <!-- code php pour avoir les differents Sockets disponibles de cartes dans la base de donnes -->
            </select>
            <label for='nbCapaciteRAM'>Capacité de RAM : </label>
            <input type='text' name='nbCapaciteRAM' value=''>
            
            <label for='nbConnecteruRAM'>Nombre de connecteurs RAM : </label>
            <select name='nbConnecteruRAM' id=''>
                <!-- code php qui affiche cache option selon les nb de connecteur disponible -->
            </select>
            <label for='wifiInclus'>Wifi inclus : </label>
            <label for='wifiInclusOui'> Avec Wifi Inclus</label>
            <input name='wifiInclus' type='radio' value ='Oui'>
            <label for='wifiInclusNon'>Sans Wifi Inclus</label>
            <input name='wifiInclus' type='radio' value='Non'>
        </form>

        <ul>Cartes Disponibles :   
            <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
        </ul>
        
    </section>
    <section>
    <h2>Processeur :</h2>
    <button name='btnSelectionCarte'> Selectioner le processeur</button>
    <form action='./traitement.php'><h3>Filtrer </h3>
    <label for='choixFabricantProcesseur'>Fabricant : </label>
    <select name='choixFabricantProcesseur' id=''>
        <!-- code php pour avoir les differents fabricants de cartes dans la base de donnes -->
    </select>
    <label for='nbCoeurs'>Nombre de coeurs physique</label>
    <select name='nbCoeurs' id=''>
        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
    </select>
    </form>
    <label for='typeSocketProcessue'>Type de Socket</label>
    <select name='typeSocketProcessue' id="">
        <!-- code php qui affichera les types de sockets de la bd -->
    </select>
    <label for='frequenceProcessue'>Frequence en GHz</label>
    <input name='frequenceProcessue' type='text'>

    <ul>Processeurs disponibles:   
        <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
    </ul>
        
</section>";
    
    echo 'configuration.php';
    require_once './inc/footer.php';
?>



<section>
    <h2>Processeur :</h2>
    <button name='btnSelectionCarte'> Selectioner le processeur</button>
    <form action='./traitement.php'><h3>Filtrer </h3>
    <label for='choixFabricantProcesseur'>Fabricant : </label>
    <select name='choixFabricantProcesseur' id=''>
        <!-- code php pour avoir les differents fabricants de cartes dans la base de donnes -->
    </select>
    <label for='nbCoeurs'>Nombre de coeurs physique</label>
    <select name='nbCoeurs' id=''>
        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
    </select>
    </form>
    <label for='typeSocketProcessue'>Type de Socket</label>
    <select name="typeSocketProcessue" id="">
        <!-- code php qui affichera les types de sockets de la bd -->
    </select>
    <label for="frequenceProcessue">Frequence en GHz</label>
    <input name="frequenceProcessue" type='text'>

    <ul>Processeurs disponibles:   
        <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
    </ul>
        
</section>
