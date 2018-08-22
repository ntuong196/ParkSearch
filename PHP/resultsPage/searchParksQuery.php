<?php

//setup PDO
include '../databaseConnection.php';

try
{
    //query the database for items matching search criteria
    //check if searching by a valid rating and show results with a review that is  above the value of the rating
    if ($_GET['rating'] == 1 || $_GET['rating'] == 2 || $_GET['rating'] == 3 || $_GET['rating'] == 4 || $_GET['rating'] == 5) {
        $query = 'SELECT items.ID, items.Name, items.Street, items.Suburb, items.Latitude, items.Longitude,'.
            ' ROUND(AVG(reviews.rating), 1) AS AverageRating '.
            'FROM  items, reviews '.
            'WHERE items.ID = reviews.ItemID and reviews.rating >= :rating'.
            ' and items.Suburb like :suburb and items.Name like :name ';

        //check if need to search by location
        if (isset($_GET['locationSearch']) && isset($_GET['latitude']) && isset($_GET['longitude'])) {
            //check that query is searching by location
            if ($_GET['locationSearch'] == 'on') {
                //add the condition of location to the query to search for parks within 1km of the user
                $query .= 'AND (acos(sin(radians(:latitude))*sin(radians(Latitude)) + cos(radians(:latitude))' . '
                *cos(radians(Latitude))*cos(radians(Longitude)-radians(:longitude))) * 6371) < 1 ';
            }
        }

        //add group by to the query
        $query .= 'Group By items.ID';


        $stmt = $pdo->prepare($query);

        //Bind values to query based on search
        $stmt->bindValue(':rating', htmlspecialchars($_GET['rating']));
    } else {
        //if the user is not searching by rating
        $query = 'SELECT items.ID, items.Name, items.Street, items.Suburb, items.Latitude, items.Longitude '.
            'FROM  items '.
            'WHERE items.Suburb like :suburb and items.Name like :name ';

        //check if need to search by location
        if (isset($_GET['locationSearch']) && isset($_GET['latitude']) && isset($_GET['longitude'])) {
            //ensure user is searching by location
            if ($_GET['locationSearch'] == 'on') {
                //add the condition of location to the query to search for parks within 1km of the user
                $query .= 'AND (acos(sin(radians(:latitude))*sin(radians(Latitude)) + cos(radians(:latitude))' . '
                *cos(radians(Latitude))*cos(radians(Longitude)-radians(:longitude))) * 6371) < 1 ';;
            }
        }

        //add group by to the query
        $query .= 'Group By items.ID ';

        //prepare the query
        $stmt = $pdo->prepare($query);

    }

    //check if searching by user's location and bind the latitude and longitude to the query if so
    if (isset($_GET['locationSearch']) && isset($_GET['latitude']) && isset($_GET['longitude'])) {
        if ($_GET['locationSearch'] == 'on') {
            $stmt->bindValue(':latitude', htmlspecialchars($_GET['latitude']));
            $stmt->bindValue(':longitude', htmlspecialchars($_GET['longitude']));
        }
    }

    //Bind values to query based on search
    $stmt->bindValue(':suburb', '%'.htmlspecialchars($_GET['suburb']).'%');
    $stmt->bindValue(':name', '%'.htmlspecialchars($_GET['parkName']).'%');

    //execute the query
    $stmt->execute();

//catch errors
}
catch (PDOException $e)
{
echo $e->getMessage();
}
?>

