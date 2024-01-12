<?php
include "partials/_dbconnect.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $course=$_POST["course_choice"];
  header("location:Add_student_2.php?course=$course");
}  
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
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
        <h2 class="container text-center"><u>ADD A STUDENT</u></h2>
        <h5 class="container text-center">Choose course : </h5>


        <form action="Add_student_1.php" method="post">
        <?php

        session_start();

        $university_code=$_SESSION['universitycode'];

        $sql="SELECT * FROM `courses` WHERE University_code='$university_code' ";
        $result=mysqli_query($conn,$sql);

        $rowaffected=mysqli_num_rows($result);
        while($row=mysqli_fetch_assoc($result)){
            $course_name=$row["Course_name"];
            echo '<div class="mb-1"><input type="radio" id="course_choice" name="course_choice" value="'.$course_name.'" required>
            <label for="course_choice">'.$course_name.'</label><br></div>';
        }
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