
<!DOCTYPE html>
<html>
<head>
    <title>Update Students</title>
    <style>
        .student-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .student-details {
            flex: 1;
            margin-right: 20px;
        }

        .student-photo {
            flex: 1;
            text-align: right;
        }

        .student-photo img {
            width: 150px;
            height: 150px;
        }
    </style>
</head>
<body>

<form action="update_status.php?camp=<?php echo $_GET['camp']; ?>" method="post"> <!-- Form to submit selected students -->
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
    $query = "SELECT regno FROM register WHERE campid = '$selectedCamp' and status='no'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $students = array();
        while ($row = $result->fetch_assoc()) {
            $students[] = $row['regno'];
        }

        // Display students with checkboxes and additional details
        foreach ($students as $student) {
            // Query to retrieve student details from the 'enroll' table
            $studentQuery = "SELECT stu_name, pno, Email, Gender, Registration_number, photo_name, photo_data FROM enroll WHERE Registration_number = '$student'";
            $studentResult = $conn->query($studentQuery);

            if ($studentResult->num_rows > 0) {
                while ($studentRow = $studentResult->fetch_assoc()) {
                    $stuName = $studentRow['stu_name'];
                    $pno = $studentRow['pno'];
                    $email = $studentRow['Email'];
                    $gender = $studentRow['Gender'];
                    $regNumber = $studentRow['Registration_number'];
                    $photoName = $studentRow['photo_name'];
                    $photoData = $studentRow['photo_data'];

                    // Display student details and checkboxes
                    echo '<div class="student-container">';
                    echo '<div class="student-details">';
                    echo '<label>';
                    echo '<input type="checkbox" name="selectedStudents[]" value="' . $regNumber . '">';
                    echo 'Name: ' . $stuName . '<br>';
                    echo 'Phone: ' . $pno . '<br>';
                    echo 'Email: ' . $email . '<br>';
                    echo 'Gender: ' . $gender . '<br>';
                    echo 'Registration Number: ' . $regNumber . '<br>';
                    echo '</label>';
                    echo '</div>';
                    echo '<div class="student-photo">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($photoData) . '" alt="' . $stuName . '" style="width: 150px; height: 150px;">'; // Adjust width and height as needed
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No student details found for registration number: $student";
            }
        }
    } else {
        echo "No students registered for the selected camp";
    }
} else {
    echo "No members to select";
}


$conn->close();

?>
    <button type="submit">Update Selected Students</button>
</form>

</body>
</html>
