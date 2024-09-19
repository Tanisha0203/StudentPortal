<?php
error_reporting(0);
include 'dbconfig.php'; // Include the database configuration file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs (you can add more validation as needed)
    $scholarnumber = mysqli_real_escape_string($conn, $_POST['scholarnumber']);
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $mname = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $faname = mysqli_real_escape_string($conn, $_POST['fathername']);
    $moname = mysqli_real_escape_string($conn, $_POST['mothername']);
    $dob = mysqli_real_escape_string($conn, $_POST['dateofbirth']);
    $emailid = mysqli_real_escape_string($conn, $_POST['email']);
    $pswd = mysqli_real_escape_string($conn, $_POST['psw']);
    $phoneno = mysqli_real_escape_string($conn, $_POST['phone']);
    $whatno = mysqli_real_escape_string($conn, $_POST['whatsapp']);
    $gend = mysqli_real_escape_string($conn, $_POST['gender']);
    $cat = mysqli_real_escape_string($conn, $_POST['category']);
    $aadharno = mysqli_real_escape_string($conn, $_POST['aadhar']);
    $states = mysqli_real_escape_string($conn, $_POST['state']);
    $cities = mysqli_real_escape_string($conn, $_POST['city']);
    $pincd = mysqli_real_escape_string($conn, $_POST['pincode']);
    $add = mysqli_real_escape_string($conn, $_POST['address']);

    // File upload handling
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "image/" . $filename;
    move_uploaded_file($tempname, $folder);

    // Insert into database
    $sql = "INSERT INTO registerat (Scholarnumber, image, firstname, middlename, lastname, fathername, mothername, dob, email, psw, pnum, wnum, gender, category, aadhar, state, city, pincode, address) 
            VALUES ('$scholarnumber', '$folder', '$fname', '$mname', '$lname', '$faname', '$moname', '$dob', '$emailid', '$pswd', '$phoneno', '$whatno', '$gend', '$cat', '$aadharno', '$states', '$cities', '$pincd', '$add')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Registered Successfully Now you can login ")</script>';
        header('location: login.php'); // Redirect after successful registration
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
