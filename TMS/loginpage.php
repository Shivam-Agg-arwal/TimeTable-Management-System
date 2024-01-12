<?php

include "partials/_dbconnect.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){
  $universitycode=$_POST["universitycode"];
  $studentid=$_POST["studentid"];
  $password=$_POST["password"];

  $sql="SELECT * FROM `students` WHERE University_code='$universitycode' AND Student_id='$studentid'";
  $result=mysqli_query($conn,$sql);
  $rowaffected=mysqli_num_rows($result);

  if($rowaffected==1){
    while($row=mysqli_fetch_assoc($result)){
        if(password_verify($password,$row['Password'])){
            session_start();
            $_SESSION['studentloggedin']=true;
            $_SESSION['universitycode']=$row['University_code'];
            $_SESSION['studentid']=$row['Student_id'];

            echo "done";
            header("location:/TMS/studentportal.php?login=true");
            exit();
        }
        else{
            $showerror="wrong password";
            echo $showerror;
        }
    }
  }
  else{
    echo "You have not signed in ";
  }
}
  

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Login    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="loginpage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="welcome container">
        <h2><b>Welcome</b></h2>
        <img class="my-4 logoimage" src="images/student.jpg" width="120px" alt="">
    </div>
    
    <div class="container work">
        Login as Student
    </div>

    <div class="container">
        <form class="mx-auto pt-1" action="loginpage.php" method="post">
            <div class="mb-3">
                    <label for="universitycode" class="form-label"></label>
                    <input type="text" class="form-control" id="universitycode" name="universitycode" aria-describedby="emailHelp"
                        placeholder="University Code">
            </div>
            <div class="mb-3">
                <label for="studentid" class="form-label"></label>
                <input type="text" class="form-control" id="studentid" name="studentid" aria-describedby="emailHelp"
                    placeholder="Student ID">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary logbutton">LOGIN</button>
        </form>
    </div>
    <div class="w-25 container extralogin">
        <p class="asadmin"><a href="adminlogin.php"><b>Login as ADMIN</b></a></p>
        <p class="asadmin"><a href="adminsignin.php"><b>Signup as ADMIN</b></a></p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>