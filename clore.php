<?php include_once 'Config.php'; ?>
<!DOCTYPE html> 
<html>
    <head>
        <title>Fin de projet</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="logged_ifrocean">
        <?php
        if (isset($_GET['valider']) == 1) {

            try {
                $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $req = $bdd->prepare("UPDATE zones SET Clore = 1 WHERE ID = ".$_GET['groupeid']);
            $req->execute();
            $req->closeCursor();
            echo"<h1>Le groupe à bien été clos, vous allez être redirigé vers la page principale</h1>";
            echo'<meta http-equiv="Refresh" content="5; url=index.php">'
        } else {
            echo'<form action="chercheur" method="post">';
            echo'<div class="valide_content">';
            echo"<h1>En cliquant sur VALIDER, vous ne pourrez plus accéder à votre groupe ni apporter des modifications.</h1>";

            echo"<p><a href='index.php' class='bouton'>Retour</a>";
            echo"<a href='clore.php?valider=1&groupeid=" . $_GET['groupeid'] . "' class='bouton'>Valider</a>";
            echo"</p>";
            echo"</div>";
            echo"</form>";
        }
        ?>
    </body>
</html>
