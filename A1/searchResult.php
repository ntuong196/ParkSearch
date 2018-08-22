
<!DOCTYPE html>
<html>
<head>
<title> Search result </title>
<meta charset="UTF-8">
<meta name="author" content="Tuan Phan">

</head>
<body > 
<?php
require_once 'includes/partials/header.php';

?>

<div id="main-wrap">

<div id="searchResult"><h2>Search Result</h2>
<br>

<table id= 'items'>
<tr>
    <th>ParkCode</th>
	<th>Name</th>
	<th>Street</th>
	<th>Suburb</th>
</tr>
   <?php
    require './includes/func/Search.php'; 
	include'./includes/func/printSearch.php';
	
   
   ?>
</table>				
</div>
<!--
div section for the map and markers
-->
<div id="nearbyMap">
	<h2>Map</h2>
	<br><br>
	<div id="map"></div>
	<?php
	 require './includes/func/Search.php'; 
	include'./includes/func/map.php';
	
	?>	
		
		
		
		</div>
</div>
	




<?php

require_once 'includes/partials/footer.php';
?>
</body>

</html>