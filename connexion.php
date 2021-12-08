<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php'; 
?>

<section class="connexion" id="formulaire_connexion">
    <h2>Connexion</h2>
    <form action="./traitement.php" class="<?php if(isset($_SESSION['errorConnexion'])) echo $_SESSION['errorConnexion']; ?>" id="f_connexion" method="post">
 
        <input type="hidden" id="connexion" name="action" value="connexion">
        <input type="text" name="co_email" class="connexion_properties" placeholder="Votre adresse électronique">

        <input type="text" name="co_password" class="connexion_properties" placeholder="Mot de passe" >

        <button type="submit" class="btn_connexion">Se connecter</button>
    </form>
</section>
      
<?php
    require_once './inc/footer.php';
    $_SESSION['errorConnexion'] = 0;
?>