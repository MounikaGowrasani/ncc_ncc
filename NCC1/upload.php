<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if a file was uploaded successfully
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Get file details
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $unit = "10A";
        $years = date("Y");

        // Read the file content
        $fileContent = file_get_contents($fileTmpName);

        // Escape and insert the filename and file content into the database
        $escapedFileName = $conn->real_escape_string($fileName);

        // Check if a record with the same 'years' value already exists
        $sql = "SELECT * FROM pdf_files WHERE years = ? and unit=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $years,$unit);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Year already exists, display an alert
                echo "<script>alert('Year $years schedule already uploaded'); window.history.back();</script>";
            } else {
                $stmt->close(); // Close the previous statement

                // Insert the new record
                $sql = "INSERT INTO pdf_files (file_name, file_content, unit, years)
                        VALUES (?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $escapedFileName, $fileContent, $unit, $years);

                if ($stmt->execute()) {
                    echo "File uploaded and stored in the database.";
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
        } else {
            echo "Error executing the query: " . $stmt->error;
        }
    } else {
        echo "Error: File upload failed or no file selected.";
    }
}


// Close the database connection
$conn->close();
?>
