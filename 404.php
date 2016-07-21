<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Erreur 404</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    
    <body id="page404">
        <h1> Vous vous êtes perdu ?</h1>
        
        <div class="display404">
            <div class="enigme404">
                <div class="position-enigme404">
                    <span class="bouton traduction404" id="bouton_traduire404" onclick="javascript:traduire('traduire404');">
                        Traduire
                    </span>
                    <p id="traduire404" style="">
                        Je vous salue visiteur !<br/>
                        Comment ? Vous vous etes perdu ?<br/>
                        Peut etre puis-je vous aider...<br/>
                        Appelez mon serviteur en cliquant <br/>
                        sur ma lanterne. Il saura vous aider.<br/>
                    </p>
                </div>
            </div>
            
            <div class="display-enigme404">
                <audio id="audioPlayer">
                    <source src="audio/404_success.mp3">
                </audio>
                <div onclick="play(&#39;audioPlayer&#39;, this);afficher_cacher('recompence404');">
                    <img src="images/404/404_aura.png" alt="" class="aura404"/>
                </div>
                
                <img src="images/404/404.png" alt=""/>
            </div>
            <div class="recompence404" id="recompence404" style="display:none;">
                <div class="btn-close-recompence404">
                    <a onclick="afficher_cacher('recompence404');" class="bouton" title="">
                        <img src="images/icone_supprimer.png" alt="Fermer"/>
                    </a>
                </div>
                <img src="images/404/404_poiscom.png" alt="" class="poiscom404"/>
                <div class="map-hover">
                    <a href="interchercheur.php" title="Vers interface chercheur"><img src="images/404/404_ile-nw.png" alt="" class="ilecarte404 NW"/></a>
                    <a href="#"><img src="images/404/404_ile-w.png" alt="" class="ilecarte404 W"/></a>
                    <a href="index.php" title="Vers l'accueil"><img src="images/404/404_ile-sw.png" alt="" class="ilecarte404 SW"/></a>
                    <a href="#"><img src="images/404/404_ile-n.png" alt="" class="ilecarte404 N"/></a>
                    <a href="#"><img src="images/404/404_ile-c-nw.png" alt="" class="ilecarte404 C-NW"/></a>
                    <a href="#"><img src="images/404/404_ile-c-se.png" alt="" class="ilecarte404 C-SE"/></a>
                    <a href="index.php#form-creation-groupe" title="Vers la création de groupe"><img src="images/404/404_ile-s.png" alt="" class="ilecarte404 S"/></a>
                    <a href="#"><img src="images/404/404_ile-ne.png" alt="" class="ilecarte404 NE"/></a>
                    <a href="#"><img src="images/404/404_ile-e.png" alt="" class="ilecarte404 E"/></a>
                    <a href="#"><img src="images/404/404_ile-se.png" alt="" class="ilecarte404 SE"/></a>
                </div>
                <figure>
                    <img src="images/404/404_carte.jpg" alt="" class="carte404"/>
                    <figcaption>Cliquez sur un lieu pour explorer.</figcaption>
                <figure>
            </div>
        </div>
        <div class="message404-standard">
            <h2>Vous êtes perdu ?</h2>
            <p>Vous êtes Préleveur et vous voulez remplir vos tableau de recherche ?</p>
            <ul>
                <li>Retournez à <a href="index.php">l'accueil</a>, sélectionnez une plage et choissisez votre groupe 
                    dans la liste.</li>
                <li>Sinon, créez un nouveau groupe <a href="index.php#creation-groupe">ici</a>.</li>
            </ul>
            <hr/>
            <p>Vous êtes chercheur et vous voulez consulter les données collectées ?</p>
            <ul>
                <li>Connectez-vous <a href="login.php">ici</a>.</li>
            </ul>
            <hr/>
            <p>Vous ne savez pas trop ?</p>
            <ul>
                <li>Demandez de l'aide à votre <a href="mailto:unchercheur@danslanature.bzh">chercheur</a> !</li>
            </ul>
        </div>
        <div class="clear"></div>

    <footer>
        <a href="#page404" class="bouton" title="Haut de page"><img src="images/icone_fleche-retour.png" alt="Haut de page"/></a>
    </footer>
        
    <!--import javascript-->
    <!--import de la bibliotheque jQuery pour les animations-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <!--script javascript-->
    <!--script js de la fonction easing de jQuery non incluse dans la bibliotheque par defaut-->
    <script type="text/javascript" src="scripts/jquery.easing.1.3.js"></script>
    <!--script js de la fonction softScroll pour les ancres-->
    <script type="text/javascript" src="scripts/scroll.js"></script>
    <!--script js de la fonction afficher-cacher-->
    <script type="text/javascript" src="scripts/afficher-cacher.js"></script>
    
    <script type="text/javascript">
    function play(idPlayer, control) {
        var player = document.querySelector('#' + idPlayer);
        player.play();      
    }
    
    function traduire(id) {
        $("#traduire404").css('font-family', 'Arial');
        $("#bouton_traduire404").css('display', 'none');
    }
    </script>
    
    </body>
</html>