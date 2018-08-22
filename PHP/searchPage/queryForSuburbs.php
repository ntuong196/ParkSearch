<?php

//setup PDO
include '../databaseConnection.php';

//get one of each suburb from item list
try
{
//query database for one of each suburb and order them alphabetically
$stmt = $pdo->query('SELECT distinct Suburb '.
                    'FROM items '.
                    'ORDER BY Suburb');
}
catch (PDOException $e)
{
echo $e->getMessage();
}
?>