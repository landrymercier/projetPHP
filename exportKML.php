<?php 
header('Content-Type: text/xml');
//header('Content-Disposition: attachment; filename=plage.kml');
header('Pragma: no-cache');

include_once 'Config.php';

$id_plage=1/*$_POST["plage"]*/;

try {
    $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<?xml version="1.0" encoding="UTF-8"?>
<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">
<Document>
    <?php $reponse = $bdd->query("SELECT ID, Nom FROM plage WHERE ID=".$id_plage);
    while ($donnees = $reponse->fetch()) {
	echo "<name>Ifrocean 2016 - ".$donnees['Nom']." | id_plage : ".$donnees['ID']."</name>";
    }$reponse->closeCursor(); ?>
    
    <StyleMap id="m_ylw-pushpin1">
	<Pair>
            <key>normal</key>
            <styleUrl>#s_ylw-pushpin</styleUrl>
	</Pair>
	<Pair>
            <key>highlight</key>
            <styleUrl>#s_ylw-pushpin_hl00</styleUrl>
	</Pair>
    </StyleMap>
    
    <Style id="s_ylw-pushpin_hl00">
	<IconStyle>
            <scale>1.3</scale>
            <Icon><href>http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png</href></Icon>
            <hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
        </IconStyle>
	<LineStyle><color>ffffaa00</color></LineStyle>
	<PolyStyle><color>7fffaa00</color></PolyStyle>
    </Style>
        
    <Style id="s_ylw-pushpin">
	<IconStyle>
	<scale>1.1</scale>
            <Icon><href>http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png</href></Icon>
            <hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
	</IconStyle>
	<LineStyle><color>ffffaa00</color></LineStyle>
	<PolyStyle><color>7fffaa00</color></PolyStyle>
    </Style>
    <Folder>
        <?php $reponse = $bdd->query("SELECT ID, Nom, Superficie FROM plage WHERE ID=".$id_plage);
        while ($donnees = $reponse->fetch()) {
	echo "<name>".$donnees['Nom']." | id_plage : ".$donnees['ID']."</name>";
	echo "<open>1</open>";
	echo "<description>Superficie : ".$donnees['Superficie']." m²

        Hediste diversicolor 	39989 	3/m²
        Amblyosyllis formosa 	1 	0,00/m²
        Arenicola marina	 	8967 	0,68/m²
        
        </description>";
        }$reponse->closeCursor(); ?>
	<Style>
            <ListStyle>
		<listItemType>check</listItemType>
		<bgColor>00ffffff</bgColor>
		<maxSnippetLines>2</maxSnippetLines>
            </ListStyle>
	</Style>
                      
<?php $reponse = $bdd->query("SELECT ID, IDplage, zones.Nom AS NOMzone, deciXA, deciYA, deciXB, deciYB, deciXC, deciYC, "
        . "deciXD, deciYD, Superficie "
        . "FROM zones WHERE IDplage=".$id_plage);
    while ($donnees = $reponse->fetch()) {
    echo"<Placemark>";
        echo"<name>Nom du groupe : " . $donnees['NOMzone'] ." | id_plage : ". $donnees['IDplage'] . " | id du groupe : ".$donnees['ID']."</name>";
            echo"<description>";
            echo"Superficie de la zone de prélèvement : ".$donnees['Superficie']." m² | ";
            $reponse2 = $bdd->query("SELECT IDespeces, espece.Nom AS NOMespece, espece.IDzone, "
                    . "prelevement.IDzone, IDespece, quantite, ID "
                    . "FROM espece, prelevement, zones "
                    . "WHERE IDespeces=IDespece AND espece.IDzone=prelevement.IDzone AND espece.IDzone=ID AND ID=".$donnees['ID']);
            echo"id groupe req1 = ".$donnees['ID']." vs ";
            while ($donnees2 = $reponse2->fetch()) {
                echo"id groupe req2 = ".$donnees2['ID']."<br/>";
                echo"Espece(s) répertoriée(s) : ".$donnees2['NOMespece']." | nombre d'individu : ".$donnees2['quantite'].",°-°, ";
            }$reponse2->closeCursor();
            echo"</description>";
            echo"<styleUrl>#m_ylw-pushpin1</styleUrl>";
                
            echo"<Polygon>
                    <tessellate>1</tessellate>
                    <outerBoundaryIs>
                        <LinearRing>
                            <coordinates>
                            ".$donnees['deciXA'].",".$donnees['deciYA'].",0 
                            ".$donnees['deciXB'].",".$donnees['deciYB'].",0 
                            ".$donnees['deciXC'].",".$donnees['deciYC'].",0 
                            ".$donnees['deciXD'].",".$donnees['deciYD'].",0 
                            </coordinates>
                        </LinearRing>
                    </outerBoundaryIs>
                </Polygon>";
    echo"</Placemark>";
    }$reponse->closeCursor();
?>
    </Folder>
</Document>
</kml>