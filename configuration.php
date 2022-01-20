<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    // loadClass("Configuration");
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
    
    echo '<h1>Configuration de votre machine</h1>';

    if (!isset($_SESSION['idClient'])) {
        echo '<h2>Veuillez vous <a href="./connexion.php">connecter</a> afin de pouvoir créer des configurations</h2>';
    } 
    else {
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

        if(isset($_POST['choixProcesseur']))
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
                'idClient' => $_SESSION['idClient'],
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

            echo "<h1>Configuration sauvegardée!</h1>";
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
            echo"<h2>Attention: Le socket du processeur et la carte mère ne sont pas compatibles!</h2>";
            }
        }
        //compatiblite Carte Mere et Memoire Vive
        if(isset($_SESSION['choixCarteMere']) && $_SESSION['choixCarteMere'] != 'Changer'&& isset($_SESSION['choixRam']) && $_SESSION['choixRam']!= 'Changer')
        {
            if(!$configManager->verificationCompatibilite($Cartechoisie[0]['typememoire'],$MvChoisi[0]['typememoire']))
            {
            echo"<h2>Attention: Le socket(type de memoire) de la memoire vive et la carte mere ne sont pas compatibles!</h2>";
            }
            if(!$configManager->verificationNbCompatibilite($Cartechoisie[0]['capaciteRam'],$MvChoisi[0]['capacite']))
            {
            echo"<h2>Attention: La capacite RAM de la carte mere et la memoire vive ne sont pas compatibles!</h2>";
            }
            if(!$configManager->verificationNbCompatibilite($Cartechoisie[0]['nbConnecteurRam'],$MvChoisi[0]['nbBarrettes']))
            {
            echo"<h2>Attention: Le nombre de connecteurs ram entre la carte mere et la memoire vive ne sont pas compatibles!</h2>";
            }
        }
        //compatibilite Boitier et Carte mere
        if(isset($_SESSION['choixCarteMere']) && $_SESSION['choixCarteMere'] != 'Changer'&& isset($_SESSION['choixBoitier']) && $_SESSION['choixBoitier']!= 'Changer')
        {
            if(!$configManager->verificationCompatibilite($Cartechoisie[0]['forme'],$choixBoitier[0]['forme']))
            {
            echo"<h2>Attention: La forme du boitier et la carte mere ne sont pas compatibles!</h2>";
            }
        }
        
    // CARTE MÈRE
    $hidden = isset($_SESSION['choixCarteMere'])? $hidden = ' hidden':'';
    echo '<section>
        <article class="config_filtre'. $hidden .'">
            <form action="configuration.php" method="post">
            <table>
                <tr><td colspan=2 class="table_top"><h2>Carte mère</h2></td></tr>
               
                <tr class="pale">
                    <td><label for="choixFabricantCarte">Fabricant</label></td>
                    <td><select id="choixFabricantCarte" name="choixFabricantCarte">
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblCarteMere as $choixFabricantCarte){
                            if (!trouverdoublon($choixFabricantCarte['fabricant'], $temp)) {
                                echo '<option value="' . $choixFabricantCarte['fabricant'] . '">' . $choixFabricantCarte['fabricant'] . '</option>';
                                array_push($temp, $choixFabricantCarte['fabricant']);
                            }
                        }
                        unset($temp); 
                    echo '</select></td>
                </tr>
                <tr>
                    <td><label for="choixSocketCarte">Choix de socket</label></td>
                    <td><select id="choixSocketCarte" name="choixSocketCarte" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblCarteMere as $choixSocketCarte){
                            if (!trouverdoublon($choixSocketCarte['socket'], $temp)) {
                                echo"<option value='" . $choixSocketCarte['socket'] . "'>" . $choixSocketCarte['socket'] . "</option>";
                                array_push($temp, $choixSocketCarte['socket']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr class="pale">
                    <td><label for="nbConnecteruRAM">Nombre de connecteurs RAM</label></td>
                    <td><select id="nbConnecteruRAM" name="nbConnecteruRAM" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblCarteMere as $nbConnecteruRAM){
                            if (!trouverdoublon($nbConnecteruRAM['nbConnecteurRam'], $temp)) {
                                echo"<option value='" . $nbConnecteruRAM['nbConnecteurRam'] . "'>" . $nbConnecteruRAM['nbConnecteurRam'] . "</option>";
                                array_push($temp, $nbConnecteruRAM['nbConnecteurRam']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr>
                    <td><label for="nbCapaciteRAM">Capacité de RAM minimale</label></td>
                    <td><input id="nbCapaciteRAM" type="number" name="nbCapaciteRAM"></td>
                </tr>
                <tr class="pale">
                    <td>WiFi inclus</td>
                    <td>
                        <label for="wifiInclusO">Oui</label>
                        <input id="wifiInclusO" name="wifiInclus" type="radio" value ="Oui">
                        <label for="wifiInclusN">Non</label>
                        <input id="wifiInclusN" name="wifiInclus" type="radio" value="Non">
                    </td>
                </tr>
            </table>
            <button class="btn_filtre" type="submit" value="Filtrer">Filtrer</button>
            </form>
        </article>';

        // tableau des résultats des filtres
        echo '<article class="config_result">
            <form method="post">
            <table>';
            if (isset($_SESSION['choixCarteMere'])) {
                echo '<tr><td class="table_top" colspan=11><h2>Carte mère choisie</h2></td></tr>';
            }
            echo '<tr>
                    <th>Fabricant</th>
                    <th>Modèle</th>
                    <th>Forme</th>
                    <th>Socket</th>
                    <th>Chipset</th>
                    <th>Capacité RAM</th>
                    <th>Type de mémoire</th>
                    <th>Nombre de connecteurs RAM</th>
                    <th>WiFi</th>
                    <th>USB compatibles</th>
                    <th>Sélection</th>
                </tr>';
                if (isset($_SESSION['choixCarteMere'])) {
                echo '
                    <tr class="pale">
                        <td>'.$Cartechoisie[0]['fabricant'].'</td>
                        <td>'.$Cartechoisie[0]['modele'].'</td>
                        <td>'.$Cartechoisie[0]['forme'].'</td>
                        <td>'.$Cartechoisie[0]['socket'].'</td>
                        <td>'.$Cartechoisie[0]['chipset'].'</td>
                        <td>'.$Cartechoisie[0]['capaciteRam'].'</td>
                        <td>'.$Cartechoisie[0]['typememoire'].'</td>
                        <td>'.$Cartechoisie[0]['nbConnecteurRam'].'</td>
                        <td>'.$Cartechoisie[0]['wifi'].'</td>
                        <td>'.$Cartechoisie[0]['supportusb'].'</td>
                        <td><button class="btn_change" name="choixCarteMere" type="submit" value="Changer">Changer</button></td>
                    </tr></table>';
                }
                else {
                    $tblenght = sizeof($tblCarteMere);
                    for ($i = 0; $i < $tblenght; $i++) {
                        $pale = '';
                        $i % 2 == 0 ? $pale = ' class="pale"':''; 
                        echo '<tr'. $pale. '>
                                <td>'.$tblCarteMere[$i]['fabricant'].'</td>
                                <td>'.$tblCarteMere[$i]['modele'].'</td>
                                <td>'.$tblCarteMere[$i]['forme'].'</td>
                                <td>'.$tblCarteMere[$i]['socket'].'</td>
                                <td>'.$tblCarteMere[$i]['chipset'].'</td>
                                <td>'.$tblCarteMere[$i]['capaciteRam'].'</td>
                                <td>'.$tblCarteMere[$i]['typememoire'].'</td>
                                <td>'.$tblCarteMere[$i]['nbConnecteurRam'].'</td>
                                <td>'.$tblCarteMere[$i]['wifi'].'</td>
                                <td>'.$tblCarteMere[$i]['supportusb'].'</td>
                                <td><input name="choixCarteMere" type="radio" value="'.$tblCarteMere[$i]['id'].'"></td>
                            </tr>';
                    }
                    echo '</table><button class="btn_confirm" type="submit" value="Confirmer">Confirmer la sélection</button>';
                }
    echo '</form></article></section>';
        
    // PROCESSEUR
    $hidden = isset($_SESSION['choixProcesseur'])? $hidden = ' hidden':'';
    echo '<section>
        <article class="config_filtre'. $hidden .'">
            <form action="configuration.php" method="post">
            <table>
            <tr><td colspan=2 class="table_top"><h2>Processeur</h2></td></tr>
            <tr class="pale">
                <td><label for="choixFabricantProcesseur">Fabricant</label></td>
                <td><select id="choixFabricantProcesseur" name="choixFabricantProcesseur">
                    <option value="all" selected>Tous / Toutes</option>';
                    $temp = array();
                    foreach ($tblProcesseur as $fabricants){
                        if(!trouverdoublon($fabricants['fabricant'], $temp)){
                            echo '<option value="' . $fabricants['fabricant'] . '">' . $fabricants['fabricant'] . '</option>';
                            array_push($temp, $fabricants['fabricant']);
                        }
                    }
                    unset($temp); 
                echo '</select></td>
            </tr>
            <tr>
                <td><label for="nbCoeurs">Nombre de coeurs physique</label></td>
                <td><select id="nbCoeurs" name="nbCoeurs" >
                    <option value="all" selected>Tous / Toutes</option>';
                    $temp = array();
                    foreach ($tblProcesseur as $nbCoeurs){
                        if (!trouverdoublon($nbCoeurs['nbCoeurs'], $temp)) {
                            echo '<option value="' . $nbCoeurs['nbCoeurs'] . '">' . $nbCoeurs['nbCoeurs'] . '</option>';
                            array_push($temp, $nbCoeurs['nbCoeurs']);
                        }
                    }
                    unset($temp);
                echo '</select></td>
            </tr>
            <tr class="pale">
                <td><label for="typeSocketProcessue">Type de socket</label></td>
                <td><select id="typeSocketProcessue" name="typeSocketProcessue" >
                <option value="all" selected>Tous / Toutes</option>';
                $temp = array();
                foreach ($tblProcesseur as $socket){
                    if (!trouverdoublon($socket['socket'], $temp)) {
                        echo '<option value="' . $socket['socket'] . '">' . $socket['socket'] . '</option>';
                        array_push($temp, $socket['socket']);
                    }
                }
                unset($temp);
                echo '</select></td>
            </tr>
            <tr>
                <td><label for="frequenceProcesseur">Fréquence minimale (GHz)</label></td>
                <td><input id="frequenceProcesseur" name="frequenceProcesseur" type="number"></td>
            </tr>
            </table>
            <button class="btn_filtre" type="submit" value="Filtrer">Filtrer</button>
            </form>
        </article>';

        // tableau de résultats
        echo '<article class="config_result">
        <form method="post">
            <table>';
            if (isset($_SESSION['choixProcesseur'])) {
                echo '<tr><td class="table_top" colspan=6><h2>Processeur choisi</h2></td></tr>';
            }
            echo '<tr>
                <th>Fabricant</th>
                <th>Modèle</th>
                <th>Nombre de coeurs physiques</th>
                <th>Frequence (GHz)</th>
                <th>Socket</th>
                <th>Sélection</th>
            </tr>';
            if (isset($_SESSION['choixProcesseur'])){
                echo '
                    <tr class="pale">
                        <td>'.$processeurChoisi[0]['fabricant'].'</td>
                        <td>'.$processeurChoisi[0]['modele'].'</td>
                        <td>'.$processeurChoisi[0]['nbCoeurs'].'</td>
                        <td>'.$processeurChoisi[0]['frequence'].'</td>
                        <td>'.$processeurChoisi[0]['socket'].'</td>
                        <td><button class="btn_change" name="choixProcesseur" type="submit" value="Changer">Changer</button></td>
                    </tr></table>';
            }
            else {
                $tblenght = count($tblProcesseur);
               
                for ($i = 0; $i < $tblenght; $i++) {
                    $pale = '';
                    $i % 2 == 0 ? $pale = ' class="pale"':''; 
                    echo '<tr'. $pale. '>
                        <td>'.$tblProcesseur[$i]['fabricant'].'</td>
                        <td>'.$tblProcesseur[$i]['modele'].'</td>
                        <td>'.$tblProcesseur[$i]['nbCoeurs'].'</td>
                        <td>'.$tblProcesseur[$i]['frequence'].'</td>
                        <td>'.$tblProcesseur[$i]['socket'].'</td>
                        <td><input name="choixProcesseur" type="radio" value="'.$tblProcesseur[$i]['id'].'"></td>
                    </tr>';
                }
                echo '</table><button class="btn_confirm" type="submit" value="Confirmer">Confirmer la sélection</button>';
            }
    echo '</form></article></section>';

    // COOLER
    $hidden = isset($_SESSION['choixCooler'])? $hidden = ' hidden':'';
    echo '<section>
        <form action="configuration.php" method="post">
        <article class="config_filtre'.$hidden.'">
            <table>
                <tr><td colspan=2 class="table_top"><h2>Système de refroidissement</h2></td></tr>
                <tr class="pale">
                    <td><label for="choixFabricantCooler">Fabricant</label></td>
                    <td><select id="choixFabricantCooler" name="choixFabricantCooler">
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblCooler as $fabricant){
                            if (!trouverdoublon($fabricant['fabricant'], $temp)) {
                                echo '<option value="' . $fabricant['fabricant'] . '">' . $fabricant['fabricant'] . '</option>';
                                array_push($temp, $fabricant['fabricant']);
                            }
                        }
                        unset($temp); 
                    echo '</select></td>
                </tr>
                <tr>
                    <td><label for="dimensionCooler">Dimensions (mm)</label></td>
                    <td><select id="dimensionCooler" name="dimensionCooler" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblCooler as $dimension){
                            if (!trouverdoublon($dimension['dimension'], $temp)) {
                                echo"<option value='" . $dimension['dimension'] . "'>" . $dimension['dimension'] . "</option>";
                                array_push($temp, $dimension['dimension']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
            </table>
            <button class="btn_filtre" type="submit" value="Filtrer">Filtrer</button>
            
        </article></form>';

        // tableau des résultats des filtres
        echo '<article class="config_result">
            <form method="post">
            <table>';
            if (isset($_SESSION['choixCooler'])) {
                echo '<tr><td class="table_top" colspan=4><h2>Système de refroidissement choisi</h2></td></tr>';
            }
            echo '<tr>
                    <th>Fabricant</th>
                    <th>Modèle</th>
                    <th>Dimensions (mm)</th>
                    <th>Sélection</th>
                </tr>';
                if (isset($_SESSION['choixCooler'])) {
                echo '
                    <tr class="pale">
                        <td>'.$CoolerrChoisi[0]['fabricant'].'</td>
                        <td>'.$CoolerrChoisi[0]['modele'].'</td>
                        <td>'.$CoolerrChoisi[0]['dimension'].'</td>
                        <td><button class="btn_change" name="choixCooler" type="submit" value="Changer">Changer</button></td>
                    </tr></table>';
                }
                else {
                    $tblenght = sizeof($tblCooler);
                    echo '';
                    for ($i = 0; $i < $tblenght; $i++) {
                        $pale = '';
                        $i % 2 == 0 ? $pale = ' class="pale"':''; 
                        echo '<tr'. $pale. '>
                                <td>'.$tblCooler[$i]['fabricant'].'</td>
                                <td>'.$tblCooler[$i]['modele'].'</td>
                                <td>'.$tblCooler[$i]['dimension'].'</td>
                                <td><input name="choixCooler" type="radio" value="'.$tblCooler[$i]['id'].'"></td>
                            </tr>';
                    }
                    echo '</table><button class="btn_confirm" type="submit" value="Confirmer">Confirmer la sélection</button>';
                }
    echo '</form></article>
    </section>';

    // MÉMOIRE VIVE
    $hidden = isset($_SESSION['choixRam'])? $hidden = ' hidden':'';
    echo '<section>
        <form action="configuration.php" method="post">
        <article class="config_filtre'.$hidden.'">
            <table>
                <tr><td colspan=2 class="table_top"><h2>Mémoire vive</h2></td></tr>
                
                <tr class="pale">
                    <td><label for="choixFabricantRAM">Fabricant</label></td>
                    <td><select id="choixFabricantRAM" name="choixFabricantRAM">
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblMemoireVive as $fabricant){
                            if (!trouverdoublon($fabricant['fabricant'], $temp)) {
                                echo '<option value="' . $fabricant['fabricant'] . '">' . $fabricant['fabricant'] . '</option>';
                                array_push($temp, $fabricant['fabricant']);
                            }
                        }
                        unset($temp); 
                    echo '</select></td>
                </tr>
                <tr>
                    <td><label for="nbBarretesRAM">Nombre de barrettes</label></td>
                    <td><select id="nbBarretesRAM" name="nbBarretesRAM" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblMemoireVive as $nbBarrettes){
                            if (!trouverdoublon($nbBarrettes['nbBarrettes'], $temp)) {
                                echo"<option value='" . $nbBarrettes['nbBarrettes'] . "'>" . $nbBarrettes['nbBarrettes'] . "</option>";
                                array_push($temp, $nbBarrettes['nbBarrettes']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr class="pale">
                    <td><label for="frequenceRAM">Fréquence (MHz)</label></td>
                    <td><select id="frequenceRAM" name="frequenceRAM" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblMemoireVive as $frequence){
                            if (!trouverdoublon($frequence['frequence'], $temp)) {
                                echo"<option value='" . $frequence['frequence'] . "'>" . $frequence['frequence'] . "</option>";
                                array_push($temp, $frequence['frequence']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr>
                    <td><label for="typeMemoireRAM">Type de mémoire</label></td>
                    <td><select id="typeMemoireRAM" name="typeMemoireRAM" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblMemoireVive as $typememoire){
                            if (!trouverdoublon($typememoire['typememoire'], $temp)) {
                                echo"<option value='" . $typememoire['typememoire'] . "'>" . $typememoire['typememoire'] . "</option>";
                                array_push($temp, $typememoire['typememoire']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr class="pale">
                    <td><label for="capaciteRAM">Capacité minimale (GB)</label></td>
                    <td><input id="capaciteRAM" type="number" name="capaciteRAM"></tr>
            </table>
            <button class="btn_filtre" type="submit" value="Filtrer">Filtrer</button>
            
        </article></form>';

        // tableau des résultats des filtres
        echo '<article class="config_result">
         <form method="post">
            <table>';
            if (isset($_SESSION['choixRam'])) {
                echo '<tr><td class="table_top" colspan=7><h2>Mémoire vive choisie</h2></td></tr>';
            }
            echo '<tr>
                    <th>Fabricant</th>
                    <th>Modèle</th>
                    <th>Capacité (GB)</th>
                    <th>Nombre de barrettes</th>
                    <th>Fréquence (HMz)</th>
                    <th>Type de mémoire</th>
                    <th>Sélection</th>
                </tr>';
                if (isset($_SESSION['choixRam'])) {
                echo '
                    <tr class="pale">
                        <td>'.$MvChoisi[0]['fabricant'].'</td>
                        <td>'.$MvChoisi[0]['modele'].'</td>
                        <td>'.$MvChoisi[0]['capacite'].'</td>
                        <td>'.$MvChoisi[0]['nbBarrettes'].'</td>
                        <td>'.$MvChoisi[0]['frequence'].'</td>
                        <td>'.$MvChoisi[0]['typememoire'].'</td>
                        <td><button class="btn_change" name="choixRam" type="submit" value="Changer">Changer</button></td>
                    </tr></table>';
                }
                else {
                    $tblenght = sizeof($tblMemoireVive);
             
                    for ($i = 0; $i < $tblenght; $i++) {
                        $pale = '';
                        $i % 2 == 0 ? $pale = ' class="pale"':''; 
                        echo '<tr'. $pale. '>
                                <td>'.$tblMemoireVive[$i]['fabricant'].'</td>
                                <td>'.$tblMemoireVive[$i]['modele'].'</td>
                                <td>'.$tblMemoireVive[$i]['capacite'].'</td>
                                <td>'.$tblMemoireVive[$i]['nbBarrettes'].'</td>
                                <td>'.$tblMemoireVive[$i]['frequence'].'</td>
                                <td>'.$tblMemoireVive[$i]['typememoire'].'</td>
                                <td><input name="choixRam" type="radio" value="'.$tblMemoireVive[$i]['id'].'"></td>
                            </tr>';
                    }
                    echo '</table><button class="btn_confirm" type="submit" value="Confirmer">Confirmer la sélection</button>';
                }
    echo '</form></article></section>';

    // SUPPORT DE STOCKAGE
    $hidden = isset($_SESSION['choixStockage'])? $hidden = ' hidden':'';
    echo '<section>
        <article class="config_filtre'.$hidden.'">
        <form action="configuration.php" method="post">
            <table>
                <tr><td colspan=2 class="table_top"><h2>Support de stockage</h2></td></tr>
                
                <tr class="pale">
                    <td><label for="choixFabricantStockage">Fabricant</label></td>
                    <td><select id="choixFabricantStockage" name="choixFabricantStockage">
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblStockage as $fabricant){
                            if (!trouverdoublon($fabricant['fabricant'], $temp)) {
                                echo '<option value="' . $fabricant['fabricant'] . '">' . $fabricant['fabricant'] . '</option>';
                                array_push($temp, $fabricant['fabricant']);
                            }
                        }
                        unset($temp); 
                    echo '</select></td>
                </tr>
                <tr>
                    <td><label for="choixTypeStockage">Type de stockage</label></td>
                    <td><select id="choixTypeStockage" name="choixTypeStockage" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblStockage as $typeStockage){
                            if (!trouverdoublon($typeStockage['typeStockage'], $temp)) {
                                echo"<option value='" . $typeStockage['typeStockage'] . "'>" . $typeStockage['typeStockage'] . "</option>";
                                array_push($temp, $typeStockage['typeStockage']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr class="pale">
                    <td><label for="connecterStockage">Connecteur du support</label></td>
                    <td><select id="connecterStockage" name="connecterStockage" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblStockage as $connecteur){
                            if (!trouverdoublon($connecteur['connecteur'], $temp)) {
                                echo"<option value='" . $connecteur['connecteur'] . "'>" . $connecteur['connecteur'] . "</option>";
                                array_push($temp, $connecteur['connecteur']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr>
                    <td><label for="choixRMPStockage">Vitesse de rotation du disque</label></td>
                    <td><select id="choixRMPStockage" name="choixRMPStockage" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblStockage as $rpm){
                            if (!trouverdoublon($rpm['rpm'], $temp)) {
                                echo"<option value='" . $rpm['rpm'] . "'>" . $rpm['rpm'] . "</option>";
                                array_push($temp, $rpm['rpm']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr class="pale">
                    <td><label for="choixCapaciteStockage">Capacité minimale (GB)</label></td>
                    <td><input id="choixCapaciteStockage" type="number" name="choixCapaciteStockage"></td>
                </tr>
                <tr>
                    <td><label for="choixTransferStockage">Taux de transfert minimal (mo/s)</label></td>
                    <td><input id="choixTransferStockage" type="number" name="choixTransferStockage"></td>
                </tr>
            </table>
            <button class="btn_filtre" type="submit" value="Filtrer">Filtrer</button>
            
            </form></article>';

        // tableau des résultats des filtres
        echo '<article class="config_result">
            <form method="post">
            <table>';
            if (isset($_SESSION['choixStockage'])) {
                echo '<tr><td class="table_top" colspan=8><h2>Support de stockage choisi</h2></td></tr>';
            }
            echo '<tr>
                    <th>Fabricant</th>
                    <th>Modèle</th>
                    <th>Type de stockage</th>
                    <th>Capacité</th>
                    <th>Vitesse de rotation (rpm)</th>
                    <th>Connecteur</th>
                    <th>Taux de transfert (mo/s)</th>
                    <th>Sélection</th>
                </tr>';
                if (isset($_SESSION['choixStockage'])) {
                echo '
                    <tr class="pale">
                        <td>'.$choixStockageockage[0]['fabricant'].'</td>
                        <td>'.$choixStockageockage[0]['modele'].'</td>
                        <td>'.$choixStockageockage[0]['typeStockage'].'</td>
                        <td>'.$choixStockageockage[0]['capacite'].'</td>
                        <td>'.$choixStockageockage[0]['rpm'].'</td>
                        <td>'.$choixStockageockage[0]['connecteur'].'</td>
                        <td>'.$choixStockageockage[0]['tauxTransfert'].'</td>
                        <td><button class="btn_change" name="choixStockage" type="submit" value="Changer">Changer</button></td>
                    </tr></table>';
                }
                else {
                    $tblenght = sizeof($tblStockage);
        
                    for ($i = 0; $i < $tblenght; $i++) {
                        $pale = '';
                        $i % 2 == 0 ? $pale = ' class="pale"':''; 
                        echo '<tr'. $pale. '>
                                <td>'.$tblStockage[$i]['fabricant'].'</td>
                                <td>'.$tblStockage[$i]['modele'].'</td>
                                <td>'.$tblStockage[$i]['typeStockage'].'</td>
                                <td>'.$tblStockage[$i]['capacite'].'</td>
                                <td>'.$tblStockage[$i]['rpm'].'</td>
                                <td>'.$tblStockage[$i]['connecteur'].'</td>
                                <td>'.$tblStockage[$i]['tauxTransfert'].'</td>
                                <td><input name="choixStockage" type="radio" value="'.$tblStockage[$i]['id'].'"></td>
                            </tr>';
                    }
                    echo '</table><button class="btn_confirm" type="submit" value="Confirmer">Confirmer la sélection</button>';
                }
    echo '</form></article></section>';

    // CARTE GRAPHIQUE
    $hidden = isset($_SESSION['choixCarteGraphique'])? $hidden = ' hidden':'';
    echo '<section>
        <form action="configuration.php" method="post">
        <article class="config_filtre'.$hidden.'">
            <table>
                <tr><td colspan=2 class="table_top"><h2>Carte graphqiue</h2></td></tr>
                <tr class="pale">
                    <td><label for="choixFabricantGPU">Fabricant</label></td>
                    <td><select id="choixFabricantGPU" name="choixFabricantGPU">
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblGpu as $fabricant){
                            if (!trouverdoublon($fabricant['fabricant'], $temp)) {
                                echo '<option value="' . $fabricant['fabricant'] . '">' . $fabricant['fabricant'] . '</option>';
                                array_push($temp, $fabricant['fabricant']);
                            }
                        }
                        unset($temp); 
                    echo '</select></td>
                </tr>
                <tr>
                    <td><label for="baseClock">Fréquence de base (MHz)</label></td>
                    <td><select id ="baseClock" name="baseClock" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblGpu as $frequence){
                            if (!trouverdoublon($frequence['frequence'], $temp)) {
                                echo"<option value='" . $frequence['frequence'] . "'>" . $frequence['frequence'] . "</option>";
                                array_push($temp, $frequence['frequence']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr class="pale">
                    <td><label for="chipsetGPU">Chipset</label></td>
                    <td><select id="chipsetGPU" name="chipsetGPU" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblGpu as $chipset){
                            if (!trouverdoublon($chipset['chipset'], $temp)) {
                                echo"<option value='" . $chipset['chipset'] . "'>" . $chipset['chipset'] . "</option>";
                                array_push($temp, $chipset['chipset']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr>
                    <td><label for="typeMemoireGpu">Type de mémoire</label></td>
                    <td><select id="typeMemoireGpu" name="typeMemoireGpu" >
                        <option value="all" selected>Tous / Toutes</option>';
                        $temp = array();
                        foreach ($tblGpu as $typememoireGpu){
                            if (!trouverdoublon($typememoireGpu['typeMemoire'], $temp)) {
                                echo"<option value='" . $chipset['typeMemoire'] . "'>" . $typememoireGpu['typeMemoire'] . "</option>";
                                array_push($temp, $typememoireGpu['typeMemoire']);
                            }
                        }
                        unset($temp);
                    echo '</select></td>
                </tr>
                <tr class="pale">
                    <td><label for="capaciteVRAM">Capacité minimale (GB)</label></td>
                    <td><input id="capaciteVRAM" name="capaciteVRAM" type="number"></td>
                </tr>
            </table>
            <button class="btn_filtre" type="submit" value="Filtrer">Filtrer</button>
            
        </article></form>';

        // tableau des résultats des filtres
        echo '<article class="config_result">
        <form method="post">
            <table>';
            if (isset($_SESSION['choixCarteGraphique'])) {
                echo '<tr><td class="table_top" colspan=9><h2>Carte graphique choisie</h2></td></tr>';
            }
            echo '<tr>
                    <th>Fabricant</th>
                    <th>Modèle</th>
                    <th>Chipset</th>
                    <th>Capacité (GB)</th>
                    <th>Type de mémoire</th>
                    <th>Fréquence (MHz)</th>
                    <th>Technologie FrameSync</th>
                    <th>Connecteur</th>
                    <th>Sélection</th>
                </tr>';
                if (isset($_SESSION['choixCarteGraphique'])) {
                echo '
                    <tr class="pale">
                        <td>'.$choixCarteGraphique[0]['fabricant'].'</td>
                        <td>'.$choixCarteGraphique[0]['modele'].'</td>
                        <td>'.$choixCarteGraphique[0]['chipset'].'</td>
                        <td>'.$choixCarteGraphique[0]['capacite'].'</td>
                        <td>'.$choixCarteGraphique[0]['typeMemoire'].'</td>
                        <td>'.$choixCarteGraphique[0]['frequence'].'</td>
                        <td>'.$choixCarteGraphique[0]['frameSync'].'</td>
                        <td>'.$choixCarteGraphique[0]['connecteur'].'</td>
                        <td><button class="btn_change" name="choixCarteGraphique" type="submit" value="Changer">Changer</button></td>
                    </tr></table>';
                }
                else {
                    $tblenght = sizeof($tblGpu);
                    for ($i = 0; $i < $tblenght; $i++) {
                        $pale = '';
                        $i % 2 == 0 ? $pale = ' class="pale"':''; 
                        echo '<tr'. $pale. '>
                                <td>'.$tblGpu[$i]['fabricant'].'</td>
                                <td>'.$tblGpu[$i]['modele'].'</td>
                                <td>'.$tblGpu[$i]['chipset'].'</td>
                                <td>'.$tblGpu[$i]['capacite'].'</td>
                                <td>'.$tblGpu[$i]['typeMemoire'].'</td>
                                <td>'.$tblGpu[$i]['frequence'].'</td>
                                <td>'.$tblGpu[$i]['frameSync'].'</td>
                                <td>'.$tblGpu[$i]['connecteur'].'</td>
                                <td><input name="choixCarteGraphique" type="radio" value="'.$tblGpu[$i]['id'].'"></td>
                            </tr>';
                    }
                    echo '</table><button class="btn_confirm" type="submit" value="Confirmer">Confirmer la sélection</button>';
                }
    echo '</form>
        </article>
    </section>';
            
    // BOITIER
    $hidden = isset($_SESSION['choixBoitier'])? $hidden = ' hidden':'';
    echo '<section>
        
        <article class="config_filtre'.$hidden.'">
            <form action="configuration.php" method="post">
            <table>
            <tr><td colspan=2 class="table_top"><h2>Boitier</h2></td></tr>
            <tr class="pale">
                <td><label for="choixFabricantBoitier">Type de boitier (Forme)</label></td>
                <td><select id="choixFabricantBoitier" name="choixFabricantBoitier">
                    <option value="all" selected>Tous / Toutes</option>';
                    $temp = array();
                    foreach ($tblBoitier as $formeB){
                        if(!trouverdoublon($formeB['fabricant'], $temp)){
                            echo '<option value="' . $formeB['fabricant'] . '">' . $formeB['fabricant'] . '</option>';
                            array_push($temp, $formeB['fabricant']);
                        }
                    }
                    unset($temp); 
                echo '</select></td>
            </tr>
            <tr>
                <td><label for="choixFenetreBoitier">type de fenêtre latérale</label></td>
                <td><select id="choixFenetreBoitier" name="choixFenetreBoitier" >
                    <option value="all" selected>Tous / Toutes</option>';
                    $temp = array();
                    foreach ($tblBoitier as $typeFenetre){
                        if (!trouverdoublon($typeFenetre['typeFenetre'], $temp)) {
                            echo '<option value="' . $typeFenetre['typeFenetre'] . '">' . $typeFenetre['typeFenetre'] . '</option>';
                            array_push($temp, $typeFenetre['typeFenetre']);
                        }
                    }
                    unset($temp);
                echo '</select></td>
            </tr>
            </table>
            <button class="btn_filtre" type="submit" value="Filtrer">Filtrer</button>
            
            </form>
        </article>
        ';

        // tableau de résultats
        echo '<article class="config_result">
            <form action="configuration.php" method="post">
            <table>';
            if (isset($_SESSION['choixBoitier'])) {
                echo '<tr><td class="table_top" colspan=6><h2>Boitier choisi</h2></td></tr>';
            }
            echo '<tr>
                <th>Fabricant</th>
                <th>Modèle</th>
                <th>Type de boitier (Forme)</th>
                <th>Type de fenêtre latérale</th>
                <th>Paneau USB</th>
                <th>Sélection</th>
            </tr>';
            if (isset($_SESSION['choixBoitier'])){
                echo '
                    <tr class="pale">
                        <td>'.$choixBoitier[0]['fabricant'].'</td>
                        <td>'.$choixBoitier[0]['modele'].'</td>
                        <td>'.$choixBoitier[0]['forme'].'</td>
                        <td>'.$choixBoitier[0]['typeFenetre'].'</td>
                        <td>'.$choixBoitier[0]['supportusb'].'</td>
                        <td><button class="btn_change" name="choixBoitier" type="submit" value="Changer">Changer</button></td>
                    </tr></table>';
            }
            else {
                $tblenght = count($tblBoitier);
           
                for ($i = 0; $i < $tblenght; $i++) {
                    $pale = '';
                    $i % 2 == 0 ? $pale = ' class="pale"':''; 
                    echo '<tr'. $pale. '>
                        <td>'.$tblBoitier[$i]['fabricant'].'</td>
                        <td>'.$tblBoitier[$i]['modele'].'</td>
                        <td>'.$tblBoitier[$i]['forme'].'</td>
                        <td>'.$tblBoitier[$i]['typeFenetre'].'</td>
                        <td>'.$tblBoitier[$i]['supportusb'].'</td>
                        <td><input name="choixBoitier" type="radio" value="'.$tblBoitier[$i]['id'].'"></td>
                    </tr>';
                }
                echo '</table><button class="btn_confirm" type="submit" value="Confirmer">Confirmer la sélection</button>';
            }
    echo '</form></article></section>';

        if(isset($_SESSION['choixCarteMere']) && $_SESSION['choixCarteMere'] != 'Changer' && isset($_SESSION['choixProcesseur']) && $_SESSION['choixProcesseur'] != 'Changer' && isset($_SESSION['choixRam']) && $_SESSION['choixRam'] != 'Changer' && isset($_SESSION['choixCarteGraphique']) && $_SESSION['choixCarteGraphique'] != 'Changer' && isset($_SESSION['choixCooler']) && $_SESSION['choixCooler'] != 'Changer' && isset($_SESSION['choixStockage']) && $_SESSION['choixStockage'] != 'Changer' &&  isset($_SESSION['choixBoitier']) && $_SESSION['choixBoitier'] != 'Changer' ){
            echo'
            <form class="saveform" action="configuration.php" method="post">
                <button class="btn_save" type="submit" name="save" value="Sauvegarder la configuration">Sauvegarder la configuration</button>
            </form>';
        }
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