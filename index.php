<?php session_start();
//session_destroy(); 
include_once 'Config.php';?>
<!DOCTYPE html>
<html>
    <head>
        <title>Interface d'étude de prélèvement</title>
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
    <?php
    try{
        $bdd = new PDO('mysql:host='.Config::SERVERNAME.';dbname='.Config::DBNAME.';charset=utf8', Config::LOGIN, '');
        }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
        }
    ?>
    
    <h1>Interface d'étude de prélèvement</h1>
        
    <?php if(isset($_SESSION['logged']) == true){//GESTION DE LA SESSION, LE CHERCHEUR EST LOGGUE, PAS LE PRELEVEUR
            echo'<a href="interchercheur.php" class="bouton">Accès préleveur</a>';
         }
            else{echo'<a href="login.php" class="bouton">Connexion</a>';
         } 
        ?>
    
    <form action="interprel.php" method="post">
        <label for="nom-projet">Projet :</label>
        <input list="projet" id="nom-projet">
        <?php //REQUETE POUR LA LISTE DES PROJETS EN COURS
        $reponse = $bdd->query("SELECT Nom FROM plage");
        echo "<datalist id=\"projet\">"; 
            while ($donnees = $reponse->fetch()) {
                echo "<option>".$donnees['Nom']."</option>";}
        echo "</datalist>";  
        $reponse->closeCursor();?>

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
            
            <?php //AFFICHE LES GROUPES DEJA CREES SUIVANT LE PROJET SELECTIONNE
            $reponse = $bdd->query("SELECT Nom FROM zones WHERE IDplage = (SELECT ID FROM plage WHERE Nom ='Crevette-sur-salade')");
            while ($donnees = $reponse->fetch())
            {
               echo"<tr>";
               echo"<td>".$donnees['Nom']."</td>";
               if(isset($_SESSION['logged']) == true){ //LE CHERCHEUR PEUT TERMINER UN PRELEVEMENT
                   echo'<td><input type="submit" id="complete" class="bouton" name="complete" value="Clore"/></td>';
               }
               else{ //LE PRELEVEUR PEUT COMPLETER SON PRELEVEMENT
                   echo'<td><input type="submit" id="complete" class="bouton" name="complete" value="Compléter"/></td>';
               }
               echo"</tr>";
            }$reponse->closeCursor();?>
        </table>
    </form>
    
   <?php if(isset($_SESSION['logged']) == false){
        echo'
        <form action="traitementGPS.php" method="post">
            <h2>Inscription d\'un nouveau groupe</h2>
            <p>
                <label for="nom-groupe">Nom du Groupe :</label>
                <input type="text" name="nom-groupe" id="nom-groupe" placeholder="Choisissez un nom" required/>
            </p>
            <div class="saisie-coordonnees">
                <h3>Coordonnees 1</h3>
                    <p>
                        Latitude
                        <input type="number" min="0" max="90" step="1" name="latitude_degres_1" id="latitude_degres_1" placeholder="Saisissez une valeur en degrés" required/>
                        <label for="latitude_degres_1">deg</label>

                        <input type="number" min="0" step="1" name="latitude_minutes_1" id="latitude_minutes_1" placeholder="Saisissez une valeur en minutes" required/>
                        <label for="latitude_minutes_1">min</label>

                        <input type="number" min="0" step="1" name="latitude_secondes_1" id="latitude_secondes_1" placeholder="Saisissez une valeur en secondes" required/>
                        <label for="latitude_secondes_1">sec</label>
                    </p>
                    <p>
                        longitude
                        <input type="number" min="-180" max="180" step="1" name="longitude_degres_1" id="longitude_degres_1" placeholder="Saisissez une valeur en degrés" required/>
                        <label for="longitude_degres_1">deg</label>

                        <input type="number" min="0" step="1" name="longitude_minutes_1" id="longitude_minutes_1" placeholder="Saisissez une valeur en minutes" required/>
                        <label for="longitude_minutes_1">min</label>

                        <input type="number" min="0" step="1" name="longitude_secondes_1" id="longitude_secondes_1" placeholder="Saisissez une valeur en secondes" required/>
                        <label for="longitude_secondes_1">sec</label>
                    </p>
            </div> 
            <div class="saisie-coordonnees">
                <h3>Coordonnees 2</h3>
                    <p>
                        Latitude
                        <input type="number" min="0" max="90" step="1" name="latitude_degres_2" id="latitude_degres_2" placeholder="Saisissez une valeur en degrés" required/>
                        <label for="latitude_degres_2">deg</label>

                        <input type="number" min="0" step="1" name="latitude_minutes_2" id="latitude_minutes_2" placeholder="Saisissez une valeur en minutes" required/>
                        <label for="latitude_minutes_2">min</label>

                        <input type="number" min="0" step="1" name="latitude_secondes_2" id="latitude_secondes_2" placeholder="Saisissez une valeur en secondes" required/>
                        <label for="latitude_secondes_2">sec</label>
                    </p>
                    <p>
                        longitude
                        <input type="number" min="-180" max="180" step="1" name="longitude_degres_2" id="longitude_degres_2" placeholder="Saisissez une valeur en degrés" required/>
                        <label for="longitude_degres_2">deg</label>

                        <input type="number" min="0" step="1" name="longitude_minutes_2" id="longitude_minutes_2" placeholder="Saisissez une valeur en minutes" required/>
                        <label for="longitude_minutes_2">min</label>

                        <input type="number" min="0" step="1" name="longitude_secondes_2" id="longitude_secondes_2" placeholder="Saisissez une valeur en secondes" required/>
                        <label for="longitude_secondes_2">sec</label>
                    </p>
            </div>
            <div class="saisie-coordonnees">
                <h3>Coordonnees 3</h3>
                    <p>
                        Latitude
                        <input type="number" min="0" max="90" step="1" name="latitude_degres_3" id="latitude_degres_3" placeholder="Saisissez une valeur en degrés" required/>
                        <label for="latitude_degres_3">deg</label>

                        <input type="number" min="0" step="1" name="latitude_minutes_3" id="latitude_minutes_3" placeholder="Saisissez une valeur en minutes" required/>
                        <label for="latitude_minutes_3">min</label>

                        <input type="number" min="0" step="1" name="latitude_secondes_3" id="latitude_secondes_3" placeholder="Saisissez une valeur en secondes" required/>
                        <label for="latitude_secondes_3">sec</label>
                    </p>
                    <p>
                        longitude
                        <input type="number" min="-180" max="180" step="1" name="longitude_degres_3" id="longitude_degres_3" placeholder="Saisissez une valeur en degrés" required/>
                        <label for="longitude_degres_3">deg</label>

                        <input type="number" min="0" step="1" name="longitude_minutes_3" id="longitude_minutes_3" placeholder="Saisissez une valeur en minutes" required/>
                        <label for="longitude_minutes_3">min</label>

                        <input type="number" min="0" step="1" name="longitude_secondes_3" id="longitude_secondes_3" placeholder="Saisissez une valeur en secondes" required/>
                        <label for="longitude_secondes_3">sec</label>
                    </p>
            </div> 
            <div class="saisie-coordonnees">
                <h3>Coordonnees 4</h3>
                    <p>
                        latitude
                        <input type="number" min="0" max="90" step="1" name="latitude_degres_4" id="latitude_degres_4" placeholder="Saisissez une valeur en degrés" required/>
                        <label for="latitude_degres_4">deg</label>

                        <input type="number" min="0" step="1" name="latitude_minutes_4" id="latitude_minutes_4" placeholder="Saisissez une valeur en minutes" required/>
                        <label for="latitude_minutes_4">min</label>

                        <input type="number" min="0" step="1" name="latitude_secondes_4" id="latitude_secondes_4" placeholder="Saisissez une valeur en secondes" required/>
                        <label for="latitude_secondes_4">sec</label>
                    </p>
                    <p>
                        longitude
                        <input type="number" min="-180" max="180" step="1" name="longitude_degres_4" id="longitude_degres_4" placeholder="Saisissez une valeur en degrés" required/>
                        <label for="longitude_degres_4">deg</label>

                        <input type="number" min="0" step="1" name="longitude_minutes_4" id="longitude_minutes_4" placeholder="Saisissez une valeur en minutes" required/>
                        <label for="longitude_minutes_4">min</label>

                        <input type="number" min="0" step="1" name="longitude_secondes_4" id="longitude_secondes_4" placeholder="Saisissez une valeur en secondes" required/>
                        <label for="longitude_secondes_4">sec</label>
                    </p>
            </div>
            <input type="submit" id="cree" class="bouton" name="cree" value="Créer"/>
            <input type="reset" class="bouton" value="Vider"/>
        </form>';
        } ?>
    <footer>
        <a href="#top" class="bouton" title="Haut de page"><img src="images/icone_fleche-retour.png" alt="Haut de page"/></a>
    </footer>
    </body>
</html>
