<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';

    echo " 
    <h1 id='creationConfig'>Choisir les composantes!</h1>
    
    <h2>Carte mère :</h2>
    <button name='btnSelectionCarte'> Selectioner</button>

     <section class='hidden'> 
        <form action='./traitement.php' class='formChoixComposant'>
            <h3>Filtrer </h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantCarte'>Fabricant : </label>
                <select name='choixFabricantCarte' id=''>
                    <!-- code php pour avoir les differents fabricants de cartes dans la base de donnes -->
                </select>
                <label for='choixSocketCarte'>Choix de Socket :</label>
                <select name='choixSocketCarte' id=''>
                    <!-- code php pour avoir les differents Sockets disponibles de cartes dans la base de donnes -->
                </select>
                
                
                <label for='nbConnecteruRAM'>Nombre de connecteurs RAM : </label>
                <select name='nbConnecteruRAM' id=''>
                    <!-- code php qui affiche cache option selon les nb de connecteur disponible -->
                </select>
            </p>
            <p>
                <label for='wifiInclus'>Wifi inclus : </label>
                <label for='wifiInclusOui'> Avec Wifi Inclus</label>
                <input name='wifiInclus' type='radio' value ='Oui'>
                <label for='wifiInclusNon'>Sans Wifi Inclus</label>
                <input name='wifiInclus' type='radio' value='Non'>
            </p>    
            <label for='nbCapaciteRAM'>Capacité de RAM minimale en GB : </label>
            <input type='text' name='nbCapaciteRAM'>
            <p>
                <input type='submit'>
            </p>
        </form>
    </section>
            
        <ul>Cartes Disponibles :   
            <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
        </ul>
         <hr>   
    </section>
    <article class='hidden'>
    
        <h2>Processeur :</h2>
        <button name='btnSelectionProcesseur'> Selectioner</button>

        <section class= 'hidden'>

            <form action='./traitement.php' class='formChoixComposant'>
                <h3>Filtrer</h3>
                <p class='selectChoixComposants'> 
                    <label for='choixFabricantProcesseur'>Fabricant : </label>
                    <select name='choixFabricantProcesseur' id=''>
                        <!-- code php pour avoir les differents fabricants de cartes dans la base de donnes -->
                    </select>
                    <label for='nbCoeurs'>Nombre de coeurs physique</label>
                    <select name='nbCoeurs' id=''>
                        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
                    </select>
                
                    <label for='typeSocketProcessue'>Type de Socket</label>
                    <select name='typeSocketProcessue' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>
                    
                </p>
                <label for='frequenceProcessue'>Frequence minimale (GHz)</label>
                    <input name='frequenceProcessue' type='text'>
                <p>
                    <input type='submit'>
                </p>
            </form>
            <ul>Processeurs disponibles:   
                <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
            </ul>
            <hr>    
        </section> 
        
        <h2>Mémoire vive (RAM) :</h2>
        <button name='btnSelectionRAM'> Selectioner</button>

        <section class='hidden'>
            <form action='./traitement.php' class='formChoixComposant'>
                <h3>Filtrer </h3>
                <p class='selectChoixComposants'> 
                    <label for='choixFabricantRAM'>Fabricant: </label>
                    <select name='choixFabricantRAM' id=''>
                        <!-- code php pour avoir les differents fabricants de RAM dans la base de donnes -->
                    </select>
                    <label for='nbBarretesRAM'>Nombre de barretes : </label>
                    <select name='nbBarretesRAM' id=''>
                        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
                    </select>
                
                    <label for='typeConnecteurRAM'>Type de connecteur: </label>
                    <select name='typeConnecteurRAM' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>
                    <label for='frequenceRAM'>Frequence minimale (MHz): </label>
                    <select name='frequenceRAM' id=''>
                    <!-- code php qui affichera les types de sockets de la bd -->
                    </select>
                    
                <p>
                <label for='capaciteRAM'>Capacite minimale RAM (GB): </label>
                    <input type='text' name='capaciteRAM'>

                <label for='typeMemoireRAM'>Type de Memoire: </label>
                <!-- ajouter checkbox et label pour chaque type de memoire dans la bd -->
                <p>
                    <input type='submit'>
                </p>
            </form>
            <ul>Memoire vive disponible:   
                <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
            </ul>
            <hr>    
        </section>
        
        <h2>Carte graphique (GPU) :</h2>
        <button name='btnSelectionRAM'> Selectioner</button>

        <section class='hidden'>

            <form action='./traitement.php' class='formChoixComposant'>
                <h3>Filtrer </h3>

                <p class='selectChoixComposants'> 
                    <label for='choixFabricantGPU'>Fabricant: </label>
                    <select name='choixFabricantGPU' id=''>
                        <!-- code php pour avoir les differents fabricants de RAM dans la base de donnes -->
                    </select>
                    <label for='baseClock'>base Clock (MHz) : </label>
                    <select name='baseClock' id=''>
                        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
                    </select>
                    <label for='boostClock'>Boost Clock (MHz) : </label>
                    <select name='boostClock' id=''>
                        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
                    </select>
                
                    <label for='typeConnecteurGPU'>Type de connecteur: </label>
                    <select name='typeConnecteurGPU' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>

                    <label for='typeMemoireGPU'>Type de Memoire: </label>
                    <!-- ajouter checkbox et label pour chaque type de memoire dans la bd -->


                    <label for='chipsetGPU'>Chipset: </label>
                    <select name='chipsetGPU' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>
                    <label for='couleurGPU'>Couleur: </label>
                    <select name='couleurGPU' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>
                    <label for='portsHDMIGPU'>Ports HDMI : </label>
                    <select name='portsHDMIGPU' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>
                </p>

                <label for='capaciteVRAM'>Capacite minimale VRAM (GB): </label>
                <input type='text' name='capaciteVRAM'>
                <p>
                    <input type='submit'>
                </p>
            </form>
            <ul>Cartes graphiques disponibles :   
            <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
            </ul>
            
            <hr>
        </section>
    
        <h2>Système de refroidissement du processeur :</h2>
        <button name='btnSelectionCooler'> Selectioner</button>

        <section class='hidden'>

            <form action='./traitement.php' class='formChoixComposant'>
                <h3>Filtrer </h3>
                <p class='selectChoixComposants'> 
                    <label for='choixFabricantCooler'>Fabricant: </label>
                    <select name='choixFabricantCooler' id=''>
                        <!-- code php pour avoir les differents fabricants de RAM dans la base de donnes -->
                    </select>

                    <label for='dimensionCooler'>Dimension : </label>
                    <select name='dimensionCooler' id=''>
                        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
                    </select>
                    
                    <label for='socketCooler'>Socket compatible: </label>
                    <select name='socketCooler' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>
                </p>
                <p>
                    <input type='submit'>
                </p>
            </form>
            <ul>Système de refroidissement du processeur disponibles :   
            <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
            </ul>
            
            <hr>
        </section>
        
        <h2>Support de stockage  :</h2>
        <button name='btnSelectionStockage'>Selectioner</button>
        
        <section class='hidden'>
            <form action='./traitement.php' class='formChoixComposant'>
                <h3>Filtrer </h3>
                <p class='selectChoixComposants'> 
                    <label for='choixFabricantStockage'>Fabricant: </label>
                    <select name='choixFabricantStockage' id=''>
                        <!-- code php pour avoir les differents fabricants de RAM dans la base de donnes -->
                    </select>

                    <label for='choixTypeStockage'> support de stockage  : </label>
                    <select name='choixTypeStockage' id=''>
                        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
                    </select>
                    <label for='connecteurStockage'> support de stockage  : </label>
                    <select name='connecterStockage' id=''>
                        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
                    </select>
                    <label for='choixRMPStockage'> Vitesse de rotation  : </label>
                    <select name='choixRMPStockage' id=''>
                        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
                    </select>
                </p>

                <label for='choixCapaciteStockage'>Capacite minimale(GB): </label>
                <input type='text' name='choixCapaciteStockage'>

                <label for='choixTransferStockage'>Taux de transfert minimal du lecteur (mo/s) : </label>
                <input type='text' name='choixTransferStockage'>
                <p>
                    <input type='submit'>
                </p>
            </form>
            <ul>Memoire disponible :   
            <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
            </ul>
                
            <hr>
        </section>
        
        <h2>Boitier :</h2>
        <button name='btnSelectionBoitier'> Selectioner</button>
        
        <section class='hidden'>

            <form action='./traitement.php' class='formChoixComposant'>
                <h3>Filtrer </h3>
                <p class='selectChoixComposants'> 
                    <label for='choixFabricantBoitier'>Fabricant: </label>
                    <select name='choixFabricantBoitier' id=''>
                        <!-- code php pour avoir les differents fabricants de RAM dans la base de donnes -->
                    </select>

                    <label for='choixTypeBoitier'>Type de Boitier : </label>
                    <select name='choixTypeBoitier' id=''>
                        <!-- code php qui cherchera dans la base de donnes le nombre de coeurs differents et affichera une option -->
                    </select>
                    
                    <label for='choixFormeBoitier'>Forme: </label>
                    <select name='choixFormeBoitier' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>

                    <label for='choixCouleurBoitier'>Couleur: </label>
                    <select name='choixCouleurBoitier' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>

                    <label for='choixFenetrerBoitier'>Fenêtre latérale : </label>
                    <select name='choixFenetreBoitier' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>

                    <label for='choixCouleurBoitier'>Couleur: </label>
                    <select name='choixCouleurBoitier' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>

                    <label for='choixPanneauBoitier'>Panneau USB frontal: </label>
                    <select name='choixPanneauBoitier' id=''>
                        <!-- code php qui affichera les types de sockets de la bd -->
                    </select>
                </p>
                <p>
                    <input type='submit'>
                </p>
                
            </form>
            <ul>Boitiers Disponible :   
            <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
            </ul>
            
        <hr>
        </section>
        </article>";
    
    
   
    require_once './inc/footer.php';
?>



