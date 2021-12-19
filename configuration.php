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
    $tblCarteMere = $configManager->getCarteMereFiltree($_POST);
    $tblProcesseur = $configManager->getProcesseurFiltree($_POST);
    $tblMemoireVive = $configManager->getRamFiltree($_POST);
    $tblGpu = $configManager->getGpufiltree($_POST);
    $tblCooler = $configManager->getCoolFiltree($_POST);
    $tblStockage = $configManager-> getStockageFiltree($_POST);
    $tblBoitier = $configManager->getBoitierFiltree($_POST);
   
    if(isset($_POST['ChoixCM']) )
    {
        if($_POST['ChoixCM'] == 'changer')
        {
            unset($_SESSION['ChoixCM']);
        }else {
            $_SESSION['ChoixCM'] = $_POST['ChoixCM'];
        }
    }
    
    if(isset($_POST['ChoixP']) )
    {
        if($_POST['ChoixP'] == 'changer')
        {
            unset($_SESSION['ChoixP']);
        }else {
            $_SESSION['ChoixP'] = $_POST['ChoixP'];
        }
    }

    if(isset($_POST['ChoixCo']) )
    {
        if($_POST['ChoixCo'] == 'changer')
        {
            unset($_SESSION['ChoixCo']);
        }else {
            $_SESSION['ChoixCo'] = $_POST['ChoixCo'];
        }
    }

    if(isset($_POST['ChoixMv']) )
    {
        if($_POST['ChoixMv'] == 'changer')
        {
            unset($_SESSION['ChoixMv']);
        }else {
            $_SESSION['ChoixMv'] = $_POST['ChoixMv'];
        }
    }

    if(isset($_POST['ChoixCg']) )
    {
        if($_POST['ChoixCg'] == 'changer')
        {
            unset($_SESSION['ChoixCg']);
        }else {
            $_SESSION['ChoixCg'] = $_POST['ChoixCg'];
        }
    }

    if(isset($_POST['ChoixSt']) )
    {
        if($_POST['ChoixSt'] == 'changer')
        {
            unset($_SESSION['ChoixSt']);
        }else {
            $_SESSION['ChoixSt'] = $_POST['ChoixSt'];
        }
    }

    if(isset($_POST['ChoixB']) )
    {
        if($_POST['ChoixB'] == 'changer')
        {
            unset($_SESSION['ChoixB']);
        }else {
            $_SESSION['ChoixB'] = $_POST['ChoixB'];
        }
    }
    
    echo " 
    <section id='creationConfig'>
        <h1>Choisir les composantes!</h1>
        
        <h2>Carte mère :</h2>
        <button name='btnSelectionCarte'> Selectioner</button>
        <form action='configuration.php' method='post' class='formChoixComposant'>
            <h3>Filtrer </h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantCarte'>Fabricant : </label>
                <select name='choixFabricantCarte'>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblCarteMere as $choixFabricantCarte){
                    
                    if(!trouverdoublon($choixFabricantCarte['fabricant'], $temp)){
                    echo "<option value='" . $choixFabricantCarte['fabricant'] . "'>" . $choixFabricantCarte['fabricant'] . "</option>";
                    array_push($temp, $choixFabricantCarte['fabricant']);
                    }
                    
                }
                unset($temp);
                echo "   
                </select>
                <label for='choixSocketCarte'>Choix de Socket :</label>
                <select name='choixSocketCarte' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblCarteMere as $choixSocketCarte){
                    if(!trouverdoublon($choixSocketCarte['socket'], $temp)){
                    echo "<option value='" . $choixSocketCarte['socket'] . "'>" . $choixSocketCarte['socket'] . "</option>";
                    array_push($temp, $choixSocketCarte['socket']);
                    }
                }
                unset($temp);
                echo "</select>
                
                
                <label for='nbConnecteruRAM'>Nombre de connecteurs RAM : </label>
                <select name='nbConnecteruRAM' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblCarteMere as $nbConnecteruRAM){
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
                <label for='wifiInclus'> Avec Wifi Inclus</label>
                <input name='wifiInclus' type='radio' value ='Oui'>
                <label for='wifiInclus'>Sans Wifi Inclus</label>
                <input name='wifiInclus' type='radio' value='Non'>
            </p>    
            <label for='nbCapaciteRAM'>Capacité de RAM minimale en GB : </label>
            <input type='text' name='nbCapaciteRAM'>
            <p>
                <input type='hidden' name='fCarte' value='filtrerCarte' >
                <input type='submit' >
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
            if(isset($_SESSION['ChoixCM'])){
                $Cartechoisie = $configManager->getCarteMereChoisi($_SESSION['ChoixCM']);
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
                    <td><input name='ChoixCM' type='submit' value='changer'></td>
                </tr>
                </table>";
            }else {
                $tblenght = sizeof($tblCarteMere);
                for ($i =0; $i < $tblenght; $i++){
                    echo "<tr class ='tblProduits'>
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
                        <td><input name='ChoixCM' type='radio' value=".$tblCarteMere[$i]['id']."></td>
                    </tr>";
                
                }
                echo " </table>
                <input type='submit' >";
            }
            
        echo "</form>";
        
    echo "</section>
    <hr>
    <section>
        <h2>Processeur :</h2>
        <form action='configuration.php' method='post' class='formChoixComposant' >
            <h3>Filtrer</h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantProcesseur'>Fabricant : </label>
                <select name='choixFabricantProcesseur' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblProcesseur as $fabricants){
                    
                    if(!trouverdoublon($fabricants['fabricant'], $temp)){
                    echo "<option value='" . $fabricants['fabricant'] . "'>" . $fabricants['fabricant'] . "</option>";
                    array_push($temp, $fabricants['fabricant']);
                    }
                    
                }
                unset($temp);
                echo " </select>
                <label for='nbCoeurs'>Nombre de coeurs physique</label>
                <select name='nbCoeurs' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblProcesseur as $nbCoeurs){
                    
                    if(!trouverdoublon($nbCoeurs['nbCoeurs'], $temp)){
                    echo "<option value='" . $nbCoeurs['nbCoeurs'] . "'>" . $nbCoeurs['nbCoeurs'] . "</option>";
                    array_push($temp, $nbCoeurs['nbCoeurs']);
                    }
                    
                }
                unset($temp);
                echo "</select>
            
                <label for='typeSocketProcessue'>Type de Socket</label>
                <select name='typeSocketProcessue' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblProcesseur as $socket){
                    if(!trouverdoublon($socket['socket'], $temp)){
                    echo "<option value='" . $socket['socket'] . "'>" . $socket['socket'] . "</option>";
                    array_push($temp, $socket['socket']);
                    }
                }
                unset($temp);
                echo "</select>
                
            </p>
            <label for='frequenceProcesseur'>Frequence minimale (GHz)</label>
                <input name='frequenceProcesseur' type='text'>
            <p>
                <input type='hidden' name='fProcesseur' value='filtrerProcesseur' >
                <input type='submit'>
            </p>
        </form>";
        echo "
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
                if(isset($_SESSION['ChoixP'])){
                    $processeurChoisi = $configManager->getProcesseurChoisi($_SESSION['ChoixP']);
                    echo 
                    "<h3>Composante choisie : </h3>
                    <tr class ='tblProduits'>
                        <td>".$processeurChoisi[0]['fabricant']."</td>
                        <td>".$processeurChoisi[0]['modele']."</td>
                        <td>".$processeurChoisi[0]['nbCoeurs']."</td>
                        <td>".$processeurChoisi[0]['frequence']."</td>
                        <td>".$processeurChoisi[0]['socket']."</td>
                        <td><input name='ChoixP' type='submit' value='changer'></td>
                    </tr>
                    </table>";
                }else {
                $tblenght = count($tblProcesseur);
                    for ($i =0; $i < $tblenght; $i++){
                        echo "<tr class ='tblProduits'>
                        <td>".$tblProcesseur[$i]['fabricant']."</td>
                        <td>".$tblProcesseur[$i]['modele']."</td>
                        <td>".$tblProcesseur[$i]['nbCoeurs']."</td>
                        <td>".$tblProcesseur[$i]['frequence']."</td>
                        <td>".$tblProcesseur[$i]['socket']."</td>
                        <td><input name='ChoixP' type='radio' value=".$tblProcesseur[$i]['id']."></td>
                        </tr>";
                    }
                    echo " </table>
                <input type='submit' >";
                }              
        echo "</form>";
        
    echo "</section> 
    <hr>
    
    <section>
        <h2>Mémoire vive (RAM) :</h2>
        <form action='configuration.php' method='post' class='formChoixComposant'>
            <h3>Filtrer </h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantRAM'>Fabricant: </label>
                <select name='choixFabricantRAM' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblMemoireVive as $fabricant){
                    if(!trouverdoublon($fabricant['fabricant'], $temp)){
                    echo "<option value='" . $fabricant['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                    array_push($temp, $fabricant['fabricant']);
                    }
                }
                unset($temp);
                echo "</select>
                <label for='nbBarretesRAM'>Nombre de barretes : </label>
                <select name='nbBarretesRAM' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblMemoireVive as $nbBarrettes){
                    if(!trouverdoublon($nbBarrettes['nbBarrettes'], $temp)){
                    echo "<option value='" . $nbBarrettes['nbBarrettes'] . "'>" . $nbBarrettes['nbBarrettes'] . "</option>";
                    array_push($temp, $nbBarrettes['nbBarrettes']);
                    }
                }
                unset($temp);
            
                echo "</select>
                <label for='frequenceRAM'>Frequence(MHz): </label>
                <select name='frequenceRAM' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblMemoireVive as $frequence){
                    if(!trouverdoublon($frequence['frequence'], $temp)){
                    echo "<option value='" . $frequence['frequence'] . "'>" . $frequence['frequence'] . "</option>";
                    array_push($temp, $frequence['frequence']);
                    }
                }
                unset($temp);
                echo "</select>
                <label for='typeMemoireRAM'>Type de Memoire: </label>
                <select name='typeMemoireRAM' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblMemoireVive as $typememoire){
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
        <form method ='post'>
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
                if(isset($_SESSION['ChoixMv'])){
                    $MvChoisi = $configManager->getRamChoisi($_SESSION['ChoixMv']);
                    echo 
                    "<h3>Composante choisie : </h3>
                    <tr class ='tblProduits'>
                    
                    <td>".$MvChoisi[0]['fabricant']."</td>
                    <td>".$MvChoisi[0]['modele']."</td>
                    <td>".$MvChoisi[0]['capacite']."</td>
                    <td>".$MvChoisi[0]['nbBarrettes']."</td>
                    <td>".$MvChoisi[0]['frequence']."</td>
                    <td>".$MvChoisi[0]['typememoire']."</td>
                    <td><input name='ChoixMv' type='submit' value='changer'></td>
                    </tr>
                    </table>";
                }else {
                    $tblenght = count($tblMemoireVive);
                    for ($i =0; $i < $tblenght; $i++){
                        echo "<tr class ='tblProduits'>
                        <td>".$tblMemoireVive[$i]['fabricant']."</td>
                        <td>".$tblMemoireVive[$i]['modele']."</td>
                        <td>".$tblMemoireVive[$i]['capacite']."</td>
                        <td>".$tblMemoireVive[$i]['nbBarrettes']."</td>
                        <td>".$tblMemoireVive[$i]['frequence']."</td>
                        <td>".$tblMemoireVive[$i]['typememoire']."</td>
                        <td><input name='ChoixMv' type='radio' value=".$tblMemoireVive[$i]['id']."></td>
                        </tr>";
                    }
                    echo " </table>
                <input type='submit' >";
                }
        echo "</form>";
        
    echo "</section>
    <hr>
    <section>
        <h2>Carte graphique (GPU) :</h2>
        <form action='configuration.php' method='post' class='formChoixComposant'>
            <h3>Filtrer </h3>

            <p class='selectChoixComposants'> 
                <label for='choixFabricantGPU'>Fabricant: </label>
                <select name='choixFabricantGPU' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblGpu as $fabricant){
                    if(!trouverdoublon($fabricant['fabricant'], $temp)){
                    echo "<option value='" . $fabricant['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                    array_push($temp, $fabricant['fabricant']);
                    }
                }
                unset($temp);
                echo "</select>
                <label for='baseClock'>base Clock (MHz) : </label>
                <select name='baseClock' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblGpu as $frequence){
                    if(!trouverdoublon($frequence['frequence'], $temp)){
                    echo "<option value='" . $frequence['frequence'] . "'>" . $frequence['frequence'] . "</option>";
                    array_push($temp, $frequence['frequence']);
                    }
                }
                unset($temp);

                echo "</select>
                <label for='chipsetGPU'>Chipset: </label>
                <select name='chipsetGPU' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblGpu as $chipset){
                    if(!trouverdoublon($chipset['chipset'], $temp)){
                    echo "<option value='" . $chipset['chipset'] . "'>" . $chipset['chipset'] . "</option>";
                    array_push($temp, $chipset['chipset']);
                    }
                }
                unset($temp);
                echo "</select>
                <label for='typeMemoireGpu'>Type de Memoire (VRAM): </label>
                <select name='typeMemoireGpu' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblGpu as $typememoireGpu){
                    if(!trouverdoublon($typememoireGpu['typeMemoire'], $temp)){
                    echo "<option value='" . $typememoireGpu['typeMemoire'] . "'>" . $typememoireGpu['typeMemoire'] . "</option>";
                    array_push($temp, $typememoireGpu['typeMemoire']);
                    }
                }
                unset($temp);
                echo " </select>
            </p>

            <label for='capaciteVRAM'>Capacite minimale VRAM (GB): </label>
            <input type='text' name='capaciteVRAM'>
            <p>
                <input type='submit'>
            </p>
        </form>";
        echo "
        <form method ='post'>
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
                if(isset($_SESSION['ChoixCg'])){
                    $choixCg = $configManager->getCarteGraphiqueChoisi($_SESSION['ChoixCg']);
                    echo 
                    
                    "<h3>Composante choisie : </h3>
                    <tr class ='tblProduits'>
                    <td>".$choixCg[0]['fabricant']."</td>
                    <td>".$choixCg[0]['modele']."</td>
                    <td>".$choixCg[0]['chipset']."</td>
                    <td>".$choixCg[0]['capacite']."</td>
                    <td>".$choixCg[0]['typeMemoire']."</td>
                    <td>".$choixCg[0]['frequence']."</td>
                    <td>".$choixCg[0]['frameSync']."</td>
                    <td>".$choixCg[0]['connecteur']."</td>
                        <td><input name='ChoixCg' type='submit' value='changer'></td>
                    </tr>
                    </table>";
                }else {
                    $tblenght = count($tblGpu);
                    for ($i =0; $i < $tblenght; $i++){
                        echo "<tr class ='tblProduits'>
                        <td>".$tblGpu[$i]['fabricant']."</td>
                        <td>".$tblGpu[$i]['modele']."</td>
                        <td>".$tblGpu[$i]['chipset']."</td>
                        <td>".$tblGpu[$i]['capacite']."</td>
                        <td>".$tblGpu[$i]['typeMemoire']."</td>
                        <td>".$tblGpu[$i]['frequence']."</td>
                        <td>".$tblGpu[$i]['frameSync']."</td>
                        <td>".$tblGpu[$i]['connecteur']."</td>
                        <td><input name='ChoixCg' type='radio' value=".$tblGpu[$i]['id']."></td>
                        </tr>";
                    }
                    echo " </table>
                <input type='submit' >";
                }
                 
        echo "</form>";
        
    echo "</section>
    <hr>
    <section>
        <h2>Système de refroidissement du processeur :</h2>
        <form action='configuration.php' method='post' class='formChoixComposant'>
            <h3>Filtrer </h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantCooler'>Fabricant: </label>
                <select name='choixFabricantCooler' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblCooler as $fabricant){
                    if(!trouverdoublon($fabricant['fabricant'], $temp)){
                    echo "<option value='" . $fabricant['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                    array_push($temp, $fabricant['fabricant']);
                    }
                }
                unset($temp);
                echo "</select>

                <label for='dimensionCooler'>Dimension (mm): </label>
                <select name='dimensionCooler' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblCooler as $dimension){
                    if(!trouverdoublon($dimension['dimension'], $temp)){
                    echo "<option value='" . $dimension['dimension'] . "'>" . $dimension['dimension'] . "</option>";
                    array_push($temp, $dimension['dimension']);
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
        <form method ='post'>
        <table class='tblProduits'>
                <tr class ='tblProduits'>
                    <th>Fabricant</th>
                    <th>Modele</th>
                    <th>Dimensions (mm)</th>
                    <th>selection</th>
                </tr>
                ";
                if(isset($_SESSION['ChoixCo'])){
                    $CoolerrChoisi = $configManager->getCoolerChoisi($_SESSION['ChoixCo']);
                    echo 
                    "<h3>Composante choisie : </h3>
                    <tr class ='tblProduits'>
                    <td>".$CoolerrChoisi[0]['fabricant']."</td>
                    <td>".$CoolerrChoisi[0]['modele']."</td>
                    <td>".$CoolerrChoisi[0]['dimension']."</td>
                    <td><input name='ChoixCo' type='submit' value='changer'></td>
                    </tr>
                    </table>";
                }else {
                    $tblenght = count($tblCooler);
                    for ($i =0; $i < $tblenght; $i++){
                        echo "<tr class ='tblProduits'>
                        <td>".$tblCooler[$i]['fabricant']."</td>
                        <td>".$tblCooler[$i]['modele']."</td>
                        <td>".$tblCooler[$i]['dimension']."</td>
                        <td><input name='ChoixCo' type='radio' value=".$tblCooler[$i]['id']."></td>
                        </tr>";
                    }
                    echo " </table>
                <input type='submit' >";
                }           
        echo "</form>";
        echo"
    </section>
    <hr>
    
    <section>
    <h2>Support de stockage  :</h2>
    <form action='configuration.php' method='post' class='formChoixComposant'>
        <h3>Filtrer </h3>
        <p class='selectChoixComposants'> 
            <label for='choixFabricantStockage'>Fabricant: </label>
            <select name='choixFabricantStockage' id=''>
            <option value='all' slected'>Tous/Toutes</option>";
            $temp = array();
            foreach ($tblStockage as $fabricant){
                if(!trouverdoublon($fabricant['fabricant'], $temp)){
                echo "<option value='" . $fabricant['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                array_push($temp, $fabricant['fabricant']);
                }
            }
            unset($temp);
            echo " </select>

            <label for='choixTypeStockage'> Type de stockage  : </label>
            <select name='choixTypeStockage' id=''>
            <option value='all' slected'>Tous/Toutes</option>";
            $temp = array();
            foreach ($tblStockage as $typeStockage){
                if(!trouverdoublon($typeStockage['typeStockage'], $temp)){
                echo "<option value='" . $typeStockage['typeStockage'] . "'>" . $typeStockage['typeStockage'] . "</option>";
                array_push($temp, $typeStockage['typeStockage']);
                }
            }
            unset($temp);
            echo "</select>
            <label for='connecterStockage'> Connecteur Stockage  : </label>
            <select name='connecterStockage' id=''>
            <option value='all' selected'>Tous/Toutes</option>";
            $temp = array();
            foreach ($tblStockage as $connecteur){
                if(!trouverdoublon($connecteur['connecteur'], $temp)){
                echo "<option value='" . $connecteur['connecteur'] . "'>" . $connecteur['connecteur'] . "</option>";
                array_push($temp, $connecteur['connecteur']);
                }
            }
            unset($temp);
            echo "</select>
            <label for='choixRMPStockage'> Vitesse de rotation (rpm): </label>
            <select name='choixRMPStockage' id=''>
            <option value='all' slected'>Tous/Toutes</option>";
            $temp = array();
            foreach ($tblStockage as $rpm){
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
        if(isset($_SESSION['ChoixSt'])){
            $choixStockage = $configManager->getStockageChoisi($_SESSION['ChoixSt']);
            echo 
            
            "<h3>Composante choisie : </h3>
            <tr class ='tblProduits'>
                <td>".$choixStockage[0]['fabricant']."</td>
                <td>".$choixStockage[0]['modele']."</td>
                <td>".$choixStockage[0]['typeStockage']."</td>
                <td>".$choixStockage[0]['capacite']."</td>
                <td>".$choixStockage[0]['rpm']."</td>
                <td>".$choixStockage[0]['connecteur']."</td>
                <td>".$choixStockage[0]['tauxTransfert']."</td>
                <td><input name='ChoixSt' type='submit' value='changer'></td>
            </tr>
            </table>";
        }else {
        $tblenght = count($tblStockage);
            for ($i =0; $i < $tblenght; $i++){
                echo "<tr class ='tblProduits'>
                <td>".$tblStockage[$i]['fabricant']."</td>
                <td>".$tblStockage[$i]['modele']."</td>
                <td>".$tblStockage[$i]['typeStockage']."</td>
                <td>".$tblStockage[$i]['capacite']."</td>
                <td>".$tblStockage[$i]['rpm']."</td>
                <td>".$tblStockage[$i]['connecteur']."</td>
                <td>".$tblStockage[$i]['tauxTransfert']."</td>
                <td><input name='ChoixSt' type='radio' value=".$tblStockage[$i]['id']."></td>
                </tr>";
            }
            echo " </table>
            <input type='submit' >";  
        }
echo "</form>";
    
echo "</section>
<hr>
<section>
        <h2>Boitier :</h2>

        <form action='configuration.php' method='post' class='formChoixComposant'>
            <h3>Filtrer </h3>
            <p class='selectChoixComposants'> 
                <label for='choixFabricantBoitier'>Fabricant: </label>
                <select name='choixFabricantBoitier' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblBoitier as $fabricant){
                    if(!trouverdoublon($fabricant['fabricant'], $temp)){
                    echo "<option value='" . $fabricant['fabricant'] . "'>" . $fabricant['fabricant'] . "</option>";
                    array_push($temp, $fabricant['fabricant']);
                    }
                }
                unset($temp);
                echo "</select>

                <label for='choixTypeBoitier'>Type de Boitier (forme): </label>
                <select name='choixTypeBoitier' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblBoitier as $typeboitier){
                    if(!trouverdoublon($typeboitier['forme'], $temp)){
                    echo "<option value='" . $typeboitier['forme'] . "'>" . $typeboitier['typeboitier'] . "</option>";
                    array_push($temp, $typeboitier['forme']);
                    }
                }
                unset($temp);
                echo "</select>

                <label for='choixFenetreBoitier'>Type de Fenêtre  : </label>
                <select name='choixFenetreBoitier' id=''>
                <option value='all' slected'>Tous/Toutes</option>";
                $temp = array();
                foreach ($tblBoitier as $typeFenetre){
                    if(!trouverdoublon($typeFenetre['typeFenetre'], $temp)){
                    echo "<option value='" . $typeFenetre['typeFenetre'] . "'>" . $typeFenetre['typeFenetre'] . "</option>";
                    array_push($temp, $typeFenetre['typeFenetre']);
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
            if(isset($_SESSION['ChoixB'])){
                $choixB = $configManager->getBoitierChoisi($_SESSION['ChoixB']);
                echo 
                "<h3>Composante choisie : </h3>
                <tr class ='tblProduits'>
                    <td>".$choixB[0]['fabricant']."</td>
                    <td>".$choixB[0]['modele']."</td>
                    <td>".$choixB[0]['forme']."</td>
                    <td>".$choixB[0]['typeFenetre']."</td>
                    <td>".$choixB[0]['supportusb']."</td>
                    <td><input name='ChoixB' type='submit' value='changer'></td>
                </tr>
                </table>";
            }else {
                $tblenght = count($tblBoitier);
                for ($i =0; $i < $tblenght; $i++){
                    echo "<tr class ='tblProduits'>
                        <td>".$tblBoitier[$i]['fabricant']."</td>
                        <td>".$tblBoitier[$i]['modele']."</td>
                        <td>".$tblBoitier[$i]['forme']."</td>
                        <td>".$tblBoitier[$i]['typeFenetre']."</td>
                        <td>".$tblBoitier[$i]['supportusb']."</td>
                        <td><input name='ChoixB' type='radio' value=".$tblBoitier[$i]['id']."></td>
                    </tr>";
                }
                echo " </table>
                <input type='submit' >";
            }    
        echo "</form>";
        
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



