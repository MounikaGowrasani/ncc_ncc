<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="./p.css"/>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* Basic CSS for layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        #header {
            background-color: #2D3092;
            color: #fff;
            padding: 0px;
            text-align: center;
            display: flex; 
            align-items: center; 
            position:relative;
            height:80px;
        }

        #menu-button {
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 24px; /* Adjust the font size as needed */
        }

        #profile-button {
            background-color: #fff;
            color: #333;
            border: none;
            padding: 10px 20px;
           right:10px;
           position:absolute;
            border-radius: 50%;
            cursor: pointer;
            font-size: 24px; /* Adjust the font size as needed */
        }

        #profile-details {
            display: none;
            background-color: #fff;
            padding: 20px;
            text-align: left;
            color: #333;
            position: absolute;
            top: 60px;
            right: 0;
            z-index: 1;
        }

        #profile-details p {
            margin: 10px 0;
        }

        #update-password-button,
        #logout-button {
            background-color: rgb(255, 103, 15);
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
        }

        /* Style the "Dashboard" text */
        #dashboard-text {
            margin-left: 35px; /* Adjust the margin as needed */
            font-size: 24px; /* Adjust the font size as needed */
        }

        #container {
            display: flex;
        }
        .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

/* Style the modal content */
.modal-content {
    background-color: #fff;
    padding: 20px;
    width: 500px;
    margin: 15% auto;
    border: 1px solid #333;
    border-radius: 5px;
    position: relative;
}

/* Style the close button */
.close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 5px 10px;
    cursor: pointer;
}

.close:hover {
    color: #f00;
}

        #menu {
            background-color: #eee;
            width: 20%;
            padding: 20px;
        }

        #content {
            width: 80%;
            padding: 20px;
        }

        #footer1 {
            clear: both;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        /* Style links in the menu */
        #menu ul {
            list-style-type: none;
            padding: 0;
        }

        #menu li {
            margin-bottom: 10px;
        }

        #menu a {
            display: block;
            padding: 20px;

            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        h2
        {
            
            margin:0 auto;
            font-size: 30px;
            text-align: center;
            
        }
        #menu a:hover {
            background-color: #007bff;
            color: #fff;
            border-radius:10px;
        }

        /* Hide the dashboard by default */
        #dashboard {
            display: none;

        }
        

        
    </style>
    <script src="preventBack.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
