<?php
session_start();
include_once 'Config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Panneau chercheur</title>
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

        <!--script js de la fonction afficher-cacher-->
        <script type="text/javascript" src="scripts/afficher-cacher.js"></script>
        <?php
        if (isset($_SESSION['logged']) == false) {
            echo'<meta http-equiv="Refresh" content="1; url=index.php">';
        }
        ?>
    </head>

    <body id="top">
        <?php
        try {
            $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        ?>

        <h1>Panneau chercheur</h1>
        <a href="unlogged.php">Déconnexion </a>
        <table class="marge-conteneur">
            <caption><h2>Liste des projets</h2></caption>
            <thead><!--en tete de tableau-->
                <tr>
                    <th>Nom du projet
                        <a href="tablechercheur.php?order=Nom&by=ASC">&uarr;</a> 
                        <a href="tablechercheur.php?order=Nom&by=DESC">&darr;</a></th>
                    <th>Ville
                        <a href="tablechercheur.php?order=Ville&by=ASC">&uarr;</a> 
                        <a href="tablechercheur.php?order=Ville&by=DESC">&darr;</a></th>
                    <th>Date
                        <a href="tablechercheur.php?order=Datepreleve&by=ASC">&uarr;</a> 
                        <a href="tablechercheur.php?order=Datepreleve&by=DESC">&darr;</a></th>
                    <th>Superficie
                        <a href="tablechercheur.php?order=Superficie&by=ASC">&uarr;</a> 
                        <a href="tablechercheur.php?order=Superficie&by=DESC">&darr;</a></th>
                    <th>Terminés</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot><!--en tete de tableau-->
                <tr>
                    <th>Nom du projet</th>
                    <th>Ville</th>
                    <th>Date</th>
                    <th>Superficie</th>
                    <th>Terminés</th>
                    <th>Action</th>
                </tr>
            </tfoot>

            <?php
            $reponse = $bdd->query("SELECT ID, Nom, Ville, Superficie, Datepreleve, Clore FROM plage ORDER BY Datepreleve DESC ");
            if (isset($_GET['order']) || isset($_GET['by'])) {
                $reponse = $bdd->query("SELECT ID, Nom, Ville, Superficie, Datepreleve, Clore FROM plage ORDER BY " . $_GET['order'] . " " . $_GET['by']);
                echo"order : " . $_GET['order'];
                echo" by : " . $_GET['by'];
            }
            while ($donnees = $reponse->fetch()) {
                echo"<tr>";
                echo"<td>" . $donnees['Nom'] . "</td>";
                echo"<td>" . $donnees['Ville'] . "</td>";
                echo"<td>" . $donnees['Datepreleve'] . "</td>";
                echo"<td>" . $donnees['Superficie'] . "</td>";

                $cpt = $bdd->query("SELECT COUNT(ID) AS 'ID' FROM zones WHERE IDplage = " . $donnees['ID'] . " AND Clore = 1");
                $cpttt = $bdd->query("SELECT COUNT(ID) AS 'ID' FROM zones WHERE IDplage = " . $donnees['ID']);
                $dcpt = $cpt->fetch();
                $dcpttt = $cpttt->fetch();
                    echo"<td>" . $dcpt['ID'] . " / " . $dcpttt['ID'] . "</td>"; 

                echo'<td>
                        <form action="interchercheur.php" method="get">
                            <input type="hidden" name="Vue" value="Vue globale"/>
                            <input type="hidden" name="nomplage" value="' . $donnees['Nom'] . '"/>
                            <input type="hidden" name="idplage" value="' . $donnees['ID'] . '"/>
                            <input type="submit" id="voir" class="bouton" name="voir" value="Acceder"/>
                        </form>
                    </td>';
                echo"</tr>";
            }$reponse->closeCursor();
            ?>

        </table>
                <fieldset  class="marge-conteneur">
            <legend><h2>Création d'un nouveau projet</h2></legend>
            <form action="interchercheur.php" method="post" id="align-form-groupe">
            
            <p class="marge-conteneur">
                <label for="nom-groupe">Nom du Projet :</label>
                <input type="text" name="nom-projet" id="nom-projet" placeholder="Entrez un nom" required/>
            <h4>Informations</h4>
                        <p>
                            <input type="text" name="ville" id="ville" placeholder="Entrez une ville" required/>
                            <input type="date" name="date" id="date" placeholder="Entrez une date" required/>
                        </p>
            <div class="align-btn-droite">
                <input type="submit" id="cree" class="bouton" name="cree" value="Créer"/>
                <input type="reset" class="bouton" value="Vider"/>
            </div>
        </form>
        </fieldset>
        

        <footer>
            <a href="#top" class="bouton" title="Haut de page"><img src="images/icone_fleche-retour.png" alt="Haut de page"/></a>
        </footer>
    </body>
</html>