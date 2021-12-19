<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    loadClass("Configuration");
    require_once './class/PDOFactory.php';
    $bdd = PDOFactory::getMySQLConnection();
    $configManager = new ConfigurationManager($bdd);
    $tblCarteMere = $configManager->getCarteMereFiltree($_POST);
    $tblProcesseur = $configManager->getProcesseurFiltree($_POST);
    $tblMemoireVive = $configManager->getRamFiltree($_POST);
    $tblGpu = $configManager->getGpufiltree($_POST);
    $tblCooler = $configManager->getCoolFiltree($_POST);
    $tblStockage = $configManager-> getStockageFiltree($_POST);
    $tblBoitier = $configManager->getBoitierFiltree($_POST);
    
   
    if(isset($_POST['choixCarteMere']))
    {
        if($_POST['choixCarteMere'] == 'Changer')
        {
            unset($_SESSION['choixCarteMere']);
        }else {
            $_SESSION['choixCarteMere'] = $_POST['choixCarteMere'];
            
        }
    }
    if (isset($_SESSION['choixCarteMere']) && $_SESSION['choixCarteMere'] != 'Changer')
    {
        $Cartechoisie = $configManager->getCarteMereChoisi($_SESSION['choixCarteMere']);
    };

    if(isset($_POST['choixProcesseur']) )
    {
        if($_POST['choixProcesseur'] == 'Changer')
        {
            unset($_SESSION['choixProcesseur']);
        }else {
            $_SESSION['choixProcesseur'] = $_POST['choixProcesseur'];
            
        }
    }
    if (isset($_SESSION['choixProcesseur']) && $_SESSION['choixProcesseur'] != 'Changer')
    {
        $processeurChoisi = $configManager->getProcesseurChoisi($_SESSION['choixProcesseur']);
    };

    if(isset($_POST['choixCooler']) )
    {
        if($_POST['choixCooler'] == 'Changer')
        {
            unset($_SESSION['choixCooler']);
        }else {
            $_SESSION['choixCooler'] = $_POST['choixCooler'];
            
        }
    }
    if (isset($_SESSION['choixCooler']) && $_SESSION['choixCooler'] != 'Changer')
    {
        $CoolerrChoisi = $configManager->getCoolerChoisi($_SESSION['choixCooler']);
    };

    if(isset($_POST['choixRam']))
    {
        if($_POST['choixRam'] == 'Changer')
        {
            unset($_SESSION['choixRam']);
        }else {
            $_SESSION['choixRam'] = $_POST['choixRam'];
            
        }
    }
    if (isset($_SESSION['choixRam']) && $_SESSION['choixRam'] != 'Changer')
    {
        $MvChoisi = $configManager->getRamChoisi($_SESSION['choixRam']);
      
    };

    if(isset($_POST['choixCarteGraphique']) )
    {
        if($_POST['choixCarteGraphique'] == 'Changer')
        {
            unset($_SESSION['choixCarteGraphique']);
        }else {
            $_SESSION['choixCarteGraphique'] = $_POST['choixCarteGraphique'];

        }
    }
    if (isset($_SESSION['choixCarteGraphique']) && $_SESSION['choixCarteGraphique'] != 'Changer')
    {
        $choixCarteGraphique = $configManager->getCarteGraphiqueChoisi($_SESSION['choixCarteGraphique']);
    };

    if(isset($_POST['choixStockage']) )
    {
        if($_POST['choixStockage'] == 'Changer')
        {
            unset($_SESSION['choixStockage']);
        }else {
            $_SESSION['choixStockage'] = $_POST['choixStockage'];

        }
    }
    if (isset($_SESSION['choixStockage']) && $_SESSION['choixStockage'] != 'Changer')
    {
        $choixStockageockage = $configManager->getStockageChoisi($_SESSION['choixStockage']);
    };

    if(isset($_POST['choixBoitier']) )
    {
        if($_POST['choixBoitier'] == 'Changer')
        {
            unset($_SESSION['choixBoitier']);
        }else {
            $_SESSION['choixBoitier'] = $_POST['choixBoitier'];

        }
    }
    if (isset($_SESSION['choixBoitier']) && $_SESSION['choixBoitier'] != 'Changer')
    {
        $choixBoitier = $configManager->getBoitierChoisi($_SESSION['choixBoitier']);
    };

    
    if(isset($_POST['save']) && isset($_POST['save']) == 'Sauvegarder la configuration')
    {
        $conftemparray = array(
            'id' => 1,
            'idClient' => 2,
            'idCarteMere' => $Cartechoisie[0]['id'],
            'idProcesseur' => $processeurChoisi[0]['id'],
            'idCooler' => $CoolerrChoisi[0]['id'],
            'idMemoireVive' => $MvChoisi[0]['id'],
            'idCarteGraphique' => $choixCarteGraphique[0]['id'],
            'idBoitier' => $choixBoitier[0]['id']
        );
        $tempconfiguration = new configuration($conftemparray);
        $tempconfiguration->add_idStockage($choixStockageockage[0]['id']);
        $configManager->addConfig($tempconfiguration);

        echo "<h1>Configuration Sauvegardé!!!</h1>";
        unset($_SESSION['choixBoitier']);
        unset($_SESSION['choixStockage']);
        unset($_SESSION['choixCarteGraphique']);
        unset($_SESSION['choixRam']);
        unset($_SESSION['choixCooler']);
        unset($_SESSION['choixProcesseur']);
        unset($_SESSION['choixCarteMere']);

        
    }
    // verification Socket Processeur & socket Carte Mere
    if(isset($_SESSION['choixCarteMere']) && $_SESSION['choixCarteMere'] != 'Changer'&& isset($_SESSION['choixProcesseur']) && $_SESSION['choixProcesseur']!= 'Changer')
    {
        if(!$configManager->verificationCompatibilite($Cartechoisie[0]['socket'],$processeurChoisi[0]['socket']))
        {
           echo"<h1>Attention : Le socket du processeur et la carte mere ne sont pas compatibiles!</h1>";
        }
    }
    //compatiblite Carte Mere et Memoire Vive
    if(isset($_SESSION['choixCarteMere']) && $_SESSION['choixCarteMere'] != 'Changer'&& isset($_SESSION['choixRam']) && $_SESSION['choixRam']!= 'Changer')
    {
        if(!$configManager->verificationCompatibilite($Cartechoisie[0]['typememoire'],$MvChoisi[0]['typememoire']))
        {
           echo"<h1>Attention : Le socket(type de memoire) de la memoire vive et la carte mere ne sont pas compatibiles!</h1>";
        }
        if(!$configManager->verificationNbCompatibilite($Cartechoisie[0]['capaciteRam'],$MvChoisi[0]['capacite']))
        {
           echo"<h1>Attention : La capacite RAM de la carte mere et la memoire vive ne sont pas compatibles!</h1>";
        }
        if(!$configManager->verificationNbCompatibilite($Cartechoisie[0]['nbConnecteurRam'],$MvChoisi[0]['nbBarrettes']))
        {
           echo"<h1>Attention :Le nombre de connecteurs ram entre la carte mere et la memoire vive ne sont pas compatibles!</h1>";
        }
    }
    //compatibilite Boitier et Carte mere
    if(isset($_SESSION['choixCarteMere']) && $_SESSION['choixCarteMere'] != 'Changer'&& isset($_SESSION['choixBoitier']) && $_SESSION['choixBoitier']!= 'Changer')
    {
        if(!$configManager->verificationCompatibilite($Cartechoisie[0]['forme'],$choixBoitier[0]['forme']))
        {
           echo"<h1>Attention : La forme du boitier et la carte mere ne sont pas compatibles!</h1>";
        }
    }
    
    echo" 
    <section id='creationConfig'>
        <h1>Choisir les composantes!</h1>
        
        <h2>Carte mère :</h2>
        <button name='btnSelectionCarte'> Selectioner</button>
        <form action='configuration.php' method='post' class='formchoixCoolermposant'>
            <h3>Filtrer </h3>
            <p class='selectchoixCoolermposants'> 
                <label for='choixFabricantCarte'>Fabricant : </label>
                <select name='choixFabricantCarte'>
                <option value='all' selected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblCarteMere as $choixFabricantCarte){
                    
                    if(!trouverdoublon($choixFabricantCarte['fabricant'], $temp)){
                    echo"<option value='" . $choixFabricantCarte['fabricant'] . "'>" . $choixFabricantCarte['fabricant'] . "</option>";
                    array_push($temp, $choixFabricantCarte['fabricant']);
                    }
                    
                }
                unset($temp);
                echo"   
                </select>
                <label for='choixSocketCarte'>Choix de Socket :</label>
                <select name='choixSocketCarte' id=''>
                <option value='all' selected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblCarteMere as $choixSocketCarte){
                    if(!trouverdoublon($choixSocketCarte['socket'], $temp)){
                    echo"<option value='" . $choixSocketCarte['socket'] . "'>" . $choixSocketCarte['socket'] . "</option>";
                    array_push($temp, $choixSocketCarte['socket']);
                    }
                }
                unset($temp);
                echo"</select>
                
                
                <label for='nbConnecteruRAM'>Nombre de connecteurs RAM : </label>
                <select name='nbConnecteruRAM' id=''>
                <option value='all' selected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblCarteMere as $nbConnecteruRAM){
                    if(!trouverdoublon($nbConnecteruRAM['nbConnecteurRam'], $temp)){
                    echo"<option value='" . $nbConnecteruRAM['nbConnecteurRam'] . "'>" . $nbConnecteruRAM['nbConnecteurRam'] . "</option>";
                    array_push($temp, $nbConnecteruRAM['nbConnecteurRam']);
                    }
                }
                unset($temp);
                echo"</select>
            </p>
            <p>
                <label for='wifiInclus'>Wifi inclus : </label>
                <label for='wifiInclus'> Avec Wifi Inclus</label>
                <input name='wifiInclus' type='radio' value ='Oui'>
                <label for='wifiInclus'>Sans Wifi Inclus</label>
                <input name='wifiInclus' type='radio' value='Non'>
            </p>    
            <label for='nbCapaciteRAM'>Capacité de RAM minimale en GB : </label>
            <input type='text' name='nbCapaciteRAM'>
            <p>
    
                <input type='submit' value='Filtrer'>
            </p>
            
        </form>
        <form method ='post'>
            <table class='tblProduits'>
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
                if(isset($_SESSION['choixCarteMere'])){
                    echo 
                    "<h3>Composante choisie : </h3>
                    <tr class ='tblProduits'>
                        <td>".$Cartechoisie[0]['fabricant']."</td>
                        <td>".$Cartechoisie[0]['modele']."</td>
                        <td>".$Cartechoisie[0]['forme']."</td>
                        <td>".$Cartechoisie[0]['socket']."</td>
                        <td>".$Cartechoisie[0]['chipset']."</td>
                        <td>".$Cartechoisie[0]['capaciteRam']."</td>
                        <td>".$Cartechoisie[0]['typememoire']."</td>
                        <td>".$Cartechoisie[0]['nbConnecteurRam']."</td>
                        <td>".$Cartechoisie[0]['wifi']."</td>
                        <td>".$Cartechoisie[0]['supportusb']."</td>
                        <td><input name='choixCarteMere' type='submit' value='Changer'></td>
                    </tr>
                    </table>";
                }else {
                $tblenght = sizeof($tblCarteMere);
                for ($i =0; $i < $tblenght; $i++){
                    echo"<tr class ='tblProduits'>
                        <td>".$tblCarteMere[$i]['fabricant']."</td>
                        <td>".$tblCarteMere[$i]['modele']."</td>
                        <td>".$tblCarteMere[$i]['forme']."</td>
                        <td>".$tblCarteMere[$i]['socket']."</td>
                        <td>".$tblCarteMere[$i]['chipset']."</td>
                        <td>".$tblCarteMere[$i]['capaciteRam']."</td>
                        <td>".$tblCarteMere[$i]['typememoire']."</td>
                        <td>".$tblCarteMere[$i]['nbConnecteurRam']."</td>
                        <td>".$tblCarteMere[$i]['wifi']."</td>
                        <td>".$tblCarteMere[$i]['supportusb']."</td>
                        <td><input name='choixCarteMere' type='radio' value=".$tblCarteMere[$i]['id']."></td>
                    </tr>";
                
                }
     echo"</table>
            <input type='submit' value='Confirmer Selection' >";
                }
            
