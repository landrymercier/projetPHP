<?php
include_once 'PointGPS.php';

abstract class PolygoneGPS {
    public $lesPoints;
    
    public function __construct($desPoints) {
        $this->lesPoints=$desPoints;
    }
    
    public abstract function calculerSurfaceZone();
}
