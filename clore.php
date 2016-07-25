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
        if (isset($_GET['fermgroupe'])) {

            try {
                $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $req = $bdd->prepare("UPDATE zones SET Clore = 1 WHERE ID = " . $_GET['groupeid']);
            $req->execute();
            $req->closeCursor();
            echo"<h1>Le groupe à bien été clos, vous allez être redirigé vers la page principale<br>Si vous n'êtes pas redirigé dans quelques secondes, cliquez sur ce <a href='index.php'>lien</a>.</h1>";
            echo'<meta http-equiv="Refresh" content="3; url=index.php">';
        } if (isset($_GET['cloregroup'])){
            echo'<form action="chercheur" method="post">';
            echo'<div class="valide_content">';
            echo"<h1>Suppression de Groupe</h1>";
            echo"<p>En cliquant sur VALIDER, vous ne pourrez plus accéder à votre groupe ni apporter des modifications.</p>";

            echo"<p><a href='index.php' class='bouton error_content'><img src='images/icone_supprimer.png' alt='Retour'/></a>";
            echo"<a href='clore.php?fermgroupe=groupe&groupeid=" . $_GET['groupeid'] . "' class='bouton valide_content'><img src='images/icone_valider.png' alt='Valider'/></a>";
            echo"</p>";
            echo"</div>";
            echo"</form>";
        }

        //VEROUILLAGE D'UN PROJET
        if (isset($_GET['verproj'])) {

            try {
                $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $req = $bdd->query("UPDATE zones SET Clore = 1 WHERE IDplage = " . $_GET['id']);
            $sup = $req->fetch();
            $req->closeCursor();
            $req = $bdd->query("UPDATE plage SET Clore = 1 WHERE ID = " . $_GET['id']);
            $sup = $req->fetch();
            $req->closeCursor();
            echo"<h1>Le projet à bien été verrouillé, vous allez être redirigé vers la liste des projets <br>Si vous n'êtes pas redirigé dans quelques secondes, cliquez sur ce <a href='index.php'>lien</a>.</h1>";
            echo'<meta http-equiv="Refresh" content="3; url=tablechercheur.php">';
        } if (isset($_GET['verrouilleproj'])){
            echo'<form action="chercheur" method="post">';
            echo'<div class="valide_content">';
            echo"<h1>Verrouillage de Plage</h1>";
            echo"<p>En cliquant sur VALIDER, les préleveurs ne pourront plus voir la plage et tous les groupes seront clos.</p>";

            echo"<p><a href='index.php' class='bouton error_content'><img src='images/icone_supprimer.png' alt='Retour'/></a>";
            echo"<a href='clore.php?verproj=projet&id=" . $_GET['groupeid'] . "' class='bouton valide_content'><img src='images/icone_valider.png' alt='Valider'/></a>";
            echo"</p>";
            echo"</div>";
            echo"</form>";
        }
        
//FERMETURE D'UN PROJET
        if (isset($_GET['fermproj']) == "projet") {

            try {
                $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $req = $bdd->prepare("UPDATE plage SET Clore = 2 WHERE ID = " . $_GET['id']);
            $req->execute();
            $req->closeCursor();
            echo"<h1>La plage à bien été clos, vous allez être redirigé vers la liste des plages <br>Si vous n'êtes pas redirigé dans quelques secondes, cliquez sur ce <a href='index.php'>lien</a>.</h1>";
            echo'<meta http-equiv="Refresh" content="3; url=tablechercheur.php">';
        } if (isset($_GET['cloreproj'])){
            echo'<form action="chercheur" method="post">';
            echo'<div class="valide_content">';
            echo"<h1>Suppression de Plage</h1>";
            echo"<p>En cliquant sur VALIDER, vous ne pourrez plus accéder à votre plage ni apporter des modifications.</p>";

            echo"<p><a href='index.php' class='bouton error_content'><img src='images/icone_supprimer.png' alt='Retour'/></a>";
            echo"<a href='clore.php?fermproj=projet&id=" . $_GET['groupeid'] . "' class='bouton valide_content'><img src='images/icone_valider.png' alt='Valider'/></a>";
            echo"</p>";
            echo"</div>";
            echo"</form>";
        }
        ?>

    </body>
</html>
