<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php'; 
?>

<h2>Connexion</h2>
<form action="connexion" method="post">

    <!-- <label for="courriel">Courriel: </label> -->
    <input type="text" name="co_email" placeholder="Votre adresse electronique">

    <!-- <label for="motDePasse">Mot de passe: </label> -->
    <input type="text" name="co_password" placeholder="Mot de passe" >

    <button type="submit">Se connecter</button>
</form>
    
    
    
<?php
    // echo 'connexion.php';
    require_once './inc/footer.php';
?>