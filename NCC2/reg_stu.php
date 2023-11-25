<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Reset some default browser styles */
        body,h2, label {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
        }


        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
        }

        #registeredStudents {
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .student-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .student-checkbox {
            margin-right: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div>
    <label for="campSelect">Select Camp ID:</label>
    <select id="campSelect" onchange="loadRegisteredStudents()">
        <!-- Camp IDs will be dynamically added here -->
    </select>
</div>
<div id="registeredStudents">
    <!-- Registered students will be displayed here -->
</div>
<?php
// Include your database connection code here
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

// Query to retrieve distinct camp IDs from the 'register' table
$query = "SELECT DISTINCT campid FROM register";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $campIDs = array();
    while ($row = $result->fetch_assoc()) {
        $campIDs[] = $row['campid'];
    }

    echo '<script>';
    echo 'var campSelect = document.getElementById("campSelect");';
    echo 'var campIDs = ' . json_encode($campIDs) . ';';
    echo 'campSelect.innerHTML = "";';
    echo 'campIDs.forEach(function (campID) {';
    echo 'var option = document.createElement("option");';
    echo 'option.value = campID;';
    echo 'option.text = campID;';
    echo 'campSelect.appendChild(option);';
    echo '});';
    echo '</script>';
} else {
    echo "No camp IDs found";
}

$conn->close();
?>

<div id="registeredStudents">
    <!-- Registered students will be displayed here -->
</div>

<script>
// JavaScript function to retrieve and display students for the selected camp
function loadRegisteredStudents() {
    var selectedCamp = document.getElementById('campSelect').value;

    // Send an AJAX request to retrieve students for the selected camp
    $.ajax({
        url: 'getstu.php',
        method: 'GET',
        data: { camp: selectedCamp },
        success: function (response) {
            var registeredStudents = document.getElementById('registeredStudents');
            registeredStudents.innerHTML = response;
        },
        error: function () {
            console.error('Failed to retrieve registered students');
        }
    });
}

// Call the loadRegisteredStudents function when the page loads
document.addEventListener("DOMContentLoaded", function () {
    loadRegisteredStudents();
});
</script>
</body>
</html>
