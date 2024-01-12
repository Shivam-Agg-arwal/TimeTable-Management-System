<?php

include "partials/_dbconnect.php";
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $course=$_GET["course"];
    $semester=$_GET["semester"];
    $section=$_GET['section'];
    $day=$_POST["day"];
    $time=$_POST["time"];
    $subject=$_POST["subject"];

    header("location:schedule_timetable_5.php?course=$course&semester=$semester&section=$section&day=$day&time=$time&subject=$subject");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Schedule Timetable : Choose Time and Subject</title>
    <link rel="stylesheet" href="adminsignin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    echo '<div class="container w-75 maincontainer">
    <h2 class="container text-center"><u>SCHEDULING A CLASS</u></h2>
    <h5 class="container text-center">Choose Time and Subject : </h5>  
        <form action="' . htmlspecialchars($_SERVER["REQUEST_URI"]) . '" method="post">';
        $coursename=$_GET['course'];
        $semesterselected=$_GET['semester'];
        $section=$_GET['section'];
        $universityname=$_SESSION['universityname'];
        $university_code=$_SESSION['universitycode'];

        
        echo '<label for="day">Choose a Day:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <select class="w-75 text-center" id="day" name="day">
            <option value="Monday" name="day" >Monday</option>
            <option value="Tuesday" name="day">Tuesday</option>
            <option value="Wednesday" name="day">Wednesday</option>
            <option value="Thursday" name="day">Thursday</option>
            <option value="Friday" name="day">Friday</option>
            <option value="Saturday" name="day">Saturday</option>
        </select><br><br>
        <label for="time">Choose a Time:&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <select class="w-75 text-center" id="time" name="time">';
        
        //making time slots

        $university_code=$_SESSION['universitycode'];
        $sql="SELECT * FROM `adminlogins` WHERE University_code = '$university_code'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $start_time=$row["College_Start_Time"];
        $hoursoperates=$row["Hours"];
        $hr = substr($start_time, 0, 2);
        $lefttime=substr($start_time,2);
        $integer_hr = intval($hr);

        $timeslots=array();
        $from_time=$start_time;
        $to_time=$start_time;

        while($hoursoperates>0){
            $hoursoperates--;
            $from_time=$to_time;
            $hr++;
            $string_hr = strval($hr);
            $leng=strlen($string_hr);
            if($leng==1){
                $to_time="0".$string_hr.$lefttime;
            }
            else{
                $to_time=$string_hr.$lefttime;
            }
            
            $timemade=$from_time."-".$to_time;
            array_push($timeslots,$timemade);
        }

        foreach($timeslots as $t){
            echo '<option value="'.$t.'" name="time" >'.$t.'</option>';
        }

        echo '</select>

        <br>
        <br>
        <label for="day">Choose a Subject:</label>
        <select class="w-75 text-center" id="subject" name="subject">';
        $sqlquery="SELECT DISTINCT `Subject` FROM `faculty_list` WHERE University_code='$university_code'";
        $sqlresult=mysqli_query($conn,$sqlquery);

        while($row=mysqli_fetch_assoc($sqlresult)){
            echo '<option value="'.$row['Subject'].'" name="subject" >'.$row['Subject'].'</option>';

        }
        echo '
        </select><br>

        <div class="mt-4">

<button type="submit" class="btn btn-primary">Proceed</button>
<a href="adminportal.php" class="btn btn-primary">Back to Home </a>

</div>
          </form>
    </div>';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>