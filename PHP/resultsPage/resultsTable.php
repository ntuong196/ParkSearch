 <?php

    //query database for data matching the search
    include ('searchParksQuery.php');

    //check if query returned any results
    if($stmt->rowcount() > 0) {
        //division containing the markers of search results on a map
        echo '<div id="resultsMap"></div>';

        //division containing the results of the search
        echo '<div id="results">';

        //input the table that will contain the results
        echo '<table>';

        //input the headings for each table column
        echo '<tr>'.
                '<th>Name</th>'.
                '<th>Street</th>'.
                '<th>Suburb</th>'.
                '<th>Average Rating</th>'.
                '<th></th>'.
            '</tr>';

        //loop through results of query
        foreach ($stmt as $result) {

            //create a table row of all information about each item found from search
            echo '<tr>';
                echo '<td>'.$result['Name'].'</td>';
                echo '<td>'.$result['Street'].'</td>';
                echo '<td>'.$result['Suburb'].'</td>';

                //include query for average ratings
                include 'averageRatingQuery.php';

                //check if the query returned an average rating for the park ID
                if ($stmt->rowCount() > 0) {

                    //if there is an average rating, return write it
                    foreach ($stmt as $averageRating){
                        echo '<td>'.$averageRating['AverageRating'].'</td>';
                    }
                } else {
                    //if no rating found, write "No Rating" in the table
                    echo '<td>No Rating</td>';
                }

                //link to the page with the id of the item passed through the url
                echo '<td> <a href = \'../itemPage/itemsPage.php?id='.$result['ID'].'\'> More Info </a></td>';

            echo '</tr>';
        };
    } else {
        //if no results found matching the query, notify the user
        echo '<div id="results">';
            echo '<table>';
                echo '<tr>';
                    echo '<td>No results found matching search</td>';
                echo '</tr>';
    }

    //close the table tag
        echo '</table>';
    echo '</div>';
 ?>