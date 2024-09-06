<?php
$servername = "localhost";
$username = "root";
$password = ""; // Update this if you have a password
$database = "cricket_team";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
