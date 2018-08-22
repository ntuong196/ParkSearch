<?php
//Setup PDO with the database and allow errors
$pdo = new PDO('mysql:host=localhost;dbname=parkfinder', 'min', 'Secret!');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>