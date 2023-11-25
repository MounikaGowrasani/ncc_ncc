<!DOCTYPE html>
<html>
<head>
    <title>Update Number of Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            margin: 20px 0;
            font-size: 30px;
        }

        .container {
            max-width: 800px;
            margin-top: 39px;
            padding: 20px;
            background-color: #ccc;
            margin-left: 75px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .update-form {
            margin-top: 20px;
        }

        .input-label {
            font-weight: bold;
            font-size: 20px;
        }

        .update-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 50%;
            margin-top: 10px;
        }

        .update-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .update-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Number of Students</h2>
        <?php
        session_start(); // Start the session

        if (isset($_SESSION['campid'])) {
            $campid = $_SESSION['campid'];

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updated_no_stu'])) {
                // Retrieve updated number of students from the form
                $updatedNoStudents = $_POST['updated_no_stu'];

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

                // Update the camps table with the new number of students for the specific campid
                $sql = "UPDATE camps SET no_stu = '$updatedNoStudents' WHERE campid = '$campid'";
                if ($conn->query($sql) === TRUE) {
                    echo '<script>alert("Number of students updated successfully.");</script>';
                    echo '<script>window.location.href = "view_camps.php";</script>';
                } else {
                    echo "Error updating number of students: " . $conn->error;
                }

                // Close the database connection
                $conn->close();
            }
        } else {
            echo "Camp ID not found in session.";
        }
        ?>
        <form method="POST" class="update-form">
            <label class="input-label" for="campid">Camp ID:</label>
            <?php echo $campid; ?>
            <br>
            <label class="input-label" for="updated_no_stu">Enter Updated Number of Students:</label>
            <input type="text" name="updated_no_stu" class="update-input" id="updated_no_stu" placeholder="Updated Number of Students">
            <br>
            <button type="submit" class="update-button">Update</button>
        </form>
    </div>
</body>
</html>
