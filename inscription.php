<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    // echo 'inscription.php';
?>
    <section class="inscription" id="formulaire_inscription">
    <h2>Créer votre compte</h2>
    <form action="./traitement.php" id="f_inscription" class="<?php if (isset($_SESSION['errorInscription'])) echo $_SESSION['errorInscription'];?>" method="post">
        <input type="hidden" id="inscription" name="action" value="inscription">
        
        <input type="text" name="prenom" id="prenom" placeholder="Prenom">
    
        <input type="text" name="nom" id="nom" placeholder="Nom">
        
        <input type="text" name="email" id="email" placeholder="Adresse electronique">

        <input type="password" name="password" placeholder="Mot de passe">

        <input type="password" name="c_password" placeholder="Confirmer le mot de passe">
     
        <input name="dateNaissance" placeholder="Date de naissance" type="text" onfocus="(this.type='date')" onblur="(this.type='text')">

        <input type="text" id="adresse" name="adresse" placeholder="Adresse (Numero de porte & rue)">

    <button type="submit" class="btn_inscription">Creer votre compte</button>

    </form>


</section>



<?php
    $_SESSION['errorInscription'] = 0;
    require_once './inc/footer.php';
?>