<?php
    //dynamically create script to draw the google map using the google maps api
    echo '<script>';
        //create function to be called
        echo 'function initMap() {';

            //coordinates of QUT, used as centre of the map
            echo 'var qut = {lat: -27.4756055, lng: 153.028871};';

            //create map in the division with the id 'map'. Adjust the zoom and set the center of the map
            // to be QUT's coordinates
            echo 'var map = new google.maps.Map(document.getElementById(\'resultsMap\'), {'.
                'zoom: 10, '.
                'center: qut'.
                '});';

            //include the search parks query to find all info about items matching the search
            include 'searchParksQuery.php';

            //loop through the results returned by the database
            foreach ($stmt as $marker) {

                //set the variable item to have the longitude and latitude of the item found in the database
                echo 'var item = {lat: ' . $marker['Latitude'] . ', lng: ' . $marker['Longitude'] . '};';

                //create a string to be displayed when each location marker is clicked
                //contains the suburb, street, coordinates and a link the item's page
                echo 'var contentString = "<p>Name: '.$marker['Name'].'</p>'.
                    '<p>Suburb: '.$marker['Suburb'].'</p>'.
                    '<p>Street: '.$marker['Street'].'</p>'.
                    '<p>Coordinates: '.$marker['Latitude'].', '.$marker['Longitude'].'</p>'.
                    '<p><a href = \'../itemPage/itemsPage.php?id='.$result['ID'].'\'> More Info </a></p>";';

                //create an info window for the marker with the above content
                echo 'var infowindow = new google.maps.InfoWindow({'.
                     ' content: contentString '.
                     '});';

                //create the marker for the park
                echo 'var marker = new google.maps.Marker({' .
                    'position: item, ' .
                    'map: map ' .
                    '});';

                //add event open the item's information window when the marker is clicked
                echo 'marker.addListener(\'click\', function() {'.
                     'infowindow.open(map, marker);'.
                     '});';

            //end loop through database results
            }
        //close the function
        echo '}';

    //close the script
    echo '</script>';

    //include the google maps api to create the map
    echo '<script async defer '.
        'src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqyoPJzJCUpNtQu68euCORHuyIv8_7B7Y&callback=initMap">'.
        '</script>';
?>