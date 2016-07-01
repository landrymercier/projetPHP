<?php session_start();
include_once 'Config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Interface Préleveur - <?php echo $_GET['nomplage']; ?></title>
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
<?php if (isset($_SESSION['logged']) == false) {
    echo'<meta http-equiv="Refresh" content="1; url=index.php">';
} ?>
    </head>

    <body id="top">
        <?php
        echo "<h1>Interface Préleveur - " . $_GET['nomplage'] . "</h1>";
        
        try {
            $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        ?>
        <form>
            <fieldset>
                <legend><h2>Liste des vues</h2></legend>
                <select name="listtri">
                    <option>Vu globale</option>
                    <option>----------</option>
                    <?php
                        $reponse = $bdd->query("SELECT ID,Nom,Clore FROM zones WHERE IDplage = (SELECT ID FROM plage WHERE id=" . $_GET['idplage'] . ")");
                        while ($donnees = $reponse->fetch()) {
                            echo"<option>" . $donnees['Nom'] . "</option>";
                        }
                    ?>
                </select>
            </fieldset>
        </form>

        <span class="bouton" id="bouton_plage" onclick="javascript:afficher_cacher('plage');">
            Cacher les informations de la plage
        </span>
        <script type="text/javascript">
            //<!--
            afficher_cacher('plage');
            //-->
        </script>
<div id="plage" class="marge-conteneur">
            <div id="infos-projet">
                <?php
                //REQUETE POUR RECUPERER LES INFORMATIONS DU PROJET (ville, nom projet, date...)
                $reponse = $bdd->query("SELECT Nom,Ville,Datepreleve FROM plage WHERE ID=".$_GET['idplage']);
                $donnees = $reponse->fetch();
                echo "<h2>Informations relatives à la plage étudiée</h2>";
                echo "<p>Nom : " . $donnees['Nom'] . "</p>";
                echo "<p>Ville : " . $donnees['Ville'] . "</p>";
                echo "<p>Date : " . $donnees['Datepreleve'] . "</p>";
                $reponse->closeCursor();
                ?>
            </div>
        </div>

        <form method="GET" action="interchercheur.php">
            <table>
                <caption><h2>Prélèvement de la zone</h2></caption>  
                <thead><!--en tete de tableau-->
                    <tr>
                        <th>Espèces</th>
                        <th>Nombres</th>
                        <th>Fonctions</th>
                    </tr>
                </thead>
                <tfoot><!--pied de tableau-->
                    <tr>
                        <th>Espèces</th>
                        <th>Nombres</th>
                        <th>Fonctions</th>
                    </tr>
                </tfoot>
                <tbody><!--corp du tableau-->
                    <?php
                    $reponse = $bdd->query("SELECT * FROM Especes");
                    while ($donnees = $reponse->fetch()) {
                        echo"<tr>";
                        echo"<td>" . $donnees['Nom'] . "</td>";
                        echo"<td>0</td>";
                        echo'<td><input type="submit" id="modif" class="bouton" name="modif" value="Modifier"/></td>';
                        echo"</tr>";
                    }$reponse->closeCursor();
                    ?>
                </tbody>
            </table>         
        </form>

        <footer>
            <a href="#top" class="bouton" title="Haut de page"><img src="images/icone_fleche-retour.png" alt="Haut de page"/></a>
        </footer>
    </body>
</html>