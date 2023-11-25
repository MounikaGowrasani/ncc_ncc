<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form Submission and Preview</title>
</head>
<body>
    <?php
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
    
        /*if( $convicted_by_criminal_court=="yes")
        {
       
        $criminal_court_details = $_POST['textBox'];
        $file_name = ""; // Initialize these variables
        $file_data = "";
        $file_type = "";*/
    
        if (isset($_FILES["fileInput"])) {
          
            $file_name = $_FILES['fileInput']['name'];
            $file_type = $_FILES['fileInput']['type'];
            $file_data = file_get_contents($_FILES['fileInput']['tmp_name']);
        }
  

       
    
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
    
        if (isset($_FILES["photo"])) {
            $photo_name = $_FILES["photo"]["name"];
            $photo_tmp_name = $_FILES["photo"]["tmp_name"];
            $photo_size = $_FILES["photo"]["size"];
            $photo_type = $_FILES["photo"]["type"];
            
          
                $photo_data =  (file_get_contents($photo_tmp_name));
               
        }
      
        // ... (Rest of your PHP code for retrieving form data and processing)

        // Display the preview of the filled details
        echo "<h2>Preview of Filled Details</h2>";
        echo "<p><strong>1. Name:</strong> $stu_name</p>";
        echo "<p><strong>2. Mobile Number:</strong> $Mobile_Number</p>";
        echo "<p><strong>3. Email:</strong> $Email</p>";
        echo "<p><strong>4. Gender:</strong> $Gender</p>";
        echo "<p><strong>5. Registration number:</strong> $Registration_number</p>";
        if (isset($_FILES["photo"])) {
            $photo_tmp_name = $_FILES["photo"]["tmp_name"];
            $photo_data = file_get_contents($photo_tmp_name);
            $photo_base64 = base64_encode($photo_data);
            $photo_type = $_FILES["photo"]["type"];
            $maxWidth = 200; // Adjust this value as needed
            $maxHeight = 200;
            // Display the image in the preview
            echo "<p><strong>6. Photo:</strong></p>";
            echo '<img src="data:' . $photo_type . ';base64,' . $photo_base64 . '" alt="Uploaded Photo" width="' . $maxWidth . '" height="' . $maxHeight . '">';
        }
        echo "<p><strong>6. Name of School/College:</strong> $Name_of_school</p>";
        echo "<p><strong>7. Stream:</strong> $Stream</p>";
        echo "<p><strong>8. PAN card Number:</strong> $PAN_crad</p>";
        echo "<p><strong>9. Aadhaar/UID Number:</strong> $Aadhar_number</p>";
        echo "<p><strong>10. Date of Birth:</strong> $DOB</p>";
        echo "<p><strong>11. Father's Name:</strong> $father_name</p>";
        echo "<p><strong>12. Mother's Name:</strong> $mother_name</p>";
        echo "<p><strong>13. Nationality:</strong> $nationality</p>";
        echo "<p><strong>14. Bank Name:</strong> $bank_name</p>";
        echo "<p><strong>15. Account Number:</strong> $account_no</p>";
        echo "<p><strong>16. IFSC Code:</strong> $ifsc_code</p>";
        echo "<p><strong>17. Educational Qualification:</strong> $edu_qualification</p>";
        echo "<p><strong>18. Marks Percentage:</strong> $marks</p>";
        echo "<p><strong>19. Communication Address:</strong> $com_address</p>";
        echo "<p><strong>20. Communication Pincode:</strong> $com_pincode</p>";
        echo "<p><strong>21. Nearest Railway Station:</strong> $nearest_railway_station</p>";
        echo "<p><strong>22. Nearest Police Station:</strong> $nearest_police_station</p>";
        echo "<p><strong>23. Identification Mark 1:</strong> $identification_mark1</p>";
        echo "<p><strong>24. Identification Mark 2:</strong> $identification_mark2</p>";
        echo "<p><strong>25. Blood Group:</strong> $blood_group</p>";
        echo "<p><strong>26. Medical Complaint:</strong> $medical_complaint</p>";

        // Handle the "Convicted by a criminal court" section and file upload
        echo "<p><strong>27. Convicted by a criminal court:</strong> $convicted_by_criminal_court</p>";
        
        /*if ($convicted_by_criminal_court == "yes") {
            echo "<p><strong>Criminal Court Details:</strong> $criminal_court_details</p>";
            
            // You can also display the uploaded file information here
            
        }*/
        if (!empty($file_name)) {
            echo "<p><strong>28. Uploaded File:</strong> $file_name ($file_type)</p>";
        }

        echo "<p><strong>29. Willing to Enroll:</strong> $willing_to_enroll</p>";
        echo "<p><strong>30. Enrolled in NCC:</strong> $enrolled_in_ncc</p>";
        
        if ($enrolled_in_ncc == "Yes") {
            echo "<p><strong>31. Previous Enrollment Number:</strong> $previous_enrollment_number</p>";
        }

        echo "<p><strong>32. Dismissed from NCC:</strong> $dismissed_from_ncc</p>";

        if ($dismissed_from_ncc == "Yes") {
            echo "<p><strong>33. Dismissal Details:</strong> $dismissal_details</p>";
        }

        echo "<p><strong>34. NCC Unit Enrolled:</strong> $ncc_unit_enrolled</p>";
        echo "<p><strong>35. Kin Name:</strong> $kin_name</p>";
        echo "<p><strong>36. Kin Relationship:</strong> $kin_relationship</p>";
        echo "<p><strong>37. Kin Contact Number:</strong> $kin_contact_no</p>";
        echo "<p><strong>38. Kin Address:</strong> $kin_address</p>";
        echo "<p><strong>39. Place:</strong> $place</p>";
        echo "<p><strong>40. Date:</strong> $Datee</p>";
        


      
        // Optionally, you can provide a button to submit the data further
        echo '<form method="POST" action="enroll.php">';
        // Include hidden fields for all form data
        // Add similar lines for other form fields
        echo '<input type="hidden" name="studentfirstname" value="' . htmlspecialchars($firstName) . '">';
        // ... (your previous code)

