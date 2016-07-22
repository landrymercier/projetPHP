<?php include_once 'Config.php'; ?>
<!DOCTYPE html> 
<html>
    <head>
        <title>Fin de projet</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="clore_ifrocean">
        <?php
        //FERMETURE D'UN GROUPE
        if (isset($_GET['valider']) == "groupe") {

            try {
                $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $req = $bdd->prepare("UPDATE zones SET Clore = 1 WHERE ID = " . $_GET['groupeid']);
            $req->execute();
            $req->closeCursor();
            echo"<h1>Le groupe à bien été clos, vous allez être redirigé vers la page principale</h1>";
            echo'<meta http-equiv="Refresh" content="5; url=index.php">';
        } elseif ($_GET['clore'] == "groupe"){
            echo'<form action="chercheur" method="post">';
            echo'<div class="valide_content">';
            echo"<h1>Suppression de Groupe</h1>";
            echo"<p>En cliquant sur VALIDER, vous ne pourrez plus accéder à votre groupe ni apporter des modifications.</p>";

            echo"<p><a href='index.php' class='bouton error_content'><img src='images/icone_supprimer.png' alt='Retour'/></a>";
            echo"<a href='clore.php?valider=groupe&groupeid=" . $_GET['groupeid'] . "' class='bouton valide_content'><img src='images/icone_valider.png' alt='Valider'/></a>";
            echo"</p>";
            echo"</div>";
            echo"</form>";
        }

//FERMETURE D'UN PROJET
        if (isset($_GET['valider']) == "projet") {

            try {
                $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $req = $bdd->prepare("UPDATE zones SET Clore = 1 WHERE ID = " . $_GET['groupeid']);
            $req->execute();
            $req->closeCursor();
            echo"<h1>Le projet à bien été clos, vous allez être redirigé vers la page principale</h1>";
            echo'<meta http-equiv="Refresh" content="5; url=index.php">';
        } elseif ($_GET['clore'] == "projet"){
            echo'<form action="chercheur" method="post">';
            echo'<div class="valide_content">';
            echo"<h1>Suppression de Plage</h1>";
            echo"<p>En cliquant sur VALIDER, vous ne pourrez plus accéder à votre plage ni apporter des modifications.</p>";

            echo"<p><a href='index.php' class='bouton error_content'><img src='images/icone_supprimer.png' alt='Retour'/></a>";
            echo"<a href='clore.php?valider=projet&id=" . $_GET['groupeid'] . "' class='bouton valide_content'><img src='images/icone_valider.png' alt='Valider'/></a>";
            echo"</p>";
            echo"</div>";
            echo"</form>";
        }
        ?>

    </body>
</html>
