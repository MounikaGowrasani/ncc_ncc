<?php
// download_certificate.php

// Database connection details
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$database = "ncc";

// Get registerid from the URL parameter
$registerid = $_GET['registerid'];

// Create a database connection
$conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve certificate data based on registerid
$query = "SELECT certificate FROM camp_certificate WHERE registerid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $registerid);

if ($stmt->execute()) {
    $stmt->bind_result($certificateBlob);
    if ($stmt->fetch()) {
        // Set appropriate headers for downloading the file
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=certificate_" . $registerid . ".jpg");

        // Output the certificate data
        echo $certificateBlob;
    } else {
        echo "Certificate not found for the given registerid.";
    }
} else {
    echo "Error retrieving certificate: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>