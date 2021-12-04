<?php 
    require_once './class/PDOFactory.php';
    require_once './class/classClientManager.php';

    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';

   
    if (isset($_REQUEST['action'])){
        if ($_REQUEST['action'] == "inscription"){
            //section entrer de donne client dans base de donne
            
            $bdd = PDOFactory::getMySQLConnection();
            $cm = new ClientManager($bdd);
           
            if($cm->emailVerification($_REQUEST['email']) && $_REQUEST['password'] == $_REQUEST['c_password']) {
                echo '<h2>' . $_REQUEST['nom'] . '</h2>';
                echo '<script>';
                echo 'console.log(1)';
                echo '</script>';
                $client_insert = new Client (1,$_REQUEST['prenom'],$_REQUEST['nom'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['dateNaissance'],$_REQUEST['adresse']);
                $_SESSION['idClient'] = $cm->addClient($client_insert);
                echo '</br><h2>Bienvenue'. $_REQUEST['prenom'] . '</h2>';
            }
            else if ($cm->emailVerification($_REQUEST['email']) == false){
                $_SESSION['error'] = 'error1';
                require_once './inscription.php';
            }
            else if ($_REQUEST['password'] != $_REQUEST['c_password'])
            { 
                require_once './inscription.php';
                $_SESSION['error'] = 'error2';
            }

            
        }
    } 
    else {}

    require_once './inc/footer.php';
?>