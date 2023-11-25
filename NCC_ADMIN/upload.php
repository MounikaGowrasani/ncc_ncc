<?php
// Replace these with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "ncc";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a file was uploaded successfully
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Get file details
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    // Read the file content
    $fileContent = file_get_contents($fileTmpName);

    // Escape and insert the filename and file content into the database
    $escapedFileName = $conn->real_escape_string($fileName);
    $escapedFileContent = $conn->real_escape_string($fileContent);
    
    $sql = "INSERT INTO pdf_files (file_name, file_content)
    VALUES ('$escapedFileName', '$escapedFileContent')";

    
    if ($conn->query($sql) === TRUE) {
        echo "File uploaded and stored in the database.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: File upload failed or no file selected.";
}

// Close the database connection
$conn->close();
?>