echo"</form>";
        
echo"</section>
    <hr>
    <section>
        <h2>Processeur :</h2>
        <form action='configuration.php' method='post' class='formchoixCoolermposant' >
            <h3>Filtrer</h3>
            <p class='selectchoixCoolermposants'> 
                <label for='choixFabricantProcesseur'>Fabricant : </label>
                <select name='choixFabricantProcesseur' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblProcesseur as $fabricants){
                        
                        if(!trouverdoublon($fabricants['fabricant'], $temp)){
                        echo"<option value='" . $fabricants['fabricant'] . "'>" . $fabricants['fabricant'] . "</option>";
                        array_push($temp, $fabricants['fabricant']);
                        }
                        
                    }
                    unset($temp);
                echo"</select>
                <label for='nbCoeurs'>Nombre de coeurs physique</label>
                <select name='nbCoeurs' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblProcesseur as $nbCoeurs){
                        
                        if(!trouverdoublon($nbCoeurs['nbCoeurs'], $temp)){
                        echo"<option value='" . $nbCoeurs['nbCoeurs'] . "'>" . $nbCoeurs['nbCoeurs'] . "</option>";
                        array_push($temp, $nbCoeurs['nbCoeurs']);
                        }
                        
                    }
                    unset($temp);
            echo"</select>
            
                <label for='typeSocketProcessue'>Type de Socket</label>
                <select name='typeSocketProcessue' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblProcesseur as $socket){
                        if(!trouverdoublon($socket['socket'], $temp)){
                        echo"<option value='" . $socket['socket'] . "'>" . $socket['socket'] . "</option>";
                        array_push($temp, $socket['socket']);
                        }
                    }
                    unset($temp);
            echo"</select>
                
            </p>
                <label for='frequenceProcesseur'>Frequence minimale (GHz)</label>
                <input name='frequenceProcesseur' type='text'>
            <p>
                <input type='submit' value='Filtrer'>
            </p>
        </form>";
        echo"
        <form method ='post'>
            <table class='tblProduits'>
                <tr class ='tblProduits'>
                    <th>Fabricant</th>
                    <th>Modele</th>
                    <th>Nombre de coeurs physiques</th>
                    <th>Frequence (Ghz)</th>
                    <th>Socket</th>
                    <th>selection</th>
                </tr>
                ";
                if(isset($_SESSION['choixProcesseur'])){
                    echo 
                    "<h3>Composante choisie : </h3>
                    <tr class ='tblProduits'>
                        <td>".$processeurChoisi[0]['fabricant']."</td>
                        <td>".$processeurChoisi[0]['modele']."</td>
                        <td>".$processeurChoisi[0]['nbCoeurs']."</td>
                        <td>".$processeurChoisi[0]['frequence']."</td>
                        <td>".$processeurChoisi[0]['socket']."</td>
                        <td><input name='choixProcesseur' type='submit' value='Changer'></td>
                    </tr>
                    </table>";
                }else {
                $tblenght = count($tblProcesseur);
                    for ($i =0; $i < $tblenght; $i++){
                        echo"<tr class ='tblProduits'>
                        <td>".$tblProcesseur[$i]['fabricant']."</td>
                        <td>".$tblProcesseur[$i]['modele']."</td>
                        <td>".$tblProcesseur[$i]['nbCoeurs']."</td>
                        <td>".$tblProcesseur[$i]['frequence']."</td>
                        <td>".$tblProcesseur[$i]['socket']."</td>
                        <td><input name='choixProcesseur' type='radio' value=".$tblProcesseur[$i]['id']."></td>
                        </tr>";
                }
      echo"</table>
            <input type='submit' value='Confirmer Selection'>";
                    }              
