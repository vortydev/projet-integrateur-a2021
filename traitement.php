<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    echo 'traitement.php';
   
    if (isset($_REQUEST['action'])){
        if ($_REQUEST['action'] == "inscription"){
            //section entrer de donne client dans base de donne
            
            
            $new_Client = new Client ()
        }
    } 
    else {}

    require_once './inc/footer.php';
?>