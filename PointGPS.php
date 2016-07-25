<?php

class PointGPS {
    
    public $x;
    public $y;

    public function __construct($abscisse_degre, $abscisse_minute, $abscisse_seconde, 
            $ordonnee_degre, $ordonnee_minute, $ordonnee_seconde) {
        $abscisse_minute = $abscisse_minute/60;
        $abscisse_seconde = $abscisse_seconde/3600;
        
        $ordonnee_minute = $ordonnee_minute/60;
        $ordonnee_seconde = $ordonnee_seconde/3600;
        
        $this->x = $abscisse_degre.$abscisse_minute.$abscisse_seconde;
        $this->y = $ordonnee_degre.$ordonnee_minute.$ordonnee_seconde;
    }
    
    public function getX(){ return $this->x; }
    public function getY(){ return $this->y; }

    public function calculerDistance($autrePoint) {
        $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
        
        //calcul des coodonnees des points converties en radian
        $pt1_x = deg2rad($this->x);
        $pt1_y = deg2rad($this->y);
        $pt2_x = deg2rad($autrePoint->x);
        $pt2_y = deg2rad($autrePoint->y);
        
        //calcul de la distance entre 2 points des abscisses et des ordonnees
        $distance_x = ($pt2_x - $pt1_x) / 2;
        $distance_y = ($pt2_y - $pt1_y) / 2;
        
        //calcul d'une distance terrestre (distance incurvée)
        $angle_distance = (sin($distance_y) * sin($distance_y)) + cos($pt1_y) * cos($pt2_y) 
                * (sin($distance_x) * sin($distance_x));
        
        $distance = 2 * atan2(sqrt($angle_distance), sqrt(1 - $angle_distance));
        
        return ($earth_radius * $distance);
    }
}
