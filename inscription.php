<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
    // echo 'inscription.php';
?>
    <section class="inscription">
    <h2>Creer votre compte</h2>
    <form action="./traitement.php" class="f_inscription" method="post">
        
        <!-- <label for="prenom">Prenom: </label> -->
        <input type="text" name="prenom" id="prenom" placeholder="Prenom">
    
        <!-- <label for="nom">Nom: </label> -->
        <input type="text" name="nom" id="nom" placeholder="Nom">
        

        <!-- <label for="email">Adresse Electronique: </label> -->
        <input type="text" name="email" id="email" placeholder="Adresse electronique">
        
        <!-- <label for="motPasse">Mot de passe: </label> -->
        <input type="password" name="password" placeholder="Mot de passe">

        <!-- <label for="motPasse">Confirmer le mot de passe: </label> -->
        <input type="password" name="c_password" placeholder="Confirmer le mot de passe">

        <!-- <label for="dateNaissance"> Date naissance: </label> --> 
        <input name="dateNaissance" placeholder="Date de naissance" type="text" onfocus="(this.type='date')" onblur="(this.type='text')">

        <!-- <label for="adresse">Adresse: </label> -->
        <input type="text" name="adresse" placeholder="Adresse (Numero de porte & rue)">

    <button type="submit" class="btn_inscription">Creer votre compte</button>

    </form>


</section>



<?php
    require_once './inc/footer.php';
?>