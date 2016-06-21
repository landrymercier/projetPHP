<?php
include_once 'PolygoneGPS.php';

class ZoneGPS extends PolygoneGPS {
    
    public function __construct($p1,$p2,$p3,$p4) {
        $desPoints=array($p1,$p2,$p3,$p4);
        parent::__construct($desPoints);
    }
    
    public function calculerSurfaceZone(){
        $triangle_1=new TriangleGPS($this->lesPoints[0],$this->lesPoints[1],$this->lesPoints[2]);
        $triangle_2=new TriangleGPS($this->lesPoints[2],$this->lesPoints[3],$this->lesPoints[0]);

        return $triangle_1->calculerSurfaceZone()+$triangle_2->calculerSurfaceZone();
    }
}
