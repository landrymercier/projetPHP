<?php

include_once 'PointGPS.php';
include_once 'PolygoneGPS.php';
include_once 'TriangleGPS.php';
include_once 'ZoneGPS.php';
include_once 'Config.php';

/* Premier point */

$x_degres_1 = $_POST["latitude_degres_1"];
$x_minutes_1 = $_POST["latitude_minutes_1"];
$x_secondes_1 = $_POST["latitude_secondes_1"];
$y_degres_1 = $_POST["longitude_degres_1"];
$y_minutes_1 = $_POST["longitude_minutes_1"];
$y_secondes_1 = $_POST["longitude_secondes_1"];


/* Deuxieme point */
$x_degres_2 = $_POST["latitude_degres_2"];
$x_minutes_2 = $_POST["latitude_minutes_2"];
$x_secondes_2 = $_POST["latitude_secondes_2"];
$y_degres_2 = $_POST["longitude_degres_2"];
$y_minutes_2 = $_POST["longitude_minutes_2"];
$y_secondes_2 = $_POST["longitude_secondes_2"];


/* Troisieme point */
$x_degres_3 = $_POST["latitude_degres_3"];
$x_minutes_3 = $_POST["latitude_minutes_3"];
$x_secondes_3 = $_POST["latitude_secondes_3"];
$y_degres_3 = $_POST["longitude_degres_3"];
$y_minutes_3 = $_POST["longitude_minutes_3"];
$y_secondes_3 = $_POST["longitude_secondes_3"];


/* Quatrieme point */
$x_degres_4 = $_POST["latitude_degres_4"];
$x_minutes_4 = $_POST["latitude_minutes_4"];
$x_secondes_4 = $_POST["latitude_secondes_4"];
$y_degres_4 = $_POST["longitude_degres_4"];
$y_minutes_4 = $_POST["longitude_minutes_4"];
$y_secondes_4 = $_POST["longitude_secondes_4"];

$pt1 = new PointGPS($x_degres_1, $x_minutes_1, $x_secondes_1, $y_degres_1, $y_minutes_1, $y_secondes_1);
$pt2 = new PointGPS($x_degres_2, $x_minutes_2, $x_secondes_2, $y_degres_2, $y_minutes_2, $y_secondes_2);
$pt3 = new PointGPS($x_degres_3, $x_minutes_3, $x_secondes_3, $y_degres_3, $y_minutes_3, $y_secondes_3);
$pt4 = new PointGPS($x_degres_4, $x_minutes_4, $x_secondes_4, $y_degres_4, $y_minutes_4, $y_secondes_4);

//enregister les variables ci dessous en base pour l'export kml
$pt1_x = $pt1->getX();
$pt1_y = $pt1->getY();
$pt2_x = $pt2->getX();
$pt2_y = $pt2->getY();
$pt3_x = $pt3->getX();
$pt3_y = $pt3->getY();
$pt4_x = $pt4->getX();
$pt4_y = $pt4->getY();
//echo $pt1_x . "/" . $pt1_y . "<br/>" . $pt2_x . "/" . $pt2_y . "<br/>" . $pt3_x . "/" . $pt3_y . "<br/>" . $pt4_x . "/" . $pt4_y . "<br/>";
//enregister les variables ci dessus en base pour l'export kml

$pt1->calculerDistance($pt2);
$pt2->calculerDistance($pt3);
$pt3->calculerDistance($pt1);
$pt3->calculerDistance($pt4);
$pt4->calculerDistance($pt1);

$zone[] = new TriangleGPS($pt1, $pt2, $pt3);
$zone[] = new TriangleGPS($pt3, $pt4, $pt1);
$zone[] = new ZoneGPS($pt1, $pt2, $pt3, $pt4);

$zone[0]->calculerSurfaceZone();
$zone[2]->calculerSurfaceZone();
$zone_totale = ($zone[0]->calculerSurfaceZone()) + ($zone[2]->calculerSurfaceZone());


