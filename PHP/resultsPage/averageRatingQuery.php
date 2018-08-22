<?php

//setup PDO
include '../databaseConnection.php';

//Check to see if there is an average rating left for the park and display it if so
try
{
    //query database for average ratings
    $stmt = $pdo->prepare('SELECT items.ID, ROUND(AVG(rating), 1)  as AverageRating '.
                            'FROM reviews, items '.
                            'WHERE reviews.ItemID = items.ID and items.ID = :ID '.
                            'Group By ID');

    //Bind values to query
    $stmt->bindValue(':ID', htmlspecialchars($result['ID']));

    //execute the query
    $stmt->execute();

}
catch (PDOException $e)
{
    echo $e->getMessage();
}
?>

