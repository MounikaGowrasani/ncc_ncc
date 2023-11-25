<!DOCTYPE html>
<html>
<head>
    <title>View Events</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            color: #333;
            margin: 10px 0;
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #ffffff;
            margin: 10px 0;
            align:center;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        li:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        /* Dropdown styles */
        label {
            font-weight: bold;
            margin-right: 10px;
        }

        #eventType {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        /* Button styles */
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Events</h1>
        <br>
        <!-- Dropdown menu for camp types -->
        <form method="post" action="">
            <label for="eventType">Select Event :</label>
            <select id="eventType" name="eventType">
                <option value="upcoming">Upcoming Events</option>
                <option value="active">Active Events</option>
                <option value="completed">Completed Events</option>
            </select>
            <input type="submit" value="Show Events">
        </form>

            
        <ul>
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

            // Determine the camp type based on the selected dropdown option
            $eventType = "upcoming"; // Default is upcoming
            if (isset($_POST['eventType'])) {
                $eventType = $_POST['eventType'];
            }

            // Retrieve camp names based on camp type and dates
            $today = date('Y-m-d');
            $sql = "";
            $currentYear=date('Y');
            if ($eventType === 'upcoming') {
                $sql = "SELECT name FROM events WHERE fdate > '$today' AND right(event_id,4)='$currentYear'";
            } elseif ($eventType === 'completed') {
                $sql = "SELECT name FROM events WHERE tdate < '$today' AND right(event_id,4)='$currentYear'";
            } elseif ($eventType === 'active') {
                $sql = "SELECT name FROM events WHERE fdate <= '$today' AND tdate >= '$today' AND right(event_id,4)='$currentYear'";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $eventName = $row['name'];
                    echo "<li><a href='view1.php?eventName=$eventName'>$eventName</a></li>";
                }
            } else {
                echo "No Events found for the selected type.";
            }

            // Close the database connectioN

            $conn->close();
            ?>
        </ul>
    </div>
</body>
</html>