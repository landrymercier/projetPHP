<?php
include_once 'PointGPS.php';
include_once 'PolygoneGPS.php';
include_once 'TriangleGPS.php';
include_once 'ZoneGPS.php';

/*$x_degres_1=$_POST["latitude_degres_1"];
$x_minutes_1=$_POST["latitude_minutes_1"];
$x_secondes_1=$_POST["latitude_secondes_1"];
$y_degres_1=$_POST["longitude_degres_1"];
$y_minutes_1=$_POST["longitude_minutes_1"];
$y_secondes_1=$_POST["longitude_secondes_1"];*/

//abscisse min et sec /1.5 et ordonnee min et sec /3 ???

$x_degres_1=47;
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
$y_secondes_4=3958;

$pt1 = new PointGPS($x_degres_1,$x_minutes_1,$x_secondes_1,$y_degres_1,$y_minutes_1,$y_secondes_1);
$pt2 = new PointGPS($x_degres_2,$x_minutes_2,$x_secondes_2,$y_degres_2,$y_minutes_2,$y_secondes_2);
echo"<br/>";
echo "A (".$pt1->x." , ".$pt1->y.")";
echo"<br/>";
echo "B (".$pt2->x." , ".$pt2->y.")";
echo"<br/>";

//var_dump(gettype($pt1));

$pt3 = new PointGPS($x_degres_3,$x_minutes_3,$x_secondes_3,$y_degres_3,$y_minutes_3,$y_secondes_3);
$pt4 = new PointGPS($x_degres_4,$x_minutes_4,$x_secondes_4,$y_degres_4,$y_minutes_4,$y_secondes_4);
echo"<br/>";
echo "C (".$pt3->x." , ".$pt3->y.")";
echo"<br/>";
echo "D (".$pt4->x." , ".$pt4->y.")";
echo"<br/>";

echo"<br/>";
echo "AB = ".$pt1->calculerDistance($pt2);
echo"<br/>";







$zone[]=new TriangleGPS($pt1,$pt2,$pt3);
$zone[]=new TriangleGPS($pt3,$pt4,$pt1);
$zone[]=new ZoneGPS($pt1,$pt2,$pt3,$pt4);

echo "<br/>";
echo "La surface de ABC = ".$zone[0]->calculerSurfaceZone();
echo "<br/>";
echo "La surface de CDA = ".$zone[2]->calculerSurfaceZone();
echo"<br/>";
echo "La surface totale = ".$zone_totale=($zone[0]->calculerSurfaceZone())+($zone[2]->calculerSurfaceZone());
?>
