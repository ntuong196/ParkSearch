<?php

//setup PDO
include '../databaseConnection.php';

//Insert details from form into database
try
{
    //Insert user registration form information to database with the password hashed and with added salt
    $stmt = $pdo->prepare('INSERT INTO members (FirstName, LastName, Email, DOB, Postcode, Gender, Password, Salt)'
        .' VALUES (:fName, :lName, :emailAddress, :dateOfBirth, :postcode, :gender, SHA2(CONCAT(:userPw, :salt), 0), :salt)');

    //create salt
    $salt = uniqid();

    //Bind values to query
    $stmt->bindValue(':fName', htmlspecialchars($_POST['fName']));
    $stmt->bindValue(':lName', htmlspecialchars($_POST['lName']));
    $stmt->bindValue(':emailAddress', htmlspecialchars($_POST['emailAddress']));
    $stmt->bindValue(':dateOfBirth', htmlspecialchars($_POST['dateOfBirth']));
    $stmt->bindValue(':postcode', htmlspecialchars($_POST['postcode']));
    $stmt->bindValue(':gender', htmlspecialchars($_POST['gender']));
    $stmt->bindValue(':userPw', htmlspecialchars($_POST['userPw']));
    $stmt->bindValue(':salt', $salt);

    //execute query
    $stmt->execute();
}
catch (PDOException $e)
{
    echo $e->getMessage();
}
?>