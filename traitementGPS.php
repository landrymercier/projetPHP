<?php
include_once 'PointGPS.php';

/*$x_degres_1=$_POST["latitude_degres_1"];
$x_minutes_1=$_POST["latitude_minutes_1"];
$x_secondes_1=$_POST["latitude_secondes_1"];
$y_degres_1=$_POST["longitude_degres_1"];
$y_minutes_1=$_POST["longitude_minutes_1"];
$y_secondes_1=$_POST["longitude_secondes_1"];*/

$x_degres_1=1;
$x_minutes_1=26;
$x_secondes_1=3264;
$y_degres_1=64;
$y_minutes_1=32;
$y_secondes_1=6325;

$x_degres_2=5;
$x_minutes_2=37;
$x_secondes_2=6914;
$y_degres_2=39;
$y_minutes_2=58;
$y_secondes_2=7643;

echo "$x_degres_1 $x_minutes_1 $x_secondes_1 $y_degres_1 $y_minutes_1 $y_secondes_1";

$pt1 = new PointGPS($x_degres_1,$x_minutes_1,$x_secondes_1,$y_degres_1,$y_minutes_1,$y_secondes_1);
$pt2 = new PointGPS($x_degres_2,$x_minutes_2,$x_secondes_2,$y_degres_2,$y_minutes_2,$y_secondes_2);
echo"<br/>";
echo "A (".$pt1->x." , ".$pt1->y.")";
echo"<br/>";
echo "B (".$pt2->x." , ".$pt2->y.")";
echo"<br/>";

//var_dump(gettype($pt1));

echo "AB = ".$pt1->calculerDistance($pt2);
?>
