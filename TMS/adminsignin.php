<?php

include "partials/_dbconnect.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){
  $universityname=$_POST["universityname"];
  $state=$_POST["state"];
  $country=$_POST["country"];
  $fullname=$_POST["fullname"];
  $phonenumber=$_POST["phonenumber"];
  $emailid=$_POST["emailid"];
  $password=$_POST["password"];
  $confirmpassword=$_POST["confirmpassword"];
  $hours=$_POST["hours"];
  $starttime=$_POST["starttime"];

  if($password==$confirmpassword){
    $hash=password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO `adminlogins` (`University_code`, `University_name`, `State`, `Country`, `Admin_name`, `Phone_number`, `Email_id`, `Password`,`Students_count`,`Faculty_count`,`Classrooms_count`,`Course_count`,`College_Start_Time`,`Hours`, `Timestamp`) VALUES (NULL, '$universityname', '$state', '$country', '$fullname', '$phonenumber', '$emailid', '$hash','0','0','0','0','$starttime','$hours', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    if($result){
      echo "Successfully signed in . POP UP TO TAKE TO LOGIN";
      echo "give university code to the user ";
    }
    else{
      echo "Not able to sign in ";
    }
  }
  else{
    echo "password dont match";
  }
  
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Signin</title>
    <link rel="stylesheet" href="adminsignin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container maincontainer">
        <h3 class="container text-center">BASIC INFORMATION REQUIRED TO SIGNIN</h3>
        <form action="adminsignin.php" method="post">
            <div class="mb-3">
              <label for="universityname" class="form-label">University Name</label>
              <input type="text" class="form-control" id="universityname" name="universityname" aria-describedby="emailHelp" required>
            </div>
              <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" name="state" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="fullname" class="form-label">Your FullName</label>
                <input type="text" class="form-control" id="fullname" name="fullname" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="phonenumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="emailid" class="form-label">Email ID</label>
                <input type="email" class="form-control" id="emailid" name="emailid" aria-describedby="emailHelp" required>
              </div>

              <div class="mb-3">
                <label for="starttime" class="form-label">College Start Time</label>
                <input type="time"  class="form-control" id="starttime" name="starttime" aria-describedby="emailHelp" required>
              </div>

              <div class="mb-3">
                <label for="hours" class="form-label">No.of hours college operates </label>
                <input type="number" min="1" max="24" class="form-control" id="hours" name="hours" aria-describedby="emailHelp" required>
              </div>

            <div class="mb-3">
              <label for="password" class="form-label">Set a Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
              </div>
            <button type="submit" class="btn btn-primary">Signin</button>
          </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>