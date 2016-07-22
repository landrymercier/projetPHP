<?php

include_once 'Config.php';

function CONNECTBDD() {
    include_once 'Config.php';
    try {
        $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
        return $bdd;
        echo'bwaaaah';
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function RecalcSuper($idplage) {
    $bdd = CONNECTBDD();
    $req = $bdd->query("SELECT SUM(Superficie) AS 'Superficie' FROM zones WHERE IDplage = " . $idplage);
    $calc = $req->fetch();
    $req = $bdd->query("UPDATE plage SET Superficie = " . $calc['Superficie'] . " WHERE ID = " . $idplage);
    $sup = $req->fetch();
}

function CreaProjet($nom, $ville, $a, $m, $j) {

    $bdd = CONNECTBDD();
    $req = $bdd->prepare('INSERT INTO plage(Nom,Ville,Superficie,Datepreleve,Clore) VALUES(:nom,:vil,:sup,:dat,:clo)');
    $req->execute(array(
        "nom" => $nom,
        "vil" => $ville,
        "sup" => 0,
        "dat" => $a . "-" . $m . "-" . $j,
        "clo" => 0));
    $req->closeCursor();
    $req = $bdd->query("SELECT ID FROM plage ORDER BY ID DESC LIMIT 1");
    $id = $req->fetch();
}
