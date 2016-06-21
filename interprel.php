<?php
//VARIABLES TEMPORAIRES --> prélèvement de la zone 1 de la ville 1 avec le groupe 1
include_once 'Config.php';
echo $_GET['groupeid'];
        //CONNEXION BDD
        try {
            $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $reponse = $bdd->query("SELECT Nom FROM zones WHERE ID=" . $_GET['groupeid']); //REQUETE POUR LE GROUPE EN COURS
        $donnees = $reponse->fetch(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Interface Préleveur - <?php echo $donnees['Nom']; ?></title>
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
    </head>

    <body id="top">
        <?php
        echo "<h1>Interface Préleveur - " . $donnees['Nom'] . "</h1>";
        ?>

        <span class="bouton" id="bouton_plage" onclick="javascript:afficher_cacher('plage');">
            Cacher les informations de la plage
        </span>
        <script type="text/javascript">
            //<!-- cacher une partie de la page (menu infos)
            afficher_cacher('plage');
            //-->
        </script>
        <div id="plage">
            <div id="infos-projet">
                <?php
                //REQUETE POUR RECUPERER LES INFORMATIONS DU PROJET (ville, nom projet, date...)
                $reponse = $bdd->query("SELECT Nom,Ville,Datepreleve FROM plage WHERE ID=(SELECT IDplage FROM zones WHERE ID=".$_GET['groupeid'].")");
                $donnees = $reponse->fetch();
                echo "<p>Projet: " . $donnees['Nom'] . "</p>";
                echo "<p>Ville: " . $donnees['Ville'] . "</p>";
                echo "<p>Date: " . $donnees['Datepreleve'] . "</p>";
                $reponse->closeCursor();
                ?>
            </div>
            <div id="coordonnees" class="clear">
                <?php
                //REQUETE POUR AFFICHER L'ESPACE DE TRAVAIL (coords, superficie)
                $reponse = $bdd->query("SELECT latA,longA,latB,longB,latC,longC,latD,longD,Superficie "
                        . "FROM Zones WHERE ID=" . $_GET['groupeid']);
                $donnees = $reponse->fetch();
                echo "<div class=\"couleur0-0\"> " . $donnees['latA'] . " " . $donnees['longA'] . "</div>";
                echo "<div class=\"couleur0-1\"> " . $donnees['latB'] . " " . $donnees['longB'] . "</div>";
                echo"<div>Surface : " . $donnees['Superficie'] . " m²</div>";
                echo "<div class=\"couleur1-0\"> " . $donnees['latC'] . " " . $donnees['longC'] . "</div>";
                echo "<div class=\"couleur1-1\"> " . $donnees['latD'] . " " . $donnees['longD'] . "</div>";
                $reponse->closeCursor();
                ?>
            </div>
        </div>

        <form method="post" action="">

            <table>
                <?php if(isset($_POST['ajout']))
                {
                    $req = $bdd->prepare('INSERT INTO espece (Nom,IDzone) VALUES(?, ?)');
                    $req->execute(array($_POST['mob'], $_GET['groupeid']));
                    $req->closeCursor();
                    $reponse = $bdd->prepare("SELECT IDzone FROM espece ORDER BY IDzone DESC LIMIT 1");
                    $id = $reponse->fetch();
                    $req->closeCursor();
                    $req = $bdd->prepare('INSERT INTO prelevement (IDzone,IDespece,quantite) VALUES(?, ?, ?)');
                    $req->execute(array($_GET['groupeid'],$id,$_POST['nb']));
                    $req->closeCursor();}
                ?>
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
                    <tr>
                        <td><input type="text" name="mob" id="mob" placeholder="Choisissez un nom" required/></td>
                        <td><input type="number" min="0" step="1" name="nb" id="nb" placeholder="Choisissez un chiffre" required/></td>
                        <td><input type="submit" id="ajout" class="bouton" name="ajout" value="Ajouter"/></td>
                    </tr>
                    <?php
                    //REQUETE POUR AFFICHER LA LISTE DES ESPECES TROUVE PAR LE GROUPE EN COURS
                    $reponse = $bdd->query("SELECT Nom,quantite FROM espece "
                                            ."INNER JOIN prelevement ON prelevement.IDespece = espece.IDespeces "
                                            ."WHERE prelevement.IDzone =".$_GET['groupeid']);
                    if($reponse != null){
                    while ($donnees = $reponse->fetch()) {
                        echo"<tr>";
                        echo"<td>" . $donnees['Nom'] . "</td>";
                        echo"<td>". $donnees['quantite'] ."</td>";
                        echo'<td><input type="submit" id="modifie" class="bouton" name="modifie" value="Modifier"/></td>';
                        echo"</tr>";
                    }$reponse->closeCursor();}
                    else{echo"<tr>";
                        echo"<td>Il n'y a encore aucune espèce inscrite</td>";
                        echo"<td></td>";
                        echo'<td></td>';
                    echo"</tr>";}
                    ?>
                </tbody>
            </table>

            <a href="index.php" class="bouton">Retour</a>
            <input type="submit" id="cloture" class="bouton" name="cloture" value="Cloturer"/>
        </form>

        <footer>
            <a href="#top" class="bouton" title="Haut de page"><img src="images/icone_fleche-retour.png" alt="Haut de page"/></a>
        </footer>
    </body>
</html>
