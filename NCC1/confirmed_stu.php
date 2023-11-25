<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ncc";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<html>";
echo "<head>";
echo "<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border: 2px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    h2 {
        color: FF9546;;
    }
</style>";
echo "</head>";
echo "<body>";
// Get distinct campid values from the database
$sql = "SELECT DISTINCT campid FROM register";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $campid = $row["campid"];
        $recordsSql="SELECT * FROM register INNER JOIN enroll ON register.regno = enroll.Registration_number WHERE status='yes' AND campid='$campid' AND enroll.ncc_unit_enrolled = '10A'";

        // Select records for the current campid and specific regimental number
        $recordsResult = $conn->query($recordsSql);

        if ($recordsResult->num_rows > 0) {
            // Output table header
            echo "<h2>Confirmed students for $campid</h2>";
            echo "<table border='1'><tr><th>campid</th><th>Regimental_number</th><th>Name</th><th>Registration_number</th><th>Certificate</th></tr>";

            // Output data of each row in the current campid and specific regimental number
            while($record = $recordsResult->fetch_assoc()) {
                $registrationNumber = $record["Registration_number"];
 $checkRegisterQuery = "SELECT registerid FROM register WHERE campid='$campid' AND regno='$registrationNumber'";
                $registerResult = $conn->query($checkRegisterQuery);

                if ($registerResult->num_rows > 0) {
                    $registerRow = $registerResult->fetch_assoc();
                    $registerid = $registerRow['registerid'];
                    $checkCertificateQuery = "SELECT certificate FROM camp_certificate WHERE registerid='$registerid'";
                    $certificateResult = $conn->query($checkCertificateQuery);

                    echo "<tr><td>".$record["campid"]."</td><td>".$record["regimental_number"]."</td><td>".$record["stu_name"]."</td><td>".$registrationNumber."</td><td>";

                    if ($certificateResult->num_rows > 0) {
                        $certificateRow = $certificateResult->fetch_assoc();
                        $certificateFileName = $certificateRow['certificate'];
                        echo "<a href='download_certificate.php?registerid=$registerid' download>download</a>";
                    } else {
                        echo "Not Yet Uploaded";
                    }

                    echo "</td></tr>";
                }
            }

            echo "</table>";
        }
         else
         { 
            echo  "No records found for campid: $campid\n";
            echo "<br>";
        }
        
    }
} else {
    echo "No distinct campid values found in the database for the specified regimental number.";
}

// Close the connection
$conn->close();
?>