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
include 'header.php';
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
foreach ($suburb as $park){
		echo '<option value="'.$park['Suburb'].'">'.$park['Suburb'].'</option>';
}	
		

?>
</select>
<br>
<button type="button" id="hidemap" onclick="return DisplayMap()">Press to enter your location</button> <span id="status"></span>
<br>
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
<div id="mapholder"></div>


<input type="submit" id="searchbutton" value="Search " >
<input type="reset" id="resetSearch" value ="Reset">


</form>
</div>

<?php
include 'footer.php';
?>

</body>

</html>
