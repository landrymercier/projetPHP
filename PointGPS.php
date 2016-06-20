<?php

class PointGPS {
    
    public $x;
    public $y;

    public function __construct($abscisse_degre, $abscisse_minute, $abscisse_seconde, 
            $ordonnee_degre, $ordonnee_minute, $ordonnee_seconde) {
        $this->x = $abscisse_degre.$abscisse_minute.$abscisse_seconde;
        $this->y = $ordonnee_degre.$ordonnee_minute.$ordonnee_seconde;
        
        $x=floatval($this->x);
        $y=floatval($this->y);
        
        //var_dump(is_float($x));
    }

    public function calculerDistance($autrePoint) {
        return sqrt(
                pow($this->x - $autrePoint->x, 2) +
                pow($this->y - $autrePoint->y, 2)
        );
    }
}
