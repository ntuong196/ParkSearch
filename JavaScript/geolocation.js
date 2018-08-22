//gets the location using html5 geolocation
function getLocation() {
   if (navigator.geolocation) {
       //get the position and pass to the function showPosition
       navigator.geolocation.getCurrentPosition(showPosition);
   } else {
       //if not supported, notify the user and untik the checkbox
       alert("Geolocation is not supported by this browser.");
       document.getElementsByName("locationSearch").checked = false;
   }
}


function showPosition(position) {
    //store the latitude and longitude on the elements on the form which are hidden
    document.getElementById("lat_holder").value = position.coords.latitude;
    document.getElementById("long_holder").value = position.coords.longitude;
}