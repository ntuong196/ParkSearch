
<!DOCTYPE html>
<html>
<head>
<title> Search result </title>
<meta charset="UTF-8">
<meta name="author" content="Tuan Phan">

</head>
<body > 
<?php
include 'header.php';
?>
<div id="main-wrap">
<br>
<br>
<div id="searchResult"><h2>Search Result</h2>
<br>
<br>
<table id= 'items'>
<tr>
    <th>ParkCode</th>
	<th>Name</th>
	<th>Street</th>
	<th>Suburb</th>
</tr>
   <?php
   include 'Search.php'; 
   foreach ($correctPark as $parks){
	    echo '

	<tr >
	    <td>'. $parks["Park_Code"] .'</td>
		<td>'. $parks["Name"] .'</td>

		<td>'. $parks["Street"] .'</td>

		<td>'. $parks["Suburb"] .'</td>


	      
	      ';
   }
   ?>
</table>
		
				
		</div>
		<div id="nearbyMap">
		<h2>Nearby Parks</h2>
		
		
		
		
		</div>
</div>
	




<?php
include 'footer.php';
?>
</body>

</html>