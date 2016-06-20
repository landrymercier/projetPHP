<?php
include_once 'PointGPS.php';

$x_degres_1=$_POST["latitude_degres_1"];
$x_minutes_1=$_POST["latitude_minutes_1"];
$x_secondes_1=$_POST["latitude_secondes_1"];
$y_degres_1=$_POST["longitude_degres_1"];
$y_minutes_1=$_POST["longitude_minutes_1"];
$y_secondes_1=$_POST["longitude_secondes_1"];

echo "$x_degres_1 $x_minutes_1 $x_secondes_1 $y_degres_1 $y_minutes_1 $y_secondes_1";

$pt1 = new PointGPS($x_degres_1,$x_minutes_1,$x_secondes_1,$y_degres_1,$y_minutes_1,$y_secondes_1);
echo"<br/>";
echo "A (".$pt1->x.",".$pt1->y.")";

//var_dump(gettype($pt1));
?>
