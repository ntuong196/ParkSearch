
<script type="text/javascript">
/*/ Javascript in a php file so that we can use the values that get from the database/ another way is to add parameters for
a javascript function in another external file /*/ 

	function initMap() {
	/*/the lat and long of brisbane CBD for the init map/*/
	var myLatLng = {lat:-27.470125, lng:153.021072};

	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 14,
		center: myLatLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	/*/ create a bound for the map so the map will center in the middle of the markers/*/
	var bounds = new google.maps.LatLngBounds();
	
	map.fitBounds(bounds);
	var infowindow = new google.maps.InfoWindow() ;

	<?php
	/*/ loop through all the result parks and place a marker of their position on the map. Create an info window for each item. The info window will appear
	when the user click on it.
	/*/
	foreach ($correctPark as $parks){
		echo'
		var marker = new google.maps.Marker({
		position: new google.maps.LatLng('.(double)$parks["Latitude"].','.(double) $parks["Longitude"].'),
		map: map,
		title: "'.$parks["Name"] .' "});
		bounds.extend(marker.getPosition());
		
		var content = "<a href= item.php?parkID='. $parks["id"] .' ><h3>'.$parks["Name"] .'</h3></a> <br><h4>Street:'.$parks["Street"] .'</h4><br><h4>Subruban:'.$parks["Suburb"] .'</h4> " ;	
		google.maps.event.addListener(marker,"click", (function(marker,content,infowindow){ 
		return function() {
        infowindow.setContent(content);
        infowindow.open(map,marker);
		};
		})(marker,content,infowindow));  
		
		';
		
		
	}
	?>

	}
</script>
<!-- googleapi script to display the map -->
 <script async defer
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjJjlz0rw02fhVg8M9K-ExyNoBWR2uqkM
&callback=initMap">
</script>