<?php
// Start the session to access session variables
require('C:\xampp\htdocs\NCC_MAIN\NCC_LOGIN\dbcon.php');
session_start();
// Check if the 'uname' session variable exists
if (isset($_SESSION['uname'])) {
    $username = $_SESSION['uname'];
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT stu_name,pno FROM enroll WHERE regimental_number = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Output data of the student
        while ($row = $result->fetch_assoc()) {
            $studentName = $row['stu_name'];
            $mno=$row['pno'];
        }
    } else {
        echo "Student not found.";
    }

    // Close the result set
    $result->close();
    
    // Close the database connection
    $conn->close();
}
 else
    echo "log out";


    if (isset($_POST['update_password'])) {
        // Handle password update here
        $newPassword = $_POST['new_password'];
        $confirmNewPassword = $_POST['confirm_new_password'];
        if ($newPassword === $confirmNewPassword) {
           
    
            // Check for a successful connection
            if ($conn->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
    
            // Update the password in the database
            $updateQuery = "UPDATE logins SET passwords = '$newPassword' WHERE username = '$username'";
            if ($conn->query($updateQuery) === TRUE) {
                echo "Password updated successfully.";
            } else {
                echo "Error updating password: " . $connection->error;
            }
    
            // Close the database connection
            $conn->close();
        } else {
            echo "New password and confirmation do not match.";
        }
    }
?>
 <div class="accolades" style=" width: 100%;
    height: 70px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;">
        <div class="inner-accolades"  style=" width: 1300px;
    height: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: white;">
          <img
            class="vignan-logo" style="width: 250px;
    height: 100%;"
            src="https://vignan.ac.in/images/LOGO_change.jpg"
            alt=""
          />
          <div class="vignan-name" style=" font-size: 20px;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: 500;
    color: #4d4d4d;">
            <div>विज्ञान शास्त्र प्रौद्योगिकी और परिशोधन संगठन</div>
            <div>విజ్ఞాన శాస్త్ర సాంకేతిక పరిశోధనా సంస్థ</div>
          </div>
          <img
            class="vignan-accolades" style="width: 310px;
    height: 100%;"
            src="https://vignan.ac.in/images/accloads.png"
            alt=""
          />
        </div>
      </div>
<div id="header">
    
    <img src="ncclogo-removebg-preview.png" style="width=100px;height:80px;margin-left:20px;"></img><br><div  id="ncch"><b style="color:#00aeef; ">राष्ट्रीय कैडेट कोर</b><br>
<b style="margin-left:10px; color:#ffcb06;">National Cadet Corps</b></div>

       <h2 style="margin-left:450px;">CADET</h2>
        <h4 style="right:100px; position:absolute; border-bottom: 2px solid #00AEEF;  border-top: 2px solid #EF1C25;cursor:pointer;padding: 5px;"><a href="\NCC_MAIN\ncc\h.html" style="color:#fff;text-decoration: none;">Home</a></h4>
        <div id="profile-button" onclick="toggleProfileDetails()"><img src="profileicon.jpeg" style="width: 30px; height: 30px;"></img></div>
        <div id="profile-details">
            <p>Name: <?php echo $studentName; ?></p>
            <p>Regimental number <?php echo $username; ?></p>
            <p>Mobile no: <?php echo $mno; ?></p>
            <button id="update-password-button" onclick="showPasswordForm()">Update Password</button>
            <button id="logout-button" onclick="logout()">Logout</button>
        </div>
    </div>
    
    <div id="container">
        <div id="menu">
            <!-- This is where the list will be dynamically generated -->
        </div>

        <div id="dashboard">
            <div id="content">
                <img src="10.jpeg" alt="image" height="500px" width="1000px">
            </div>
        </div>
    </div><br><br>




    <center><h1 style="font-family: 'Times New Roman';"><u>MOTTO of NCC</u></h1></center>

    <div class="motto">
    <h3 style=" text-align: center; margin-left: 150px; margin-right: 150px; font-family: 'Times New Roman'; font-weight: normal; line-height: 1.5;">
        The need for having a motto for the Corps was discussed in the 11th Central Advisory Committee (CAC) meeting held on 11 Aug 1978. 
        The mottos suggested were “Duty and Discipline”; “Duty, Unity and Discipline”; “Duty and Unity”; “Unity and Discipline”. 
        The final decision for the selection of “Unity and Discipline” as the motto for the NCC was taken in the 12th CAC meeting held on 12 Oct 1980.
    </h3>
</div><br>

<center><h1 style="font-family: 'Times New Roman';"><u>Pledge</u></h1></center>
<div class="pledge" style="text-align: center; text-shadow: 4px 4px 8px rgba(128, 128, 128, 0.7);">
<p>WE THE CADETS OF THE NATIONAL CADET CORPS,</p>
<p>DO SOLOEMNLY PLEDGE THAT WE SHALL ALWAYS UPHOLD THE UNITY OF INDIA.</p>
<p>WE RESOLVE TO BE DISCIPLINED AND RESPONSIBLE CITIZEN OF OUR NATION.</p>
<p>WE SHALL UNDERTAKE POSITIVE COMMUNITY SERVICE IN THE SPIRIT OF SELFLESSNESS</p>
<p>AND CONCERN FOR OUR FELLOW BEINGS.</p>
</div>
<br>

<center><h1 style="font-family: 'Times New Roman';"><u>NCC Flag</u></h1></center>
<center><img src="ncc_flag.jpg" style="height:20%;width:20%;"></img></center>
<h3 style="margin-left: 150px; text-align: center;margin-right: 150px; font-family: 'Times New Roman'; font-weight: normal; line-height: 1.5;font-style: inherit;">The NCC flag for various units of the NCC was first introduced in 1951. The flag was of same pattern, colour and size as was used by various regiments of the Army. The only difference was that it had the NCC badge and unit designation placed in the centre. Later on it was felt that the flag should be in keeping with the inter-service character of the Corps. In 1954 the existing tricolour flag was introduced. The three colours in the flag depict the three services of the Corps, red for the Army, deep blue for the Navy and light blue for the Air Force. The letters NCC and the NCC crest in gold in the middle of the flag encircled by a wreath of lotus, give the flag a colourful look and a distinct identity.
</h3>
<br>

<center><h1 style="font-family: 'Times New Roman';"><u>Associate NCC Officers</u></h1></center>
<div class="phone" style="background-color: rgba(253, 252, 252, 0.3);
    border: 2px black;
    border-radius: 10px;
    margin-left: 400px;
    margin-top:40px;
    margin-right:10px;">
  <div class="ph1" style="display: flex;">
  <div><img class ="pj" src="ANO.jpg" style="height:90%;width:70%"></img></div>
 <div class="con" style="font-family: 'Times New Roman';">
  <p>
  Lt Siva Koteswararao Chinnam</p>
<p>Captain</p>
<p>138-B, 25(A) BN NCC, Guntur</p>
<p>Army Wing</p>
<p class="fas fa-envelope" style="display:inline;"></p>
vfstrncc@gmail.com
</div>
</div>
</div>
<br>
<br>


  <!-- Footer Container -->
  <div class="footer" style="display: flex; flex-direction: column; align-items: center; padding: 10px;background-color: #b2cfef;height: 250px;">
    <center><img style="height: 110px;width: 120px;margin-top: -20px;" src="/NCC_MAIN/ncc/vignan logo square.png"></img></center>
    <!-- Social Links -->
    <div class="social-links mt-3" style="text-align: center;">
      <a href="#" class="facebook"   style="background-color: #1877f2; color: #fff; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; margin: 10px; transition: transform 0.2s; text-decoration:none;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
        <i class="fab fa-facebook" style="font-size: 20px;"></i>
      </a>
      <a href="#" class="whatsapp"  style="background-color: #25d366; color: #fff; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; margin: 10px; transition: transform 0.2s; text-decoration:none;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
        <i class="fab fa-whatsapp" style="font-size: 20px;"></i>
      </a>
      <a href="#" class="instagram" style="background-color: #e4405f; color: #fff; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; margin: 10px; transition: transform 0.2s; text-decoration: none;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
  <i class="fab fa-instagram" style="font-size: 20px;"></i>
</a>
<a href="#" class="twitter" style="background-color: #1da1f2; color: #fff; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; margin: 10px; transition: transform 0.2s; text-decoration: none;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
  <i class="fab fa-twitter" style="font-size: 20px;"></i>
</a>
<a href="#" class="linkedin" style="background-color: #0077b5; color: #fff; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; margin: 10px; transition: transform 0.2s; text-decoration: none;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
  <i class="fab fa-linkedin" style="font-size: 20px;"></i>
</a>

    </div>
    <p style="text-align: center; margin: 10px; ">
      Vignan's Foundation for Science, Technology and Research (Deemed to be University), Vadlamudi, Guntur-522213
    </p>
    <!-- Additional Contact Info -->
    <div class="contact-info mt-3" style="text-align: center;">
      <div class="email" style="color: #fff; padding: 2px; border-radius: 10px; margin: 5px;">
        <i class="fas fa-envelope" style="font-size: 20px; "></i> Email: admissions@vignan.ac.in
      </div>
      <div class="email" style="color: #fff; padding: 2px; border-radius: 10px; margin: 5px;">
        <i class="fas fa-phone" style="font-size: 20px;"></i> Phone: 7799 427 427
      </div>
    </div>
  </div>
</div>


<div id="footer1" style="background-color: #2D3092;height:30px;padding-top: 10px;">
       <center> &copy; Copyright VFSTR . All Rights Reserved</center>
    </div>



 

  
    
          
    <script>
            var menu = document.getElementById('menu');
            var dashboard = document.getElementById('dashboard');
                dashboard.style.display = 'block';
                menu.innerHTML = '<ul style="list-style-type:none;">' +'<li style="cursor:pointer;"><h2>Dashboard</h2></li>'+
                '<li style="display: flex; align-items: center;"><i class="fas fa-calendar-alt" style="margin-right: 10px;"></i><a href="#camp" onclick="showContent(\'SCHEDULE\')">VIEW SCHEDULE</a></li>' +
                '<li style="display: flex; align-items: center;"><i class="fas fa-calendar" style="margin-right: 10px;"></i><a href="#events" onclick="showContent(\'EVENTS\')">VIEW EVENTS</a></li>' +
                '<li style="display: flex; align-items: center;"><i class="fas fa-campground" style="margin-right: 10px;"></i><a href="#camps" onclick="showContent(\'CAMPS\')">VIEW CAMPS</a></li>' +
                '<li style="display: flex; align-items: center;"><i class="fas fa-check-circle" style="margin-right: 10px;"></i><a href="#camps" onclick="showContent(\'R1CAMPS\')">REGISTERED CAMPS</a></li>' +

                '<li style="display: flex; align-items: center;"><i class="fas fa-comments" style="margin-right: 10px;"></i><a href="#feedback" onclick="showContent(\'FEEDBACK\')"> FEEDBACK</a></li>' +

                '<li style="display: flex; align-items: center;"><i class="fas fa-question-circle" style="margin-right: 10px;"></i><a href="#queries" onclick="showContent(\'QUERIES\')"> QUERIES</a></li>' +

    '</ul>';
    
        // JavaScript function to show content for the selected link
        function showContent(content) {
    var contentDiv = document.getElementById('content');
    if (content === 'EVENTS') {
        contentDiv.innerHTML = '<iframe src="view_events3.php" width="1000px" height="500px"></iframe>';
    } 
    else if(content === 'CAMPS')
    {
        contentDiv.innerHTML= '<iframe src="view_camps2.php" width="1000px" height="500px"></iframe>';
    }
    else if(content === 'SCHEDULE')
    {
        contentDiv.innerHTML= '<iframe src="viewschedule.php" width="1000px" height="500px"></iframe>';
    }
    else if(content === 'FEEDBACK')
    {
        contentDiv.innerHTML= '<iframe src="feedback.html" width="1000px" height="500px"></iframe>';
    }
    else if(content === 'R1CAMPS')
    {
        contentDiv.innerHTML= '<iframe src="regcamps.php" width="1000px" height="500px"></iframe>';
    }
    else {
        contentDiv.innerHTML = '<h2>' + content + '</h2>' +
            '<p>This is the content for ' + content + '</p>';
    }
}
function toggleProfileDetails() {
            var profileDetails = document.getElementById('profile-details');
            if (profileDetails.style.display === 'block') {
                profileDetails.style.display = 'none';
            } else {
                profileDetails.style.display = 'block';
            }
        }

    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        $('.editable').on('blur', function () {
            var newValue = $(this).text();
            var columnName = $(this).data('column');
    
            // Send an AJAX request to update the value in the database
            $.ajax({
                url: 'update_database.php',
                method: 'POST',
                data: {
                    column: columnName,
                    newValue: newValue,
                    // Add any other data you need to identify the record
                },
                success: function (response) {
                    // Handle the response from the server if needed
                }
            });
        });
    });

    function logout() {
    // Send an AJAX request to the server to log out the user
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/NCC_MAIN/NCC_LOGIN/logout.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Display the "Logout successful" alert
            alert("Logout successful");
            // Redirect to the login page if needed
            window.location.href ="/NCC_MAIN/NCC_LOGIN/loginmain.php"; // Replace with your actual login page URL
           
        }
    };
    xhr.send();

  
}
document.getElementById("update-password-button").addEventListener("click", function() {
    showPasswordForm();
});

// Function to display the password form dialog
function showPasswordForm() {
    var modal = document.getElementById("password-form");
    modal.style.display = "block";
}

// Function to close the password form dialog
function closePasswordForm() {
    var modal = document.getElementById("password-form");
    modal.style.display = "none";
}


   var tabRadios = document.querySelectorAll(".tab-radio");
        var tabContents = document.querySelectorAll(".content");
       

        tabRadios.forEach(function(tabRadio, index) {
            tabRadio.addEventListener("change", function () {
                tabContents.forEach(function(content, contentIndex) {
                    if (contentIndex === index) {
                        content.style.maxHeight = "100vh";
                        
                        
                    } else {
                        content.style.maxHeight = "0px";
                       
                    }
                });
            });
        });

    </script>
    <script src="preventBack.js"></script>
  

</body>

</html>