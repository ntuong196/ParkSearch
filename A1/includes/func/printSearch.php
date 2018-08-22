<?php // function to print out the item of the search result
  //if there are no parks, return no result matches
  //use the rowCount to decide if there is park match the search query or not
if($correctPark->rowCount()==0){
	echo"<td colspan='4'><a href='main.php'>Sorry, no result matches. Please back to the homepage</a></td>";

}else{
	// return the parks info from the database in table format
	foreach ($correctPark as $parks){
		echo '

		<tr >
			<td>'. $parks["Park_Code"] .'</a></td>
			<td><a href= item.php?parkID='. $parks["id"] .' >'. $parks["Name"] .'</td>
			<td>'. $parks["Street"] .'</td>
			<td>'. $parks["Suburb"] .'</td>  
	     ';
   }
}
?>
