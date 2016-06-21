<?php
include_once 'PolygoneGPS.php';

class TriangleGPS extends PolygoneGPS {
    
    public function __construct($p1,$p2,$p3) {
        $desPoints=array($p1,$p2,$p3);
        parent::__construct($desPoints);
    }
    
    public function calculerSurfaceZone(){
        $cote1=$this->lesPoints[0]->calculerDistance($this->lesPoints[1]);
        $cote2=$this->lesPoints[2]->calculerDistance($this->lesPoints[1]);
        $cote3=$this->lesPoints[0]->calculerDistance($this->lesPoints[2]);

        $perimetre=($cote1+$cote2+$cote3)/2;
        return sqrt($perimetre*($perimetre-$cote1)*($perimetre-$cote2)*($perimetre-$cote3));
    }
}
