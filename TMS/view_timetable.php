<?php
include "partials/_dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["Date"];
    $subject = $_POST["Subject"];
    $mainnotice = $_POST["mainnotice"];

    session_start();
    $university_code = $_SESSION['universitycode'];

    // Use prepared statement to avoid SQL injection
    $sql = "INSERT INTO `notices` (`Subject`, `Notice`, `Date`, `University_code`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $subject, $mainnotice, $date, $university_code);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Notice sent";
        } else {
            echo "Unable to send the notice: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the statement: " . mysqli_error($conn);
    }
    
    // Close the connection
    mysqli_close($conn);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TimeTable</title>
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
    <?php
    session_start();


    if(isset($_GET['course'])){

    $course=$_GET['course'];
    $section=$_GET['section'];
    $semester=$_GET['semester'];
    }
    else{
        $studentid=$_SESSION['studentid'];

        $sql="SELECT * FROM `students` WHERE Student_id='$studentid'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $course=$row['Course'];
        $section=$row['Section'];
        $semester=$row['Semester'];

    }

    echo '<div class="container w-75 maincontainer">
        <h2 class="container text-center"><u>SECTION '.$section.' [ '.$course.' - '.$semester.' ]</u></h2><br>

        <table border="2" width="100%" cellpadding="10" cellspacing="0" bordercolor="#000000" >
                    <tr bgcolor="#EBEBEB">    
                        <td align="center"><B>TIMING</B></td>
                        <td align="center"><B>MONDAY </B></td>
                        <td align="center"><B>TUESDAY</B></td>
                        <td align="center"><B>WEDNESDAY</B></td>
                        <td align="center"><B>THURSDAY</B></td>
                        <td align="center"><B>FRIDAY</B></td>
                        <td align="center"><B>SATURDAY</B></td>
                    </tr>';

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
                foreach($timeslots as $t){
                    echo '<tr>    
                    <td align="center" bgcolor="#EBEBEB"><B>'.$t.'</B></td>';
                    foreach($days as $d){

                        $sql="SELECT * FROM `sections_schedule` WHERE Course='$course' AND Semester='$semester' AND Section='$section' AND Day='$d' AND Time='$t' AND University_code='$university_code'";
                        $result=mysqli_query($conn,$sql);
                        $row=mysqli_fetch_assoc($result);
                        if($row['Subject']=='Free'){
                            echo '<td align="center">BREAK</td>';
                        }
                        else{
                        echo '<td align="center"><abbr title="Faculty : '.$row['Faculty'].'">'.$row['Subject'].' [Room :'.$row['Classroom'].']</abbr></td>';
                        }
                    }
                    echo '</tr>';
                }
                echo '</table> 
                <div class="mt-4 text-center">';
                if(isset($_GET['course'])){
                    echo '<a href="adminportal.php" class="btn btn-primary">Back to Home </a>';
                }
                else{
                    echo '<a href="studentportal.php" class="btn btn-primary">Back to Home </a>';
                }
echo '</div></div>'; 
        




    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>