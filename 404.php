<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Erreur 404</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <!--import javascript-->
            <!--import de la bibliotheque jQuery pour les animations-->
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <!--script javascript-->
            <!--script js de la fonction easing de jQuery non incluse dans la bibliotheque par defaut-->
            <script type="text/javascript" src="scripts/jquery.easing.1.3.js"></script>
            <!--script js de la fonction softScroll pour les ancres-->
            <script type="text/javascript" src="scripts/scroll.js"></script>
    </head>
    
    <body id="page404">
        <h1> Vous vous êtes perdu ?</h1>
        <div>
            <img src="images/404.png" alt=""/>
            <p class="font404">Vous ne savez plus ou vous etes ?</p>
        </div>
        <div>
            <h2>Qu'est ce que vous essayiez de faire ?</h2>
        
            <p><a href="index.php">Retourner à l'accueil</a></p>
            <br/>
            <p>Vous voulez accéder à l'interface Chercheur ?</p>
            <a href="login.php">Connectez-vous ici</a> avec l'identifiant que l'on vous à donné.
            <hr/>
            <p>Vous êtes Préleveur et vous voulez remplir vos tableau de recherche ?</p>
            <a href="index.php">Retournez en page d'accueil</a> et renseignez le nom de votre groupe.
            <hr/>
            <p>Sinon, créez un nouveau groupe via le bouton correspondant, 
            après avoir renseigné les coordonnées de votre estran.</p>
            <hr/>
            <p>Vous ne savez pas trop ? Demandez de l'aide à votre 
            <a href="mailto:unchercheur@danslanature.bzh"> Chercheur attitré !</a></p>
        </div>
        
    <footer>
        <a href="#top" class="bouton" title="Haut de page"><img src="images/icone_fleche-retour.png" alt="Haut de page"/></a>
    </footer>
    </body>
</html>