echo"</form>";
        
echo"</section> 
    <hr>
    <section>
        <h2>Mémoire vive (RAM) :</h2>
        <form action='configuration.php' method='post' class='formchoixCoolermposant'>
            <h3>Filtrer </h3>
            <p class='selectchoixCoolermposants'> 
                <label for='choixFabricantRAM'>Fabricant: </label>
                <select name='choixFabricantRAM' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblMemoireVive as $fabricant){
                        if(!trouverdoublon($fabricant['fabricant'], $temp)){
                        echo"<option value='" . $fabricant['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                        array_push($temp, $fabricant['fabricant']);
                        }
                    }
                    unset($temp);
            echo"</select>
                <label for='nbBarretesRAM'>Nombre de barretes : </label>
                <select name='nbBarretesRAM' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblMemoireVive as $nbBarrettes){
                        if(!trouverdoublon($nbBarrettes['nbBarrettes'], $temp)){
                        echo"<option value='" . $nbBarrettes['nbBarrettes'] . "'>" . $nbBarrettes['nbBarrettes'] . "</option>";
                        array_push($temp, $nbBarrettes['nbBarrettes']);
                        }
                    }
                    unset($temp);
            echo"</select>
                <label for='frequenceRAM'>Frequence(MHz): </label>
                <select name='frequenceRAM' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblMemoireVive as $frequence){
                        if(!trouverdoublon($frequence['frequence'], $temp)){
                        echo"<option value='" . $frequence['frequence'] . "'>" . $frequence['frequence'] . "</option>";
                        array_push($temp, $frequence['frequence']);
                        }
                    }
                    unset($temp);
            echo"</select>
                <label for='typeMemoireRAM'>Type de Memoire: </label>
                <select name='typeMemoireRAM' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblMemoireVive as $typememoire){
                        if(!trouverdoublon($typememoire['typememoire'], $temp)){
                        echo"<option value='" . $typememoire['typememoire'] . "'>" . $typememoire['typememoire'] . "</option>";
                        array_push($temp, $typememoire['typememoire']);
                        }
                    }
                    unset($temp);
            echo"</select>   
            <p>
                <label for='capaciteRAM'>Capacite minimale RAM (GB): </label>
                <input type='text' name='capaciteRAM'>
            <p>
                <input type='submit' value='Filtrer'>
            </p>
        </form>";
    echo"<form method ='post'>
        <table class='tblProduits'>
            <tr class ='tblProduits'>
                <th>Fabricant</th>
                <th>Modele</th>
                <th>Capacité (GB)</th>
                <th>Nombre de Barrettes</th>
                <th>Frequence (Mhz)</th>
                <th>Type de memoire</th>
                <th>selection</th>
            </tr>
            ";
            if(isset($_SESSION['choixRam'])){
                
                echo 
                "<h3>Composante choisie : </h3>
                <tr class ='tblProduits'>
                    <td>".$MvChoisi[0]['fabricant']."</td>
                    <td>".$MvChoisi[0]['modele']."</td>
                    <td>".$MvChoisi[0]['capacite']."</td>
                    <td>".$MvChoisi[0]['nbBarrettes']."</td>
                    <td>".$MvChoisi[0]['frequence']."</td>
                    <td>".$MvChoisi[0]['typememoire']."</td>
                    <td><input name='choixRam' type='submit' value='Changer'></td>
                </tr>
        </table>";
            }else {
                $tblenght = count($tblMemoireVive);
                for ($i =0; $i < $tblenght; $i++){
                    echo"<tr class ='tblProduits'>
                    <td>".$tblMemoireVive[$i]['fabricant']."</td>
                    <td>".$tblMemoireVive[$i]['modele']."</td>
                    <td>".$tblMemoireVive[$i]['capacite']."</td>
                    <td>".$tblMemoireVive[$i]['nbBarrettes']."</td>
                    <td>".$tblMemoireVive[$i]['frequence']."</td>
                    <td>".$tblMemoireVive[$i]['typememoire']."</td>
                    <td><input name='choixRam' type='radio' value=".$tblMemoireVive[$i]['id']."></td>
                    </tr>";
                }
                echo"</table>
            <input type='submit' value='Confirmer Selection'>";
            }
        echo"</form>";
        
    echo"</section>
    <hr>
    <section>
        <h2>Carte graphique (GPU) :</h2>
        <form action='configuration.php' method='post' class='formchoixCoolermposant'>
            <h3>Filtrer </h3>

            <p class='selectchoixCoolermposants'> 
                <label for='choixFabricantGPU'>Fabricant: </label>
                <select name='choixFabricantGPU' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblGpu as $fabricant){
                        if(!trouverdoublon($fabricant['fabricant'], $temp)){
                        echo"<option value='" . $fabricant['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                        array_push($temp, $fabricant['fabricant']);
                        }
                    }
                    unset($temp);
            echo"</select>
                <label for='baseClock'>base Clock (MHz) : </label>
                <select name='baseClock' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblGpu as $frequence){
                        if(!trouverdoublon($frequence['frequence'], $temp)){
                        echo"<option value='" . $frequence['frequence'] . "'>" . $frequence['frequence'] . "</option>";
                        array_push($temp, $frequence['frequence']);
                        }
                    }
                    unset($temp);
            echo"</select>
                <label for='chipsetGPU'>Chipset: </label>
                <select name='chipsetGPU' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblGpu as $chipset){
                        if(!trouverdoublon($chipset['chipset'], $temp)){
                        echo"<option value='" . $chipset['chipset'] . "'>" . $chipset['chipset'] . "</option>";
                        array_push($temp, $chipset['chipset']);
                        }
                    }
                    unset($temp);
            echo"</select>
                <label for='typeMemoireGpu'>Type de Memoire (VRAM): </label>
                <select name='typeMemoireGpu' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblGpu as $typememoireGpu){
                        if(!trouverdoublon($typememoireGpu['typeMemoire'], $temp)){
                        echo"<option value='" . $typememoireGpu['typeMemoire'] . "'>" . $typememoireGpu['typeMemoire'] . "</option>";
                        array_push($temp, $typememoireGpu['typeMemoire']);
                        }
                    }
                    unset($temp);
            echo"</select>
            </p>
                <label for='capaciteVRAM'>Capacite minimale VRAM (GB): </label>
                <input type='text' name='capaciteVRAM'>
            <p>
                <input type='submit' value='Filtrer'>
            </p>
        </form>";
    echo"<form method ='post'>
        <table class='tblProduits'>
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
        if(isset($_SESSION['choixCarteGraphique'])){
            
        echo"<h3>Composante choisie : </h3>
            <tr class ='tblProduits'>
                <td>".$choixCarteGraphique[0]['fabricant']."</td>
                <td>".$choixCarteGraphique[0]['modele']."</td>
                <td>".$choixCarteGraphique[0]['chipset']."</td>
                <td>".$choixCarteGraphique[0]['capacite']."</td>
                <td>".$choixCarteGraphique[0]['typeMemoire']."</td>
                <td>".$choixCarteGraphique[0]['frequence']."</td>
                <td>".$choixCarteGraphique[0]['frameSync']."</td>
                <td>".$choixCarteGraphique[0]['connecteur']."</td>
                <td><input name='choixCarteGraphique' type='submit' value='Changer'></td>
            </tr>
        </table>";
        }else {
        $tblenght = count($tblGpu);
        for ($i =0; $i < $tblenght; $i++){
        echo"<tr class ='tblProduits'>
                <td>".$tblGpu[$i]['fabricant']."</td>
                <td>".$tblGpu[$i]['modele']."</td>
                <td>".$tblGpu[$i]['chipset']."</td>
                <td>".$tblGpu[$i]['capacite']."</td>
                <td>".$tblGpu[$i]['typeMemoire']."</td>
                <td>".$tblGpu[$i]['frequence']."</td>
                <td>".$tblGpu[$i]['frameSync']."</td>
                <td>".$tblGpu[$i]['connecteur']."</td>
                <td><input name='choixCarteGraphique' type='radio' value=".$tblGpu[$i]['id']."></td>
            </tr>";
        }
    echo"</table>
            <input type='submit' value='Confirmer Selection'>";
            }
    echo"</form>";
        
