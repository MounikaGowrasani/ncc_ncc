<?php
require 'dbcon.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    // Check if it's the 1st day of the month
    $username = $_SESSION['uname'];
    if (date('j') == 1 or date('j')== 15 ) {
        
        $feedback = $_POST["feedback"];
        $rating = $_POST["rating"];
        $feedbackdate = date('Y-m-d');
        // Insert the data into the database
        $sql = "INSERT INTO feedback (regno, feedback, rating, feedbackdate) VALUES ('$username', '$feedback', '$rating', '$feedbackdate')";
        if ($conn->query($sql) === TRUE) {
            echo "Feedback submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // It's not the 1st day of the month, display an alert
        echo '<script>alert("Feedback can only be submitted on the 1st & 15th of each month.");</script>';
        echo '<script>window.location.href = "feedback.html";</script>';
    }
}

// Close the database connection
$conn->close();
?>




