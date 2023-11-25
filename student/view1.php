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
            padding: 5px;
        }
        .detail {
            color: #333;
            padding:5px;
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
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['eventName'])) {
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
            $eventName = $_GET['eventName'];
            
            $sql = "SELECT * FROM events WHERE name = '$eventName'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h2>Event Details</h2>";
                echo "<p><span class='details'>Event Name:</span> <span class='detail'>" . $row['name'] . "</span></p>";
                echo "<p><span class='details'>Event Type:</span> <span class='detail'>" . $row['type'] . "</span></p>";
                echo "<p><span class='details'>From Date:</span> <span class='detail'>" . $row['fdate'] . "</span></p>";
                echo "<p><span class='details'>To Date:</span> <span class='detail'>" . $row['tdate'] . "</span></p>";
                // You can add more details as needed
            } else {
                echo "Event details not found.";
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "Event Name not provided.";
        }
        ?>
    </div>
</body>
</html>