if (isset($_POST['cree'])) {
    try {
        $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    //echo"<br><br>";
    //echo $_POST['idprojet'] . " , " . $x_degres_1 . "°" . $x_minutes_1 . "'" . $x_secondes_1 . "\"" . " , " .
    //$y_degres_1 . "°" . $y_minutes_1 . "'" . $y_secondes_1 . "\"" . " , " .
    //$x_degres_2 . "°" . $x_minutes_2 . "'" . $x_secondes_2 . "\"" . " , " .
    //$y_degres_2 . "°" . $y_minutes_2 . "'" . $y_secondes_2 . "\"" . " , " .
    //$x_degres_3 . "°" . $x_minutes_3 . "'" . $x_secondes_3 . "\"" . " , " .
    //$y_degres_3 . "°" . $y_minutes_3 . "'" . $y_secondes_3 . "\"" . " , " .
    //$x_degres_4 . "°" . $x_minutes_4 . "'" . $x_secondes_4 . "\"" . " , " .
    //$y_degres_4 . "°" . $y_minutes_4 . "'" . $y_secondes_4 . "\"" . " , " .
    //$_POST['nom-groupe'] . " , " . $zone_totale . " , 0," .
    //$pt1_x . "," . $pt1_y . "," . $pt2_x . "," . $pt2_y . "," . $pt3_x . "," . $pt3_y . "," . $pt4_x . "," . $pt4_y;
//CREATION DU GROUPE
    $req = $bdd->prepare('INSERT INTO zones (IDplage,latA,longA,latB,longB,latC,longC,latD,longD,Nom,Superficie,Clore,deciXA,deciYA,deciXB,deciYB,deciXC,deciYC,deciXD,deciYD) '
            . 'VALUES(:idplage,:latA,:lonA,:latB,:lonB,:latC,:lonC,:latD,:lonD,:nom,:super,:clos,:XA,:YA,:XB,:YB,:XC,:YC,:XD,:YD)');

    $req->execute(array(
        "idplage" => $_POST['idprojet'],
        "latA" => $x_degres_1 . "°" . $x_minutes_1 . "'" . $x_secondes_1 . "\"", "lonA" => $y_degres_1 . "°" . $y_minutes_1 . "'" . $y_secondes_1 . "\"",
        "latB" => $x_degres_2 . "°" . $x_minutes_2 . "'" . $x_secondes_2 . "\"", "lonB" => $y_degres_2 . "°" . $y_minutes_2 . "'" . $y_secondes_2 . "\"",
        "latC" => $x_degres_3 . "°" . $x_minutes_3 . "'" . $x_secondes_3 . "\"", "lonC" => $y_degres_3 . "°" . $y_minutes_3 . "'" . $y_secondes_3 . "\"",
        "latD" => $x_degres_4 . "°" . $x_minutes_4 . "'" . $x_secondes_4 . "\"", "lonD" => $y_degres_4 . "°" . $y_minutes_4 . "'" . $y_secondes_4 . "\"",
        "nom" => $_POST['nom-groupe'],
        "super" => $zone_totale,
        "clos" => 0,
        "XA" => $pt1_x, "YA" => $pt1_y,
        "XB" => $pt2_x, "YB" => $pt2_y,
        "XC" => $pt3_x, "YC" => $pt3_y,
        "XD" => $pt4_x, "YD" => $pt4_y));
    $req->closeCursor();


    $req = $bdd->query('SELECT ID FROM zones ORDER BY ID DESC LIMIT 1');
    $id = $req->fetch();


    echo'<html>
    <head>
        <title>Connexion réussie</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <meta http-equiv="Refresh" content="3; url=interprel.php?groupeid=' . $id['ID'] . '">
    </head>
    
    <body id="logged_ifrocean">
        <div class="valide_content">
            <h1>Création de groupe réussie !</h1>
            <p>Si vous n\'êtes pas redirigé dans quelques secondes, cliquez sur ce <a href="interprel.php?groupeid=' . $id['ID'] . '">lien</a>.</p>
        </div>  
    </body>       
</html>';
} else {
    echo'<a href="index.php">Oups, il semble y avoir eu des erreurs, <a href="index.php">cliquez ici</a> pour retourner vers l\'index </a>';
}
?>