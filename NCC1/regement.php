<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncc";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM enroll where ncc_unit_enrolled='65-G,10(A)GBN NCC,Guntur' OR ncc_unit_enrolled='10A'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<html>";
echo "<head>";
echo "<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5; /* Light gray background */
}

.table-container {
    overflow-x: auto;
    margin: 20px;
    background-color: #fff; /* White background for the table */
    border-radius: 10px; /* Rounded corners for the table container */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: FF9546; /* Orange background for table headers */
    color: black;
}

.regimental-number {
    width: 80px;
}

.button-container {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}

.export-button {
    background-color: #3498db; /* Blue background for export buttons */
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border-radius: 5px; /* Rounded corners for buttons */
}

.export-button:hover {
    background-color: #2980b9; /* Darker blue shade on hover */
}

   
</style>";
echo "</head>";
echo "<body>";
    echo "<table border=><tr><th>ID</th>
    <th>stu_name</th>
    <th>pno</th>
    <th>Email</th>
    <th>Gender</th>
    <th>Registration_number</th>
    <th>photo</th>
    <th>Name_of_school</th> 
    <th>Stream</th>
    <th>PAN_card_no</th>
    <th>Marks memos</th>
    <th>Aadhar_number</th>
    <th>Date__of__birth </th>
    <th>father_name </th>
    <th>mother_name </th>
    <th>nationality </th>
    <th>bank_name </th>
    <th>account_no </th>
    <th>ifsc_code </th>
    <th>edu_qualification </th>
    <th>marks </th>
    <th>com_address</th> 
    <th>com_pincode</th>
    <th>identification_mark1 </th>
    <th>identification_mark2 </th>
    <th>blood_group</th> 
    <th>place </th>
    <th>Date</th>
    <th>Regimental_number</th>
    </tr>";
    $id=1;
    $alternateColor = false;
    while ($row = $result->fetch_assoc()) {
        $rowColor = $alternateColor ? '#FFB476' : '#FFF7E8'; 
        echo "<tr style='background-color: " . $rowColor . ";'><td>" . $id . "</td><td>" . $row["stu_name"] . "</td><td>" . $row["pno"] ."</td><td>" . $row["Email"] . "</td><td>" . $row["Gender"] ."</td><td>" . $row["Registration_number"] . "</td><td>";

        if (isset($row["photo_data"])) {
            // Assuming the "photo_data" column contains the image data
            // Display the image using an <img> tag
            echo "<img src='data:image/png;base64," . base64_encode($row["photo_data"]) . "' alt='Student Photo' width='100'>";
        } else {
            echo "No photo available";
        }

        echo "</td><td>" . $row["Name_of_school"] . "</td><td>" . $row["Stream"] ."</td><td>" . $row["PAN_crad"] . "</td><td>";


        if (!empty($row["file_data"])) {
            $pdfData = $row["file_data"];
            $pdfDataEncoded = base64_encode($pdfData);
            $rno=$row['Registration_number'];
            // Create a unique filename for the downloaded PDF (optional)
            $filename = " " . $rno . ".pdf";

            // Display the link to download the PDF
            echo "<a href='data:application/pdf;base64,$pdfDataEncoded' download='$filename'>$filename</a>";
        } else {
            // Display "File not available" when file_data is empty
            echo "File not available";
        }

        // Continue displaying other columns

        echo "</td><td>". $row["Aadhar_number"] ."</td><td>" . $row["Date__of__birth"] . "</td><td >" . $row["father_name"] ."</td><td>" . $row["mother_name"] . "</td><td>" . $row["nationality"] ."</td><td>" . $row["bank_name"] . "</td><td>" . $row["account_no"] ."</td><td>" . $row["ifsc_code"] . "</td><td>" . $row["edu_qualification"] ."</td><td>" . $row["marks"] . "</td><td>" . $row["com_address"] ."</td><td>" . $row["com_pincode"] . "</td><td>" . $row["identification_mark1"] ."</td><td>".$row["identification_mark2"] . "</td><td>" . $row["blood_group"]."</td><td>".$row["place"] . "</td><td>" . $row["Datee"];
        echo "</td><td>";
        if ($row["regimental_number_updated"]==NULL) {
            // Display an input field to update regimental_number
            echo "<form method='POST' action='update_regimental_number.php'>
            <input type='hidden' name='student_id' value='" . $row['Registration_number'] . "'>
            <input type='text' class='editable regimental-number' name='new_regimental_number' data-column='regimental_number' value='" . $row["regimental_number"] . "'>
            <input type='submit' name='submit' value='Update Regimental Number'>
        </form>";
        } else {
            // Display the existing regimental_number as plain text
            echo $row["regimental_number"];
        }
        echo "</td></tr>";
        $alternateColor = !$alternateColor;
        $id=$id+1;
    }
    echo "</table>";
} else {
    echo "No results found";
}
echo "<div class='button-container'>";
echo "<button class='export-button' onclick='exportToExcel()'>Export to Excel</button>";
echo "<button class='export-button' id='exportBu' onclick='exportToWord()'>Export to Word</button>";
echo "</div>";


$conn->close();
?>
<script>
function exportToExcel() {
        
        window.location.href = '/NCC_MAIN/NCC_ADMIN//export.php';
        }
        
    function exportToWord(){
        
        window.location.href = '/NCC_MAIN/NCC_ADMIN//exportw.php';
        }

        
</script>