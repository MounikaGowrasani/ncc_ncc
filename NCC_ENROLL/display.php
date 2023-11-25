<?php
// Database connection parameters (same as in your upload.php)

// Create a database connection
$conn = new mysqli("localhost", "root", "", "ncc");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = mysqli_query($conn, "SELECT photo_data FROM enroll WHERE Registration_number = '12341'"); 

$row = mysqli_fetch_array($result); 
$image = $row['photo_data']; 

header('Content-Type: image/png'); 
echo $image; 
?>