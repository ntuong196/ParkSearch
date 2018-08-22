<?php
//log the user out and reload the login page to allow another account to login
session_start();
unset($_SESSION['loggedIn']);
header("Location: login.php");
exit();
?>