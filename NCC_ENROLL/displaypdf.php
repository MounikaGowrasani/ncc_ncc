<?php
// Database connection parameters (same as in upload.php)

// Create a database connection
$conn = new mysqli("localhost", "root", "", "ncc");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the PDF data from the database based on some identifier, for example, an ID
$pdfId = "hema  sri"; // Replace with the actual identifier
$sql = "SELECT file_name, file_data FROM enroll WHERE stu_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pdfId);
$stmt->execute();
$stmt->bind_result($fileName, $fileData);

if ($stmt->fetch()) {
    // Set the appropriate content headers
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=$fileName"); // You can change 'inline' to 'attachment' to force download

    // Output the PDF data
    echo $fileData;
} else {
    // PDF not found or error occurred
    echo "PDF not found or an error occurred.";
}

$stmt->close();
?>
