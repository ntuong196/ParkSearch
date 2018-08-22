<?php
//include PDO to database
include "../databaseConnection.php";

try {
//Query
$result = $pdo->prepare('SELECT reviews.ReviewText, members.FirstName, members.LastName, items.Name, '.
                        'DATE_FORMAT(reviews.PostDate, \'%D %M %Y\') as PostDate, reviews.Rating '.
                        'FROM reviews, members, items '.
                        'WHERE reviews.UserID = members.UserID and reviews.ItemID = :ParkID '.
                        'Group By reviews.ReviewID');
//Bind values to the query
$result->bindValue(':ParkID', htmlspecialchars($_GET['id']));
//execute the query
$result->execute();
//Catch errors
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>