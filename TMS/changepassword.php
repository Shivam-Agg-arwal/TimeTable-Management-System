<?php
include "partials/_dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldpassword = $_POST["oldpassword"];
    $newpassword = $_POST["newpassword"];
    $confirmnewpassword = $_POST["confirmnewpassword"];
    session_start();
    $universitycode=$_SESSION['universitycode'];
    $studentid=$_SESSION['studentid'];

    $sql="SELECT * FROM `students` WHERE University_code='$universitycode' AND Student_id='$studentid'";
    $result=mysqli_query($conn,$sql);
    $rowaffected=mysqli_num_rows($result);

    if($rowaffected==1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($oldpassword,$row['Password'])){
                if($newpassword==$confirmnewpassword){
                    $hash=password_hash($newpassword,PASSWORD_DEFAULT);
                    $insertsql="UPDATE `students` SET `Password` = '$hash' WHERE `students`.`University_code` = $universitycode AND `Student_id` =$studentid";
                    $insertresult=mysqli_query($conn,$insertsql);
                    if($insertresult){
                        echo "Password changed ";
                    }
                    else{
                        echo "Not dhanged";
                    }
                }
                else{
                    echo "password dont match ";
                }
            }
            else{
                echo "wrong old password";
            }
        }
    }


}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
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
        <h2 class="container text-center"><u>Change Your Password</u></h2>
        <form action="changepassword.php" method="post">
            <div class="mb-1">
                <label for="oldpassword" class="form-label"></label>
                <input type="password" class="form-control" id="oldpassword" name="oldpassword" aria-describedby="emailHelp"
                    placeholder="Old Password">
            </div>
            <div class="mb-1">
                <label for="newpassword" class="form-label"></label>
                <input type="password" class="form-control" id="newpassword" name="newpassword" aria-describedby="emailHelp"
                    placeholder="New Password">
            </div>
            <div class="mb-1">
                <label for="confirmnewpassword" class="form-label"></label>
                <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword" aria-describedby="emailHelp"
                    placeholder="Confirm New Password">
            </div>

            <div class="mt-4">

<button type="submit" class="btn btn-primary">Change Password</button>
<a href="studentportal.php" class="btn btn-primary">Back to Home </a>

</div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>