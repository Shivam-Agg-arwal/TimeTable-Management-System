<?php

include "partials/_dbconnect.php";
session_start();



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $course=$_GET["course"];
    $semester=$_GET["semester"];
    $section=$_GET['section'];
    $universityname=$_SESSION['universityname'];

    $studentname=$_POST["studentname"];
    $phone=$_POST["phone"];
    $emailid=$_POST["emailid"];
    $enrollmentno=$_POST["enrollmentno"];
    $studentid=$_POST["studentid"];

    $password=$_POST["studentid"];
    $university_code=$_SESSION['universitycode'];
    $hash=password_hash($password,PASSWORD_DEFAULT);

    $sql="INSERT INTO `students` (`S.No`, `Student_id`, `Password`, `Enrollment_no`, `Phone_number`, `Email_id`, `Name`, `University`, `Course`, `Semester`, `Section`, `University_code`) VALUES (NULL, '$studentid', '$hash', '$enrollmentno', '$phone', '$emailid', '$studentname', '$universityname', '$course', '$semester', '$section', '$university_code')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "Student added (DEFAULT PASSWORD IS HIS/HER STUDENT ID )";

        echo "give university code to the user ";
        echo "give university code , student id to user";
    }
    else    echo "Not able to sign in ";
}



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student : Information</title>
    <link rel="stylesheet" href="adminsignin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <?php
    echo '<div class="container maincontainer">
        <h2 class="container text-center"><u>ADD STUDENT </u></h2>
        
        
        <form action="' . htmlspecialchars($_SERVER["REQUEST_URI"]) . '" method="post">';
        $coursename=$_GET['course'];
        $semesterselected=$_GET['semester'];
        $section=$_GET['section'];
        $universityname=$_SESSION['universityname'];
        
        echo '<div class="mb-3">
              <label for="universityname" class="form-label">University Name</label>
              <input type="text" class="form-control" id="universityname" name="universityname" placeholder="'.$universityname.'" aria-describedby="emailHelp" disabled>
            </div>
              <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" id="course" name="course "placeholder="'.$coursename.'" aria-describedby="emailHelp" disabled>
              </div>
              <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <input type="text" class="form-control" id="semester" name="semester" placeholder="'.$semesterselected.'" aria-describedby="emailHelp" disabled>
              </div>
              <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" class="form-control" id="section" name="section" placeholder="'.$section.'" aria-describedby="emailHelp" disabled>
              </div>
              <div class="mb-3">
                <label for="studentname" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="studentname" name="studentname" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="emailid" class="form-label">Student emailid </label>
                <input type="email" class="form-control" id="emailid" name="emailid" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Student phone number</label>
                <input type="text"  class="form-control" id="phone" name="phone" aria-describedby="emailHelp" required>
              </div>

              <div class="mb-3">
                <label for="enrollmentno" class="form-label">ENROLLMENT NUMBER </label>
                <input type="text" min="1" max="24" class="form-control" id="enrollmentno" name="enrollmentno" aria-describedby="emailHelp" required>
              </div>

            <div class="mb-3">
              <label for="studentid" class="form-label">STUDENT ID</label>
              <input type="text" class="form-control" id="studentid" name="studentid" required>
            </div><small>STUDENT ID WILL BE THE DEFAULT PASSWORD </small>
            <div class="mt-4">

            <button type="submit" class="btn btn-primary">Add Student</button>
            <a href="adminportal.php" class="btn btn-primary">Back to Home </a>

        </div>
          </form>
    </div>';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>