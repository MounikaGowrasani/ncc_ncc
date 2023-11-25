<!DOCTYPE html>
<html>
<head>
    <title>Retrieve PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #333;
            margin: 10px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 10px;
        }

        button {
            margin-top: 10px;
        }

        #update {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
if (isset($_POST["update"])) {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ncc";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to safely close the database connection
    function closeConnection($conn) {
        if ($conn) {
            $conn->close();
        }
    }

    try {
        $scheduleType = $_POST['schedule_type'];
        $currentYear = date('Y');

        if (isset($_FILES['schedule_file'])) {
            $fileName = $_FILES['schedule_file']['name'];
            $fileTmpName = $_FILES['schedule_file']['tmp_name'];

            // Ensure it's a PDF file
            if (pathinfo($fileName, PATHINFO_EXTENSION) === 'pdf') {
                $fileContent = file_get_contents($fileTmpName);
                $escapedFileName = $conn->real_escape_string($fileName);
                $escapedFileContent = $conn->real_escape_string($fileContent);

                $unit = ($scheduleType === 'update1') ? '10A' : '25A';

                // Check if a record with the given criteria exists in the database
                $sql_check = "SELECT * FROM pdf_files WHERE unit = '$unit' AND years = '$currentYear'";
                $result = $conn->query($sql_check);

                if ($result && $result->num_rows > 0) {
                    // If the record exists, update it
                    $sql = "UPDATE pdf_files SET file_name = '$escapedFileName', file_content = '$escapedFileContent' 
                            WHERE unit = '$unit' AND years = '$currentYear'";
                } else {
                    // If the record doesn't exist, insert a new record
                    $sql = "INSERT INTO pdf_files (unit, years, file_name, file_content)
                            VALUES ('$unit', '$currentYear', '$escapedFileName', '$escapedFileContent')";
                }

                if ($conn->query($sql) === TRUE) {
                    echo "File updated successfully.";
                } else {
                    echo "Error updating file: " . $conn->error;
                }
            } else {
                echo "Error: File must be a PDF.";
            }
        } else {
            echo "Error: File upload failed or no file selected.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        closeConnection($conn);
    }
}
?>
<h2>Retrieve PDF</h2>
<div class="container">
    <a href="retrieve1.php" target="_self">View ANO1(10A) Schedule</a>
    <br>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="schedule_file" accept=".pdf">
        <input type="hidden" name="schedule_type" value="update1">
        <button type="submit" name="update" id="update">Update Schedule</button>
    </form>
</div>
<br>
<br>
<div class="container">
    <a href="retrieve2.php">View ANO2(25A) Schedule</a>
    <br>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="schedule_file" accept=".pdf">
        <input type="hidden" name="schedule_type" value="update2">
        <button type="submit" name="update" id="update">Update Schedule</button>
    </form>
</div>
</body>
</html>