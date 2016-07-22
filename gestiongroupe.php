<?php
session_start();
include_once 'Config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Panneau chercheur</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <?php
        if (isset($_SESSION['logged']) == false) {
            echo'<meta http-equiv="Refresh" content="1; url=index.php">';
        }
        ?>
    </head>

    <body id="table-chercheur_ifrocean">
        <?php
        try {
            $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        if (isset($_POST['cloregroupe'])) {
            $req = $bdd->prepare('UPDATE zones SET Clore = 1 WHERE ID=' . $_POST['cloregroupe']);
            $req->execute();
        }
        if (isset($_POST['opengroupe'])) {
            $req = $bdd->prepare('UPDATE zones SET Clore = 0 WHERE ID=' . $_POST['opengroupe']);
            $req->execute();
        }
        ?>

        <h1>Panneau chercheur</h1>
        <?php echo'<a href="interchercheur.php?Vue=Vue globale&nbgroupe=' .$_SESSION['nomplage'].'.php">Retour</a>' ?>
        <table class="marge-conteneur">
            <caption><h2>Liste des plages</h2></caption>
            <thead><!--en tete de tableau-->
                <tr>
                    <th>Nom du groupe</th>
                    <th>Etat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot><!--en tete de tableau-->
                <tr>
                    <th>Nom du groupe</th>
                    <th>Etat</th>
                    <th>Action</th>
                </tr>
            </tfoot>

            <?php
            $reponse = $bdd->query("SELECT ID, Nom, Clore FROM zones WHERE IDplage=" . $_SESSION['idplage']);
            while ($donnees = $reponse->fetch()) {
                echo"<tr>";
                echo"<td>" . $donnees['Nom'] . "</td>";
                if ($donnees['Clore'] == 0) {
                    echo"<td>En cours</td>";
                } else {
                    echo"<td>Clos</td>";
                }
                if ($donnees['Clore'] == 1) {
                    echo'<form action="" method="post">';
                    echo'<td><input type="hidden" name="opengroupe" value="' . $donnees['ID'] . '"/>';
                    echo'<input type="submit" class="bouton" value="Ouvrir"/></td>';
                    echo'</form>';
                } else {
                    echo'<form action="" method="post">';
                    echo'<td><input type="hidden" name="cloregroupe" value="' . $donnees['ID'] . '"/>';
                    echo'<input type="submit" class="bouton" value="Clore"/></td>';
                    echo'</form>';
                }
            }


            $reponse->closeCursor();
            ?>

            <footer>
                <a href="#table-chercheur_ifrocean" class="bouton" title="Haut de page"><img src="images/icone_fleche-retour.png" alt="Haut de page"/></a>
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
    </body>
</html>