echo"</section>
    <hr>
    <section>
        <h2>Système de refroidissement du processeur :</h2>
        <form action='configuration.php' method='post' class='formchoixCoolermposant'>
            <h3>Filtrer </h3>
            <p class='selectchoixCoolermposants'> 
                <label for='choixFabricantCooler'>Fabricant: </label>
                <select name='choixFabricantCooler' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblCooler as $fabricant){
                        if(!trouverdoublon($fabricant['fabricant'], $temp)){
                        echo"<option value='" . $fabricant['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                        array_push($temp, $fabricant['fabricant']);
                        }
                    }
                    unset($temp);
            echo"</select>

                <label for='dimensionCooler'>Dimension (mm): </label>
                <select name='dimensionCooler' id=''>
                    <option value='all' selected'>Tous/Toutes</option>";
                    $temp = array();
                    foreach ($tblCooler as $dimension){
                        if(!trouverdoublon($dimension['dimension'], $temp)){
                        echo"<option value='" . $dimension['dimension'] . "'>" . $dimension['dimension'] . "</option>";
                        array_push($temp, $dimension['dimension']);
                        }
                    }
                    unset($temp);
            echo"</select>  
            </p>
            <p>
                <input type='submit' value='Filtrer'>
            </p>
        </form>";
        echo"
        <form method ='post'>
        <table class='tblProduits'>
            <tr class ='tblProduits'>
                <th>Fabricant</th>
                <th>Modele</th>
                <th>Dimensions (mm)</th>
                <th>selection</th>
            </tr>
            ";
            if(isset($_SESSION['choixCooler'])){
                
                echo 
                "<h3>Composante choisie : </h3>
                <tr class ='tblProduits'>
                    <td>".$CoolerrChoisi[0]['fabricant']."</td>
                    <td>".$CoolerrChoisi[0]['modele']."</td>
                    <td>".$CoolerrChoisi[0]['dimension']."</td>
                    <td><input name='choixCooler' type='submit' value='Changer'></td>
                </tr>
        </table>";
            }else {
                $tblenght = count($tblCooler);
                for ($i =0; $i < $tblenght; $i++){
            echo"<tr class ='tblProduits'>
                    <td>".$tblCooler[$i]['fabricant']."</td>
                    <td>".$tblCooler[$i]['modele']."</td>
                    <td>".$tblCooler[$i]['dimension']."</td>
                    <td><input name='choixCooler' type='radio' value=".$tblCooler[$i]['id']."></td>
                </tr>";
                }
        echo"</table>
            <input type='submit' value='Confirmer Selection'>";
                }           
    echo"</form>";
echo"</section>
    <hr>
    <section>
    <h2>Support de stockage :</h2>
    <form action='configuration.php' method='post' class='formchoixCoolermposant'>
        <h3>Filtrer </h3>
        <p class='selectchoixCoolermposants'> 
            <label for='choixFabricantStockage'>Fabricant: </label>
            <select name='choixFabricantStockage' id=''>
                <option value='all' selected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblStockage as $fabricant){
                    if(!trouverdoublon($fabricant['fabricant'], $temp)){
                    echo"<option value='" . $fabricant['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                    array_push($temp, $fabricant['fabricant']);
                    }
                }
                unset($temp);
        echo"</select>

            <label for='choixTypeStockage'> Type de stockage  : </label>
            <select name='choixTypeStockage' id=''>
                <option value='all' selected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblStockage as $typeStockage){
                    if(!trouverdoublon($typeStockage['typeStockage'], $temp)){
                    echo"<option value='" . $typeStockage['typeStockage'] . "'>" . $typeStockage['typeStockage'] . "</option>";
                    array_push($temp, $typeStockage['typeStockage']);
                    }
                }
                unset($temp);
        echo"</select>
            <label for='connecterStockage'> Connecteur Stockage  : </label>
            <select name='connecterStockage' id=''>
                <option value='all' selected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblStockage as $connecteur){
                    if(!trouverdoublon($connecteur['connecteur'], $temp)){
                    echo"<option value='" . $connecteur['connecteur'] . "'>" . $connecteur['connecteur'] . "</option>";
                    array_push($temp, $connecteur['connecteur']);
                    }
                }
                unset($temp);
        echo"</select>
            <label for='choixRMPStockage'> Vitesse de rotation (rpm): </label>
            <select name='choixRMPStockage' id=''>
                <option value='all' selected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblStockage as $rpm){
                    if(!trouverdoublon($rpm['rpm'], $temp)){
                    echo"<option value='" . $rpm['rpm'] . "'>" . $rpm['rpm'] . "</option>";
                    array_push($temp, $rpm['rpm']);
                    }
                }
                unset($temp);
        echo"</select>
        </p>
        <label for='choixCapaciteStockage'>Capacite minimale(GB): </label>
            <input type='text' name='choixCapaciteStockage'>
            <label for='choixTransferStockage'>Taux de transfert minimal du lecteur (mo/s) : </label>
            <input type='text' name='choixTransferStockage'>
        <p>
            <input type='submit' value='Filtrer'>
        </p>
    </form>";
    echo"
    <form method ='post'>
    <table class='tblProduits'>
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
        if(isset($_SESSION['choixStockage'])){
        echo"<h3>Composante choisie : </h3>
            <tr class ='tblProduits'>
                <td>".$choixStockageockage[0]['fabricant']."</td>
                <td>".$choixStockageockage[0]['modele']."</td>
                <td>".$choixStockageockage[0]['typeStockage']."</td>
                <td>".$choixStockageockage[0]['capacite']."</td>
                <td>".$choixStockageockage[0]['rpm']."</td>
                <td>".$choixStockageockage[0]['connecteur']."</td>
                <td>".$choixStockageockage[0]['tauxTransfert']."</td>
                <td><input name='choixStockage' type='submit' value='Changer'></td>
            </tr>
    </table>";
        }else {
        $tblenght = count($tblStockage);
        for ($i =0; $i < $tblenght; $i++){
        echo"<tr class ='tblProduits'>
                <td>".$tblStockage[$i]['fabricant']."</td>
                <td>".$tblStockage[$i]['modele']."</td>
                <td>".$tblStockage[$i]['typeStockage']."</td>
                <td>".$tblStockage[$i]['capacite']."</td>
                <td>".$tblStockage[$i]['rpm']."</td>
                <td>".$tblStockage[$i]['connecteur']."</td>
                <td>".$tblStockage[$i]['tauxTransfert']."</td>
                <td><input name='choixStockage' type='radio' value=".$tblStockage[$i]['id']."></td>
            </tr>";
        }
echo"</table>
    <input type='submit' value='Confirmer Selection'>";  
        }
