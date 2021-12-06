<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();

    $_SESSION['idClient'] = null;
    require_once './index.php';

?>