<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Panneau chercheur</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="afficher-cacher.js"></script>
        <?php if(isset($_SESSION['logged']) == false){echo'<META HTTP-EQUIV="Refresh" CONTENT="1; URL=index.php">';} ?>
    </head>
    <body>
        
    <?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=projet_annelide;charset=utf8', 'root', '');
    }
    catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
    }
    if(isset($_GET['ajout'])){
    $req = $bdd->prepare('INSERT INTO bestioles (bestioles, nb) VALUES(?, ?)');
    $req->execute(array($_GET['mob'], $_GET['nb']));
    $req->closeCursor();}
    ?>

    <h1>Panneau chercheur</h1>
        
    <form>
        <fieldset>
            <legend><h2>Choix du projet</h2></legend>
            <select name="listprojet">
                <option>Projet 1</option>
                <option>Projet 2</option>
                <option>Projet X</option>
                <option>Projet blair witch</option>
                <option>Projet parquet cuisine</option>
            </select>
        </fieldset>
    </form>
        
    <form>
        <fieldset>
            <legend><h2>Choix du groupe</h2></legend>
            <select name="listtri">
                <option>Vu globale</option>
                <option>--------</option>
                <option>Groupe 1</option>
                <option>Groupe 2</option>
                <option>Groupe 3</option>
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
            <div class="couleur0-0">N20°14'5123" N20°14'5123"</div>
            <div class="couleur0-1">N20°14'5123" N20°14'5123"</div>
            <div>surface : "surface"</div>
            <div class="couleur1-0">N20°14'5123" N20°14'5123"</div>
            <div class="couleur1-1">N20°14'5123" N20°14'5123"</div>
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
                    echo'<td><input type="submit" id="modif" class="bouton" name="modif" value="Modifier"/></td>';
                    echo"</tr>";
                }$reponse->closeCursor();?>
            </tbody>
        </table> 
            
    </form>
    
    </body>
</html>