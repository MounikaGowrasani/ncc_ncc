<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncc";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h2>138-B,25(A)BN NCC,Guntur</h2>";
$sql = "SELECT * FROM enroll where ncc_unit_enrolled='138-B,25(A)BN NCC,Guntur' OR ncc_unit_enrolled='25A'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<style>
    
    th,td{
        padding: 10px;
    }
   
    .date {
        font-size: 18px;
        margin: 20px;
    }
    </style>";
    echo "<table border='1'><tr><th>ID</th>
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
    <th>Date__of__birth</th>
    <th>father_name</th>
    <th>mother_name</th>
    <th>nationality</th>
    <th>bank_name</th>
    <th>account_no</th>
    <th>ifsc_code</th>
    <th>edu_qualification</th>
    <th>marks</th>
    <th>com_address</th> 
    <th>com_pincode</th>
    <th>identification_mark1</th>
    <th>identification_mark2</th>
    <th>blood_group</th> 
    <th>place</th>
    <th>Datee</th>
    <th>regimental_number</th>
    </tr>";
    $id=1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $id . "</td><td>" . $row["stu_name"] . "</td><td>" . $row["pno"] ."</td><td>" . $row["Email"] . "</td><td>" . $row["Gender"] ."</td><td>" . $row["Registration_number"] . "</td><td>";

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
        echo $row["regimental_number"];
        echo "<form method='POST' action='update_regimental_number.php' onsubmit='updateRegimentalNumber(this)'>
        <input type='hidden' name='student_id' value='" . $row['Registration_number'] . "'>
        <input type='text' name='new_regimental_number' style='display:none;' placeholder='New Regimental Number'>
        <input type='submit' name='submit' value='Update' style='display:none;'>
        <button type='button' onclick='showUpdateFields(this)'>Update Regimental Number</button>
    </form>";
        
        echo "</td></tr>";
        $id=$id+1;
    }

    echo "</table>";
} else {
    echo "No results found";
}
echo "<br><br>";
echo "<button onclick='exportToExcel25()'>Export to Excel</button>";
echo "<button id='exportBu' onclick='exportToWord25()'>Export to Word</button>";
echo "<br><br>";
echo "<h2>65-G,10(A)GBN NCC,Guntur</h2>";
$sql = "SELECT * FROM enroll where ncc_unit_enrolled='65-G,10(A)GBN NCC,Guntur' OR ncc_unit_enrolled='10A'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th>
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
    <th>Date__of__birth</th>
    <th>father_name</th>
    <th>mother_name</th>
    <th>nationality</th>
    <th>bank_name</th>
    <th>account_no</th>
    <th>ifsc_code</th>
    <th>edu_qualification</th>
    <th>marks</th>
    <th>com_address</th> 
    <th>com_pincode</th>
    <th>identification_mark1</th>
    <th>identification_mark2</th>
    <th>blood_group</th> 
    <th>place</th>
    <th>Datee</th>
    <th>regimental_number</th>
    </tr>";
    $id=1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $id . "</td><td>" . $row["stu_name"] . "</td><td>" . $row["pno"] ."</td><td>" . $row["Email"] . "</td><td>" . $row["Gender"] ."</td><td>" . $row["Registration_number"] . "</td><td>";


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
        echo $row["regimental_number"];
        echo "<form method='POST' action='update_regimental_number.php' onsubmit='updateRegimentalNumber(this)'>
        <input type='hidden' name='student_id' value='" . $row['Registration_number'] . "'>
        <input type='text' name='new_regimental_number' style='display:none;' placeholder='New Regimental Number' minlength='13' maxlength='13'>
        <input type='submit' name='submit' value='Update' style='display:none;'>
        <button type='button' onclick='showUpdateFields(this)'>Update Regimental Number</button>
    </form>";
        
        echo "</td></tr>";
        $id=$id+1;
    }

    echo "</table>";
} else {
    echo "No results found";
}

echo "<br><br>";
echo "<button id='exportButton' onclick='exportToExcel()'>Export to Excel</button>";
echo "<button id='exportBu' onclick='exportToWord()'>Export to Word</button>";
echo "<br><br>";
// Close the database connection
$conn->close();
?>
<script>
    function showUpdateFields(formButton) {
        // Get the parent form element
        var form = formButton.parentNode;
        
        // Get the input fields
        var newRegimentalNumberInput = form.querySelector('input[name="new_regimental_number"]');
        var submitButton = form.querySelector('input[type="submit"]');
        
        // Display the input fields
        newRegimentalNumberInput.style.display = 'block';
        submitButton.style.display = 'block';
        
        // Hide the "Update Regimental Number" button
        formButton.style.display = 'none';
    }
    
    function updateRegimentalNumber(form) {
        // You can add your AJAX code here to submit the form data to the server
        
        // For demonstration purposes, let's display the new value in an alert
        var newRegimentalNumber = form.querySelector('input[name="new_regimental_number"]').value;
       
        alert("New Regimental Number: " + newRegimentalNumber);
    }
    function exportToExcel() {
        
        window.location.href = 'export.php';
        }
        function exportToExcel25() {
        
        window.location.href = 'export25.php';
        }
    function exportToWord(){
        
        window.location.href = 'exportw.php';
        }
        function exportToWord25() {
        
        window.location.href = 'exportw25.php';
        }
        
</script>
