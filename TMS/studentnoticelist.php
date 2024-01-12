<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
      body{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
}

.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
    </style>
  </head>
  <body>
  <div class="container emp-profile">
  <h3 class="container text-center">NOTICES</h3>

  <?php
  include "partials/_dbconnect.php";
  session_start();
  $universitycode=$_SESSION['universitycode'];

  $sql="SELECT * FROM `notices` WHERE University_code= '$universitycode' ORDER BY `S.No` DESC ";
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_assoc($result)){

    $noticedate=$row['Date'];
    $noticesubject=$row['Subject'];
    $noticeno=$row['S.No'];
    $noticedesc=$row['Notice'];

    echo '<div class="row">
    <div class="col-md-2">
      <p><b>'.$noticedate.'</b></p>
    </div>
    <div class="col-md-10"><b>'.$noticesubject.'</b><br> '.$noticedesc.'</div>
  </div><hr> ';
  
  }
  echo '<div class="mt-4 text-center"> <a href="studentportal.php" class="btn btn-primary">Back to Home </a></div>';
?>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>