<?php 
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once './inc/header.php';
?>

<h1>Pour une configuration sans trop de réflexions.</h1>
<h2>Configuration Suprême est un outil <em>simple</em> et <em>gratuit</em> vous permettant de configurer l'ordinateur de vos rêves, 
    tout en validant la compatibilité des pièces choisies.</h2>
<h2>Qu'attendez-vous? Commencez à configurer <em>maintenant</em>!</h2>

<?php
    require_once './inc/footer.php';
?>