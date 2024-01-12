<?php

session_start();
if(isset($_SESSION["studentloggedin"]) && ($_SESSION["studentloggedin"]==true)){
    echo "good";
}
else{
    echo "return ";
    header("location:/TMS/loginpage.php");
}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student : <?php echo $_SESSION['studentid']; ?></title>
    <link rel="stylesheet" href="studentportal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body><?php
//   extract name and put on portal

        include "partials/_dbconnect.php";
        $unc=$_SESSION['universitycode'];
        $studentid=$_SESSION['studentid'];
        $sql="SELECT * FROM `students` WHERE University_code='$unc' AND Student_id='$studentid'";
        $result=mysqli_query($conn,$sql);
        $rowaffected=mysqli_num_rows($result);

        if($rowaffected==1){
            while($row=mysqli_fetch_assoc($result)){
                $universityname=$row['University'];
                $email=$row['Email_id'];
                $phone=$row['Phone_number'];
                $studentname=$row['Name'];
                $course=$row['Course'];
                $section=$row["Section"];
                $semester=$row["Semester"];
                $enrollmentno=$row["Enrollment_no"];
            }
        }
        else{
            echo "Technical error go to logout";
            header("location:logout.php");
        }
    echo '<div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="https://source.unsplash.com/2400x1680/?STUDENT" alt="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <br><br>
                        <h5 >'.$studentname.'</h5>
                        <h6 >Student</h6>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <p class="nav-link active">About</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="logout.php" class="btn btn-primary logbutton">LOGOUT</a>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p>WORK LINK</p>
                        <a href="view_timetable.php">TimeTable</a><br />
                        <br>
                        <a href="studentnoticelist.php">Notices</a><br />
                        <br>
                        <a href="changepassword.php">Change Password</a><br />
                        <br>
                        <a href="">About</a><br />
                        <br>
                        <a href="">Query Raise</a><br />


                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$studentname.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Student ID</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$studentid.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Enrollment Number</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$enrollmentno.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone Number</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$phone.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email ID</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$email.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Course</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$course.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Semester</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$semester.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Section</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$section.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>University</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$universityname.'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>