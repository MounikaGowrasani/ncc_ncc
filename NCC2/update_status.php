<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "ncc";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selectedStudents']) && is_array($_POST['selectedStudents'])) {
        $selectedStudents = $_POST['selectedStudents'];
        
        $campid= $_GET['camp'];
        
        // Loop through the selected student numbers and update their status in the database
        foreach ($selectedStudents as $regNumber) {
            // Perform your database update operation here
            // For example, you can update the 'status' column in a table named 'students'
            $updateQuery = "UPDATE register SET status = 'yes' WHERE regno = '$regNumber' and campid='$campid'";

            if ($conn->query($updateQuery) === TRUE) {
                echo '<script>alert("Status updated successfully ");window.location.href ="confirmed_stu.php";</script>';
            } else {
                echo "Error updating status: " . $conn->error . "<br>";
            }
        }
    } else {
        echo "Invalid data received";
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>