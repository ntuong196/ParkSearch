<?php

//include PDO to database
include "../databaseConnection.php";

//Query the database for all info in the items table on the database for the current item
try {
    //Query
    $result = $pdo->prepare('SELECT items.* '.
        'FROM items, reviews '.
        'WHERE ID = :ParkID '.
        'GROUP BY ID');

    //Bind values to the query
    $result->bindValue(':ParkID', htmlspecialchars($_GET['id']));

    //execute the query
    $result->execute();

    //Catch errors
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>