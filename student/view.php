<!DOCTYPE html>
<html>
<head>
    <title>Camp Details</title>
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

        p {
            margin: 10px 0;
        }

        .container {
            max-width: 800px;
            margin-top: 39px;
            padding: 20px;
            background-color:#ccc;
            margin-left: 75px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .details {
            font-weight: bold;
            color: #333;
            font-size: 20px;
        }
        .detail {
            color: #333;
            font-size: 20px;
        }

        .details span {
            color: #007bff;
        }

        .apply-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .apply-button:hover {
            background-color: #0056b3;
        }

        .registration-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 50%;
            margin-top: 10px;
        }
        label {
            font-weight: bold;
            margin-right: 5px;
            font-size: 20px;
        }

        input[type="text"],
        {
            width: 60%;
            margin-top: 5px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['campName'])) {
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

            // Retrieve camp details based on the campName from the URL
            $campName = $_GET['campName'];
            $sql = "SELECT * FROM camps WHERE name = '$campName'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h2>Camp Details</h2>";
                $today = date('Y-m-d');
       SESSION_start();
                $_SESSION['campIdd']=$row['campid'];
                echo "<p><span class='details'>Camp Name:</span> <span class='detail'>" . $row['name'] . "</span></p>";
                echo "<p><span class='details'>Location:</span> <span class='detail'>" . $row['location'] . "</span></p>";
                echo "<p><span class='details'>From Date:</span> <span class='detail'>" . $row['fdate'] . "</span></p>";
                echo "<p><span class='details'>To Date:</span> <span class='detail'>" . $row['tdate'] . "</span></p>";
                echo "<p><span class='details'>Daily Allowance (per student):</span> <span class='detail'>" . $row['dallow'] . "</span></p>";
                echo "<p><span class='details'>Travel Allowance (per student):</span> <span class='detail'>" . $row['tallow'] . "</span></p>";
                echo "<p><span class='details'>Petrol Oil Lubricant Allowance (POL) (per student):</span> <span class='detail'>" . $row['pol'] . "</span></p>";
                echo "<p><span class='details'>Total Expenditure:</span> <span class='detail'>" . $row['exp'] . "</span></p>";
                echo "<p><span class='details'>Number of Students:</span> <span class='detail'>" . $row['no_stu'] . "</span></p>";
                // You can add more details as needed

                // Show registration input for upcoming camps
              
                if ($row['fdate'] > $today) {
                    echo '<form method="POST" action="register.php">';
                    echo '<button type="submit" class="apply-button">Apply</button>';
                    echo '</form>';
                }
            } else {
                echo "Camp details not found.";
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "Camp Name not provided.";
        }
        ?>
    </div>
</body>
</html>
