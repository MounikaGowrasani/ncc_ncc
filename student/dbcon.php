<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncc";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

