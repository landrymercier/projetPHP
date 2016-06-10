<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>"nom du projet via Php"</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="afficher-cacher.js"></script>
    </head>
    <body>

    <?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=projet_annelide;charset=utf8', 'root', '');
    }
    catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
    }
    /*if(isset($_GET['ajout'])){
    $req = $bdd->prepare('INSERT INTO bestioles (bestioles, nb) VALUES(?, ?)');
    $req->execute(array($_GET['mob'], $_GET['nb']));}
    $reponse->closeCursor();*/
    ?>
        
    <h1>"Nom du groupe en Php"</h1>
    
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
            <div class="couleur0-0">N20°14'5123" N20°14'5123"</div>
            <div class="couleur0-1">N20°14'5123" N20°14'5123"</div>
            <div>surface : "surface"</div>
            <div class="couleur1-0">N20°14'5123" N20°14'5123"</div>
            <div class="couleur1-1">N20°14'5123" N20°14'5123"</div>
        </div>
    </div>
    
    <form method="post" action="traitement.php">
            
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
                <tr>
                    <td><input type="text" name="mob" id="mob" placeholder="Choisissez un nom" required/></td>
                    <td><input type="number" min="0" name="nb" id="nb" placeholder="Choisissez un chiffre" required/></td>
                    <td><input type="submit" id="ajout" class="bouton" name="ajout" value="Ajouter"/></td>
                </tr>
                <?php
                $reponse = $bdd->query("SELECT * FROM bestioles");
                while ($donnees = $reponse->fetch())
                {
                   echo"<tr>";
                   echo"<td>".$donnees['bestioles']."</td>";
                   echo"<td>".$donnees['nb']."</td>";
                   echo'<td><input type="submit" id="modifie" class="bouton" name="modifie" value="Modifier"/></td>';
                   echo"</tr>";
                }$reponse->closeCursor();?>
            </tbody>
        </table>

        <a href="index.php" class="bouton">Retour</a>
        <input type="submit" id="cloture" class="bouton" name="cloture" value="Cloturer"/>
      
    </form>

    </body>
</html>
