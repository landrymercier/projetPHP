<?php
include_once 'PointGPS.php';
include_once 'PolygoneGPS.php';
include_once 'TriangleGPS.php';
include_once 'ZoneGPS.php';
include_once 'Config.php';

<<<<<<< HEAD



=======
/*Premier point*/
>>>>>>> 2baf07d400dbc799d20be8245e3e1b665468423e
$x_degres_1=$_POST["latitude_degres_1"];
$x_minutes_1=$_POST["latitude_minutes_1"];
$x_secondes_1=$_POST["latitude_secondes_1"];
$y_degres_1=$_POST["longitude_degres_1"];
$y_minutes_1=$_POST["longitude_minutes_1"];
$y_secondes_1=$_POST["longitude_secondes_1"];

<<<<<<< HEAD
=======
/*Deuxieme point*/
>>>>>>> 2baf07d400dbc799d20be8245e3e1b665468423e
$x_degres_2=$_POST["latitude_degres_2"];
$x_minutes_2=$_POST["latitude_minutes_2"];
$x_secondes_2=$_POST["latitude_secondes_2"];
$y_degres_2=$_POST["longitude_degres_2"];
$y_minutes_2=$_POST["longitude_minutes_2"];
$y_secondes_2=$_POST["longitude_secondes_2"];

<<<<<<< HEAD
=======
/*Troisieme point*/
>>>>>>> 2baf07d400dbc799d20be8245e3e1b665468423e
$x_degres_3=$_POST["latitude_degres_3"];
$x_minutes_3=$_POST["latitude_minutes_3"];
$x_secondes_3=$_POST["latitude_secondes_3"];
$y_degres_3=$_POST["longitude_degres_3"];
$y_minutes_3=$_POST["longitude_minutes_3"];
$y_secondes_3=$_POST["longitude_secondes_3"];

<<<<<<< HEAD
=======
/*Quatrieme point*/
>>>>>>> 2baf07d400dbc799d20be8245e3e1b665468423e
$x_degres_4=$_POST["latitude_degres_4"];
$x_minutes_4=$_POST["latitude_minutes_4"];
$x_secondes_4=$_POST["latitude_secondes_4"];
$y_degres_4=$_POST["longitude_degres_4"];
$y_minutes_4=$_POST["longitude_minutes_4"];
$y_secondes_4=$_POST["longitude_secondes_4"];
<<<<<<< HEAD

//abscisse min et sec /1.5 et ordonnee min et sec /3 ???

/*$x_degres_1=47;
$x_minutes_1=21;
$x_secondes_1=7146;
$y_degres_1=-1;
$y_minutes_1=55;
$y_secondes_1=4045;

$x_degres_2=47;
$x_minutes_2=21;
$x_secondes_2=7165;
$y_degres_2=-1;
$y_minutes_2=55;
$y_secondes_2=3909;

$x_degres_3=47;
$x_minutes_3=21;
$x_secondes_3=7234;
$y_degres_3=-1;
$y_minutes_3=55;
$y_secondes_3=4065;

$x_degres_4=47;
$x_minutes_4=21;
$x_secondes_4=7239;
$y_degres_4=-1;
$y_minutes_4=55;
$y_secondes_4=3958;*/
=======
>>>>>>> 2baf07d400dbc799d20be8245e3e1b665468423e

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

<<<<<<< HEAD
echo "<br/>";
echo "La surface de ABC = ".$zone[0]->calculerSurfaceZone();
echo "<br/>";
echo "La surface de CDA = ".$zone[2]->calculerSurfaceZone();
echo"<br/>";
echo "La surface totale = ".$zone_totale=($zone[0]->calculerSurfaceZone())+($zone[2]->calculerSurfaceZone());


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

=======
$zone[0]->calculerSurfaceZone();
$zone[2]->calculerSurfaceZone();
$zone_totale=($zone[0]->calculerSurfaceZone())+($zone[2]->calculerSurfaceZone());
>>>>>>> 2baf07d400dbc799d20be8245e3e1b665468423e
?>
