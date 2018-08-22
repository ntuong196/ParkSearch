<?php
//include PDO to database
include "../databaseConnection.php";

try {
    //get the current date of posting
    $today = date('Y-m-d H:i:s');
//Query
    $stmt = $pdo->prepare('INSERT INTO reviews (UserID, ItemID, ReviewText, PostDate, Rating) '.
                          'VALUES (:user, :item, :reviewText, :date, :rating)');
//Bind values to the query
    //post date as today
    $stmt->bindValue(':date', $today);

    //review text as review text
    $stmt->bindValue(':reviewText', htmlspecialchars($_POST['reviewText']));

    //star rating as select box rating
    $stmt->bindValue(':rating', htmlspecialchars($_POST['rating']));

    //user ID as logged in user
    $stmt->bindValue(':user', htmlspecialchars($_SESSION['loggedIn']));

    //item ID as selected item
    $stmt->bindValue(':item', htmlspecialchars($_GET['id']));

    //execute the query
    $stmt->execute();

//Catch errors
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>