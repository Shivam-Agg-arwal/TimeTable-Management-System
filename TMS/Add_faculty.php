<?php
include "partials/_dbconnect.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $facultyname=$_POST["facultyname"];
  $subject=$_POST["subject"];
  //agar pehle se pda h toh mat dalna 

    session_start();

    $un=$_SESSION['universityname'];
    $university_code=$_SESSION['universitycode'];
    $sql="SELECT * FROM `adminlogins` WHERE University_code = '$university_code'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $start_time=$row["College_Start_Time"];
    $hoursoperates=$row["Hours"];
    $hr = substr($start_time, 0, 2);
    $lefttime=substr($start_time,2);
    $integer_hr = intval($hr);

    $days=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
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
    $allqueryexecuted=true;

    foreach($days as $d){
        foreach($timeslots as $t){
            $timesql="INSERT INTO `faculty_schedule` (`S.No`, `Name`, `Subject`, `Day`, `Time`, `Available`,`University_code`) VALUES (NULL, '$facultyname', '$subject', '$d', '$t', 'Yes','$university_code')";
            $timeresult=mysqli_query($conn,$timesql);
            $allqueryexecuted=$allqueryexecuted && $timeresult;
        }
    }
    
    $sql="INSERT INTO `faculty_list` (`S.No`, `Faculty_name`, `Subject`,`University_code`) VALUES (NULL, '$facultyname', '$subject','$university_code')";
    $result=mysqli_query($conn,$sql);

    $allqueryexecuted=$allqueryexecuted && $result;

    if($allqueryexecuted){
        echo "Faculty added";
    }
    else{
        echo "problem";
    }



}  
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Faculty</title>
    <style>
        body {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        }
        .maincontainer {
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }
        form {
            padding: 5%;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container w-50 maincontainer">
        <h2 class="container text-center"><u>ADD A FACULTY</u></h2>
        <form action="Add_faculty.php" method="post">
            <div class="mb-1">
                <input type="text" class="form-control" id="facultyname" name="facultyname"
                    aria-describedby="emailHelp" placeholder="FACULTY NAME" required>
            </div>
            <div class="mb-4">
                <label for="semestercount" class="form-label"></label>
                <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp"
                    placeholder="SUBJECT TAUGHT" required>
            </div>

            <div class="mt-4">

            <button type="submit" class="btn btn-primary">Add Faculty</button>
            <a href="adminportal.php" class="btn btn-primary">Back to Home </a>

        </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
</html>