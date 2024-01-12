<?php
include "partials/_dbconnect.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $course=$_POST["coursename"];
  $semestercount=$_POST["semestercount"];
  session_start();

  $universtiy_code=$_SESSION['universitycode'];
  //agar pehle se pda h toh mat dalna 

    $sql="INSERT INTO `courses` (`S.No`, `Course_name`, `Semester_in_course`,`University_code`) VALUES (NULL, '$course', '$semestercount','$universtiy_code')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "Course Added";
    }
    else{
        echo "unable to add the course ";
    }
}  
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Course</title>
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
        <h3 class="container text-center">ADD A COURSE</h3>
        <form action="Add_course.php" method="post">
            <div class="mb-1">
                <label for="coursename" class="form-label"></label>
                <input type="text" class="form-control" id="coursename" name="coursename"
                    aria-describedby="emailHelp" placeholder="COURSE NAME" required>
            </div>
            <div class="mb-4">
                <label for="semestercount" class="form-label"></label>
                <input type="text" class="form-control" id="semestercount" name="semestercount" aria-describedby="emailHelp"
                    placeholder="NUMBER OF SEMESTERS IN COURSE" required>
            </div>

            <button type="submit" class="btn btn-primary">Add a course</button>

            <a href="adminportal.php" class="btn btn-primary">Home</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
</html>