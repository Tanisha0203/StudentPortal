<?php
include 'index.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crse = $_POST['course'];
    $ssion = $_POST['session'];
    $sem = $_POST['semester'];
    $semmonth = $_POST['semestermonth'];
    $credit = $_POST['validcredit'];
    $descript = $_POST['description'];

    $q = "INSERT INTO semester(course, session, semester, semestermonth, credit, description)
          VALUES ('$crse', '$ssion', '$sem', '$semmonth', '$credit', '$descript')";

    $result = mysqli_query($con, $q);

    if ($result) {
        echo '<script>alert("Register Successfully")</script>';
        // header('location:index.php');
    } else {
        echo 'Operation failed: ' . mysqli_error($con);
        // header('location:http://localhost/Blood/Adminmain.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
    var courseObject = {
        "B.Tech": {
            "2021-2025": ["1st sem", "2nd sem", "3rd sem", "4th sem", "5th sem", "6th sem", "7th sem", "8th sem"],
            "2022-2026": ["1st sem", "2nd sem", "3rd sem", "4th sem", "5th sem", "6th sem", "7th sem", "8th sem"],
            "2023-2027": ["1st sem", "2nd sem", "3rd sem", "4th sem", "5th sem", "6th sem", "7th sem", "8th sem"]
        },
        "M.Tech": {
            "2021-2023": ["1st sem", "2nd sem", "3rd sem", "4th sem"],
            "2022-2024": ["1st sem", "2nd sem", "3rd sem", "4th sem"],
            "2023-2025": ["1st sem", "2nd sem", "3rd sem", "4th sem"]
        },
        "B.Com": {
            "2021-2024": ["1st sem", "2nd sem", "3rd sem", "4th sem", "5th sem", "6th sem"],
            "2022-2025": ["1st sem", "2nd sem", "3rd sem", "4th sem", "5th sem", "6th sem"],
            "2023-2026": ["1st sem", "2nd sem", "3rd sem", "4th sem", "5th sem", "6th sem"]
        },
        "Pharmacy": {
            "2021-2025": ["1st sem", "2nd sem", "3rd sem", "4th sem", "5th sem", "6th sem", "7th sem", "8th sem"],
            "2022-2026": ["1st sem", "2nd sem", "3rd sem", "4th sem", "5th sem", "6th sem", "7th sem", "8th sem"],
            "2023-2027": ["1st sem", "2nd sem", "3rd sem", "4th sem", "5th sem", "6th sem", "7th sem", "8th sem"]
        }
    };
    window.onload = function() {
        var courseSel = document.getElementById("course");
        var sessionSel = document.getElementById("session");
        var semesterSel = document.getElementById("semester");
        for (var x in courseObject) {
            courseSel.options[courseSel.options.length] = new Option(x, x);
        }
        courseSel.onchange = function() {
            semesterSel.length = 1;
            sessionSel.length = 1;
            for (var y in courseObject[this.value]) {
                sessionSel.options[sessionSel.options.length] = new Option(y, y);
            }
        }
        sessionSel.onchange = function() {
            semesterSel.length = 1;
            var z = courseObject[courseSel.value][this.value];
            for (var i = 0; i < z.length; i++) {
                semesterSel.options[semesterSel.options.length] = new Option(z[i], z[i]);
            }
        }
    }
    </script>
    <link rel="stylesheet" href="addsemester.css">
</head>
<body>
    <div class="container">
        <h1>Add Semester</h1>
        <form method="post">
            <table class="semester" id="sem">
                <tr>
                    <td>Course:
                        <select class="crse" id="course" name="course">
                            <option>Select Course</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Session:
                        <select class="sess" id="session" name="session">
                            <option>Select Session</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Semester:
                        <select class="sem" id="semester" name="semester">
                            <option>Select Semester</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Semester Month:
                        <input class="semmonth" id="semestermonth" name="semestermonth" type="text">
                    </td>
                </tr>
                <tr>
                    <td>Valid Credit:
                        <input class="credit" id="validcredit" name="validcredit" type="text">
                    </td>
                </tr>
                <tr>
                    <td>Description:
                        <input class="descrip" id="description" name="description" type="text">
                    </td>
                </tr>
            </table>
            <div class="button">
                <input type="submit" name="submit" value="Submit" class="sub">
                <input type="reset" name="reset" value="Reset" class="rest">
                <input type="button" name="cancel" value="Cancel" class="cncl">
            </div>
        </form>
    </div>
</body>
</html>
