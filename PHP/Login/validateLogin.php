<?php
//checks whether the current password and username can be matched with a row from the table
function check_password(&$errors, $email, $password) {
    include '../databaseConnection.php';
    try
    {
        //Query
        $result = $pdo->prepare('SELECT UserID, Email, Password '
            .'FROM members '
            .'WHERE Email = :emailAddress AND Password = SHA2(CONCAT(:password, Salt), 0)');

        $result->bindValue(':emailAddress', htmlspecialchars($email));
        $result->bindValue(':password', htmlspecialchars($password));

        //execute query
        $result->execute();
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    //check if account with the password and username exists in the database
    if ($result->rowCount() > 0){

        //if the account exists, loop through row on database to obtain the userID
        foreach ($result as $login) {
            $userID = $login['UserID'];
        }

        //start a session to allow the use of session variables
        session_start();
        //store the userID of the account in a session variable
        $_SESSION['loggedIn'] = $userID;

        //return true as the functions result
        return true;

    } else {
        //if account doesn't exist, notify the user that there was an error
        $errors['password'] = 'Invalid username or password';
        return false;
    }
}
?>