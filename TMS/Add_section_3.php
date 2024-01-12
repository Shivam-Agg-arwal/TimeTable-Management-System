<?php
include "partials/_dbconnect.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $coursename=$_GET['course'];
    $semesterselected=$_GET['semester'];
    $sectiontoadd=$_POST['section'];


    //so we have to extract college start time and the no. of hours it operates and then we put it on monday to saturday in section with time range 
    //add section to section count
    //update in section list as well

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
            $timesql="INSERT INTO `sections_schedule` (`S.No`, `Course`, `Semester`, `Section`, `Day`, `Time`, `Subject`, `Classroom`, `Faculty`,`University_code`) VALUES (NULL, '$coursename', '$semesterselected', '$sectiontoadd', '$d', '$t', 'Free', 'Free', 'Free','$university_code')";
            $timeresult=mysqli_query($conn,$timesql);
            $allqueryexecuted=$allqueryexecuted && $timeresult;
        }
    }

    $sqlq="INSERT INTO `section_list` (`S.No`, `Course`, `Semester`, `Section`,`University_code`) VALUES (NULL, '$coursename', '$semesterselected', '$sectiontoadd','$university_code')";
    $qresult=mysqli_query($conn,$sqlq);
    $allqueryexecuted=$allqueryexecuted && $qresult;



    if($result) echo "added successfully";
    else echo "something not ";
    
}  
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Section: Name Section</title>
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
            padding: 5% 5% 1% 5%;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container w-50 maincontainer">
    <h2 class="container text-center"><u>ADD A SECTION</u></h2>
        <h5 class="container text-center">Name section : </h5>

        <?php
        echo '<form action="' . htmlspecialchars($_SERVER["REQUEST_URI"]) . '" method="post">';

        $semesterselected=$_GET['semester'];

        echo '<div class="mb-1"><input class="w-100" type="text" id="section" name="section" placeholder="Enter the section to add" required><br></div>';
        ?>

    <div class="mt-4 text-center">

    <button type="submit" class="btn btn-primary">Proceed</button>
    <a href="adminportal.php" class="btn btn-primary">Back to Home </a>

    </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
</html>