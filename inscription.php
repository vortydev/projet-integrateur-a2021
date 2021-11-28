<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    echo 'inscription.php';
    require_once './inc/footer.php';
?>