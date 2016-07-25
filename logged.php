<?php
session_start();
include_once 'Config.php'
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Connexion réussie</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="logged_ifrocean">
        <?php
                    try {
                $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            
        $reponse = $bdd->query("SELECT mdp FROM login");
        $donnees = $reponse->fetch();

        echo"mdp :" . $donnees['mdp'];
        if ($donnees['mdp'] == $_POST['pass']) {
            $_SESSION['logged'] = true;
            echo'<div class="valide_content">
            <h1>Connexion réussie !</h1>
            <p>Si vous n\'êtes pas redirigé dans quelques secondes, cliquez sur ce <a href="tablechercheur.php">lien</a>.</p>
                    <meta http-equiv="Refresh" content="3; url=tablechercheur.php">
        </div>';
        } else {
            echo'<div class="valide_content">
            <h1>Mot de passe invalide ! Veuillez recommencer</h1>
            <p>Si vous n\'êtes pas redirigé dans quelques secondes, cliquez sur ce <a href="tablechercheur.php">lien</a>.</p>
                    <meta http-equiv="Refresh" content="3; url=login.php">
        </div>';
        }
        ?>
    </body>       
</html>