// Include hidden input fields for the remaining form fields
echo '<input type="hidden" name="studentmiddlename" value="' . htmlspecialchars($middleName) . '">';
echo '<input type="hidden" name="studentlastname" value="' . htmlspecialchars($lastName) . '">';
echo '<input type="hidden" name="mobileno" value="' . htmlspecialchars($Mobile_Number) . '">';
echo '<input type="hidden" name="email" value="' . htmlspecialchars($Email) . '">';
echo '<input type="hidden" name="gender" value="' . htmlspecialchars($Gender) . '">';
echo '<input type="hidden" name="rno" value="' . htmlspecialchars($Registration_number) . '">';
echo '<input type="hidden" name="institutecode" value="' . htmlspecialchars($Name_of_school) . '">';
echo '<input type="hidden" name="substream" value="' . htmlspecialchars($Stream) . '">';
echo '<input type="hidden" name="pan" value="' . htmlspecialchars($PAN_crad) . '">';
echo '<input type="hidden" name="ad" value="' . htmlspecialchars($Aadhar_number) . '">';
echo '<input type="hidden" name="dobdob" value="' . htmlspecialchars($DOB) . '">';
echo '<input type="hidden" name="fsalutation" value="' . htmlspecialchars($fsalutation) . '">';
echo '<input type="hidden" name="fatherfirstname" value="' . htmlspecialchars($fatherfirstname) . '">';
echo '<input type="hidden" name="fathermiddlename" value="' . htmlspecialchars($fathermiddlename) . '">';
echo '<input type="hidden" name="fatherlastname" value="' . htmlspecialchars($fatherlastname) . '">';
echo '<input type="hidden" name="msalutation" value="' . htmlspecialchars($msalutation) . '">';
echo '<input type="hidden" name="motherfirstname" value="' . htmlspecialchars($motherfirstname) . '">';
echo '<input type="hidden" name="mothermiddlename" value="' . htmlspecialchars($mothermiddlename) . '">';
echo '<input type="hidden" name="motherlastname" value="' . htmlspecialchars($motherlastname) . '">';
echo '<input type="hidden" name="nationality" value="' . htmlspecialchars($nationality) . '">';
echo '<input type="hidden" name="bn" value="' . htmlspecialchars($bank_name) . '">';
echo '<input type="hidden" name="accountno" value="' . htmlspecialchars($account_no) . '">';
echo '<input type="hidden" name="ifsccode" value="' . htmlspecialchars($ifsc_code) . '">';
echo '<input type="hidden" name="qualification" value="' . htmlspecialchars($edu_qualification) . '">';
echo '<input type="hidden" name="markpercent" value="' . htmlspecialchars($marks) . '">';
echo '<input type="hidden" name="comaddress" value="' . htmlspecialchars($com_address) . '">';
echo '<input type="hidden" name="compincode" value="' . htmlspecialchars($com_pincode) . '">';
echo '<input type="hidden" name="railway" value="' . htmlspecialchars($nearest_railway_station) . '">';
echo '<input type="hidden" name="policestation" value="' . htmlspecialchars($nearest_police_station) . '">';
echo '<input type="hidden" name="identificationmark1" value="' . htmlspecialchars($identification_mark1) . '">';
echo '<input type="hidden" name="identificationmark2" value="' . htmlspecialchars($identification_mark2) . '">';
echo '<input type="hidden" name="bloodgroup" value="' . htmlspecialchars($blood_group) . '">';
echo '<input type="hidden" name="medicalcomplaint" value="' . htmlspecialchars($medical_complaint) . '">';
echo '<input type="hidden" name="enableInput" value="' . htmlspecialchars($convicted_by_criminal_court) . '">';
//echo '<input type="hidden" name="textBox" value="' . htmlspecialchars($criminal_court_details) . '">';
echo '<input type="hidden" name="previousapplied" value="' . htmlspecialchars($enrolled_in_ncc) . '">';
// Include hidden input field for $willing_to_enroll
echo '<input type="hidden" name="enrolldeclaration" value="' . htmlspecialchars($willing_to_enroll) . '">';

