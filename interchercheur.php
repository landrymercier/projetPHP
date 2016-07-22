<?php
session_start();
include_once 'Config.php';
include_once 'cherchclass.php';
if(isset($_GET['voir'])){
$_SESSION['idplage'] = $_GET['idplage'];
$_SESSION['nomplage'] = $_GET['nomplage'];
$_SESSION['nbgroupe'] = $_GET['nbgroupe'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Interface Préleveur - <?php echo $_SESSION['nomplage']; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <?php
        echo"idplage:".$_SESSION['idplage'];
        echo"nomplage:".$_SESSION['nomplage'];
        if (isset($_SESSION['logged']) == false) {
            echo'<meta http-equiv="Refresh" content="1; url=index.php">';
        }
        ?>
    </head>

    <body id="interchercheur_ifrocean">
 <?php
        if (isset($_POST['cree'])) {
            echo "<h1>Interface Préleveur - " . $_POST['nom-projet'] . "</h1>";
        } else {
            echo "<h1>Interface Préleveur - " . $_SESSION['nomplage'] . "</h1>";
        }

    $bdd = CONNECTBDD();
       
        
//SI CREATION D'UN NOUVEAU PROJET
        if (isset($_POST['cree'])) {
            CreaProjet($_POST['nom-projet'],$_POST['ville'],$_POST['annee'],$_POST['mois'],$_POST['jour']);
        }
        
//SI RECALCUL DE LA SUPERFICIE
        if(isset($_POST['Recalc'])){
            RecalcSuper($_SESSION['idplage']);
        }
        
        //FERMETURE DES GROUPES
        if(isset($_POST['CloreAll'])){
            
            $req = $bdd->query("UPDATE zones SET Clore = 1 WHERE IDplage = " . $_SESSION['idplage']);
            $sup = $req->fetch();
            echo"UPDATE zones SET Clore = 1 WHERE IDplage = " . $_SESSION['idplage'];
        }
        
//FERMETURE DE TOUS LES GROUPES LIES AU PROJET
        
        ?>
        <div class="btn-session">
            <a href="unlogged.php" class="bouton" title="Se déconnecter"><img src="images/icone_deconnexion.png" alt="Se déconnecter"/></a>
        </div>
        <div class="btn-sitemap">
            <a href="404.php" class="bouton" title="Plan du site"><img src="images/icone_sitemap.png" alt="Plan du site"/></a>
        </div>
        <a href="tablechercheur.php">Retour à la liste des plages </a>

        <form action="interchercheur.php" method="get">
            <fieldset>
                <legend><h2>Liste des vues</h2></legend>
                <select name="Vue">
                    <option>Vue globale</option>
                    <option disabled>──────────</option>
                    <?php
                    if (isset($_POST['cree'])) {
                        
                    } else {
                        $reponse = $bdd->query("SELECT ID,Nom,Clore FROM zones WHERE IDplage = (SELECT ID FROM plage WHERE id=" . $_SESSION['idplage'] . ")");
                        while ($donnees = $reponse->fetch()) {
                            if($_GET['Vue']==$donnees['Nom']){
                            echo"<option selected='selected'>" . $donnees['Nom'] . "</option>";}
                            else{
                            echo"<option>" . $donnees['Nom'] . "</option>";}
                        }
                    }
                    ?>
                </select>
                <div class="align-btn-droite">
                    <input type="submit" id="voire" class="bouton" name="voire" value="Modifier la vue"/>
                </div>
            </fieldset>

        </form>

        <span class="bouton" id="bouton_plage" onclick="javascript:afficher_cacher('plage');">
            Cacher les informations de la plage
        </span>
        
        <div id="plage" class="marge-conteneur">
            <form method="post">
                <input type="submit" id="Modif-projet" class="bouton" name="Modif-projet" value="Modifier les informations"/>
                <input type="submit" id="Recalc" class="bouton" name="Recalc" value="Recalculer la superficie"/>
                <input type="submit" id="CloreAll" class="bouton" name="CloreAll" value="Clore tous les groupes"/>
            </form>
            <form method="get" action="gestiongroupe.php">
                <?php if (!isset($_POST['cree'])) {echo'<input type="hidden" name="nbgroupe" value="' . $_SESSION['nbgroupe'] . '"/>';}?>
            <input type="submit" id="" class="bouton" name="" value="Gestion des groupe"/>
            </form>
            <?php if (!isset($_POST['cree'])){echo'<form method="get" action="exportKML.php">
                <input type="submit" id="KML" class="bouton" name="KML" value="Exporter KML"/>
            </form>';} ?>
            <form method="get" action="tablechercheur.php">
            <input type="submit" id="" class="bouton" name="supprimer" value="Supprimer le projet"/>
            </form>
            
            <div id="infos-projet">
                <?php
                //REQUETE POUR RECUPERER LES INFORMATIONS DU PROJET (ville, nom projet, date...)
                if (isset($_POST['cree'])) {
                    echo "<h2>Informations relatives à la plage étudiée</h2>";
                    echo "<p>Nom : " . $_POST['nom-projet'] . "</p>";
                    echo "<p>Ville : " . $_POST['ville'] . "</p>";
                    echo "<p>Date : " . $_POST['jour'] ."-". $_POST['mois'] ."-". $_POST['annee'] . "</p>";
                    echo "<p>Superficie totale : 0 m²</p>";
                } else {
                    $reponse = $bdd->query("SELECT Nom,Ville,Datepreleve,Superficie FROM plage WHERE ID=" . $_SESSION['idplage']);
                    $donnees = $reponse->fetch();
                    echo "<h2>Informations relatives à la plage étudiée</h2>";
                    echo "<p>Nom : " . $donnees['Nom'] . "</p>";
                    echo "<p>Ville : " . $donnees['Ville'] . "</p>";
                    echo "<p>Date : " . $donnees['Datepreleve'] . "</p>";
                    echo "<p>Superficie totale : " . $donnees['Superficie'] . " m²</p>";
                    echo "<p>Nombre de groupes : " . $_SESSION['nbgroupe'] . "</p>";
                    $reponse->closeCursor();
                }
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
                    if (isset($_POST['cree'])) {
                        
                    } else {
                        if ($_GET['Vue'] == 'Vue globale') {
                            $reponse = $bdd->query("SELECT DISTINCT espece.Nom, SUM(prelevement.quantite) AS quantite FROM zones 
                        INNER JOIN (espece INNER JOIN prelevement ON espece.IDespeces=prelevement.IDespece)
                        ON zones.ID=espece.IDzone WHERE zones.IDplage=" . $_SESSION['idplage'] ." GROUP BY espece.Nom");
                        } else {
                            $reponse = $bdd->query("SELECT DISTINCT espece.Nom, prelevement.quantite FROM zones 
                        INNER JOIN (espece INNER JOIN prelevement ON espece.IDespeces=prelevement.IDespece)
                        ON zones.ID=espece.IDzone WHERE zones.IDplage=" . $_SESSION['idplage'] . " AND zones.Nom='" . $_GET['Vue'] . "'");
                        }
                        while ($donnees = $reponse->fetch()) {
                            echo"<tr>";
                            echo"<td>" . $donnees['Nom'] . "</td>";
                            echo"<td>" . $donnees['quantite'] . "</td>";
                            echo'<td><input type="submit" id="modif" class="bouton" name="modif" value="Modifier"/></td>';
                            echo"</tr>";
                        }$reponse->closeCursor();
                    }
                    ?>
                </tbody>
            </table>         
        </form>

        <footer>
            <a href="#interchercheur_ifrocean" class="bouton" title="Haut de page"><img src="images/icone_fleche-retour.png" alt="Haut de page"/></a>
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
            //<!--
            afficher_cacher('plage');
            //-->
        </script>
    </body>
</html>