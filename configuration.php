<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    loadClass("Boitier");
    loadClass("CarteGraphique");
    loadClass("CarteMere");
    loadClass("Configuration");
    loadClass("Cooler");
    loadClass("MemoireVive");
    loadClass("Processeur");
    loadClass("SupportStockage");
    require_once './class/PDOFactory.php';
    $bdd = PDOFactory::getMySQLConnection();
    $configManager = new ConfigurationManager($bdd);
    $allCarteMere = $configManager->getAllCarteMere($bdd);
    $allProcesseur = $configManager->getAllProcesseur($bdd);
    $allMemoireVive = $configManager->getAllMemoireVive($bdd);
    $allCarteGraphique = $configManager->getAllCarteGraphique($bdd);
    $allCooler = $configManager->getAllCooler($bdd);
    $allStockage = $configManager->getAllStockage($bdd);
    $allBoitier = $configManager->getAllBoitier($bdd);
   
    

    echo " 
    <section id='creationConfig'>
        <h1>Choisir les composantes!</h1>
        
        <h2>Carte mère :</h2>
        <button name='btnSelectionCarte'> Selectioner</button>
        <form action='./traitement.php' class='formChoixComposant'>
            <h3>Filtrer </h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantCarte'>Fabricant : </label>
                <select name='choixFabricantCarte' id=''>";
                $temp = array();
                foreach ($allCarteMere as $choixFabricantCarte){
                    
                    if(!trouverdoublon($choixFabricantCarte['fabricant'], $temp)){
                    echo "<option value='" . $choixFabricantCarte['fabricant'] . "'>" . $choixFabricantCarte['fabricant'] . "</option>";
                    array_push($temp, $choixFabricantCarte['fabricant']);
                    }
                    
                }
                unset($temp);
                echo "   
                </select>
                <label for='choixSocketCarte'>Choix de Socket :</label>
                <select name='choixSocketCarte' id=''>";
                $temp = array();
                foreach ($allCarteMere as $choixSocketCarte){
                    if(!trouverdoublon($choixSocketCarte['socket'], $temp)){
                    echo "<option value='" . $choixSocketCarte['socket'] . "'>" . $choixSocketCarte['socket'] . "</option>";
                    array_push($temp, $choixSocketCarte['socket']);
                    }
                }
                unset($temp);
                echo "</select>
                
                
                <label for='nbConnecteruRAM'>Nombre de connecteurs RAM : </label>
                <select name='nbConnecteruRAM' id=''>";
                $temp = array();
                foreach ($allCarteMere as $nbConnecteruRAM){
                    if(!trouverdoublon($nbConnecteruRAM['nbConnecteurRam'], $temp)){
                    echo "<option value='" . $nbConnecteruRAM['nbConnecteurRam'] . "'>" . $nbConnecteruRAM['nbConnecteurRam'] . "</option>";
                    array_push($temp, $nbConnecteruRAM['nbConnecteurRam']);
                    }
                }
                unset($temp);
                echo "</select>
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
            
        </form>";
        echo "

        <table class='tblProduits'>Cartes disponibles :
            <tr class ='tblProduits'>
                <th>Fabricant</th>
                <th>Modele</th>
                <th>Forme</th>
                <th>Socket</th>
                <th>Chipset</th>
                <th>Capacite RAM</th>
                <th>Type de memoire</th>
                <th>Nombre de connecteur RAM</th>
                <th>Wifi si inclus</th>
                <th>USB compatibles</th>
                <th>selection</th>
            </tr>
            ";
            $tblenght = count($allCarteMere);
            for ($i =0; $i < $tblenght; $i++){
                echo "<tr class ='tblProduits'>
                <td>".$allCarteMere[$i]['fabricant']."</td>
                <td>".$allCarteMere[$i]['modele']."</td>
                <td>".$allCarteMere[$i]['forme']."</td>
                <td>".$allCarteMere[$i]['socket']."</td>
                <td>".$allCarteMere[$i]['chipset']."</td>
                <td>".$allCarteMere[$i]['capaciteRam']."</td>
                <td>".$allCarteMere[$i]['typememoire']."</td>
                <td>".$allCarteMere[$i]['nbConnecteurRam']."</td>
                <td>".$allCarteMere[$i]['wifi']."</td>
                <td>".$allCarteMere[$i]['supportusb']."</td>
                <td><button>choisir</button></td>
                </tr>";
            }
        echo "</table>";
        
    echo "</section>
    <hr>
    <section>
        <h2>Processeur :</h2>
        <form action='./traitement.php' class='formChoixComposant'>
            <h3>Filtrer</h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantProcesseur'>Fabricant : </label>
                <select name='choixFabricantProcesseur' id=''>";
                $temp = array();
                foreach ($allProcesseur as $fabricants){
                    
                    if(!trouverdoublon($fabricants['fabricant'], $temp)){
                    echo "<option value='" . $fabricants['fabricant'] . "'>" . $fabricants['fabricant'] . "</option>";
                    array_push($temp, $fabricants['fabricant']);
                    }
                    
                }
                unset($temp);
                echo " </select>
                <label for='nbCoeurs'>Nombre de coeurs physique</label>
                <select name='nbCoeurs' id=''>";
                $temp = array();
                foreach ($allProcesseur as $nbCoeurs){
                    
                    if(!trouverdoublon($nbCoeurs['nbCoeurs'], $temp)){
                    echo "<option value='" . $nbCoeurs['nbCoeurs'] . "'>" . $nbCoeurs['nbCoeurs'] . "</option>";
                    array_push($temp, $nbCoeurs['nbCoeurs']);
                    }
                    
                }
                unset($temp);
                echo "</select>
            
                <label for='typeSocketProcessue'>Type de Socket</label>
                <select name='typeSocketProcessue' id=''>";
                $temp = array();
                foreach ($allProcesseur as $socket){
                    if(!trouverdoublon($socket['socket'], $temp)){
                    echo "<option value='" . $socket['socket'] . "'>" . $socket['socket'] . "</option>";
                    array_push($temp, $socket['socket']);
                    }
                }
                unset($temp);
                echo "</select>
                
            </p>
            <label for='frequenceProcessue'>Frequence minimale (GHz)</label>
                <input name='frequenceProcesseur' type='text'>
            <p>
                <input type='submit'>
            </p>
        </form>";
        echo "

        <table class='tblProduits'>Processeurs disponibles : 
                <tr class ='tblProduits'>
                    <th>Fabricant</th>
                    <th>Modele</th>
 
                    <th>Nombre de coeurs physiques</th>
                    <th>Frequence (Ghz)</th>
                    <th>Socket</th>
                    <th>selection</th>
                </tr>
                ";
                $tblenght = count($allProcesseur);
                for ($i =0; $i < $tblenght; $i++){
                    echo "<tr class ='tblProduits'>
                    <td>".$allProcesseur[$i]['fabricant']."</td>
                    <td>".$allProcesseur[$i]['modele']."</td>
                    <td>".$allProcesseur[$i]['nbCoeurs']."</td>
                    <td>".$allProcesseur[$i]['frequence']."</td>
                    <td>".$allProcesseur[$i]['socket']."</td>
                    <td><button>choisir</button></td>
                    </tr>";
                }              
        echo "</table>";
        
    echo "</section> 
    <hr>
    
    <section>
        <h2>Mémoire vive (RAM) :</h2>
        <form action='./traitement.php' class='formChoixComposant'>
            <h3>Filtrer </h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantRAM'>Fabricant: </label>
                <select name='choixFabricantRAM' id=''>";
                $temp = array();
                foreach ($allMemoireVive as $fabricant){
                    if(!trouverdoublon($fabricant['fabricant'], $temp)){
                    echo "<option value='" . $socket['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                    array_push($temp, $fabricant['fabricant']);
                    }
                }
                unset($temp);
                echo "</select>
                <label for='nbBarretesRAM'>Nombre de barretes : </label>
                <select name='nbBarretesRAM' id=''>";
                $temp = array();
                foreach ($allMemoireVive as $nbBarrettes){
                    if(!trouverdoublon($nbBarrettes['nbBarrettes'], $temp)){
                    echo "<option value='" . $nbBarrettes['nbBarrettes'] . "'>" . $nbBarrettes['nbBarrettes'] . "</option>";
                    array_push($temp, $nbBarrettes['nbBarrettes']);
                    }
                }
                unset($temp);
                echo "</select>
                <label for='typeConnecteurRAM'>Type de connecteur: </label>
                <select name='typeConnecteurRAM' id=''>";
                $temp = array();
                foreach ($allMemoireVive as $connecteur){
                    if(!trouverdoublon($connecteur['connecteur'], $temp)){
                    echo "<option value='" . $nbBarrettes['connecteur'] . "'>" . $connecteur['connecteur'] . "</option>";
                    array_push($temp, $connecteur['connecteur']);
                    }
                }
                unset($temp);
                echo "</select>
                <label for='frequenceRAM'>Frequence minimale (MHz): </label>
                <select name='frequenceRAM' id=''>";
                $temp = array();
                foreach ($allMemoireVive as $frequence){
                    if(!trouverdoublon($frequence['frequence'], $temp)){
                    echo "<option value='" . $frequence['frequence'] . "'>" . $frequence['frequence'] . "</option>";
                    array_push($temp, $frequence['frequence']);
                    }
                }
                unset($temp);
                echo "</select>
                <label for='typeMemoireRAM'>Type de Memoire: </label>
                <select name='typeMemoireRAM' id=''>";
                $temp = array();
                foreach ($allMemoireVive as $typememoire){
                    if(!trouverdoublon($typememoire['typememoire'], $temp)){
                    echo "<option value='" . $typememoire['typememoire'] . "'>" . $typememoire['typememoire'] . "</option>";
                    array_push($temp, $typememoire['typememoire']);
                    }
                }
                unset($temp);
                echo "</select>   
            <p>
            <label for='capaciteRAM'>Capacite minimale RAM (GB): </label>
                <input type='text' name='capaciteRAM'>

 
            <p>
                <input type='submit'>
            </p>
        </form>";
        echo "

        <table class='tblProduits'>Memoire RAM disponibles
                <tr class ='tblProduits'>
                    <th>Fabricant</th>
                    <th>Modele</th>
                    <th>Capacité (GB)</th>
                    <th>Nombre de Barrettes</th>
                    <th>Frequence (Mhz)</th>
                    <th>Connecteur</th>
                    <th>Type de memoire</th>
                    <th>selection</th>
                </tr>
                ";
                $tblenght = count($allMemoireVive);
                for ($i =0; $i < $tblenght; $i++){
                    echo "<tr class ='tblProduits'>
                    <td>".$allMemoireVive[$i]['fabricant']."</td>
                    <td>".$allMemoireVive[$i]['modele']."</td>
                    <td>".$allMemoireVive[$i]['capacite']."</td>
                    <td>".$allMemoireVive[$i]['nbBarrettes']."</td>
                    <td>".$allMemoireVive[$i]['frequence']."</td>
                    <td>".$allMemoireVive[$i]['connecteur']."</td>
                    <td>".$allMemoireVive[$i]['typememoire']."</td>
                    <td><button>choisir</button></td>
                    </tr>";
                }
        echo "</table>";
        
    echo "</section>
    <hr>
    <section>
        <h2>Carte graphique (GPU) :</h2>
        <form action='./traitement.php' class='formChoixComposant'>
            <h3>Filtrer </h3>

            <p class='selectChoixComposants'> 
                <label for='choixFabricantGPU'>Fabricant: </label>
                <select name='choixFabricantGPU' id=''>";
                $temp = array();
                foreach ($allCarteGraphique as $fabricant){
                    if(!trouverdoublon($fabricant['fabricant'], $temp)){
                    echo "<option value='" . $socket['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                    array_push($temp, $fabricant['fabricant']);
                    }
                }
                unset($temp);
                echo "</select>
                <label for='baseClock'>base Clock (MHz) : </label>
                <select name='baseClock' id=''>";
                $temp = array();
                foreach ($allCarteGraphique as $frequence){
                    if(!trouverdoublon($frequence['frequence'], $temp)){
                    echo "<option value='" . $frequence['frequence'] . "'>" . $frequence['frequence'] . "</option>";
                    array_push($temp, $frequence['frequence']);
                    }
                }
                unset($temp);
                echo "</select>
            
                <label for='typeConnecteurGPU'>Type de connecteur: </label>
                <select name='typeConnecteurGPU' id=''>";
                $temp = array();
                foreach ($allCarteGraphique as $connecteur){
                    if(!trouverdoublon($connecteur['connecteur'], $temp)){
                    echo "<option value='" . $connecteur['connecteur'] . "'>" . $connecteur['connecteur'] . "</option>";
                    array_push($temp, $connecteur['connecteur']);
                    }
                }
                unset($temp);
                echo "</select>
                <label for='chipsetGPU'>Chipset: </label>
                <select name='chipsetGPU' id=''>";
                $temp = array();
                foreach ($allCarteGraphique as $chipset){
                    if(!trouverdoublon($chipset['chipset'], $temp)){
                    echo "<option value='" . $chipset['chipset'] . "'>" . $chipset['chipset'] . "</option>";
                    array_push($temp, $chipset['chipset']);
                    }
                }
                unset($temp);
                echo " </select>
            </p>

            <label for='capaciteVRAM'>Capacite minimale VRAM (GB): </label>
            <input type='text' name='capaciteVRAM'>

            
            <label for='typeMemoireGPU'>Type de Memoire: </label>
            <!-- ajouter checkbox et label pour chaque type de memoire dans la bd -->
            <p>
                <input type='submit'>
            </p>
        </form>";
        echo "

        <table class='tblProduits'>Cartes Disponibles
                <tr class ='tblProduits'>
                    <th>Fabricant</th>
                    <th>Modele</th>
                    <th>Chipset</th>
                    <th>Capacite VRAM (GB)</th>
                    <th>Type de memoire</th>
                    <th>Frequence (Mhz)</th>
                    <th>Technologie FrameSync</th>
                    <th>Connecteur</th>
                    <th>selection</th>
                </tr>
                ";
                $tblenght = count($allCarteGraphique);
                for ($i =0; $i < $tblenght; $i++){
                    echo "<tr class ='tblProduits'>
                    <td>".$allCarteGraphique[$i]['fabricant']."</td>
                    <td>".$allCarteGraphique[$i]['modele']."</td>
                    <td>".$allCarteGraphique[$i]['chipset']."</td>
                    <td>".$allCarteGraphique[$i]['capacite']."</td>
                    <td>".$allCarteGraphique[$i]['typeMemoire']."</td>
                    <td>".$allCarteGraphique[$i]['frequence']."</td>
                    <td>".$allCarteGraphique[$i]['frameSync']."</td>
                    <td>".$allCarteGraphique[$i]['connecteur']."</td>
                    <td><button>choisir</button></td>
                    </tr>";
                }
                 
        echo "</table>";
        
    echo "</section>
    <hr>
    <section>
        <h2>Système de refroidissement du processeur :</h2>
        <form action='./traitement.php' class='formChoixComposant'>
            <h3>Filtrer </h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantCooler'>Fabricant: </label>
                <select name='choixFabricantCooler' id=''>";
                $temp = array();
                foreach ($allCooler as $fabricant){
                    if(!trouverdoublon($fabricant['fabricant'], $temp)){
                    echo "<option value='" . $socket['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                    array_push($temp, $fabricant['fabricant']);
                    }
                }
                unset($temp);
                echo "</select>

                <label for='dimensionCooler'>Dimension (mm): </label>
                <select name='dimensionCooler' id=''>";
                $temp = array();
                foreach ($allCooler as $dimension){
                    if(!trouverdoublon($dimension['dimension'], $temp)){
                    echo "<option value='" . $dimension['dimension'] . "'>" . $dimension['dimension'] . "</option>";
                    array_push($temp, $dimension['dimension']);
                    }
                }
                unset($temp);
                echo "</select>
                 
            </p>
            <label for='socketCooler'>Socket compatible: </label>
            <input type='text' name='socketCooler'>

            <p>
                <input type='submit'>
            </p>
        </form>
        <ul>Système de refroidissement du processeur disponibles :   
        <!-- code php qui cherchera chaque composante et l'affichera dans un li -->
        </ul>
        

    </section>
    <hr>
    
    <section>
    <h2>Support de stockage  :</h2>
    <form action='./traitement.php' class='formChoixComposant'>
        <h3>Filtrer </h3>
        <p class='selectChoixComposants'> 
            <label for='choixFabricantStockage'>Fabricant: </label>
            <select name='choixFabricantStockage' id=''>";
            $temp = array();
            foreach ($allStockage as $fabricant){
                if(!trouverdoublon($fabricant['fabricant'], $temp)){
                echo "<option value='" . $socket['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                array_push($temp, $fabricant['fabricant']);
                }
            }
            unset($temp);
            echo " </select>

            <label for='choixTypeStockage'> support de stockage  : </label>
            <select name='choixTypeStockage' id=''>";
            $temp = array();
            foreach ($allStockage as $typeStockage){
                if(!trouverdoublon($typeStockage['typeStockage'], $temp)){
                echo "<option value='" . $typeStockage['typeStockage'] . "'>" . $typeStockage['typeStockage'] . "</option>";
                array_push($temp, $typeStockage['typeStockage']);
                }
            }
            unset($temp);
            echo "</select>
            <label for='connecteurStockage'> Connecteur Stockage  : </label>
            <select name='connecterStockage' id=''>";
            $temp = array();
            foreach ($allStockage as $connecteur){
                if(!trouverdoublon($connecteur['connecteur'], $temp)){
                echo "<option value='" . $connecteur['connecteur'] . "'>" . $connecteur['connecteur'] . "</option>";
                array_push($temp, $connecteur['connecteur']);
                }
            }
            unset($temp);
            echo "</select>
            <label for='choixRMPStockage'> Vitesse de rotation (rpm): </label>
            <select name='choixRMPStockage' id=''>";
            $temp = array();
            foreach ($allStockage as $rpm){
                if(!trouverdoublon($rpm['rpm'], $temp)){
                echo "<option value='" . $rpm['rpm'] . "'>" . $rpm['rpm'] . "</option>";
                array_push($temp, $rpm['rpm']);
                }
            }
            unset($temp);
            echo "</select>
        </p>

        <label for='choixCapaciteStockage'>Capacite minimale(GB): </label>
        <input type='text' name='choixCapaciteStockage'>

        <label for='choixTransferStockage'>Taux de transfert minimal du lecteur (mo/s) : </label>
        <input type='text' name='choixTransferStockage'>
        <p>
            <input type='submit'>
        </p>
    </form>";
    echo "

    <table class='tblProduits'>Cartes Disponibles
            <tr class ='tblProduits'>
                <th>Fabricant</th>
                <th>Modele</th>
                <th>Type Stockage</th>
                <th>Capacité</th>
                <th>Vitesse de rotation (rpm)</th>
                <th>Connecteur</th>
                <th>Taux de transfer (mo/s)</th>

                <th>selection</th>
            </tr>
            ";
            $tblenght = count($allStockage);
            for ($i =0; $i < $tblenght; $i++){
                echo "<tr class ='tblProduits'>
                <td>".$allStockage[$i]['fabricant']."</td>
                <td>".$allStockage[$i]['modele']."</td>
                <td>".$allStockage[$i]['typeStockage']."</td>
                <td>".$allStockage[$i]['capacite']."</td>
                <td>".$allStockage[$i]['rpm']."</td>
                <td>".$allStockage[$i]['connecteur']."</td>
                <td>".$allStockage[$i]['tauxTransfert']."</td>
                <td><button>choisir</button></td>
                </tr>";
            }  
    echo "</table>";
    
echo "</section>
<hr>
<section>
        <h2>Boitier :</h2>

        <form action='./traitement.php' class='formChoixComposant'>
            <h3>Filtrer </h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantBoitier'>Fabricant: </label>
                <select name='choixFabricantBoitier' id=''>";
                $temp = array();
                foreach ($allBoitier as $fabricant){
                    if(!trouverdoublon($fabricant['fabricant'], $temp)){
                    echo "<option value='" . $socket['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                    array_push($temp, $fabricant['fabricant']);
                    }
                }
                unset($temp);
                echo "</select>

                <label for='choixTypeBoitier'>Type de Boitier (forme): </label>
                <select name='choixTypeBoitier' id=''>";
                $temp = array();
                foreach ($allBoitier as $typeboitier){
                    if(!trouverdoublon($typeboitier['typeboitier'], $temp)){
                    echo "<option value='" . $typeboitier['typeboitier'] . "'>" . $typeboitier['typeboitier'] . "</option>";
                    array_push($temp, $typeboitier['typeboitier']);
                    }
                }
                unset($temp);
                echo "</select>

                <label for='choixFenetrerBoitier'>Type de Fenêtre  : </label>
                <select name='choixFenetreBoitier' id=''>";
                $temp = array();
                foreach ($allBoitier as $typeFenetre){
                    if(!trouverdoublon($typeFenetre['typeFenetre'], $temp)){
                    echo "<option value='" . $typeFenetre['typeFenetre'] . "'>" . $typeFenetre['typeFenetre'] . "</option>";
                    array_push($temp, $typeFenetre['typeFenetre']);
                    }
                }
                unset($temp);
                echo "</select>

                <label for='choixPanneauBoitier'>Panneau USB frontal: </label>
                <select name='choixPanneauBoitier' id=''>";
                $temp = array();
                foreach ($allBoitier as $supportusb){
                    if(!trouverdoublon($supportusb['supportusb'], $temp)){
                    echo "<option value='" . $supportusb['supportusb'] . "'>" . $supportusb['supportusb'] . "</option>";
                    array_push($temp, $supportusb['supportusb']);
                    }
                }
                unset($temp);
                echo "</select>
            </p>
            <p>
                <input type='submit'>
            </p>
            
        </form>";
        echo "
        <table class='tblProduits'>Cartes Disponibles
                <tr class ='tblProduits'>
                    <th>Fabricant</th>
                    <th>Modele</th>
                    <th>Type de boitier (forme)</th>
                    <th>Type fênetre</th>
                    <th>Paneaux USB</th>
                    <th>selection</th>
                </tr>
                ";
                $tblenght = count($allCarteMere);
                for ($i =0; $i < $tblenght; $i++){
                    echo "<tr class ='tblProduits'>
                    <td>".$allBoitier[$i]['fabricant']."</td>
                    <td>".$allBoitier[$i]['modele']."</td>
                    <td>".$allBoitier[$i]['typeboitier']."</td>
                    <td>".$allBoitier[$i]['typeFenetre']."</td>
                    <td>".$allBoitier[$i]['supportusb']."</td>
                    <td><button>choisir</button></td>
                    </tr>";
                }      
        echo "</table>";
        
    echo "</section>
    <hr>";
    function trouverdoublon($mot,array $temp){
        
        $arraylenght = count($temp);
        foreach ($temp as $motemp) {
            
           if($motemp == $mot)
           return true;
        }
        return false;
        
    };
    require_once './inc/footer.php';
?>



