<?php

include "partials/_dbconnect.php";
session_start();



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $course=$_GET["course"];
    $semester=$_GET["semester"];
    $section=$_GET['section'];
    $day=$_GET["day"];
    $time=$_GET["time"];
    $subject=$_GET["subject"];
    $classroom=$_POST["classroom"];
    $faculty=$_POST["faculty"];
    $university_code=$_SESSION['universitycode'];



    //ab 3 query run hogi 
    // classroomm and faculty status updat
    // and then section schedule update

    $sql="UPDATE `sections_schedule` SET `Subject` = '$subject', `Classroom` = '$classroom', `Faculty` = '$faculty' WHERE `sections_schedule`.`Course` = '$course' AND `Semester`='$semester' AND `Section`='$section' AND `Day`='$day'AND `Time`='$time' AND `University_code`='$university_code' ";

    $result=mysqli_query($conn,$sql);


    $crsql="UPDATE `classrooms_schedule` SET `Available` = 'No' WHERE `classrooms_schedule`. `Classroom_name`='$classroom' AND `Day`='$day'AND `Time`='$time' AND `University_code`='$university_code'";

    $crresult=mysqli_query($conn,$crsql);

    $fsql="UPDATE `faculty_schedule` SET `Available` = 'No' WHERE `faculty_schedule`. `Name`='$faculty' AND `Day`='$day'AND `Time`='$time' AND `University_code`='$university_code'";

    $fresult=mysqli_query($conn,$fsql);

    if($result && $crresult && $fresult)    echo "scheduled";
    else    echo "problem";
}



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Schedule Timetable : Choose Faculty and Classroom</title>
    <link rel="stylesheet" href="adminsignin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    echo '<div class="container w-50 maincontainer">
    
    <h2 class="container text-center"><u>SCHEDULING A CLASS</u></h2>
    <h5 class="container text-center">Choose Faculty and Classroom  : </h5>   
        <form action="' . htmlspecialchars($_SERVER["REQUEST_URI"]) . '" method="post">';
        $subject=$_GET['subject'];
        $day=$_GET['day'];
        $time=$_GET['time'];
        $university_code=$_SESSION['universitycode'];
        $sql="SELECT * FROM `faculty_schedule` WHERE University_code='$university_code' AND Subject='$subject' AND Day='$day' AND Time='$time' AND Available='Yes'";
        $result=mysqli_query($conn,$sql);
        $classroomsql="SELECT * FROM `classrooms_schedule` WHERE University_code='$university_code' AND Day='$day' AND Time='$time' AND Available='Yes'";
        $classroomresult=mysqli_query($conn,$classroomsql);

        echo '<label for="day">Choose a faculty:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <select class="w-75 text-center" id="faculty" name="faculty">';
        while($row=mysqli_fetch_assoc($result)){
            echo '<option value="'.$row["Name"].'" name="faculty" >'.$row["Name"].'</option>';
        }

        echo '</select><br><br>';

        echo '<label for="classroom">Choose a classroom:</label>
        <select class="w-75 text-center" id="classroom" name="classroom">';

        while($row=mysqli_fetch_assoc($classroomresult)){
            echo '<option value="'.$row["Classroom_name"].'" name="classroom" >'.$row["Classroom_name"].'</option>';
        }

        echo '</select><br><div class="mt-4"><button type="submit" class="btn btn-primary">Schedule This Class </button><a href="adminportal.php" class="btn btn-primary">Back to Home </a></div>
          </form>
    </div>';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>