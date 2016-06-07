<!DOCTYPE html>
<html>
    <head>
        <title>Interface Préleveur</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css"/>
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
        $req->execute(defined(array($_GET['mob'], $_GET['nb'])));
        $reponse->closeCursor();}
    ?>
    
    <h1>Interface de saisie de prélèvement</h1>
        
    <a href="login.php" class="bouton">Connexion</a>

    <form action="preleveur" method="post">        
        <label for="nom-projet">Projet :</label>
        <input list="projet" id="nom-projet">
        <datalist id="projet"> 
            <option>Projet1</option> 
            <option>Projet2</option> 
            <option>Projet3</option> 
            <option>Projet4</option> 
            <option>Projet5</option> 
            <option>Projet6</option> 
            <option>Projet7</option> 
            <option>Projet8</option> 
        </datalist>  
   
        <table>
            <caption><h2>Groupe(s) assigné(s) au projet</h2></caption>
            <thead><!--en tete de tableau-->
                <tr>
                    <th>Nom du groupe</th>
                    <th>Fonctions</th>
                </tr>
            </thead>
            <tfoot><!--en tete de tableau-->
                <tr>
                    <th>Nom du groupe</th>
                    <th>Fonctions</th>
                </tr>
            </tfoot>
            
            <?php
            $reponse = $bdd->query("SELECT * FROM groupe");
            while ($donnees = $reponse->fetch())
            {
               echo"<tr>";
               echo"<td>".$donnees['Nom']."</td>";
               echo'<td><input type="submit" id="complete" class="bouton" name="complete" value="Compléter"/></td>';
               echo"</tr>";
            }$reponse->closeCursor();?>
        </table>
   
        <h2>Inscription d'un nouveau groupe</h2>
        <p>
            <label for="nom-groupe">Nom du Groupe :</label>
            <input type="text" name="nom-groupe" id="nom-groupe" placeholder="Choisissez un nom" required/>
        </p>
        <div class="saisie-coordonnees">
            <h3>Coordonnees 1 XY</h3>
                <input type="number" min="0" name="latitude_degres_1" id="latitude_degres_1" placeholder="Saisissez une valeur en degrés" required/>
                <label for="latitude_degres_1">deg</label>
                
                <input type="number" min="0" name="latitude_minutes_1" id="latitude_minutes_1" placeholder="Saisissez une valeur en minutes" required/>
                <label for="latitude_minutes_1">min</label>
                
                <input type="number" min="0" name="latitude_secondes_1" id="latitude_secondes_1" placeholder="Saisissez une valeur en secondes" required/>
                <label for="latitude_secondes_1">sec</label>
        </div>
        <div class="saisie-coordonnees">
            <h3>Coordonnees 2 XY</h3>
                <input type="number" min="0" name="longitude_degres_2" id="longitude_degres_2" placeholder="Saisissez une valeur en degrés" required/>
                <label for="longitude_degres_2">deg</label>
                
                <input type="number" min="0" name="longitude_minutes_2" id="longitude_minutes_2" placeholder="Saisissez une valeur en minutes" required/>
                <label for="longitude_minutes_2">min</label>
                
                <input type="number" min="0" name="longitude_secondes_2" id="longitude_secondes_2" placeholder="Saisissez une valeur en secondes" required/>
                <label for="longitude_secondes_2">sec</label>
        </div> 
        <div class="saisie-coordonnees">
            <h3>Coordonnees 3 XY</h3>
                <input type="number" min="0" name="latitude_degres_3" id="latitude_degres_3" placeholder="Saisissez une valeur en degrés" required/>
                <label for="latitude_degres_3">deg</label>
                
                <input type="number" min="0" name="latitude_minutes_3" id="latitude_minutes_3" placeholder="Saisissez une valeur en minutes" required/>
                <label for="latitude_minutes_3">min</label>
                
                <input type="number" min="0" name="latitude_secondes_3" id="latitude_secondes_3" placeholder="Saisissez une valeur en secondes" required/>
                <label for="latitude_secondes_3">sec</label>
        </div>
        <div class="saisie-coordonnees">
            <h3>Coordonnees 4 XY</h3>
                <input type="number" min="0" name="longitude_degres_4" id="longitude_degres_4" placeholder="Saisissez une valeur en degrés" required/>
                <label for="longitude_degres_4">deg</label>
                
                <input type="number" min="0" name="longitude_minutes_4" id="longitude_minutes_4" placeholder="Saisissez une valeur en minutes" required/>
                <label for="longitude_minutes_4">min</label>
                
                <input type="number" min="0" name="longitude_secondes_4" id="longitude_secondes_4" placeholder="Saisissez une valeur en secondes" required/>
                <label for="longitude_secondes_4">sec</label>
        </div>
        <div class="saisie-coordonnees">
            <h3>Coordonnees 5 XY</h3>
                <input type="number" min="0" name="latitude_degres_5" id="latitude_degres_5" placeholder="Saisissez une valeur en degrés" required/>
                <label for="latitude_degres_5">deg</label>
                
                <input type="number" min="0" name="latitude_minutes_5" id="latitude_minutes_5" placeholder="Saisissez une valeur en minutes" required/>
                <label for="latitude_minutes_5">min</label>
                
                <input type="number" min="0" name="latitude_secondes_5" id="latitude_secondes_5" placeholder="Saisissez une valeur en secondes" required/>
                <label for="latitude_secondes_5">sec</label>
        </div>
        <div class="saisie-coordonnees">
            <h3>Coordonnees 6 XY</h3>
                <input type="number" min="0" name="longitude_degres_6" id="longitude_degres_6" placeholder="Saisissez une valeur en degrés" required/>
                <label for="longitude_degres_6">deg</label>
                
                <input type="number" min="0" name="longitude_minutes_6" id="longitude_minutes_6" placeholder="Saisissez une valeur en minutes" required/>
                <label for="longitude_minutes_6">min</label>
                
                <input type="number" min="0" name="longitude_secondes_6" id="longitude_secondes_6" placeholder="Saisissez une valeur en secondes" required/>
                <label for="longitude_secondes_6">sec</label>
        </div> 
        <div class="saisie-coordonnees">
            <h3>Coordonnees 7 XY</h3>
                <input type="number" min="0" name="latitude_degres_7" id="latitude_degres_7" placeholder="Saisissez une valeur en degrés" required/>
                <label for="latitude2_degres_7">deg</label>
                
                <input type="number" min="0" name="latitude_minutes_7" id="latitude_minutes_7" placeholder="Saisissez une valeur en minutes" required/>
                <label for="latitude_minutes_7">min</label>
                
                <input type="number" min="0" name="latitude_secondes_7" id="latitude_secondes_7" placeholder="Saisissez une valeur en secondes" required/>
                <label for="latitude_secondes_7">sec</label>
        </div>
        <div class="saisie-coordonnees">
            <h3>Coordonnees 8 XY</h3>
                <input type="number" min="0" name="longitude_degres_8" id="longitude_degres_8" placeholder="Saisissez une valeur en degrés" required/>
                <label for="longitude_degres_8">deg</label>
                
                <input type="number" min="0" name="longitude_minutes_8" id="longitude_minutes_8" placeholder="Saisissez une valeur en minutes" required/>
                <label for="longitude_minutes_8">min</label>
                
                <input type="number" min="0" name="longitude_secondes_8" id="longitude_secondes_8" placeholder="Saisissez une valeur en secondes" required/>
                <label for="longitude_secondes_8">sec</label>
        </div>
        <input type="submit" id="cree"  class="bouton" name="cree" value="Créer" onclick="self.location.href='lien4.html'"/>
        
    </form>
    
    </body>
</html>
