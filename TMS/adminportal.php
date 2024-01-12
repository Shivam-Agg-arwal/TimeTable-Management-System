<?php

    session_start();
    if(isset($_SESSION["adminloggedin"]) && ($_SESSION["adminloggedin"]==true)){
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
    <title>ADMIN : <?php echo $_SESSION['universityname']; ?></title>
    <link rel="stylesheet" href="adminportal.css">
    <style>
        .logbutton{
            width: 50%;
            /* border: none; */
            border-radius: 50px;
            background: rgba(87,184,70,255);
            font-family: 'Poppins',sans-serif;
            margin-top:20px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body><?php
//   extract name and put on portal

        include "partials/_dbconnect.php";
        $un=$_SESSION['universityname'];
        $unc=$_SESSION['universitycode'];

        $sql="SELECT * FROM `adminlogins` WHERE University_code = '$unc'";
        $result=mysqli_query($conn,$sql);
        $rowaffected=mysqli_num_rows($result);
        $universityname="";
        $email="";
        $phone="";
        $state="";
        $country="";

        if($rowaffected==1){
            while($row=mysqli_fetch_assoc($result)){
                $universityname=$row['University_name'];
                $email=$row['Email_id'];
                $phone=$row['Phone_number'];
                $state=$row['State'];
                $country=$row['Country'];
                $adminname=$row["Admin_name"];
                $studentcount=$row["Students_count"];
                $facultycount=$row["Faculty_count"];
                $classrooms=$row["Classrooms_count"];
                $coursecount=$row["Course_count"];
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
                        <h5>'.$universityname.'</h5>
                        <h6>Admin</h6>
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
                        <p>ADD/REMOVE</p>
                        <a href="Add_course.php">Course</a><br />
                        <a href="Add_section_1.php">Section</a><br />
                        <a href="Add_student_1.php">Student</a><br />
                        <a href="Add_faculty.php">Faculty</a><br />
                        <a href="Add_classroom.php">Classroom</a><br />
                        <p>WORKS</p>
                        <a href="schedule_timetable_1.php">Schedule Timetable</a><br />
                        <a href="choosecourse.php">View Timetable</a><br />
                        <a href="sendnotice.php">Send Notice</a><br />
                        
                        <a href="">Check Classroom Status</a><br />
                        <a href="">Check Faculty Status</a><br />


                        <br>


                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>University Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$universityname.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>State</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$state.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Country</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$country.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Admin Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$adminname.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$email.'</p>
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
                                    <label>Students Added </label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$studentcount.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Faculty Added</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$facultycount.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Classrooms Added</label>
                                </div>
                                <div class="col-md-6">
                                    <p>'.$classrooms.'</p>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <label>Courses Added</label>
                            </div>
                            <div class="col-md-6">
                                <p>'.$coursecount.'</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>