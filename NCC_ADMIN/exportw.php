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

// Fetch data from the database
$sql = "SELECT regimental_number,stu_name,photo_data FROM enroll where  ncc_unit_enrolled='65-G,10(A)GBN NCC,Guntur' OR ncc_unit_enrolled='10A'";
$result = $conn->query($sql);

// Create an HTML table
$html = '<style>
table {
    margin: 20px auto;
    border-collapse: collapse;
    width: 80%;
}

table, th, td {
    border: 1px solid black;
}

th, td {
    padding: 8px;
}

th {
    background-color: #f2f2f2;
}
</style>
<table border="1">
    <tr>
        <th>Regimental_number</th>
        <th>Name</th>
        <th>Photo</th>
    </tr>';

while ($row = $result->fetch_assoc()) {
    $name = $row['regimental_number'];
    $email = $row['stu_name'];
    $imageData = $row['photo_data'];
    
    $imageBase64 = base64_encode($imageData);

    // Embed the base64 image data within an HTML img tag
    $html .= '<tr>
        <td>' . $name . '</td>
        <td>' . $email . '</td>
        <td><img src="data:image/jpeg;base64,' . $imageBase64 . '" alt="Photo" style="max-width: 50px; max-height: 50px;"></td>
    </tr>';
}

$html .= '</table>';

$conn->close();

// Set headers for Excel download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="student(10A).xls"');

// Output the HTML as an Excel file
echo $html;
?>