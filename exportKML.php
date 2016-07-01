<?php 
header('Content-Type: text/xml');
header('Content-Disposition: attachment; filename=plage.kml');
header('Pragma: no-cache');

try {
    $bdd = new PDO('mysql:host=' . Config::SERVERNAME . ';dbname=' . Config::DBNAME . ';charset=utf8', Config::LOGIN, '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<?xml version="1.0" encoding="UTF-8"?>
<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">
<Document>
	<name>Ifrocean 2016 - <?php echo "Alan est breton"  ?></name>
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
			<Icon>
				<href>http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png</href>
			</Icon>
			<hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
		</IconStyle>
		<LineStyle>
			<color>ffffaa00</color>
		</LineStyle>
		<PolyStyle>
			<color>7fffaa00</color>
		</PolyStyle>
	</Style>
	<Style id="s_ylw-pushpin">
		<IconStyle>
			<scale>1.1</scale>
			<Icon>
				<href>http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png</href>
			</Icon>
			<hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
		</IconStyle>
		<LineStyle>
			<color>ffffaa00</color>
		</LineStyle>
		<PolyStyle>
			<color>7fffaa00</color>
		</PolyStyle>
	</Style>
	<Folder>
		<name>Natura 2015 - Pentrez</name>
		<open>1</open>
		<description>325000 m²

Hediste diversicolor 	39989 	3/m²
Amblyosyllis formosa 	1 	0,00/m²
Arenicola marina	 	8967 	0,68/m²</description>
		<Style>
			<ListStyle>
				<listItemType>check</listItemType>
				<bgColor>00ffffff</bgColor>
				<maxSnippetLines>2</maxSnippetLines>
			</ListStyle>
		</Style>
          
                
<?php
            //nom du groupe
            //nom des especes + nb especes
            //coordonnees gps
            $reponse = $bdd->query("SELECT * FROM plage");
            while ($donnees = $reponse->fetch()) {
                echo"<Placemark>";
                echo"<name>" . $donnees['Nom'] . "</name>";
                
                echo"<description>" . $donnees['Description'] . "</description>";
                echo"<styleUrl>#m_ylw-pushpin1</styleUrl>";
                echo'<Polygon>
                        <tessellate>1</tessellate>
                        <outerBoundaryIs>
                            <LinearRing>
                                <coordinates>
                                ' . $donnees['latA'] . ',0
                                </coordinates>
                            </LinearRing>
                        </outerBoundaryIs>
                    </Polygon>';
                echo"</Placemark>";
            }$reponse->closeCursor();
?>

                
		<Placemark>
			<name>Zone A (avec données)</name>
			<description>Nombre préleveurs : 8

Hediste diversicolor 39
Amblyosyllis formosa 1
Arenicola marina	 89</description>
			<styleUrl>#m_ylw-pushpin1</styleUrl>
			<Polygon>
				<tessellate>1</tessellate>
				<outerBoundaryIs>
					<LinearRing>
						<coordinates>
							-4.298260551299795,48.18643740852482,0 -4.300167618696066,48.18610768892475,0 -4.300072660468564,48.18594695452178,0 -4.298180408797481,48.18631488049339,0 -4.298260551299795,48.18643740852482,0 
						</coordinates>
					</LinearRing>
				</outerBoundaryIs>
			</Polygon>
		</Placemark>
		<Placemark>
			<name>zone B</name>
			<styleUrl>#m_ylw-pushpin1</styleUrl>
			<Polygon>
				<tessellate>1</tessellate>
				<outerBoundaryIs>
					<LinearRing>
						<coordinates>
							-4.292280155113648,48.17656285369605,0 -4.295599777342361,48.17624535706326,0 -4.295513050447296,48.17597407471386,0 -4.292094870307301,48.17641129380625,0 -4.292280155113648,48.17656285369605,0 
						</coordinates>
					</LinearRing>
				</outerBoundaryIs>
			</Polygon>
		</Placemark>
		<Placemark>
			<name>zone C</name>
			<styleUrl>#m_ylw-pushpin1</styleUrl>
			<Polygon>
				<tessellate>1</tessellate>
				<outerBoundaryIs>
					<LinearRing>
						<coordinates>
							-4.295108876800305,48.18104508245188,0 -4.297065456396416,48.18080329738116,0 -4.296935821108802,48.18064756221847,0 -4.295071960438857,48.1809349309659,0 -4.295108876800305,48.18104508245188,0 
						</coordinates>
					</LinearRing>
				</outerBoundaryIs>
			</Polygon>
		</Placemark>
		<Placemark>
			<name>zone D</name>
			<styleUrl>#m_ylw-pushpin1</styleUrl>
			<Polygon>
				<tessellate>1</tessellate>
				<outerBoundaryIs>
					<LinearRing>
						<coordinates>
							-4.29665734743651,48.18443766178272,0 -4.298891319237397,48.18393735336625,0 -4.298830158755218,48.18382696526784,0 -4.296559278390776,48.18437318416211,0 -4.29665734743651,48.18443766178272,0 
						</coordinates>
					</LinearRing>
				</outerBoundaryIs>
			</Polygon>
		</Placemark>
		<Placemark>
			<name>zone E</name>
			<styleUrl>#m_ylw-pushpin1</styleUrl>
			<Polygon>
				<tessellate>1</tessellate>
				<outerBoundaryIs>
					<LinearRing>
						<coordinates>
							-4.303023146932214,48.19337597965041,0 -4.304686734442361,48.19306413303297,0 -4.304575520539025,48.19294608934865,0 -4.302957800617055,48.19323941025391,0 -4.303023146932214,48.19337597965041,0 
						</coordinates>
					</LinearRing>
				</outerBoundaryIs>
			</Polygon>
		</Placemark>
		<Placemark>
			<name>zone F</name>
			<styleUrl>#m_ylw-pushpin1</styleUrl>
			<Polygon>
				<tessellate>1</tessellate>
				<outerBoundaryIs>
					<LinearRing>
						<coordinates>
							-4.299903581060151,48.18892226385036,0 -4.301549842817076,48.18850234734383,0 -4.301464141135155,48.18835506025399,0 -4.299830825921557,48.1887872877573,0 -4.299903581060151,48.18892226385036,0 
						</coordinates>
					</LinearRing>
				</outerBoundaryIs>
			</Polygon>
		</Placemark>
		<Placemark>
			<name>zone G</name>
			<styleUrl>#m_ylw-pushpin1</styleUrl>
			<Polygon>
				<tessellate>1</tessellate>
				<outerBoundaryIs>
					<LinearRing>
						<coordinates>
							-4.301836211013212,48.1915220046996,0 -4.303192849355018,48.19113081324124,0 -4.303024897572437,48.1908764923915,0 -4.301679716628951,48.19128888385606,0 -4.301836211013212,48.1915220046996,0 
						</coordinates>
					</LinearRing>
				</outerBoundaryIs>
			</Polygon>
		</Placemark>
		<Placemark>
			<name>zone H</name>
			<styleUrl>#m_ylw-pushpin1</styleUrl>
			<Polygon>
				<tessellate>1</tessellate>
				<outerBoundaryIs>
					<LinearRing>
						<coordinates>
						</coordinates>
					</LinearRing>
				</outerBoundaryIs>
			</Polygon>
		</Placemark>
	</Folder>
</Document>
</kml>