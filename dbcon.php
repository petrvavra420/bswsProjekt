<?php
$servername = "10.0.10.4:3306";
$usernameDB = "peta";
$passwordDB = "petadb69";

// Create connection
$conn = mysqli_connect($servername, $usernameDB, $passwordDB);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>