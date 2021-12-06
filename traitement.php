<?php 
    require_once './class/PDOFactory.php';
    require_once './class/classClientManager.php';
    require_once './class/classClient.php';
    $bdd = PDOFactory::getMySQLConnection();
    $cm = new ClientManager($bdd);

    if (session_status() === PHP_SESSION_NONE) session_start();
        
    

    if (isset($_REQUEST['action'])){
        
        if($_REQUEST['action'] != 'inscription' && $_REQUEST['action'] != 'connexion')
            require_once './inc/header.php';

        if ($_REQUEST['action'] == "inscription"){
            //section entrer de donne client dans base de donne
            
            if($cm->emailVerification($_REQUEST['email']) && $_REQUEST['password'] == $_REQUEST['c_password'] && strlen($_REQUEST['c_password']) > 8) {

                $client_insert = new Client (1,$_REQUEST['prenom'],$_REQUEST['nom'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['dateNaissance'],$_REQUEST['adresse']);
                $_SESSION['idClient'] = $cm->addClient($client_insert);
                require_once './inc/header.php';
                echo '</br><h2>Bienvenue '. $_REQUEST['prenom'] . '</h2>';
            }
            else if ($cm->emailVerification($_REQUEST['email']) == false){
                
                $_SESSION['errorInscription'] = 'error1';
                require_once './inscription.php';
            }
            else if ($_REQUEST['password'] != $_REQUEST['c_password'])
            { 
                $_SESSION['errorInscription'] = 'error2';
                require_once './inscription.php';
                
            }
            else if (strlen($_REQUEST['password']) < 8)
            {
                $_SESSION['errorInscription'] = 'error3';
                require_once './inscription.php';
            }
            
        }
     
        else if ($_REQUEST['action'] == "connexion") {
            
            if($cm->connexionVerification($_REQUEST['co_email'],$_REQUEST['co_password']) == false)
            {
                $_SESSION['errorConnexion'] = 'error';
                require_once './connexion.php';
            }
            else {
                $results = $cm->connexionVerification($_REQUEST['co_email'],$_REQUEST['co_password']);
                $_SESSION['idClient'] = $results['id'];
                require_once './inc/header.php';
                echo '</br><h2>Bienvenue '. $results['prenom'] . '</h2>';
            }
        
        }
    }
    require_once './inc/footer.php';
?>