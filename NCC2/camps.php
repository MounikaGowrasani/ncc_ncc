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

// Get data from the form
$campName = $_POST['campName'];
$location = $_POST['location'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$dailyAllowance = $_POST['dailyAllowance'];
$travelAllowance = $_POST['travelAllowance'];
$polAllowance = $_POST['polAllowance'];
$numberOfStudents = $_POST['numberOfStudents'];
$startDateTimestamp = strtotime($startDate);
$endDateTimestamp = strtotime($endDate);
$numberOfDays = ($endDateTimestamp - $startDateTimestamp) / (60 * 60 * 24); // Number of days between start and end date
$totalExpenditure = ($dailyAllowance + $travelAllowance + $polAllowance) * $numberOfDays;
$currentYear = date("Y");
$campId=$campName."@".$currentYear;
// Insert data into the database
$checkCampIdQuery = "SELECT * FROM camps WHERE campId='$campId'";
$checkCampIdResult = $conn->query($checkCampIdQuery);

if ($checkCampIdResult->num_rows > 0) {
    echo "<script>alert('Camp ID already exists!'); window.history.back();</script>";
} else {
    // Insert data into the database
    $insertSql = "INSERT INTO camps 
    VALUES ('$campId','$campName', '$location', '$startDate', '$endDate', $dailyAllowance, $travelAllowance, $polAllowance, $numberOfStudents,$totalExpenditure)";
    
    if ($conn->query($insertSql) === TRUE) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>