<?php
include "partials/_dbconnect.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $coursename=$_GET['course'];
    $semesterselected=$_GET['semester'];
    $section=$_POST['section'];

    header("location:view_timetable.php?course=$coursename&semester=$semesterselected&section=$section");

}  
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Timetable : Choose Section</title>
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
        
        
    <h2 class="container text-center"><u>View Timetable</u></h2>
        <h5 class="container text-center">Choose section : </h5>
        <?php
        echo '<form action="' . htmlspecialchars($_SERVER["REQUEST_URI"]) . '" method="post">';
        $coursename=$_GET['course'];
        $semesterselected=$_GET['semester'];
        
        session_start();

        $university_code=$_SESSION['universitycode'];

        $sql="SELECT * FROM `section_list` WHERE Course='$coursename' AND  University_code='$university_code' AND Semester='$semesterselected'";
        
        $result=mysqli_query($conn,$sql);

        $rowaffected=mysqli_num_rows($result);
        while($row=mysqli_fetch_assoc($result)){
            $section=$row["Section"];
            echo '<div class="mb-1"><input type="radio" id="section" name="section" value="'.$section.'">
            <label for="section"> Section - '.$section.'</label><br></div>';
        }
        ?>
        <div class="mt-4">

<button type="submit" class="btn btn-primary">View Timetable</button>
<a href="adminportal.php" class="btn btn-primary">Back to Home </a>

</div>
          </form>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
</html>