echo"</form>";
echo"</section>
<hr>
<section>
    <h2>Boitier :</h2>
    <form action='configuration.php' method='post' class='formchoixCoolermposant'>
        <h3>Filtrer </h3>
        <p class='selectchoixCoolermposants'> 
            <label for='choixFabricantBoitier'>Fabricant: </label>
            <select name='choixFabricantBoitier' id=''>
                <option value='all' selected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblBoitier as $fabricant){
                    if(!trouverdoublon($fabricant['fabricant'], $temp)){
                    echo"<option value='" . $fabricant['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                    array_push($temp, $fabricant['fabricant']);
                    }
                }
                unset($temp);
        echo"</select>

            <label for='choixTypeBoitier'>Type de Boitier (forme): </label>
            <select name='choixTypeBoitier' id=''>
                <option value='all' selected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblBoitier as $typeboitier){
                    if(!trouverdoublon($typeboitier['forme'], $temp)){
                    echo"<option value='" . $typeboitier['forme'] . "'>" . $typeboitier['typeboitier'] . "</option>";
                    array_push($temp, $typeboitier['forme']);
                    }
                }
                unset($temp);
        echo"</select>
            <label for='choixFenetreBoitier'>Type de Fenêtre  : </label>
            <select name='choixFenetreBoitier' id=''>
            <option value='all' selected'>Tous/Toutes</option>";
            $temp = array();
            foreach ($tblBoitier as $typeFenetre){
                if(!trouverdoublon($typeFenetre['typeFenetre'], $temp)){
                echo"<option value='" . $typeFenetre['typeFenetre'] . "'>" . $typeFenetre['typeFenetre'] . "</option>";
                array_push($temp, $typeFenetre['typeFenetre']);
                }
            }
            unset($temp);
            
            echo"</select>
        </p>
        <p>
            <input type='submit' value='Filtrer'>
        </p>
        
    </form>";
        echo"
        <form method ='post'>
        <table class='tblProduits'>
            <tr class ='tblProduits'>
                <th>Fabricant</th>
                <th>Modele</th>
                <th>Type de boitier (forme)</th>
                <th>Type fênetre</th>
                <th>Paneaux USB</th>
                <th>selection</th>
            </tr>
            ";
            if(isset($_SESSION['choixBoitier'])){
                echo 
                "<h3>Composante choisie : </h3>
                <tr class ='tblProduits'>
                    <td>".$choixBoitier[0]['fabricant']."</td>
                    <td>".$choixBoitier[0]['modele']."</td>
                    <td>".$choixBoitier[0]['forme']."</td>
                    <td>".$choixBoitier[0]['typeFenetre']."</td>
                    <td>".$choixBoitier[0]['supportusb']."</td>
                    <td><input name='choixBoitier' type='submit' value='Changer'></td>
                </tr>
                </table>";
            }else {
                $tblenght = count($tblBoitier);
                for ($i =0; $i < $tblenght; $i++){
            echo"<tr class ='tblProduits'>
                        <td>".$tblBoitier[$i]['fabricant']."</td>
                        <td>".$tblBoitier[$i]['modele']."</td>
                        <td>".$tblBoitier[$i]['forme']."</td>
                        <td>".$tblBoitier[$i]['typeFenetre']."</td>
                        <td>".$tblBoitier[$i]['supportusb']."</td>
                        <td><input name='choixBoitier' type='radio' value=".$tblBoitier[$i]['id']."></td>
                    </tr>";
                }
            echo"</table>
                <input type='submit' value='Confirmer Selection' >";
            }    
    echo"</form>";
    echo"</section>
    <hr>";
    if(isset($_SESSION['choixCarteMere']) && $_SESSION['choixCarteMere'] != 'Changer' && isset($_SESSION['choixProcesseur']) && $_SESSION['choixProcesseur'] != 'Changer' && isset($_SESSION['choixRam']) && $_SESSION['choixRam'] != 'Changer' && isset($_SESSION['choixCarteGraphique']) && $_SESSION['choixCarteGraphique'] != 'Changer' && isset($_SESSION['choixCooler']) && $_SESSION['choixCooler'] != 'Changer' && isset($_SESSION['choixStockage']) && $_SESSION['choixStockage'] != 'Changer' &&  isset($_SESSION['choixBoitier']) && $_SESSION['choixBoitier'] != 'Changer' ){
        echo"
        <form action='configuration.php' method='post'>
            <input type='submit' name='save' value='Sauvegarder la configuration'>
        </form>";
    }
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



