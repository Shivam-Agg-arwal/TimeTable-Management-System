<?php

include "partials/_dbconnect.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){
  $universityname=$_POST["universityname"];
  $universitycode=$_POST["universitycode"];
  $password=$_POST["password"];

  $univeristyexists="SELECT * FROM `adminlogins` WHERE University_code='$universitycode'";
  $result=mysqli_query($conn,$univeristyexists);
  $rowaffected=mysqli_num_rows($result);

  if($rowaffected==1){
    while($row=mysqli_fetch_assoc($result)){
        if(password_verify($password,$row['Password'])){
            session_start();
            $_SESSION['adminloggedin']=true;
            $_SESSION['universitycode']=$row['University_code'];
            $_SESSION['universityname']=$row['University_name'];
            echo "done";
            header("location:/TMS/adminportal.php?login=true");
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
    <title>Admin Login</title>
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
        Login as Admin
    </div>

    <div class="container">
        <form class="mx-auto pt-1" action="adminlogin.php" method="post">
            <div class="mb-3">
                <label for="universityname" class="form-label"></label>
                <input type="text" class="form-control" id="universityname" name="universityname" aria-describedby="emailHelp"
                    placeholder="University Name">
            </div>
            <div class="mb-3">
                <label for="universitycode" class="form-label"></label>
                <input type="text" class="form-control" id="universitycode" name="universitycode" aria-describedby="emailHelp"
                    placeholder="University Code">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary logbutton">LOGIN</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>