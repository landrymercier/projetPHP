<?php
include_once 'PointGPS.php';
include_once 'PolygoneGPS.php';
include_once 'TriangleGPS.php';
include_once 'ZoneGPS.php';
include_once 'Config.php';

/*Premier point*/

$x_degres_1=$_POST["latitude_degres_1"];
$x_minutes_1=$_POST["latitude_minutes_1"];
$x_secondes_1=$_POST["latitude_secondes_1"];
$y_degres_1=$_POST["longitude_degres_1"];
$y_minutes_1=$_POST["longitude_minutes_1"];
$y_secondes_1=$_POST["longitude_secondes_1"];


/*Deuxieme point*/
$x_degres_2=$_POST["latitude_degres_2"];
$x_minutes_2=$_POST["latitude_minutes_2"];
$x_secondes_2=$_POST["latitude_secondes_2"];
$y_degres_2=$_POST["longitude_degres_2"];
$y_minutes_2=$_POST["longitude_minutes_2"];
$y_secondes_2=$_POST["longitude_secondes_2"];


/*Troisieme point*/
$x_degres_3=$_POST["latitude_degres_3"];
$x_minutes_3=$_POST["latitude_minutes_3"];
$x_secondes_3=$_POST["latitude_secondes_3"];
$y_degres_3=$_POST["longitude_degres_3"];
$y_minutes_3=$_POST["longitude_minutes_3"];
$y_secondes_3=$_POST["longitude_secondes_3"];


/*Quatrieme point*/
$x_degres_4=$_POST["latitude_degres_4"];
$x_minutes_4=$_POST["latitude_minutes_4"];
$x_secondes_4=$_POST["latitude_secondes_4"];
$y_degres_4=$_POST["longitude_degres_4"];
$y_minutes_4=$_POST["longitude_minutes_4"];
$y_secondes_4=$_POST["longitude_secondes_4"];

$pt1 = new PointGPS($x_degres_1,$x_minutes_1,$x_secondes_1,$y_degres_1,$y_minutes_1,$y_secondes_1);
$pt2 = new PointGPS($x_degres_2,$x_minutes_2,$x_secondes_2,$y_degres_2,$y_minutes_2,$y_secondes_2);
$pt3 = new PointGPS($x_degres_3,$x_minutes_3,$x_secondes_3,$y_degres_3,$y_minutes_3,$y_secondes_3);
$pt4 = new PointGPS($x_degres_4,$x_minutes_4,$x_secondes_4,$y_degres_4,$y_minutes_4,$y_secondes_4);

$pt1->calculerDistance($pt2);
$pt2->calculerDistance($pt3);
$pt3->calculerDistance($pt1);
$pt3->calculerDistance($pt4);
$pt4->calculerDistance($pt1);

$zone[]=new TriangleGPS($pt1,$pt2,$pt3);
$zone[]=new TriangleGPS($pt3,$pt4,$pt1);
$zone[]=new ZoneGPS($pt1,$pt2,$pt3,$pt4);

$zone[0]->calculerSurfaceZone();
$zone[2]->calculerSurfaceZone();
$zone_totale=($zone[0]->calculerSurfaceZone())+($zone[2]->calculerSurfaceZone());


if(isset($_POST['cree'])){
try {
            $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        
        $req = $bdd->prepare('INSERT INTO zones (IDplage,latA,longA,latB,longB,latC,longC,latD,longD,Nom,Superficie,Clore) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
        $req->execute(array($_POST['idprojet'], $x_degres_1."°".$x_minutes_1."'".$x_secondes_1."\"",
                                                    $y_degres_1."°".$y_minutes_1."'".$y_secondes_1."\"",
                                                    $x_degres_2."°".$x_minutes_2."'".$x_secondes_2."\"",
                                                    $y_degres_2."°".$y_minutes_2."'".$y_secondes_2."\"",
                                                    $x_degres_3."°".$x_minutes_3."'".$x_secondes_3."\"",
                                                    $y_degres_3."°".$y_minutes_3."'".$y_secondes_3."\"",
                                                    $x_degres_4."°".$x_minutes_4."'".$x_secondes_4."\"",
                                                    $y_degres_4."°".$y_minutes_4."'".$y_secondes_4."\"",
                                                    $_POST['nom-groupe'], $zone_totale, 0));
        $req->closeCursor();
        echo"<br><br>";
        echo $_POST['idprojet']." , ". $x_degres_1."°".$x_minutes_1."'".$x_secondes_1."\"" ." , ".
                                                    $y_degres_1."°".$y_minutes_1."'".$y_secondes_1."\"" ." , ".
                                                    $x_degres_2."°".$x_minutes_2."'".$x_secondes_2."\"" ." , ".
                                                    $y_degres_2."°".$y_minutes_2."'".$y_secondes_2."\"" ." , ".
                                                    $x_degres_3."°".$x_minutes_3."'".$x_secondes_3."\"" ." , ".
                                                    $y_degres_3."°".$y_minutes_3."'".$y_secondes_3."\"" ." , ".
                                                    $x_degres_4."°".$x_minutes_4."'".$x_secondes_4."\"" ." , ".
                                                    $y_degres_4."°".$y_minutes_4."'".$y_secondes_4."\"" ." , ".
                                                    $_POST['nom-groupe'] ." , ". $zone_totale ." , 0";
}
?>
