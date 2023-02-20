<?php
$servername = "10.0.10.4:3306";
$username = "peta";
$passwordDB = "petadb69";

// Create connection
$conn = mysqli_connect($servername, $username, $passwordDB);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?> 