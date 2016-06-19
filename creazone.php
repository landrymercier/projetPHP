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
    </head>
    
    <body id="top">
        <h1>Panneau chercheur</h1>
        
        <form>
            <select name="listprojet" size="1">
                <option>Projet 1</option>
                <option>Projet 2</option>
                <option>Projet X</option>
                <option>Projet blair witch</option>
                <option>Projet parquet cuisine</option>
            </select>
        </form>
        
        <form>
            <select name="listtri" size="1">
                <option>Vu globale</option>
                <option>--------</option>
                <option>Groupe 1</option>
                <option>Groupe 2</option>
                <option>Groupe 3</option>
            </select>
        </form>

        <div>
            "nom projet"<br>
            "nom commune"<br>
            "date"<br>
            "nom plage"<br>
        </div>
        <div>
            coord1 : "coordsX" "coordsY"<br>
            coord2 : "coordsX" "coordsY"<br>
            coord3 : "coordsX" "coordsY"<br>
            coord4 : "coordsX" "coordsY"<br>
        </div>

        <form method="post" action="traitement.php">
            
            <table class="tablelist">
                <tr>
                    <td>Espèces</td>
                    <td>Nb</td>
                    <td></td>
                </tr>
                <tr>
                    <td><input class="mob" type="text" name="mob" /></td>
                    <td><input class="champ" type="text" name="nb" /></td>
                    <td><button class="envoyer">Ajouter</button></td>
                </tr>
                <tr>
                    <td>une espèce</td>
                    <td>42</td>
                    <td><button class="envoyer">Modifier</button></td>
                </tr>
            </table>
            <button class="envoyer">Retour</button>
            <button class="envoyer">Cloturer</button>
            
            
        </form>