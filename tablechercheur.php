<?php
session_start();
include_once 'config.php';
include 'cherchclass.php';
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
        $bdd = CONNECTBDD();
        //SUPPRESSION DE LA PLAGE
        if (isset($_GET['supprimer'])) {
            $req = $bdd->prepare("UPDATE plage SET Clore = 2 WHERE ID =" . $_SESSION['idplage']);
            $req->execute();
        }
        ?>

        <h1>Panneau chercheur</h1>
        <div class="btn-session">
            <a href="unlogged.php" class="bouton" title="Se déconnecter"><img src="images/icone_deconnexion.png" alt="Se déconnecter"/></a>
        </div>
        <div class="btn-sitemap">
            <a href="404.php" class="bouton" title="Plan du site"><img src="images/icone_sitemap.png" alt="Plan du site"/></a>
        </div>
        <table class="marge-conteneur">
            <caption><h2>Liste des plages</h2></caption>
            <thead><!--en tete de tableau-->
                <tr>
                    <th>Nom de la plage
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
                    <th>Nom de la plage</th>
                    <th>Ville</th>
                    <th>Date</th>
                    <th>Superficie</th>
                    <th>Terminés</th>
                    <th>Action</th>
                </tr>
            </tfoot>

            <?php
            $reponse = $bdd->query("SELECT ID, Nom, Ville, Superficie, Datepreleve, Clore FROM plage WHERE Clore < 2 ORDER BY Datepreleve DESC ");
            if (isset($_GET['order']) || isset($_GET['by'])) {
                $reponse = $bdd->query("SELECT ID, Nom, Ville, Superficie, Datepreleve, Clore FROM plage WHERE Clore < 2 ORDER BY " . $_GET['order'] . " " . $_GET['by']);
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
                            <input type="hidden" name="nbgroupe" value="' . $dcpttt['ID'] . '"/>
                            <input type="submit" id="voir" class="bouton ';
                if ($dcpt['ID'] == $dcpttt['ID'] && $dcpt['ID'] != 0) {
                    echo'valide_content';
                }
                echo'" name="voir" value="Acceder"/>
                        </form>
                    </td>';
                echo"</tr>";
            }$reponse->closeCursor();
            ?>

        </table>
        <fieldset  class="marge-conteneur">
            <legend><h2>Création d'une nouvelle plage</h2></legend>


            <form action="interchercheur.php?idplage" method="post" id="align-form-groupe">

                <p class="marge-conteneur">
                    <label for="nom-groupe">Nom de la plage :</label>
                    <input type="text" name="nom-projet" id="nom-projet" placeholder="Entrez un nom" required/>
                <h4>Informations</h4>
                <p>
                    <label for="ville">Nom de la ville :</label>
                    <input type="text" name="ville" id="ville" placeholder="Entrez une ville" required/>
                </p>
                <p class="align-date-creation-plage">
                    <label>Date de création :</label>
                    <input type="number" step="1" min="1" max="31" name="jour" id="jour" placeholder="25" required/>
                    /
                    <input type="number" step="1" min="1" max="12" name="mois" id="mois" placeholder="07" required/>
                    /
                    <input type="number" step="1" min="2016" name="annee" id="annee" placeholder="2016" required/>
                </p>
                <div class="align-btn-droite">
                    <input type="submit" id="cree" class="bouton" name="cree" value="Créer"/>
                    <input type="reset" class="bouton" value="Vider"/>
                </div>
            </form>
        </fieldset>

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