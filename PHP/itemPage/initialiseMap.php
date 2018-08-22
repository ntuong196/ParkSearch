<?php
    //dynamically create script to draw the google map using the google maps api
    echo '<script>';
        //create function to be called
        echo 'function initMap() {';

        //include the item's query to find all info about the item
        include 'itemInfoQuery.php';

        //loop through the results returned by the database
        foreach ($result as $marker) {
            //set the variable item to have the longitude and latitude of the item found in the database
            echo 'var item = {lat: ' . $marker['Latitude'] . ', lng: ' . $marker['Longitude'] . '};';
        }
            //create map in the division with the id 'map'. Adjust the zoom and set the center of the map
            // to be where the item is located.
            echo 'var map = new google.maps.Map(document.getElementById(\'mapIndividual\'), {'.
                'zoom: 15,'.
                'center: item'.
                '});';

            //create a marker with the same latitude and longitude as the park and put it on the map
            echo 'var marker = new google.maps.Marker({'.
                'position: item,'.
                'map: map'.
                '})';
            echo '}';

    //close the script
    echo '</script>';

    //include the google maps api to create the map
    echo '<script async defer '.
         'src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqyoPJzJCUpNtQu68euCORHuyIv8_7B7Y&callback=initMap">'.
         '</script>';
?>