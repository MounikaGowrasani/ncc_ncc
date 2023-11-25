<!DOCTYPE html>
<html>
<head>
    <center><title>Feedback Table</title></center>
    <style>
        /* Apply styles to the table */
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        /* Style table headers */
        th {
            background-color: #f2f2f2;
            text-align: left;
        }

        /* Style table rows */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Style table cells */
        td, th {
            padding: 8px;
            border: 1px solid #ddd;
        }
    </style>

</head>
<body>
    <h2>Feedback Data</h2>
<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncc";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query="SELECT * FROM feedback INNER JOIN enroll ON feedback.regno = enroll.regimental_number WHERE enroll.ncc_unit_enrolled='138-B,25(A)BN NCC,Guntur' OR enroll.ncc_unit_enrolled='25A'";

    // Execute the query
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo '<table border="1">';
        echo '<tr><th>Registration Number</th><th>Feedback</th><th>Rating</th><th>Feedback Date</th></tr>';
        
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['regno'] . '</td>';
            echo '<td>' . $row['feedback'] . '</td>';
            echo '<td>' . $row['rating'] . '</td>';
            echo '<td>' . $row['feedbackdate'] . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
    } else {
        echo 'No feedback data found.';
    }

    // Close the database connection
    $conn->close();
    ?>

<br>

</body>
</html>

