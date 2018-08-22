<?php
//return the average rating across all reviews on the current item. If there are no reviews, return "Not Rated"
function average_rating() {
    //include PDO to database
    include "../databaseConnection.php";

    try {
        //Query
        $result = $pdo->prepare('SELECT round(avg(rating), 1) as AverageRating '.
                                'FROM reviews '.
                                'WHERE ItemID = :ParkID '.
                                'Group By ItemID');

        //Bind values to the query
        $result->bindValue(':ParkID', htmlspecialchars($_GET['id']));

        //execute the query
        $result->execute();

        //Catch errors
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    //check if the park has had at least one rating
    if ($result->rowCount() > 0) {
        //if the park has recieved a rating, return the average rating
        foreach ($result as $avgRating) {
            return $avgRating['AverageRating']. ' Stars';
        }
    } else {
        //if not rated return "Not Rated"
        return "Not Rated";
    }
}