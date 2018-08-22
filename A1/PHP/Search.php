<?php
/*/ Retrieve the input data from the search and find the park in the database/*/
$suburban = $_GET['suburban'];
$name = $_GET['name'];
$correctPark = $pdo->prepare('Select ID,ParkCode,Name,Street,Suburb FROM items Where Suburb LIKE :suburb and Name LIKE :name');
$correctPark->bindValue(':suburb','%'. $suburban .'%');
$correctPark->bindValue(':name','%'. $name .'%');
$correctPark->execute();

?>