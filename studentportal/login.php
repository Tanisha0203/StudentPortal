<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scholarNumber = $_POST['scholarnumber'];
    $password = $_POST['pswd'];

    $q = "SELECT * FROM registerat WHERE Scholarnumber = '$scholarNumber' AND psw = '$password'";
    $result = mysqli_query($con, $q);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION['scholarnumber'] = $row['Scholarnumber'];
        header('Location: dashboard.php');
        exit;
    } else {
        echo "<script>alert('Wrong Scholarnumber or password');</script>";
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="loginbox">
        <h2>Login Form</h2>
        <form action="" method="post">
            <div class="imgcontainer">
                <img src="image/logo.jpg" alt="logo" class="logo">
            </div>
            <div class="container">
                <label for="scholarnumber"><b>Scholar Number</b></label>
                <input type="text" placeholder="Enter Scholar Number" name="scholarnumber" required>

                <label for="pswd"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pswd" required>

                <button type="submit">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
                <span class="psw"><a href="index.php">Forgot password?</a></span>
            </div>
        </form>
    </div>
</body>
</html>
