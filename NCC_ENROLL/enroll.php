<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ncc";
    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Retrieve data from the form
    $firstName = $_POST['studentfirstname'];
    $middleName = $_POST['studentmiddlename'];
    $lastName = $_POST['studentlastname'];
// Step 2: Concatenate the names
    $stu_name  = $firstName . ' ' . $middleName . ' ' . $lastName;
    $Mobile_Number= $_POST['mobileno'];
    $Email 	= $_POST['email'];
    $Gender = $_POST['gender'];
    $Registration_number= $_POST['rno'];
    $Name_of_school = $_POST['institutecode'];
    $Stream = $_POST['substream'];
    $PAN_crad= $_POST['pan'];
    $Aadhar_number  = $_POST['ad'];
    $DOB = $_POST['dobdob'];
    $fsalutation = $_POST['fsalutation'];
    $fatherfirstname = $_POST['fatherfirstname'];
    $fathermiddlename = $_POST['fathermiddlename'];
    $fatherlastname = $_POST['fatherlastname'];
    $father_name  = $fsalutation .' ' .$fatherfirstname . ' ' . $fathermiddlename . ' ' . $fatherlastname;
    $msalutation = $_POST['msalutation'];
    $motherfirstname = $_POST['motherfirstname'];
    $mothermiddlename = $_POST['mothermiddlename'];
    $motherlastname = $_POST['motherlastname'];
    $mother_name = $msalutation .' ' .$motherfirstname . ' ' . $mothermiddlename . ' ' . $motherlastname;
    $nationality  = $_POST['nationality'];
    $bank_name  = $_POST['bn'];    
    $account_no  = $_POST['accountno'];
    $ifsc_code = $_POST['ifsccode'];
    $edu_qualification  = $_POST['qualification'];
    $marks = $_POST['markpercent'];
    $com_address = $_POST['comaddress'];
    $com_pincode = $_POST['compincode'];
    $nearest_railway_station = $_POST['railway'];
    $nearest_police_station = $_POST['policestation'];
    $identification_mark1 = $_POST['identificationmark1'];
    $identification_mark2 = $_POST['identificationmark2'];
    $blood_group = $_POST['bloodgroup'];
    $medical_complaint = $_POST['medicalcomplaint'];

    $convicted_by_criminal_court = $_POST['enableInput'];

$file_name = $_POST['file_name'];
$file_type = $_POST['file_type'];
$file_data = $_POST['file_data'];
    $willing_to_enroll  = $_POST['enrolldeclaration'];
    $enrolled_in_ncc = $_POST['previousapplied'];
    if($enrolled_in_ncc=="Yes")
    $previous_enrollment_number = $_POST['pre'];
    else
    $previous_enrollment_number = "NULL";
    $dismissed_from_ncc  = $_POST['pa'];
    if( $dismissed_from_ncc=="Yes")
    {
    $dismissal_details = $_POST['par'];
    }
    else
    $dismissal_details = "NULL";
    $ncc_unit_enrolled = $_POST['ucode'];
    $kin_name = $_POST['kinname'];
    $kin_relationship = $_POST['kinrelationship'];
    $kin_contact_no = $_POST['kincontactno'];
    $kin_address = $_POST['kinaddress'];
    $place = $_POST['place'];
    $Datee = $_POST['Datee'];

    // Sanitize and validate the data (you should implement proper validation)

    $photo_name = $_POST['photo_name'];
$photo_size = $_POST['photo_size'];
$photo_type = $_POST['photo_type'];
$photo_data = base64_decode($_POST['photo_data']);
$file_data_base64 = $_POST['file_data'];

// Decode the base64-encoded file data to get the binary data
$file_data = base64_decode($file_data_base64);
    $regimental_number=NULL;
    $conn->query("SET GLOBAL max_allowed_packet=134217728");

    $check_query = "SELECT COUNT(*) as count FROM enroll WHERE Registration_number = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $Registration_number); // Bind the parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];
    if ($count > 0) {
        // Registration number already exists, display an alert and redirect back
        echo '<script>alert("Registration number already exists."); window.history.back();</script>';
        // Stop further execution
    }
       else{
         $sql = "INSERT INTO enroll (stu_name,pno,Email,Gender,Registration_number,photo_name ,photo_data ,Name_of_school ,Stream ,PAN_crad ,Aadhar_number ,Date__of__birth ,father_name ,mother_name ,nationality ,bank_name ,account_no ,ifsc_code ,edu_qualification ,marks ,com_address ,com_pincode,nearest_railway_station ,nearest_police_station ,	identification_mark1 ,	identification_mark2 ,	blood_group ,	medical_complaint ,	convicted_by_criminal_court ,	criminal_court_details ,file_name ,	file_data ,	file_type ,	willing_to_enroll ,	enrolled_in_ncc ,previous_enrollment_number ,dismissed_from_ncc ,dismissal_details ,ncc_unit_enrolled ,kin_name ,kin_relationship ,kin_contact_no ,kin_address,	place ,Datee,regimental_number)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
                ,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssss",$stu_name,$Mobile_Number,$Email,$Gender,$Registration_number,$photo_name ,$photo_data ,$Name_of_school ,$Stream ,$PAN_crad ,$Aadhar_number,$DOB,$father_name,$mother_name ,$nationality,$bank_name ,$account_no ,$ifsc_code ,$edu_qualification,$marks ,$com_address ,$com_pincode,$nearest_railway_station ,$nearest_police_station ,	$identification_mark1 ,$identification_mark2,	$blood_group,	$medical_complaint ,	$convicted_by_criminal_court ,$criminal_court_details ,$file_name,$file_data ,$file_type ,$willing_to_enroll ,$enrolled_in_ncc ,$previous_enrollment_number ,$dismissed_from_ncc,$dismissal_details ,$ncc_unit_enrolled ,$kin_name ,$kin_relationship,$kin_contact_no ,$kin_address,$place ,$Datee,$regimental_number);
        if ($stmt->execute()) {
            echo '<script>alert("Registered successfully!");</script>';
            echo '<script>window.location.href = "enroll.html";</script>';
            
        } else {
            echo "Error: " ."<br>" . $stmt->error;
        }
        // Close the database connection
        $conn->close();
    }
}
    ?>