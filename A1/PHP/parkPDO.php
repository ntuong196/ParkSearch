<?php
$pdo = new PDO('mysql:host=localhost;dbname=n9764631', 'n9764631', 'myNewPassword');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
$result = $pdo->query('SELECT * FROM items ');
$suburb = $pdo->query('SELECT Distinct Suburb FROM park');

} catch (PDOException $e) {
echo $e->getMessage();
}
?>