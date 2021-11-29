<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';

    echo "
    <h1>Choisir les composantes!</h1>
    
    <section>
        <h2>Carte mère :</h2>
        <button name='btnSelectionCarte'> Selectioner</button>
        <form action='./traitement.php'><h3>Filtrer </h3>
            <label for='choixFabricantCarte'>Fabricant : </label>
            <select name='choixFabricantCarte' id=''>
                <!-- code php pour avoir les differents fabricants de cartes dans la base de donnes -->
            </select>
            <label for='choixSocketCarte'>Choix de Socket :</label>
            <select name='choixSocketCarte' id=''>
                <!-- code php pour avoir les differents Sockets disponibles de cartes dans la base de donnes -->
            </select>
            <label for='nbCapaciteRAM'>Capacité de RAM minimale en GB : </label>
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
        
    </section><hr>
    <section>
        <h2>Processeur :</h2>
        <button name='btnSelectionProcesseur'> Selectioner</button>
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
        <select name='typeSocketProcessue' id=''>
            <!-- code php qui affichera les types de sockets de la bd -->
        </select>
        <label for='frequenceProcessue'>Frequence minimale en GHz</label>
        <input name='frequenceProcessue' type='text'>

        <ul>Processeurs disponibles:   
            <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
        </ul>
        
    </section> <hr>
    
    <section>
        <h2>Mémoire vive (RAM) :</h2>
        <button name='btnSelectionRAM'> Selectioner</button>
        <form action='./traitement.php'><h3>Filtrer </h3>

        <label for='capaciteRAM'>Capacite minimale RAM: </label>
        <input type='text' name='capaciteRAM'>
        <label for='choixFabricantRAM'>Fabricant: </label>
        <select name='choixFabricantRAM' id=''>
            <!-- code php pour avoir les differents fabricants de RAM dans la base de donnes -->
        </select>
        <label for='nbBarretesRAM'>Nombre de barretes : </label>
        <select name='nbBarretesRAM' id=''>
            <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
        </select>
        </form>
        <label for='typeConnecteurRAM'>Type de connecteur: </label>
        <select name='typeConnecteurRAM' id=''>
            <!-- code php qui affichera les types de sockets de la bd -->
        </select>
        <label for='frequenceRAM'>Frequence minimale en MHz: </label>
        <input name='frequenceRAM' type='text'>

        <label for='typeMemoireRAM'>Type de Memoire: </label>
        <!-- ajouter checkbox et label pour chaque type de memoire dans la bd -->
        
        <ul>Memoire vive disponible:   
            <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
        </ul>
        
    </section><hr>
    
    <section>
        <h2>Carte graphique (GPU) :</h2>
        <button name='btnSelectionRAM'> Selectioner</button>
        <form action='./traitement.php'><h3>Filtrer </h3>

        <label for='capaciteRAM'>Capacite minimale RAM: </label>
        <input type='text' name='capaciteRAM'>
        <label for='choixFabricantRAM'>Fabricant: </label>
        <select name='choixFabricantRAM' id=''>
            <!-- code php pour avoir les differents fabricants de RAM dans la base de donnes -->
        </select>
        <label for='nbBarretesRAM'>Nombre de barretes : </label>
        <select name='nbBarretesRAM' id=''>
            <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
        </select>
        </form>
        <label for='typeConnecteurRAM'>Type de connecteur: </label>
        <select name='typeConnecteurRAM' id=''>
            <!-- code php qui affichera les types de sockets de la bd -->
        </select>
        <label for='frequenceRAM'>Frequence minimale en MHz: </label>
        <input name='frequenceRAM' type='text'>

        <label for='typeMemoireRAM'>Type de Memoire: </label>
        <!-- ajouter checkbox et label pour chaque type de memoire dans la bd -->
        
        <ul>Memoire vive disponible:   
            <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
        </ul>
        
    </section><hr>";
    
    echo "configuration.php";
    require_once './inc/footer.php';
?>




