<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
require_once './class/PDOFactory.php';
require_once './inc/autoLoader.php';
    
$bdd = PDOFactory::getMySQLConnection();
$cm = new ClientManager($bdd);
$configManager = new ConfigurationManager($bdd);

// INSCRIPTION DU CLIENT
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "inscription") {

    if ($cm->emailVerification($_REQUEST['email']) && $_REQUEST['password'] == $_REQUEST['c_password'] && strlen($_REQUEST['c_password']) > 8) {
        $client_insert = new Client (1, $_REQUEST['prenom'],$_REQUEST['nom'],$_REQUEST['email'],$_REQUEST['password'],$_REQUEST['dateNaissance'],$_REQUEST['adresse']);
        $_SESSION['idClient'] = $cm->addClient($client_insert);
        require_once './inc/header.php';
        echo '<h1>Bienvenue '. $_REQUEST['prenom'] . '!</h1>';
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
// CONNEXION DU CLIENT 
else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "connexion") {
    
    if ($cm->connexionVerification($_REQUEST['co_email'],$_REQUEST['co_password']) == false)
    {
        $_SESSION['errorConnexion'] = 'error';
        require_once './connexion.php';
    }
    else {
        $results = $cm->connexionVerification($_REQUEST['co_email'],$_REQUEST['co_password']);
        $_SESSION['idClient'] = $results['id'];
        require_once './inc/header.php';
        echo '<h1>Bienvenue '. $results['prenom'] . '!</h1>';
    }
}
// SUPRESSION DE CONFIGURATION
else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete_config') {
    require_once './inc/header.php';
    $idConfig = $_POST['idConfig'];

    echo '<h1>La configuration #' . sprintf("%04d", $idConfig) . ' a été supprimée</h1>';
    echo '<h2><a href="./mesConfigurations.php">Retour</a></h2>';
    $configManager->deleteConfig($idConfig);
}

require_once './inc/footer.php';
?>