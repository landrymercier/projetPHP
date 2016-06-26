<?php session_start(); 
include_once 'Config.php';?>
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
        <?php if(isset($_SESSION['logged']) == false){echo'<meta http-equiv="Refresh" content="1; url=index.php">';} ?>
    </head>
    
    <body id="top">
    <?php
    try{
        $bdd = new PDO('mysql:host='.Config::SERVERNAME.';dbname='.Config::DBNAME.';charset=utf8', Config::LOGIN, '');
    }
    catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
    }
    if(isset($_GET['ajout'])){
    $req = $bdd->prepare('INSERT INTO Especes (Nom,IDzone) VALUES(?, ?)');
    $req->execute(array($_GET['mob'], 3));
    $req->closeCursor();}
    ?>

    <h1>Panneau chercheur</h1>
        
    <form>
        <fieldset>
            <legend><h2>Choix du projet</h2></legend>
            <select name="listprojet">
                <?php $reponse = $bdd->query("SELECT Nom FROM plage");
                    while ($donnees = $reponse->fetch()) {
                    echo"<option>".$donnees['Nom']."</option>";}
                $reponse->closeCursor();?>
            </select>
        </fieldset>
    </form>
        
    <form>
        <fieldset>
            <legend><h2>Choix du groupe</h2></legend>
            <select name="listtri">
                <option>Vu globale</option>
                <option>----------</option>
                <?php $reponse = $bdd->query("SELECT Nom FROM Zones");
                    while ($donnees = $reponse->fetch()) {
                    echo"<option>".$donnees['Nom']."</option>";}
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
    <div id="plage">
        <div id="infos-projet">
            <p>"nom projet</p>
            <p>"nom commune"</p>
            <p>"date"</p>
            <p>"nom plage"</p>
        </div>
        <div id="coordonnees" class="clear">
            <?php $reponse = $bdd->query("SELECT latA,longA,latB,longB,latC,longC,latD,longD,Superficie FROM Zones");
            $donnees = $reponse->fetch();
            echo "<div class=\"couleur0-0\"> ".$donnees['latA']." ".$donnees['longA']."</div>";
            echo "<div class=\"couleur0-1\"> ".$donnees['latB']." ".$donnees['longB']."</div>";
            echo"<div>Surface : ".$donnees['Superficie']." m²</div>";
            echo "<div class=\"couleur1-0\"> ".$donnees['latC']." ".$donnees['longC']."</div>";
            echo "<div class=\"couleur1-1\"> ".$donnees['latD']." ".$donnees['longD']."</div>"; 
            $reponse->closeCursor();?>
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
                while ($donnees = $reponse->fetch())
                {
                    echo"<tr>";
                    echo"<td>".$donnees['Nom']."</td>";
                    echo"<td>0</td>";
                    echo'<td><input type="submit" id="modif" class="bouton" name="modif" value="Modifier"/></td>';
                    echo"</tr>";
                }$reponse->closeCursor();?>
            </tbody>
        </table>         
    </form>
    
    <footer>
        <a href="#top" class="bouton" title="Haut de page"><img src="images/icone_fleche-retour.png" alt="Haut de page"/></a>
    </footer>
    </body>
</html>