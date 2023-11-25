<?php
$servername = "localhost"; // Replace with your database server hostname
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "ncc"; // Replace with your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['camp'])) {
    $selectedCamp = $_GET['camp'];

    // Query to retrieve students for the selected camp
    $query = "SELECT regno FROM register WHERE campid = '$selectedCamp'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $students = array();
        while ($row = $result->fetch_assoc()) {
            $students[] = $row['regno'];
        }

        // Display students with checkboxes
        foreach ($students as $student) {
            echo '<label><input type="checkbox" name="selectedStudents[]" value="' . $student . '">' . $student . '</label><br>';
        }
    } else {
        echo "No students registered for the selected camp";
    }
} else {
    echo "Invalid camp selection";
}

$conn->close();
?>
