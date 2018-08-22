<!DOCTYPE html>
<html>
<head>
<title>Park search </title>
 <!-- Assignment 1-->
<meta charset="UTF-8">
<meta name="author" content="Tuan Phan">


</head>
<body > 

<?php 
require_once './includes/partials/header.php';
?>

<br>
<br>
<br>
<div id='searchForm'>
<form id="search-details" method='get' action="searchResult.php">

<input type="text" name='name' id="search" placeholder ="Enter the park name ..">

<select name="suburban" id="suburb">
<?php
echo '<option value="">All suburbans </option>';
$suburb = $pdo->query('SELECT Distinct Suburb FROM park');
foreach ($suburb as $park){
		echo '<option value="'.$park['Suburb'].'">'.$park['Suburb'].'</option>';
}	
		

?>
</select>

<div id='currentLocation'>
<input type="text" name='lat' id='latitude' >
<input type="text" name='long' id='longtitude' >


</div>

<fieldset id="ratings">

<legend>Select the park by rating</legend>
<input type="checkbox" name="rating" value="Excellent">Excellent
<input type="checkbox" name="rating" value="Good">Good
<input type="checkbox" name="rating" value="Ok">Ok
<input type="checkbox" name="rating" value="Bad">Bad
<input type="checkbox" name="rating" value="Terrible">Terrible

</fieldset>
<br>
<br>
<button type="button" id="hidemap" onclick="return getLocation();">Press to enter your location</button> <span id="status">Pressed to use Nearby</span>
<br>
<br>
<div id="mapholder"></div>

<input type="submit" id="searchbutton" name='submit' value="Search" >
<input type="submit" id="searchbutton2" name='submit' value="Nearby" >

<input type="reset" onclick="return Reset()" id="resetSearch" value ="Reset">


</form>
</div>

<?php
include './includes/partials/footer.php';
?>

</body>

</html>
