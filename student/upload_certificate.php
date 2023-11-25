<!DOCTYPE html>
<html>
<head>
    <title>Upload Certificate</title>
</head>
<body>

<h2>Upload Certificate</h2>

<?php
// Check if registerid is provided in the URL
if (isset($_GET['registerid'])) {
    $registerid = $_GET['registerid'];
    echo "<form action='final_upload.php' method='post' enctype='multipart/form-data'>";
    echo "<input type='hidden' name='registerid' value='$registerid'>";
    echo "Select Certificate (jpg,jpeg,png only): <input type='file' name='certificateFile' accept='image/png, image/gif, image/jpeg' required><br>";
    echo "<input type='submit' value='Upload Certificate'>";
    echo "</form>";
} else {
    echo "Invalid request. Please make sure you provide a valid registerid.";
}
?>

</body>
</html>