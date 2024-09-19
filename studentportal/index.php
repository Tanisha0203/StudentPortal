<?php
session_start();
if (!isset($_SESSION['scholarnumber'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="social-media col-12">
        <a href="#facebook"><img src="images/facebook.png" alt=""></a>
        <a href="#instagram"><img src="images/instagram.png" alt=""></a>
        <a href="#linkedin"><img src="images/linkedin.png" alt=""></a>
        <a href="#twitter"><img src="images/twitter.png" alt=""></a>
        <div class="ptag">
            <b>Scholar Number: 
                <br>
                <?php
                include 'dbconfig.php';
                $q1 = "SELECT * FROM registerat WHERE Scholarnumber='" . $_SESSION['scholarnumber'] . "'";
                $result = mysqli_query($con, $q1);
                $row = mysqli_fetch_array($result);
                echo $row['Scholarnumber'];
                mysqli_close($con);
                ?>
            </b>
            <div class="image">
                <img src="images/avatar.jpg" class="pcircle">
                <?php echo $row['firstname'] . ' ' . $row['lastname']; ?>
            </div>
        </div>
    </div>
    <div class="stable">
        <div class="col-2">
            <ul>
                <li><a href="dashboard.php" class="item active">Dashboard</a></li>
                <li><a href="addsession.php" class="item">Add Session</a></li>
                <li><a href="addsemester.php" class="item">Add Semester</a></li>
                <li><a href="addcourse.php" class="item">Add Course</a></li>
                <li><a href="addsubject.php" class="item">Add Subject</a></li>
                <li><a href="login.php" class="logoutbtn">Log Out</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