if ($enrolled_in_ncc == "Yes") {
    echo '<input type="hidden" name="pre" value="' . htmlspecialchars($previous_enrollment_number) . '">';
}

echo '<input type="hidden" name="pa" value="' . htmlspecialchars($dismissed_from_ncc) . '">';

if ($dismissed_from_ncc == "Yes") {
    echo '<input type="hidden" name="par" value="' . htmlspecialchars($dismissal_details) . '">';
}

echo '<input type="hidden" name="ucode" value="' . htmlspecialchars($ncc_unit_enrolled) . '">';
echo '<input type="hidden" name="kinname" value="' . htmlspecialchars($kin_name) . '">';
echo '<input type="hidden" name="kinrelationship" value="' . htmlspecialchars($kin_relationship) . '">';
echo '<input type="hidden" name="kincontactno" value="' . htmlspecialchars($kin_contact_no) . '">';
echo '<input type="hidden" name="kinaddress" value="' . htmlspecialchars($kin_address) . '">';
echo '<input type="hidden" name="place" value="' . htmlspecialchars($place) . '">';
echo '<input type="hidden" name="Datee" value="' . htmlspecialchars($Datee) . '">';
// Include hidden input fields for file-related variables
echo '<input type="hidden" name="photo_name" value="' . htmlspecialchars($photo_name) . '">';
echo '<input type="hidden" name="photo_size" value="' . htmlspecialchars($photo_size) . '">';
echo '<input type="hidden" name="photo_type" value="' . htmlspecialchars($photo_type) . '">';
echo '<input type="hidden" name="photo_data" value="' . base64_encode($photo_data) . '">';

// Include hidden input fields for file-related variables and $criminal_court_details
echo '<input type="hidden" name="convicted_by_criminal_court" value="' . htmlspecialchars($convicted_by_criminal_court) . '">';
//echo '<input type="hidden" name="criminal_court_details" value="' . htmlspecialchars($criminal_court_details) . '">';
echo '<input type="hidden" name="file_name" value="' . htmlspecialchars($file_name) . '">';
echo '<input type="hidden" name="file_type" value="' . htmlspecialchars($file_type) . '">';
$file_data_base64 = base64_encode($file_data);

// Include a hidden input field for the base64-encoded file data
echo '<input type="hidden" name="file_data" value="' . htmlspecialchars($file_data_base64) . '">';
        // Add similar lines for other form fields
        echo ' <input type="button" value="Edit" onclick="history.go(-1);">';
        echo '<input type="submit" name="submit" value="Confirm and Submit" >';
        echo '</form>';
    

?>

</body>
</html>