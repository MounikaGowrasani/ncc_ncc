<?php
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
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=student(25A)_list.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
 
 
	$output = "";
 
	$output .="
		<table>
			<thead>
				<tr style='width: 100px; height: 100px;'>
				<th>stu_name</th>
				<th>pno</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Registration_number</th>
				<th>photo</th>
				<th>Name_of_school</th> 
				<th>Stream</th>
				<th>PAN_card_no</th>
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
				<th>Date</th>
				<th>regimental_number</th>
				</tr>
			<tbody>
	";
 
	$query = $conn->query("SELECT * FROM `enroll` where ncc_unit_enrolled='138-B,25(A)BN NCC,Guntur' OR ncc_unit_enrolled='25A'") or die(mysqli_errno());
	while($fetch = $query->fetch_array()){
		$aadhar_number ="'". $fetch['Aadhar_number'];
	$output .= "
				<tr style='width: 100px; height: 100px;'>
				<td>".$fetch['stu_name']."</td>
				<td>".$fetch['pno']."</td>
				<td>".$fetch['Email']."</td>
				<td>".$fetch['Gender']."</td>
				<td>".$fetch['Registration_number']."</td>
				<td><img src='data:image/png;base64," . base64_encode($fetch['photo_data']) . "' alt='Student Photo' width='100'></td>
				<td>".$fetch['Name_of_school']."</td>
				<td>".$fetch['Stream']."</td>
				<td>".$fetch['PAN_crad']."</td>
				
				<td>".$aadhar_number."</td>
				<td>".$fetch['Date__of__birth']."</td>
				<td>".$fetch['father_name']."</td>
				<td>".$fetch['mother_name']."</td>
				<td>".$fetch['nationality']."</td>
				<td>".$fetch['bank_name']."</td>
				<td>".$fetch['account_no']."</td>
				<td>".$fetch['ifsc_code']."</td>
				<td>".$fetch['edu_qualification']."</td>
				<td>".$fetch['marks']."</td>
				<td>".$fetch['com_address']."</td>
				<td>".$fetch['com_pincode']."</td>
				<td>".$fetch['identification_mark1']."</td>
				<td>".$fetch['identification_mark2']."</td>
				<td>".$fetch['blood_group']."</td>
				<td>".$fetch['place']."</td>
				<td>".$fetch['Datee']."</td>
				<td>".$fetch['regimental_number']."</td>
				
				</tr>
	";
	}
 
	$output .="
			</tbody>
 
		</table>
	";
 
	echo $output;
    ?>