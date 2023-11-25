<?php
// upload_certificate.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve campid, registrationNumber, and registerid from the GET parameters

    $registerid = $_POST['registerid'];

    // Handle file upload
    if ($_FILES["certificateFile"]["error"] == UPLOAD_ERR_OK) {
        // Get the uploaded file information
        $certificateTmpName = $_FILES["certificateFile"]["tmp_name"];

        // Database connection details
        $servername = "localhost";
        $usernameDB = "root";
        $passwordDB = "";
        $database = "ncc";

        // Create a database connection
        $conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Read the certificate file as binary data
        $certificateBlob = file_get_contents($certificateTmpName);
        // Insert data into camp_certificate table
        $insertQuery = "INSERT INTO camp_certificate (registerid, certificate) VALUES ( ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("is", $registerid, $certificateBlob);

        if ($stmt->execute()) {
            echo "Certificate uploaded and inserted successfully.";
        } else {
            echo "Error inserting certificate: " . $stmt->error;
        }

        $stmt->close();

        // Close the database connection
        $conn->close();
    } else {
        echo "Error uploading file: " . $_FILES["certificateFile"]["error"];
    }
}
?>