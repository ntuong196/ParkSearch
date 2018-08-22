<?php
/*/ Retrieve the input data from the search and find the park in the database/*/
$suburban = $_GET['suburban'];
$name = $_GET['name'];
$latitude =(double)$_GET['lat'];
$longitude =(double)$_GET['long'];
if ($_GET['submit']=='Nearby'){
	$correctPark = $pdo->prepare('Select * FROM park Where 
(111.045*DEGREES(ACOS(COS(RADIANS(Latitude)) * COS(RADIANS(:lat)) *
             COS(RADIANS(Longitude) - RADIANS(:long)) +
             SIN(RADIANS(Latitude)) * SIN(RADIANS(:lat)))) <2)');
$correctPark->bindValue(':lat',$latitude);
$correctPark->bindValue(':long',$longitude);



}else {
$correctPark = $pdo->prepare('Select * FROM park Where 
Suburb LIKE :suburb and 
Name LIKE :name');
$correctPark->bindValue(':suburb',$suburban .'%');
$correctPark->bindValue(':name','%'. $name .'%');
}
$correctPark->execute();	

?>