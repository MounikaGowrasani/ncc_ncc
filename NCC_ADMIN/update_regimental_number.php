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

if (isset($_POST['submit'])) {
    $studentId = $_POST['student_id'];
    $newRegimentalNumber = $_POST['new_regimental_number'];

    // Check if the new regimental number already exists in the database
    $checkSql = "SELECT COUNT(*) FROM enroll WHERE regimental_number = ?";
    $stmtCheck = $conn->prepare($checkSql);
    $stmtCheck->bind_param("s", $newRegimentalNumber);
    $stmtCheck->execute();
    $stmtCheck->bind_result($count);
    $stmtCheck->fetch();
    $stmtCheck->close();
    if($newRegimentalNumber=="")
     echo '<script>alert("Regimental number given empty");window.location.href ="regment.php";</script>';
     elseif (strlen($newRegimentalNumber) !== 13) {
        echo '<script>alert("Regimental number must be exactly 13 characters long."); window.history.back();</script>';
    } 
    else if ($count > 0) {
        // The regimental number already exists, display an alert
        echo '<script>alert("Regimental number already exists."); window.history.back(-1);</script>';
    } else {
        // Update the database with the new regimental_number
        $updateSql = "UPDATE enroll SET regimental_number = ?, regimental_number_updated = 1 WHERE Registration_number = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ss", $newRegimentalNumber, $studentId);

        if ($stmt->execute()) {
            $insertSql = "INSERT INTO logins (username, passwords,type) VALUES (?, ?,?)";
    
    // You can generate a random password for the user or set a default one.
    // Here, I'm using 'password123' as a default password for the example.
    //$defaultPassword = password_hash('Vignan@123', PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare($insertSql);
    $defaultPassword='Vignan@123';
    $cadet='cadet';
    $stmt->bind_param("sss", $newRegimentalNumber, $defaultPassword,$cadet);

    if ($stmt->execute()) {
        echo "Regimental number updated and inserted as a username.";
    } else {
        echo "Error inserting the username.";
    }
            // Success: Display a success message and redirect
            echo '<script>alert("Regimental number updated successfully");window.location.href ="regment.php";</script>';
        } else {
            // Error: Display an error message
            echo "Error updating Regimental Number: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
