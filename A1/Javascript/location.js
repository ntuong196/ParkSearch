function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementById("status").innerHTML="Geolocation is not supported by this browser.";
	}
}
function showPosition(position) {

	// display on a map
		// display on a map
	var latlon = position.coords.latitude + "," + position.coords.longitude;
	document.getElementById("latitude").value = position.coords.latitude;
	document.getElementById("longtitude").value = position.coords.longitude;
	
	document.getElementById("status").innerHTML="Location has been recorded";

}
function showError(error) {
	var msg = "";
	switch(error.code) {
		case error.PERMISSION_DENIED:
			msg = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			msg = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			msg = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			msg = "An unknown error occurred."
			break;
	}
	document.getElementById("status").innerHTML = msg;
}

function Reset(){
	document.getElementById("status").innerHTML="Location has not been recorded";
}