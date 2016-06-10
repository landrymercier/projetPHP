<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <title>Panneau chercheur</title>
    </head>
    <body>
        <h1>Panneau chercheur</h1>
        
    <FORM>
        <SELECT name="listprojet" size="1">
        <OPTION>Projet 1</OPTION>
        <OPTION>Projet 2</OPTION>
        <OPTION>Projet X</OPTION>
        <OPTION>Projet blair witch</OPTION>
        <OPTION>Projet parquet cuisine</OPTION>
        </SELECT>
    </FORM>
        
    <FORM>
        <SELECT name="listtri" size="1">
        <OPTION>Vu globale</OPTION>
        <OPTION>--------</OPTION>
        <OPTION>Groupe 1</OPTION>
        <OPTION>Groupe 2</OPTION>
        <OPTION>Groupe 3</OPTION>
        </SELECT>
    </FORM>

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

        <br>
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