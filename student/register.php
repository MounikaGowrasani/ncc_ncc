<?php
// Start a session if not already started
session_start();

if (isset($_SESSION['campIdd'])) {
    $campId = $_SESSION['campIdd'];

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

    if (isset($_SESSION['uname'])) {
        $username = $_SESSION['uname'];

        // Query to fetch user information
        $sql1 = "SELECT * FROM enroll WHERE regimental_number = '$username'";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            $regno = $row1['Registration_number'];

            // Check if the registration number already exists in the 'register' table
            $checkSql = "SELECT * FROM register WHERE regno = '$regno' and campid='$campId'";
            $checkResult = $conn->query($checkSql);

            if ($checkResult->num_rows > 0) {
                // Registration number already exists, display an alert box
                echo "<script>alert('Already applied for this camp');window.history.back();</script>";
            } else {
                $status = "no";

                // Insert data into the 'register' table
                $sql = "INSERT INTO register VALUES ('$campId', '$regno', '$status','NULL')";

                if ($conn->query($sql) === TRUE) {
                    echo "Application submitted successfully.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "No records found for the given username.";
        }
    } else {
        echo "Session error: 'uname' not set in the session.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Session error: 'campid' not set in the session.";
}
?>
