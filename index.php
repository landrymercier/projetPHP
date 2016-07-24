<?php
session_start();
include_once 'Config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Interface d'étude de prélèvement</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>

    <body id="index_ifrocean"> 
        <?php
        try {
            $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        ?>

        <h1>Interface d'étude de prélèvement</h1>

        <div class="btn-session">
        <?php
        if (isset($_SESSION['logged']) == true) {//GESTION DE LA SESSION, LE CHERCHEUR EST LOGGUE, PAS LE PRELEVEUR
            echo'<a href="tablechercheur.php" class="bouton" title="Page Chercheur"><img src="images/icone_session.png" alt="Page chercheur"/></a>';
        } else {
            echo'<a href="login.php" class="bouton" title="Se connecter"><img src="images/icone_login.png" alt="Se connecter"/></a>';
        }
        ?>
        </div>
        <div class="btn-aide">
            <a href="404.php" class="bouton" title="Aide"><img src="images/icone_aide.png" alt="Aide"/></a>
        </div>

        <form action="index.php" method="post" id="align-form-plage" class="marge-conteneur">
            <label for="nom">Sélectionnez une plage :</label>
            <select name="idprojet" id="nom">
                <?php
                //LISTE DES PROJETS EN COURS, ON RECUPERE L'ID POUR L'ENVOYER DANS LA REQUETE SUIVANTE
                $reponse = $bdd->query("SELECT ID,Nom FROM plage WHERE Clore = 0");
                while ($donnees = $reponse->fetch()) {
                    echo "<option value='" . $donnees['ID'] . "'>" . $donnees['Nom'] . "</option>";
                }
                $reponse->closeCursor();
                ?>
            </select>
            <div class="align-btn-droite">
                <input type="submit" class="bouton" value="Choisir" id="envoiprojet" name="envoiprojet"/>
            </div>
        </form>


        <table class="marge-conteneur">
            <caption><h2>Groupe(s) assigné(s) à la plage</h2></caption>
            <thead><!--en tete de tableau-->
                <tr>
                    <th>Nom du groupe</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot><!--en tete de tableau-->
                <tr>
                    <th>Nom du groupe</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            
                <?php
                if (isset($_POST['envoiprojet']) == "Envoyer") {
                    //AFFICHE LES GROUPES DEJA CREES SUIVANT LE PROJET SELECTIONNE
                    $reponse = $bdd->query("SELECT ID,Nom,Clore FROM zones WHERE IDplage = (SELECT ID FROM plage WHERE id=" . $_POST['idprojet'] . ")");
                    while ($donnees = $reponse->fetch()) {
                        echo"<tr>";
                        echo"<td>" . $donnees['Nom'] . "</td>";
                         
                        if($donnees['Clore'] == 1){ //SI LA ZONE EST CLOSE
                            echo'<td>Clos</td>';
                        } else { //LE PRELEVEUR PEUT COMPLETER SON PRELEVEMENT
                            echo'<form action="interprel.php" method="get">';
                            echo'<td><input type="hidden" name="groupeid" value="'. $donnees['ID'] .'"/>';
                            echo'<input type="submit" class="bouton" value="Completer"/></td>';
                            echo'</form>';
                        }
                        echo"</tr>";
                    }$reponse->closeCursor();
                }
                ?>
            
        </table>

        <?php
        if (isset($_SESSION['logged']) == false) {
            echo'
        <fieldset class="marge-conteneur" id="form-creation-groupe">
            <legend><h2>Création d\'un groupe</h2></legend>
            <form action="traitementGPS.php" method="post" id="align-form-groupe">
            
            <label for="nom">Sélectionnez une plage :</label>
            <select name="idprojet" id="nom">';
                $reponse = $bdd->query("SELECT ID,Nom FROM plage WHERE Clore = 0");
                while ($donnees = $reponse->fetch()) {
                    echo "<option value='" . $donnees['ID'] . "'>" . $donnees['Nom'] . "</option>";
                }
                $reponse->closeCursor();

            echo'</select>
            
            <p class="marge-conteneur">
                <label for="nom-groupe">Nom du Groupe :</label>
                <input type="text" name="nom-groupe" id="nom-groupe" placeholder="Choisissez un nom" required/>
            </p>
            <h3>Coordonnées de la zone de prélèvement</h3>
            <div id="align-form-coordonnee">
                <div>
                    <div class="saisie-coordonnees marge-conteneur">
                        <h4>Coordonnées du premier point</h4>
                        <p>
                            <span>Latitude</span>
                            <input type="number" min="0" max="90" step="1" name="latitude_degres_1" id="latitude_degres_1" placeholder="47" required/>
                            <label for="latitude_degres_1">°</label>

                            <input type="number" min="0" max="59" step="1" name="latitude_minutes_1" id="latitude_minutes_1" placeholder="13" required/>
                            <label for="latitude_minutes_1">\'</label>

                            <input type="number" min="0" max="59.99" step="0.01" name="latitude_secondes_1" id="latitude_secondes_1" placeholder="7,09" required/>
                            <label for="latitude_secondes_1">"</label>
                        </p>
                        <p>
                            <span>Longitude</span>
                            <input type="number" min="-180" max="180" step="1" name="longitude_degres_1" id="longitude_degres_1" placeholder="-1" required/>
                            <label for="longitude_degres_1">°</label>

                            <input type="number" min="0" max="59" step="1" name="longitude_minutes_1" id="longitude_minutes_1" placeholder="33" required/>
                            <label for="longitude_minutes_1">\'</label>

                            <input type="number" min="0" max="59.99" step="0.01" name="longitude_secondes_1" id="longitude_secondes_1" placeholder="33,74" required/>
                            <label for="longitude_secondes_1">"</label>
                        </p>
                    </div>
                    <div class="saisie-coordonnees marge-conteneur">
                        <h4>Coordonnées du deuxième point</h4>
                        <p>
                            <span>Latitude</span>
                            <input type="number" min="0" max="90" step="1" name="latitude_degres_2" id="latitude_degres_2" placeholder="48" required/>
                            <label for="latitude_degres_2">°</label>

                            <input type="number" min="0" max="59" step="1" name="latitude_minutes_2" id="latitude_minutes_2" placeholder="00" required/>
                            <label for="latitude_minutes_2">\'</label>

                            <input type="number" min="0" max="59.99" step="0.01" name="latitude_secondes_2" id="latitude_secondes_2" placeholder="19,96" required/>
                            <label for="latitude_secondes_2">"</label>
                        </p>
                        <p>
                            <span>Longitude</span>
                            <input type="number" min="-180" max="180" step="1" name="longitude_degres_2" id="longitude_degres_2" placeholder="0" required/>
                            <label for="longitude_degres_2">°</label>

                            <input type="number" min="0" max="59" step="1" name="longitude_minutes_2" id="longitude_minutes_2" placeholder="11" required/>
                            <label for="longitude_minutes_2">\'</label>

                            <input type="number" min="0" max="59.99" step="0.01" name="longitude_secondes_2" id="longitude_secondes_2" placeholder="59,33" required/>
                            <label for="longitude_secondes_2">"</label>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="saisie-coordonnees marge-conteneur">
                        <h4>Coordonnées du troisième point</h4>
                        <p>
                            <span>Latitude</span>
                            <input type="number" min="0" max="90" step="1" name="latitude_degres_3" id="latitude_degres_3" placeholder="47" required/>
                            <label for="latitude_degres_3">°</label>

                            <input type="number" min="0" max="59" step="1" name="latitude_minutes_3" id="latitude_minutes_3" placeholder="18" required/>
                            <label for="latitude_minutes_3">\'</label>

                            <input type="number" min="0" max="59.99" step="0.01" name="latitude_secondes_3" id="latitude_secondes_3" placeholder="5,71" required/>
                            <label for="latitude_secondes_3">"</label>
                        </p>
                        <p>
                            <span>Longitude</span>
                            <input type="number" min="-180" max="180" step="1" name="longitude_degres_3" id="longitude_degres_3" placeholder="5" required/>
                            <label for="longitude_degres_3">°</label>

                            <input type="number" min="0" max="59" step="1" name="longitude_minutes_3" id="longitude_minutes_3" placeholder="03" required/>
                            <label for="longitude_minutes_3">\'</label>

                            <input type="number" min="0" max="59.99" step="0.01" name="longitude_secondes_3" id="longitude_secondes_3" placeholder="23,25" required/>
                            <label for="longitude_secondes_3">"</label>
                        </p>
                    </div> 
                    <div class="saisie-coordonnees marge-conteneur">
                        <h4>Coordonnees du quatrième point</h4>
                        <p>
                            <span>Latitude</span>
                            <input type="number" min="0" max="90" step="1" name="latitude_degres_4" id="latitude_degres_4" placeholder="45" required/>
                            <label for="latitude_degres_4">°</label>

                            <input type="number" min="0" max="59" step="1" name="latitude_minutes_4" id="latitude_minutes_4" placeholder="49" required/>
                            <label for="latitude_minutes_4">\'</label>

                            <input type="number" min="0" max="59.99" step="0.01" name="latitude_secondes_4" id="latitude_secondes_4" placeholder="33,34" required/>
                            <label for="latitude_secondes_4">"</label>
                        </p>
                        <p>
                            <span>Longitude</span>
                            <input type="number" min="-180" max="180" step="1" name="longitude_degres_4" id="longitude_degres_4" placeholder="1" required/>
                            <label for="longitude_degres_4">°</label>

                            <input type="number" min="0" max="59" step="1" name="longitude_minutes_4" id="longitude_minutes_4" placeholder="16" required/>
                            <label for="longitude_minutes_4">\'</label>

                            <input type="number" min="0" max="59.99" step="0.01" name="longitude_secondes_4" id="longitude_secondes_4" placeholder="15,53" required/>
                            <label for="longitude_secondes_4">"</label>
                        </p>
                    </div>
                </div>
            </div>
            <div class="align-btn-droite">
                <input type="submit" id="cree" class="bouton" name="cree" value="Créer"/>
                <input type="reset" class="bouton" value="Vider"/>
            </div>
        </form>
        </fieldset>';
        }
        ?>
        <footer>
            <a href="#index_ifrocean" class="bouton" title="Haut de page"><img src="images/icone_fleche-retour.png" alt="Haut de page"/></a>
        </footer>
        
        <!--import javascript-->
        <!--import de la bibliotheque jQuery pour les animations-->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <!--script javascript-->
        <!--script js de la fonction easing de jQuery non incluse dans la bibliotheque par defaut-->
        <script type="text/javascript" src="scripts/jquery.easing.1.3.js"></script>
        <!--script js de la fonction softScroll pour les ancres-->
        <script type="text/javascript" src="scripts/scroll.js"></script>
    </body>
</html>
